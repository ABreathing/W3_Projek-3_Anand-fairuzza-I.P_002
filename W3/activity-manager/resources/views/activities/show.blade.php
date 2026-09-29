@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                <span>Detail Kegiatan</span>
                <a href="{{ route('activities.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <h4>{{ $activity->title }}</h4>
                <p class="text-muted mb-3">
                    Kode: {{ $activity->code }}
                    | Kategori: {{ $activity->category->name }}
                    | Status: <span class="badge bg-secondary">{{ ucfirst($activity->status) }}</span>
                </p>
                <p class="mb-1"><strong>Lokasi:</strong> {{ $activity->location }}</p>
                <p class="mb-1"><strong>Mulai:</strong> {{ $activity->start_at->format('d M Y H:i') }}</p>
                <p class="mb-1"><strong>Selesai:</strong> {{ $activity->end_at->format('d M Y H:i') }}</p>
                <p class="mb-1"><strong>Kapasitas:</strong> {{ $activity->capacity }}</p>
                <hr>
                <h5>Deskripsi:</h5>
                <p>{{ $activity->description ?? 'Tidak ada deskripsi.' }}</p>
            </div>
            <div class="card-footer bg-white text-end">
                <a href="{{ route('activities.edit', $activity) }}" class="btn btn-warning text-white">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection