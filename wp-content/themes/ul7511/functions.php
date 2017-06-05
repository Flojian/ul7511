<?php

function my_custom_js() {
    echo '<script src="wp-content/themes/ul7511/js/lib/parallax.min.js"></script>';
}
// Add hook for front-end <head></head>
add_action('wp_head', 'my_custom_js');

function custom_header_image() {
  if ( !is_front_page() && (function_exists( 'has_post_thumbnail' )) && ( has_post_thumbnail() ) ) :
    echo '<div style="height: 25vh" class="parallax-window" data-parallax="scroll" data-image-src="' . get_the_post_thumbnail_url() . '"></div>';
  endif;
}

function get_post_link() {
  $dom = new DOMDocument;
  $dom->loadHTML(get_the_content());
  $xpath = new DOMXPath($dom);
  $nodes = $xpath->query('//a/@href');
  return $nodes->item(0)->nodeValue;
}

function sparkling_featured_slider() {
  if ( is_front_page() && of_get_option( 'sparkling_slider_checkbox' ) == 1 ) {
    echo '<div class="flexslider">';
      echo '<ul class="slides">';

        $count = of_get_option( 'sparkling_slide_number' );
        $slidecat =of_get_option( 'sparkling_slide_categories' );

        $query = new WP_Query( array( 'cat' =>$slidecat,'posts_per_page' =>$count ) );
        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();

            if ( (function_exists( 'has_post_thumbnail' )) && ( has_post_thumbnail() ) ) :
              echo '<li style="background-image: url(' . get_the_post_thumbnail_url() . ')">';
            endif;

              echo '<div class="flex-caption">';
                  if ( get_the_title() != '' ) echo '<h2 class="entry-title">'. get_the_title().'</h2>';
                  if ( get_the_excerpt() != '' ) echo '<div class="excerpt">' . get_the_excerpt() . '</div>';
              echo '</div>';
              $link = get_post_link();
              if ($link) {
                echo '<a href="' . $link . '"></a>';
              }
              echo '</li>';
          endwhile;
        endif;

      echo '</ul>';
    echo ' </div>';
  }
}


function get_layout_class() {
  if (is_front_page()) {
    return 'container-fluid';
  } else {
    return 'no-sidebar';
  }
}

function get_layout_container_class() {
  if (is_front_page()) {
    return 'container-fluid';
  } else {
    return 'container';
  }
}

function sparkling_main_content_bootstrap_classes() {
  if (is_front_page()) {
    return 'col-sm-12 col-md-8 col-lg-9';//col-xs-12 col-sm-6 col-md-4 col-lg-3
  } else {
    return 'col-sm-12 col-md-12';
  }
	// if ( is_page_template( 'page-fullwidth.php' ) ) {
	// 	return 'col-sm-12 col-md-12';
	// }
	// return 'col-sm-12 col-md-8';
}

function get_custom_home_side_widgets() {
  if ( is_front_page()) {

    echo '<div class="well">';

      $count = of_get_option( 'sparkling_slide_number' );
      $slidecat = of_get_option( 'home_widgets_categories' );

      $query = new WP_Query( array( 'cat' =>$slidecat,'posts_per_page' =>$count ) );
      if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

          echo '<aside class="widget widget_text col-sm-6 col-md-12">';
            echo '<div class="textwidget">';
              echo '<div class="crf-widget">';
                if ( (function_exists( 'has_post_thumbnail' )) && ( has_post_thumbnail() ) ) :
                  echo '<img src="' . get_the_post_thumbnail_url() . '" />';
                endif;
                echo '<div class="title">' . get_the_title() . '</div>';
                echo '<div class="content">' . get_the_excerpt() . '</div>';
              echo '</div>';
            echo '</div>';
          echo '</aside>';
        endwhile;
      endif;

    echo ' </div>';
  }
}

function UL7511_customizer( $wp_customize ) {

  // Pull all the categories into an array
  global $options_categories;
  $wp_customize->add_setting('sparkling[home_widgets_categories]', array(
      'default' => '',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sparkling_sanitize_slidecat'
  ));
  $wp_customize->add_control('sparkling[home_widgets_categories]', array(
      'label' => __('Home widgets Category', 'sparkling'),
      'section' => 'sparkling_slider_options',
      'type'    => 'select',
      'description' => __('Select a category for the featured left widgets', 'sparkling'),
      'choices'    => $options_categories
  ));
}

add_action( 'customize_register', 'UL7511_customizer' );
