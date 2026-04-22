@extends('admin.includes.main')
@push('title')
    <title>GEAR_DATABASE - Admin</title>
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
        padding: 1rem 0.5rem !important;
    }

    .product-img-frame {
        border: 1px solid rgba(0, 242, 255, 0.2);
        padding: 2px;
        background: rgba(0,0,0,0.3);
        width: 60px;
        height: 60px;
        object-fit: contain;
    }

    .btn-edit-gaming {
        border: 1px solid var(--neon-cyan);
        color: var(--neon-cyan);
        background: transparent;
        border-radius: 0;
        font-size: 0.7rem;
        padding: 5px 15px;
        font-family: 'Orbitron', sans-serif;
        transition: 0.3s;
        text-decoration: none;
        margin-right: 5px;
    }

    .btn-edit-gaming:hover {
        background: var(--neon-cyan);
        color: #000;
        box-shadow: 0 0 15px var(--neon-cyan);
    }

    .btn-delete-gaming {
        border: 1px solid var(--neon-purple);
        color: var(--neon-purple);
        background: transparent;
        border-radius: 0;
        font-size: 0.7rem;
        padding: 5px 15px;
        font-family: 'Orbitron', sans-serif;
        transition: 0.3s;
        text-decoration: none;
    }

    .btn-delete-gaming:hover {
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
                <h2 class="mb-0 text-white">GEAR_INVENTORY</h2>
            </div>

            <div class="card p-4">
                <div class="table-responsive">
                    <table class="table table-gaming">
                        <thead>
                            <tr>
                                <th scope="col">GEAR_ID</th>
                                <th scope="col">VISUAL</th>
                                <th scope="col">ITEM_NAME</th>
                                <th scope="col">CREDIT_VAL</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td class="fw-bold text-info">#00{{$product->id}}</td>
                                <td>
                                    <img src="{{asset('products/' . $product->image)}}" class="product-img-frame">
                                </td>
                                <td class="text-white">{{$product->name}}</td>
                                <td class="text-info-neon fw-bold">₹ {{ number_format($product->price, 0) }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{url('admin/edit-product/' . $product->id)}}" class="btn-edit-gaming">UPDATE</a>
                                        <a href="{{url('admin/delete-product/' . $product->id)}}" class="btn-delete-gaming">REDACT</a>
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