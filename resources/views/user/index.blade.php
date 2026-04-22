@php
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('user.layouts.main')
@push('title')
    <title>SYNC_PROFILE - VendoMart</title>
@endpush

@section('content')
<style>
    .user-profile-img {
        width: 155px; height: 155px; 
        object-fit: cover; 
        border-radius: 20px; 
        border: 2px solid var(--neon-cyan);
        box-shadow: 0 0 20px rgba(0, 242, 255, 0.3);
        margin-bottom: 1.5rem;
    }
    
    .status-badge {
        font-size: 0.6rem;
        letter-spacing: 2px;
        color: var(--neon-cyan);
        border: 1px solid var(--neon-cyan);
        padding: 4px 10px;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .data-label {
        color: #64748b;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .data-value {
        color: white;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .table-gaming {
        color: #94a3b8 !important;
    }

    .table-gaming th {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-cyan) !important;
        background: rgba(15, 23, 42, 0.8) !important;
        border-bottom: 1px solid var(--neon-cyan) !important;
        font-size: 0.8rem;
    }

    .table-gaming td {
        border-bottom: 1px solid rgba(255,255,255,0.05) !important;
        vertical-align: middle;
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center my-5">
                <div class="me-3" style="width: 10px; height: 40px; background: var(--neon-cyan); box-shadow: 0 0 15px var(--neon-cyan);"></div>
                <h2 class="mb-0 text-info-neon">DASHBOARD_STATION</h2>
            </div>

            <div class="row g-4">
                <!-- Profile Identity -->
                <div class="col-xl-4 col-md-5">
                    <div class="card p-4 h-100 text-center">
                        <div class="status-badge">REPLICANT_DETECTED</div>
                        <div class="mb-3 d-flex justify-content-center">
                            @if(Auth::user()->photo)
                                <img src="{{ asset('uploads/profile/' . Auth::user()->photo) }}" class="user-profile-img">
                            @else
                                <div class="user-profile-img d-flex align-items-center justify-content-center bg-dark">
                                    <i class="fa-solid fa-user-gear fa-4x text-info"></i>
                                </div>
                            @endif
                        </div>
                        <h4 class="text-white mb-2">{{ Auth::user()->name }}</h4>
                        <p class="text-secondary small mb-0">[ RANK: ELITE_VENDOR ]</p>
                    </div>
                </div>

                <!-- Account Intel -->
                <div class="col-xl-8 col-md-7">
                    <div class="card p-4 h-100">
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="text-purple-neon">BIOMETRIC_DATA</h5>
                            <i class="fa-solid fa-dna text-secondary opacity-50"></i>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-sm-6 mb-4">
                                <div class="data-label">Identity ID</div>
                                <div class="data-value">#{{ Auth::user()->id }}BC_CORE</div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <div class="data-label">Comm Link</div>
                                <div class="data-value">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <div class="data-label">Deployment Date</div>
                                <div class="data-value">{{ Auth::user()->created_at->format('d.m.Y') }}</div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <div class="data-label">Security Protocol</div>
                                <div class="data-value text-info-neon">WPA3_ULTRA_ENCRYPT</div>
                            </div>
                        </div>

                        <div class="mt-auto d-flex gap-3">
                            <a href="{{url('user/settings')}}" class="btn-gaming text-decoration-none">UPDATE_IDENT</a>
                            <form action="{{ route('user.delete.request') }}" method="POST" onsubmit="return confirm('WARNING: THIS WILL PERMANENTLY ERASE YOUR PROFILE FROM THE MATRIX. PROCEED?');">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger px-4 py-2 rounded-0 small" style="font-family: 'Orbitron', sans-serif; letter-spacing: 2px; font-size: 0.7rem;">TERMINATE_ACCOUNT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Log -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="text-info-neon">TRANSACTION_LOGS</h5>
                            <a href="{{url('user/order-history')}}" class="btn-gaming btn-sm text-decoration-none">SCAN_HISTORY</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-gaming">
                                <thead>
                                    <tr>
                                        <th scope="col">LOG_ID</th>
                                        <th scope="col">CYCLE_DATE</th>
                                        <th scope="col">CREDITS</th>
                                        <th scope="col">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td class="fw-bold">#{{ $order->id }}X</td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td class="text-info-neon">{{ number_format($order->total_amount, 0) }}</td>
                                        <td>
                                            @php
                                                $badgeStyle = '';
                                                if($order->status == 'Pending') $badgeStyle = 'border: 1px solid #ffc107; color: #ffc107;';
                                                elseif($order->status == 'On the Way') $badgeStyle = 'border: 1px solid #0dcaf0; color: #0dcaf0;';
                                                else $badgeStyle = 'border: 1px solid #198754; color: #198754;';
                                            @endphp
                                            <span class="small px-2 py-1" style="{{ $badgeStyle }} font-family: 'Orbitron', sans-serif; font-size: 0.6rem;">
                                                {{ strtoupper($order->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection