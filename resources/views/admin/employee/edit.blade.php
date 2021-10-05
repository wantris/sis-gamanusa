@extends('admin.template')

@section('title') {{'Karyawan'}} @endsection

@section('breadcumb-title') {{'Tambah Data Karyawan'}} @endsection

@section('content')
    <div class="row mx-auto">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.employee.update')}}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{$em->id}}">
                        <div class="form-group">
                            <label>Nama Karyawan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-signature"></i>
                                </div>
                              </div>
                              <input type="text" name="employee_name" value="{{$em->name}}" class="form-control phone-number">
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
                                  @foreach ($ps as $item)
                                        @if ($item->position_cd == $em->position_cd)
                                            <option value="{{$item->position_cd}}" selected>{{$item->position_name}} ({{$item->position_cd}})</option>
                                        @else
                                            <option value="{{$item->position_cd}}">{{$item->position_name}} ({{$item->position_cd}})</option>
                                        @endif
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
                              <input type="text" name="nik" value="{{$em->nik}}" class="form-control phone-number">
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
                                  <option value="Laki-laki" @if($em->gender == "Laki-laki") selected @endif>Laki-laki</option>
                                  <option value="Perempuan" @if($em->gender == "Perempuan") selected @endif>Perempuan</option>
                                  <option value="Lainnya" @if($em->gender == "Lainnya") selected @endif>Lainnya</option>
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
                              <input type="text" name="email" value="{{$em->email}}" class="form-control phone-number">
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