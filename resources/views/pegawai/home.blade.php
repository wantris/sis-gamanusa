@extends('pegawai.template')

@section('title') {{'Dashboard'}} @endsection

@section('breadcumb-title') {{'Dashboard'}} @endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fal fa-money-check-edit-alt"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Riwayat Kelas</h4>
            </div>
            <div class="card-body">
              {{$bonuses}}
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection