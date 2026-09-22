<div class="mb-3">
    <label for="title" class="form-label">Judul Aktivitas</label>
    <input type="text" 
           id="title" 
           name="title" 
           class="form-control @error('title') is-invalid @enderror" 
           value="{{ old('title', $activity->title ?? '') }}">
    @error('title')
        <p class="text-danger small mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea id="description" 
              name="description" 
              class="form-control @error('description') is-invalid @enderror" 
              rows="4">{{ old('description', $activity->description ?? '') }}</textarea>
    @error('description')
        <p class="text-danger small mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
        <option value="">-- Pilih Status --</option>
        <option value="pending" {{ old('status', $activity->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in_progress" {{ old('status', $activity->status ?? '') == 'in_progress' ? 'selected' : '' }}>Sedang Berjalan</option>
        <option value="completed" {{ old('status', $activity->status ?? '') == 'completed' ? 'selected' : '' }}>Selesai</option>
    </select>
    @error('status')
        <p class="text-danger small mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="due_date" class="form-label">Tenggat Waktu</label>
    <input type="date" 
           id="due_date" 
           name="due_date" 
           class="form-control @error('due_date') is-invalid @enderror" 
           value="{{ old('due_date', $activity->due_date ?? '') }}">
    @error('due_date')
        <p class="text-danger small mt-1">{{ $message }}</p>
    @enderror
</div>