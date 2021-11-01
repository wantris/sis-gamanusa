@extends('student.template')

@section('title') {{'Ganti Password'}} @endsection

@section('breadcumb-title') {{'Ganti Password'}} @endsection

@section('content')
    <div class="row mx-auto">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('siswa.auth.changepassword.post')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Password Baru</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                              </div>
                              <input type="password" name="password" class="form-control">
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                              </div>
                              <input type="password" name="confirm_password" class="form-control">
                            </div>
                            @if ($errors->has('confirm_password'))
                                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Submit"  class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
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