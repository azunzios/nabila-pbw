<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Publikasi BPS Jawa Tengah</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Form Edit Publikasi</h4>
            </div>
            <div class="card-body">
                <!-- PENTING: enctype untuk upload file -->
                <form action="{{ route('publikasi.update', $publikasi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Publikasi</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $publikasi->judul) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_rilis" class="form-label">Tanggal Rilis</label>
                        <input type="date" name="tanggal_rilis" id="tanggal_rilis" class="form-control" value="{{ old('tanggal_rilis', $publikasi->tanggal_rilis) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="sampul" class="form-label">Ganti Sampul</label>
                        <input type="file" name="sampul" id="sampul" class="form-control" accept="image/*">
                        <small class="text-muted">
                            Sampul sekarang:
                            <code>{{ $publikasi->sampul ?? 'belum ada' }}</code>
                        </small>
                    </div>

                    <!-- Preview gambar lama -->
                    @if($publikasi->sampul && file_exists(public_path('images/'.$publikasi->sampul)))
                        <div class="mb-3">
                            <label class="form-label">Sampul Saat Ini:</label><br>
                            <img src="{{ asset('images/'.$publikasi->sampul) }}" alt="{{ $publikasi->judul }}" width="100" class="border rounded">
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('publikasi.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Perbarui Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>