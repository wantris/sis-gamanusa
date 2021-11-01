@extends('admin.template')

@section('title') {{'Profil'}} @endsection

@section('breadcumb-title') {{'Profil'}} @endsection

@section('content')
    <div class="row mx-auto">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.auth.profile.post')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                              </div>
                              <input type="text" value="{{$user->fullname}}" name="fullname" class="form-control">
                            </div>
                            @if ($errors->has('fullname'))
                                <span class="text-danger">{{ $errors->first('fullname') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                              </div>
                              <input type="text" value="{{$user->username}}" disabled name="username" class="form-control">
                            </div>
                            @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                              </div>
                              <input type="text" value="{{$user->email}}" name="email" class="form-control">
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Photo</label>
                            <input type="file" name="photo" class="form-control" onchange="loadFile(event)" id="">
                            <input type="hidden" name="oldPhoto" value="{{$user->photo}}">
                            <div class="invalid-feedback">
                            Please fill in your date of address
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Submit"  class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 text-center">
            @if ($user->photo)
            <img src="{{url('assets/img/user-photo/'.$user->photo)}}" accept="image/*" id="photo-img" width="200" class="img-fluid rounded-circle" alt="">
            @else
            <img src="{{url('assets/img/user.svg')}}" accept="image/*" id="photo-img" width="200" class="img-fluid rounded-circle" alt="">
            @endif
        </div>
    </div>
@endsection

@push('custom-js')
    <script>

        var loadFile = function(event) {
            var output = document.getElementById('photo-img');
            
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endpush