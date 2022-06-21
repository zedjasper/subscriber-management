@extends('layouts.auth')
@section('content')
<div class="row d-flex align-items-center min-vh-100 justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Login</h5>
                <login-form></login-form>
            </div>
        </div>
    </div>
</div>
@endsection