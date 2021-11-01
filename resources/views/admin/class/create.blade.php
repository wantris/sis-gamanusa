@extends('admin.template')

@section('title') {{'Kelas'}} @endsection

@section('breadcumb-title') {{'Tambah Data Kelas'}} @endsection

@section('content')
    <div class="row mx-auto">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.class.save')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Jenjang</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                              </div>
                              <input type="text" name="level" class="form-control phone-number">
                            </div>
                            @if ($errors->has('level'))
                                <span class="text-danger">{{ $errors->first('level') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-arrows-alt"></i>
                                </div>
                              </div>
                              <input type="text" name="class_name" class="form-control phone-number">
                            </div>
                            @if ($errors->has('class_name'))
                                <span class="text-danger">{{ $errors->first('class_name') }}</span>
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