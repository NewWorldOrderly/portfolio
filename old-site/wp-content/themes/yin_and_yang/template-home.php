<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>

	<?php	
		$count = 0;
		$id_suffix = 1;
		$items_per_row = 4;
		$quality = 90;			   	   		
		$my_query = new WP_Query( array( 'posts_per_page' => '-1', 'post_type' => 'portfolio' ) );
		$grid_class = 'grid_3';
		$desired_width = 220;
		$desired_height = 190;
		$terms = get_terms( 'portfolio_categories' ); 
		$count_terms = count( $terms ); 
	?>
    
    <!-- START #project-wrapper -->
    <div id="project-wrapper"></div>
    <!-- END #project-wrapper -->
    
    <!-- START #portfolio-header -->
	<div id="portfolio-header" class="grid_12 alpha omega group <?php if( ! $intro_text ) echo 'no-intro'; ?>">  
		  
	    <h2><?php _e( 'Portfolio', 'onioneye' ); ?></h2>
		
		<!-- START #filter -->
		<ul id="filter" class="group">
			
			<!-- START .active -->
			<li class="active">
				<a href="#" class="all" title="<?php _e( 'View all items', 'onioneye' ); ?>">
					
					<span class="term-name"><?php _e( 'All', 'onioneye' ); ?></span>
					
					<!-- START .term-count -->
					<span class="term-count">
						<?php echo wp_count_posts( 'portfolio' )->publish; ?>
						<span class="triangle-down"></span>
					</span>
					<!-- END .term-count -->
					
				</a>
			</li>
			<!-- END .active -->
				
			<?php if ( $count_terms > 0 ) { ?>
					
				<?php foreach ( $terms as $term ) { ?>
						
					<li>
						<a class="<?php echo $term->slug; ?>" href="#" title="<?php printf ( __( 'View all items filed under %s', 'onioneye' ), $term->name ); ?>">
	
							<span class="term-name"><?php echo $term->name; ?></span>
							
							<!-- START .term-count -->
							<span class="term-count"><?php echo $term->count; ?><span class="triangle-down"></span></span>
							<!-- END .term-count -->
							
						</a>
					</li>
					
				<?php } ?>
					
			<?php } ?>
			
		</ul>
		<!-- END #filter -->
		
	</div>	
	<!-- END #portfolio-header -->
		
	<!-- START .portfolio-gallery -->			
	<ul id="filterable-gallery" class="portfolio-gallery four-items-per-row grid_12 alpha omega">
		
	<?php while ( $my_query -> have_posts()) : $my_query -> the_post(); //query the "portfolio" custom post type for portfolio items ?>
			
		<?php $preview_img_url = eq_get_the_preview_img_url(); ?>
		<?php $count++; ?>
				
		<!-- START .portfolio-item -->
		<li data-id="id-<?php echo $id_suffix; ?>" <?php $terms = get_the_terms( $post -> ID, 'portfolio_categories' ); if ( !empty( $terms ) ) { echo 'data-group="'; foreach( $terms as $term ) { echo $term -> slug . ' '; } echo '"'; } ?> class="portfolio-item <?php echo $grid_class; ?> <?php if( $count === 1 ) { echo 'alpha'; } elseif( $count === $items_per_row ) { echo 'omega'; } ?>">
			
			<!-- START .project -->
			<figure class="project">   
					
				<?php $nonce = wp_create_nonce("portfolio_item_nonce"); ?>
   					
   				<!-- START .project-link -->
				<a class="project-link" href="<?php the_permalink(); ?>" data-post_id="<?php echo $post->ID; ?>" data-nonce="<?php echo $nonce; ?>">
				
					<?php if ( $preview_img_url ) { ?>
							
					<?php
						$image_details = wp_get_attachment_image_src( eq_get_attachment_id_from_src( $preview_img_url ), 'full');
						$image_full_width = $image_details[1];
						$image_full_height = $image_details[2];
										    
						// If the original width of the thumbnail doesn't match the width of the slider, resize it; otherwise, display it in original size
						if( $image_full_width > $desired_width || $image_full_height > $desired_height ) { 
					?>
						    <img width="<?php echo $desired_width; ?>" height="<?php echo $desired_height; ?>" src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $image_details[0]; ?>&amp;h=<?php echo $desired_height; ?>&amp;w=<?php echo $desired_width; ?>&amp;q=<?php echo $quality; ?>" alt="<?php the_title(); ?>" />
						    				       		  								              
					<?php 
						} else { 
					?>			              	
							<img width="<?php echo $desired_width; ?>" height="<?php echo $desired_height; ?>" src="<?php echo $preview_img_url; ?>" alt="<?php the_title(); ?>" />					              
					<?php 
						} 
					?>
								    	
				    	<span class="project-overlay">View Details</span>
				    	
				    	<div class="project-content">
					    	<h3 class="project-caption"><?php the_title(); ?></h3> 
					    	<img class="view-button" src="<?php echo get_template_directory_uri(); ?>/images/layout/view-details.png" />
					    </div>
				    	
				    </a>
				    <!-- END .project-link -->
				    
				    <span class="blocked-project-overlay"></span>
				    				    
			    </figure>
			    <!-- START .project -->
			    			    
			<?php } ?>
					
		</li>  
		<!-- END .portfolio-item -->
						    
		<?php if( $count === $items_per_row ) { // if the current row is filled out with columns, reset the count variable ?>
			
			<?php $count = 0; ?> 
			 
		<?php } ?>
		<?php $id_suffix++; ?>
			
	<?php endwhile; ?>
			
	</ul>
	<!-- END .portfolio-gallery -->
	
	<?php if( of_get_option( 'client_logos' ) ) { // display the client logos if defined in the theme options panel ?>
		
		<div class="clients grid_12 alpha omega group">    
		    <h2><?php _e( 'Clients', 'onioneye' ); ?></h2>
		    
		    <img class="client-logos" src="<?php echo of_get_option( 'client_logos' ); ?>" alt="client logos" />
		</div>	
		
    <?php } ?>

<?php get_footer(); ?>