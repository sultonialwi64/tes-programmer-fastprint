<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Produk - FastPrint Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .btn { border-radius: 8px; }
        .table thead th { background-color: #0d6efd; color: white; border: none; }
        .table tbody tr:hover { background-color: #f1f3f5; }
        .status-badge { font-size: 0.85em; padding: 5px 10px; border-radius: 20px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-box-seam"></i> FastPrint Produk</a>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0 fw-bold text-primary">Daftar Produk (Siap Jual)</h4>
                <div>
                    <a href="/fetch-data" class="btn btn-warning text-dark me-2">
                        <i class="bi bi-cloud-download-fill"></i> Reset & Tarik API
                    </a>
                    <a href="{{ route('produk.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Tambah Baru
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="rounded-top">
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $p)
                        <tr>
                            <td><span class="text-muted">#{{ $p->id_produk }}</span></td>
                            <td class="fw-bold text-dark">{{ $p->nama_produk }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $p->kategori->nama_kategori ?? '-' }}</span></td>
                            <td class="text-success fw-bold">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-success status-badge">
                                    <i class="bi bi-check-circle"></i> {{ $p->status->nama_status ?? '-' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('produk.edit', $p->id_produk) }}" class="btn btn-sm btn-outline-info me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                <form action="{{ route('produk.destroy', $p->id_produk) }}" method="POST" class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data produk. Silakan klik tombol "Tarik API".
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <footer class="text-center mt-5 text-muted small">
            &copy; 2026 Ahmad Sultoni Alwi - Tes Programmer FastPrint
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Intercept semua form dengan class 'form-delete'
        const deleteForms = document.querySelectorAll('.form-delete');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Stop submit asli
                
                Swal.fire({
                    title: 'Yakin hapus produk?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Lanjutkan submit jika user klik Ya
                    }
                });
            });
        });
    </script>
</body>
</html>