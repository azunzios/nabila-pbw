<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Publikasi Baru</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Form Tambah Publikasi</h4>
            </div>
            <div class="card-body">
                <!-- PENTING: enctype untuk upload file -->
                <form action="{{ route('publikasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Publikasi</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_rilis" class="form-label">Tanggal Rilis</label>
                        <input type="date" name="tanggal_rilis" id="tanggal_rilis" class="form-control" value="{{ old('tanggal_rilis') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="sampul" class="form-label">Upload Sampul</label>
                        <input type="file" name="sampul" id="sampul" class="form-control" accept="image/*">
                        <small class="text-muted">Format: jpg, jpeg, png. Maks 5MB.</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('publikasi.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>