<header>

  <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
    <ul class="title-area">
      <li class="name">
        <h1><a href="/<?php echo $_mt['server_path']; ?>/"><i class="fa fa-bug"></i> / mt</a></h1>
      </li>
      <li class="toggle-topbar menu-icon"><a><span></span></a></li>
    </ul>

    <section class="top-bar-section">
      <ul class="right">
        <li class="has-dropdown" id="settings-menu">
          <a><i class="fa fa-cog"></i></a>
          <ul class="dropdown">
            <li><a data-reveal-id="file-browser" data-instance-id="mtSetWallpaper">Set Wallpaper</a></li>
          </ul>
        </li>
      </ul>

      <ul class="left">
        <li class="divider"></li>
        <li><a href="/<?php echo $_mt['server_path']; ?>/nodes/">Nodes</a></li>
      </ul>
    </section>
  </nav>

  <?php if(count($_mt['args']) > 1): ?>
    <ul class="breadcrumbs">
      <li><a href="/<?php echo $_mt['server_path']; ?>/">Dashboard</a></li>
      <?php $crumbs = array_slice($_mt['args'], 1); ?>
      <?php $currPath = ""; $count = 0;?>
      <?php foreach($crumbs as $crumb): ?>
        <?php $currPath .= $crumb . "/" ?>
        <?php if($count == count($crumbs) - 1): ?>
          <li class="current"> <?php echo preg_replace("/\-/", " ", $crumb); ?> </li>
        <?php else: ?>
          <li>
            <a href="/<?php echo $_mt['server_path']; ?>/<?php echo $currPath; ?>">
              <?php echo preg_replace("/\-/", " ", $crumb); ?>
            </a>
          </li>
        <?php endif; ?>
        <?php $count++; ?>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

</header>
