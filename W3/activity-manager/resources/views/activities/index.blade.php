@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Aktivitas</h2>
    <a href="{{ route('activities.create') }}" class="btn btn-primary">+ Tambah Aktivitas</a>
</div>

<form method="GET" action="{{ route('activities.index') }}" class="row g-2 mb-3">
    <div class="col-auto">
        <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="" {{ !$status ? 'selected' : '' }}>Semua</option>
            <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ $status == 'in_progress' ? 'selected' : '' }}>Sedang Berjalan</option>
            <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Selesai</option>
        </select>
    </div>
    @if($status)
        <div class="col-auto">
            <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary">Reset Filter</a>
        </div>
    @endif
</form>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Tenggat Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activities as $activity)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $activity->title }}</td>
                        <td>
                            @if($activity->status == 'completed')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($activity->status == 'in_progress')
                                <span class="badge bg-warning text-dark">Sedang Berjalan</span>
                            @else
                                <span class="badge bg-secondary">Pending</span>
                            @endif
                        </td>
                        <td>{{ $activity->due_date ? \Carbon\Carbon::parse($activity->due_date)->format('d M Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('activities.show', $activity->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                            <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                            <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada data aktivitas.</td>
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