<div class="row mb-3">
    <div class="col-6">
        <label for="name">Category name:</label>
        <input type="text" name="name" value="{{ old('name' , optional($category ?? null)->name) }}" class="form-control @error('name')
            is-invalid
        @enderror">
        @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="col-6">
        <label for="parent category">Parent category:</label>
        <select name="parent_id" class="form-control">
            <option value="">select parent category </option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="col-6"></div>
</div>

<div>
    <button type="submit" class="btn btn-primary btn-md">Save <i class="fa-solid fa-share ml-2"></i> </button>
</div>