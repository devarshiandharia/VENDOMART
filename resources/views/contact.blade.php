@extends('layouts.main')

@section('content')
<style>
    .contact-container {
        padding: 5rem 0;
        background: radial-gradient(circle at 50% 50%, #0a1229 0%, #050811 100%);
    }

    .form-glow {
        background: rgba(15, 23, 42, 0.8);
        border: 1px solid rgba(0, 242, 255, 0.2);
        padding: 3rem;
        position: relative;
        backdrop-filter: blur(15px);
    }

    .form-glow:hover {
        border-color: var(--neon-cyan);
        box-shadow: 0 0 30px rgba(0, 242, 255, 0.1);
    }

    .cyber-input {
        background: rgba(0, 0, 0, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #fff !important;
        border-radius: 0 !important;
        padding: 12px 20px !important;
        margin-bottom: 20px;
    }

    .cyber-input:focus {
        border-color: var(--neon-cyan) !important;
        box-shadow: 0 0 15px rgba(0, 242, 255, 0.2) !important;
    }

    .btn-transmit {
        background: var(--neon-cyan);
        color: #000;
        font-family: 'Orbitron', sans-serif;
        font-weight: 800;
        border-radius: 0;
        padding: 15px 40px;
        letter-spacing: 3px;
        transition: 0.3s;
        border: none;
        width: 100%;
    }

    .btn-transmit:hover {
        background: #fff;
        box-shadow: 0 0 30px var(--neon-cyan);
        transform: translateY(-2px);
    }

    .section-header {
        font-family: 'Orbitron', sans-serif;
        color: white;
        text-align: center;
        margin-bottom: 4rem;
    }

    .contact-info-item {
        background: rgba(0, 242, 255, 0.05);
        padding: 2rem;
        border-left: 3px solid var(--neon-cyan);
        margin-bottom: 1.5rem;
    }

    .contact-info-item i {
        font-size: 2rem;
        color: var(--neon-cyan);
        margin-bottom: 1rem;
    }
</style>

<div class="contact-container">
    <div class="container">
        <div class="section-header">
            <h1 style="letter-spacing: 10px; font-weight: 900;">DIRECT_COMMS</h1>
            <p class="text-secondary mt-3">ESTABLISHING SECURE UPLINK TO CORE COMMAND</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row g-5">
                    <div class="col-md-5">
                        <div class="contact-info-item">
                            <i class="fa-solid fa-satellite-dish"></i>
                            <h5 class="text-white orbitron">COMMS_FREQUENCY</h5>
                            <p class="text-secondary small">andhariadevarshi11@gmail.com</p>
                        </div>
                        <div class="contact-info-item">
                            <i class="fa-solid fa-location-crosshairs"></i>
                            <h5 class="text-white orbitron">NEXUS_COORDS</h5>
                            <p class="text-secondary small">Sector 7, Neo City, Global Node</p>
                        </div>
                        <div class="contact-info-item">
                            <i class="fa-solid fa-microchip"></i>
                            <h5 class="text-white orbitron">SYSTEM_STATUS</h5>
                            <p class="text-success small"><span class="status-pulse d-inline-block me-2"></span> OPERATIONAL</p>
                        </div>
                    </div>
                    
                    <div class="col-md-7">
                        <div class="form-glow">
                            @if(session('success'))
                                <div class="alert alert-success bg-dark text-cyan border-info mb-4" style="font-family: 'Orbitron', sans-serif; font-size: 0.8rem;">
                                    <i class="fa-solid fa-check-double me-2"></i> {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="text-secondary small mb-2 orbitron">IDENTIFIER</label>
                                        <input type="text" name="name" class="form-control cyber-input" placeholder="OPERATOR_NAME" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-secondary small mb-2 orbitron">SIGNAL_ADDR</label>
                                        <input type="email" name="email" class="form-control cyber-input" placeholder="ID@NODE.CYBER" required>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label class="text-secondary small mb-2 orbitron">SIGNAL_TYPE</label>
                                    <input type="text" name="subject" class="form-control cyber-input" placeholder="TRANSMISSION_SUBJECT" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label class="text-secondary small mb-2 orbitron">DATA_PAYLOAD</label>
                                    <textarea name="message" class="form-control cyber-input" rows="5" placeholder="ENTER_MESSAGE_HERE..." required></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-transmit">BEAM TRANSMISSION</button>
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
