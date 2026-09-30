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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if ($activity->poster_path)
                    <img src="{{ asset('storage/' . $activity->poster_path) }}" class="img-fluid mb-3" style="max-height:300px">
                @endif

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
                @if ($activity->status === 'draft')
                    <form action="{{ route('activities.publish', $activity) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success">Publish</button>
                    </form>
                @elseif ($activity->status === 'published')
                    <form action="{{ route('activities.complete', $activity) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-primary">Tandai Selesai</button>
                    </form>
                @endif
                <a href="{{ route('activities.edit', $activity) }}" class="btn btn-warning text-white">Edit</a>
            </div>
        </div>

        @if ($activity->status === 'published')
        <div class="card shadow-sm mt-3">
            <div class="card-header bg-white fw-bold">
                Daftar Peserta ({{ $activity->registered_count }}/{{ $activity->capacity }})
            </div>
            <div class="card-body">
                <form action="{{ route('activities.register', $activity) }}" method="POST" class="row g-2">
                    @csrf
                    <div class="col-md-5">
                        <input type="text" name="participant_name" placeholder="Nama" class="form-control @error('participant_name') is-invalid @enderror" value="{{ old('participant_name') }}">
                        @error('participant_name') <p class="text-danger small">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-md-5">
                        <input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email') <p class="text-danger small">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    </div>
                </form>
                @error('status') <p class="text-danger small mt-2">{{ $message }}</p> @enderror
                @error('capacity') <p class="text-danger small mt-2">{{ $message }}</p> @enderror
            </div>
        </div>
        @endif
    </div>
</div>
@endsection