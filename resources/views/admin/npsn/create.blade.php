@extends('admin.template')

@section('title') {{'NPSN'}} @endsection

@section('breadcumb-title') {{'Tambah Data NPSN'}} @endsection

@section('content')
    <div class="row mx-auto">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.npsn.save')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nomor NPSN</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                              </div>
                              <input type="text" name="number" class="form-control phone-number">
                            </div>
                            @if ($errors->has('number'))
                                <span class="text-danger">{{ $errors->first('number') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tanggal Terbit</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-arrows-alt"></i>
                                </div>
                              </div>
                              <input type="date" name="date" class="form-control phone-number">
                            </div>
                            @if ($errors->has('date'))
                                <span class="text-danger">{{ $errors->first('date') }}</span>
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