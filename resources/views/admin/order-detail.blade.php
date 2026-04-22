@extends('admin.includes.main')
@push('title')
<title>Order Detail</title>
@endpush

@section('content')
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-5">
                        <div class="row my-4">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <h6 class="text-secondary mb-0"><i class="fas fa-microchip me-2"></i>LOG_SEQUENCE: {{ $order->created_at->format('Ymd') }}-{{ $order->id }}</h6>
                                <a href="{{ route('admin.export.order.pdf', $order->id) }}" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-file-pdf me-2"></i>DOWNLOAD_ENCRYPTED_PDF
                                </a>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-xl-6 col-md-6 mt-3 border border-primary p-4 card">
                                
                                    <h5 class="text-info-neon mb-4"><i class="fas fa-user-tag me-2"></i>Customer Information</h5>
                                    <div class="mb-2"><span class="text-secondary">NAME:</span> <span class="text-light ms-2">{{ $order->user->name }}</span></div>
                                    <div class="mb-2"><span class="text-secondary">EMAIL:</span> <span class="text-light ms-2">{{ $order->user->email }}</span></div>
                                    <div class="mb-2"><span class="text-secondary">PHONE:</span> <span class="text-light ms-2">{{ $order->phone }}</span></div>
                                    <div class="mb-2"><span class="text-secondary">SHIPPING_NODE:</span> <span class="text-light ms-2">{{ $order->address }}, {{ $order->city }}, {{ $order->state }} - {{ $order->zip_code }}</span></div>
                                
                            </div>

                            <div class="col-xl-6 col-md-6 mt-3 border border-primary p-4 card">
                                
                                    <h5 class="text-info-neon mb-4"><i class="fas fa-file-invoice me-2"></i>Order Summary</h5>
                                    <div class="mb-2"><span class="text-secondary">ORDER_ID:</span> <span class="text-light ms-2">#{{ $order->id }}</span></div>
                                    <div class="mb-2"><span class="text-secondary">PAYMENT_METHOD:</span> <span class="text-light ms-2">{{ $order->payment_method == 'card' ? 'Payment by Card' : 'Cash on Delivery' }}</span></div>
                                    <div class="mb-2"><span class="text-secondary">PAYMENT_STATUS:</span> 
                                        @if($order->payment_method == 'card')
                                            <span class="badge text-bg-success ms-2">SUCCESS</span>
                                        @else
                                            @if($order->status == 'Delivered')
                                                <span class="badge text-bg-success ms-2">PAID</span>
                                            @else
                                                <span class="badge text-bg-warning ms-2">PENDING</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="mb-2"><span class="text-secondary">ORDER_STATUS:</span> <span class="badge text-bg-info ms-2">{{ strtoupper($order->status) }}</span></div>
                                    <div class="mb-2 border-top border-secondary pt-2 mt-2"><span class="text-secondary">SUBTOTAL:</span> <span class="text-light ms-2">₹ {{ number_format($order->total_amount, 2) }}</span></div>
                                    
                                    <h4 class="text-info-neon mt-3">TOTAL_DEBT: ₹ {{ number_format($order->total_amount, 2) }}</h4>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="position-relative m-4">
                                    @php
                                        $stages = ['Pending', 'Processing', 'On the Way', 'Delivered'];
                                        $currentPos = array_search($order->status, $stages);
                                        $width = ($currentPos / (count($stages) - 1)) * 100;
                                    @endphp
                                    <div class="progress" role="progressbar" aria-label="Progress" style="height: 5px;">
                                        <div class="progress-bar" style="width: {{ $width }}%"></div>
                                    </div>
                                    <button type="button" class="position-absolute top-0 translate-middle btn btn-sm {{ $currentPos >= 0 ? 'btn-primary' : 'btn-secondary' }} rounded-pill" style="left: 0%; width: 2rem; height: 2rem;">1</button>
                                    <button type="button" class="position-absolute top-0 translate-middle btn btn-sm {{ $currentPos >= 1 ? 'btn-primary' : 'btn-secondary' }} rounded-pill" style="left: 33.3%; width: 2rem; height: 2rem;">2</button>
                                    <button type="button" class="position-absolute top-0 translate-middle btn btn-sm {{ $currentPos >= 2 ? 'btn-primary' : 'btn-secondary' }} rounded-pill" style="left: 66.6%; width: 2rem; height: 2rem;">3</button>
                                    <button type="button" class="position-absolute top-0 translate-middle btn btn-sm {{ $currentPos >= 3 ? 'btn-primary' : 'btn-secondary' }} rounded-pill" style="left: 100%; transform: translateX(-50%); width: 2rem; height: 2rem;">4</button>
                                </div>

                            </div>

                           <div class="col-xl-12 col-md-12">
                                <div class="d-flex text-center">
                                    <div class="flex-fill">Pending</div>
                                    <div class="flex-fill">Processing</div>
                                    <div class="flex-fill">On the Way</div>
                                    <div class="flex-fill">Delivered</div>
                                </div>
                           </div>

                           <div class="col-12 mt-4 text-center">
                                @if($order->status != 'Delivered')
                                    <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Move to Next Stage</button>
                                    </form>
                                @else
                                    <div class="alert alert-success d-inline-block">Order Successfully Delivered!</div>
                                @endif
                           </div>
                        </div>

                        <div class="row my-5">
                            <div class="col-lg-12">
                            <table class="table table-bordered text-light">
                                <thead class="border-secondary">
                                    <tr>
                                    <th scope="col" class="text-secondary">CORE_MODULE</th>
                                    <th scope="col" class="text-secondary">UNIT_PRICE</th>
                                    <th scope="col" class="text-secondary">QUANTITY</th>
                                    <th scope="col" class="text-secondary">SUBTOTAL</th>
                                    </tr>
                                </thead>
                                <tbody class="border-secondary">
                                    @foreach($order->items as $item)
                                    <tr class="align-middle">
                                    <th>
                                        <div class="d-flex align-items-center">
                                            <div class="border border-info p-1 rounded">
                                                <img src="{{ asset('products/' . $item->product->image) }}" style="width:70px;" class="rounded-3">
                                            </div>
                                            <div class="ms-3"><h6 class="text-info-neon mb-0">{{ $item->product->name }}</h6></div>
                                        </div>
                                    </th>
                                    <td>₹ {{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="text-info-neon">₹ {{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                
                            </div>
                        
                        </div>
                    </div>
                </main>
            
                

@endsection
                