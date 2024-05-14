<div class="form-group">
    <label for="title">Book title :</label>
    <input type="text" name="title" class="form-control @error('title')
        is-invalid
    @enderror"
    value="{{ old('title' , optional($book ?? null)->title) }}">
    @error('title')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="author">Author :</label>
    <input type="text" name="author" class="form-control @error('author')
        is-invalid
    @enderror"
    value="{{ old('author' , optional($book ?? null)->author) }}">
    @error('author')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="publish_date">Publish date :</label>
    <input type="date" name="publish_date"
        class="form-control @error('publish_date')
        is-invalid
    @enderror"
    value="{{ old('publish_date' , optional($book ?? null)->publish_date) }}">
    @error('publish_date')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>


<div class="form-group">
    <label for="category_id">Category</label>
    <select type="date" name="category_id"
        class="form-control @error('category_id')
        is-invalid
    @enderror">
        <option value="" disabled>-- Select Category -- </option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description :</label>
    <textarea name="description" id="description" class="form-control">
        {{ old('description' , optional($book ?? null)->description) }}
    </textarea>
</div>

<div>
    <button type="submit" class="btn btn-primary btn-md">Save <i class="fa-solid fa-share ml-2"></i> </button>
</div>