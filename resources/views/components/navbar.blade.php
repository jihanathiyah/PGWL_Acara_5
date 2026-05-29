<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

        <!-- Kiri -->
        <a class="navbar-brand me-auto" href="#">
            <i class="fa-solid fa-cat me-2"></i>{{ $title }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Kanan -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                        <i class="fa-solid fa-house me-1"></i>Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('peta') }}">
                        <i class="fa-solid fa-map me-1"></i>Peta
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tabel') }}">
                        <i class="fa-solid fa-table me-1"></i>Tabel
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tentang') }}">
                        <i class="fa-solid fa-circle-info me-1"></i>Tentang
                    </a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fa-solid fa-arrow-right-to-bracket me-1"></i>Login
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent">
                                <i class="fa-solid fa-right-from-bracket me-1"></i>Logout
                            </button>
                        </form>
                    </li>
                @endauth

            </ul>
        </div>

    </div>
</nav>
