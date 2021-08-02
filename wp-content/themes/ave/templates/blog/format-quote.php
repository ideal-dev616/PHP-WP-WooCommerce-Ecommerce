<?php

$attributes = '';
if( 'only-title' === $style ) {
	$attributes = ' data-fittext="true" and  data-max-fontsize="75px"';
}
?>
<div class="post-quote">
    <blockquote cite="<?php liquid_helper()->get_option_echo( 'post-quote-url', 'url' ) ?>"<?php echo $attributes ?>>
        <?php the_content() ?>
        <footer>
            <cite><?php the_title() ?></cite>
        </footer>
    </blockquote>
</div>
