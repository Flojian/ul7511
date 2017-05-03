<?php
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
              echo '<li style="height: 50vh;background: url(' . get_the_post_thumbnail_url() . ') no-repeat center;-webkit-background-size: cover;background-size: cover;">';
            endif;

              echo '<div class="flex-caption">';
                  if ( get_the_title() != '' ) echo '<h2 class="entry-title">'. get_the_title().'</h2>';
                  if ( get_the_excerpt() != '' ) echo '<div class="excerpt">' . get_the_excerpt() .'</div>';
              echo '</div>';
              echo '</li>';
          endwhile;
        endif;

      echo '</ul>';
    echo ' </div>';
    // echo '<div class="container-fluid">';
    //   echo '<div class="sub-slider container">';
    //     echo '<div class="sub-slider-item co-sm-6 col-md-3">';
    //       echo '<div class="sub-slider-item-content">Coucou</div>';
    //     echo '</div>';
    //     // echo '<div class="sub-slider-item col-md-3">Coucou</div>';
    //     // echo '<div class="sub-slider-item col-md-3">Coucou</div>';
    //     // echo '<div class="sub-slider-item col-md-3">Coucou</div>';
    //   echo '</div>';
    // echo '</div>';
  }
}


function get_layout_class() {
  if (is_front_page()) {
    return 'container-fluid';
  } else {
    return 'no-sidebar';
  }
  // return get_the_url();//'container-fluid';
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
