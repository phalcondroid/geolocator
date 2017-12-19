<!DOCTYPE html>

<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <title>KML Layers</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
      <?php
      //en el server dependiendo puede cambiar
      $urlDeMiLocalHost = "https://garlicsms.com/public/geolocator/uploads/cta.kml";

      //copiado de internet para subir archivos

      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //guardo en sesión para imprimir en java script
            $_SESSION["nombreDelArchivo"] = $_FILES["fileToUpload"]["name"];
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
      }
      ?>
    <form action="index.php" method="post" enctype="multipart/form-data" style="margin-bottom:100px; margin-top:100px;">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
    <div id="map"></div>
    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11,
          //-74.028764,4.768023,0
          center: {lat: 4.67, lng: -74.04}
        });

        var ctaLayer = new google.maps.KmlLayer({
          url: '<?php
            $ruta = isset($_SESSION["nombreDelArchivo"]) ? $_SESSION["nombreDelArchivo"] : "";
            echo $urlDeMiLocalHost . $ruta;
           ?>',
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlMjRNgM0JW_xnmW7nGG0XDa2EG6L-BzA&callback=initMap">
    </script>
  </body>
</html>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Localizador</title>
        <!-- Bootstrap core CSS
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="../js/fileinput.min.js" type="text/javascript"></script>
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <!-- Custom styles for this template
        <link href="css/clean-blog.min.css" rel="stylesheet">

    </head>
    <body>
        <!-- Navigation 
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="index.php"></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Procesar </a>
                        </li>   
                        <li class="nav-item">
                            <a class="nav-link" href="cargarKml.php">Kml </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header 
        <header class="masthead" style="background-image: url('img/home-bg.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                            <h1>GEOLOCALIZADOR</h1>
                            <span class="subheading">CONVIERTE Y VERIFICA LOS PUNTOS DE REFERENCIA</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-preview">
                        <h2 class="post-title">
                            Convertidor
                        </h2>
                        <p class="post-meta">Funcion Seleccionar el documento a procesar</p>
                        <div style="align-items: center">
                            <form action="control/upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input id="file-1"  name="myfile"  type="file" class="file" data-preview-file-type="any"/>
                                    <input id="file-1"  name="submit"  type="hidden" class="file" data-preview-file-type="any"/>
                                    <br/>
                                    <input name="enviar" type="submit" value="Importar" class="btn btn-success"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <hr>
        <!-- Footer
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <p class="copyright text-muted">Copyright &copy; Your Website 2017</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JavaScript
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/popper/popper.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <!-- Custom scripts for this template
        <script src="js/clean-blog.min.js"></script>
        <?php
        // put your code here
        ?>
    </body>
</html>
