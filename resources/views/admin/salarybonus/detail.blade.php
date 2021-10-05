@extends('admin.template')

@section('title') {{'Penerima Bonus Gaji'}} @endsection

@section('breadcumb-title') {{'Data Penerima Bonus Gaji'}} @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="display table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <th>Nama Karyawan</th>
                                <th>Gaji</th>
                                <th>Nominal Bonus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bonus->detailRef as $detail)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$detail->employeeRef->name}}</td>
                                    <td>Rp. {{number_format($detail->employeeRef->positionRef->salary,2,',','.')}}</td>
                                    <td>Rp. {{number_format($detail->nominal_total,2,',','.')}}</td>
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