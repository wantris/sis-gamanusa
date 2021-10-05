@extends('admin.template')

@section('title') {{'Karyawan'}} @endsection

@section('breadcumb-title') {{'Tambah Data Karyawan'}} @endsection

@section('content')
    <div class="row mx-auto">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.employee.save')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama Karyawan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-signature"></i>
                                </div>
                              </div>
                              <input type="text" name="employee_name" class="form-control phone-number">
                            </div>
                            @if ($errors->has('employee_name'))
                                <span class="text-danger">{{ $errors->first('employee_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-arrows-alt"></i>
                                </div>
                              </div>
                              <select name="position" id="" class="form-control">
                                  <option selected>Pilih Jabatan</option>
                                  @foreach ($ps as $item)
                                      <option value="{{$item->position_cd}}">{{$item->position_name}} ({{$item->position_cd}})</option>
                                  @endforeach
                              </select>
                            </div>
                            @if ($errors->has('position'))
                                <span class="text-danger">{{ $errors->first('position') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>NIK</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-id-card"></i>
                                </div>
                              </div>
                              <input type="text" name="nik" class="form-control phone-number">
                            </div>
                            @if ($errors->has('nik'))
                                <span class="text-danger">{{ $errors->first('nik') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-venus-mars"></i>
                                </div>
                              </div>
                              <select name="gender" class="form-control" id="">
                                  <option value="Laki-laki">Laki-laki</option>
                                  <option value="Perempuan">Perempuan</option>
                                  <option value="Lainnya">Lainnya</option>
                              </select>
                            </div>
                            @if ($errors->has('gender'))
                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-at"></i>
                                </div>
                              </div>
                              <input type="text" name="email" class="form-control phone-number">
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
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