@extends('admin.includes.main')
@push('title')
<title>REPLICANT_DATABASE - Admin</title>
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

    .btn-gear {
        width: 35px; height: 35px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 0;
        background: transparent;
        transition: 0.3s;
        margin: 0 2px;
    }

    .btn-unblock {
        border: 1px solid var(--neon-cyan);
        color: var(--neon-cyan);
    }
    .btn-unblock:hover {
        background: var(--neon-cyan);
        color: #000;
        box-shadow: 0 0 15px var(--neon-cyan);
    }

    .btn-block {
        border: 1px solid var(--neon-purple);
        color: var(--neon-purple);
    }
    .btn-block:hover {
        background: var(--neon-purple);
        color: white;
        box-shadow: 0 0 15px var(--neon-purple);
    }

    .btn-delete {
        border: 1px solid #ef4444;
        color: #ef4444;
    }
    .btn-delete:hover {
        background: #ef4444;
        color: white;
        box-shadow: 0 0 15px #ef4444;
    }

    .alert-success-gaming {
        background: rgba(0, 242, 255, 0.1);
        border: 1px solid var(--neon-cyan);
        color: var(--neon-cyan);
        border-radius: 0;
        font-family: 'Orbitron', sans-serif;
        font-size: 0.8rem;
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center my-4">
                <div class="me-3" style="width: 10px; height: 40px; background: var(--neon-purple); box-shadow: 0 0 15px var(--neon-purple);"></div>
                <h2 class="mb-0 text-white">REPLICANT_DATA_STREAM</h2>
            </div>

            <div class="card p-4">
                @if(session('success'))
                    <div class="alert alert-success-gaming mb-4">
                        <i class="fa-solid fa-check-double me-2"></i> {{ strtoupper(session('success')) }}
                    </div>
                @endif

                <div class="table-responsive mt-3">
                    <table class="table table-gaming">
                        <thead>
                            <tr>
                                <th scope="col">ENTRY_NODE</th>
                                <th scope="col">REPLICANT_ID</th>
                                <th scope="col">IDENT_MAIL</th>
                                <th scope="col">PROTOCOL</th>
                                <th scope="col">OVERRIDE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $user)
                            <tr>
                                <td class="fw-bold">#00{{ $index + 1 }}</td>
                                <td class="text-white">{{ $user->name }}</td>
                                <td class="text-info-neon">{{ $user->email }}</td>
                                <td>
                                    @if($user->status == 1)
                                        <span class="small px-2 py-1 border border-success text-success" style="font-size: 0.6rem; font-family: 'Orbitron', sans';">ACTIVE_NODE</span>
                                    @else
                                        <span class="small px-2 py-1 border border-danger text-danger" style="font-size: 0.6rem; font-family: 'Orbitron', sans';">TERMINATED</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ url('admin/unblock-user/'.$user->id) }}" class="btn-gear btn-unblock" title="Restore"><i class="fa-solid fa-shield-heart"></i></a>
                                        <a href="{{ url('admin/block-user/'.$user->id) }}" class="btn-gear btn-block" title="Suspend"><i class="fa-solid fa-ban"></i></a>
                                        <a href="{{ url('admin/delete-user/'.$user->id) }}" class="btn-gear btn-delete" title="Purge" onclick="return confirm('Initiate purge sequence? This cannot be undone.');"><i class="fa-solid fa-trash"></i></a>
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