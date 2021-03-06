<?php

if (!empty($_POST)):
    $requiredFields = array(
        "name" => "Name",
        "email" => "Email",
        "content" => "Content"
    );
    $errorMsg = "";
    foreach ($requiredFields as $key => $value) {
        if (empty($_POST[$key])) {
            $errorMsg .= $value . "is required";
        }
    }
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email address";
    }
    $to      = "micahliu153@gmail.com";
    $subject = "Contact from " . $_POST["email"];
    $message = "Name: " . $_POST["name"];
    $message .= "\nEmail: " . $_POST["email"];
    $message .= "\nContent: " . $_POST["content"];
    $headers = "From: " . $_POST["email"] . "\r\n" . "Reply-To: " . $_POST["email"] . "\r\n";
    mail($to, $subject, $message, $headers);

endif;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Contact From</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <div style="width:500px;margin-left:50px;">
    <h1>Contact Form </h1>
    <form data-toggle="validator" role="form" id="registration-form" method="POST" action="index.php">
  <div class="form-group">
    <label for="inputName" class="control-label">Name</label>
    <input type="text" class="form-control" id="inputName" placeholder="Cina Saffary" name="name" value="<?php echo $_POST['name']?>">
  </div>

  <div class="form-group">
    <label for="inputEmail" class="control-label">Email</label>
    <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email" data-error="Bruh, that email address is invalid" value="<?php echo $_POST['email']?>">
    <div class="help-block with-errors"></div>
  </div>
  <div class="form-group">
    <label for="inputContent" class="control-label" >Content</label>
    <textarea class="form-control" id="inputContent" rows="6" name="content"> <?php echo $_POST['content']?> </textarea>
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
  function handleErroMsg(element,errorMsg){
    if(errorMsg != ""){
      element.closest(".form-group").addClass("has-error")

      if(element.closest(".form-group").find(".help-block").length > 0){
        element.closest(".form-group").find(".help-block").html(errorMsg)

      }else{
        element.closest(".form-group").append('<span class="help-block">' + errorMsg + '</span>')
      }

      return false

    }else{
      element.closest(".form-group").find(".help-block").remove();
    }
  }
  function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
  $(document).ready(function() {
    
    $("#registration-form").submit(function(){
      valid = true
      var errorMsg = ""
      console.log($("#registration-form").attr('id'))
      if ($("#inputName").val()==""){
        errorMsg ="Name is required"
      }else if ($("#inputName").val().length < 2){
        errorMsg ="please enter at least 2 characters"
      }
      if (errorMsg!= ""){
        valid = false
      }
      console.log(errorMsg)
      handleErroMsg($("#inputName"),errorMsg)

      var errorMsg = ""
      if($("#inputEmail").val()==""){
        errorMsg = "Email is required"
      }else if (validateEmail($("#inputEmail").val())==false){
        errorMsg = "please enter a valid email address"

      }
      if (errorMsg !=""){
        valid = false
      }
      handleErroMsg($("#inputEmail"),errorMsg)

      var errorMsg = ""
      if($("#inputContent").val()==""){
         errorMsg = "content is required"
      }else if($("#inputContent").val().length<6){
        errorMsg ="content needs Minimum of 6 characters"
      }

      if (errorMsg !=""){
        valid = false
      }
      handleErroMsg($("#inputContent"),errorMsg)

      return valid
    })

  })
</script>
</body>
</html>
