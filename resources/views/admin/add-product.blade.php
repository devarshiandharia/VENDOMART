@extends('admin.includes.main')
@push('title')
    <title>DEPLOY_GEAR - Admin</title>
@endpush

@section('content')
<style>
    .form-label-gaming {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-cyan);
        font-size: 0.7rem;
        letter-spacing: 2px;
        margin-bottom: 0.8rem;
        text-transform: uppercase;
    }

    .form-control-gaming {
        background: rgba(255, 255, 255, 0.02) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: white !important;
        border-radius: 0;
        padding: 12px;
        transition: 0.3s;
    }

    .form-control-gaming:focus {
        border-color: var(--neon-purple) !important;
        box-shadow: 0 0 15px rgba(188, 19, 254, 0.2) !important;
        outline: none;
    }

    .select-gaming {
        background-color: #0f172a !important;
        color: white !important;
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center my-4">
                <div class="me-3" style="width: 10px; height: 40px; background: var(--neon-cyan); box-shadow: 0 0 15px var(--neon-cyan);"></div>
                <h2 class="mb-0 text-white">DEPLOY_NEW_GEAR</h2>
            </div>

            <div class="card p-5">
                @if(session('success'))
                    <div class="alert alert-success bg-dark border-success text-success rounded-0 mb-4">
                        <i class="fa-solid fa-check-circle me-2"></i> {{ strtoupper(session('success')) }}
                    </div>
                @endif

                <form method="POST" action="{{url('admin/add-product')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label-gaming">Gear Designation</label>
                            <input type="text" name="name" class="form-control-gaming form-control" placeholder="E.g. NEON_BLADE_X" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label-gaming">Class Module</label>
                            <select name="category_id" class="form-control-gaming form-select select-gaming" required>
                                <option value="" class="bg-dark">Select Class...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" class="bg-dark">{{ strtoupper($category->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-gaming">Combat Specs / Description</label>
                        <textarea name="description" class="form-control-gaming form-control" rows="4" placeholder="Enter technical specifications..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label-gaming">Credit Value (CR)</label>
                            <input type="number" name="price" class="form-control-gaming form-control" placeholder="0.00">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label-gaming">Visual Data (Image)</label>
                            <input type="file" name="image" class="form-control-gaming form-control">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-gaming-cyan px-5 py-3 w-100">INITIALIZE_DEPLOYMENT</button>
                    </div>

                </form>
            </div>
        </div>
    </main>
</div>
@endsection