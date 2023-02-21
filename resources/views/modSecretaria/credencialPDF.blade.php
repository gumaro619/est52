<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
    .credencial{
      color: #000000;
      font-family: 'Source Sans Pro';
      background-color: #30c2db;
      width: 8.56cm;
      height: 5.398cm;
      position: relative;
      border-radius: 10px;
      overflow: hidden;
      z-index: 0;
    }

    .heading .logo, .heading .subtitle, .foto, img, .datos{
      position: absolute;
    }

    .heading .logo {
      letter-spacing: -0.4mm;
      top: -0.7cm;
      left: 0.6cm;
      font-size: 1cm;
    }

    .datos, .heading .subtitle{
      list-style: none;
    }

    .datos{
      color: #000000;
      bottom: 0.2cm;
      font-size: 0.29cm;
      font-weight: 600;
      left: -0.78cm;
      letter-spacing: 0.1mm
    }

    .heading .subtitle{
      font-size: 2.6mm;
      left: 2cm;
      line-height: 3mm;
      font-weight: 600;
      color: #000000;
      
    }

    img{   
        top: 50%;      
        transform: translate(-30.5%, -50.2%) scale(0.28);
      z-index: -1;
    }



    .foto{
      height: 3.005cm;
      width: 2.66cm;
      right: 0.2mm;
      top: 0.2mm;
      background-color: white;
    }
    .transaparente{
        
    }

  </style>
  <title>credencial</title>
</head>

  <body>
      <div class="credencial">
          <div class="heading">
            <h1 class="logo"><strong>E.S.T</strong></h1>
            <ul class="subtitle">
              <li>Escuela Secundaria</li>
              <li>Técnica</li>
              <li> No. 52</li>
            </ul>
          </div>
          
          <div class="foto">
            tu foto
          </div>
          <?php
              $nombreImagen = "imgs\logo.png";
              $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
  ?>
          
          <img src="<?php echo $imagenBase64 ?>" alt="">
        </div>
      <div>
          <div>-------------------------------------------------------------</div>
        <div class="credencial">
          <div class="heading">
            <h1 class="logo"><strong>E.S.T</strong></h1>
            <ul class="subtitle">
              <li>Escuela Secundaria</li>
              <li>Técnica</li>
              <li> No. 52</li>
            </ul>
          </div>
          
        
          
          
        
          <ul class="datos">
              <li>
                  {{  $datos[0]['curp'] }}
              </li>
              <li>
                  {{  $datos[0]['nombre'] }}
              </li>
              <li>
                ESTUDIANTE
              </li>
              <li>
                  {{  $datos[0]['grupo'] }}
              </li>
            </ul>
        </div>
      </div>
  </body>
</html>