<?php
/**
 * Template Name: General
 */
get_header();
wp_reset_query();
$page_title = get_the_title();
$post_url = get_permalink();
$page_image = get_image_src(get_post_thumbnail_id(get_the_id()), '1200x450');
$post_date = get_the_date();
?>
        <section id="contact-hero">
          <div id="hero-dark-bkg"></div>
          <div id="content-wrapper">
            <h1>
              <?php echo $page_title; ?>
            </h1>
          </div>
          <img
            class="background"
            src="<?php echo $page_image; ?>">
        </section>
        <section id="content">
          <div class="page-content">
            <?php the_content(); ?>
          </div>
          <label id="date">
            <?php echo $post_date; ?>
          </label>
          <?php share_buttons($post_url); ?>
        </section>
<?php get_footer(); ?>
