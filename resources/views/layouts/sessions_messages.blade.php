@if (session()->has('success'))
    <div class="alert alert-success">
        <i class="fa-regular fa-circle-check fa-lg mr-2"></i>
        {{ session('success') }}
    </div>
@endif
@if (session()->has('warning'))
<div class="alert alert-warning">
    <i class="fa-solid fa-triangle-exclamation fa-lg mr-2"></i>
        {{ session('warning') }}  

    </div>
@endif
@if (session()->has('danger'))
    <div class="alert alert-danger">
        <i class="fa-regular fa-calendar-xmark fa-lg mr-2"></i>
        {{ session('danger') }} 
    </div>
@endif
@if (session()->has('info'))
    <div class="alert alert-info">
        <i class="fa-regular fa-calendar-xmark fa-lg mr-2"></i>
        {{ session('info') }} 
    </div>
@endif