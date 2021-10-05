@extends('admin.template')

@section('title') {{'Bonus Gaji'}} @endsection

@section('breadcumb-title') {{'Data Bonus Gaji'}} @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('admin.salaryBonus.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus mr-2"></i>Tambah</a>
            <div class="card">
                <div class="card-body">
                    <table id="example" class="display table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <th>Title</th>
                                <th>Deskripsi</th>
                                <th>Nominal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bonuses as $bonus)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$bonus->title}}</td>
                                    <td>{{$bonus->description}}</td>
                                    <td>Rp. {{number_format($bonus->nominal,2,',','.')}}</td>
                                    <td>
                                        <a href="{{route('admin.salaryBonus.detail', $bonus->id)}}" class="btn btn-primary d-inline mr-2 mb-2">Detail</a>
                                        <a href="#" onclick="deleteSalaryBonus('{{$bonus->id}}')" class="btn btn-danger d-inline mr-2 mb-2">Hapus</a>
                                        <a href="{{route('admin.salaryBonus.edit', $bonus->id)}}" class="btn btn-success d-inline">Edit</a>
                                        
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

        const deleteSalaryBonus = (id) => {
            event.preventDefault();
            let url = "/admin/salarybonus/delete";
            Notiflix.Confirm.Show( 
                'Data Bonus Gaji',
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