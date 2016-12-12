<?php require_once("layout/header.php") ?>
<script>
  $(document).ready(function() {
    // validate signup form on keyup and submit
    $("#addWorkForm").validate();
  });
</script>
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