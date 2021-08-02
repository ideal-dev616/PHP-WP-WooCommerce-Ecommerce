<?php
/**
 * Liquid_TagBlog class for blog posts page and blog archives
 */

class Liquid_TagBlog extends LD_Blog {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {
		$this->atts = array(
			'style' => liquid_helper()->get_option( 'tag-blog-style' ),

			'enable_parallax' => liquid_helper()->get_option( 'tag-blog-enable-parallax' ),
			'show_meta' => liquid_helper()->get_option( 'tag-blog-show-meta' ),
			'meta_type' => liquid_helper()->get_option( 'tag-blog-meta-type' ),
			'one_category' => liquid_helper()->get_option( 'tag-blog-one-category' ),
			'post_excerpt_length' => liquid_helper()->get_option( 'tag-blog-excerpt-length' ),
			'grid_columns' => '2',
			'pagination'      => 'pagination',
		);

		$this->render( $this->atts );

	}

	/**
	 * [render description]
	 * @method render
	 * @return [type] [description]
	 */
	public function render( $atts, $content = '' ) {

		extract($atts);

		// check
		$located = locate_template( "templates/blog/tmpl-$style.php" );
		if ( ! file_exists( $located ) ) {
			return;
		}
		$masonry_sizes = array(
			'shortest' => 'h-300',
			'short'    => 'h-300',
			'stall'    => 'h-300',
			'taller'   => 'h-300',
		);
		$i = 0;

		$before = $after = '';

		echo '<div class="liquid-blog-posts ' . $this->get_id() . '">';
			
			if( 'timeline' === $style ) {
				echo '<div class="liquid-blog-grid liquid-blog-style-timeline row" data-liquid-masonry="true">';	
				$before = '<div class="col-md-6 masonry-item">';
				$after  = '</div>';
			}
			elseif( 'classic-full' === $style ) {
				echo '<div class="liquid-blog-grid liquid-blog-style-classic row">';
				$before = '<div class="col-md-12">';
				$after  = '</div>';		
			}
			elseif( 'split' === $style ) {
				echo '<div class="liquid-blog-grid liquid-blog-style-split row" data-liquid-masonry="true" data-masonry-options=\'{ "stagger": 50, "hiddenStyle": { "transform": "translateY(100px)", "opacity": 0 }, "visibleStyle": { "transform": "translateY(0)", "opacity": 1 }, "filtersID": "#' . $filter_id . '" }\'>';
				$before = '<div class="col-sm-12 masonry-item ">';
				$after = '</div>';
			}
			elseif( 'masonry' === $style ) {
				echo '<div class="liquid-blog-grid liquid-blog-grid liquid-blog-style-masonry liquid-blog-grid-columns-4" data-liquid-masonry="true">';
				$before = '<div class="col-lg-3 col-md-4 col-sm-6 masonry-item">';
				$after  = '</div>';		
			}
			elseif( 'minimal' === $style ) {
				echo '<div class="liquid-blog-grid liquid-blog-style-square row mx-0" data-liquid-masonry="true">';
				$before = '<div class="col-md-4 masonry-item px-0">';
				$after  = '</div>';
			}
			elseif( 'square' === $style ) {
				echo '<div class="liquid-blog-grid liquid-blog-style-square row" data-liquid-masonry="true">';
				$before = '<div class="col-md-4 masonry-item">';
				$after  = '</div>';
			}
			elseif( 'featured-fullwidth' === $style ) {
				echo '<div class="liquid-blog-grid liquid-blog-style-fullwidth row">';
				$before = '<div class="col-xs-12">';
				$after  = '</div>';
			}
			elseif( 'carousel' === $style ) {
				echo '<div class="liquid-blog-grid liquid-blog-style-carousel"><div class="carousel-container carousel-nav-circle carousel-nav-bordered carousel-nav-sm">
				' . $carousel_heading . '
				<div class="carousel-items row" data-lqd-flickity=\'{ "equalHeightCells": true, "fullwidthSide": true, "prevNextButtons": true, "navArrow": 6, "buttonsAppendTo": "#' . $section_id . '" }\'>';
				$before = '<div class="carousel-item col-lg-8 col-md-6 col-sm-12">';
				$after  = '</div>';
			}
			elseif( 'carousel-filter' === $style ) {
				echo '<div class="carousel-container carousel-nav-floated carousel-nav-vertical carousel-nav-left carousel-nav-circle carousel-nav-solid carousel-nav-lg carousel-nav-shadowed" data-filterable-carousel="true">
						<div class="carousel-items row" data-lqd-flickity=\'{ "filters": "#' . $filter_id . '", "prevNextButtons": true, "navArrow": 1, "fullwidthSide": true, "navOffsets": { "nav": {"left": -10, "top": 200} } }\'>';
				$before = '<div class="carousel-item col-lg-8 col-md-6 col-sm-12">';
				$after  = '</div>';		
			}
			elseif( 'metro' === $style || 'metro-alt' === $style ) {
				echo '<div class="liquid-blog-grid row">';
				echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" class="liquid-lp-gradient" width="0" height="0">
						<defs>
							<linearGradient id="liquid-lp-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
								<stop offset="0%" />
								<stop offset="100%" />
							</linearGradient>
						</defs>
					</svg>';		
				$before = '<div class="col-md-10 col-md-offset-1 col-lg-6 col-lg-offset-0 col-xs-12">';
				$after  = '</div>';		
			}
			else {
				echo '<div class="liquid-blog-grid row">';
				$before = '<div class="' . $this->get_grid_class() . '">';
				$after  = '</div>';
			}

			while( have_posts() ): the_post();

				$post_classes = array( 'liquid-lp' );
				if( 'text-date' === $style ) {
					$post_classes[] = 'liquid-lp-time-aside';
				}
				elseif( 'grid' === $style ) {
					$post_classes[] = 'liquid-blog-item liquid-blog-item-grid liquid-blog-scheme-dark';
				}
				elseif( 'metro' === $style || 'metro-alt' === $style ) {
					$post_classes[] = 'liquid-lp-sp-block';
					if( 'metro-alt' === $style ) {
						$post_classes[] = 'liquid-lp-sp-block-alt';	
					}
					$featured = get_post_meta( get_the_ID(), 'post-metro-featured', true );
					if( 'featured' ===  $featured ) {
						$post_classes[] = 'liquid-lp-featured';
					}
					elseif( 'instagram' === $featured ) {
						$post_classes[] = 'liquid-lp-sp-instagram';				
					}
					else{
						$i++;
						if( $i % 3 == 0 || $i % 4 == 0 ) {
							$post_classes[] = 'liquid-lp-reverse';
						}
						if( $i % 4 == 0 ) {
							$i = 0;
						}
					}
				}
				elseif( 'square' === $style ) {
					$post_classes[] = 'liquid-lp liquid-blog-item liquid-blog-contents-inside liquid-blog-item-square liquid-blog-scheme-light round h-450';
					$i++;
					if( 1 === $i ) {
						$before = '<div class="col-md-6 masonry-item">';
					}
					else {
						$before = '<div class="col-md-3 col-sm-6 masonry-item">';
					}			
				}
				elseif( 'timeline' === $style ) {
					$post_classes[] = 'liquid-blog-item liquid-blog-item-timeline liquid-blog-scheme-dark liquid-blog-scheme-dark-alt';
				}
				elseif( 'masonry' === $style ) {
					$post_size_meta = get_post_meta( get_the_ID(), 'liquid-post-height', true );
					$post_size = isset( $masonry_sizes[ $post_size_meta ] ) ? $masonry_sizes[ $post_size_meta ] : 'h-300';
					$post_classes[] = 'liquid-blog-item liquid-blog-contents-inside liquid-blog-item-masonry liquid-blog-scheme-light liquid-blog-cloned-title ' . $post_size;
				}
				elseif( 'minimal' === $style ) {
					$post_classes[] = 'liquid-lp liquid-blog-item liquid-blog-item-gray liquid-blog-scheme-dark';
				}
				elseif( 'featured-fullwidth' === $style ) {
					$post_classes[] = 'liquid-blog-item liquid-blog-contents-inside contents-middle liquid-blog-item-fullwidth liquid-blog-scheme-light liquid-blog-scheme-light-alt h-100';
				}
				elseif( 'carousel' === $style ) {
					$post_width_meta = get_post_meta( get_the_ID(), 'post-carousel-width', true );
					$post_width = !empty( $post_width_meta ) ? $post_width_meta : '8';
					$before = '<div class="carousel-item col-lg-' . $post_width . ' col-md-6 col-sm-12">';
					$post_classes[] = 'liquid-blog-item liquid-blog-item-carousel liquid-blog-contents-inside contents-bottom liquid-blog-scheme-light liquid-blog-scheme-light-alt h-300';
				}
				elseif( 'split' === $style ) {
					$before = '<div class="col-sm-12 masonry-item ' . $this->entry_term_classes() . '">';
					$post_classes[] = 'liquid-blog-item liquid-blog-item-split liquid-blog-scheme-dark liquid-blog-scheme-dark-alt';
				}
				elseif( 'classic-full' === $style ) {
					$post_classes[] = 'liquid-blog-item liquid-blog-item-grid liquid-blog-scheme-dark';
				}
			
				$post_classes = join( ' ', get_post_class( $post_classes, get_the_ID() ) );
			
				$attributes = array(
					'id'    => 'post-' . get_the_ID(),
					'class' => $post_classes
				);

				printf( '%s <article%s>', $before, ld_helper()->html_attributes( $attributes ) );

					if( 'quote' === get_post_format() ) {
						$quote_located = locate_template( 'templates/blog/format-quote.php' );
						include $quote_located;
					}
					else {
						include $located;
					}

				echo '</article>' . $after;

				// Adjust the timestamp settings for next loop
				if( 'timeline' === $style ) {
					$prev_post_timestamp = $post_timestamp;
					$prev_post_month = $post_month;
					$prev_post_year = $post_year;
					$post_count++;
				}

			endwhile;

			echo '</div><!--/ .row -->';
			
			// Pagination
			if( 'pagination' === $atts['pagination'] ) {
				
				$max = $GLOBALS['wp_query']->max_num_pages;
		
				// Set up paginated links.
		        $links = paginate_links( array(
					'type' => 'array',
					'prev_next' => true,
					'prev_text' => '<span aria-hidden="true">' . wp_kses_post( __( '<i class="fa fa-angle-left"></i>', 'ave' ) ) . '</span>',
					'next_text' => '<span aria-hidden="true">' . wp_kses_post( __( '<i class="fa fa-angle-right"></i>', 'ave' ) ) . '</span>',
				) );
		
				if( !empty( $links ) ) {
					printf( '<div class="page-nav"><nav aria-label="'. esc_attr__( 'Page navigation', 'ave' ) .'"><ul class="pagination"><li>%s</li></ul></nav></div>', join( "</li>\n\t<li>", $links ) );
				}
			}
		echo '</div>';
	}
}
new Liquid_TagBlog;