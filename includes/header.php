<?php
/**
 * Shared page header: <head>, preloader and main navigation.
 * Pages set $page_title / $page_desc before including this file.
 */
require_once __DIR__ . '/config.php';

$current_page = basename($_SERVER['SCRIPT_NAME']);
$nav_items = array(
    'index.php'    => 'Home',
    'about.php'    => 'About',
    'services.php' => 'Services',
    'project.php'  => 'Projects &amp; Clients',
    'contact.php'  => 'Contact Us',
);
$page_title = isset($page_title) ? $page_title : 'Home';
$page_desc  = isset($page_desc) ? $page_desc : SITE_DESCRIPTION;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo htmlspecialchars($page_desc, ENT_QUOTES); ?>">
  <meta name="author" content="<?php echo SITE_NAME; ?>">
  <title><?php echo htmlspecialchars($page_title, ENT_QUOTES); ?> | <?php echo SITE_NAME; ?> — <?php echo SITE_TAGLINE; ?>, Eswatini</title>
  <link rel="icon" href="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2064%2064'%3E%3Crect%20width='64'%20height='64'%20rx='14'%20fill='%232563eb'/%3E%3Ctext%20x='32'%20y='43'%20font-family='Arial'%20font-size='28'%20font-weight='900'%20fill='white'%20text-anchor='middle'%3EM%3C/text%3E%3C/svg%3E">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;300;400;500;700;800;900&display=swap" rel="stylesheet">
  <!--
  MSQ SOLUTIONS — website redesign
  Layout skeleton based on the "Softy Pinko" structure (templatemo tm-535),
  rebuilt with MSQ Solutions branding & content as a multi-page PHP site.
  -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- ***** Preloader Start ***** -->
<div id="preloader">
  <div class="jumper">
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky" id="siteHeader">
  <div class="container">
    <div class="header-inner">
      <nav class="main-nav">
        <a href="index.php" class="logo" aria-label="<?php echo SITE_NAME; ?> — home">
    <img src="assets/images/msq-removebg-preview.png" alt="<?php echo SITE_NAME; ?> logo" class="logo-img">
    <span class="logo-text">
        <?php echo SITE_NAME; ?>
        <small><?php echo SITE_TAGLINE; ?></small>
    </span>
</a>
        <!-- ***** Logo End ***** -->
        <!-- ***** Menu Start ***** -->
        <ul class="nav" id="navMenu">
          <?php foreach ($nav_items as $nav_file => $nav_label): ?>
          <li><a href="<?php echo $nav_file; ?>"<?php echo $current_page === $nav_file ? ' class="active"' : ''; ?>><?php echo $nav_label; ?></a></li>
          <?php endforeach; ?>
        </ul>
        <button class="menu-trigger" id="menuTrigger" aria-label="Toggle menu" aria-expanded="false" aria-controls="navMenu">
          <span></span><span></span><span></span>
        </button>
        <!-- ***** Menu End ***** -->
      </nav>
    </div>
  </div>
</header>
<!-- ***** Header Area End ***** -->
