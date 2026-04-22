@extends('layouts.main')

@push('title')
<title>Verify Identity - Vendomart</title>
@endpush

@section('content')
<style>
    .auth-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        background: radial-gradient(circle at 50% 50%, #0a1229 0%, #050811 100%);
        padding: 4rem 0;
    }

    .auth-card {
        background: var(--glass-bg, rgba(15, 23, 42, 0.8));
        border: 1px solid rgba(188, 19, 254, 0.3);
        border-radius: 10px;
        padding: 3rem;
        position: relative;
        backdrop-filter: blur(10px);
        box-shadow: 0 0 40px rgba(188, 19, 254, 0.1);
    }

    .auth-title {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-cyan, #00f2ff);
        letter-spacing: 2px;
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-input {
        background: rgba(0, 0, 0, 0.5) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: white !important;
        padding: 12px 20px !important;
        border-radius: 0 !important;
        font-family: 'Inter', sans-serif;
        text-align: center;
        letter-spacing: 5px;
        font-size: 1.5rem;
    }

    .auth-input:focus {
        border-color: var(--neon-purple, #bc13fe) !important;
        box-shadow: 0 0 15px rgba(188, 19, 254, 0.3) !important;
    }

    .btn-auth-submit {
        background: var(--neon-purple, #bc13fe);
        color: white;
        font-family: 'Orbitron', sans-serif;
        font-weight: 800;
        width: 100%;
        padding: 15px;
        border-radius: 0;
        letter-spacing: 2px;
        border: none;
        transition: 0.3s;
        margin-top: 1.5rem;
    }

    .btn-auth-submit:hover {
        background: white;
        color: var(--neon-purple, #bc13fe);
        box-shadow: 0 0 20px var(--neon-purple, #bc13fe);
    }
</style>

<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card">
                    <h3 class="auth-title">IDENTIFIER_SYNC</h3>
                    <p class="text-secondary text-center small mb-4">Enter the 6-digit access code beamed to your secure comms channel.</p>
                    
                    @if(session('success'))
                        <div class="alert alert-success bg-dark text-cyan border-info mb-4" style="font-family: 'Orbitron', sans-serif; font-size: 0.8rem;">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger bg-dark text-danger border-danger mb-4" style="font-family: 'Orbitron', sans-serif; font-size: 0.8rem;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('otp.verify.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-secondary small orbitron">SECURITY_CODE</label>
                            <input type="text" class="form-control auth-input" name="otp" required maxlength="6" pattern="\d{6}" placeholder="------">
                            @error('otp')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-auth-submit">VERIFY_UPLINK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
