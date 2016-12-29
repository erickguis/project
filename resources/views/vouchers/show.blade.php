@extends('app')

@section('contentheader_title')

	<div class="row">
		<div class="col-md-6">
			{!! Breadcrumbs::render('show_contribution', $affiliate) !!}
		</div>
        <div class="col-md-4">
            @if(!$voucher->payment_date)
                <div class="btn-group" style="margin:-6px 1px 12px;" data-toggle="tooltip" data-placement="top" data-original-title="Cobrar">
                    <a href="" data-target="#myModal-update" class="btn btn-raised btn-success dropdown-toggle enabled" data-toggle="modal">
                        &nbsp;<span class="glyphicon glyphicon-usd"></span>&nbsp;
                    </a>
                </div>
            @endif
        </div>
		<div class="col-md-2 text-right">

			<a href="{!! url('voucher') !!}" class="btn btn-raised btn-warning" data-toggle="tooltip" data-placement="top" data-original-title="Atrás">
				&nbsp;<span class="glyphicon glyphicon-share-alt"></span>&nbsp;
			</a>
		</div>
	</div>

@endsection

@section('main-content')

    <div class="row">
        <div class="col-md-6">
            @include('affiliates.simple_info')
            <div class="box box-info">
				<div class="box-header with-border">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="box-title"><span class="glyphicon glyphicon-list-alt"></span> Información de Cobro</h3>
                        </div>
                    </div>
                </div>
                <div class="box-body" style="font-size: 14px">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-responsive" style="width:100%;">
                                <tr>
                                    <td style="border-top:0px;border-bottom:1px solid #f4f4f4;">
                                        <div class="row">
                                            <div class="col-md-5">
                                                Concepto
                                            </div>
                                            <div class="col-md-7">
                                                {!! $voucher->voucher_type->name !!}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-top:0px;border-bottom:1px solid #f4f4f4;">
                                        <div class="row">
                                            <div class="col-md-5">
                                                Total Bs
                                            </div>
                                            <div class="col-md-7">
                                                {!! $voucher->total !!}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-responsive" style="width:100%;">
                                <tr>
                                    <td style="border-top:0px;border-bottom:1px solid #f4f4f4;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                Fecha Emisión
                                            </div>
                                            <div class="col-md-6">
                                                {!! $voucher->getCreationDate() !!}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-top:0px;border-bottom:1px solid #f4f4f4;">
                                        <div class="row">
                                            <div class="col-md-6">
                                            Fecha de Pago
                                            </div>
                                            <div class="col-md-6">
                                                @if($voucher->payment_date)
                                                    {!! $voucher->payment_date !!}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">

            @if($voucher->payment_date)
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Despliegue</h3>
                            </div>
                            <div class="panel-body">
                                <iframe src="{!! url('print_voucher/' . $voucher->id) !!}" width="99%" height="1200"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            {!! Form::model($voucher, ['method' => 'PATCH', 'route' => ['voucher.update', $voucher->id], 'class' => 'form-horizontal']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('Total', 'Total', ['class' => 'col-md-5 control-label']) !!}
                            <div class="col-md-6">
                                <h3>{!! $voucher->total !!}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('received', 'Recibido', ['class' => 'col-md-5 control-label']) !!}
                            <div class="col-md-3">
                                <input data-bind="value: received, valueUpdate: 'afterkeydown'" class="form-control" style="font-size:24px;"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('Cambio', 'Cambio', ['class' => 'col-md-5 control-label']) !!}
                            <div class="col-md-6">
                                <h3><span data-bind="text: change()"></span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::hidden('data', null, ['data-bind'=> 'value: ko.toJSON(model)']) !!}
                <div class="row text-center">
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-raised btn-success" data-toggle="tooltip" data-placement="bottom" data-original-title="Guardar">&nbsp;<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            @endif

        </div>
    </div>

@endsection

@push('scripts')
<script>

    function CalculationChange(voucher) {

        var self = this;

        self.received = ko.observable();
        self.change = ko.computed(function() {
            var rest = 0;
            if (self.received()) {
                rest = roundToTwo(parseFloat(self.received()) - parseFloat(voucher.total));
            }
            if (rest < 0) { rest = 0; };
            return rest ? rest : 0;
        });

    }
    window.model = new CalculationChange({!! $voucher !!});
    ko.applyBindings(model);

    function roundToTwo(num) {
        var val = +(Math.round(num + "e+2")  + "e-2");
        return num ? parseFloat(Math.round(parseFloat(val) * 100) / 100).toFixed(2) : 0;
    }

</script>
@endpush