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