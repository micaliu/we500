<?php require_once("layout/header.php") ?>
          <h1 class="page-header">Works</h1>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Website</th>
                  <th>Image</th>
                  <th>Position</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($works as $work):?>
                <tr>
                  <td><?php echo $work['id']?></td>
                  <td><?php echo $work['name']?></td>
                  <td><?php echo $work['link']?></td>
                  <td><img src="<?php echo $work['coverimage']?>" width="100" /></td>
                  <td><?php echo $work['position']?></td>
                  <td><?php echo $work['status'] ==1 ? "Enabled":"Disabled"?></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
            <a class ="btn btn-default" href="<?php echo BASEURL?>add.php" role="button">Add New Work </a>
          </div>
<?php require_once("layout/footer.php");?>
