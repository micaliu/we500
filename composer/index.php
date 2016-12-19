<?php 
require_once 'vendor/autoload.php';
use Imagine\Image\Box;

if(!empty( $_FILES["file"]["name"])){ 
	
	$tmpFile = $_FILES["file"]["tmp_name"];
	
	$imagine = new Imagine\Gd\Imagine();
	
	$image = $imagine->open($tmpFile);
	
// 	$image->resize(new Box(200, 200));
	
	$size    = new Box(100, 100);
	
	$mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
	// or
	$mode    = Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
	
	$image->thumbnail($size, $mode)->save("tmp/".time().".jpeg");

}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Contact Form</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    

    <div class="container">

      <div class="starter-template">
        <h1>Upload Form</h1>
       
      </div>
      <br/><br/><br/>
      <div class="col-xs-6">
   
      <form class="form-horizontal" id="contact-form" method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
          <label for="inputName" >Image</label>
         
            <input name="file" type="file" class="form-control"  >
          
        </div>
        

        <div class="form-group">
          <div >
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </div>
      </form>
    
    </div>
    </div><!-- /.container -->


  
  </body>
</html>