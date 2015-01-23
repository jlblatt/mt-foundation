<div id="set-wallpaper" class="reveal-modal" data-reveal>
  <?php imageBrowser(); ?>
  <a class="close-reveal-modal">&#215;</a>
</div>

<?php function imageBrowser() { 
  
  global $_mt; ?>

  <div class="file-browser">
    
    <h1>Choose an image...</h1>
    
    <div class="filesystem" data-url="/<?php echo $_mt['server_path']; ?>/ajax/filebrowser/" data-file-root="/<?php echo $_mt['server_path']; ?>/uploads/">
      <ul class="breadcrumbs"><li><a>uploads</a></li></ul>
      <div class="files"></div>
    </div>

    <p class="lead">Upload a new image:</p>
    
    <div class="file-upload">
      <div class="progress"><span class="meter" style="width: 0%"></span></div>
      <div class="input-wrapper">
        <h3 class="centered">Drop your images here or click to upload</h3>
        <input class="file-field" type="file" name="files[]" data-url="/<?php echo $_mt['server_path']; ?>/ajax/fileupload/" multiple>
      </div>
      <div class="results"></div>
    </div>
  
  </div>

<?php } ?>