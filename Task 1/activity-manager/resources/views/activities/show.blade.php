@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                <span>Detail Aktivitas</span>
                <a href="{{ route('activities.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <h4>{{ $activity->title }}</h4>
                <p class="text-muted mb-3">
                    Status: 
                    @if($activity->status == 'completed')
                        <span class="badge bg-success">Selesai</span>
                    @elseif($activity->status == 'in_progress')
                        <span class="badge bg-warning text-dark">Sedang Berjalan</span>
                    @else
                        <span class="badge bg-secondary">Pending</span>
                    @endif
                    | Tenggat Waktu: {{ $activity->due_date ? \Carbon\Carbon::parse($activity->due_date)->format('d M Y') : '-' }}
                </p>
                <hr>
                <h5>Deskripsi:</h5>
                <p>{{ $activity->description ?? 'Tidak ada deskripsi.' }}</p>
            </div>
            <div class="card-footer bg-white text-end">
                <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning text-white">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection