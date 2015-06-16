<?php
/**
 * Template Name: homepage
 */

get_header();

$pageTitle = '';
$gallery = array();

if ( have_posts() ){
	while( have_posts() ){
		the_post();

		$pageTitle = get_the_title();

		if( have_rows('cake_gallery_slider') ){
			while( have_rows('cake_gallery_slider') ){
				the_row();

				$gallery[] = array(
					'slider_title' => get_sub_field('cake_gallery_slider_title'),
					'desktop_slider_image' => get_sub_field('cake_gallery_desktop_slider_image'),
					'mobile_slider_image' => get_sub_field('cake_gallery_mobile_slider_image'),
				);
			}
		}

	}
}
?>
<div class="content-section" style="background-image:url(<?php echo ot_get_option( 'general_bkg' ); ?>)">
	<div class="main-container">
		<div class="cake-gallery-title-section">
			<div class="stroke-title">
				<div class="stroke-title-line-left white-bkg"></div>
				<h2><?php echo $pageTitle; ?></h2>
				<div class="stroke-title-line-right white-bkg"></div>
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
		<div class="cake-gallery-slider-wrapper">
			<div class="slider cake-gallery-section-slider">
				<?php
					foreach( $gallery as $item ){
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
<?php

get_footer();
?>
