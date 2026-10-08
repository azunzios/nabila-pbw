<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Publikasi BPS Provinsi Jawa Tengah</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('publikasi.index') }}">
            <img src="{{ asset('images/logo bps.png') }}" alt="Logo BPS" height="40" class="d-inline-block align-text-top">
            <span class="fw-bold">BPS Provinsi Jawa Tengah</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('publikasi.index') }}">
                        Daftar Publikasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('publikasi.create') }}">
                        Tambah Publikasi
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="flex-grow-1">
<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Daftar Publikasi</h1>
            <p class="text-muted mb-0">Publikasi BPS Provinsi Jawa Tengah</p>
        </div>

        <a href="{{ route('publikasi.create') }}" class="btn btn-primary">
            Tambah Publikasi
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4">No</th>
                            <th class="text-center">Judul</th>
                            <th class="text-center">Tanggal Rilis</th>
                            <th class="text-center">Sampul</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($publikasi as $index => $item)
                            <tr>
                                <td class="px-4">{{ $index + 1 }}</td>
                                <td class="fw-semibold text-center">{{ $item->judul }}</td>
                                <td class="text-center">{{ $item->tanggal_rilis }}</td>
                                <td class="text-center">
                                    @if($item->sampul)
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ asset('images/'.$item->sampul) }}"
                                                alt="{{ $item->judul }}"
                                                width="70"
                                                class="img-thumbnail">
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('publikasi.edit', $item->id) }}"
                                    class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('publikasi.destroy', $item->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</main>

<footer class="mt-auto border-top bg-light py-4 shadow-sm">
    <div class="container text-center text-muted small">
        <div class="fw-semibold text-dark">BPS PROVINSI JAWA TENGAH
        </div>
        <div>Created by Nabila Novita Rahma (222413701)</div>
        <div>Politeknik Statistika STIS</div>
        <div>Program Studi DIV Komputasi Statistik</div>
        <div>Jakarta, Indonesia</div>
    </div>
</footer>
</body>

</html>