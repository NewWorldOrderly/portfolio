<?php get_header(); ?>

	<div class="narrowcolumnwrapper"><div class="narrowcolumn">

		<div class="content">

			<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<div class="postinfo">
<?php printf(__('Posted on %s by %s', 'digg3'), '<span class="postdate">'.get_the_time(get_option('date_format')).'</span>', get_the_author()); ?>
<?php edit_post_link(__('Edit', 'digg3'), ' &#124; ', ''); ?>
				</div>

				<div class="entry">

					<?php the_excerpt(); ?>

					<p class="postinfo">
					<?php printf( __('Filed under: %1$s &#124; %2$s', 'digg3'), get_the_category_list( __( ', ' , 'digg3')), get_the_tag_list( __( 'Tagged:' , 'digg3') . ' ', __( ', ' , 'digg3'), ' &#124;' )); ?> <?php comments_popup_link(__('Leave a Comment &#187;', 'digg3'), __('1 Comment &#187;', 'digg3'), __('% Comments &#187;', 'digg3')); ?>
					</p>

				</div>
			</div>

<?php endwhile; ?>

<?php include (TEMPLATEPATH . '/browse.php'); ?>

<?php else : ?>

			<div <?php post_class(); ?>>

				<h2><?php _e('Not Found', 'digg3'); ?></h2>

				<div class="entry">
<p><?php _e('Sorry, but you are looking for something that isn&#39;t here.', 'digg3'); ?></p>
				</div>

			</div>

<?php endif; ?>

		</div><!-- End content -->

	</div></div><!-- End narrowcolumnwrapper and narrowcolumn classes -->

<?php get_footer(); ?>
