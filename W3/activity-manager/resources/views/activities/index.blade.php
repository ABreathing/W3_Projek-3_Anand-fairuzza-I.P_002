@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Kegiatan</h2>
    <div>
        <a href="{{ route('activities.trash') }}" class="btn btn-outline-secondary">Kegiatan Terhapus</a>
        <a href="{{ route('activities.create') }}" class="btn btn-primary">+ Tambah Kegiatan</a>
    </div>
</div>
<form method="GET" action="{{ route('activities.index') }}" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Cari judul atau kode..."
               value="{{ $filters['search'] ?? '' }}">
    </div>
    <div class="col-md-3">
        <select name="category_id" class="form-select">
            <option value="">-- Semua Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <select name="status" class="form-select">
            <option value="">-- Semua Status --</option>
            @foreach (['draft', 'published', 'completed'] as $statusOption)
                <option value="{{ $statusOption }}" @selected(($filters['status'] ?? '') == $statusOption)>
                    {{ ucfirst($statusOption) }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <select name="sort" class="form-select">
            <option value="newest" @selected(($filters['sort'] ?? 'newest') == 'newest')>Tanggal Terbaru</option>
            <option value="oldest" @selected(($filters['sort'] ?? '') == 'oldest')>Tanggal Terlama</option>
        </select>
    </div>
    <div class="col-md-1">
        <button type="submit" class="btn btn-outline-primary w-100">Cari</button>
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Mulai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activities as $activity)
                    <tr>
                        <td>{{ $activities->firstItem() + $loop->index }}</td>
                        <td>{{ $activity->code }}</td>
                        <td>{{ $activity->title }}</td>
                        <td>{{ $activity->category->name }}</td>
                        <td>{{ $activity->start_at->format('d M Y H:i') }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($activity->status) }}</span></td>
                        <td>
                            <a href="{{ route('activities.show', $activity) }}" class="btn btn-sm btn-info text-white">Detail</a>
                            <a href="{{ route('activities.edit', $activity) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                            <form action="{{ route('activities.destroy', $activity) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada kegiatan yang cocok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $activities->links() }}
        </div>
    </div>
</div>
@endsection