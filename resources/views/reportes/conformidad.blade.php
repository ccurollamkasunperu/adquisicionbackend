<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
@page { margin: 40px 35px 50px 35px; }
body { margin-top: 0px;font-family: Arial, sans-serif; font-size: 11px; color: #000; }

table { width: 100%; border-collapse: collapse; }
td, th { border: 1px solid #000; padding: 4px 6px; vertical-align: middle; }

.bold { font-weight: bold; }
.text-center { text-align: center; }
.text-right { text-align: right; }
.text-justify { text-align: justify; }
.upper { text-transform: uppercase; }
.bg-rosado { background-color: #ffffff; }
.bg-gris { background-color: #f2f2f2; }
.bg-griss { background-color:#f0f0f0; }

.header { width: 100%; border: none; margin-bottom: 5px; }
.header td { border: none; vertical-align: top; }
.header .logo-left { width: 90px; }
.header .logo-right { width: 100px; text-align: right; }
.subtitulo { font-size: 10px; }

h2 { text-align: center; margin: 0; font-size: 13px; font-weight: bold; }
h3 { text-align: center; margin: 0; font-size: 12px; font-weight: bold; }

.tablasino {
  border-collapse: collapse;
  margin: auto;
  font-size: 10px;
}

.padsino {
  padding: 2px 5px;
}

td {
  vertical-align: middle;
}

</style>
</head>
<body>

<!-- Encabezado con logos -->
<!-- Encabezado -->
<div style="position: relative; width: 100%; height: 80px; margin-bottom: 10px;">
  <img src="{{ public_path('images/imagensuperior.png') }}" style="position: absolute; top: 0; left: 0; width: 33%; object-fit: cover;">
  <div style="position: absolute; top: 0; left: 0; width: 100%; text-align: center; color: #000;">
    <!-- <div style="font-size:10px; padding-top:25px;">Programa de Empleo Temporal “Llamkasun Perú”</div> -->
    <div style="font-size:10px;padding-top:35px;">“Decenio de la Igualdad de Oportunidades para la Mujer y el Hombre”</div>
    <div style="font-size:10px;margin-bottom: 8px;">“{{ $data['noa_descri'] ?? '' }}”</div>
    <h2 style="margin: 5px 0 0 0; font-size: 14px;">ANEXO Nº 12</h2>
  </div>
</div>

<!-- Título general -->
<h3 style="text-align:center; margin-top:10px;margin-bottom:15px;">
  INFORME DE LA CONFORMIDAD DE LA PRESTACIÓN DE SERVICIO / RECEPCIÓN DE BIENES
</h3>


<table>
  <tr>
    <td rowspan="1" width="4%" class="text-center bold">1</td>
    <td width="26%" class="bold">FECHA DE EMISIÓN</td>
    <td class="text-center">{{ $data['cnf_fecemi'] ?? '' }}</td>
  </tr>
  <tr>
    <td class="text-center bold">2</td>
    <td class="bold">DEPENDENCIA USUARIA</td>
    <td>COORDINACIÓN FUNCIONAL DE ABASTECIMIENTO Y SERVICIOS GENERALES</td>
  </tr>
  <tr>
    <td class="text-center bold">3</td>
    <td class="bold">DATOS DEL CONTRATISTA</td>
    <td>
      <b>RAZÓN SOCIAL:{{ $data['prv_nomrso'] ?? '' }}</b><br>
      <b>RUC: {{ $data['prv_numruc'] ?? '' }}</b>
    </td>
  </tr>

  <!-- Datos del contrato -->
  <tr>
    <td class="text-center bold">4</td>
    <td class="bold">DATOS DEL CONTRATO</td>
    <td style="padding: 0px;">
      <table width="100%" style="border-collapse:collapse;">
        <tr>
          <td width="40%">Número del Contrato u Orden de Compra o Servicio</td>
          <td>ORDEN DE COMPRA N° {{ $data['ord_numero'] ?? '' }} <br>SIAF N° {{ $data['ord_nusiaf'] ?? '' }}</td>
        </tr>
        <tr>
          <td>Denominación de la Contratación</td>
          <td>{{ $data['ord_concep'] ?? '' }}</td>
        </tr>
        <tr>
          <td>Monto Total Contractual (S/)</td>
          <td>S/ {{ number_format($data['ord_montot'] ?? 0, 2) }}</td>
        </tr>
        <tr>
          <td>Monto de la Prestación Ejecutada (S/)</td>
          <td>S/ {{ number_format($data['cnf_monpre'] ?? 0, 2) }}</td>
        </tr>
        <tr>
          <td>N° de Producto / Entregable</td>
          <td>{{ $data['eor_descri'] ?? '' }}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<!-- VERIFICACIONES -->
<table style="width:100%; border-collapse: collapse; font-size:11px; font-family: Arial, sans-serif; margin-top:4px">
  <tr>
    <td rowspan="6" width="4%" class="text-center bold" style="border:1px solid #000;">5</td>
    <td colspan="3" width="96%" class="bold text-left" style="border:1px solid #000;">VERIFICACIONES REALIZADAS</td>
  </tr>

  <!-- 5.1 -->
  <tr>
    <td width="5%" class="text-center bold" style="border:1px solid #000;">5.1</td>
    <td width="55%" style="border:1px solid #000;">
      Cumplimiento de las prestaciones ejecutadas de acuerdo a lo señalado en los Términos de Referencia /
      Especificaciones Técnicas. (marcar con una “X”, según sea el caso)
    </td>
    <td width="41%" style="border:1px solid #000; padding:0;">
      <table style="width:100%; border-collapse: collapse; font-size:10px;">
        <tr>
          <td style="border:1px solid #000; width:70%; text-align:center;">SI CUMPLE</td>
          <td style="border:1px solid #000; text-align:center; width:30%; font-weight:bold;">
            {{ $data['chk_cumpre'] == 1 ? 'X' : '' }}
          </td>
        </tr>
        <tr>
          <td style="border:1px solid #000; text-align:center;">NO CUMPLE</td>
          <td style="border:1px solid #000; text-align:center; width:30%; font-weight:bold;">
            {{ $data['chk_cumpre'] == 0 ? 'X' : '' }}
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <!-- 5.2 -->
  <tr>
    <td class="text-center bold" style="border:1px solid #000;">5.2</td>
    <td class="bg-griss" colspan="2"></td>
  </tr>

  <!-- 5.3 -->
  <tr>
    <td class="text-center bold" style="border:1px solid #000;">5.3</td>
    <td style="border:1px solid #000;">
      Cumplimiento del plazo: <br>
      <span style="font-weight:bold;">(marcar con una “X”, según corresponda)</span>
    </td>
    <td style="border:1px solid #000; padding:0;">
      <table style="width:100%; border-collapse: collapse; font-size:10px;">
        <tr>
          <td style="border:1px solid #000; width:70%; text-align:center;">SI CUMPLE</td>
          <td style="border:1px solid #000; text-align:center; font-weight:bold;">
            {{ $data['chk_cumplz'] == 1 ? 'X' : '' }}
          </td>
        </tr>
        <tr>
          <td style="border:1px solid #000; text-align:center;">NO CUMPLE</td>
          <td style="border:1px solid #000; text-align:center; font-weight:bold;">
            {{ $data['chk_cumplz'] == 0 ? 'X' : '' }}
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="text-center bold" style="border:1px solid #000;">5.4</td>
    <td style="border:1px solid #000;">Confidencialidad del entregable</td>
    <td style="border:1px solid #000; padding:0; text-align:center; vertical-align:middle;">
      <div style="display: flex; justify-content: center; align-items: center;">
        <table style="width:40%; border-collapse: collapse; font-size:10px; margin:auto;" class="tablasino">
          <tr>
            <td class="padsino" style="border:1px solid #000; text-align:center;">SI</td>
            <td class="padsino" style="border:1px solid #000; text-align:center; font-weight:bold;">
              {{ $data['chk_conent'] == 1 ? 'X' : '' }}
            </td>
            <td class="padsino" style="border:1px solid #000; text-align:center;">NO</td>
            <td class="padsino" style="border:1px solid #000; text-align:center; font-weight:bold;">
              {{ $data['chk_conent'] == 0 ? 'X' : '' }}
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
  <tr>
    <td class="text-center bold" style="border:1px solid #000;">5.5</td>
    <td style="border:1px solid #000;">
      Custodia del Producto en el área usuaria: <br>
      <span style="font-weight:bold;">(marcar con una “X”)</span>
    </td>
    <td style="border:1px solid #000; padding:0; text-align:center; vertical-align:middle;">
      <div style="display: flex; justify-content: center; align-items: center;">
        <table style="width:40%; border-collapse: collapse; font-size:10px; margin:auto;" class="tablasino">
          <tr>
            <td class="padsino" style="border:1px solid #000; text-align:center;">SI</td>
            <td class="padsino" style="border:1px solid #000; text-align:center; font-weight:bold;">
              {{ $data['chk_cuprau'] == 1 ? 'X' : '' }}
            </td>
            <td class="padsino" style="border:1px solid #000; text-align:center;">NO</td>
            <td class="padsino" style="border:1px solid #000; text-align:center; font-weight:bold;">
              {{ $data['chk_cuprau'] == 0 ? 'X' : '' }}
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>

<!-- Observaciones -->
<table style="margin-top:5px;">
  <tr>
    <td rowspan="2" width="4%" class="text-center bold" style="border:1px solid #000;">6</td>
    <td width="96%"><b>OBSERVACIONES</b> (de ser el caso, podrán comunicar las observaciones realizadas)</td>
  </tr>
  <tr>
    <td>{{ $data['cnf_observ'] ?? '-' }}</td>
  </tr>
</table>

<!-- Conformidad -->
<table style="margin-top:5px;">
  <tr>
    <td rowspan="2" width="4%" class="text-center bold">7</td>
    <td width="96%"><b>CONFORMIDAD DE LA PRESTACIÓN</b></td>
  </tr>
  <tr>
    <td style="font-size: 9px;">{{ $data['cnf_presta'] ?? '' }}</td>
  </tr>
</table>

<!-- Firma -->
<table style="margin-top:15px;">
  <tr>
    <td rowspan="2" width="4%" class="text-center bold">8</td>
    <td class="text-center" style="padding:20px 0;"><br><br><br><br><br>
      <!-- <b>{{ $data['fun_nomcom'] ?? '' }}</b><br> -->
      {{ $data['ard_descri'] ?? '' }}<br>
      {{ $data['ent_razsoc'] ?? '' }}
    </td>
  </tr>
  <tr>
    <td style="font-size: 9px;" class="bold text-center">NOMBRE , FIRMA Y SELLO DEL FUNCIONARIO COMPETENTE</td>
  </tr>
</table>

<table style="margin-top:15px;">
  <tr>
    <td>
      <p style="font-size:9px;"><b>IMPORTANTE:</b><br> La recepción de la conformidad no enerva su derecho de reclamar posteriormente por defectos o vicios ocultos.</p>
    </td>
  </tr>
</table>

</body>
</html>
