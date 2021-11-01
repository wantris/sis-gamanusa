@extends('admin.template')

@section('title') {{'Akun Admin'}} @endsection

@section('breadcumb-title') {{'Edit Data Akun Admin'}} @endsection

@section('content')
    <div class="row mx-auto">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.admin.update')}}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{$account->id}}">
                        <div class="form-group">
                            <label>Nama Admin</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fad fa-user"></i>
                                </div>
                              </div>
                              <input type="text" value="{{$account->fullname}}" name="fullname" id="" class="form-control">
                            </div>
                            @if ($errors->has('fullname'))
                                <span class="text-danger">{{ $errors->first('fullname') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fad fa-user"></i>
                                </div>
                              </div>
                              <input type="email" value="{{$account->email}}" name="email" id="" class="form-control">
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-signature"></i>
                                </div>
                              </div>
                              <input type="text" name="username" id="" value="{{$account->username}}" class="form-control">
                            </div>
                            @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-key"></i>
                                </div>
                              </div>
                              <input type="password" name="password" id="" class="form-control">
                              <input type="hidden" name="oldPassword" value="{{$account->password}}">
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
         $(document).ready(function() {
            
        } );
    </script>
@endpush