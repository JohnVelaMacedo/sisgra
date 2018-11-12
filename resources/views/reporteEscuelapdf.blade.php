<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Graduados</title>
    
    
</head>
<?php
use App\Persona;
$user = \Auth::user();  
        $user = $user->id;
        $p=Persona::where('DNI',$user)->first();
$Reporte = DB::select("SELECT g.DNI, g.Nombre, g.Telefono, g.Correo, g.AnioNacimiento, g.Genero, p.Nombre as pNombre,
                                ed.Nombre as deNombre, g.DistritoCiudad, g.Dirección, ec.descripcion, g.CantHijos,
                                 d.descripcion as dDescripcion, 
                                g.Ingreso, g.egreso, g.AnioBachiller, g.AnioTitulo
                                from graduado g
                                inner join departamentoestado ed ON ed.DepartamentoEstado = g.EstadoDepartamento
                                inner join estadocivil ec ON ec.id = g.EstadoCivil
                                inner join discapacidad d ON d.id = g.Discapacidad
                                inner join pais  p on p.idPais = g.PaisResidencia
                                where g.Escuela=".$p->idEscuela);
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
    <h1>Lista De Egresados</h1>
    <hr>
    {{-- g.DNI, g.Nombre, g.Telefono, g.Correo, g.AnioNacimiento, g.Genero, p.Nombre as pNombre,
                                ed.Nombre as deNombre, g.DistritoCiudad, g.Dirección, ec.descripcion, g.CantHijos,
                                 d.descripcion as dDescripcion, 
                                g.Ingreso, g.egreso, g.AnioBachiller, g.AnioTitulo --}}
    <table class="table table-striped" style="font-size:10px;">
     <tr class="tr" align="center">
        <td class="td">DNI</td>
        <td class="td">Nombres</td>
        <td class="td">Telefono</td>
        <td class="td">Correo</td>
        <td class="td">Pais Residencia</td>
        <td class="td">Direccion</td>
        <td class="td">Estado Civil</td>
        <td class="td">N° Hijos</td>
        <td class="td">Discapacidad</td>
        <td class="td">Ingreso</td>
        <td class="td">Egreso</td>
        <td class="td">Año Bachiller</td>
        <td class="td">Año Titulo</td>
     </tr>
     @foreach ($Reporte as $report)
        <tr>
            <td>{{$report->DNI}}</td>
            <td>{{$report->Nombre}}</td>
            <td>{{$report->Telefono}}</td>
            <td>{{$report->Correo}}</td>
            <td>{{$report->pNombre}}</td>
            <td>{{$report->Dirección}}</td>
            <td>{{$report->descripcion}}</td>
            <td>{{$report->CantHijos}}</td>
            <td>{{$report->dDescripcion}}</td>
            <td>{{$report->Ingreso}}</td>
            <td>{{$report->egreso}}</td>
            <td>{{$report->AnioBachiller}}</td>
            <td>{{$report->AnioTitulo}}</td>
        </tr>
     @endforeach  
        <tr>
            <td colspan="14" align="center">Numeo de Egresados: {{count($Reporte)}}</td>    
        </tr>   
    </table>
    </center>
</body>
</html>   