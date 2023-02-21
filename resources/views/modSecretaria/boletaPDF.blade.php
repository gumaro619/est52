<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>Document</title>
    <style>
        .boleta{
    color: #000000;
    font-family: 'Source Sans Pro';
    background-color: #ffffff;
    width: 20cm;
                    
    flex-direction: column;
    position: relative;
    border: 1px;
    border-style: solid;
    border-color: #000000;
    overflow: hidden;
    z-index: 0;
}
.titulo{
    text-align: center;
}
table {
    table-layout: fixed;
    width: 100%;
    border-collapse: collapse;
    border: 2px solid rgb(0, 0, 0);
}
thead th, tfoot th {
    font-family: 'Rock Salt', cursive;
}

th {
    letter-spacing: 2px;
    border: 1px solid rgb(0, 0, 0);
}

td {
    letter-spacing: 1px;
    text-align: center;
    border: 1px solid rgb(109, 109, 109);
}

tbody td {
    text-align: center;
}

tfoot th {
    text-align: right;
}
.materias{
    width: 4cm;
}
.promedio{
    color: #000000;
    font-family: 'Source Sans Pro';
}
    </style>
</head>
    <body>
        <div class="boleta">
            <div class="titulo">
                    <H2>Escuela Secundaria Tecnica No. 52</H2>
                    <h3>Boleta de calificaciones</h3>
            </div>
            <div>
                <label for="">Nombre:</label>
                <label for="">{{  $datos[0]['nombre'] }}</label>
                <br>
                <label for="">Grado y grupo:</label>
                <label for="">{{$datos[0]['grado']}}</label>

            </div>
            <div>

                <table id="tablaBoleta" class="table" >

                    <tr>
                
                    <th class="materias">materia</th>
                
                    <th>Trimestre 1</th>
                
                    <th>Faltas</th>

                    <th>Trimestre 2</th>
                
                    <th>Faltas</th>

                    <th>Trimestre 3</th>
                
                    <th>Faltas</th>
                    <th>Promedio</th>
                    </tr>
                    
                @foreach ($info as $clave => $valor)
                    
                
                        
                    
                        <tr>
                        
                        
                        <td>{{$info[$clave]['materia']}}</td>
                    
                        <td>{{$info[$clave]['cal1']}}</td>
                    
                        <td>{{$info[$clave]['fal1']}}</td>
                        
                        <td>{{$info[$clave]['cal2']}}</td>
                    
                        <td>{{$info[$clave]['fal2']}}</td>

                        <td>{{$info[$clave]['cal3']}}</td>
                    
                        <td>{{$info[$clave]['fal3']}}</td>

                        <td>{{$info[$clave]['promedio']}}</td>
                        
                        </tr>
                        @endforeach   
                </table>
                <label class="promedio" for="">Promedio final:</label>
                <label class="promedio" for="">{{$datos[0]['final']}}</label>
            </div>
        </div>
    </body>
</html>