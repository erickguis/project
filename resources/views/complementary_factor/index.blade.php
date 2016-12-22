@extends('app')

@section('contentheader_title')

    <div class="row">
        <div class="col-md-8">
            {!! Breadcrumbs::render('complementarity_factors') !!}
        </div>
        <div class="col-md-4 text-right">
            @can('manage')
                <a href="" data-target="#myModal-import" class="btn btn-raised btn-success dropdown-toggle" data-toggle="modal">&nbsp;
                    <i class="glyphicon glyphicon-import"></i>&nbsp;
                </a>
            @endcan
        </div>
    </div>

@endsection

@section('main-content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="panel-title">Caso Vejez</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="complementarity_factor_old_age-table">
                        <thead>
                            <tr class="warning">
                                <th>AÑO</th>
                                <th>Semestre</th>
                                <th><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="00 - GENERALES">GENERALES</div></th>
                                <th><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="01 - JEFES Y OFICIALES">JEFES Y OFICIALES</div></th>
                                <th><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="02 - JEFES Y OFICIALES ADMINISTRATIVOS">JEFES Y OFICIALES ADMTVOS.</div></th>
                                <th><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="03 - JEFES Y OFICIALES ADMINISTRATIVOS">SUBOFICIALES, CLASES Y POLICIAS</div></th>
                                <th><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="04 - SUBOFICIALES, CLASES Y POLICIAS ADMINSTRATIVOS">SUBOFICIALES, CLASES Y POLICIAS ADMTVOS.</div></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="panel-title">Caso Viudez</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="complementary_factor_widowhood-table">
                        <thead>
                            <tr class="warning">
                                <th>AÑO</th>
                                <th>Semestre</th>
                                <th><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="00 - GENERALES">GENERALES</div></th>
                                <th><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="01 - JEFES Y OFICIALES">JEFES Y OFICIALES</div></th>
                                <th><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="02 - JEFES Y OFICIALES ADMINISTRATIVOS">JEFES Y OFICIALES ADMTVOS.</div></th>
                                <th><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="03 - JEFES Y OFICIALES ADMINISTRATIVOS">SUBOFICIALES, CLASES Y POLICIAS</div></th>
                                <th><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="04 - SUBOFICIALES, CLASES Y POLICIAS ADMINSTRATIVOS">SUBOFICIALES, CLASES Y POLICIAS ADMTVOS.</div></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="box-header with-border">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Editar Factores de Complemantación</h4>
                </div>
                <div class="modal-body">

                    {!! Form::model($complementary_factor, ['method' => 'PATCH', 'route' => ['ipc_rate.update', $complementary_factor->id], 'class' => 'form-horizontal']) !!}
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                        {!! Form::label('month_year', 'Mes y Año', ['class' => 'col-md-5 control-label']) !!}
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker" name="month_year" value="{!! $complementary_factor->getMonthYearEdit() !!}">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                        {!! Form::label('index', 'Tasa IPC', ['class' => 'col-md-5 control-label']) !!}
                                    <div class="col-md-3">
                                        {!! Form::text('index', $complementary_factor->index, ['class'=> 'form-control', 'required' => 'required']) !!}
                                        <span class="help-block">Monto de IPC</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row text-center">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <a href="{!! url('ipc_rate') !!}" class="btn btn-raised btn-warning" data-toggle="tooltip" data-placement="bottom" data-original-title="Cancelar">&nbsp;<i class="glyphicon glyphicon-remove"></i>&nbsp;</a>
                                    &nbsp;&nbsp;
                                    <button type="submit" class="btn btn-raised btn-success" data-toggle="tooltip" data-placement="bottom" data-original-title="Guardar">&nbsp;<i class="glyphicon glyphicon-floppy-disk"></i>&nbsp;</button>
                                </div>
                            </div>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script type="text/javascript">

        $('.datepicker').datepicker({
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months",
            language: "es",
            orientation: "bottom right",
            autoclose: true
        });

        $(function() {
            $('#complementarity_factor_old_age-table').DataTable({
                "dom": '<"top">t<"bottom"p>',
                "order": [[ 0, "desc" ]],
                processing: true,
                serverSide: true,
                pageLength: 10,
                autoWidth: false,
                ajax: '{!! route('get_complementary_factor_old_age') !!}',
                columns: [
                    { data: 'year', sClass: "text-center" },
                    { data: 'semester', sClass: "text-center", bSortable: false },
                    { data: 'cf1', sClass: "text-right", bSortable: false },
                    { data: 'cf2', sClass: "text-right", bSortable: false },
                    { data: 'cf3', sClass: "text-right", bSortable: false },
                    { data: 'cf4', sClass: "text-right", bSortable: false },
                    { data: 'cf5', sClass: "text-right", bSortable: false }
                ]
            });
        });

        $(function() {
            $('#complementary_factor_widowhood-table').DataTable({
                "dom": '<"top">t<"bottom"p>',
                "order": [[ 0, "desc" ]],
                processing: true,
                serverSide: true,
                pageLength: 10,
                autoWidth: false,
                ajax: '{!! route('get_complementary_factor_widowhood') !!}',
                columns: [
                    { data: 'year', sClass: "text-center" },
                    { data: 'semester', sClass: "text-center", bSortable: false },
                    { data: 'cf1', sClass: "text-right", bSortable: false },
                    { data: 'cf2', sClass: "text-right", bSortable: false },
                    { data: 'cf3', sClass: "text-right", bSortable: false },
                    { data: 'cf4', sClass: "text-right", bSortable: false },
                    { data: 'cf5', sClass: "text-right", bSortable: false }
                ]
            });
        });

    </script>

@endpush