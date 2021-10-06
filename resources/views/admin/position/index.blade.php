@extends('admin.template')

@section('title') {{'Jabatan'}} @endsection

@section('breadcumb-title') {{'Data Jabatan'}} @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('admin.position.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus mr-2"></i>Tambah</a>
            <div class="card">
                <div class="card-body">
                    <table id="example" class="display table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th >No.</th>
                                <th >Kode Jabatan</th>
                                <th>Nama Jabatan</th>
                                <th>Jumlah Gaji</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($positions as $position)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$position->position_cd}}</td>
                                    <td>{{$position->position_name}}</td>
                                    <td>Rp. {{number_format($position->salary,2,',','.')}}</td>
                                    <td>
                                        <a href="#" onclick="deletePosition('{{$position->position_cd}}')" class="btn btn-danger d-inline mr-2 mb-2">Hapus</a>
                                        <a href="{{route('admin.position.edit', $position->position_cd)}}" class="btn btn-success d-inline">Edit</a>
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

        const deletePosition = (code) => {
            event.preventDefault();
            let url = "/admin/position/delete";
            Notiflix.Confirm.Show( 
                'Jabatan',
                'Apakah anda yakin ingin menghapus?',
                'Yes',
                'No',
                function(){ 
                    $.ajax(
                        {
                            url: url,
                            type: 'delete', 
                            dataType: "JSON",
                            data: {
                                "code": code ,
                            },
                            success: function (response){
                                if(response.status == 1){
                                    Notiflix.Notify.Success(response.message);
                                    location.reload();
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr);
                                Notiflix.Notify.Failure('Ooopss');
                            }
                    });
                }, function(){
                    // No button callback alert('If you say so...'); 
                } ); 
    }
    </script>
@endpush