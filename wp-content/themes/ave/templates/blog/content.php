<?php
/**
 * The template part for displaying content
 *
 * @package Ave theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h2><?php the_title(); ?></h2>
	<?php the_excerpt(); ?>
	<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php esc_html_e( 'Read More', 'ave' ); ?></a>
</article>
