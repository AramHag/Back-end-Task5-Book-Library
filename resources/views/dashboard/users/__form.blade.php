<div class="form-group">
    <label for="name">User name :</label>
    <input type="text" name="name"
        class="form-control @error('name')
            is-invalid
        @enderror">
    @error('name')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="from-group mb-3">
    <label for="email">Email :</label>
    <input type="email" name="email"
        class="form-control @error('error')
        is-invalid
    @enderror">
    @error('error')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="roles">Role</label>
    <select class="form-control roles" name="roles[]" multiple="multiple">
        @foreach ($roles as $role)
            <option value="{{ $role->id }}">
                {{ $role->name }}
                </option>
        @endforeach
    </select>
</div>

@if ($user_roles)
    <div>
        <p>{{ $user_roles }}</p>
    </div>
@endif

<div class="row">
    <div class="col-6 form-group">
        <label for="password">Password :</label>
        <input type="password" name="password"
            class="form-control @error('password')
            is-invalid
        @enderror">
        @error('password')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="col-6 form-group">
        <label for="password_confirmation">Password confirmation :</label>
        <input type="password" name="password_confirmation"
            class="form-control @error('password_confirmation')
            is-invalid
        @enderror">
        @error('password_confirmation')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>

<div>
    <button type="submit" class="btn btn-primary">Save <i class="fa-solid fa-share ml-2"></i> </button>
</div>