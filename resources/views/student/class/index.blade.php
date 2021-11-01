@extends('student.template')

@section('title') {{'Riwayat Kelas'}} @endsection

@section('breadcumb-title') {{'Data Riwayat Kelas'}} @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="display table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <th>Riwayat Kelas</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listClass as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->classRef->level.$item->classRef->class_name}}</td>
                                    <td>{{$item->year}}</td>
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