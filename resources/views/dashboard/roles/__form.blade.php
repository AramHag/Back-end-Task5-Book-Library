<div class="form-group">
    <label for="name">Role Name :</label>
    <input type="text" class="form-control  @error('name')
        is-invalid
    @enderror" name="name"
        value="{{ old('name', optional($role ?? null)->name) }}">
    @error('name')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div>
    <button type="submit" class="btn btn-primary btn-md">Save <i class="fa-solid fa-share ml-2"></i> </button>
</div>
