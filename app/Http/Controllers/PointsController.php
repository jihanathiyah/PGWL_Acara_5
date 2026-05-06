<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pointsModel;

class PointsController extends Controller
{
    protected $points;
    public function __construct()
    {
        $this->points = new pointsModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validasi Input
        $request->validate(
            [
                'geometry_point' => 'required',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'geometry_point.required' => 'Field geometry point harus diisi.',
                'name.required' => 'Field nama harus diisi.',
                'name.string' => 'Field nama harus berupa string.',
                'name.max' => 'Field nama tidak boleh lebih dari 255 karakter.',
                'description.required' => 'Field deskripsi harus diisi.',
                'description.string' => 'Field deskripsi harus berupa string.',
                'image.image' => 'File harus berupa file gambar.',
                'image.mimes' => 'File gambar harus berupa JPEG, JPG, atau PNG.',
                'image.max' => 'Ukuran file gambar tidak boleh lebih dari 2 MB.',
            ]
        );

        //Create directory for images if it doesnt exist
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        //Get the uploaded image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geometry_point' => $request->geometry_point,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];


        //Simpan data ke database
        if (!$this->points->create($data)) {
            return redirect()->route('peta')->with('error',
            'Gagal menyimpan data point.');
        };

        //kembali ke halaman peta
        return redirect()->route('peta')->with('success',
        'Berhasil menyimpan data point.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
      public function destroy(string $id)
    {
        // Mencari data point berdasarkan ID
        $point = $this->points->find($id);

        if (!$point) {
            return redirect()->route('peta')->with('error', 'Data point tidak ditemukan.');
        }

        $image = $point->image;

        if (!$point->delete()) {
            return redirect()->route('peta')->with('error', 'Gagal menghapus data point.');
        }

        if ($image != null) {
            if (file_exists('./storage/images/' . $image)) {
                unlink('./storage/images/' . $image);
            }
        }

        return redirect()->route('peta')->with('success', 'Data point berhasil dihapus.');
    }
}
