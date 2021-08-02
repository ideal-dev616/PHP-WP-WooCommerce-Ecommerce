<?php

global $post;

$style = liquid_helper()->get_option( 'post-style', 'cover-spaced' );
$style = !empty( $style ) ? $style : 'cover-spaced';

$featured_image = 'liquid-cover-spaced';

$figure_atts     = array();
$enable_parallax = liquid_helper()->get_option( 'post-parallax-enable' );
$alt_image_src   = liquid_helper()->get_option( 'liquid-post-cover-image' );
$format          = get_post_format();
$gallery_ids     = get_post_meta( get_the_ID(), 'post-gallery', true );

if( isset( $alt_image_src['media']['id'] ) ){
	$image_src = wp_get_attachment_url( $alt_image_src['media']['id'] );
}
else {
	$image_src = isset( $alt_image_src['background-image'] ) ? esc_url( $alt_image_src['background-image'] ) : get_the_post_thumbnail_url( get_the_ID(), 'full' );	
}

if( 'default' === $style ) { 
	
	
	if( 'gallery' == $format && $gallery_ids )  { 
		
	?>
		
		<div class="blog-single-cover" data-inview="true" data-inview-options='{ "onImagesLoaded": true }'>
			<div class="carousel-container cover-carousel carousel-nav-floated carousel-nav-circle carousel-nav-bordered">
				<div class="carousel-items row mx-0" id="blog-cover-carousel" data-lqd-flickity='{ "prevNextButtons": true, "navArrow": "6", "navOffsets": { "prev": 15, "next": 15 } }'>

				<?php foreach( $gallery_ids as $image ) {  ?>

					<div class="col-sm-12 carousel-item">

						<figure class="blog-single-media">
							<img src="<?php echo esc_url( $image['image'] ); ?>" alt="Blog single" />
						</figure>
						
					</div><!-- /.col-sm-12 -->

				<?php } ?>

				</div><!-- /.carousel-items -->
			</div><!-- /.carousel-container -->
		</div><!-- /.blog-single-cover -->			
			
<?php
	}
	else {
		if( '' !== get_the_post_thumbnail() ) {
	
			$figure_atts[] = 'data-responsive-bg="true"';
			
			if( 'off' !== $enable_parallax ) {
				
				$figure_atts[] = 'data-parallax="true"';
				$figure_atts[] = 'data-parallax-options=\'{ "parallaxBG": true, "triggerHook": "onCenter" }\'';
				$figure_atts[] = 'data-parallax-from=\'{ "translateY": "-15%" }\'';
				$figure_atts[] = 'data-parallax-to=\'{ "translateY": "20%" }\'';
			}
	?>
			<div class="blog-single-cover" data-inview="true" data-inview-options='{ "onImagesLoaded": true }' style="background-color: #dfdfe1;" data-reveal="true" data-reveal-options='{ "direction": "tb", "bgcolor": "#f0f3f6" }'>
				<figure class="blog-single-media hmedia" <?php echo implode( ' ', $figure_atts ); ?>>
					<?php the_post_thumbnail( 'liquid-default-post', array( 'itemprop' => 'url' ) ); ?>
				</figure>
			</div><!-- /.blog-single-cover -->	
	<?php 
	
		}
	}
} 
elseif( 'cover' === $style || 'cover-spaced' === $style  ) {

	if( 'gallery' == $format && $gallery_ids )  { 
		
		if( 'cover' === $style ) {

		?>
	
		<div class="carousel-container cover-carousel carousel-nav-circle carousel-nav-bordered">
	
			<div class="carousel-items row mx-0" id="blog-cover-carousel" data-lqd-flickity='{ "prevNextButtons": true, "buttonsAppendTo": ".blog-single-details-extra", "navArrow": "6" }'>
	
				<?php foreach( $gallery_ids as $image ) {  ?>
	
				<div class="col-sm-12 carousel-item">
	
					<figure class="blog-single-media" style="background-image: url(<?php echo esc_url( $image['image'] ); ?>);" data-parallax="true" data-parallax-options='{ "parallaxBG": true }'>
						<img src="<?php echo esc_url( $image['image'] ); ?>" alt="Blog single">
					</figure>
					
				</div><!-- /.col-sm-12 -->
	
				<?php } ?>
	
			</div><!-- /.carousel-items -->
	
		</div><!-- /.carousel-container -->
		
		<?php
		
		} 
		else {

		?>
	
			<div class="carousel-container cover-carousel carousel-nav-floated carousel-nav-circle carousel-nav-bordered">
		
				<div class="carousel-items row" id="blog-cover-carousel" data-lqd-flickity='{ "prevNextButtons": true, "navArrow": "6", "navOffsets": { "prev": 30, "next": 30 } }'>	
				<?php foreach( $gallery_ids as $image ) {  ?>
	
				<div class="col-sm-12 carousel-item">
	
				<figure class="blog-single-media" style="background-image: url(<?php echo esc_url( $image['image'] ); ?>);" data-parallax="true" data-parallax-options='{ "parallaxBG": true, "triggerHook": "onLeave" }' data-parallax-from='{ "translateY": "0%" }' data-parallax-to='{ "translateY": "20%" }'>
					<img src="<?php echo esc_url( $image['image'] ); ?>" alt="Blog single">
				</figure>
					
				</div><!-- /.col-sm-12 -->
	
				<?php } ?>
	
			</div><!-- /.carousel-items -->
	
		</div><!-- /.carousel-container -->
		
		<?php			
			
		}
		
	}	
	else {
		if( '' !== $image_src ) {
			$figure_atts[] = 'data-responsive-bg="true"';
	
			if( 'off' !== $enable_parallax ) {
				$figure_atts[] = 'data-parallax="true"';
				$figure_atts[] = 'data-parallax-options=\'{ "parallaxBG": true, "triggerHook": "onLeave" }\'';
				$figure_atts[] = 'data-parallax-from=\'{ "translateY": "0%" }\'';
				$figure_atts[] = 'data-parallax-to=\'{ "translateY": "20%" }\'';
			}
	?>
			<figure class="blog-single-media post-image hmedia" <?php echo implode( ' ', $figure_atts ); ?>>
				<?php 
					if( isset( $alt_image_src['background-image'] ) && !empty( $alt_image_src['background-image'] ) ) { 
						$img_id = attachment_url_to_postid( $image_src );
						if( empty( $img_id ) ) {
							$img_id = $alt_image_src['media']['id'];
						}
						echo wp_get_attachment_image( $img_id, 'liquid-cover-post', false, array( 'itemprop' => 'url' ) );
				?>
				<?php
					
					} else { 
					
				?>
					<?php the_post_thumbnail( 'liquid-cover-post', array( 'itemprop' => 'url' ) ); ?>
				<?php } ?>
			</figure>	
	<?php 
	
		} 
	}

}
elseif( 'slider' === $style ) { 
	
	$gallery = get_post_meta( get_the_ID(), 'liquid-post-slider', true );
	if( ! empty( $gallery ) ) {
		$gallery = explode( ',', $gallery );
		
		if( 'off' !== $enable_parallax ) {
			$figure_atts[] = 'data-responsive-bg="true"';
			$figure_atts[] = 'data-parallax="true"';
			$figure_atts[] = 'data-parallax-options=\'{ "parallaxBG": true, "triggerHook": "onLeave" }\'';
			$figure_atts[] = 'data-parallax-from=\'{ "translateY": "0%" }\'';
			$figure_atts[] = 'data-parallax-to=\'{ "translateY": "20%" }\'';
		}
			
	}
	
?>
	
<div class="carousel-container cover-carousel">

	<div class="carousel-items row" id="blog-cover-carousel" data-lqd-flickity='{ "prevNextButtons": true, "buttonsAppendTo": "#blog-cover-carousel-thumbs", "navArrow": "1" }'>

		<?php foreach( $gallery as $slide ) {
			
			$image_src = wp_get_attachment_url( $slide );
			
		?>
		<div class="col-sm-12 carousel-item">

			<figure class="blog-single-media" style="background-image:url(<?php echo esc_url( $image_src ) ?>);" <?php echo implode( ' ', $figure_atts ); ?>>
				<?php echo wp_get_attachment_image( $slide, 'full', false ); ?>
			</figure>				

		</div><!-- /.col-sm-12 carousel-item -->	
		<?php } ?>

	</div><!-- /.carousel-items -->

</div><!-- /.carousel-container -->


<?php 

}
elseif( 'modern' === $style ) { 
	
	$image_src = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	if( '' !== $image_src ) {
		$figure_atts[] = 'data-responsive-bg="true"';

		if( 'off' !== $enable_parallax ) {
			$figure_atts[] = 'data-parallax="true"';
			$figure_atts[] = 'data-parallax-options=\'{ "parallaxBG": true }\'';
			$figure_atts[] = 'data-parallax-from=\'{ "translateY": "-20%" }\'';
			$figure_atts[] = 'data-parallax-to=\'{ "translateY": "0%" }\'';
		}
		?>
		<figure class="blog-single-media post-image hmedia" <?php echo implode( ' ', $figure_atts ); ?>>
			<?php 
				$img_id = attachment_url_to_postid( $image_src );
				echo wp_get_attachment_image( $img_id, 'full', false, array( 'itemprop' => 'url' ) );
			?>
		</figure>	
		<?php 

	} 	
	
}
?>