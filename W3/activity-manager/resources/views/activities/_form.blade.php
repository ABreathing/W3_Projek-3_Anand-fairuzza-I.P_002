<div class="mb-3">
    <label for="category_id" class="form-label">Kategori</label>
    <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $activity->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p class="text-danger small mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="code" class="form-label">Kode Kegiatan</label>
    <input type="text"
           id="code"
           name="code"
           class="form-control @error('code') is-invalid @enderror"
           value="{{ old('code', $activity->code ?? '') }}">
    @error('code')
        <p class="text-danger small mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="title" class="form-label">Judul Kegiatan</label>
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
    <label for="location" class="form-label">Lokasi</label>
    <input type="text"
           id="location"
           name="location"
           class="form-control @error('location') is-invalid @enderror"
           value="{{ old('location', $activity->location ?? '') }}">
    @error('location')
        <p class="text-danger small mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="start_at" class="form-label">Tanggal Mulai</label>
        <input type="datetime-local"
               id="start_at"
               name="start_at"
               class="form-control @error('start_at') is-invalid @enderror"
               value="{{ old('start_at', ($activity->start_at ?? null)?->format('Y-m-d\TH:i')) }}">
        @error('start_at')
            <p class="text-danger small mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="end_at" class="form-label">Tanggal Selesai</label>
        <input type="datetime-local"
               id="end_at"
               name="end_at"
               class="form-control @error('end_at') is-invalid @enderror"
               value="{{ old('end_at', ($activity->end_at ?? null)?->format('Y-m-d\TH:i')) }}">
        @error('end_at')
            <p class="text-danger small mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="capacity" class="form-label">Kapasitas</label>
    <input type="number"
           id="capacity"
           name="capacity"
           min="1"
           max="500"
           class="form-control @error('capacity') is-invalid @enderror"
           value="{{ old('capacity', $activity->capacity ?? '') }}">
    @error('capacity')
        <p class="text-danger small mt-1">{{ $message }}</p>
    @enderror
</div>