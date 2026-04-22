@extends('user.layouts.main')
@push('title')
<title>Settings</title>
@endpush

@section('content')
        
            <div id="layoutSidenav_content">
                <main>
                   <div class="container p-4">
                         <div class="card p-4">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('user.settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                
                                <div class="col-xl-8 col-md-8">
                                        <h4>Account Setting</h4>

                                            <div class="row mt-3">
                                            <div class="col-lg-12 mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                                            </div>

                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary ">Save Changes</button>
                                            </div>
                                            </div>
                                        
                                </div>

                                <div class="col-xl-4 col-md-4 mt-5">
                                    <div class="text-center">
                                        @if(Auth::user()->photo)
                                            <img id="profile-preview" src="{{ asset('uploads/profile/' . Auth::user()->photo) }}" style="width:155px; height:155px; object-fit: cover; border-radius: 50%;">
                                        @else
                                            <img id="profile-preview" src="{{ asset('dashboard/assets/img/user.png') }}" style="width:155px;">
                                        @endif
                                        <div class="mt-3">
                                            <label for="image" class="form-label btn btn-dark">Choose Image</label>
                                            <input type="file" name="photo" class="form-control d-none" id="image">
                                        </div>
                                    </div>

                                </div>
                                </div>
                            </form>
                             
                        </div>

                        <!-- <div class="card p-4 mt-4">
                            <div class="row">
                            
                            <div class="col-xl-12 col-md-12">
                                    <h4>Billing Address</h4>

                                    
                                        <div class="row mt-3">
                                            <div class="col-lg-12 mb-3">
                                                <label class="form-label">Country</label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Select your Country</option>
                                                        <option value="1">India</option>
                                                        <option value="2">USA</option>
                                                        <option value="3">Nepal</option>
                                                    </select>
                                            </div>
                                            
                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" placeholder="John">
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" placeholder="Doe">
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" placeholder="john@gmail.com">
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Phone Number</label>
                                                <input type="tel" class="form-control" placeholder="+91 ">
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Pin Code</label>
                                                <input type="text" class="form-control" placeholder="141001">
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Landmark</label>
                                                <input type="text" class="form-control" placeholder="India Gate">
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">City</label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Select your City</option>
                                                        <option value="1">Ludhiana</option>
                                                        <option value="2">Moga</option>
                                                        <option value="3">Jalandhar</option>
                                                    </select>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">State</label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Select your State</option>
                                                        <option value="1">Punjab</option>
                                                        <option value="2">Bihar</option>
                                                        <option value="3">UP</option>
                                                    </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <button class="btn btn-primary ">Save Changes</button>
                                            </div>
                                        </div>
                                    
                            </div>

                            
                            </div>

                            
                        </div> -->
                      
                   </div>
                </main>
            
                

@endsection

@push('scripts')
<script>
    document.getElementById('image').onchange = function (evt) {
        const [file] = this.files
        if (file) {
            document.getElementById('profile-preview').src = URL.createObjectURL(file)
        }
    }
</script>
@endpush
                