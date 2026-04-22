@extends('layouts.main')

@push('title')
    <title>SYNC | IDENTIFY USER</title>
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
        overflow-x: hidden;
    }

    .login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4rem 0;
    }

    .login-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 242, 255, 0.2);
        border-radius: 0;
        box-shadow: 0 0 50px rgba(0, 242, 255, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 1000px;
        position: relative;
    }

    .login-card::after {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 4px; height: 100%;
        background: var(--neon-cyan);
        box-shadow: 0 0 15px var(--neon-cyan);
    }

    .login-image-side {
        background: linear-gradient(135deg, #0f172a 0%, #050811 100%);
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem;
        color: white;
        border-right: 1px solid rgba(255,255,255,0.05);
    }

    .login-image-side img {
        max-width: 100%;
        height: auto;
        border: 1px solid var(--neon-cyan);
        box-shadow: 0 0 30px rgba(0, 242, 255, 0.3);
        padding: 10px;
        background: rgba(0,0,0,0.5);
    }

    .login-form-side {
        padding: 4rem;
        background: transparent;
    }

    .form-header {
        margin-bottom: 3rem;
    }

    .form-header h2 {
        font-family: 'Orbitron', sans-serif;
        font-weight: 800;
        color: var(--neon-cyan);
        text-transform: uppercase;
        letter-spacing: 5px;
        margin-bottom: 1rem;
    }

    .form-header p {
        color: #94a3b8;
        font-size: 0.9rem;
        letter-spacing: 2px;
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
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control-custom:focus {
        border-color: var(--neon-purple) !important;
        background: rgba(188, 19, 254, 0.05) !important;
        box-shadow: 0 0 15px rgba(188, 19, 254, 0.2) !important;
        outline: none;
    }

    .input-group-custom i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--neon-cyan);
        filter: drop-shadow(0 0 5px var(--neon-cyan));
    }

    .btn-login {
        background: transparent;
        border: 1px solid var(--neon-cyan);
        color: var(--neon-cyan);
        padding: 15px;
        border-radius: 0;
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        width: 100%;
        letter-spacing: 3px;
        transition: all 0.3s ease;
        text-transform: uppercase;
    }

    .btn-login:hover {
        background: var(--neon-cyan);
        color: #000;
        box-shadow: 0 0 30px var(--neon-cyan);
    }

    .signup-link {
        margin-top: 2.5rem;
        text-align: center;
        color: #64748b;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }

    .signup-link a {
        color: var(--neon-purple);
        font-weight: 700;
        text-decoration: none;
        text-transform: uppercase;
    }

    .signup-link a:hover {
        color: var(--neon-cyan);
        text-shadow: 0 0 10px var(--neon-cyan);
    }

    @media (max-width: 768px) {
        .login-image-side {
            display: none;
        }
    }
</style>

<div class="login-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 px-4">
                <div class="login-card mx-auto">
                    <div class="row g-0">
                        <div class="col-md-5 login-image-side">
                            <div class="text-center w-100">
                                <h4 class="mb-4" style="font-family: 'Orbitron', sans-serif; color: var(--neon-cyan); letter-spacing: 2px;">VENDOMART_HQ</h4>
                                <p class="mb-5 text-secondary small" style="letter-spacing: 1px;">ENCRYPTED_CONNECTION_ESTABLISHED<br>AUTHORIZED_PERSONNEL_ONLY</p>
                                <div class="px-3">
                                    <img src="https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&w=1000&q=80" alt="High-End RGB Hardware" class="img-fluid rounded-4 shadow-lg border border-info border-opacity-25">
                                </div>
                                <div class="mt-5 small text-info opacity-50" style="font-family: 'Orbitron', sans-serif;">[ GEAR_LEVEL: ELITE ]</div>
                            </div>
                        </div>
                        <div class="col-md-7 login-form-side">
                            <div class="form-header">
                                <h2>SYNC PROFILE</h2>
                                <p>INITIALIZE BIOMETRIC DATA</p>
                            </div>

                            @if(session('error'))
                                <div class="alert alert-danger bg-dark border-danger text-danger rounded-0 mb-4">
                                    <i class="fa-solid fa-triangle-exclamation me-2"></i> ERROR: {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ url('login') }}">
                                @csrf
                                <div class="input-group-custom">
                                    <i class="fa-solid fa-id-badge"></i>
                                    <input type="email" name="email" class="form-control-custom" placeholder="EMAIL_IDENTIFIER" required autofocus>
                                </div>

                                <div class="input-group-custom">
                                    <i class="fa-solid fa-terminal"></i>
                                    <input type="password" name="password" class="form-control-custom" placeholder="ACCESS_KEY" required>
                                </div>

                                <div class="mb-4 text-end">
                                    <a href="{{ route('forgot.password') }}" class="text-secondary small text-decoration-none hover-cyan" style="letter-spacing: 1px;">
                                        [ FORGOT_ACCESS_KEY? ]
                                    </a>
                                </div>

                                <button type="submit" class="btn btn-login mb-4">
                                    INITIALIZE SYNC <i class="fa-solid fa-bolt ms-2"></i>
                                </button>

                                <div class="signup-link">
                                    NO RECORD FOUND? <a href="{{ url('register') }}">CREATE PROFILE</a>
                                </div>

                                <style>
                                    .hover-cyan:hover {
                                        color: var(--neon-cyan) !important;
                                        text-shadow: 0 0 8px var(--neon-cyan);
                                    }
                                </style>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection