<style type="text/css">

body { background: #F9F9F9; }

.dt-overlay-box {
	width: 600px;
	margin: 225px auto;
	padding: 20px;
	text-align: center;
	font: normal 13px/1.4 'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, sans-serif;
	color: #777;
	background: #FFFFE0;
	border: 1px solid #E6DB55;
	-moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px;
}

.dt-overlay-box h2 {
	margin-bottom: 10px;
	color: #333;
	font: normal 24px/1 Georgia, "Times New Roman", "Bitstream Charter", Times, serif;
}

.dt-overlay-box a {	color: #21759B; }
	.dt-overlay-box a:hover { color: #D54E21; }

</style>
<script type="text/javascript">
	jQuery(document).ready(function(){

		jQuery('#wrapper').html('');

		var html='<div class="dt-overlay-box"><h2>Hi there! Don\'t worry, you didn\'t break anything.</h2><p>It just looks like you still need to configure your <a href="<?php echo admin_url(''); ?>admin.php?page=<?php echo DT_MAINMENU_NAME; ?>">theme options</a>.';

		jQuery('#wrapper').html(html);

	});
</script>