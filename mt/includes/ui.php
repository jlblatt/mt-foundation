<div id="file-browser" class="reveal-modal" data-reveal>
  <h1>Choose an image...</h1>
  
  <div id="filesystem" data-url="/<?php echo $_mt['server_path']; ?>/ajax/filebrowser/" data-file-root="/<?php echo $_mt['server_path']; ?>/uploads/">
    <ul class="breadcrumbs"><li><a>uploads</a></li></ul>
    <div class="files">
      <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5"></ul>
    </div>
  </div>

  <p class="lead">Upload a new image:</p>
  
  <div id="file-upload">
    <div class="progress"><span class="meter"></span></div>
    <div class="input-wrapper">
      <h3 class="centered">Drop your images here or click to upload</h3>
      <input class="file-field" type="file" name="files[]" data-url="/<?php echo $_mt['server_path']; ?>/ajax/fileupload/" multiple>
    </div>
    <div class="results"></div>
  </div>
  
  <a class="close-reveal-modal">&#215;</a>
</div>

<div id="wallpaper-settings" class="reveal-modal" data-reveal>
  <h3>Wallpaper Preview:</h3>
  <div class="preview"><div class="overlay"></div></div>
  <div class="row controls">
    <div class="small-12 columns">
      <label>Opacity:</label>
      <div class="range-slider" data-slider data-options="end: 25;">
        <span class="range-slider-handle" role="slider"></span>
        <span class="range-slider-active-segment"></span>
        <input type="hidden" name="wallpaper-opacity">
      </div>
    </div>
  </div>
  <div class="actions">
    <a class="button save">Save</a>
    <a class="button secondary">Cancel</a>
  </div>
  <a class="close-reveal-modal">&#215;</a>
</div>