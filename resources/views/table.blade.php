@extends('layouts.template')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css">

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
                <h3 class="mb-0">Tabel Data Point</h3>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped" id="tabledatapoints">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Foto</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($points as $p)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $p['name'] }}</td>
                                <td>{{ $p['description'] }}</td>
                                <td>
                                    <img src="{{ asset('storage/images') . '/' . $p['image'] }}" alt=""
                                        width="100">
                                </td>
                                <td>{{ $p['created_at'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="mb-0">Tabel Data Polyline</h3>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped" id="tabledatapolylines">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Foto</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($polylines as $p)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $p['name'] }}</td>
                                <td>{{ $p['description'] }}</td>
                                <td>
                                    <img src="{{ asset('storage/images') . '/' . $p['image'] }}" alt=""
                                        width="100">
                                </td>
                                <td>{{ $p['created_at'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="mb-0">Tabel Data Polygon</h3>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped" id="tabledatapolygons">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Foto</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($polygons as $p)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $p['name'] }}</td>
                                <td>{{ $p['description'] }}</td>
                                <td>
                                    <img src="{{ asset('storage/images') . '/' . $p['image'] }}" alt=""
                                        width="100">
                                </td>
                                <td>{{ $p['created_at'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
        <script>
            new DataTable('#tabledatapoints');
            new DataTable('#tabledatapolylines');
            new DataTable('#tabledatapolygons');
        </script>
    @endsection
