<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Graduados</title>
    
    
</head>
<?php
// var_dump($resultado);

?>
<style>
body{
  background-color:#FFFFFF;
  overflow:hidden;
  font-family: 'Raleway', sans-serif;
}

.main-wrap{
  padding:3%;
  max-width:1200px;
  display:block;
  margin: 10px auto;
}

.table.table-striped {
  width:100%;
    border-collapse: collapse;
      background: #fff;
    overflow: hidden;
    box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    -webkit-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    -o-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    -ms-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
}

.table.table-striped thead {
    background: #fff;
    box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
    -webkit-box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
    -o-box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
    -ms-box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
}

.table.table-striped th {
    padding: 0.9rem 0.5rem;
    font-weight: bold;
      border: 1px solid #efefef;
    text-align: left;
    border-top: 0px;
}

.table.table-striped tbody tr:nth-child(odd){
    background-color: rgba(0,0,0,.02);
}

.table.table-striped tbody tr td a {
    color: #3c2f17;
    font-size: 4px;
    text-decoration:none;
  font-weight:500;
}

.table.table-striped tr:nth-child(even) {
    background-color: #fff;
}

.table.table-striped tbody tr td {
    border: 1px solid #efefef;
    padding: 0.7rem;
    text-align: left;
    border-top: 0px;
}

.ftr{
    text-align: center;
    margin-top: 20px;
    font-weight: bold;
}

.ftr a{
    color: #fff;
}
</style>
<body>
    <center>
    <h2>Lista De Graduados {{$fac}}</h2>
    <hr>
    
    <table class="table table-striped" style="font-size:10px;">
     <tr class="tr" align="center" style="background-color: #C4BEBD">
        <td class="td">Escuela</td>
        <td class="td">DNI</td>
        <td class="td">Nombres</td>
        <td class="td">Telefono</td>
        {{-- <td class="td">Correo</td> --}}
        <td class="td">Pais Residencia</td>
        <td class="td">Departamento</td>
        <td class="td">Distrito</td>
        <td class="td">Direccion</td>
        <td class="td">Estado Civil</td>
        <td class="td">N° Hijos</td>
        <td class="td">Discapacidad</td>
        <td class="td">Ingreso</td>
        <td class="td">Egreso</td>
        <td class="td">Año Bachiller</td>
        <td class="td">Año Titulo</td>
     </tr>
     @foreach ($resultado as $report)
        <tr>
            <td>{{$report->escuela}}</td>
            <td>{{$report->DNI}}</td>
            <td>{{$report->Nombre}}</td>
            <td>{{$report->Telefono}}</td>
            {{-- <td>{{$report->Correo}}</td> --}}
            <td>{{$report->pais}}</td>
            <td>{{$report->departamento}}</td>
            <td>{{$report->DistritoCiudad}}</td>
            <td>{{$report->Dirección}}</td>
            <td>{{$report->estadocivil}}</td>
            <td>{{$report->CantHijos}}</td>
            <td>{{$report->discapacidad}}</td>
            <td>{{$report->Ingreso}}</td>
            <td>{{$report->egreso}}</td>
            <td>{{$report->AnioBachiller}}</td>
            <td>{{$report->AnioTitulo}}</td>
        </tr>
     @endforeach 
        <tr style="text-align: right!important;font-size: 14px!important">
            <td colspan="15"><b>Cantidad de Graduados: {{count($resultado)}}</b></td>    
        </tr>   
    </table>
    </center>
</body>
</html>   