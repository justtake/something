@php
    $superAdmin = $superAdmin ?? request('superadmin');
    $failed = session('failed');
    $errors = $errors ?? session('errors');
    $success = session('success');
@endphp

@if ($superAdmin)
    <div class="alert alert-info" role="alert">
        I Am Super Admin!
    </div>
@endif

@if ($failed)
    <div class="alert alert-danger" role="alert">
        {{ $failed }}
    </div>
@endif

@if ($errors && $errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@if ($success)
    <div class="alert alert-success" role="alert">
        {{ $success }}
    </div>
@endif
