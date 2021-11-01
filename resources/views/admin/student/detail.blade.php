@extends('admin.template')

@section('title') {{'Siswa'}} @endsection

@section('breadcumb-title') {{'Edit Data Siswa'}} @endsection

@section('content')
    <div class="row mx-auto">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.student.update')}}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="email">Nama Lengkap</label>
                            <input id="username" disabled type="text" value="{{$st->fullname}}" class="form-control" name="fullname" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                            Please fill in your fullname
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" disabled type="email" value="{{$st->email}}" class="form-control" name="email" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                            Please fill in your email
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Nomor Telepon</label>
                            <input id="phone" disabled type="text" class="form-control" value="{{$st->phone}}" name="phone" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                            Please fill in your phone
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Tempat Lahir</label>
                            <input id="email" disabled type="text" class="form-control" value="{{$st->place_of_birth}}" name="place" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                            Please fill in your place of birth
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Tanggal Lahir</label>
                            <input id="phone" disabled type="date" class="form-control" value="{{$st->date_of_birth}}" name="date" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                            Please fill in your date of birth
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Jenis Kelamin</label>
                            <select name="gender" disabled class="form-control" id="">
                                <option value="Laki-laki" @if($st->gender == "Laki-laki" ) selected @endif>Laki-laki</option>
                                <option value="Perempuan" @if($st->gender == "Perempuan" ) selected @endif>Perempuan</option>
                            </select>
                            <div class="invalid-feedback">
                            Please fill in your gender
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Alamat</label>
                            <textarea name="address" disabled id="" class="form-control">{{$st->address}}</textarea>
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
        <div class="col-lg-6 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <p class="text-center font-weight-bold">Riwayat Kelas</p>
                    <table id="example" class="display table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Daftar Kelas</th>
                                <th>Tahun</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($st->studentClassRef as $class)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$class->classRef->level.$class->classRef->class_name}}</td>
                                    <td>{{$class->year}}</td>
                                    <td>
                                        <a href="#" onclick="deleteStudent('{{$class->id}}')" class="btn btn-danger d-inline mr-2 mb-2">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <p class="text-center font-weight-bold">Tambah Riwayat Kelas</p>
                    <form action="{{route('admin.student.class.save')}}" method="post">
                        @csrf
                        <input type="hidden" name="student_id" value="{{$st->id}}">
                        <div class="form-group">
                            <label for="email">Kelas</label>
                            <select name="class_id" id="" class="form-control">
                                <option selected>Pilih Kelas</option>
                                @foreach ($listClass as $item)
                                    <option value="{{$item->id}}">{{$item->level.$item->class_name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                            Please fill in your date of address
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Tahun</label>
                            <input id="datepicker" name="year" width="276" />
                            <div class="invalid-feedback">
                            Please fill in your date of address
                            </div>
                        </div>
                        <input type="submit" value="Submit" class="form-control btn btn-primary d-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
         $(document).ready(function() {
            $('#datepicker').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy'
            });
        } );
    </script>
@endpush