@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Kegiatan</h2>
    <a href="{{ route('activities.create') }}" class="btn btn-primary">+ Tambah Kegiatan</a>
</div>

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
                        <td colspan="7" class="text-center text-muted py-4">Belum ada kegiatan.</td>
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