@extends('admin.template')

@section('title') {{'Bonus Gaji'}} @endsection

@section('breadcumb-title') {{'Edit Data Bonus Gaji'}} @endsection

@section('content')
<form action="{{route('admin.salaryBonus.update')}}" enctype="multipart/form-data" method="post">
@csrf
@method('put')
    <div class="row mx-auto">
        <div class="col-12">
            <div class="card rounded">
                <div class="card-body">
                    <p class="h4 text-primary mb-3">Form Nominal Bonus</p>
                    <input type="hidden" name="bonus_id" value="{{$bonus->id}}">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label>Perihal Bonus</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fal fa-signature"></i>
                                    </div>
                                    </div>
                                    <input type="text" name="title"  value="{{$bonus->title}}" class="form-control">
                                </div>
                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label>Deskripsi Bonus</label>
                                <textarea name="description" class="form-control">{{$bonus->description}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label>Total Nominal Bonus</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-money-bill-wave-alt"></i>
                                    </div>
                                    </div>
                                    <input type="number" name="total_nominal" value="{{$bonus->nominal}}" id="bonus-nominal-inp" class="form-control phone-number">
                                </div>
                                @if ($errors->has('total_nominal'))
                                    <span class="text-danger">{{ $errors->first('total_nominal') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="submit-bonus" value="Submit" class="btn btn-primary btn-block">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="h4 text-primary mb-3 float-left">Form Penerima</p>
                            <a href="#" class="btn btn-primary float-right" onclick="addEmployee()" title="Tambah karyawan"><i class="fas fa-plus"></i></a>
                            <a href="#" class="btn btn-success float-right mr-2" onclick="refresh()" title="Refresh"><i class="fas fa-sync-alt"></i></a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <p class="d-inline mr-2">Total Presentase: </p>
                            @php
                                $total_precentage = 0;
                            @endphp
                            @foreach ($bonus->detailRef as $item)
                                @php
                                    $total_precentage += (int)$item->precentage;
                                @endphp
                            @endforeach
                            <p class="d-inline" id="total-precentage-text">{{$total_precentage}} %</p>
                        </div>
                    </div>
                    @foreach ($bonus->detailRef as $key => $detail)
                        <input type="hidden" name="detail_id[]" value="{{$detail->id}}">
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label>Pilih karyawan</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fad fa-user"></i>
                                        </div>
                                    </div>
                                    <select name="employee[]" id="employee_{{$key+1}}" class="form-control employee-select">
                                        @foreach ($employees as $employee)
                                            <option value="{{$employee->id}}" @if($employee->id == $detail->employee_id) selected @endif>{{$employee->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-12">
                                <div class="form-group">
                                    <label>Presentase</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fad fa-percentage"></i>
                                        </div>
                                    </div>
                                    <input type="number" name="precentage[]" value="{{$detail->precentage}}" placeholder="Input presentase" id="employee_precentage_{{$key+1}}" onkeyup="calculatePrecentage({{$key+1}})" class="form-control precentage">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label>Hasil</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-money-check-alt"></i>
                                        </div>
                                    </div>
                                    @php
                                        $calculate = (int)$detail->precentage/100 * $bonus->nominal;
                                    @endphp
                                    <input type="text" id="employee_nominal_{{$key+1}}" value="{{$calculate}}" disabled class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-12 pt-4">
                                <div class="form-group mt-1">
                                    <label></label>
                                    <a href="#" onclick="deleteEmployeeDb({{$detail->id}})" class="btn btn-danger"><i class="far fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        <div class="employee-container">
                            
                        </div>
                    </div>
                </div>
        </div>

    </div>
</form>
@endsection

@push('custom-js')
    <script>
        let employee_number = "{{$total_employee}}"; 
        let employee_list = "";
        let total_precentage = 0;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            callEmployee();    
        });

        const refresh = () => {
            event.preventDefault();
            var elements = document.getElementsByTagName("input");

            for (var ii=0; ii < elements.length; ii++) {
                if (elements[ii].type == "text" || elements[ii].type == "number") {
                    elements[ii].value = "";
                }
            }

            renderTotalPrecentage();
        }

        const callEmployee = () =>{
            const url_employee_list = "/admin/employee/list";
            $.ajax(
                {
                    url: url_employee_list,
                    type: 'get', 
                    success: function (response){
                        if(response.code == 200){
                            employee_list = response.datas;
                            renderEmployee(response.datas);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                }
            );
        }

        const renderEmployee = (employees) =>{
            $('.employee-select').each(function(){
                let container = this;
                $(container).append($('<option> selected', {
                    text : "Pilih Karyawan"
                }));

                $.each(employees, function (i, employee) {
                    $(container).append($('<option>', { 
                        value: employee.id,
                        text : employee.name
                    }));
                });
            })
        }

        const renderSingleEmployee = (container_id) => {
            console.log(container_id);
            $("#"+container_id).append($('<option> selected', {
                text : "Pilih Karyawan"
            }));

            $.each(employee_list, function (i, employee) {
                $("#"+container_id).append($('<option>', { 
                    value: employee.id,
                    text : employee.name
                }));
            });
        }
        

        const addEmployee = () => {
            event.preventDefault();
            employee_number = employee_number + 1;
            let html = `
                    <input type="hidden" name="detail_id[]" value="null">
                    <div class="row" id="row_employee_${employee_number}">
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label>Pilih karyawan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fad fa-user"></i>
                                    </div>
                                    </div>
                                    <select name="employee[]" id="employee_select_${employee_number}" class="form-control employee-select">
                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="form-group">
                                <label>Presentase</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fad fa-percentage"></i>
                                    </div>
                                    </div>
                                    <input type="number" name="precentage[]" id="employee_precentage_${employee_number}" onkeyup="calculatePrecentage(${employee_number})" placeholder="Input presentase" class="form-control precentage">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label>Hasil</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-money-check-alt"></i>
                                    </div>
                                    </div>
                                    <input type="text" disabled id="employee_nominal_${employee_number}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-12 pt-4">
                            <div class="form-group mt-1">
                                <label></label>
                                <a href="#" onclick="deleteEmployee(${employee_number})" class="btn btn-danger"><i class="far fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
            `;

            $('.employee-container').append(html);

            renderSingleEmployee(`employee_select_${employee_number}`);
        }

        const calculatePrecentage = (number_id) => {
            if ($('#employee_precentage_'+number_id).val() > 100 && event.keyCode !== 462 && event.keyCode !== 8) {
                event.preventDefault();     
                $('#employee_precentage_'+number_id).val(100);
                renderTotalPrecentage();
                if(total_precentage > 100){
                    Notiflix.Notify.Failure("Presentase melebih 100%");
                }
            }else{
                let nominal = parseInt($('#bonus-nominal-inp').val()) || 0;
                let precentage = $('#employee_precentage_'+number_id).val() || 0;
                let calculate = 0 ;
                if(precentage != null || precentage != ""){
                    renderTotalPrecentage();
                    if(total_precentage <= 100){
                        calculate  = parseInt(precentage)/100 * nominal;
                        var	number_string = calculate.toString(),
                            sisa 	= number_string.length % 3,
                            rupiah 	= number_string.substr(0, sisa),
                            ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                                
                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        $('#employee_nominal_'+number_id).val('Rp. '+calculate+',00');
                    }else{
                        Notiflix.Notify.Failure("Presentase melebih 100%");
                    }
                }else{
                    $('#employee_nominal_'+number_id).val('Rp. 0');
                }
            }

           
        }

        const renderTotalPrecentage = () => {
            let precentage_total = 0;
            $('.precentage').each(function(){
                let precentage = parseInt($(this).val()) || 0;
                precentage_total += precentage;
            });

            total_precentage = precentage_total;
            $('#total-precentage-text').text(total_precentage + ' %')

            if(total_precentage > 100){
                $('#submit-bonus').removeClass('btn-primary');
                $('#submit-bonus').addClass('btn-secondary');
                $('#submit-bonus').prop("disabled", true);
            }else{
                $('#submit-bonus').removeClass('btn-secondary');
                $('#submit-bonus').addClass('btn-primary');
              
                $('#submit-bonus').prop("disabled", false);
            }
        }

        const deleteEmployee = (number_id) => {

            event.preventDefault();
            if(employee_number > 1){
                $('#row_employee_'+number_id).remove();

                // employee_number = employee_number - 1;
            }
        }

        const deleteEmployeeDb = (id) => {
            event.preventDefault();
            let url = "/admin/salarybonus/delete/detail";
            Notiflix.Confirm.Show( 
                'Detail bonus Gaji',
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