<div id="set-wallpaper" class="reveal-modal" data-reveal>
  <?php imageBrowser('wallpaper'); ?>
  <a class="close-reveal-modal">&#215;</a>
</div>

<?php function imageBrowser($id) { 

  global $_mt;
  $id = preg_replace("/[^\w\-\/]/", "", $id); ?>

  <h1>Choose an image...</h1>
  <p>No uploads yet!</p>
  <p class="lead">Upload a new image:</p>
  <form class="ajax-form-standard" action="/<?php echo $_mt['server_path']; ?>/ajax/postfile.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="formid" value="<?php echo $id; ?>" />
    <input type="file" name="imagefile" required />
    <input type="submit" value="Upload" class="button" />
  </form>
<?php } ?>