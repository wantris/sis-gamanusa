@extends('student.template')

@section('title') {{'Profil'}} @endsection

@section('breadcumb-title') {{'Profil'}} @endsection

@section('content')
    <div class="row mx-auto">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('siswa.auth.profile.post')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                              </div>
                              <input type="text" value="{{$user->studentRef->fullname}}" name="fullname" class="form-control">
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
                            <label>Nomor Telepon</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                              </div>
                              <input type="text" value="{{$user->studentRef->phone}}" name="phone" class="form-control">
                            </div>
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
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
                              <input type="text" value="{{$user->studentRef->email}}" name="email" class="form-control">
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                              </div>
                              <input type="text" value="{{$user->studentRef->place_of_birth}}" name="place" class="form-control">
                            </div>
                            @if ($errors->has('place'))
                                <span class="text-danger">{{ $errors->first('place') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                              </div>
                              <input type="date" value="{{$user->studentRef->date_of_birth}}" name="date" class="form-control">
                            </div>
                            @if ($errors->has('date'))
                                <span class="text-danger">{{ $errors->first('date') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Jenis Kelamin</label>
                            <select name="gender" class="form-control" id="">
                                <option value="Laki-laki" @if($user->studentRef->gender == "Laki-laki" ) selected @endif>Laki-laki</option>
                                <option value="Perempuan" @if($user->studentRef->gender == "Perempuan" ) selected @endif>Perempuan</option>
                            </select>
                            <div class="invalid-feedback">
                            Please fill in your gender
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Alamat</label>
                            <textarea name="address" id="" class="form-control">{{$user->studentRef->address}}</textarea>
                            <div class="invalid-feedback">
                            Please fill in your date of address
                            </div>
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