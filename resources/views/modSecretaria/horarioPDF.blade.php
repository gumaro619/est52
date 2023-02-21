<!DOCTYPE html>
<html lang="es">

	



<head>
	<meta charset="UTF-8">

	<title> Mi horario de clases</title>

<style>
            table.cal {
	
	min-height:600px;
	width:97%;
	color: #06425c;
	border-spacing:0;

	border-radius: 20px 20px 20px 20px;
	padding: 2%;
	margin: 2%;
}
table > caption {
	border: 5px solid  grey;
	
	border-radius: 15px;
	text-transform: uppercase;
	text-align: center;
	background-color: #008080;
	color: #ffffff;
	font-size: 50px; 
	padding:1% 1% 1% 1% ;
	margin:2% 2% 2% 2% ;
}
thead> tr > th {; background-color:#29a6F6; 
		border: 1px solid  white;
	border-radius: 10px ; height:50px;
	text-align:center;
	vertical-align:center;
font-size:25px;  margin: 1%; padding:1%;}

tr:nth-child(odd) {
	
	border-radius: 10px 10px 10px 10px;
	padding:1%;
	margin:1%;
}
tr:nth-child(even) {
		border-radius: 10px 10px 10px 10px;
	padding:1%;
	margin:1%;
}
tr:last-child {
	border-radius: 0 0 10px 10px;
	padding:1%;
	margin:1%;
}
tr:last-child > td:first-child {
	border-radius: 10px ;
	padding:1%;
	margin:1%;
}
tr:last-child > td:last-child {
	padding:1%;
	margin:1%;
	border-radius: 10px;
}

table.cal>tbody> th,td
 {
	display:in-line;	
		width:10%;margin: 2%;
	padding:2%;
	height:60px;
		border: 2px outset white;
	vertical-align:top;

	text-align: center;
	border-radius: 10px;
}
th {
	text-align: center;
	background: #ffffff;
	border: 2px outset grey;
}

.horas{
	margin: 0;
	padding: 0;
	background-color:#FFD180 ;
}

.Mates{ padding:0; margin:0; background-color: #FF8A80;}

span {
	display: block;
	text-align: center;
	color: #800000;
	
}
td:active > span {
	visibility: visible;
}

.datos{
	
	text-align: left;
	color: #000000;
}

.ti{
	background-color:#ffffff
}
</style>

</head>

<body>
	<table class="cal">
		<caption>ciclo {{  $datos[0]['ciclo'] }}</caption> 
		
		<thead>
			<tr>
				<th colspan="6"> Escuela secundaria tecnica numero 52</th>
			</tr>
			<tr class="ti">
				<th colspan ="6" class="datos" >Nombre: {{  $datos[0]['nombre'] }}
					<span class="datos">Grado y grupo: {{  $datos[0]['grupo'] }}</span>
				</th>
			</tr>
			<tr>
				<th></th>
				<th>Lun</th>
				<th>Mar</th>
				<th>Mié</th>
				<th>Jue</th>
				<th>Vie</th>

			</tr>

		</thead>

		<tbody>
			@foreach ($info as $clave => $valor)
				<tr>
					<td class="horas">{{$info[$clave]['hora']}} </td>
					<td class="Mates">{{$info[$clave]['lmat']}}<span>{{$info[$clave]['laula']}}</span><span>{{$info[$clave]['lp']}}</span></td>
					<td class="Mates">{{$info[$clave]['mmat']}}<span>{{$info[$clave]['maula']}}</span><span>{{$info[$clave]['mp']}}</span></td>
					<td class="Mates">{{$info[$clave]['mimat']}}<span>{{$info[$clave]['miaula']}}</span><span>{{$info[$clave]['mip']}}</span></td>
					<td class="Mates">{{$info[$clave]['jmat']}}<span>{{$info[$clave]['jaula']}}</span><span>{{$info[$clave]['jp']}}</span></td>
					<td class="Mates">{{$info[$clave]['vmat']}}<span>{{$info[$clave]['vaula']}}</span><span>{{$info[$clave]['vp']}}</span></td>

				</tr>
			@endforeach   
			
		</tbody>
	</table>

</body>
</html>