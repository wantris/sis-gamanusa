@extends('pegawai.template')

@section('title') {{'Bonus Gaji'}} @endsection

@section('breadcumb-title') {{'Data Bonus Gaji'}} @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="display table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <th>Title</th>
                                <th>Deskripsi</th>
                                <th>Nominal</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bonuses as $bonus)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$bonus->salaryBonusRef->title}}</td>
                                    <td>{{$bonus->salaryBonusRef->description}}</td>
                                    <td>Rp. {{number_format($bonus->nominal_total,2,',','.')}}</td>
                                    <td>{{$bonus->created_at->isoFormat('D MMMM Y')}}</td>
                                    <td>
                                        <a href="{{route('employee.salaryBonus.detail', $bonus->salaryBonusRef->id)}}" class="btn btn-primary d-inline mr-2 mb-2">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endpush