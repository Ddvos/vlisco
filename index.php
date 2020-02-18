<?php
/**
 * Created by PhpStorm.
 * User: Dominique
 * Date: 2-11-2020
 * Time: 15:05
 */
//include('session.php');

include("config.php");


$inputCode = 1;
$postMade = false;
$videoResult = 'none';

//This is input from the input field when form submit
if(isset($_POST['submit'])) {
  $inputCode = $_POST['inputCode'];
  echo("<script>console.log('button pressed');</script>");
  $postMade = true;
 
}

// looks if there is some input if not there is a message
if($inputCode == null || $inputCode == '' ){
  $inputZero ="block";
  $result='none';
}
else{
  $inputZero ="none";
}


// count files in video folder
$directory = "videos/";
$filecount = 0;
$files = glob($directory . "*");

if ($files){
 $filecount = count($files);
}


$path = "videos/"; // is the locations of the videos
$result = "none"; // shows a message when your video isnt found

// loops trough the number of files in the folder for example 3 
for ($i = 0; $i <= $filecount; $i++){

    foreach (scandir($path) as $file) {
      
      // removes the extensions from the files found
      $file= pathinfo($file, PATHINFO_FILENAME);

      if( $inputCode == $file){
        echo("<script>console.log('file is ".$file." found');</script>");
        $result='none';
        $videoResult = 'block';
        $i=$filecount +1;
      break;
      } 

      if( $i == $filecount){
          echo("<script>console.log('file is not found');</script>");
          if($postMade == true){
            $result='block';
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

    <title>Download your video</title>
  </head>
  <body>
      
  <header>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <strong>vlisco</strong>
      </a>
    </div>
  </div>
</header>

<main role="main">

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="font-weight-light">Find your video!</h1>
        <p class="lead text-muted">Fill in your code and download your video.</p>
        <p>
          <!-- <a href="/uploadwebsite/videos/'+id+'.mp4" class="btn btn-primary my-2" download>Download</a> -->
          <a href=""  onclick="this.href = <?php echo $inputZero; ?>" download hidden></a>  

          <form action="index.php" method="post">
            
            <div class="form-group mx-sm-3 mb-2">
              <label for="inputCode" class="sr-only"></label>
              <input type="text" class="form-control" id="inputCode" name="inputCode" placeholder="Fill here your code in">
            </div>
          
            <div id="removeMessage">
              <div class="alert alert-danger" role="alert" style="display: <?php echo $inputZero; ?>  ;">
                    Please enter a code
              </div>

              <div class="alert alert-danger" role="alert" style="display: <?php echo $result; ?>  ;">
                    Sorry your video isn't found, perhaps you entered the wrong code
              </div>
              </div>
            

            <input type="submit" class="btn btn-primary" name="submit"  value="Search" onclick="showInput()"/>
            
          </form>

        </p>
      </div>
    </div>
  </section>

  
  
<div class="showOnSearch" style="display: <?php echo $videoResult; ?>  ;">
 <div class="container">
 <div class="row">
   Share your video with your friends

   <a href="https://web.whatsapp.com/send?text=checkThisVideo" data-text="Take a look at this awesome website:" data-href="/uploadwebsite/videos/A1.mp4" class="wa_btn wa_btn_s" style="display:block">
   <button type="button" class="btn btn-primary">share whatsapp</button>
   </a>
  
  
 </div>
 <div class="row">
        <video width="100%" height="auto" controls>
            <source id="videoCode" src="/uploadwebsite/videos/<?php echo $inputCode; ?>.mp4" type="video/mp4">  
        </video>

       

        <a href="/uploadwebsite/videos/<?php echo $inputCode; ?>.mp4" value="Download2"  download>
        <button type="button" class="btn btn-primary">Download</button>
        </a>
      </div>
      
    </div>
  </div>


  <div class="album py-5 bg-light">

  </div>

</main>

<footer class="text-muted py-5">
  
</footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>


        function showInput() {
          //console.log("Download button preset"); 

          var code = document.getElementById("videoCode").value;
          console.log(code);

            if(code == null || code == ''){

            }
              else{
                /// This link should be changed to the right link
                url = '/uploadwebsite/videos/'+code+'.mp4'
                document.getElementById('download').click();  
              }                 
            
          }

          function removeWarning() {
              document.getElementById("removeMessage").innerHTML = "";
          }

          document.getElementById("inputCode").onkeyup = removeWarning;
    </script>

    <style  scoped>

      .btn-primary{
        margin: 40px;

      }
    </style>

  </body>
</html>
