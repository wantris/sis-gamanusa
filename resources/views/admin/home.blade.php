@extends('admin.template')

@section('title') {{'Dashboard'}} @endsection

@section('breadcumb-title') {{'Dashboard'}} @endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-user-shield"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Admin</h4>
          </div>
          <div class="card-body">
            {{$admin}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-user-shield"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Kelas</h4>
          </div>
          <div class="card-body">
            {{$admin}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-user-shield"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Siswa</h4>
          </div>
          <div class="card-body">
            {{$admin}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Akun</h4>
          </div>
          <div class="card-body">
            {{$user}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection