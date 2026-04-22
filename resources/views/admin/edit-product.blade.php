@extends('admin.includes.main')
@push('title')
    <title>Edit Product</title>
@endpush

@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <div class="card p-4 mt-4">
                    <div class="d-flex justify-content-between">
                        <h4>Edit Product</h4>
                        <a href="{{url('admin/view-product')}}" class="btn btn-secondary">Back</a>
                    </div>
                    <hr>

                    @if(session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif

                    <form method="POST" action="{{url('admin/update-product/' . $product->id)}}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Current Image</label><br>
                            <img src="{{asset('products/' . $product->image)}}" width="100" class="mb-2 rounded shadow-sm">
                            <br>
                            <label>Change Image (Optional)</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <button class="btn btn-primary">Update Product</button>

                    </form>

                </div>
            </div>
        </main>
    </div>

@endsection
