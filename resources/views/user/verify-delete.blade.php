@extends('layouts.main')

@push('title')
    <title>TERMINATION_PROTOCOL | IDENTITY PURGE</title>
@endpush

@section('content')
<style>
    :root {
        --gaming-bg: #050811;
        --gaming-card: #0f172a;
        --neon-cyan: #00f2ff;
        --neon-purple: #bc13fe;
        --neon-red: #ff3131;
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
        border: 1px solid var(--neon-red);
        border-radius: 10px;
        padding: 3rem;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 0 50px rgba(255, 49, 49, 0.1);
        position: relative;
    }

    .auth-card::before {
        content: 'WARNING: DELETION_IN_PROGRESS';
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-red);
        font-size: 0.7rem;
        letter-spacing: 2px;
    }

    .auth-title {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-red);
        letter-spacing: 3px;
        text-align: center;
        margin-bottom: 2rem;
        text-transform: uppercase;
    }

    .auth-input {
        background: rgba(0, 0, 0, 0.5) !important;
        border: 1px solid rgba(255, 49, 49, 0.3) !important;
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
        border-color: var(--neon-red) !important;
        box-shadow: 0 0 20px rgba(255, 49, 49, 0.3) !important;
    }

    .btn-auth {
        background: transparent;
        border: 1px solid var(--neon-red);
        color: var(--neon-red);
        padding: 15px;
        font-family: 'Orbitron', sans-serif;
        width: 100%;
        letter-spacing: 2px;
        transition: 0.3s;
        text-transform: uppercase;
        margin-top: 1.5rem;
    }

    .btn-auth:hover {
        background: var(--neon-red);
        color: #fff;
        box-shadow: 0 0 30px var(--neon-red);
    }
</style>

<div class="auth-container">
    <div class="container d-flex justify-content-center">
        <div class="auth-card">
            <h2 class="auth-title">IDENTITY_PURGE</h2>
            <p class="text-secondary text-center small mb-4" style="letter-spacing: 1px;">ENTER THE 6-DIGIT TERMINATION CODE TO FINALIZE ACCOUNT DELETION.</p>

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

            <form method="POST" action="{{ route('user.delete.confirm') }}">
                @csrf
                <div class="mb-4">
                    <input type="text" name="otp" class="form-control auth-input" required maxlength="6" pattern="\d{6}" placeholder="------" autofocus>
                </div>

                <button type="submit" class="btn btn-auth mb-3">
                    CONFIRM_TERMINATION <i class="fa-solid fa-skull ms-2"></i>
                </button>

                <div class="text-center mt-4">
                    <a href="{{ url('user/') }}" class="text-secondary small text-decoration-none">
                        ABORT_PROTOCOL
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
