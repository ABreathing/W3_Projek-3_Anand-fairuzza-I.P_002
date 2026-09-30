@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Kegiatan Terhapus</h2>
    <a href="{{ route('activities.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped align-middle mb-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Dihapus Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activities as $activity)
                    <tr>
                        <td>{{ $activity->code }}</td>
                        <td>{{ $activity->title }}</td>
                        <td>{{ $activity->category->name }}</td>
                        <td>{{ $activity->deleted_at->format('d M Y H:i') }}</td>
                        <td>
                            <form action="{{ route('activities.restore', $activity->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-success">Restore</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Tidak ada kegiatan terhapus.</td>
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