@extends('admin.includes.main')
@push('title')
<title>CORE_LOGS | Orders - VendoMart</title>
@endpush

@section('content')
<style>
    .table-gaming {
        color: #94a3b8 !important;
    }

    .table-gaming th {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-cyan) !important;
        background: rgba(15, 23, 42, 0.8) !important;
        border-bottom: 1px solid var(--neon-cyan) !important;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .table-gaming td {
        border-bottom: 1px solid rgba(255,255,255,0.05) !important;
        vertical-align: middle;
        padding: 1.2rem 0.5rem !important;
    }

    .btn-action {
        width: 35px; height: 35px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 0;
        background: transparent;
        border: 1px solid var(--neon-purple);
        color: var(--neon-purple);
        transition: 0.3s;
    }

    .btn-action:hover {
        background: var(--neon-purple);
        color: white;
        box-shadow: 0 0 15px var(--neon-purple);
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center my-4">
                <div class="me-3" style="width: 10px; height: 40px; background: var(--neon-cyan); box-shadow: 0 0 15px var(--neon-cyan);"></div>
                <h2 class="mb-0 text-white">ORDER_ARCHIVE</h2>
            </div>

            <div class="card p-4">
                <div class="table-responsive">
                    <table class="table table-gaming" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">ID_TOKEN</th>
                                <th scope="col">OPERATOR_ID</th>
                                <th scope="col">VAL_CREDITS</th>
                                <th scope="col">DESTINATION</th>
                                <th scope="col">NODE_TAX</th>
                                <th scope="col">METHOD</th>
                                <th scope="col">LOG_STATUS</th>
                                <th scope="col">ACCESS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="fw-bold text-info">#{{ $order->id }}X</td>
                                <td>
                                    @if($order->user)
                                        {{ $order->user->name }}
                                        @if($order->user->trashed())
                                            <span class="badge bg-danger ms-1" style="font-size: 0.5rem; vertical-align: middle;">DELETED</span>
                                        @endif
                                    @else
                                        <span class="text-secondary italic">Unknown User</span>
                                    @endif
                                </td>
                                <td class="text-white">₹ {{ number_format($order->total_amount, 0) }}</td>
                                <td>
                                    <div class="text-secondary small">{{ $order->city }}, {{ $order->state }}</div>
                                </td>
                                <td class="text-secondary small">₹ {{ number_format($order->total_amount * 0.1, 0) }}</td>
                                <td>
                                    <span class="badge border border-secondary text-secondary px-2 py-1" style="font-size: 0.6rem; font-family: 'Orbitron', sans-serif;">
                                        {{ strtoupper($order->payment_method) }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $statusClass = '';
                                        if($order->status == 'Pending') $statusClass = 'border-warning text-warning';
                                        elseif($order->status == 'On the Way') $statusClass = 'border-info text-info';
                                        else $statusClass = 'border-success text-success';
                                    @endphp
                                    <span class="badge rounded-0 border {{ $statusClass }} px-2 py-1" style="font-size: 0.6rem; font-family: 'Orbitron', sans-serif;">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ url('admin/order-detail/' . $order->id) }}" class="btn-action" title="VIEW_LOG">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.export.order.pdf', $order->id) }}" class="btn-action" style="border-color: var(--neon-cyan); color: var(--neon-cyan);" title="EXPORT_PDF">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection