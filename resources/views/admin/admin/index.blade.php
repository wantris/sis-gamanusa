@extends('admin.template')

@section('title') {{'Akun Admin'}} @endsection

@section('breadcumb-title') {{'Data Akun Admin'}} @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('admin.admin.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus mr-2"></i>Tambah</a>
            <div class="card">
                <div class="card-body">
                    <table id="example" class="display table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <th>Nama Karyawan</th>
                                <th>username</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $account)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$account->employeeRef->name}}</td>
                                    <td>{{$account->username}}</td>
                                    <td>
                                        <a href="#" onclick="deleteAccount('{{$account->id}}')" class="btn btn-danger d-inline mr-2 mb-2">Hapus</a>
                                        <a href="{{route('admin.admin.edit', $account->id)}}" class="btn btn-success d-inline">Edit</a>
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

        const deleteAccount = (id) => {
            event.preventDefault();
            let url = "/admin/admin/delete";
            Notiflix.Confirm.Show( 
                'Admin',
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