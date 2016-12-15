<?php require_once("layout/header.php") ?>

<h1 class="page-header">Add new Works</h1>
<form class="form-horizontal" id="addWorkForm" method="POST" action="<?php echo BASEURL ?>add.php" enctype="multipart/form-data">   <div class="has-error"><?php echo @$error?></div>
  <div class="form-group" >
    <label for="name" class="col-sm-2 control-label">Project Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name" name="name" placeholder="Project Name" value="" required>
    </div>
  </div>
  <div class="form-group">
    <label for="link" class="col-sm-2 control-label">Website Link</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="link" name="link" placeholder="Website Link" value="" required>
    </div>
  </div>
  <div class="form-group">
    <label for="link" class="col-sm-2 control-label">Overview</label>
    <div class="col-sm-10">
      <textarea id="overview" name="overview" class="form-control" rows="3" required> </textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="link" class="col-sm-2 control-label">Cover Image</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="coverimage" id="coverimage" >
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $("#moreimage-container").on("click",".addmore",function(){
        var unitToAppend = $(this).parent().clone()

        if (unitToAppend.find(".removeimage").length==0){
          unitToAppend.append(" <a class='removeimage'>remove</a>")
        }
        $("#moreimage-container").append(unitToAppend)

        if($(this).parent().find(".removeimage").length==0){
          $(this).text("remove").removeClass("addmore").addClass("removeimage")
        }else{
          $(this).remove()
        }
        if($("#moreimage-container .moreimage-unit").length == 5){
          $("#moreimage-container .moreimage-unit .addmore").remove()
        }

      })
      $("#moreimage-container").on("click",".removeimage",function(){
        $(this).parent().remove()
        if($("#moreimage-container").find(".addmore").length==0){
          $("<a class='addmore'>add more image</a>").insertBefore($("#moreimage-container .moreimage-unit").last().find(".removeimage"))
        }

        if($("#moreimage-container .moreimage-unit").length ==1){
          $("#moreimage-container .moreimage-unit .removeimage").remove()
        }
      })
    })
  </script>
  <div class="form-group">
    <label for="link" class="col-sm-2 control-label">More Image</label>
    <div class="col-sm-10" id="moreimage-container">
        <div class="moreimage-unit">
          <input type="file" class="form-control" name="moreimage[]">
          <a class="addmore">add more image</a>
        </div>
    </div>
  </div>

  <div class="form-group">
    <label for="position" class="col-sm-2 control-label">Position</label>
    <div class="col-sm-10">
       <input type="integer" class="form-control" id="position" name="position" value="1"  placeholder="Position" required>
    </div>
  </div> 

    <div class="form-group">
    <label for="status" class="col-sm-2 control-label">Status</label>
    <div class="col-sm-10">
       <select class="form-control" id="status" name="status">
      <option value="1">Enabled</option>
      <option value="0">Disabled</option>
    </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>

<?php require_once("layout/footer.php");?>