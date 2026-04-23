@extends('layouts.template')

@section('styles')
    <style>
        body {
            background-color: #ffe7e7;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(236, 158, 158, 0.764);
        }

        .card-header {
            background: #fd0d0d56;
            color: white;
            font-weight: 600;
            border-radius: 12px 12px 0 0;
        }

        thead {
            background-color: #e9f2ff;
        }

        th {
            text-align: center;
            font-weight: 600;
        }

        td {
            vertical-align: middle;
        }

        tbody tr:hover {
            background-color: #f1f7ff;
            transition: 0.2s;
        }
    </style>
@endsection

@section('content')
    <!-- Content -->
    <div class="container mt-4">

        <div class="card">

            <div class="card-header">
                <h3 class="mb-0">Tabel Data</h3>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Bundaran UGM</td>
                            <td>Jalan Pancasila</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Monumen Jogja Kembali</td>
                            <td>Jl. Ring Road Utara</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Keraton Yogyakarta</td>
                            <td>Jl. Rotowijayan No.1</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Taman Sari</td>
                            <td>Jl. Taman Sari No.2</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Alun-Alun Kidul</td>
                            <td>Jl. Alun-Alun Kidul</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
