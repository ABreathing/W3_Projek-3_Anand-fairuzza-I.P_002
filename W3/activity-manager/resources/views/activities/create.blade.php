@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">Tambah Aktivitas Baru</div>
            <div class="card-body">
                <form action="{{ route('activities.store') }}" method="POST">
                    @csrf
                    
                    @include('activities._form')

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('activities.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection