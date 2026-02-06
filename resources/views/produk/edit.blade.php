<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }</style>
</head>
<body class="d-flex align-items-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="mb-0 fw-bold">Edit Produk</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST">
                            @csrf
                            @method('PUT') <div class="mb-3">
                                <label class="form-label text-muted small text-uppercase fw-bold">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control form-control-lg" value="{{ $produk->nama_produk }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small text-uppercase fw-bold">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Kategori</label>
                                    <select name="kategori_id" class="form-select">
                                        @foreach($kategoris as $k)
                                            <option value="{{ $k->id_kategori }}" {{ $produk->kategori_id == $k->id_kategori ? 'selected' : '' }}>
                                                {{ $k->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Status</label>
                                    <select name="status_id" class="form-select">
                                        @foreach($statuses as $s)
                                            <option value="{{ $s->id_status }}" {{ $produk->status_id == $s->id_status ? 'selected' : '' }}>
                                                {{ $s->nama_status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
                                <a href="/" class="btn btn-light text-muted">Batal & Kembali</a>
                            </div>
                        </form>
                        </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>