<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Liquorice
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<h2 class="post-title"><?php _e( 'Not Found', 'liquorice' ); ?></h2>
	<p><?php _e( 'Sorry, but nothing matched your search criteria.', 'liquorice' ); ?></p>
	<?php get_search_form(); ?>
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>
		<?php /* Determine how to display posts depending on post format */
			get_template_part( 'content', get_post_format() );
		?>
<?php endwhile; // End the loop ?>

<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div class="post-navigation">
		<div class="nav-previous"><span class="meta-nav"><?php _e( '&larr;', 'liquorice' ); ?></span> <?php next_posts_link( __( 'Older Posts', 'liquorice' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer Posts', 'liquorice' ) ); ?> <span class="meta-nav"><?php _e( '&rarr;', 'liquorice' ); ?></span></div>
	</div><!-- .post-navigation -->
<?php endif; ?>