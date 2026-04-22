@extends('admin.includes.main')
@push('title')
<title>Add Category</title>
@endpush

@section('content')
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <div class="card p-4 mt-4">
                            <div class="row">
                            
                            <div class="col-xl-8 col-md-8">
                                    <h4>Add Category</h4>

                                    @if(session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    <form method="POST" action="{{ url('admin/add-category') }}">
                                        @csrf
                                        <div class="row mt-3">
                                            <div class="col-lg-12 mb-3">
                                                <label class="form-label">Category Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="e.g. Electronics" required>
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <label class="form-label">Icon (FontAwesome class)</label>
                                                <input type="text" name="icon" class="form-control" placeholder="e.g. fa-laptop">
                                            </div>

                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary">Add Category</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                            </div>

                            
                            </div>

                            
                        </div>
                </main>


                

@endsection
                