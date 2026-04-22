@extends('layouts.main')

@push('title')
    <title>INVENTORY_SYNC | VendoMart</title>
@endpush

@section('content')
<style>
    :root {
        --neon-cyan: #00f2ff;
        --neon-purple: #bc13fe;
        --glass-bg: rgba(15, 23, 42, 0.9);
        --input-bg: rgba(0, 0, 0, 0.4);
    }

    .inventory-container {
        padding: 5rem 0;
        min-height: 80vh;
        background: var(--gaming-bg) !important; /* Ensure dark background */
    }

    .inventory-card {
        background: var(--glass-bg);
        border: 1px solid rgba(0, 242, 255, 0.2);
        border-radius: 12px;
        backdrop-filter: blur(20px);
        padding: 3rem;
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
    }

    .inventory-title {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-cyan);
        letter-spacing: 4px;
        margin-bottom: 3rem;
        text-transform: uppercase;
        text-shadow: 0 0 10px rgba(0, 242, 255, 0.3);
    }

    .table-inventory {
        background: transparent !important;
        color: #e2e8f0 !important;
        border-collapse: separate;
        border-spacing: 0 15px;
    }

    .table-inventory thead th {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-purple) !important;
        background: transparent !important;
        border-bottom: 2px solid var(--neon-purple) !important;
        padding-bottom: 1.5rem !important;
        font-size: 0.85rem;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .table-inventory tbody tr {
        background: rgba(255, 255, 255, 0.03) !important;
        transition: all 0.3s ease;
    }

    .table-inventory tbody tr:hover {
        background: rgba(255, 255, 255, 0.07) !important;
        transform: scale(1.01);
    }

    .table-inventory td {
        background: transparent !important;
        border: none !important;
        padding: 1.5rem 1rem !important;
        vertical-align: middle;
        color: #e2e8f0 !important;
    }

    .item-img-frame {
        border: 1px solid rgba(0, 242, 255, 0.3);
        padding: 5px;
        background: rgba(0,0,0,0.5);
        width: 80px; height: 80px;
        object-fit: contain;
        border-radius: 8px;
    }

    .price-credits {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-cyan) !important;
        font-size: 1.1rem;
        text-shadow: 0 0 8px rgba(0, 242, 255, 0.2);
    }

    .total-cr-value {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-pink, #ff00ff) !important;
        font-weight: 700;
        text-shadow: 0 0 10px rgba(255, 0, 255, 0.3);
    }

    .quantity-input {
        background: var(--input-bg) !important;
        color: var(--neon-cyan) !important;
        border: 1px solid rgba(0, 242, 255, 0.3) !important;
        border-radius: 8px;
        font-family: 'Orbitron', sans-serif;
    }

    .quantity-input:focus {
        border-color: var(--neon-cyan) !important;
        box-shadow: 0 0 10px var(--neon-cyan) !important;
    }

    .total-banner {
        background: rgba(0, 242, 255, 0.05);
        border: 1px solid rgba(0, 242, 255, 0.2);
        border-left: 5px solid var(--neon-cyan);
        padding: 2.5rem;
        margin-top: 3rem;
        border-radius: 0 12px 12px 0;
    }

    .btn-checkout-gaming {
        background: linear-gradient(45deg, var(--neon-purple), #7e22ce);
        color: white !important;
        border: none;
        padding: 1.2rem 3.5rem;
        font-family: 'Orbitron', sans-serif;
        font-weight: 800;
        letter-spacing: 3px;
        transition: 0.3s;
        text-transform: uppercase;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .btn-checkout-gaming:hover {
        background: var(--neon-cyan);
        color: #000 !important;
        box-shadow: 0 0 30px var(--neon-cyan);
        transform: translateY(-2px);
    }

    .empty-inventory {
        text-align: center;
        padding: 8rem 0;
        border: 2px dashed rgba(255, 255, 255, 0.05);
        border-radius: 20px;
    }
</style>

<div class="inventory-container">
    <div class="container">
        <div class="d-flex align-items-center mb-5">
            <div class="me-3" style="width: 12px; height: 40px; background: var(--neon-cyan); box-shadow: 0 0 15px var(--neon-cyan);"></div>
            <h2 class="inventory-title mb-0">INVENTORY_SYNC</h2>
        </div>

        <div class="inventory-card">
            @if(session('cart') && count(session('cart')) > 0)
                <div class="table-responsive">
                    <table class="table table-inventory">
                        <thead>
                            <tr>
                                <th scope="col">GEAR_VISUAL</th>
                                <th scope="col">IDENT_NAME</th>
                                <th scope="col">UNIT_CR</th>
                                <th scope="col">QTY</th>
                                <th scope="col">TOTAL_CR</th>
                                <th scope="col">PURGE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach(session('cart') as $id => $item)
                                @php
                                    $total = $item['price'] * $item['quantity'];
                                    $grandTotal += $total;
                                @endphp
                                <tr>
                                    <td><img src="{{ asset('products/' . $item['image']) }}" class="item-img-frame" alt="{{ $item['name'] }}"></td>
                                    <td>
                                        <h6 class="mb-1 text-white fw-bold" style="letter-spacing: 1px;">{{ strtoupper($item['name']) }}</h6>
                                        <span class="badge bg-dark border border-secondary text-secondary">#UID_{{ substr($id, 0, 8) }}</span>
                                    </td>
                                    <td class="price-credits">₹{{ number_format($item['price'], 0) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control quantity-input text-center me-2" style="width: 80px;">
                                            <button type="submit" class="btn btn-sm btn-outline-info" style="font-family: 'Orbitron', sans-serif; font-size: 0.7rem;">SYNC</button>
                                        </form>
                                    </td>
                                    <td class="total-cr-value">₹{{ number_format($total, 0) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Confirm Gear Decommission?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; border-color: rgba(220, 38, 38, 0.5); transition: all 0.3s;">
                                                <i class="fa-solid fa-trash-can" style="font-size: 0.8rem;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <form action="{{ route('place.order') }}" method="POST" id="checkout-form">
                    @csrf
                    
                    <!-- Delivery Address Section -->
                    <div class="delivery-address-section mt-5 mb-4">
                        <h4 class="text-white orbitron mb-4" style="letter-spacing: 2px;">DELIVERY_ADDRESS</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-secondary small orbitron d-block mb-2">CONTACT_PHONE</label>
                                <input type="text" name="phone" class="form-control quantity-input w-100" placeholder="+91 XXXXX XXXXX" required>
                            </div>
                            <div class="col-md-6">
                                <label class="text-secondary small orbitron d-block mb-2">ZIP_CODE</label>
                                <input type="text" name="zip_code" class="form-control quantity-input w-100" placeholder="XXXXXX" required>
                            </div>
                            <div class="col-12">
                                <label class="text-secondary small orbitron d-block mb-2">STREET_ADDRESS</label>
                                <textarea name="address" class="form-control quantity-input w-100" rows="2" placeholder="Enter your full neural-link address" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="text-secondary small orbitron d-block mb-2">CITY_NODE</label>
                                <input type="text" name="city" class="form-control quantity-input w-100" placeholder="Neo City" required>
                            </div>
                            <div class="col-md-6">
                                <label class="text-secondary small orbitron d-block mb-2">STATE_REGION</label>
                                <input type="text" name="state" class="form-control quantity-input w-100" placeholder="Maharashtra" required>
                            </div>
                        </div>
                    </div>

                    <div class="payment-methods-section mt-5 mb-4">
                        <h4 class="text-white orbitron mb-4" style="letter-spacing: 2px;">PAYMENT_PROTOCOL</h4>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="payment-option-card" onclick="selectPayment('cod')">
                                    <input type="radio" name="payment_method" value="cod" id="payment_cod" class="d-none" checked>
                                    <div class="payment-card-inner" id="card_cod">
                                        <div class="d-flex align-items-center">
                                            <div class="method-icon me-3">
                                                <i class="fa-solid fa-hand-holding-dollar fa-2x"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-white">CASH_ON_DELIVERY</div>
                                                <small class="text-secondary">Settle credits upon physical arrival</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="payment-option-card" onclick="selectPayment('card')">
                                    <input type="radio" name="payment_method" value="card" id="payment_card" class="d-none">
                                    <div class="payment-card-inner" id="card_card">
                                        <div class="d-flex align-items-center">
                                            <div class="method-icon me-3">
                                                <i class="fa-solid fa-credit-card fa-2x"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-white">NEURAL_PAY_CARD</div>
                                                <small class="text-secondary">Secure encrypted uplink transaction</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Details Form (Hidden by default) -->
                        <div id="card-details-form" class="mt-4 p-4 border border-info rounded-3" style="display: none; background: rgba(0, 242, 255, 0.05);">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="text-secondary small orbitron d-block mb-2">CARD_IDENTIFIER</label>
                                    <input type="text" name="card_number" class="form-control quantity-input w-100" placeholder="XXXX XXXX XXXX XXXX">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-secondary small orbitron d-block mb-2">EXPIRY_DATE</label>
                                    <input type="text" name="expiry" class="form-control quantity-input w-100" placeholder="MM/YY">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-secondary small orbitron d-block mb-2">SECURITY_CVV</label>
                                    <input type="password" name="cvv" class="form-control quantity-input w-100" placeholder="***">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="total-banner d-flex justify-content-between align-items-center flex-wrap gap-4">
                        <div>
                            <span class="text-secondary small d-block mb-1" style="letter-spacing: 2px;">AGGREGATE_VAL</span>
                            <h2 class="text-white mb-0" style="font-family: 'Orbitron', sans-serif; font-weight: 800;">
                                <span style="color: var(--neon-cyan);">₹</span> {{ number_format($grandTotal, 0) }} <span class="small text-secondary" style="font-size: 1rem;">CREDITS</span>
                            </h2>
                        </div>
                        <button type="submit" class="btn btn-checkout-gaming">
                            <i class="fa-solid fa-bolt me-2"></i> FINALIZE_TRANSACTION
                        </button>
                    </div>
                </form>
<script>
function selectPayment(method) {
    document.getElementById('payment_' + method).checked = true;
    
    // Update UI
    document.getElementById('card_cod').classList.remove('active-payment');
    document.getElementById('card_card').classList.remove('active-payment');
    document.getElementById('card_' + method).classList.add('active-payment');
    
    // Show/Hide card form
    const cardForm = document.getElementById('card-details-form');
    if (method === 'card') {
        cardForm.style.display = 'block';
        cardForm.querySelectorAll('input').forEach(i => i.required = true);
    } else {
        cardForm.style.display = 'none';
        cardForm.querySelectorAll('input').forEach(i => i.required = false);
    }
}

// Initial state
document.addEventListener('DOMContentLoaded', () => {
    selectPayment('cod');
});
</script>
<style>
.payment-card-inner {
    padding: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s;
    background: rgba(255, 255, 255, 0.02);
}
.payment-card-inner:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: var(--neon-cyan);
}
.active-payment {
    border-color: var(--neon-cyan) !important;
    background: rgba(0, 242, 255, 0.1) !important;
    box-shadow: 0 0 15px rgba(0, 242, 255, 0.2);
}
.method-icon {
    color: var(--neon-cyan);
}
.orbitron {
    font-family: 'Orbitron', sans-serif;
}
</style>
            @else
                <div class="empty-inventory">
                    <div class="mb-4">
                        <i class="fa-solid fa-box-open fa-5x text-secondary opacity-25"></i>
                    </div>
                    <h3 class="text-secondary" style="font-family: 'Orbitron', sans-serif; letter-spacing: 3px;">NO GEAR DETECTED IN STORAGE</h3>
                    <p class="text-secondary opacity-50 small mt-3">PROCEED TO THE ARMORY TO EQUIP ITEMS</p>
                    <a href="{{ url('/') }}" class="btn btn-checkout-gaming mt-4 px-5">
                        <i class="fa-solid fa-gun me-2"></i> RETURN TO ARMORY
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection