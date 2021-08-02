<?php 

extract( $atts );

?>
<div class="liquid-twitter-feed">

	<?php $this->get_twitter_icon(); ?>

	<ul class="liquid-twitter-feed-list">
		<li>
			<?php $this->get_tweet_data(); ?>
		</li>
	</ul>
</div><!-- /.liquid-twitter-feed -->