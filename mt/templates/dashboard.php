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
        <div class="title"><strong>Lorem ipsum Cillum</strong><hr /></div>
        Lorem ipsum In magna pariatur Duis adipisicing nisi do dolore nulla ut deserunt in.
      </div>
      <div class="panel" data-dash-id="2">
        <div class="title"><strong>Lorem ipsum Cillum</strong><hr /></div>
        Lorem ipsum In magna pariatur Duis adipisicing nisi do dolore nulla ut deserunt in.
      </div>
    </div>
    <div class="small-12 medium-6 columns">
      <div class="panel" data-dash-id="3">
        <div class="title"><strong>Lorem ipsum Cillum</strong><hr /></div>
        Lorem ipsum In magna pariatur Duis adipisicing nisi do dolore nulla ut deserunt in.
      </div>
      <div class="panel" data-dash-id="4">
        <div class="title"><strong>Lorem ipsum Cillum</strong><hr /></div>
        Lorem ipsum In magna pariatur Duis adipisicing nisi do dolore nulla ut deserunt in.
      </div>
    </div>
  </div>
</div>
