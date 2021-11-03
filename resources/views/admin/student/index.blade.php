@extends('admin.template')

@section('title') {{'Siswa'}} @endsection

@section('breadcumb-title') {{'Data Siswa'}} @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('admin.student.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus mr-2"></i>Tambah</a>
            <div class="card">
                <div class="card-body">
                    <table id="example" class="display table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas Terakhir</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$student->nis}}</td>
                                    <td>{{$student->fullname}}</td>
                                    <td>
                                        @if ($student->lastStudentClassRef)
                                        {{$student->lastStudentClassRef->classRef->level.$student->lastStudentClassRef->classRef->class_name}}
                                        @endif 
                                    </td>
                                    <td>{{$student->gender}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>
                                        <a href="#" onclick="deleteStudent('{{$student->id}}')" class="btn btn-danger d-inline mr-2 mb-2">Hapus</a>
                                        <a href="{{route('admin.student.edit', $student->id)}}" class="btn btn-success d-inline mr-2 mb-2">Edit</a>
                                        <a href="{{route('admin.student.detail', $student->id)}}" class="btn btn-info d-inline">Detail</a>
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

        const deleteStudent = (id) => {
            event.preventDefault();
            let url = "/admin/student/delete";
            Notiflix.Confirm.Show( 
                'Data Siswa',
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