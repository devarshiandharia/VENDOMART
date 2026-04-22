@extends('layouts.main')

@push('title')
    <title>HQ_ACCESS | Secure Core</title>
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

    .admin-login-wrapper {
        background-color: var(--gaming-bg);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4rem 0;
        background-image: 
            linear-gradient(rgba(0, 242, 255, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 242, 255, 0.03) 1px, transparent 1px);
        background-size: 50px 50px;
    }

    .admin-login-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 242, 255, 0.2);
        border-radius: 0;
        box-shadow: 0 0 50px rgba(0, 242, 255, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 1000px;
        display: flex;
        position: relative;
    }

    .admin-login-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 2px;
        background: linear-gradient(to right, transparent, var(--neon-cyan), transparent);
        box-shadow: 0 0 15px var(--neon-cyan);
    }

    .admin-image-side {
        flex: 1;
        background: linear-gradient(135deg, #0f172a 0%, #050811 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem;
        color: white;
        text-align: center;
        border-right: 1px solid rgba(255,255,255,0.05);
    }

    .admin-image-side h3 {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-cyan);
        letter-spacing: 3px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .admin-form-side {
        flex: 1;
        padding: 4rem;
        background: transparent;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-header h2 {
        font-family: 'Orbitron', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        color: var(--neon-purple);
        text-transform: uppercase;
        letter-spacing: 4px;
        text-shadow: 0 0 10px rgba(188, 19, 254, 0.3);
    }

    .form-header p {
        color: #94a3b8;
        margin-bottom: 3rem;
        letter-spacing: 2px;
        font-size: 0.8rem;
    }

    .input-grp {
        position: relative;
        margin-bottom: 2rem;
    }

    .input-grp i {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--neon-cyan);
        filter: drop-shadow(0 0 5px var(--neon-cyan));
    }

    .admin-input {
        width: 100%;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 0;
        padding: 1.2rem 1.2rem 1.2rem 3.5rem;
        color: white;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .admin-input:focus {
        outline: none;
        border-color: var(--neon-purple);
        background: rgba(188, 19, 254, 0.05);
        box-shadow: 0 0 20px rgba(188, 19, 254, 0.2);
    }

    .btn-admin-login {
        background: transparent;
        border: 1px solid var(--neon-cyan);
        color: var(--neon-cyan);
        padding: 1.2rem;
        border-radius: 0;
        font-weight: 700;
        font-family: 'Orbitron', sans-serif;
        font-size: 1.1rem;
        width: 100%;
        margin-top: 1rem;
        cursor: pointer;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 3px;
    }

    .btn-admin-login:hover {
        background: var(--neon-cyan);
        color: #000;
        box-shadow: 0 0 30px var(--neon-cyan);
    }

    @media (max-width: 900px) {
        .admin-image-side {
            display: none;
        }
    }
</style>

<div class="admin-login-wrapper">
    <div class="admin-login-card mx-auto">
        <div class="admin-image-side">
            <div class="mb-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border: 2px solid var(--neon-purple); border-radius: 50%; color: var(--neon-purple); box-shadow: 0 0 20px var(--neon-purple);">
                <i class="fa-solid fa-tower-broadcast fa-2x"></i>
            </div>
            <h3>CORE_COMMAND</h3>
            <p class="opacity-75 small mt-3" style="letter-spacing: 1px;">CENTRAL_CONTROL_UNIT<br>STATUS: STANDBY</p>
        </div>
        <div class="admin-form-side">
            <div class="form-header">
                <h2>ADMIN_SYNC</h2>
                <p>INITIALIZE SECURE OVERRIDE</p>
            </div>

            @if(session('error'))
                <div class="alert alert-danger bg-dark border-danger text-danger rounded-0 mb-4 small">
                    <i class="fa-solid fa-skull-crossbones me-2"></i> ERROR: ACCESS_DENIED
                </div>
            @endif

            <form method="POST" action="{{ url('admin/login') }}">
                @csrf
                <div class="input-grp">
                    <input type="email" name="email" class="admin-input" placeholder="ADMIN_IDENTIFIER" required autofocus>
                    <i class="fa-solid fa-user-secret"></i>
                </div>

                <div class="input-grp">
                    <input type="password" name="password" class="admin-input" placeholder="PASS_PROTOCOL" required>
                    <i class="fa-solid fa-fingerprint"></i>
                </div>


                <button type="submit" class="btn-admin-login">
                    RUN_OVERRIDE <i class="fa-solid fa-power-off ms-2"></i>
                </button>
            </form>
            
        </div>
    </div>
</div>
@endsection