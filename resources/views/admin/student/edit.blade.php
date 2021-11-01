@extends('admin.template')

@section('title') {{'Siswa'}} @endsection

@section('breadcumb-title') {{'Edit Data Siswa'}} @endsection

@section('content')
    <div class="row mx-auto">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.student.update')}}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{$st->id}}">
                        <input type="hidden" name="nis" value="{{$st->nis}}">
                        <div class="form-group">
                            <label for="email">Nama Lengkap</label>
                            <input id="username" type="text" value="{{$st->fullname}}" class="form-control" name="fullname" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                            Please fill in your fullname
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" value="{{$st->email}}" class="form-control" name="email" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                            Please fill in your email
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Nomor Telepon</label>
                            <input id="phone" type="text" class="form-control" value="{{$st->phone}}" name="phone" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                            Please fill in your phone
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Tempat Lahir</label>
                            <input id="email" type="text" class="form-control" value="{{$st->place_of_birth}}" name="place" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                            Please fill in your place of birth
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Tanggal Lahir</label>
                            <input id="phone" type="date" class="form-control" value="{{$st->date_of_birth}}" name="date" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                            Please fill in your date of birth
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Jenis Kelamin</label>
                            <select name="gender" class="form-control" id="">
                                <option value="Laki-laki" @if($st->gender == "Laki-laki" ) selected @endif>Laki-laki</option>
                                <option value="Perempuan" @if($st->gender == "Perempuan" ) selected @endif>Perempuan</option>
                            </select>
                            <div class="invalid-feedback">
                            Please fill in your gender
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Alamat</label>
                            <textarea name="address" id="" class="form-control">{{$st->address}}</textarea>
                            <div class="invalid-feedback">
                            Please fill in your date of address
                            </div>
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