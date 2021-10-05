@extends('admin.template')

@section('title') {{'jabatan'}} @endsection

@section('breadcumb-title') {{'Edit Data Jabatan'}} @endsection

@section('content')
    <div class="row mx-auto">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.position.update')}}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Kode Jabatan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                              </div>
                              <input type="text" name="code" value="{{$ps->position_cd}}" class="form-control phone-number">
                            </div>
                            @if ($errors->has('code'))
                                <span class="text-danger">{{ $errors->first('code') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Nama Jabatan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-arrows-alt"></i>
                                </div>
                              </div>
                              <input type="text" name="name" value="{{$ps->position_name}}" class="form-control phone-number">
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Jumlah Gaji Jabatan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-money-check"></i>
                                </div>
                              </div>
                              <input type="text" name="salary" value="{{$ps->salary}}" class="form-control phone-number">
                            </div>
                            @if ($errors->has('salary'))
                                <span class="text-danger">{{ $errors->first('salary') }}</span>
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