<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
  <head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, user-scalable=no"/>
  <?php if (is_search()) { ?>
    <meta name="robots" content="noindex, nofollow" />
  <?php } ?>
  <title>
    <?php
    if (function_exists("is_tag") && is_tag()) {
      single_tag_title("Tag Archive for &quot;"); echo "&quot; - "; }
    elseif (is_archive()) {
      wp_title(""); echo " Archive - "; }
    elseif (is_search()) {
      echo "Search for &quot;".wp_specialchars($s)."&quot; - "; }
    elseif (!(is_404()) && (is_single()) || (is_page())) {
      wp_title(""); echo " - "; }
    elseif (is_404()) {
      echo "Not Found - "; }
    if (is_home()) {
      bloginfo("name"); echo " - "; bloginfo("description"); }
    else {
      bloginfo("name"); }
    if ( $paged > 1 ) {
      echo " - page ". $paged; }
    ?>
  </title>
  <link rel="shortcut icon" href="<?php bloginfo("template_directory"); ?>/favicon.ico" type="image/x-icon" />
  <?php
  wp_head();
  global $siteURL;
  ?>
  </head>
    <body <?php body_class(); ?>>
      <div id="header-wrapper">
        <nav id="nav-wrapper">
          <a
            href="<?php echo $siteURL->home->url; ?>"
            id="logo-wrapper">
            <img
              id="logo"
              class="hide"
              src=<?php echo get_stylesheet_directory_uri()."/asset/logo.png";?>
              />
            <img
              id="logo-white"
              src=<?php echo get_stylesheet_directory_uri()."/asset/logo-white.png";?>
              />
          </a>
          <ul id="main-menu-wrapper">
            <li>
              <a href="<?php echo $siteURL->home->url; ?>/#como-funciona">
                ¿Cómo funciona?
              </a>
            </li>
            <li>
              <a href="<?php echo $siteURL->home->url; ?>/#comparativo">
                  Afinsa vs. Bancos
              </a>
            </li>
            <li>
              <a href="<?php echo $siteURL->contact->url; ?>">
                Contacto
              </a>
            </li>
            <li class="more">
              <a href="<?php echo $siteURL->we->url; ?>">
                Conoce más
              </a>
              <ul class="submenu">
                <li>
                  <a href="<?php echo $siteURL->we->url; ?>">
                    Acerca de nosotros
                  </a>
                </li>
                <li>
                  <a href="<?php echo $siteURL->success_history->url; ?>">
                    Historia de éxitos
                  </a>
                </li>
                <li>
                  <a href="<?php echo $siteURL->faq->url; ?>">
                    Preguntas frecuentes
                  </a>
                </li>
                <li>
                  <a href="#">
                    Portal de clientes
                  </a>
                </li>
                <li>
                  <a href="<?php echo $siteURL->blog->url; ?>">
                    Blog
                  </a>
                </li>
                <li>
                  <a href="<?php echo $siteURL->privacy->url; ?>">
                    Aviso de privacidad
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <nav id="mobile-nav-wrapper">
          <a
            href="/wordpress/"
            id="mobile-logo-wrapper">
            <img
              id="mobile-logo"
              src=<?php echo get_stylesheet_directory_uri()."/asset/logo.png";?>
              class="hide"
              />
            <img
              id="mobile-logo-white"
              src=<?php echo get_stylesheet_directory_uri()."/asset/logo-white.png";?>
              class="hide"
              />
          </a>
          <div id="menu-items-left">
            <button
              class="sandwich"
              onclick="openMenu()">
              <div></div>
              <div></div>
              <div></div>
            </button>
          </div>
        </nav>
        <div
          id="mobile-menu-background"
          onclick="closeMenu()"></div>
        <div id="mobile-menu">
          <ul>
            <li>
              <a href="<?php echo $siteURL->home->url; ?>/#como-funciona">
                ¿Cómo funciona?
              </a>
            </li>
            <li>
              <a href="<?php echo $siteURL->home->url; ?>/#comparativo">
                  Afinsa vs. Bancos
              </a>
            </li>
            <li>
              <a href="<?php echo $siteURL->contact->url; ?>">
                Contacto
              </a>
            </li>
            <li class="more">
              <a href="<?php echo $siteURL->we->url; ?>">
                Conoce más
              </a>
              <ul class="submenu">
                <li>
                  <a href="<?php echo $siteURL->we->url; ?>">
                    Acerca de nosotros
                  </a>
                </li>
                <li>
                  <a href="<?php echo $siteURL->success_history->url; ?>">
                    Historia de éxitos
                  </a>
                </li>
                <li>
                  <a href="<?php echo $siteURL->faq->url; ?>">
                    Preguntas frecuentes
                  </a>
                </li>
                <li>
                  <a href="#">
                    Portal de clientes
                  </a>
                </li>
                <li>
                  <a href="<?php echo $siteURL->blog->url; ?>">
                    Blog
                  </a>
                </li>
                <li>
                  <a href="<?php echo $siteURL->privacy->url; ?>">
                    Aviso de privacidad
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
