@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">Edit Aktivitas</div>
            <div class="card-body">
                <form action="{{ route('activities.update', $activity->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('activities._form')

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('activities.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection