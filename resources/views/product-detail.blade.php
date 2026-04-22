@php
    use Illuminate\Support\Facades\Auth;
@endphp
@php
    $isAdmin = Auth::check() && Auth::user()->email === 'admin@gmail.com';
@endphp

@extends('layouts.main')

@push('title')
    <title>{{ $product->name }} | VENDOMART</title>
@endpush

@section('content')
    <style>
        .product-hero {
            background: radial-gradient(circle at 50% 50%, rgba(0, 242, 255, 0.05) 0%, rgba(5, 8, 17, 1) 70%);
            padding: 80px 0;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 242, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .product-img-container {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(0, 242, 255, 0.2);
            box-shadow: 0 0 30px rgba(0, 242, 255, 0.1);
            transition: all 0.5s ease;
        }

        .product-img-container:hover {
            border-color: var(--neon-cyan);
            box-shadow: 0 0 50px rgba(0, 242, 255, 0.2);
            transform: scale(1.02);
        }

        .product-name {
            font-family: 'Orbitron', sans-serif;
            font-weight: 800;
            letter-spacing: 2px;
            background: linear-gradient(to right, #fff, var(--neon-cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .product-price {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            color: var(--neon-pink);
            text-shadow: 0 0 15px rgba(255, 0, 255, 0.3);
            margin-bottom: 30px;
        }

        .feature-badge {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px 15px;
            border-radius: 12px;
            font-size: 0.9rem;
            color: #94a3b8;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .feature-badge i {
            color: var(--neon-cyan);
        }

        .description-box {
            color: #94a3b8;
            line-height: 1.8;
            font-size: 1.1rem;
            margin: 30px 0;
            border-left: 3px solid var(--neon-purple);
            padding-left: 20px;
        }

        .btn-add-cart {
            background: linear-gradient(45deg, var(--neon-cyan), var(--neon-purple));
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 12px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-add-cart:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 242, 255, 0.3);
            color: white;
        }

        .btn-add-cart::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
            transition: 0.5s;
        }

        .btn-add-cart:hover::after {
            left: 120%;
        }
    </style>

    <div class="product-hero">
        <div class="container">
            <div class="glass-card">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="product-img-container">
                            <img src="{{ asset('products/' . $product->image) }}" class="img-fluid w-100" alt="{{ $product->name }}">
                        </div>
                    </div>
                    <div class="col-lg-6 ps-lg-5">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb" style="font-size: 0.8rem;">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-info text-decoration-none">BASE</a></li>
                                <li class="breadcrumb-item active text-secondary" aria-current="page">GEAR</li>
                            </ol>
                        </nav>
                        
                        <h1 class="product-name display-4">{{ $product->name }}</h1>
                        
                        <div class="product-price">
                            ₹ {{ number_format($product->price, 2) }}
                        </div>

                        <div class="features-list">
                            <div class="feature-badge"><i class="fa-solid fa-bolt"></i> WARP SHIPPING</div>
                            <div class="feature-badge"><i class="fa-solid fa-shield-halved"></i> ENCRYPTED PAY</div>
                            <div class="feature-badge"><i class="fa-solid fa-rotate-left"></i> RETRO-LINK</div>
                            <div class="feature-badge"><i class="fa-solid fa-headset"></i> CORE SUPPORT</div>
                        </div>

                        <div class="description-box">
                            {{ $product->description }}
                        </div>

                        @if(!$isAdmin)
                            <div class="d-flex align-items-center gap-4 mt-5">
                                <form action="{{ url('add-to-cart/' . $product->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-add-cart">
                                        <i class="fa-solid fa-cart-plus me-2"></i> Sync to Inventory
                                    </button>
                                </form>
                                <button class="btn btn-outline-secondary rounded-circle" style="width: 50px; height: 50px;">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </div>
                        @else
                            <div class="mt-5">
                                <a href="{{ url('admin/edit-product/' . $product->id) }}" class="btn btn-gaming-cyan px-5 py-3 rounded-pill">
                                    <i class="fa-solid fa-pen-to-square me-2"></i> Modify Specs
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection