<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package sparkling
 */
?>

<div class="post-inner-content">
	<div class="entry-content">
		<?php the_content(); ?>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'sparkling' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<i class="fa fa-pencil-square-o"></i><span class="edit-link">',
					'</span>'
				);
			?>
		</footer>
	<?php endif; ?>
</div>
