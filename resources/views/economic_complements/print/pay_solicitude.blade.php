@extends('globalprint.print')

@section('formnumber')
Formulario Nº 4
@endsection

@section('content')

<div class="title2"><b>Registro: Nº {!! $economic_complement->code !!}</div>
<div id="project">
 <b>Señor (a) </b><br />
 <b>DIRECTOR (A) GENERAL EJECUTIVO</b><br />
 <b>MUTUAL DE SERVICIOS AL POLICIA</b><br />
 Presente.-<br /><br />
 <p><b>REF: SOLICITUD PAGO COMPLEMENTO ECONÓMICO {!! strtoupper($economic_complement->semester) !!} SEMESTRE DE LA GESTIÓN {!! Util::getYear($economic_complement->reception_date) !!} COMO BENEFICIARIOHABITUAL..................</b></p><br />

 <p>Distinguido (a) Director (a): </p>
 <p align="justify">La presente tiene por objeto solicitar a su autoridad pueda instruir por la unidad correspondiente hacerme el <b>PAGO DEL BENEFICIO DEL COMPLEMENTO ECONÓMICO DEL {!! strtoupper($economic_complement->semester) !!} SEMESTRE DE LA GESTIÓN {!! Util::getYear($economic_complement->reception_date) !!} </b>en razón que mi persona fue beneficiario en el semestre anterior.</p>
 <p>Para tal efecto, adjunto folder con los requisitos exigidos de acuerdo al siguiente detalle:</p>

 <table>
            <tr>
              <th class="grand">N°</th>
              <th class="grand">REQUISITOS</th>
              <th class="grand">ESTADO</th>

            </tr>
            <?php $i=1;?>
            @foreach($eco_com_submitted_document as $item)
            <tr>
                <td><center>{!! $i !!}</center></td>
                <td>{!! $item->economic_complement_requirement->shortened !!}</td>
                @if ($item->status == 1)
                      <td class="info"><center><img class="circle" src="{!! asset('img/check.png') !!}" style="width:70%" alt="icon"></center></td>
                @else
                <td class="info"> </td>
                @endif
            </tr>
            <?php $i++;?>
            @endforeach
</table>
 <p>Sin otro particular me despido de usted my atentamente. </p> <br /><br /><br /><br /><br />
    <table>
              <tr>
                  <th class="info" style="border: 0px;text-align:center;"><p>&nbsp;</p><br>----------------------------------------------------------------------</th>



              </tr>
              <tr>
                <th class="info" style="border: 0px;text-align:center;"><b>{!! $eco_com_applicant->getTitleNameFull() !!}<br />C.I. {!! $eco_com_applicant->identity_card !!} {!! $eco_com_applicant->city_identity_card->shortened !!} <br /> Telefono. {!! $eco_com_applicant->getPhone() !!}</b></th>

              </tr>
    </table>

</div>
@endsection
