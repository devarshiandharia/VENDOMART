@extends('user.layouts.main')
@push('title')
<title>Order History</title>
@endpush

@section('content')
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 mt-4">

                        <div class="card p-4">
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="d-flex">
                                        <h4>Order History</h4>
                                        
                                    </div>
                                    <div class="mt-3">
                                        <style>
                                            #datatablesSimple th, #datatablesSimple td {
                                                color: white !important;
                                            }
                                            .dataTable-info, .dataTable-pagination a {
                                                color: white !important;
                                            }
                                        </style>
                                        <table id="datatablesSimple" class="text-white">
                                            <thead>
                                                <tr>
                                                <th scope="col">Order Id</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Payment</th>
                                                <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                <tr>
                                                <th scope="row">{{ $order->id }}</th>
                                                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                                <td>₹ {{ $order->total_amount }} ({{ $order->items->count() }} Products)</td>
                                                <td>
                                                    <span class="badge bg-secondary orbitron" style="font-size: 0.7rem;">
                                                        {{ strtoupper($order->payment_method) }}
                                                    </span>
                                                </td>
                                                <td>
                                                <span class="badge rounded-pill 
                                                    @if($order->status == 'Pending') text-bg-warning 
                                                    @elseif($order->status == 'On the Way') text-bg-info 
                                                    @else text-bg-success @endif">
                                                    {{ $order->status }}
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
@endsection
                