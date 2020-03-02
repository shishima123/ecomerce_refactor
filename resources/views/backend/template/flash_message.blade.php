{{-- Flash Message --}}
@if (session('flash_message'))
<div id="alertMessage" class="text-center alert alert-{{ session('flash_type') }}" role="alert">
    {{ session('flash_message') }}
</div>
@endif
{{-- End Flash Message --}}