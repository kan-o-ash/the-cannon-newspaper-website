			<!--END #content -->
			</div>

		<!--END #main -->
		</div>

	<!--END #page -->
    </div>

<!--END #wrapper -->
</div>

<!--BEGIN #bottom -->
<div id="bottom">

	<!--BEGIN #footer -->
	<div id="footer">
		
		<!--BEGIN #footer-menu -->
		<div id="footer-menu" class="clearfix">
			<?php if ( has_nav_menu( 'footer-menu' ) ) : wp_nav_menu( array( 'theme_location' => 'footer-menu', 'depth' => '1' ) ); endif; ?>
			<h2 style="float:left">Subscribe to The Cannon:</h2>
			<ul class="social">
				<li><div class="fb-like" data-href="https://www.facebook.com/cannon.news" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></li>
  				<li><a target="_blank" href="https://facebook.com/cannon.news"><img src="<?php bloginfo('template_directory'); ?>/images/social_facebook.png" /></a></li>
  			<!--	<li><div class="fb-like" data-href="https://www.facebook.com/cannon.news" data-send="false" data-width="200" data-show-faces="true" data-colorscheme="dark"></div><li/>-->
  				<li><a target="_blank" href="https://twitter.com/#!/cannon_news"><img src="<?php bloginfo('template_directory'); ?>/images/social_twitter.png" /></a></li>
  				<li><a target="_blank" href="http://feeds.feedburner.com/the-cannon" title="RSS 2.0 Feed"><img width="32px" src="<?php bloginfo('template_directory'); ?>/images/rss.png" alt="RSS 2 Feed" /></a></li>
			</ul>
		<!--END #footer-menu -->
		</div>
		
		<!--BEGIN #credits -->
		<div id="credits">
			<div id="credit-content">

			</div>
		<!--END #credits -->
		</div>

	<!--END #footer -->
	</div>

<!--END #bottom -->
</div>

<script> // for contact form
	var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
</script>

<?php wp_footer(); ?>

</body>

</html>