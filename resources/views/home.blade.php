@extends('layouts.main')

@push('title')
    <title>ULTRA-GAMING | Future of Tech</title>
@endpush

@section('content')
<style>
    /* Futuristic CSS Variables */
    :root {
        --neon-cyan: #00f2ff;
        --neon-purple: #bc13fe;
        --deep-space: #050811;
        --glass-bg: rgba(15, 23, 42, 0.7);
    }

    body {
        background-color: var(--deep-space);
        overflow-x: hidden;
    }

    .section-title {
        font-family: 'Orbitron', sans-serif;
        color: white;
        text-transform: uppercase;
        letter-spacing: 4px;
        margin-bottom: 4rem;
        position: relative;
        text-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 0;
        width: 100px;
        height: 2px;
        background: linear-gradient(to right, var(--neon-cyan), transparent);
    }

    /* Category Cards - Gaming Style */
    .category-section {
        padding: 8rem 0;
        background: radial-gradient(circle at 50% 50%, #101935 0%, #050811 100%);
        border-top: 1px solid rgba(0, 242, 255, 0.1);
        border-bottom: 1px solid rgba(0, 242, 255, 0.1);
    }

    .category-card {
        background: var(--glass-bg);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        padding: 3rem 1.5rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .scan-line {
        position: absolute;
        width: 100%;
        height: 2px;
        background: rgba(0, 242, 255, 0.3);
        top: 0;
        left: 0;
        animation: scan 3s linear infinite;
        z-index: 2;
    }

    @keyframes scan {
        0% { top: 0; opacity: 0; }
        50% { opacity: 1; }
        100% { top: 100%; opacity: 0; }
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(45deg, transparent, rgba(0, 242, 255, 0.05), transparent);
        transform: translateX(-100%);
        transition: 0.6s;
    }

    .category-card:hover::before {
        transform: translateX(100%);
    }

    .category-card:hover {
        transform: translateY(-10px) scale(1.05);
        border-color: var(--neon-cyan);
        box-shadow: 0 0 30px rgba(0, 242, 255, 0.2);
    }

    .category-card i {
        font-size: 3.5rem;
        color: var(--neon-cyan);
        margin-bottom: 1.5rem;
        filter: drop-shadow(0 0 10px rgba(0, 242, 255, 0.4));
    }

    .category-card h6 {
        font-family: 'Orbitron', sans-serif;
        color: white;
        font-weight: 700;
        letter-spacing: 1px;
    }

    /* Product Cards - Futuristic Gear */
    .product-card {
        background: var(--glass-bg);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 24px;
        transition: all 0.4s;
        backdrop-filter: blur(10px);
    }

    .product-card:hover {
        border-color: var(--neon-purple);
        box-shadow: 0 0 30px rgba(188, 19, 254, 0.2);
        transform: translateY(-5px);
    }

    .product-image-wrapper {
        background: rgba(0,0,0,0.5);
        border-radius: 20px;
        margin: 10px;
        height: 200px; /* Fixed height for uniform grids */
        overflow: hidden;
        position: relative;
        border: 1px solid rgba(255,255,255,0.02);
    }

    .product-image-wrapper a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .product-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Fills container, cropping overflow to prevent squashing */
        transition: transform 0.5s ease, filter 0.5s ease;
        filter: brightness(0.8) contrast(1.1); /* Moodier default state */
    }

    .product-card:hover .product-image-wrapper img {
        transform: scale(1.1);
        filter: brightness(1) contrast(1.2);
    }


    .badge-gaming {
        background: linear-gradient(45deg, var(--neon-purple), var(--neon-cyan));
        color: white;
        padding: 5px 15px;
        border-radius: 50px;
        font-family: 'Orbitron', sans-serif;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
    }

    .price-neon {
        color: var(--neon-cyan);
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        font-size: 1.4rem;
        text-shadow: 0 0 10px rgba(0, 242, 255, 0.3);
    }

    .btn-buy-neon {
        width: 45px; height: 45px;
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
        box-shadow: 0 0 20px var(--neon-purple);
    }

    .hero-gaming {
        padding: 10rem 0;
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(188, 19, 254, 0.15) 0%, transparent 40%),
            radial-gradient(circle at 80% 70%, rgba(0, 242, 255, 0.15) 0%, transparent 40%);
        text-align: center;
    }

    .hero-gaming h1 {
        font-family: 'Orbitron', sans-serif;
        font-size: 5rem;
        font-weight: 900;
        background: linear-gradient(to right, #fff, var(--neon-cyan));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: 10px;
    }

    /* Enhanced Futuristic Card Components */
    .laptop-special {
        position: relative;
        transition: 0.5s;
        border: 2px solid rgba(0, 242, 255, 0.2) !important;
        background: linear-gradient(135deg, rgba(16, 25, 53, 0.9), rgba(5, 8, 17, 0.95)) !important;
    }

    .laptop-special:hover {
        border-color: var(--neon-cyan) !important;
        box-shadow: 0 0 40px rgba(0, 242, 255, 0.3) !important;
        transform: translateY(-8px) scale(1.02);
    }

    .corner-tag {
        position: absolute;
        width: 15px; height: 15px;
        border-color: var(--neon-cyan);
        border-style: solid;
        pointer-events: none;
    }
    .ct-tl { top: 0; left: 0; border-width: 2px 0 0 2px; }
    .ct-tr { top: 0; right: 0; border-width: 2px 2px 0 0; }
    .ct-bl { bottom: 0; left: 0; border-width: 0 0 2px 2px; }
    .ct-br { bottom: 0; right: 0; border-width: 0 2px 2px 0; }

    .system-status-bar {
        position: absolute;
        top: 10px; right: 10px;
        display: flex; align-items: center;
        gap: 5px; font-size: 0.5rem;
        color: var(--neon-cyan);
        letter-spacing: 1px;
    }
    
    .status-pulse {
        width: 6px; height: 6px;
        background: #00ff00;
        border-radius: 50%;
        box-shadow: 0 0 10px #00ff00;
        animation: pulse 1.5s infinite;
    }

    .data-stream {
        height: 2px;
        background: var(--neon-cyan);
        width: 0%;
        position: absolute;
        bottom: 0; left: 0;
        transition: 0.5s;
    }
    .laptop-special:hover .data-stream {
        width: 100%;
        box-shadow: 0 0 10px var(--neon-cyan);
    }

    .laptop-icon-wrap {
        position: relative;
        padding: 20px;
        background: rgba(0, 242, 255, 0.03);
        border-radius: 50%;
        display: inline-block;
        margin-bottom: 20px;
    }

    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.3; }
        100% { opacity: 1; }
    }

    /* CPU Special Design */
    .cpu-special {
        position: relative;
        transition: 0.5s;
        border: 2px solid rgba(255, 123, 0, 0.2) !important;
        background: linear-gradient(135deg, rgba(53, 30, 16, 0.9), rgba(17, 8, 5, 0.95)) !important;
        border-radius: 12px;
        margin-top: -10px;
        overflow: hidden;
    }

    .cpu-special:hover {
        border-color: #ff7b00 !important;
        box-shadow: 0 0 40px rgba(255, 123, 0, 0.3) !important;
        transform: translateY(-8px) scale(1.02);
    }

    .cpu-tag {
        position: absolute;
        width: 15px; height: 15px;
        border-color: #ff7b00;
        border-style: solid;
        pointer-events: none;
    }

    .clock-speed-meter {
        width: 40px; height: 40px;
        border: 2px solid rgba(255, 123, 0, 0.2);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 15px;
        position: relative;
    }

    .clock-speed-meter::after {
        content: '';
        position: absolute;
        width: 2px; height: 15px;
        background: #ff7b00;
        top: 5px; transform-origin: bottom;
        animation: rotate-needle 2s infinite linear;
    }

    @keyframes rotate-needle {
        0% { transform: rotate(-45deg); }
        50% { transform: rotate(180deg); }
        100% { transform: rotate(-45deg); }
    }

    .text-orange-neon {
        color: #ff7b00 !important;
        text-shadow: 0 0 10px rgba(255, 123, 0, 0.5);
    }

    /* Generic Gear Special Design */
    .gear-special {
        --gear-color: #bc13fe;
        --gear-color-rgb: 188, 19, 254;
        position: relative;
        transition: 0.5s;
        border: 2px solid rgba(var(--gear-color-rgb), 0.2) !important;
        background: linear-gradient(135deg, rgba(25, 10, 35, 0.9), rgba(10, 5, 15, 0.95)) !important;
        border-radius: 12px;
        margin-top: -10px;
        overflow: hidden;
    }

    .gear-special:hover {
        border-color: var(--gear-color) !important;
        box-shadow: 0 0 40px rgba(var(--gear-color-rgb), 0.3) !important;
        transform: translateY(-8px) scale(1.02);
    }

    .gear-tag {
        position: absolute;
        width: 15px; height: 15px;
        border-color: var(--gear-color);
        border-style: solid;
        pointer-events: none;
    }
    
    .gear-special:hover .data-stream {
        width: 100%;
        box-shadow: 0 0 10px var(--gear-color);
    }

</style>

<!-- Hero Section -->
<section class="hero-gaming mb-5">
    <div class="container">
        <span class="badge-gaming mb-4">Phase 1: Deployment</span>
        <h1>EQUIP YOURSELF</h1>
        <p class="lead text-secondary mt-3 mb-5" style="letter-spacing: 2px;">Enter the next dimension of gaming performance.</p>
        <a href="#products" class="btn btn-gaming-cyan px-5 py-3 rounded-0">ACCESS DATA</a>
    </div>
</section>

<!-- Category Section -->
<section class="category-section">
    <div class="container">
        <h3 class="section-title">Class Selection</h3>
        <div class="row g-4 justify-content-center">
            @foreach($categories as $category)
            <div class="col-6 col-md-3">
                <a href="{{ url('category/' . $category->slug) }}" class="text-decoration-none">
                        @if(Str::contains(Str::lower($category->name), 'laptop'))
                            <div class="laptop-special p-3" style="border-radius: 12px; margin-top: -10px;">
                                <div class="ct-tl corner-tag"></div>
                                <div class="ct-tr corner-tag"></div>
                                <div class="ct-bl corner-tag"></div>
                                <div class="ct-br corner-tag"></div>
                                <div class="system-status-bar">
                                    <span class="status-pulse"></span> ONLINE
                                </div>
                                <div class="laptop-icon-wrap">
                                    <i class="fa-solid fa-laptop-code fa-2x text-info-neon"></i>
                                </div>
                                <h6 class="orbitron text-white mb-1" style="font-size: 0.9rem;">{{ $category->name }}</h6>
                                <div class="mt-2 text-info-neon fw-bold mb-2" style="font-size: 0.55rem; letter-spacing: 2px;">
                                    [ MOBILE_WAR_STATION ]
                                </div>
                                <div class="progress mb-2" style="height: 3px; background: rgba(255,255,255,0.05);">
                                    <div class="progress-bar" style="width: 88%; background: var(--neon-cyan); box-shadow: 0 0 10px var(--neon-cyan);"></div>
                                </div>
                                <div class="d-flex justify-content-between small opacity-75" style="font-size: 0.5rem; letter-spacing: 1px;">
                                    <span>CORE: ACTIVE</span>
                                    <span>TEMP: 42°C</span>
                                </div>
                                <div class="data-stream"></div>
                            </div>
                        @elseif(Str::contains(Str::lower($category->name), 'cpu') || Str::contains(Str::lower($category->name), 'processor'))
                            <div class="cpu-special p-3">
                                <div class="ct-tl cpu-tag"></div>
                                <div class="ct-tr cpu-tag"></div>
                                <div class="ct-bl cpu-tag"></div>
                                <div class="ct-br cpu-tag"></div>
                                <div class="system-status-bar text-orange-neon">
                                    <span class="status-pulse" style="background: #ff7b00; box-shadow: 0 0 10px #ff7b00;"></span> OVERCLOCKED
                                </div>
                                <div class="clock-speed-meter mt-3">
                                    <i class="fa-solid fa-microchip text-orange-neon"></i>
                                </div>
                                <h6 class="orbitron text-white mb-1" style="font-size: 0.9rem;">{{ $category->name }}</h6>
                                <div class="mt-2 text-orange-neon fw-bold mb-2" style="font-size: 0.55rem; letter-spacing: 2px;">
                                    [ SYNAPTIC_ENGINE ]
                                </div>
                                <div class="progress mb-2" style="height: 3px; background: rgba(255,123,0,0.1);">
                                    <div class="progress-bar" style="width: 95%; background: #ff7b00; box-shadow: 0 0 10px #ff7b00;"></div>
                                </div>
                                <div class="d-flex justify-content-between small opacity-75" style="font-size: 0.5rem; letter-spacing: 1px; color: #ff7b00;">
                                    <span>KHZ: 5.4 GHZ</span>
                                    <span>LOAD: 12%</span>
                                </div>
                                <div class="data-stream" style="background: #ff7b00;"></div>
                            </div>
                        @else
                            @php
                                $colorList = [
                                    ['hex' => '#bc13fe', 'rgb' => '188, 19, 254'], // Purple
                                    ['hex' => '#00ff00', 'rgb' => '0, 255, 0'],    // Green
                                    ['hex' => '#ffea00', 'rgb' => '255, 234, 0'],  // Yellow
                                    ['hex' => '#ff007f', 'rgb' => '255, 0, 127'],  // Pink
                                    ['hex' => '#ff003c', 'rgb' => '255, 0, 60'],   // Red
                                ];
                                $c = $colorList[$loop->index % count($colorList)];
                            @endphp
                            <div class="gear-special p-3 text-center" style="--gear-color: {{ $c['hex'] }}; --gear-color-rgb: {{ $c['rgb'] }}; text-align: left !important;">
                                <div class="ct-tl gear-tag"></div>
                                <div class="ct-tr gear-tag"></div>
                                <div class="ct-bl gear-tag"></div>
                                <div class="ct-br gear-tag"></div>
                                <div class="system-status-bar" style="color: var(--gear-color);">
                                    <span class="status-pulse" style="background: var(--gear-color); box-shadow: 0 0 10px var(--gear-color);"></span> STANDBY
                                </div>
                                <div class="laptop-icon-wrap" style="background: rgba(var(--gear-color-rgb), 0.03);">
                                    <i class="fa-solid {{ $category->icon ?? 'fa-layer-group' }} fa-2x" style="color: var(--gear-color); text-shadow: 0 0 10px rgba(var(--gear-color-rgb), 0.5);"></i>
                                </div>
                                <h6 class="orbitron text-white mb-1" style="font-size: 0.9rem;">{{ $category->name }}</h6>
                                <div class="mt-2 fw-bold mb-2" style="font-size: 0.55rem; letter-spacing: 2px; color: var(--gear-color);">
                                    @if(Str::contains(Str::lower($category->name), 'phone'))
                                        [ NEURAL_LINK ]
                                    @else
                                        [ SYS_COMPONENT ]
                                    @endif
                                </div>
                                <div class="progress mb-2" style="height: 3px; background: rgba(var(--gear-color-rgb), 0.1);">
                                    <div class="progress-bar" style="width: 75%; background: var(--gear-color); box-shadow: 0 0 10px var(--gear-color);"></div>
                                </div>
                                <div class="d-flex justify-content-between small opacity-75" style="font-size: 0.5rem; letter-spacing: 1px; color: var(--gear-color);">
                                    <span>PWR: OPTIMAL</span>
                                    <span>SYNC: 100%</span>
                                </div>
                                <div class="data-stream" style="background: var(--gear-color);"></div>
                            </div>
                        @endif
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Product Section -->
<section id="products" class="py-5 my-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h3 class="section-title mb-0">Epic Loot</h3>
            <a href="#" class="text-decoration-none text-info small" style="letter-spacing: 2px;">SCAN ALL <i class="fa-solid fa-chevron-right ms-2"></i></a>
        </div>
        
        <div class="row g-4">
            @if($products->count() > 0)
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-card h-100 p-2">
                            <div class="product-image-wrapper mb-3">
                                <a href="{{ url('product/' . $product->slug) }}">
                                    <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="badge-gaming">Mythic</span>
                                    <small class="text-secondary">#{{$product->id}}</small>
                                </div>
                                <h6 class="mb-2 text-white fw-bold">
                                    <a href="{{ url('product/' . $product->slug) }}" class="text-white text-decoration-none hover-cyan">
                                        {{ Str::limit($product->name, 25) }}
                                    </a>
                                </h6>
                                
                                <!-- Added Details -->
                                <p class="text-secondary mb-3" style="font-size: 0.75rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.4;">
                                    {{ $product->description }}
                                </p>
                                
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span class="badge bg-dark border border-secondary text-info-neon px-2 py-1" style="font-size: 0.6rem; letter-spacing: 1px;"><i class="fa-solid fa-microchip me-1"></i>CLASS: {{ \App\Models\Category::find($product->category_id)?->name ?? 'GEAR' }}</span>
                                    <span class="badge bg-dark border border-secondary text-warning px-2 py-1" style="font-size: 0.6rem;"><i class="fa-solid fa-star me-1"></i>5.0</span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-end mt-2 pt-3 border-top border-secondary border-opacity-25">
                                    <div>
                                        <p class="text-secondary small mb-0 font-monospace" style="font-size: 0.65rem; letter-spacing: 1px;">REQ. CREDITS</p>
                                        <span class="price-neon">{{ number_format($product->price, 0) }}</span>
                                    </div>
                                    <a href="{{ url('product/' . $product->slug) }}" class="btn-buy-neon"><i class="fa-solid fa-bolt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="spinner-border text-info" role="status"></div>
                    <h4 class="text-secondary mt-4">SEARCHING FOR GEAR...</h4>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection