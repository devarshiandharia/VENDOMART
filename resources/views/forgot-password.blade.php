@extends('layouts.main')

@push('title')
    <title>RECOVERY | IDENTITY RESET</title>
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
        border: 1px solid rgba(0, 242, 255, 0.2);
        border-radius: 10px;
        padding: 3rem;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 0 50px rgba(0, 242, 255, 0.1);
    }

    .auth-title {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-cyan);
        letter-spacing: 3px;
        text-align: center;
        margin-bottom: 2rem;
        text-transform: uppercase;
    }

    .input-group-custom {
        position: relative;
        margin-bottom: 2rem;
    }

    .form-control-custom {
        background: rgba(255,255,255,0.02) !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        color: white !important;
        padding: 15px 15px 15px 50px;
        border-radius: 0;
        width: 100%;
        transition: 0.3s;
    }

    .form-control-custom:focus {
        border-color: var(--neon-cyan) !important;
        background: rgba(0, 242, 255, 0.05) !important;
        box-shadow: 0 0 15px rgba(0, 242, 255, 0.2) !important;
    }

    .input-group-custom i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--neon-cyan);
    }

    .btn-auth {
        background: transparent;
        border: 1px solid var(--neon-cyan);
        color: var(--neon-cyan);
        padding: 15px;
        font-family: 'Orbitron', sans-serif;
        width: 100%;
        letter-spacing: 2px;
        transition: 0.3s;
        text-transform: uppercase;
    }

    .btn-auth:hover {
        background: var(--neon-cyan);
        color: #000;
        box-shadow: 0 0 30px var(--neon-cyan);
    }
</style>

<div class="auth-container">
    <div class="container d-flex justify-content-center">
        <div class="auth-card">
            <h2 class="auth-title">RECOVERY_UPLINK</h2>
            <p class="text-secondary text-center small mb-4" style="letter-spacing: 1px;">ENTER YOUR IDENTIFIER TO RECEIVE A RECOVERY CODE.</p>

            @if(session('error'))
                <div class="alert alert-danger bg-dark border-danger text-danger rounded-0 mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('forgot.password.post') }}">
                @csrf
                <div class="input-group-custom">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" class="form-control-custom" placeholder="EMAIL_IDENTIFIER" required autofocus>
                </div>

                <button type="submit" class="btn btn-auth mb-3">
                    SEND RECOVERY CODE <i class="fa-solid fa-paper-plane ms-2"></i>
                </button>

                <div class="text-center mt-4">
                    <a href="{{ url('login') }}" class="text-secondary small text-decoration-none hover-cyan">
                        RETURN TO SYNC_GATE
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
