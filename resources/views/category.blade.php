@extends('layouts.main')

@push('title')
    <title>{{ strtoupper($category->name) }} | Tactical Gear</title>
@endpush

@section('content')
<style>
    :root {
        --neon-cyan: #00f2ff;
        --neon-purple: #bc13fe;
        --deep-space: #050811;
        --glass-bg: rgba(15, 23, 42, 0.7);
    }

    .category-header {
        background: radial-gradient(circle at center, #101935 0%, #050811 100%);
        color: white;
        padding: 8rem 0;
        text-align: center;
        border-bottom: 1px solid rgba(0, 242, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .category-header::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
        opacity: 0.2;
    }

    .category-header i {
        font-size: 5rem;
        margin-bottom: 2rem;
        color: var(--neon-cyan);
        filter: drop-shadow(0 0 15px var(--neon-cyan));
    }

    .category-header h1 {
        font-family: 'Orbitron', sans-serif;
        text-transform: uppercase;
        letter-spacing: 8px;
        text-shadow: 0 0 20px rgba(0, 242, 255, 0.5);
    }

    .product-card {
        background: var(--glass-bg);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        transition: all 0.4s;
        backdrop-filter: blur(10px);
        overflow: hidden;
    }

    .product-card:hover {
        border-color: var(--neon-cyan);
        box-shadow: 0 0 30px rgba(0, 242, 255, 0.2);
        transform: translateY(-5px);
    }

    .product-image-wrapper {
        background: rgba(0,0,0,0.3);
        height: 250px;
        display: flex;
        align-items: center; justify-content: center;
        padding: 2rem;
        position: relative;
    }

    .product-image-wrapper img {
        max-height: 100%;
        max-width: 100%;
        filter: drop-shadow(0 0 10px rgba(255,255,255,0.1));
    }

    .price-neon {
        color: var(--neon-cyan);
        font-family: 'Orbitron', sans-serif;
        font-weight: 800;
        font-size: 1.4rem;
        text-shadow: 0 0 10px rgba(0, 242, 255, 0.3);
    }

    .btn-action-gear {
        background: transparent;
        border: 1px solid var(--neon-purple);
        color: var(--neon-purple);
        border-radius: 0;
        width: 45px; height: 45px;
        display: flex; align-items: center; justify-content: center;
        transition: 0.3s;
    }

    .btn-action-gear:hover {
        background: var(--neon-purple);
        color: white;
        box-shadow: 0 0 15px var(--neon-purple);
    }

    .empty-state {
        padding: 10rem 0;
        background: var(--glass-bg);
        border: 1px dashed var(--neon-purple);
        color: #94a3b8;
        font-family: 'Orbitron', sans-serif;
    }
</style>

<div class="category-header">
    <div class="container">
        <i class="fa-solid {{ $category->icon ?? 'fa-layer-group' }}"></i>
        <h1 class="display-4 fw-bold">{{ strtoupper($category->name) }}</h1>
        <p class="lead text-secondary mt-3" style="letter-spacing: 2px;">SCANNING DATA FOR: {{ strtoupper($category->slug) }}_MODULE</p>
    </div>
</div>

<section class="py-5 my-5">
    <div class="container">
        <div class="row g-4">
            @if($products->count() > 0)
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-card h-100">
                            <div class="product-image-wrapper">
                                <a href="{{ url('product/' . $product->slug) }}">
                                    <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                            <div class="card-body p-4">
                                <small class="text-secondary opacity-50 mb-1 d-block" style="letter-spacing: 1px;">IDENT: GEAR_{{ $product->id }}</small>
                                <h6 class="mb-3">
                                    <a href="{{ url('product/' . $product->slug) }}" class="text-white text-decoration-none fw-bold" style="letter-spacing: 1px;">
                                        {{ strtoupper($product->name) }}
                                    </a>
                                </h6>
                                <div class="d-flex justify-content-between align-items-end mt-4">
                                    <div>
                                        <p class="text-secondary small mb-0">CREDITS</p>
                                        <span class="price-neon">{{ number_format($product->price, 0) }}</span>
                                    </div>
                                    <a href="{{ url('product/' . $product->slug) }}" class="btn-action-gear"><i class="fa-solid fa-bolt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="empty-state text-center">
                        <i class="fa-solid fa-triangle-exclamation fa-3x mb-4 text-warning opacity-50"></i>
                        <h3>NO GEAR DETECTED AT THIS NODE</h3>
                        <p class="mt-3">Please recalibrate your search parameters.</p>
                        <a href="{{ url('/') }}" class="btn btn-gaming-cyan mt-4 px-5">RETURN TO BASE</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection