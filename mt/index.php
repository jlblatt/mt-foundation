<?php require_once("conf/bootstrap.php"); ?><!doctype html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimal-ui">

    <title><!--TITLE--></title>
    
    <script src="/<?php echo $_mt['server_path']; ?>/js/vendor/modernizr.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/vendor/jquery.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/vendor/jquery.cookie.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/vendor/jquery-ui.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/vendor/fastclick.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/vendor/placeholder.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/vendor/foundation.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/main.js" defer></script>

    <link rel="stylesheet" href="/<?php echo $_mt['server_path']; ?>/css/vendor/normalize.css">
    <link rel="stylesheet" href="/<?php echo $_mt['server_path']; ?>/css/vendor/jquery-ui.css">
    <link rel="stylesheet" href="/<?php echo $_mt['server_path']; ?>/css/vendor/foundation.css">
    <link rel="stylesheet" href="/<?php echo $_mt['server_path']; ?>/css/main.css">
  </head>

  <body>
    <?php if($_mt['page'] == "install"): ?>
      <?php require_once("conf/install.php"); ?>
    <?php else: ?>

      <?php require_once("includes/ui.php"); ?>
      <?php require_once("includes/header.php"); ?>
      
      <div id="main">

        <?php if(count($_mt['msgs']) > 0): ?>
          <div class="msgs">
            <?php foreach($_mt['msgs'] as $msg): ?>
              <div data-alert class="alert-box <?php if(isset($msg['lvl'])) echo $msg['lvl']; ?>">
                <?php if(isset($msg['msg'])) echo $msg['msg']; ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        
        <?php if(file_exists("templates/" . $_mt['page'] . ".php")): ?>
          <?php require_once("templates/" . $_mt['page'] . ".php"); ?>
        <?php else: ?>
          <?php require_once("templates/" . $_mt['page'] . "/index.php"); ?>
        <?php endif; ?>
      </div>
      
      <?php require_once("includes/footer.php"); ?>
      
    <?php endif; ?>
  </body>

</html>

<?php 
  $page = ob_get_contents();
  ob_end_clean();

  $title = $_mt['page_title'] ? $_mt['page_title'] : $_mt['page'];
  echo str_replace ('<!--TITLE-->', 'mt - ' . $title, $page);
?>