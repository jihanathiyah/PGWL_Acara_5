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
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Aplikasi Geospasial CRUD</h3>
            </div>

            <div class="card-body">
                <p>Aplikasi ini dibuat untuk memenuhi tugas mata kuliah Pemrograman Geospasial Web Lanjut. Aplikasi ini
                menampilkan peta interaktif yang menunjukkan objek dengan geometri titik, garis, dan area yang dapat
                ditambah, ditampilkan, diubah, dan dihapus. Aplikasi ini dikembangkan dengan menggunakan Laravel dan
                PostgreSQL - PostGIS.</p>
            </div>
        </div>

            <div class="row mt-3">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Jumlah Point</h3>
                        </div>
                        <div class="card-body text-center">
                            <h1>
                                {{ $points_count }}
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Jumlah Polyline</h3>
                        </div>
                        <div class="card-body text-center">
                            <h1>
                                {{ $polylines_count }}
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Jumlah Polygon</h3>
                        </div>
                        <div class="card-body text-center">
                            <h1>
                                {{ $polygons_count }}
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Jumlah User</h3>
                        </div>
                        <div class="card-body text-center">
                            <h1>
                                {{ $users_count }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
