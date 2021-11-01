@extends('admin.template')

@section('title') {{'NPSN'}} @endsection

@section('breadcumb-title') {{'Data NPSN'}} @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('admin.npsn.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus mr-2"></i>Tambah</a>
            <div class="card">
                <div class="card-body">
                    <table id="example" class="display table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nomor NPSN</th>
                                <th>Tanggal Terbit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($npsns as $npsn)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$npsn->number}}</td>
                                    <td>{{$npsn->date}}</td>
                                    <td>
                                        <a href="#" onclick="deleteNpsn('{{$npsn->id}}')" class="btn btn-danger d-inline mr-2 mb-2">Hapus</a>
                                        <a href="{{route('admin.npsn.edit', $npsn->id)}}" class="btn btn-success d-inline">Edit</a>
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

        const deleteNpsn = (id) => {
            event.preventDefault();
            let url = "/admin/npsn/delete";
            Notiflix.Confirm.Show( 
                'Data NPSN',
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
                                "id": id ,
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