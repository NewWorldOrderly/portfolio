<?php
	// This is the loop, which fetches entries from your database.
	// It is a very delicate piece of machinery. Be gentle!

	// Get core WP functions when loaded dynamically
	if (isset($_GET['rolling'])) {
		require (dirname(__FILE__).'/../../../wp-blog-header.php');
	}

	// Get the asides category
	$redo_asidescategory = 0;
?>

<?php is_tag(); ?>
	<?php /* Headlines for archives */ if ((!is_single() and !is_home()) or is_paged()) { ?>
		<h2>
		<?php // Figure out what kind of page is being shown
			if (is_category()) {
				if ($cat != $redo_asidescategory) { printf(__('Archive for the \'%s\' Category','redo_domain'), single_cat_title('', false)); }
				else { single_cat_title();	} }



			elseif ( is_tag() ) {
				printf(__('Posts Tagged &#8216;'));
				single_tag_title();
			}


			elseif (is_day()) { printf(__('Archive for %s','redo_domain'), get_the_time(__('F jS, Y','redo_domain'))); }
			elseif (is_month()) { printf(__('Archive for %s','redo_domain'), get_the_time(__('F, Y','redo_domain'))); }
			elseif (is_year()) { printf(__('Archive for %s','redo_domain'), get_the_time(__('Y','redo_domain'))); }
			elseif (is_search()) { printf(__('Search Results for \'%s\'','redo_domain'), get_search_query()); }
			elseif (function_exists('is_tag') and is_tag()) { printf(__('Tag Archive for \'%s\'','redo_domain'), get_query_var('tag') ); }
			elseif (is_author()) {
		   		$post = $wp_query->post;
				$author = get_userdata( $post->post_author );
				printf(__('Author Archive for %s','redo_domain'), $author->first_name . ' ' . $author->last_name ); }
			elseif (is_paged() and ($paged > 1)) { printf(__('Archive Page %s','redo_domain'), $paged ); }
		?>
		</h2>
	<?php } ?>

	<?php if (!is_single() and !is_home() and is_paged()) include (TEMPLATEPATH . '/navigation.php'); ?>

	<?php /* Check if there are posts */
		if ( have_posts() ) {
			/* It saves time to only perform the following if there are posts to show */

			// If there are 2+ users, this is a multiple-user blog
			// Alex: original does a count query to check this, we'll just assume yes
			$multiple_users = true;

			// Get the user information
			get_currentuserinfo();
			global $user_level;

			// Post index for semantic classes
			$post_index = 1;

			// Check if to display asides inline or not
			if(is_archive() or is_search() or is_single() or (function_exists('is_tag') and is_tag())) {
				$redo_asidescheck = '0';
			} else {
				$redo_asidescheck = get_option('redo_asidesposition');
			}

	?>


	<?php /* Start the loop */
		while ( have_posts() ) {
			the_post();

			// Post is an aside
			$post_asides = in_category($redo_asidescategory);
	?>

	<!--  Added to display wp-recent-links plugin -->
<?php
		if( 'link' == $post->rp_entry_type && !is_single()) {
    		if ($link_counter == 0) { ?>
            	<div class="lentry <?php if ( is_home() and $redo_asidescategory != 0 ) { echo 'rightmargin'; } ?>">
<?php 		} // recent links open <ul> ?>
					<div class="published_link"><?php echo date('d/m', strtotime($post->date_added)) ?></div>
					<div id="link-<?php the_ID(); ?>" class="link-title">
						<a href="<?php echo $post->link_url; ?>"><?php echo wptexturize($post->link_text); ?></a>
<?php 		if ('' != $post->link_caption) { ?>&#8594;
       			<?php echo wptexturize(convert_smilies($post->link_caption)); ?><?php } ?>
       			<!-- a href="<?php echo $post->link_permalink; ?>" class="permalink">#</a -->
					</div>
   			<?php $link_counter++; ?>
<?php 		if( function_exists('rewind_post_count') ) {
				rewind_post_count();
			} ?>
<?php 	} else {
        	/* Standard Entries */
			if ($link_counter > 0) { $link_counter = 0; ?>
				<div class="link-header">LINK LOG</div>
            	</div>
<?php 	} // recent links close </ul> ?>
	<!-- end add for wp-recent-links plugin -->

	<?php /* Only display asides if sidebar asides are not active */ if(!$post_asides || $redo_asidescheck == '0') { ?>
		<div id="post-<?php the_ID(); ?>" class="<?php redo_post_class($post_index++, $post_asides); ?> <?php if ( is_home() and $redo_asidescategory != 0 ) { echo 'rightmargin'; } ?> ">
			<div class="entry-head">
				<?php printf(	__('%1$s','redo_domain'),
					'<div class="published_sm" title="'. get_the_time('Y-m-d\TH:i:sO') . '">' .
					( '<div class="day">' . get_the_time('d') . '</div><div class="month">' . get_the_time('M') . '</div><div class="year">' . get_the_time('y') . '</div>' )
					. '</div>'
					); ?>


				<h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permanent link to %s', 'redo_domain' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h3>
				<?php /* Edit Link */ edit_post_link(__('Edit','redo_domain'), '<span class="editLink">','</span>'); ?>

				<div class="entry-meta">

					<div class="meta-row">
						<?php /* Date & Author */
							printf(	__('%1$s','redo_domain'), sprintf(__('<span class="authordata">By %s</span>','redo_domain'), '<span class="vcard author"><a href="' . get_author_link(0, $authordata->ID, $authordata->user_nicename) .'" class="url fn">' . get_the_author() . '</a></span>') );
						?>

						<?php /* Comments */ comments_popup_link(__('Leave a&nbsp;').'<span>'.__('Comment','redo_domain').'</span>', '1&nbsp;<span>'.__('Comment','redo_domain').'</span>', '%&nbsp;<span>'.__('Comments','redo_domain').'</span>', 'commentslink', '<span>'.__('Closed','redo_domain').'</span>'); ?>
					</div>

					<div class="meta-row">
						<?php /* Categories */ printf(__('<span class="entry-category">Categories: %s</span>','redo_domain'), redo_nice_category(', ', ' '.__('and','redo_domain').' ') ); ?>

					<br />
					<?php the_tags('<span class="entry-category">Tags: ', ', ', '<br /></span>'); ?>

					</div>
				</div> <!-- .entry-meta -->
			</div> <!-- .entry-head -->

			<div class="entry-content">
				<!-- or (function_exists('is_tag') and is_tag()) -->
				<?php if (is_search()) {
					the_excerpt();
				} else {
					the_content(__('Continue reading','redo_domain') . " '" . the_title('', '', false) . "'");
				} ?>

				<?php if( get_bloginfo('version') < 2.1 ) { ?>
					<?php link_pages('<p><strong>'.__('Pages:','redo_domain').'</strong> ', '</p>','number'); ?>
				<?php } else { ?>
					<?php wp_link_pages('before=<p><strong>'.__('Pages:','redo_domain').'</strong>&after=</p>&next_or_number=number')?>
				<?php } ?>
			</div> <!-- .entry-content -->

		</div> <!-- #post-ID -->

	<?php } /* End sidebar asides test */ ?>

	<?php } // close if() for entry types ?> <!-- added for wp-recent-links plugin -->

	<?php } /* End The Loop */ ?>

	<!-- added for wp-recent-links plugin -->
	<?php if ($link_counter > 0) { $link_counter = 0; ?>
        </ul>
    <?php } // recent links close </ul> ?>
	<!-- end add -->

	<?php /* Insert Paged Navigation */ if (!is_single()) { include(TEMPLATEPATH . '/navigation.php'); } ?>

<?php /* If there is nothing to loop */  } else { $notfound = '1'; ?>

	<div class="hentry four04">

		<div class="entry-head">
			<h3 class="center"><?php _e('Not Found','redo_domain'); ?></h2>
		</div>

		<div class="entry-content">
			<p><?php _e('Oh no! You\'re looking for something which just isn\'t here! Fear not however, errors are to be expected, and luckily there are tools on the sidebar for you to use in your search for what you need.','redo_domain'); ?></p>
		</div>

	</div> <!-- .hentry .four04 -->

<?php } /* End Loop Init  */ ?>
