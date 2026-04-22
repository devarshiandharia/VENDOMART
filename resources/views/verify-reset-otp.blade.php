@extends('layouts.main')

@push('title')
    <title>VERIFY | IDENTITY CONFIRMATION</title>
@endpush

@section('content')
<style>
    :root {
        --gaming-bg: #050811;
        --gaming-card: #0f172a;
        --neon-cyan: #00f2ff;
        --neon-purple: #bc13fe;
        --glass-bg: rgba(15, 23, 42, 0.8);
    }

    body {
        background-color: var(--gaming-bg) !important;
    }

    .auth-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4rem 0;
    }

    .auth-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(188, 19, 254, 0.3);
        border-radius: 10px;
        padding: 3rem;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 0 50px rgba(188, 19, 254, 0.1);
    }

    .auth-title {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-purple);
        letter-spacing: 3px;
        text-align: center;
        margin-bottom: 2rem;
        text-transform: uppercase;
    }

    .auth-input {
        background: rgba(0, 0, 0, 0.5) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: white !important;
        padding: 15px !important;
        border-radius: 0 !important;
        text-align: center;
        letter-spacing: 10px;
        font-size: 2rem;
        font-family: 'Orbitron', sans-serif;
        width: 100%;
    }

    .auth-input:focus {
        border-color: var(--neon-purple) !important;
        box-shadow: 0 0 20px rgba(188, 19, 254, 0.3) !important;
    }

    .btn-auth {
        background: transparent;
        border: 1px solid var(--neon-purple);
        color: var(--neon-purple);
        padding: 15px;
        font-family: 'Orbitron', sans-serif;
        width: 100%;
        letter-spacing: 2px;
        transition: 0.3s;
        text-transform: uppercase;
        margin-top: 1.5rem;
    }

    .btn-auth:hover {
        background: var(--neon-purple);
        color: #fff;
        box-shadow: 0 0 30px var(--neon-purple);
    }
</style>

<div class="auth-container">
    <div class="container d-flex justify-content-center">
        <div class="auth-card">
            <h2 class="auth-title">IDENTITY_VERIFY</h2>
            <p class="text-secondary text-center small mb-4" style="letter-spacing: 1px;">ENTER THE 6-DIGIT RECOVERY CODE BEAMED TO YOUR SIGNAL ADDRESS.</p>

            @if(session('success'))
                <div class="alert alert-success bg-dark text-info border-info rounded-0 mb-4 small">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger bg-dark text-danger border-danger rounded-0 mb-4 small">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.verify.otp.post') }}">
                @csrf
                <div class="mb-4">
                    <input type="text" name="otp" class="form-control auth-input" required maxlength="6" pattern="\d{6}" placeholder="------" autofocus>
                </div>

                <button type="submit" class="btn btn-auth mb-3">
                    VERIFY_IDENTITY <i class="fa-solid fa-microchip ms-2"></i>
                </button>

                <div class="text-center mt-4">
                    <a href="{{ route('forgot.password') }}" class="text-secondary small text-decoration-none">
                        RESEND_CODE
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
