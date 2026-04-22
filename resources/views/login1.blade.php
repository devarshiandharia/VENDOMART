@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif


@extends('layouts.main')

@push('title')
    <title>Login</title>
@endpush

@section('content')
    <div class="container-fluid bg-light p-5">
        <h1 class="text-center text-secondary"><i class="fa-solid fa-user"></i> User Login</h1>
    </div>

    <section>
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <img src="{{asset('assets/images/register.jpg')}}" class="rounded-3 img-fluid">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div>
                                <form method="POST" action="{{ url('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control form-control-lg"
                                            placeholder="Email Address" required>
                                    </div>

                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control form-control-lg"
                                            placeholder="Password" required>
                                    </div>

                                    <button type="submit"
                                        class="btn theme-orange-btn text-light form-control form-control-lg">
                                        Login
                                    </button>

                                    <div class="text-center p-5 my-5">
                                        Don't have an account?
                                        <a href="{{ url('register') }}" class="text-decoration-none">Signup</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection