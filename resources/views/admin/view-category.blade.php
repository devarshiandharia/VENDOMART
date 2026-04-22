@extends('admin.includes.main')
@push('title')
<title>CLASS_LOGS - Admin</title>
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

    .icon-frame {
        color: var(--neon-cyan);
        font-size: 1.5rem;
        filter: drop-shadow(0 0 5px var(--neon-cyan));
    }

    .btn-delete-flash {
        border: 1px solid var(--neon-purple);
        color: var(--neon-purple);
        background: transparent;
        width: 35px; height: 35px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 0;
        transition: 0.3s;
    }

    .btn-delete-flash:hover {
        background: var(--neon-purple);
        color: white;
        box-shadow: 0 0 15px var(--neon-purple);
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center my-4">
                <div class="me-3" style="width: 10px; height: 40px; background: var(--neon-purple); box-shadow: 0 0 15px var(--neon-purple);"></div>
                <h2 class="mb-0 text-white">CLASS_MODULE_LOGS</h2>
            </div>

            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="text-secondary small mb-0">REGISTERED_CATEGORIES</h5>
                    <a href="{{url('admin/add-category')}}" class="btn btn-gaming-cyan btn-sm px-4">NEW_MODULE</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success bg-dark border-success text-success rounded-0 mb-4 small">
                        <i class="fa-solid fa-check-circle me-2"></i> SUCCESS: MODULE_DATA_UPDATED
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-gaming">
                        <thead>
                            <tr>
                                <th scope="col">NODE_ID</th>
                                <th scope="col">SYMBOLOGY</th>
                                <th scope="col">CLASS_NAME</th>
                                <th scope="col">SLUG_IDENT</th>
                                <th scope="col">REDACT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td class="fw-bold text-info">#C0{{ $loop->iteration }}</td>
                                <td><i class="fa-solid {{ $category->icon }} icon-frame"></i></td>
                                <td class="text-white fw-bold">{{ strtoupper($category->name) }}</td>
                                <td class="text-secondary small">{{ $category->slug }}</td>
                                <td>
                                    <a href="{{url('admin/delete-category/' . $category->id)}}" class="btn-delete-flash" onclick="return confirm('Are you sure you want to REDACT this module?')">
                                        <i class="fa-solid fa-bolt"></i>
                                    </a>
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