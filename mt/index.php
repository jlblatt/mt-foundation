<?php error_reporting(E_ALL); $_mt = array(); require_once("conf/bootstrap.php"); ?><!doctype html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimal-ui">

    <title>mt<?php if($_mt['page_title']) echo ' - ' . $_mt['page_title']; ?></title>
    
    <script src="/<?php echo $_mt['server_path']; ?>/js/vendor/modernizr.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/vendor/jquery.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/vendor/jquery.cookie.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/vendor/fastclick.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/vendor/placeholder.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/foundation.min.js"></script>
    <script src="/<?php echo $_mt['server_path']; ?>/js/main.js" defer></script>

    <link rel="stylesheet" href="/<?php echo $_mt['server_path']; ?>/css/normalize.css">
    <link rel="stylesheet" href="/<?php echo $_mt['server_path']; ?>/css/foundation.min.css">
    <link rel="stylesheet" href="/<?php echo $_mt['server_path']; ?>/css/main.css">
  </head>

  <body>
    <?php if($_mt['page'] == "install"): ?>
      <?php require_once("conf/install.php"); ?>
    <?php else: ?>

      <?php require_once("includes/header.php"); ?>
      <div id="main">
        <?php require_once("templates/" . $_mt['page'] . ".php"); ?>
      </div>
      <?php require_once("includes/footer.php"); ?>
      
    <?php endif; ?>
  </body>

</html>