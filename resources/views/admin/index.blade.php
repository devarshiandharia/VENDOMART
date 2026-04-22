@extends('admin.includes.main')
@push('title')
<title>CORE_DASHBOARD - Admin</title>
@endpush

@section('content')
        
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center my-4">
                    <div class="me-3" style="width: 12px; height: 45px; background: var(--neon-purple); box-shadow: 0 0 15px var(--neon-purple);"></div>
                    <h1 class="mb-0 text-white">SYSTEM_STATUS</h1>
                </div>
                
                <div class="row g-4 mb-5">
                    <div class="col-xl-4 col-md-4">
                        <div class="card p-4 h-100" style="border-bottom: 3px solid #3b82f6;">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="text-secondary small">ORDERS_PROCESSED</h6>
                                <i class="fa-solid fa-cart-arrow-down text-info"></i>
                            </div>
                            <div class="mb-2">
                                <h2 class="text-white fw-bold">{{ $totalOrders }}</h2>
                            </div>
                            <div class="mt-auto">
                                <div class="progress" style="height: 4px; background: rgba(255,255,255,0.05);">
                                    <div class="progress-bar bg-info" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4">
                        <div class="card p-4 h-100" style="border-bottom: 3px solid var(--neon-cyan);">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="text-secondary small">NET_CREDITS_VALUE</h6>
                                <i class="fa-solid fa-microchip text-info-neon"></i>
                            </div>
                            <div class="mb-2">
                                <h2 class="text-info-neon fw-bold">₹ {{ number_format($totalSales, 0) }}</h2>
                            </div>
                            <div class="mt-auto">
                                <div class="progress" style="height: 4px; background: rgba(255,255,255,0.05);">
                                    <div class="progress-bar bg-cyan" style="width: 60%; background: var(--neon-cyan);"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4">
                        <div class="card p-4 h-100" style="border-bottom: 3px solid var(--neon-purple);">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="text-secondary small">ACTIVE_REPLICANTS</h6>
                                <i class="fa-solid fa-users-viewfinder text-purple-neon"></i>
                            </div>
                            <div class="mb-2">
                                <h2 class="text-white fw-bold">{{ $totalUsers }}</h2>
                            </div>
                            <div class="mt-auto">
                                <div class="progress" style="height: 4px; background: rgba(255,255,255,0.05);">
                                    <div class="progress-bar" style="width: 85%; background: var(--neon-purple);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="text-white mb-0">RECENT_COMM_LOGS</h4>
                                <a href="{{url('admin/orders')}}" class="btn btn-outline-info btn-sm rounded-0 px-3">FULL_SCAN</a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-dark table-hover mb-0">
                                    <thead style="font-family: 'Orbitron', sans-serif; font-size: 0.7rem;">
                                        <tr class="text-secondary">
                                            <th class="border-0">LOG_ID</th>
                                            <th class="border-0">CYCLE_DATE</th>
                                            <th class="border-0">REVENUE</th>
                                            <th class="border-0">PROTOCOL</th>
                                            <th class="border-0">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody class="small">
                                        @foreach($recentOrders as $order)
                                        <tr>
                                            <td class="text-info border-secondary">#{{ $order->id }}X</td>
                                            <td class="border-secondary text-secondary">{{ $order->created_at->format('d/m/Y') }}</td>
                                            <td class="border-secondary fw-bold text-white">₹ {{ number_format($order->total_amount, 0) }}</td>
                                            <td class="border-secondary">
                                                @php
                                                    $statusClass = '';
                                                    if($order->status == 'Pending') $statusClass = 'border-warning text-warning';
                                                    elseif($order->status == 'On the Way') $statusClass = 'border-info text-info';
                                                    else $statusClass = 'border-success text-success';
                                                @endphp
                                                <span class="badge rounded-0 border {{ $statusClass }} px-2 py-1" style="font-size: 0.6rem;">
                                                    {{ strtoupper($order->status) }}
                                                </span>
                                            </td>
                                            <td class="border-secondary">
                                                <a href="{{ url('admin/order-detail/'.$order->id) }}" class="btn btn-link text-info p-0 text-decoration-none small">OPEN_FILE</a>
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