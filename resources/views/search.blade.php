@extends('layouts.main')

@push('title')
    <title>SCAN_RESULTS: {{ strtoupper($query) }} | VendoMart</title>
@endpush

@section('content')
<style>
    :root {
        --neon-cyan: #00f2ff;
        --neon-purple: #bc13fe;
        --deep-space: #050811;
        --glass-bg: rgba(15, 23, 42, 0.7);
    }

    .search-header {
        background: radial-gradient(circle at center, #101935 0%, #050811 100%);
        color: white;
        padding: 6rem 0;
        text-align: center;
        border-bottom: 2px solid var(--neon-purple);
        position: relative;
    }

    .search-header h1 {
        font-family: 'Orbitron', sans-serif;
        text-transform: uppercase;
        letter-spacing: 5px;
        text-shadow: 0 0 15px rgba(188, 19, 254, 0.5);
    }

    .product-card {
        background: var(--glass-bg);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        transition: all 0.4s;
        backdrop-filter: blur(10px);
        overflow: hidden;
    }

    .product-card:hover {
        border-color: var(--neon-cyan);
        box-shadow: 0 0 30px rgba(0, 242, 255, 0.1);
        transform: translateY(-5px);
    }

    .product-image-wrapper {
        background: rgba(0,0,0,0.3);
        height: 220px;
        display: flex;
        align-items: center; justify-content: center;
        padding: 1.5rem;
    }

    .product-image-wrapper img {
        max-height: 100%;
        max-width: 100%;
    }

    .price-neon {
        color: var(--neon-cyan);
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
    }

    .btn-buy-neon {
        width: 40px; height: 40px;
        border-radius: 50%;
        background: transparent;
        border: 1px solid var(--neon-purple);
        color: var(--neon-purple);
        display: flex; align-items: center; justify-content: center;
        transition: 0.3s;
    }

    .btn-buy-neon:hover {
        background: var(--neon-purple);
        color: white;
        box-shadow: 0 0 15px var(--neon-purple);
    }
</style>

<div class="search-header">
    <div class="container">
        <h1 class="mb-3">SYSTEM_SCAN: RESULTS</h1>
        <p class="lead text-secondary" style="letter-spacing: 2px;">QUERY_PARAM: <span class="text-info">"{{ strtoupper($query) }}"</span></p>
    </div>
</div>

<section class="py-5 my-5">
    <div class="container">
        <div class="row g-4">
            @if($products->count() > 0)
                <div class="col-12 mb-4">
                    <p class="text-secondary small" style="letter-spacing: 1px;">FOUND {{ $products->count() }} MATCHING_MODULE(S) IN DATABASE</p>
                </div>
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-card h-100">
                            <div class="product-image-wrapper">
                                <a href="{{ url('product/' . $product->slug) }}">
                                    <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                            <div class="card-body p-4">
                                <small class="text-secondary opacity-50 mb-1 d-block">GEAR_ID: #{{ $product->id }}</small>
                                <h6 class="mb-3 text-white fw-bold">
                                    <a href="{{ url('product/' . $product->slug) }}" class="text-white text-decoration-none">
                                        {{ strtoupper($product->name) }}
                                    </a>
                                </h6>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <span class="price-neon">₹ {{ number_format($product->price, 0) }}</span>
                                    <a href="{{ url('product/' . $product->slug) }}" class="btn-buy-neon"><i class="fa-solid fa-bolt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="p-5" style="border: 1px dashed rgba(255,255,255,0.1);">
                        <i class="fa-solid fa-triangle-exclamation fa-3x mb-4 text-warning opacity-50"></i>
                        <h3 class="text-white mb-3" style="font-family: 'Orbitron', sans-serif;">ZERO_RESULTS_RETURNED</h3>
                        <p class="text-secondary lead">NO GEAR MATCHING <span class="text-info">"{{ $query }}"</span> FOUND IN LOCAL_STORAGE</p>
                        <a href="{{ url('/') }}" class="btn btn-gaming-cyan mt-4 px-5 px-5">RETRY_SCAN</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
