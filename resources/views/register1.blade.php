@extends('layouts.main')

@push('title')
    <title>Register</title>
@endpush

@section('content')
    <div class="container-fluid bg-light p-5">
        <h1 class="text-center text-secondary"><i class="fa-solid fa-user"></i> User Register</h1>
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
                                <form method="POST" action="{{ url('register') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <input type="text" name="name" class="form-control form-control-lg"
                                            placeholder="Full Name" required>
                                    </div>

                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control form-control-lg"
                                            placeholder="Email Address" required>
                                    </div>

                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control form-control-lg"
                                            placeholder="Password" required>
                                    </div>

                                    <div class="mb-3">
                                        <input type="password" name="password_confirmation"
                                            class="form-control form-control-lg" placeholder="Confirm Password" required>
                                    </div>

                                    <button type="submit"
                                        class="btn theme-orange-btn text-light form-control form-control-lg">
                                        Signup
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection