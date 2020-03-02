<?php
/**
 * Created by PhpStorm.
 * User: Dominique
 * Date: 2-11-2020
 * Time: 15:05
 */
//include('session.php');

include("config.php");


// loops trough the jsonn filew 






$inputCode = 1;
$postMade = false;
$videoResult = 'none';  // determined if the video output is vissible 
$inputEquealArray = false; 
$videoArray = 'none';   // meassge video in array but not uploaded yet
$searhElement = 'block'; // hide when video is found  

//This is input from the input field when form submit
if(isset($_POST['submit'])) {
  $inputCode = $_POST['inputCode'];
  // echo("<script>console.log('button pressed');</script>");
  $postMade = true;
  

  $fileJsonContent = file_get_contents("http://www.vliscowm2020.com/8000_codes.json"); // change file so php can understand 
  $obj = json_decode($fileJsonContent, TRUE);

  // loops trough array of codes and looks if it is equal to the input
  foreach($obj as $item) 
  {
    if(strcasecmp($inputCode, $item) ==0){ // strcasecmp makes it independent capital or small letters
      $inputEquealArray = true; 
    }
  }
 
}

// looks if there is some input if not there is a message "please enter a code"
if($inputCode == null || $inputCode == '' ){
  $inputZero ="block";
  $result='none';
  $videoResult = 'none';
}
else{
  $inputZero ="none";
}


// count files in video folder
$directory = "../videos/";
$filecount = 0;
$files = glob($directory . "*");

if ($files){
 $filecount = count($files); // is the total files found in the folder
}


$path = "../videos/"; // is the locations of the videos
$result = "none"; // shows a message when your video isnt found

// loops trough the number of files in the folder for example 3 
for ($i = 0; $i <= $filecount; $i++){

    foreach (scandir($path) as $file) {
      
      // removes the extensions from the files found
      $file= pathinfo($file, PATHINFO_FILENAME);

      if(strcasecmp($inputCode,$file) ==0){ // checks if input is equal to videos in video folder, capital or small letters 
        // echo("<script>console.log('file is ".$file." found');</script>");
        $result='none';

        $inputCode = $file;
        
        if($inputZero =="block"){// checks if there is any input if not then the video div is hidden 
          $videoResult = 'none';
        }else{
          $videoResult = 'block';
          $searhElement= 'none'; // search element will be hidden 
        }
        
        $i=$filecount +1;
        break;
      } 

      // input is not eguaql to videos found, but is to video array show message: video will upload later
      if( $i == $filecount && $inputEquealArray == true ){
        
        if($postMade == true){
          // echo("<script>console.log('Your video code is found');</script>");
          $result='none';
          $videoArray = 'block';
          $videoResult = 'none';
        }
      break;
    } 
      // your video is not found and will never exist
      if( $i == $filecount){
         
          if($postMade == true){
            // echo("<script>console.log('file is not found');</script>");
            $result='block';
            $videoResult = 'none';
          }
        break;
      }      
    }
}

  
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.plyr.io/2.0.15/plyr.css">
    <link rel="stylesheet" type="text/css" href="/css/custom.css">

    <title>Vlisco – Installation Mois de la femme Vlisco</title>
  </head>
  <body>
      
  <header>
    <div class="container">
      <div class="logo">
        <a class="logo" href="https://www.vlisco.com">
          <img src="http://www.vliscowm2020.com/img/VLISCO_LOGO.jpg" alt="Vlisco" width="150">
        </a>
      <div>
      <p class="translateButton">
          <a class="english" href="http://www.vliscowm2020.com/">EN</a>
          <a class="french" href="http://www.vliscowm2020.com/fr">FR</a>
      </p>
    </div>
</header>

<main role="main">
  <section class="py-5 text-center container" style="display: <?php echo $searhElement; ?>  ;">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="videoText">Trouvez votre vidéo</h1>
        <p class="lead text-muted">Saisissez votre code et téléchargez votre vidéo</p>
        <p>
          <!-- <a href="/uploadwebsite/videos/'+id+'.mp4" class="btn btn-primary my-2" download>Download</a> -->
          <a href=""  onclick="this.href = <?php echo $inputZero; ?>" download hidden></a>  

          <form action="http://www.vliscowm2020.com/fr/" method="post">
            
            <div class="form-group mx-sm-3 mb-2">
              <label for="inputCode" class="sr-only"></label>
              <input class="inputField"type="text" class="form-control" id="inputCode" name="inputCode" placeholder="Saisissez votre code" maxlength="4">
            </div>
          
            <div id="removeMessage">
              <div class="alert alert-danger" role="alert" style="display: <?php echo $inputZero; ?>  ;">
                      Merci de saisir un code
              </div>

              <div class="alert alert-danger" role="alert" style="display: <?php echo $result; ?>  ;">
                      Le code saisi n’est pas valide, merci de réessayer
              </div>

              <div class="alert alert-danger" role="alert" style="display: <?php echo $videoArray; ?>  ;">
                        Votre vidéo n’a pas encore été mise en ligne! Merci de réessayer ultérieurement
              </div>
              </div>
            

            <input type="submit" class="btn btn-primary" name="submit"  value="Rechercher" onclick="showInput()"/>
            
          </form>

        </p>
      </div>
    </div>
  </section>

  
  
<div class="showOnSearch" style="display: <?php echo $videoResult; ?>  ;">
 <div class="container">
  <div class="row">
  <!-- <video  controls="controls" height="auto" preload="auto" src="https://stud.hosted.hr.nl/0931703/vlisco/videos/<?php echo $inputCode; ?>.mp4" style="object-fit: contain;" width="600" playsinline></video> -->
    <div class="videoElement">
      <video  width= "100%" height="auto" auto id="plyr-video" poster="http://www.vliscowm2020.com/img/THUMBNAIL_PLACEHOLDER.jpg"  controls playsinline>
              <source id="videoCode" src="http://www.vliscowm2020.com/videos/<?php echo $inputCode; ?>.mp4" type="video/mp4">  <!-- "/uploadwebsite/videos/<?php echo $inputCode; ?>.mp4"   "https://stud.hosted.hr.nl/0931703/vlisco/videos/<?php echo $inputCode; ?>.mp4" -->
      </video>
      <br>
    </div>
  </div>
  <div class="row">
  <div class="button">  
      <a  href="videos/<?php echo $inputCode; ?>.mp4" download>
          <button type="button" class="btn btn-primary">Télécharger</button>
      </a>
  </div>  
  </div>   
    
 
  <br>
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
      <br>
      <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">

           
              <a class="show-mobile" href="https://api.whatsapp.com/send?text=http://www.vliscowm2020.com/videos/<?php echo $inputCode; ?>.mp4" data-action="share/whatsapp/share">
                  <img src="http://vliscowm2020.com/img/whatsapp.png" alt="whatsapp_logo" width="32" height="22.72">
              </a>
           
              <a class="hide-mobile" href="https://web.whatsapp.com/send?text=http://www.vliscowm2020.com/videos/<?php echo $inputCode; ?>.mp4">
                  <img src="http://www.vliscowm2020.com/img/whatsapp.png" alt="whatsapp_logo" width="32" height="22.72">
             </a>
          
            <a href="https://www.facebook.com/sharer/sharer.php?u=http://www.vliscowm2020.com/videos/<?php echo $inputCode; ?>.mp4" target="_blank" rel="noopener">
              <img src="http://www.vliscowm2020.com/img/facebook.png" alt="facebook_logo" width="32" height="32">
            </a>
            <a href="https://twitter.com/intent/tweet?url=URL&text=http://www.vliscowm2020.com/videos/<?php echo $inputCode; ?>.mp4" target="_blank" rel="noopener">
              <img src="http://www.vliscowm2020.com/img/twitter.png" alt="twitter_logo" width="32" height="32">
            </a>
          </div>
          <div class="col-sm-2"></div>
        </div>
       </div>
    <div class="col-sm-2"></div>
  </div>


  </div>
</div>






  

</main>

<footer class="footer">
    <H1 class="footerLink">
      <a  class="footerLink" href="https://twitter.com/vlisco" >#VLISCOWOMENSMONTH2020</a>
    </H1>
</footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.plyr.io/2.0.15/plyr.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
     
    

      // makes de video element plyr.io rady 
     plyr.setup("#plyr-video", {captions: {active: false}});
 


          function removeWarning() {
              document.getElementById("removeMessage").innerHTML = "";
          }

          document.getElementById("inputCode").onkeyup = removeWarning;

        
    </script>

    <style  scoped>

@font-face {
      font-family: 'Avenir-Next1';
        src: url("http://www.vliscowm2020.com/fonts/Avenir-Next.ttc");
      }

      @font-face {
      font-family: 'AvenirNextLTW01-medium';
        src: url("http://www.vliscowm2020.com/fonts/avenir-medium.ttf");
    
      }

      @font-face {
      font-family: 'AvenirNextLTW01-regular';
        src: url("http://www.vliscowm2020.com/fonts/avenir-regular.ttf");
    
      }

      .main{
        font-family: 'AvenirNextLTW01-Medium';
        width:   100%;
        height:  100%;
        margin:  auto;
      }

      .row.py-lg-5 {
        font-family: 'AvenirNextLTW01-regular';
        height:  60%;
        margin:  auto;

      }
      .col-lg-6.col-md-8.mx-auto{
        height:  40%;
        margin:  auto;
      }

    .logo{
      margin-top: 40px;
      text-align: center;
    }

    .translateButton{
      color: #000000;
      font-family: 'AvenirNextLTW01-regular';
      font-weight: 500;
      text-align: center;
      margin-top: 20px;
     
    }

    .translateButton a:link {
      text-decoration: none;
    }

    .translateButton a:hover{
      color: #000000; 
    }

    .english{ 
      font-weight: 500;  
      color: #808c96;  
    }

    .french{
      font-weight: 500;
      color: #000000; 
    }

   
    .videoText{
      font-family: 'AvenirNextLTW01-medium';
    }

    .text-muted{
      font-family: 'AvenirNextLTW01-regular';
    }

    .alert{
      font-family: 'AvenirNextLTW01-regular';
    }

    .btn-primary{
      background-color: #333;
      border-color: #333;
    }
    .btn-primary:hover{
      background-color: #808c96 !important;
      border-color: #808c96 !important;
    }

    .btn-primary:focus{
      background-color: #808c96 !important;
      border-color: #808c96  !important;
    }

    .footer{
      
      font-weight: 600;
      text-align: center;
      margin-top: 20px;
    }

    .footerLink{
      color: #000000;
      font-family: 'AvenirNextLTW01-medium';
    }

    .footerLink a:link {
      text-decoration: none;
    }


    .button{
    
      margin: auto;
      }

      .inputField{
        text-align: center;
        min-width: 250px;
      }

  
    a:hover {
    color: #808c96;
    }


      .pb-5, .py-5 {
          padding-bottom: 0px;
      }


     @media (min-width: 600px) {

       .videoElement{
        max-width: 500px;
        margin:  auto;
        
      }  
        .show-mobile {
          display: none;
          max-width: 32px;
        }
        .hide-mobile {
          display: inline;
          max-width: 32px;
         
        }
        .btn-primary{
          min-width: 180px;
        margin: auto;

        }
        .col-sm-8{
          text-align: center;
        }

        .button{
          min-width: 180px;
          margin-right: 80px;
      
      width: 50%;
      }

        
      }
      @media (max-width: 600px) {

      
    .videoElement{
        margin: 20px;
        width: 100%;
        height: auto;
        
      } 
      .show-mobile {
        display: inline;
        max-width: 32px;
      }
      .hide-mobile {
        display: none;
        max-width: 32px;
      }
      .col-sm-8{
          text-align: center;
        }
      .button{
        min-width: 180px;
        margin: auto;
      width: 50%;
      }

      .footer{
        font-size: 20px;
      font-weight: 600;
      text-align: center;
      margin-top: 20px;
    }

    .footerLink{
      font-size: 17px;
      color: #000000;
    }
    }

 
    </style>

  </body>
</html>
