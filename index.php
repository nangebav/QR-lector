<?php

namespace Zxing;

require("vendor/autoload.php");

$qrcode = new QrReader($_FILES['qrimage']['tmp_name']);

$text= $qrcode->text();



?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<title>Decodificar códigos QR con PHP</title>


<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"crossorigin="anonymous">

<script src="https://kit.fontawesome.com/11badbbafe.js" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"crossorigin="anonymous"></script>

<link rel="stylesheet"type="text/css"href="qr.css">

</head>

<body class="bg">

<!-- Camara -->

<!-- Imagen QR -->
<div class="container">
<h1>Lector QR</h1>
  <br><br><br>
  <div class="row">


    <div class="col-md-6 offset-md-3 card">

      <div>
        <h3> <i class="fa-solid fa-camera"></i> Escanear QR con cámara  </h3>
        <hr>
          <center>

            <img src="images\not-camera.png" alt="not-camera" id="notcamera" width="300px" />

            <video id="preview" width="300px" hidden="true" ></video>

            <br><br>
          
            <div class="row">
              <button id="apagar" class="btn btn-md btn-block btn-info" > Apagar <i class="fa-solid fa-camera-slash"></i> </button>
              <button id="encender" class="btn btn-md btn-block btn-info" > Prender <i class="fa-solid fa-camera"></i></button>
            </div>

          </center>

          <input type="text" name="text"id="text" readonyy="" placeholder="QR" class="form-control"/>
      </div>


    </div>

    <div class="col-md-6 offset-md-3 card">
      <div class="panel-heading">
        <h3><i class="fa-solid fa-image"></i> Subir imagen QR </h3>
      </div>
      <hr>
      <form method="post" enctype="multipart/form-data">
        <input type="file" name="qrimage" id="qrimage" class="form-control" required="" ><br>
        <input type="submit" class="btn btn-md btn-block btn-info" value="Leer QR" name="">
      </form>

      <br>
      <span></span>

      <input type="text" value='<?php echo $text; ?>'  class="form-control" placeholder="QR"/>

    </div>
    
    

  </div>
</div>

<script type="text/javascript">



  /* Función Camara */
      let estateCamera = ""

      const buttonA = document.getElementById('apagar');

      buttonA.addEventListener("click", function() {
        scanner.stop()

        document.getElementById('notcamera').hidden = false;
        document.getElementById('preview').hidden = true;

      });

      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

      const buttonE = document.getElementById('encender');
      buttonE.addEventListener("click", function() {
          Instascan.Camera.getCameras().then(function (cameras) {
          if (cameras.length > 0) {
            scanner.start(cameras[0]);
            document.getElementById('notcamera').hidden = true;
            document.getElementById('preview').hidden = false;

          } else {
            console.error('No cameras found.');
          }
        }).catch(function (e) {
          console.error(e);
        });

      });

      scanner.addListener('scan', function (content) {
        document.getElementById('text').value=content;
    });

      
    </script>

</body>


