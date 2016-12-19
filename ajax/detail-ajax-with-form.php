<?php 
require_once 'db_config.php';
require_once 'class.paging.php';
//fetch news from db

$sql = "select * from news where id = ?";
$stmt = $db->prepare($sql);
$stmt->execute(array($_GET["nid"]));

try{
	$news = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $exception){
	echo $exception->getMessage();
	die();
}


?>


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
		<h1><?php echo $news["title"]?></h1>
		<?php echo time()?>
		<div>
			<?php echo nl2br($news["content"])?>
		</div>
		
		<br/>
		<h4>Comments</h4>
     	
     	<div id="comments">
     		<img src="https://i0.wp.com/cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif"> Loading...
      	</div>
      	
      	<h4>Submit your comment</h4>
      	<p class="alert" id="notice"></p>
      	<form class="form-horizontal" id="comment-form" method="POST" action="submit_comment_ajax.php">
      	<input type="hidden" name="nid" value="<?php echo $_GET["nid"]?>" />
        <div class="form-group">
          <label for="inputName" >Name (required)</label>
         
            <input name="name" type="text" class="form-control" id="inputName" placeholder="Name" value="" requred  >
          
        </div>
        
        <div class="form-group">
          <label for="inputcontent" >Content</label>
         
            <textarea rows="5" cols="" id="comment-content"  class="form-control"  name="content" required></textarea>
         
        </div>

        <div class="form-group">
          <div >
            <button type="submit" class="btn btn-default">Submit</button>
            <span id="submitting" style="display: none"><img src="https://i0.wp.com/cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" width=30> Submitting...</span>
          </div>
        </div>
      </form>
     	
    </div><!-- /.container -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  
    <script>

    var loading = '<img src="https://i0.wp.com/cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif"> Loading...'
        
    function loadComments(page) {
    	$("#comments").html(loading)
        $.get("comments-ajax.php?nid=<?php echo $_GET["nid"]?>&page="+page,function(data){
        	$("#comments").html(data)
        })
    }
    $().ready(function() {
        loadComments(1)

        $("#comments").on("click","ul.pagination a",function(){
            var page = $(this).attr("data-page")
            loadComments(page)
			return false;
        })

        $("#comment-form").submit(function(){

			//disable submit btn
            $(this).find(".btn").attr("disabled",true)
            //display loading sign
            $("#submitting").show()
			
			//do ajax post
			//1. remote url, 2. form data, 3. callback function
			$.post($(this).attr("action"),$(this).serialize(),function(response){
				//enable btn
				$("#comment-form").find(".btn").removeAttr('disabled')
				//hide loading sign
				$("#submitting").hide()
				
				// check if success
				if(response == "s") {
					$("#notice").addClass("alert-success").removeClass("alert-danger").html("<strong>Success!</strong> Thank you.")
					loadComments(1)
					
					$("#inputName").val("")
					$("#comment-content").val("")
				} else {
					$("#notice").removeClass("alert-success").addClass("alert-danger").html("<strong>Error!</strong> Please try again.")
				}

				
				
			})
			
			return false
        })
		
    })
       
    </script>
   
  </body>
</html>
