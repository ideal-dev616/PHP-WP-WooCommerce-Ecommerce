<div class="titlebar">
  
  <div class="titlebar-overlay ld-overlay"></div><!-- /.titlebar-overlay -->
  
  <div class="titlebar-inner">

    <div class="container titlebar-container">

      <div class="row titlebar-container">

        <div class="titlebar-col col-md-6">

					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php bbp_breadcrumb(); ?>

        </div><!-- /.col-md-6 -->

        <div class="titlebar-col col-md-6 text-md-right">
	        
	        	<?php if ( bbp_has_replies() && is_singular( 'topic' ) ) : ?>
	        	
					<?php bbp_get_template_part( 'pagination', 'replies'    ); ?>

				<?php elseif ( !bbp_is_forum_category() && bbp_has_topics() ) : ?>

					<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>
		
				<?php endif; ?>

        </div><!-- /.col-md-6 -->

      </div><!-- /.row -->

    </div><!-- /.container -->

  </div><!-- /.titlebar-inner -->

</div><!-- /.titlebar -->