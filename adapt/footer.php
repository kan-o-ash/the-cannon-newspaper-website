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
  				<li><a target="_blank" href="https://facebook.com/cannon.news"><img src="<?php bloginfo('template_directory'); ?>/images/social_facebook.png" /></a></li>
  				<li><a target="_blank" href="https://twitter.com/#!/cannon_news"><img src="<?php bloginfo('template_directory'); ?>/images/social_twitter.png" /></a></li>
  				<!--<li><a href="<?php bloginfo('rss2_url'); ?>" title="RSS 2.0 Feed"><img height="32px" src="<?php bloginfo('template_directory'); ?>/images/rss.gif" width="15px" height="14px" alt="RSS 2 Feed" /></a></li>-->
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