<header>

  <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">

    <ul class="title-area">
      <li class="name">
        <h1><a href="/<?php echo $_mt['server_path']; ?>/">mt</a></h1>
      </li>
      <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">

      <ul class="right">
        <li class="active"><a href="#">Right Button Active</a></li>
        <li class="has-dropdown">
          <a href="#">Right Button Dropdown</a>
          <ul class="dropdown">
            <li><a href="#">First link in dropdown</a></li>
            <li class="active"><a href="#">Active link in dropdown</a></li>
          </ul>
        </li>
      </ul>

      <ul class="left">
        <li><a href="#">Left Nav Button</a></li>
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
      <!--<li><a href="#">Features</a></li>
      <li class="unavailable"><a href="#">Gene Splicing</a></li>
      <li class="current"><a href="#">Cloning</a></li>-->
    </ul>
  <?php endif; ?>

</header>