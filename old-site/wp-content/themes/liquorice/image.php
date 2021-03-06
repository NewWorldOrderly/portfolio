<?php
/**
 * The template for displaying an attachment image.
 *
 * @package WordPress
 * @subpackage Liquorice
 */
get_header(); ?>

<div id="primary-content" class="image-attachment">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-wrapper' ); ?>>
			<h2 class="single-title"><?php the_title(); ?></h2>
			<div class="date">
				<small>
					<?php
						if ( ! empty( $post->post_parent ) ) :

							$metadata = wp_get_attachment_metadata();
							printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span>  at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'liquorice' ),
								esc_attr( get_the_time() ),
								get_the_date(),
								wp_get_attachment_url(),
								$metadata['width'],
								$metadata['height'],
								get_permalink( $post->post_parent ),
								get_the_title( $post->post_parent )
							);
					?>
					<?php
						else :

							$metadata = wp_get_attachment_metadata();
							printf( __( '<span class="meta-prep meta-prep-entry-date">Uploaded </span> at <a href="%1$s" title="Link to full-size image">%2$s &times; %3$s</a>', 'liquorice' ),
								wp_get_attachment_url(),
								$metadata['width'],
								$metadata['height']
							);
					?>
						<?php edit_post_link( __( 'Edit', 'liquorice' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
					<?php endif; ?>
				</small>
			</div><!-- .date -->

			<div id="image-navigation">
				<span class="previous-image"><?php previous_image_link( false, __( 'Previous Image', 'liquorice' ) ); ?></span>
				<span class="next-image"><?php next_image_link( false, __( 'Next Image', 'liquorice' ) ); ?></span>
			</div><!-- #image-navigation -->

			<div class="entry">
				<div class="entry-attachment">
					<div class="attachment">
<?php
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
	 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
	 */
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
						<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
						echo wp_get_attachment_image( $post->ID, array( 788, 788 ) ); // filterable image width with, essentially, no limit for image height.
						?></a>
					</div><!-- .attachment -->

					<?php if ( ! empty( $post->post_excerpt ) ) : ?>
					<div class="entry-caption">
						<?php the_excerpt(); ?>
					</div>
					<?php endif; ?>
				</div><!-- .entry-attachment -->

				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'liquorice' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'liquorice' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry -->

			<div class="post-meta">
				<?php liquorice_posted_in(); ?>
			</div><!-- .post-meta -->

	</div><!-- #post-## -->

	<?php comments_template(); ?>

	<?php endwhile; ?>
</div><!-- #primary-content -->

<?php get_footer(); ?>