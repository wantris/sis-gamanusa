@extends('admin.template')

@section('title') {{'Akun'}} @endsection

@section('breadcumb-title') {{'Tambah Data Akun'}} @endsection

@section('content')
    <div class="row mx-auto">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.account.save')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama Karyawan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fad fa-user"></i>
                                </div>
                              </div>
                              <select name="employee" id="" class="form-control">
                                  <option selected>Pilih Karyawan</option>
                                  @foreach ($employees as $item)
                                      <option value="{{$item->id}}">{{$item->name}}</option>
                                  @endforeach
                              </select>
                            </div>
                            @if ($errors->has('employee'))
                                <span class="text-danger">{{ $errors->first('employee') }}</span>
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