<div class="dashboard">

  <div class="row">
    <div class="small-12 columns no-drop">
      <?php 
        $greeting = "Hello";
        date_default_timezone_set('America/New_York');
        $localtime = localtime();
        if($localtime[2] < 4) $greeting = "Get to bed &#3232;_&#3232;";
        else if($localtime[2] >= 4 && $localtime[2] < 12) $greeting = "Good morning!";
        else if($localtime[2] >= 12 && $localtime[2] < 17) $greeting = "Good afternoon!";
        else if($localtime[2] >= 17) $greeting = "Good evening!";
      ?>
      <h1><?php echo $greeting; ?></h1><hr />
    </div>
  </div>

  <div class="row grid">
    <div class="small-12 medium-6 columns">
      <div class="panel callout" data-dash-id="1">
        <div class="title"><strong>Welcome to mt-foundation</strong> <i class="fa fa-smile-o"></i><hr /></div>
        <p>This project's goal was to create a framework for quickly setting up very simple custom CMS's, and to learn more about Zurb's <a href="http://foundation.zurb.com/" target="_blank">Foundation</a>.</p>
        <p>If you insalled the test data bundled with the project, you should be able to browse and edit a small collection of music I've scraped from <a href="http://www.discogs.com/" target="_blank">Discogs</a>.</p> 
        <p>Have fun, and visit <a href="https://github.com/jlblatt/mt-foundation" target="_blank">mt-foundation</a> on Github for more info.</p>
      </div>
    </div>
    <div class="small-12 medium-6 columns">
      
    </div>
  </div>
</div>
