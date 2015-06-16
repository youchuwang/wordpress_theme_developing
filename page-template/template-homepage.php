<?php
/**
 * Template Name: homepage
 */

get_header(); 
?>
<div class="content-section" style="background-image:url(<?php echo ot_get_option( 'general_bkg' ); ?>)">
	<div class="main-container">
		<div class="header-slider-section">
			<?php
				if( isMobile() ){
					echo apply_filters( 'the_content', ot_get_option('mobile_header_slider_section_content') 
						);
				} else {
					echo apply_filters( 'the_content', ot_get_option('header_slider_section_content') 
						);
				}
			?>
		</div>
		<div id="the-bakery" class="the-bakery-section">
			<div class="the-bakery-section-content">
				<div class="stroke-title">
					<div class="stroke-title-line-left"></div>
					<h2><?php echo ot_get_option('the_bakery_section_title'); ?></h2>
					<div class="stroke-title-line-right"></div>
				</div>
				<div class="the-bakery-section-content-info">
					<?php echo apply_filters( 'the_content', ot_get_option('the_bakery_section_content') ); ?>
				</div>
			</div>
			<div class="the-bakery-section-slider">
				<?php echo apply_filters( 'the_content', ot_get_option('the_bakery_section_slider') ); ?>
			</div>
		</div>
		<div id="menu" class="bakery-menu-section">
			<div class="bakery-menu-section-content">
				<div class="stroke-title">
					<div class="stroke-title-line-left white-bkg"></div>
					<h2><?php echo ot_get_option('bakery_menu_section_title'); ?></h2>
					<div class="stroke-title-line-right white-bkg"></div>
				</div>
				<div class="bakery-menu-section-content-info">
					<?php echo apply_filters( 'the_content', ot_get_option('bakery_menu_section_content') ); ?>
				</div>
			</div>
		</div>
		<div class="cupon-section">
			<div class="cupon-section-message">
				<div class="cupon-section-message-wrapper-1">
					<div class="cupon-section-message-wrapper-2">
						<?php echo apply_filters( 'the_content', ot_get_option('cupon_section_content') ); ?>
					</div>
				</div>
			</div>
			<div class="cupon-section-slider">
				<div id="cupon-section-slider-wrapper" class="carousel slide" data-ride="carousel" data-interval="3000">
					<div class="carousel-inner">
					<?php 
						for($i = 1; $i < 6; $i++) { 
							$imgURL = ot_get_option('cupon_section_slider_' . $i);
							if( $imgURL == '' ) continue;
					?>
						<div class="item<?php echo $i == 1 ? " active":""; ?>" style="background-image:url(<?php echo $imgURL; ?>);">
						</div>
					<?php
						}
					?>
					</div>
				</div>
			</div>
		</div>
		<div id="the-pastry" class="the-pastry-section">
			<div class="the-pastry-section-title">
				<div class="stroke-title">
					<div class="stroke-title-line-left"></div>
					<h2><?php echo ot_get_option('the_pastry_section_title'); ?></h2>
					<div class="stroke-title-line-right"></div>
				</div>
			</div>
			<div class="gallery-cat-section">
			<?php
				$args = array(
					'post_type' => 'cake-gallery',
					'posts_per_page' => -1,
				);

				$the_query = new WP_Query( $args );

				if ( $the_query->have_posts() ) {
					echo '<ul>';
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
					}
					echo '</ul>';
				}
			?>
			</div>
			<div class="the-pastry-section-slider-wrapper">
				<div class="slider the-pastry-section-slider">
					<?php
						$parstrySliderList = get_field('pastry_slider', 'options');

						foreach( $parstrySliderList as $item ){
							$img_url = '';

							$height = '';
							$width = '';

							if( isMobile() ){
								$img_url = $item['mobile_slider_image']['url'];
								$height = 'style="min-height:' . ( $item['mobile_slider_image']['height'] + 15 ) . 'px;"';
								$width = 'style="width:' . ( $item['mobile_slider_image']['width'] + 10 ) . 'px;"';
							} else {
								$img_url = $item['desktop_slider_image']['url'];
								$height = 'style="min-height:' . ( $item['desktop_slider_image']['height'] + 15 ) . 'px;"';
								$width = 'style="width:' . ( $item['desktop_slider_image']['width'] + 10 ) . 'px;"';
							}

							if( $img_url != '' ){
					?>
						<div <?php echo $width; ?>><div class="image img-cover slick-loading"><img data-lazy="<?php echo $img_url; ?>" class="slick-loading" <?php echo $height; ?>/><h2><?php echo $item['slider_title']; ?></h2></div></div>
					<?php
							}
						}
					?>
			    </div>
			</div>
		</div>
		<div id="requests" class="requests-section">
			<div class="requests-section-content">
				<div class="stroke-title">
					<div class="stroke-title-line-left"></div>
					<h2><?php echo ot_get_option('requests_section_title'); ?></h2>
					<div class="stroke-title-line-right"></div>
				</div>
				<div class="requests-section-content-info">
					<?php echo apply_filters( 'the_content', ot_get_option('requests_section_content') ); ?>
				</div>
			</div>
		</div>
		<?php
			$review_bkg_url = "";

			if( isMobile() ){
				$review_bkg_url = ot_get_option('reviews_section_mobile_background');
			} else {
				$review_bkg_url = ot_get_option('reviews_section_background');
			}
		?>
		<div id="reviews" class="review-section" style="background-image:url(<?php echo $review_bkg_url; ?>)">
			<h2><?php echo ot_get_option('reviews_section_title'); ?></h2>			
			<div class="review-content">
				<div class="review-content-inner">
					<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="6000">
						<div class="carousel-inner" role="listbox">
							<?php
								global $post;

								$args = array(  
									'post_type' => 'review',
									'posts_per_page' => -1
								);

								$reviewPosts = new WP_Query( $args );
								$firstFlag = true;

								if( $reviewPosts->have_posts() ){
									while( $reviewPosts->have_posts() ){
										$reviewPosts->the_post();
							?>
							<div class="item <?php echo $firstFlag ? 'active' : '' ; ?>">
								<?php the_content(); ?>
								<h2>- <?php the_title(); ?></h2>
							</div>
							<?php
										if( $firstFlag ) $firstFlag = false;
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="blog" class="blog-section">
			<div class="stroke-title">
				<div class="stroke-title-line-left" style="width: 369px; left: 0px; top: 22px;"></div>
				<h2>BLOG</h2>
				<div class="stroke-title-line-right" style="width: 369px; right: 0px; top: 22px;"></div>
			</div>
			<div class="blog-items">
			<?php
				$args = array(  
					'post_type' => 'post',
					'posts_per_page' => 2
				);

				$count_posts = wp_count_posts();

				$blogPosts = new WP_Query( $args );

				$countPost = 0;

				if( $blogPosts->have_posts() ){
					while( $blogPosts->have_posts() ){
						$blogPosts->the_post();

						$countPost++;
			?>
				<div class="blog-item">
					<div class="blog-item-image"><?php echo get_the_post_thumbnail($post->ID, 'home-blog-size'); ?></div>
					<div class="blog-item-content">
						<div class="blog-item-content-inner">
							<h2><?php echo $post->post_title; ?></h2>
							<div class="post-date"><?php  echo get_the_date('', $post->ID); ?></div>
							<div id="blog-content-close<?php echo $post->ID; ?>" class="blog-item-content-excerpt">
								<?php echo apply_filters( 'the_content', $post->post_excerpt ); ?>
							</div>
							<div id="blog-content-open<?php echo $post->ID; ?>" class="blog-item-content-full hide"></div>
							<div class="blog-item-read-more">
								<a href="#" id="blog-content-btn<?php echo $post->ID; ?>" data-read="un-read" data-status="close" data-postid="<?php echo $post->ID; ?>">Read More</a>
							</div>
						</div>
					</div>
				</div>
			<?php
					}
				}
			?>
			</div>
			<?php
				if( $count_posts->publish > 2){
			?>
			<div class="load-more-btn-section">
				<div class="load-more-btn-wrapper">
					<a id="blog-load-more-btn" href="#" data-posts="<?php echo $count_posts->publish; ?>" data-seek="<?php echo $countPost; ?>">LOAD MORE POSTS</a>
				</div>
			</div>
			<?php
				}
			?>
		</div>
		<?php
			$footer_bkg_url = "";

			if( isMobile() ){
				$footer_bkg_url = ot_get_option('footer_section_mobile_bkg');
			} else {
				$footer_bkg_url = ot_get_option('footer_section_bkg');
			}
		?>
		<div class="footer-section" style="background-image:url(<?php echo $footer_bkg_url; ?>)">
			<div class="footer-section-content">
				<?php 
					if( isMobile() ){
						echo apply_filters( 'the_content', ot_get_option('footer_section_mobile_content') );
					} else {
						echo apply_filters( 'the_content', ot_get_option('footer_section_content') );
					}
				?>
			</div>
		</div>
		<div class="legal-privacy-section" style="display:none" data-status="close">
			<div class="legal-privacy-section-inner">
				<div class="stroke-title">
					<div class="stroke-title-line-left"></div>
					<h2><?php echo ot_get_option('legal_privacy_title'); ?></h2>
					<div class="stroke-title-line-right"></div>
				</div>
				<?php echo apply_filters( 'the_content', ot_get_option('legal_privacy_content') ); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
