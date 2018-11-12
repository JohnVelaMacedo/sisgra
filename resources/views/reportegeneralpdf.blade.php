<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Graduados</title>
    
    
</head>
<?php
$Reporte = DB::select("CALL `SP_MostrarCantidadPorEscuelaAnio`()");
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
    font-size: 12px;
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
    <h1>Universidad Nacional de ucayali</h1>
    <p><img src="assets/img/unu.png" height="80" width="60"></p>
    <h2>Lista De Graduados General</h2>
    
    <hr>
    <table class="table table-striped">
     <tr class="tr" align="center">
        <td class="td">Año Bachiller</td>
        <td class="td">Facultad</td>
        <td class="td">Escuela</td>
        <td class="td">Cantidad</td>
        
     </tr>
     @foreach ($Reporte as $report)
        <tr>
            <td>{{$report->bach}}</td>
            <td>{{$report->facu}}</td>
            <td>{{$report->esc}}</td>
            <td>{{$report->cant}}</td>
        </tr>
     @endforeach     
    </table>
    </center>
</body>
</html>   