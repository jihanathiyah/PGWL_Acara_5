@extends('layouts.template')

@section('styles')
    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    {{-- Leaflet Draw CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Mengatur tinggi peta agar memenuhi seluruh layar */
        #map {
            height: calc(100vh - 56px);
            width: 100%;
            );
        }

        /* Menghilangkan margin dan padding default dari body */
        body,
        html {
            height: 100%;
            width: 100%;
            ;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #333;
            padding: 1rem;
            display: flex;
            gap: 1rem;
        }

        nav a {
            color: white;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
        }

        #map {
            flex: 1;
        }
    </style>
@endsection


@section('content')
    <div id="map"></div>

    {{-- Modal Form Edit --}}
    <div class="modal" tabindex="-1" id="modalEdit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('polygons.update', $id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill name here">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry_ppolygon" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geometry" name="geometry" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control" type="file" id="image" name="image"
                                onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                        </div>

                        <div class = "mb-3">
                            <img src="" alt="" id="preview-image" class="img-thumbnail" width="400">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    {{-- Leaflet Draw JS --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    {{-- Terraformer JS --}}
    <script src="https://unpkg.com/@terraformer/wkt"></script>

    {{-- JQuery JS --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // Inisialisasi peta dan atur tampilan ke koordinat Surabaya dengan zoom level 13
        var map = L.map('map').setView([-7.7956, 110.3695], 14);

        // Tambahkan tile layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: false,
            edit: {
                featureGroup: drawnItems,
                edit: true,
                remove: false
            }
        });

        map.addControl(drawControl);

        map.on('draw:edited', function(e) {
            var layers = e.layers;

            layers.eachLayer(function(layer) {
                var drawnJSONObject = layer.toGeoJSON();
                console.log(drawnJSONObject);

                var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);
                console.log(objectGeometry);

                // layer properties
                var properties = drawnJSONObject.properties;
                console.log(properties);

                drawnItems.addLayer(layer);

                // mengisi form edit dengan data dari layer yang diedit
                $('#name').val(properties.name);
                $('#description').val(properties.description);
                $('#geometry').val(properties.Geometry);
                $('#preview-image').attr('src', "{{ asset('storage/images') }}/" + properties.image);

                // menampilkan modal form edit
                $('#modalEdit').modal('show');
            });
        });

        //GeoJSON Polygons
        var polygons = L.geoJSON(null, {

            // onEachFeature
            onEachFeature: function(feature, layer) {

                // memasukkan layer ke dalam drawnItems agar bisa diedit
                drawnItems.addLayer(layer);

                var properties = feature.properties;
                var objectGeometry = Terraformer.geojsonToWKT(feature.geometry);

                layer.on({
                    click: function(e) {

                        // mengisi form edit dengan data dari layer yang diedit
                        $('#name').val(properties.name);
                        $('#description').val(properties.description);
                        $('#geometry_polygon').val(objectGeometry);

                        // preview image
                        if (properties.image) {
                            $('#preview-image').attr(
                                'src',
                                "{{ asset('storage/images') }}/" + properties.image
                            );
                        }

                        // menampilkan modal form edit
                        $('#modalEdit').modal('show');
                    }
                });

                // Route delete polygon
                var routedelete = "{{ route('polygons.delete', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                // Route edit polygon
                var routeedit = "{{ route('polygons.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                // variable popup content
                var popup_content =
                    "Nama: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Dibuat: " + feature.properties.created_at + "<br>" +

                    "<img src='{{ asset('storage/images') }}/" +
                    feature.properties.image +
                    "' alt='' class='img-thumbnail' width='400'>" +

                    "<br><br>" +

                    "<div class='row'>" +

                    "<div class='col-2'>" +
                    "<form action='" + routedelete + "' method='post'>" +
                    '@csrf' +
                    '@method('DELETE')' +

                    "<button type='submit' class='btn btn-sm btn-danger' " +
                    "title='Delete Feature' " +
                    "onclick='return confirm(`Are you sure you want to delete this feature?`)'>" +

                    "<i class='fa-solid fa-trash-can'></i>" +
                    "</button>" +
                    "</form>" +
                    "</div>" +

                    "<div class='col-2'>" +
                    "<a href='" + routeedit + "' class='btn btn-warning btn-sm' title='Edit Point'>" +
                    "<i class='fa-solid fa-pen-to-square'></i>" +
                    "</a>" +
                    "</div>" +

                    "</div>";

                layer.bindPopup(popup_content);
            },
        });

        // menampilkan data geojson
        $.getJSON("{{ route('geojson.polygons') }}", function(data) {
            polygons.addData(data);
            map.addLayer(polygons);
        });
    </script>
@endsection
