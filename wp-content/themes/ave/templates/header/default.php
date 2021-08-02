<?php

/**
* Default header
*
* @package Ave
*/

?>
<header class="main-header lqd-main-header-default">

	<div class="mainbar-wrap">
	
		<div class="container mainbar-container">
	
			<div class="mainbar">
	
				<div class="row mainbar-row">
	
					<div class="col-auto">
	
						<div class="navbar-header">
							<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<span class="navbar-brand-inner">
									<img class="logo-default" src="<?php liquid_logo_url(); ?>" alt="<?php echo bloginfo( 'name' ) ?>" />
								</span><!-- /.navbar-brand-inner -->
							</a>
							<?php liquid_header_mobile_trigger_button( array( 'class' => 'navbar-toggle collapsed nav-trigger style-mobile' ) ); ?>
						</div><!-- /.navbar-header -->
						
					</div><!-- /.col -->
					
					<div class="col">
						
						<div class="collapse navbar-collapse" id="main-header-collapse">
							<?php
	
								if( has_nav_menu( 'primary' ) ) :
	
									wp_nav_menu( array(
										'theme_location' => 'primary',
										'container'      => 'ul',
										'before'         => false,
										'after'          => false,
										'link_before'    => '<span class="link-icon"></span><span class="link-txt"><span class="link-ext"></span><span class="txt">',
										'link_after'     => '<span class="submenu-expander"> <i class="fa fa-angle-down"></i> </span></span></span>',
										'menu_id'        => 'primary-nav',
										'menu_class'     => 'main-nav main-nav-hover-underline-2 nav',
										'items_wrap'     => '<ul id="%1$s" class="%2$s" data-submenu-options=\'{ "toggleType": "fade", "handler": "mouse-in-out" }\' >%3$s</ul>',
										'walker'         => class_exists( 'Liquid_Mega_Menu_Walker' ) ? new Liquid_Mega_Menu_Walker : '',
									 ) );
	
								 else:

									wp_page_menu( array(
										'container'   => 'ul',
										'before'      => false,
										'after'       => false,
										'link_before' => '<span class="link-icon"></span><span class="link-txt"><span class="link-ext"></span><span class="txt">',
										'link_after'  => '<span class="submenu-expander"> <i class="fa fa-angle-down"></i> </span></span></span>',
										'menu_id'     => 'primary-nav',
										'menu_class'  => 'main-nav main-nav-hover-underline-2 nav',
										'depth'       => 3
									) );
	
								endif;
	
							?>
						</div><!-- /.navbar-collapse -->
	
					</div><!-- /.col -->
					
					<div class="col-auto">

						<div class="header-module">
	
							<?php get_template_part( 'templates/header/header', 'search' ); ?>
							
						</div><!-- /.header-module -->

				</div><!-- /.col -->
	
				</div><!-- /.row mainbar-row -->
	
			</div><!-- /.mainbar -->
	
		</div><!-- /.container -->
	
	</div><!-- /.mainbar-wrap -->

</header>