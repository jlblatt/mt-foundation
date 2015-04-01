<header>

  <div class="sticky">
    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="toggle-topbar menu-icon"><a><span></span></a></li>
      </ul>

      <section class="top-bar-section">
        <ul class="right">
          <li class="has-dropdown">
            <a><i class="fa fa-cog"></i></a>
            <ul class="dropdown">
              <li><a data-reveal-id="file-browser" data-instance-id="mtSetWallpaper">Set Wallpaper<i class="fa fa-picture-o"></i></a></li>
              <li><a id="toggle-fullscreen">Toggle Fullscreen<i class="fa fa-expand"></i></a></li>
            </ul>
          </li>
        </ul>

        <ul class="left">
          <li class="name has-dropdown">
            <h1><a href="/<?php echo $_mt['server_path']; ?>/" title="mt-foundation"></a></h1>
            <ul class="dropdown">
              <li>
                <a><i class="fa fa-birthday-cake"></i></a>
                <a><i class="fa fa-tachometer"></i></a>
                <a><i class="fa fa-tty"></i></a>
                <a><i class="fa fa-beer"></i></a>
              </li>
              <li>
                <a><i class="fa fa-bug"></i></a>
                <a><i class="fa fa-bed"></i></a>
                <a><i class="fa fa-heart"></i></a>
                <a><i class="fa fa-transgender-alt"></i></a>
              </li>
              <li>
                <a><i class="fa fa-magic"></i></a>
                <a><i class="fa fa-music"></i></a>
                <a><i class="fa fa-rocket"></i></a>
                <a><i class="fa fa-rebel"></i></a>
              </li>
              <li>
                <a><i class="fa fa-empire"></i></a>
                <a><i class="fa fa-glass"></i></a>
                <a><i class="fa fa-leaf"></i></a>
                <a><i class="fa fa-paw"></i></a>
              </li>
            </ul>
          </li>
          <li class="divider"></li>
          <li class="has-dropdown">
            <a href="/<?php echo $_mt['server_path']; ?>/artists/">Artists</a>
            <ul class="dropdown">
              <li><a href="/<?php echo $_mt['server_path']; ?>/artists/create/"><i class="fa fa-plus-square"></i>Create</a></li>
            </ul>
          </li>
          <li class="divider"></li>
          <li class="has-dropdown">
            <a href="/<?php echo $_mt['server_path']; ?>/albums/">Albums</a>
            <ul class="dropdown">
              <li><a href="/<?php echo $_mt['server_path']; ?>/albums/create/"><i class="fa fa-plus-square"></i>Create</a></li>
            </ul>
          </li>
          <li class="divider"></li>
          <li class="has-dropdown">
            <a href="/<?php echo $_mt['server_path']; ?>/songs/">Songs</a>
            <ul class="dropdown">
              <li><a href="/<?php echo $_mt['server_path']; ?>/songs/create/"><i class="fa fa-plus-square"></i>Create</a></li>
            </ul>
          </li>
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
  
  </div>
</header>
