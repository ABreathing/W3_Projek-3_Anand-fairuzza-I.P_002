@extends('layouts.app')

@section('content')
<h2 class="mb-3">Kategori</h2>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-white fw-bold">Tambah Kategori</div>
    <div class="card-body">
        <form action="{{ route('categories.store') }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-8">
                <input type="text"
                       name="name"
                       placeholder="Nama kategori"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}">
                @error('name')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
                @error('slug')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped align-middle mb-0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Jumlah Kegiatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->activities_count }}</td>
                        <td>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection