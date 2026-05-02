@extends('layouts.main')

@push('title')
    <title>SYNC | INITIALIZE PROFILE</title>
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

    .register-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4rem 0;
    }

    .register-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(188, 19, 254, 0.2);
        border-radius: 0;
        box-shadow: 0 0 50px rgba(188, 19, 254, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 1000px;
        position: relative;
    }

    .register-card::after {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 4px; height: 100%;
        background: var(--neon-purple);
        box-shadow: 0 0 15px var(--neon-purple);
    }

    .register-image-side {
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

    .register-image-side img {
        max-width: 100%;
        height: auto;
        border: 1px solid var(--neon-purple);
        box-shadow: 0 0 30px rgba(188, 19, 254, 0.3);
        padding: 10px;
        background: rgba(0,0,0,0.5);
    }

    .register-form-side {
        padding: 4rem;
        background: transparent;
    }

    .form-header {
        margin-bottom: 3rem;
    }

    .form-header h2 {
        font-family: 'Orbitron', sans-serif;
        font-weight: 800;
        color: var(--neon-purple);
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
        border-color: var(--neon-cyan) !important;
        background: rgba(0, 242, 255, 0.05) !important;
        box-shadow: 0 0 15px rgba(0, 242, 255, 0.2) !important;
        outline: none;
    }

    .input-group-custom i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--neon-purple);
        filter: drop-shadow(0 0 5px var(--neon-purple));
        transition: 0.3s;
    }

    .form-control-custom:focus + i {
        color: var(--neon-cyan);
        filter: drop-shadow(0 0 5px var(--neon-cyan));
    }

    .btn-register {
        background: transparent;
        border: 1px solid var(--neon-purple);
        color: var(--neon-purple);
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

    .btn-register:hover {
        background: var(--neon-purple);
        color: #fff;
        box-shadow: 0 0 30px var(--neon-purple);
    }
    
    .form-check-label {
        color: #94a3b8;
    }

    .login-link {
        margin-top: 2.5rem;
        text-align: center;
        color: #64748b;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }

    .login-link a {
        color: var(--neon-cyan);
        font-weight: 700;
        text-decoration: none;
        text-transform: uppercase;
    }

    .login-link a:hover {
        color: #fff;
        text-shadow: 0 0 10px var(--neon-cyan);
    }

    @media (max-width: 768px) {
        .register-image-side {
            display: none;
        }
    }
</style>

<div class="register-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 px-4">
                <div class="register-card mx-auto">
                    <div class="row g-0">
                        <div class="col-md-5 register-image-side">
                            <div class="text-center w-100">
                                <h4 class="mb-4" style="font-family: 'Orbitron', sans-serif; color: var(--neon-purple); letter-spacing: 2px;">VENDOMART_CREATE</h4>
                                <p class="mb-5 text-secondary small" style="letter-spacing: 1px;">AWAITING_BIOMETRIC_DATA<br>GENERATING_NEW_PROFILE</p>
                                <div class="px-3">
                                    <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=1000&q=80" alt="High-End RGB Hardware" class="img-fluid rounded-4 shadow-lg border border-info border-opacity-25">
                                </div>
                                <div class="mt-5 small text-info opacity-50" style="font-family: 'Orbitron', sans-serif;">[ GEAR_LEVEL: ASPIRANT ]</div>
                            </div>
                        </div>
                        <div class="col-md-7 register-form-side">
                            <div class="form-header">
                                <h2>INITIALIZE</h2>
                                <p>REGISTER NEW OPERATOR IDENTITY</p>
                            </div>

                            @if(session('error'))
                                <div class="alert alert-danger bg-dark border-danger text-danger rounded-0 mb-4">
                                    <i class="fa-solid fa-triangle-exclamation me-2"></i> ERROR: {{ session('error') }}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger bg-dark border-danger text-danger rounded-0 mb-4">
                                    <ul class="mb-0 list-unstyled">
                                        @foreach($errors->all() as $error)
                                            <li><i class="fa-solid fa-circle-xmark me-2"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ url('register') }}">
                                @csrf
                                <div class="input-group-custom">
                                    <input type="text" name="name" class="form-control-custom" placeholder="OPERATOR_NAME" required autofocus>
                                    <i class="fa-solid fa-user"></i>
                                </div>

                                <div class="input-group-custom">
                                    <input type="email" name="email" class="form-control-custom" placeholder="SIGNAL_ADDR (EMAIL)" required>
                                    <i class="fa-solid fa-envelope"></i>
                                </div>

                                <div class="input-group-custom">
                                    <input type="password" name="password" class="form-control-custom" placeholder="ACCESS_KEY" required>
                                    <i class="fa-solid fa-lock"></i>
                                </div>

                                <div class="input-group-custom">
                                    <input type="password" name="password_confirmation" class="form-control-custom" placeholder="CONFIRM_ACCESS_KEY" required>
                                    <i class="fa-solid fa-shield-check"></i>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input custom-cyber-check" type="checkbox" id="terms" required>
                                        <label class="form-check-label small ms-2" for="terms" style="cursor: pointer;">
                                            I AGREE TO THE <a href="#" class="text-info text-decoration-none" style="text-shadow: 0 0 5px var(--neon-cyan);">EULA PROTOCOLS</a>
                                        </label>
                                    </div>
                                    <style>
                                        .custom-cyber-check {
                                            width: 20px;
                                            height: 20px;
                                            background-color: rgba(0, 0, 0, 0.5) !important;
                                            border: 2px solid var(--neon-purple) !important;
                                            border-radius: 0 !important;
                                            cursor: pointer;
                                            position: relative;
                                            appearance: none;
                                            -webkit-appearance: none;
                                        }
                                        .custom-cyber-check:checked {
                                            background-color: var(--neon-purple) !important;
                                            box-shadow: 0 0 10px var(--neon-purple);
                                        }
                                        .custom-cyber-check:checked::after {
                                            content: '\f00c';
                                            font-family: 'Font Awesome 6 Free';
                                            font-weight: 900;
                                            color: white;
                                            font-size: 12px;
                                            position: absolute;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, -50%);
                                        }
                                    </style>
                                </div>

                                <button type="submit" class="btn btn-register mb-3">
                                    EXECUTE REGISTRATION <i class="fa-solid fa-satellite-dish ms-2"></i>
                                </button>

                                <div class="login-link">
                                    IDENTIFIER ALREADY EXISTS? <a href="{{ url('login') }}">SYNC PROFILE</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection