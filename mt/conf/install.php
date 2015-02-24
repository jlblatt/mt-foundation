<?php 

$installSuccess = false;
$failedReason = "";

if(!$_mt['init'] && isset($_POST['install']))
{

  //sanitize where appropriate
  $_POST['tblprefix'] = preg_replace("/\W/", "", $_POST['tblprefix']);


  //check database credentials
  try
  {
    $conn = new PDO('mysql:host=' . $_POST['dbhost'] .';dbname=' . $_POST['dbname'], $_POST['dbuser'], $_POST['dbpass']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  catch (Exception $e)
  {
    $failedReason = "Could not connect to database.  Please check the credentials.";
  }

  if(isset($_POST['testdata']))
  {
    //create test table and load with test data
    try
    {
      $sql = str_replace('{{{prefix}}}', $_POST['tblprefix'], file_get_contents('conf/testdata/testdata.sql'));
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }

    catch(Exception $e)
    {
      $failedReason = "Could not load test data to database.";
    }

    //copy test template files into place
    @mkdir('uploads');
    $result = true;
    recurse_copy('conf/testdata/templates', 'templates');
    recurse_copy('conf/testdata/uploads', 'uploads');
    if(!$result) $failedReason = "Could not copy test template files.";

    //add navigation (need to migrate into testdata somehow)
    //$mainnav = 
      //'<li class="divider"></li><li><a href="/mt/artists/">Artists</a></li>' . 
      //'<li class="divider"></li><li><a href="/mt/albums/">Albums</a></li>' . 
      //'<li class="divider"></li><li><a href="/mt/songs/">Songs</a></li>';
    //$header = str_replace('<!--{{{mainnav}}}-->', $mainnav, file_get_contents('includes/header.php'));
    //$result = file_put_contents('includes/header.php', $header);

    //add dashboard panels (also in testdata somehow)

    //testdata js

    //testdata css
    
  }

  //rewrite .htaccess once in case user changed the base /mt/ directory
  $result = file_put_contents('.htaccess',"
      #begin mt rules
      <IfModule mod_rewrite.c>
          RewriteEngine On
          RewriteBase /{$_mt['server_path']}/

          RewriteRule ^index\.php$ - [L]

          RewriteCond %{REQUEST_URI} /+[^\.]+$
          RewriteRule ^(.+[^/])$ %{REQUEST_URI}/ [R=301,L]

          RewriteCond %{REQUEST_FILENAME} !-f
          RewriteCond %{REQUEST_FILENAME} !-d
          RewriteRule . /{$_mt['server_path']}/index.php [L]
      </IfModule>
      #end mt rules"
    );
  
  if($result === false) $failedReason = "Could not write to .htaccess.";

  //setup conf file
  $result = file_put_contents("conf/conf.php", "<?php
      //begin database conf
      \$_mt['dbhost'] = '{$_POST['dbhost']}';
      \$_mt['dbname'] = '{$_POST['dbname']}';
      \$_mt['dbuser'] = '{$_POST['dbuser']}';
      \$_mt['dbpass'] = '{$_POST['dbpass']}';
      \$_mt['tblprefix'] = '{$_POST['tblprefix']}';
      \$conn = new PDO('mysql:host=' . \$_mt['dbhost'] .';dbname=' . \$_mt['dbname'], \$_mt['dbuser'], \$_mt['dbpass']);
      //end database conf"
    );
  
  if($result === false) $failedReason = "Could not write to conf/conf.php.";
  
  //did we make it?
  if(!$failedReason) $installSuccess = true;
}

?>

<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="#">install mt</a></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>
</nav>

<div id="main">
  <div class="row">

    <div class="medium-2 large-3 columns">&nbsp;</div>

    <div class="medium-8 large-6 columns">

      <?php if($installSuccess): ?>
        <h4 class="text-center">Install success! Go to the <a href="/<?php echo $_mt['server_path']; ?>/">dashboard</a>.</h4>
      
      <?php elseif($_mt['init']): ?>
        <div data-alert class="alert-box warning">
          mt is already installed.  Delete conf/conf.php to reinstall.
        </div>

      <?php else: ?>
        <?php if($failedReason): ?>
          <div data-alert class="alert-box alert">
            <?php echo $failedReason; ?>
            <a href="#" class="close">&times;</a>
          </div>
        <?php endif; ?>
        <form method="post">
          <input type="hidden" name="install" />

          <label>Database Host
            <input type="text" name="dbhost" required 
              value="<?php if(isset($_POST['dbhost'])) echo htmlspecialchars($_POST['dbhost']); else echo 'localhost'; ?>" />
          </label>

          <label>Database Name
            <input type="text" name="dbname" required 
            <?php if(isset($_POST['dbname'])) echo 'value="' . htmlspecialchars($_POST['dbname']) . '"'; ?>/>
          </label>

          <label>Database Username
            <input type="text" name="dbuser" required 
            <?php if(isset($_POST['dbuser'])) echo 'value="' . htmlspecialchars($_POST['dbuser']) . '"'; ?> />
          </label>

          <label>Database Password
            <input type="password" name="dbpass" 
            <?php if(isset($_POST['dbpass'])) echo 'value="' . htmlspecialchars($_POST['dbpass']) . '"'; ?>/>
          </label>

          <label>Table Prefix [A-Za-z0-9_]
            <input type="text" name="tblprefix" 
            value="<?php if(isset($_POST['tblprefix'])) echo htmlspecialchars($_POST['tblprefix']); else echo 'mt_'; ?>" />
          </label>

          <label>
            <input type="checkbox" name="testdata" <?php if(isset($_POST['testdata'])) echo 'checked'; ?> />
            Load test data during install?
          </label>

          <p>&nbsp;</p>
          <p><strong>WARNING!</strong> Installing or reinstalling mt will permanently delete all current data with the same table prefix.</p>
          
          <input type="submit" value="Install" class="button" />
        </form>
      <?php endif; ?>
    </div>

    <div class="medium-2 large-3 columns">&nbsp;</div>

  </div>
</div>



<?php
//http://php.net/manual/en/function.copy.php#91010
function recurse_copy($src,$dst) {
  global $result;
  $dir = opendir($src);
  @mkdir($dst);
  while(false !== ( $file = readdir($dir)) ) {
    if (( $file != '.' ) && ( $file != '..' )) {
      if ( is_dir($src . '/' . $file) ) {
        recurse_copy($src . '/' . $file,$dst . '/' . $file);
      }
      else {
        $res = copy($src . '/' . $file,$dst . '/' . $file);
        if(!$res) $result = false;
      }
    }
  }
  closedir($dir);
}
?>