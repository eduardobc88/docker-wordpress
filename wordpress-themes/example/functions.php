<?php
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL, 'es_ES');

show_admin_bar(false);

add_action('init', 'addThemeSupport');
add_action('wp_enqueue_scripts', 'registerScripts');
add_action('wp_enqueue_scripts', 'registerStyles');
add_action('init', 'registerPostTypes');
add_action('add_meta_boxes', 'registerMetabox');
add_action('save_post', 'onSavePost');
add_action('rest_api_init', 'exampleAPIRest');
add_action('wp', 'generateLinks');
add_action( 'init', 'RegisterCustomTaxonomy', 0);
add_action('admin_init', 'admin_page_register_settings');
add_action('admin_menu', 'add_admin_page');

add_filter('clean_url', 'addAsyncForScript', 11, 1);
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );


function admin_page_register_settings() {
  register_setting('general-settings', 'contact_email');
  register_setting('general-settings', 'contact_auto_email');
  register_setting('general-settings', 'contact_home_email');
}

function add_admin_page() {
  add_menu_page('General', 'General', 'administrator', 'wp-general-options', 'page_general_content', '', 21);
}

function page_general_content() {
  $contact_email = get_option('contact_email');
  ?>
  <div class="wrap">
    <form method="post" action="options.php">
      <?php settings_fields('general-settings'); ?>
      <h2>General</h2>
      <table class="form-table">
        <tbody>
          <?php get_input_field('Email de contacto', 'contact_email', 'ejemplo@gmail.com', $contact_email); ?>
        </tbody>
      </table>
      <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Guardar') ?>" />
      </p>
    </form>
  </div>
  <?php
}

function tn_custom_excerpt_length($length) {
  return 20;
}

function exampleAPIRest() {
  register_rest_route(
    'example-api/',
    'autos/',
    array('methods'  => 'GET', 'callback' => 'APIControllerGetAutos'));
  register_rest_route(
    'example-api/',
    'autos/',
    array('methods'  => 'GET', 'callback' => 'APIControllerGetAutos'));
}

function APIControllerGetAutos () {
  global $wpdb;
  $query = "";
  if(!empty($_GET['param-a']))
    $query = "";
  if(!empty($_GET['param-a']) && !empty($_GET['param-b']))
    $query = "";
  $rows = $wpdb->get_results( $query );
  $response = new WP_REST_Response($rows);
  $response->set_status(200);
  return $response;
}

function registerPostTypes() {
  // $example_labels = array(
  //   'name'               => __('Examples', 'ee'),
  //   'singular_name'      => __('Example ', 'ee'),
  //   'add_new'            => __('Agregar nuevo example', 'ee'),
  //   'add_new_item'       => __('Agregar nuevo example', 'ee'),
  //   'edit_item'          => __('Editar example', 'ee'),
  //   'new_item'           => __('Nuevo example', 'ee'),
  //   'all_items'          => __('Todos los examples', 'ee'),
  //   'view_item'          => __('Vista de examples', 'ee'),
  //   'search_items'       => __('Buscar examples', 'ee'),
  //   'not_found'          => __('Examples no encontrados', 'ee'),
  //   'not_found_in_trash' => __('Examples no encontrados en la papelera', 'ee'),
  //   'parent_item_colon'  => '',
  //   'menu_name'          => __('Examples', 'ee'),
  // );
  // register_post_type('example',
  //   array(
  //     'labels' => $example_labels,
  //     'public' => true,
  //     'has_archive' => false,
  //     'hierarchical'  => false,
  //     'supports' => array('title'),
  //     'query_var' => true,
  //   )
  // );
}

function RegisterCustomTaxonomy() {
  // $labels = array(
  //   'name' => _x( 'Types', 'Categoría' ),
  //   'singular_name' => _x( 'Type', 'Categoría' ),
  //   'search_items' =>  __( 'Buscar Categorias' ),
  //   'all_items' => __( 'Todas Categorias' ),
  //   'parent_item' => __( 'Categoría padre' ),
  //   'parent_item_colon' => __( 'Categoría padre:' ),
  //   'edit_item' => __( 'Editar Categoría' ),
  //   'update_item' => __( 'Actualizar Categoría' ),
  //   'add_new_item' => __( 'Agregar Nueva Categoría' ),
  //   'new_item_name' => __( 'Nueva Categoría' ),
  //   'menu_name' => __( 'Categorias' ),
  // );
  // register_taxonomy('types',array('faq'), array(
  //   'hierarchical' => true,
  //   'labels' => $labels,
  //   'show_ui' => true,
  //   'show_admin_column' => true,
  //   'query_var' => true,
  //   'rewrite' => array( 'slug' => 'type' ),
  // ));
}

function registerMetabox() {
  // add_meta_box(
  //   'auto-data',
  //   'Contenido Extra',
  //   'contentMetabox',
  //   'auto',
  //   'normal',
  //   'default'
  // );
  // add_meta_box(
  //   'auto-data',
  //   'Contenido Extra',
  //   'contentMetabox',
  //   'histories',
  //   'normal',
  //   'default'
  // );
}

function contentMetabox($post) {
  $template_file = get_post_meta($post->ID, '_wp_page_template', TRUE);
  if($template_file == 'template-world-week-single.php') {

  }
  if($post->post_type == 'auto') {
    // $auto_brand = get_post_meta($post->ID, 'auto_brand', TRUE);
    ?>
    <!-- <table class="form-table">
      <tbody>
        <?php get_input_field('Marca', 'auto_brand', 'Mazda', $auto_brand); ?>
      </tbody>
    </table> -->
    <?php
  }
}

function onSavePost($post_id) {
  $template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
  if(get_post($post_id)->post_type == 'auto') {
    // update_post_meta($post_id, 'auto_brand', $_POST['auto_brand']);
  }
}

function get_input_field($row_title, $input_name, $input_placeholder, $input_value) {
  ?>
  <tr>
    <th scope="row">
      <label for="blogname"><?php echo $row_title; ?></label>
    </th>
    <td>
      <input type="text" name="<?php echo $input_name; ?>" id="<?php echo $input_name; ?>" value="<?php echo $input_value; ?>" placeholder="<?php echo $input_placeholder; ?>" class="regular-text">
    </td>
  </tr>
  <?php
}
function get_textarea_field($row_title, $input_name, $input_placeholder, $input_value) {
  ?>
  <tr>
    <th scope="row">
      <label for="blogname"><?php echo $row_title; ?></label>
    </th>
    <td>
      <textarea type="text" name="<?php echo $input_name; ?>" id="<?php echo $input_name; ?>" placeholder="<?php echo $input_placeholder; ?>" class="regular-text"><?php echo $input_value; ?></textarea>
    </td>
  </tr>
  <?php
}

function addAsyncForScript($url) {
  if (strpos($url, '#asyncload') === false)
    return $url;
  else if (is_admin())
    return str_replace('#asyncload', '', $url);
  else
    return str_replace('#asyncload', '', $url)."' async='async";
}

function addThemeSupport() {
  add_post_type_support('page', 'excerpt');
  add_post_type_support('post', 'excerpt');
  add_theme_support('custom-header');
  add_theme_support('menus');
  add_theme_support('post-thumbnails');
  add_image_size('150x150', 150, 150, true);
  add_image_size('300x120', 300, 120, true);
  add_image_size('1200x450', 1200, 450, true);
}

function registerScripts() {
  global $post;
  // wp_register_script('global-js', get_stylesheet_directory_uri().'/js/global.js#asyncload', array(), false, true);
  // wp_register_script('template-home-js', get_stylesheet_directory_uri().'/js/template-home.js#asyncload', array(), '1.1.1', true);
  // wp_register_script('template-contact-js', get_stylesheet_directory_uri().'/js/template-contact.js#asyncload', array(), '1.1.1', true);
  // wp_register_script('axios-js', 'https://unpkg.com/axios/dist/axios.min.js', array(), '1.0.0', true);
  // wp_register_script('glide-js', get_stylesheet_directory_uri().'/js/glide.js#asyncload', array(), '3.3.0', true);
  // wp_register_script('share-this-js', get_stylesheet_directory_uri().'/js/share-this.js', array(), '1.0.0', false);
  // wp_register_script('template-faq-js', get_stylesheet_directory_uri().'/js/template-faq.js#asyncload', array(), '1.0.0', true);
  // wp_register_script('template-histories-js', get_stylesheet_directory_uri().'/js/template-histories.js#asyncload', array(), '1.0.0', true);
  // wp_enqueue_script('global-js');
  // wp_enqueue_script('share-this-js');

  switch(basename(get_page_template())) {
    case 'template-home.php':
      wp_enqueue_script('axios-js');
      // $example_api_url = get_site_url().'/wp-json/example-api/autos';
      // wp_localize_script('template-home-js', 'example_api_url', $example_api_url);
      // wp_enqueue_script('glide-js');
      // wp_enqueue_script('template-home-js');
    break;
    // case 'template-contact.php':
    //   wp_enqueue_script('template-contact-js');
    // break;
    // case 'template-faq.php':
    //   wp_enqueue_script('template-faq-js');
    // break;
    // case 'template-success-histories.php':
    //   wp_enqueue_script('template-histories-js');
    // break;
  }
}

function registerStyles() {
  global $post;
  // wp_register_style('font-css', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700,800&display=swap#asyncload');
  // wp_register_style('global-css', get_stylesheet_directory_uri().'/css/global.css#asyncload', array(), '1.1.1', false);
  // wp_register_style('template-home-css', get_stylesheet_directory_uri().'/css/template-home.css#asyncload', array(), '1.1.1', false);
  // wp_register_style('template-contact-css', get_stylesheet_directory_uri().'/css/template-contact.css#asyncload', array(), '1.0.0', false);
  // wp_register_style('template-css', get_stylesheet_directory_uri().'/css/template.css#asyncload', array(), '1.0.0', false);
  // wp_register_style('glide-core-css', get_stylesheet_directory_uri().'/css/glide-core.css#asyncload', array(), '3.3.0', false);
  // wp_register_style('glide-theme-css', get_stylesheet_directory_uri().'/css/glide-theme.css#asyncload', array(), '1.0.0', false);
  // wp_register_style('template-about-css', get_stylesheet_directory_uri().'/css/template-about.css#asyncload', array(), '1.0.0', false);
  // wp_register_style('category-blog-css', get_stylesheet_directory_uri().'/css/category-blog.css#asyncload', array(), '1.0.0', false);
  // wp_register_style('single-css', get_stylesheet_directory_uri().'/css/single.css#asyncload', array(), '1.0.0', false);
  // wp_register_style('template-faq-css', get_stylesheet_directory_uri().'/css/template-faq.css#asyncload', array(), '1.0.0', false);
  // wp_register_style('template-histories-css', get_stylesheet_directory_uri().'/css/template-histories.css#asyncload', array(), '1.0.0', false);
  // wp_enqueue_style('font-css');
  // wp_enqueue_style('global-css');

  $is_template = false;
  // switch(basename(get_page_template())) {
  //   case 'template-home.php':
  //     wp_enqueue_style('template-home-css');
  //     wp_enqueue_style('glide-core-css');
  //     wp_enqueue_style('glide-theme-css');
  //     $is_template = true;
  //   break;
  //   case 'template-contact.php':
  //     wp_enqueue_style('template-contact-css');
  //     $is_template = true;
  //   break;
  //   case 'template-credit-thanks.php':
  //     wp_enqueue_style('template-css');
  //     $is_template = true;
  //   break;
  //   case 'template-contact-thanks.php':
  //     wp_enqueue_style('template-css');
  //     $is_template = true;
  //   break;
  //   case 'template-about.php':
  //     wp_enqueue_style('template-about-css');
  //     $is_template = true;
  //   break;
  //   case 'template-general.php':
  //     wp_enqueue_style('template-css');
  //     $is_template = true;
  //   break;
  //   case 'template-faq.php':
  //     wp_enqueue_style('template-faq-css');
  //     $is_template = true;
  //   break;
  //   case 'template-success-histories.php':
  //     wp_enqueue_style('template-histories-css');
  //     $is_template = true;
  //   break;
  // }
  // if($is_template == false && is_page()) {
  //   wp_enqueue_style('template-css');
  // }
  // if(is_category()) {
  //   wp_enqueue_style('category-blog-css');
  // }
  // if(is_single()) {
  //   switch($post->post_type) {
  //     default:
  //       wp_enqueue_style('single-css');
  //     break;
  //   }
  // }
}

$siteURL = (object) array();
function generateLinks() {
  global $siteURL;
  global $post;
	$siteURL->home = (object) array('url'=>get_page_link(get_option('page_on_front')), 'title'=>get_the_title(get_option('page_on_front')), 'id'=>get_option('page_on_front'));
  // $siteURL->contact = (object) array('url'=>get_page_link(10), 'title'=>get_the_title(10), 'id'=>10);
  // $siteURL->we = (object) array('url'=>get_page_link(12), 'title'=>get_the_title(12), 'id'=>12);
  // $siteURL->faq = (object) array('url'=>get_page_link(14), 'title'=>get_the_title(14), 'id'=>14);
  // $siteURL->automotiveCredit = (object) array('url'=>get_page_link(16), 'title'=>get_the_title(16), 'id'=>16);
  // $siteURL->privacy = (object) array('url'=>get_page_link(18), 'title'=>get_the_title(18), 'id'=>18);
  // $siteURL->credit_thanks = (object) array('url'=>get_page_link(20), 'title'=>get_the_title(20), 'id'=>20);
  // $siteURL->success_history = (object) array('url'=>get_page_link(22), 'title'=>get_the_title(22), 'id'=>22);
  // $siteURL->blog = (object) array('url'=>get_category_link(1), 'title'=>'Blog', 'id'=>1);
  // $siteURL->contact_thanks = (object) array('url'=>get_page_link(24), 'title'=>get_the_title(24), 'id'=>24);
  // $siteURL->histories = (object) array('url'=>get_page_link(26), 'title'=>get_the_title(26), 'id'=>26);
}

function send_email($to, $copy_to, $subject, $message_data) {
  $headers = 'From: aprolam<no_reply@aprolam.mx>' . "\r\n";
  if( $copy_to != "" )
      $headers .= 'Bcc: '.$copy_to. "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
  $message_data = $message_data.'<p style="font-size: 12px; color: #444; text-align: right;">'.date_i18n('j F Y - H:i:s').'</p>';
  $message = '<div style="padding: 15px; background-color: #ccc;"><div style="position: relative; left: 0; right: 0; margin: auto; width: 600px; border-radius: 5px; border: 1px solid #ccc;">
    <table style="width:100%;border-spacing: 0;border-collapse: collapse;">
      <tr style="padding-bottom: 30px;">
        <td style="background-color: #FFF;">
          <a href="'.get_home_url().'" style="display: inline-block;"><img style="width: 250px; padding: 40px 0 0px 15px;" src="'.get_template_directory_uri().'/asset/logo.png"></a>
        </td>
      </tr>
      <tr>
        <td style="background-color: #FFF;">
          <h2 style="color: #000;
          font-size: 32px;
          padding: 15px;
          margin: 0;
          font-family: sans-serif;
          font-weight: 200;">'.$subject.'</h2>
          <tr><td style="background-color: #FFF; color: #777676; font-size: 16px; padding-top: 30px; padding-bottom: 30px; padding-left: 15px; padding-right: 15px; margin: 0px;font-family: sans-serif;font-weight: 400;">'.$message_data.'</td></tr>
        </td>
      </tr>
    </table>
  </div></div>';
  return mail($to, 'EXAMPLE - '.$subject, $message, $headers);
}

function get_image_src($post_thumbnail_id, $size) {
  if($post_thumbnail_id == "") {
      $post_thumbnail_id = -1;
  }
  $result = false;
  $result = wp_get_attachment_image_src($post_thumbnail_id, $size)[0];
  if($result == false)
    $result = "https://placehold.it/".$size."/".get_hexadecimal_color()."/DADADA/?text=".$size;
    //$size_rename = str_replace("x","/",$size);
    //$result = "http://lorempixel.com/".$size_rename."/city/".$size."/";
    //$result = "https://placeimg.com/".$size_rename."/tech/".$size."/";
  return $result;
}

function get_hexadecimal_color() {
  $num = mt_rand (0, 0xffffff);
  $output = sprintf ("%06x" , $num);
  return $output="7b7b7b";
}

function get_pagination() {
  global $wp_query;
  $big = 999999999;
  $paginate_links = paginate_links(array(
    'base' => str_replace($big, '%#%', get_pagenum_link($big)),
    'current' => max(1, get_query_var('paged')),
    'total' => $wp_query->max_num_pages,
    'mid_size' => 5,
    'prev_text'    => __('<'),
    'next_text'  =>  __('>'),
    'type'  => 'array'
  ));
  if($paginate_links) {
  ?>
    <ul id='pagination'>
      <?php
      foreach($paginate_links as $key => $value) {
        echo "<li>".$value."</li>";
      }
      ?>
    </ul>
  <?php
  }
  wp_reset_query();
}

function share_buttons($post_url) {
  ?>
  <div id="share">
      <label>Compatir en:</label>
      <div onClick="FBShare(this)" class="button share-fb" attr-permalink="<?php echo $post_url; ?>"></div>
      <div onClick="TwShare(this)" class="button share-tw" attr-permalink="<?php echo $post_url; ?>"></div>
      <div onClick="WAShare(this)" class="button share-wa" attr-permalink="<?php echo $post_url; ?>"></div>
      <div onClick="TeShare(this)" class="button share-t" attr-permalink="<?php echo $post_url; ?>"></div>
  </div>
  <?php
}
?>
