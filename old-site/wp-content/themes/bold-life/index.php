<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bold_Life
 */

get_header(); ?>

<div class="post-wrapper">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-wrapper last' ); ?>>

			<?php // Only show comment bubbles when comments have been made
			$comments_number = get_comments_number();
			if ( ! is_sticky() ) : ?>
				<div class="post-date-wrapper">
					<div class="post-date">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'bold-life' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
							<span><?php the_time( 'd' ); ?></span>
							<?php the_time( 'M Y' ); ?>
						</a>
					</div><!-- .post-date -->
					<?php
					if ( 0 < $comments_number ) :
						comments_popup_link(
							__( 'Leave a Comment', 'bold-life' ),
							_x( '<span>1</span> Comment', 'comments number', 'bold-life' ),
							_x( '<span>%</span> Comments', 'comments number', 'bold-life' ),
							'comment-left'
						);
					endif; ?>
				</div><!-- .post-date-wrapper -->
			<?php endif; ?>

			<?php
			if ( ! is_sticky() )
				echo '<div class="entry-wrapper">';
			else
				echo '<div class="wide-entry-wrapper">';
			?>
				<div class="entry">
					<div class="entry-inner">
						<h2 class="post-title">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'bold-life' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h2>
						<?php
						the_content( __( 'Read more&hellip;', 'bold-life' ) );
						wp_link_pages( array( 'before' => '<div class="post-pages">' . __( 'Pages:', 'bold-life' ), 'after' => '</div>' ) );
						?>
						<div class="post-meta">
							<?php
							$categories_list = get_the_category_list( __( ', ', 'bold-life' ) );
							$tag_list = get_the_tag_list( '', __( ', ', 'bold-life' ) );
							if ( is_multi_author() && $tag_list ) {
								printf( __( 'Posted by %1$s in %2$s and tagged %3$s', 'bold-life' ), esc_html( get_the_author() ), $categories_list, $tag_list );
							} elseif ( !is_multi_author() && $tag_list ) {
								printf( __( 'Posted in %1$s and tagged %2$s', 'bold-life' ), $categories_list, $tag_list );
							} elseif ( is_multi_author() ) {
								printf( __( 'Posted by %1$s in %2$s', 'bold-life' ), esc_html( get_the_author() ), $categories_list );
							} else {
								printf( __( 'Posted in %1$s', 'bold-life' ), $categories_list );
							}
							if ( comments_open() && ( is_sticky() || 0 == $comments_number ) ) :
								echo ' | ';
								comments_popup_link(
									__( 'Leave a Comment', 'bold-life' ),
									_x( '<span>1</span> Comment', 'comments number', 'bold-life' ),
									_x( '<span>%</span> Comments', 'comments number', 'bold-life' ),
									'meta-comment-link'
								);
							endif; ?>
						</div><!-- .post-meta -->
					</div><!-- .entry-inner -->
				</div><!-- .entry -->
			</div><!-- .entry-wrapper -->
		</div><!-- #post-<?php the_ID(); ?> -->

	<?php endwhile; ?>

		<div id="post-navigation">
			<h3 class="screen-reader-text">
				<?php _e( 'Post Navigation', 'bold-life' ); ?>
			</h3>
			<div class="nav-previous">
				<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older Entries', 'bold-life' ) ); ?>
			</div><!-- .nav-previous -->
			<div class="nav-next">
				<?php previous_posts_link( __( 'Newer Entries <span class="meta-nav">&rarr;</span>', 'bold-life' ) ); ?>
			</div><!-- .nav-next -->
		</div><!-- #post-navigation -->

	<?php else : ?>

		<div id="post-0" class="no-results-wrapper">
			<div class="entry">
				<div class="entry-inner">
					<h2>
						<?php _e( 'Not Found', 'bold-life' ); ?>
					</h2>
					<p>
						<?php _e( 'Sorry, but you are looking for something that isn&rsquo;t here.', 'bold-life' ); ?>
					</p>
				</div><!-- .entry-inner -->
			</div><!-- .entry -->
		</div><!-- #post-0 -->

	<?php endif; ?>

</div><!-- .post-wrapper -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>