<?php
/**
 * The template for displaying the header
 *
 * @package Ave theme
 */

?><!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>
<head <?php liquid_helper()->attr( 'head' ); ?>>

	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ) ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> <?php liquid_helper()->attr( 'body' ); ?>>

	<?php liquid_action( 'before' ) ?>

	<div id="wrap">

		<?php
			liquid_action( 'before_header' );
			liquid_action( 'header' );
			liquid_action( 'after_header' );
		?>

		<main <?php liquid_helper()->attr( 'content' ); ?>>
			<?php liquid_action( 'before_content' ); ?>
