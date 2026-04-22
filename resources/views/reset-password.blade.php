@extends('layouts.main')

@push('title')
    <title>RESET | KEY_INITIALIZATION</title>
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
        border-color: var(--neon-purple) !important;
        background: rgba(188, 19, 254, 0.05) !important;
        box-shadow: 0 0 15px rgba(188, 19, 254, 0.2) !important;
    }

    .input-group-custom i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--neon-purple);
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
            <h2 class="auth-title">KEY_RE_INITIALIZE</h2>
            <p class="text-secondary text-center small mb-4" style="letter-spacing: 1px;">GENERATE A NEW SECURE ACCESS KEY FOR YOUR PROFILE.</p>

            @if($errors->any())
                <div class="alert alert-danger bg-dark border-danger text-danger rounded-0 mb-4 small">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.reset.post') }}">
                @csrf
                <div class="input-group-custom">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" class="form-control-custom" placeholder="NEW_ACCESS_KEY" required autofocus>
                </div>

                <div class="input-group-custom">
                    <i class="fa-solid fa-shield-check"></i>
                    <input type="password" name="password_confirmation" class="form-control-custom" placeholder="CONFIRM_NEW_ACCESS_KEY" required>
                </div>

                <button type="submit" class="btn btn-auth mb-3">
                    EXECUTE_RESET <i class="fa-solid fa-key-skeleton ms-2"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
