@extends('layouts.main')

@push('title')
    <title>Logout</title>
@endpush

@section('content')
    <div class="container-fluid bg-light p-5">
        <h1 class="text-center text-secondary">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </h1>
    </div>

    <section>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <div class="card shadow p-4 text-center">
                        <h4 class="mb-4">Are you sure you want to logout?</h4>

                        <form method="POST" action="{{ url('logout') }}">
                            @csrf

                            <button type="submit" class="btn btn-danger form-control form-control-lg mb-3">
                                Yes, Logout
                            </button>
                        </form>

                        <a href="{{ url('user/') }}" class="btn btn-secondary form-control form-control-lg">
                            Cancel & Go Back
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection