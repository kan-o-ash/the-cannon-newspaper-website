<?php
/*
Template Name: abouttemplate
*/
?>

<?php get_header(); ?>

<style type="text/css">
  .authors {
    overflow: auto;
  }
  .author-cell {
    padding: 0;
    width: 33%;
    display: inline-block;
  }

  .author-link {
    width: 100%;
    margin: auto;
  }

  .author-inner{
    width: 100%;
    margin:auto;
  }

  .avatar-wrap {
    width: 100%;
    margin: 0;
  }

  .about-avatar {
    width: 160px;
    height:240px;
    margin: 10px auto;
  }

  .about-avatar img{
    width: 100%;
  }

  .about-info {
    font-size: 1.2em;
    width:  100%;
    text-align: center;
    color: black;
    position: relative;
    z-index: 2;
  }

  .about-info h6{
    font-size:1.4em;
  }

  .about-info a{
    width:245px;
    margin:auto;
  }

  .authors a {
    display:inline;
    text-decoration:none;
    font-size: 0.95em;
  }

  .author-table tr:nth-child(odd) td {
    background-color: transparent;
  }

  tr:nth-child(even) {
    background-color: #f4f4f4;
  }

  .author-cell:hover {
    background: rgba(0,0,0,0.05);
  }

  .page-template-abouttemplate-php #content .post-content{
    padding:0;
  } 

@media screen and (max-width: 980px) {
  .author-cell {
    width:50%;
  }
  .about-avatar img{
    //width: 150px;
  }

}

@media screen and (max-width: 640px) {
  .author-cell {
    width:50%;
  }

  .about-avatar img{
    //width: 140px;
  }

  .authors a {
    font-size: 12px;
  }
}
</style>

<script type="text/javascript">
$ = jQuery
$(document).ready(function() {
  $('#masonry').masonry({
   columnWidth: 297,
   itemSelector: '.author-cell'
  }).imagesLoaded(function() {
   $('#masonry').masonry('reload');
  });
});

</script>

<!--BEGIN #content -->

<div id="content">  

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <!-- #hentry-wrap -->
    <div id="hentry-wrap">
      <!--BEGIN .hentry -->
      <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <!--BEGIN .post-header-->
        <div class="post-header">
          <div class="inner">
            <h2 class="post-title">About The Cannon</h2>
            <!--END .post-header -->
          </div>
          <!--BEGIN .post-content -->
          <div class="post-content">
            <p style="text-align: left; font: normal 13px/1.8 'Merriweather', serif;">The Cannon is the official newspaper of the University of Toronto <a href="http://skulepedia.ca/wiki/Engineering_Society" title="Engineering Society" target="_blank">Engineering Society</a>.
              Established in 1978, it serves the undergraduate students of the Faculty of Applied Science and Engineering, with a circulation of up to 4000 across the University of Toronto campus.
              It is one of two newspapers funded by the Engineering Society, and is the more serious of the two.</p>
            <h2 class="post-title" style="text-align:center;padding: 0; background:none;">Meet the team</h2>
            <h2 class="post-title" style="text-align:center;">1T2 - 1T3</h2>

            <?php /*
              $authors = get_users('orderby=mata_value');
              $args = array(
                'orderby'  => 'meta_value',
                'order' => 'ascending',
                'meta_key' => 'order',
                'meta_query' => array(
                ), // End of meta_query
                'exclude' => array(
                  1
                ),
              );
            $q = new WP_User_Query($args);*/
            $order = $wpdb->get_results("SELECT DISTINCT user_id FROM $wpdb->usermeta WHERE meta_key='order' ORDER BY meta_value ASC", "ARRAY_N");
            $authors = array();
            foreach($order as $aid)
              $authors[] = new WP_User($aid[0]);

            $count = 0;
            ?> 
            <div class="authors" id="masonry">

              <?php foreach ($authors as $curauth) { ?>
              <div class="author-cell isotope">
                <div class="author-inner">
                  <a class="author-link" href="<?php echo get_author_posts_url($curauth->ID); ?>">
                    <div class="avatar-wrap">
                      <div class="about-avatar"> <?php //echo $curauth; ?>
                        <?php 
                          $imgs_rel_dir = "/images/authors/";
                          $img_rel_path = $imgs_rel_dir.$curauth->first_name."-web.jpg";
                          $img_path = get_template_directory().$img_rel_path;
                          if (file_exists($img_path)) $img_url = get_bloginfo('template_directory').$img_rel_path;
                          else $img_url = get_bloginfo('template_directory').$imgs_rel_dir."placeholder.jpg";
                        ?>
                        <img src="<?php echo $img_url; ?>"/>
                      </div>
                    </div>
                  </a>
                  <?php 
                    $info = '<h2>'.$curauth->first_name.' '.$curauth->last_name."</h2><br />".$curauth->aim."<br />".$curauth->yim; 
                    if ($count <= 10){
                      if ($curauth->first_name == "Maddy"){
                        $curauth_email = "arts.culture@cannon.skule.ca";
                      }
                      else{ $curauth_email = $curauth->user_email; }
                      $info = $info . '<br /><a href="mailto:' .$curauth_email.'">'.$curauth_email."</a>";
                    }
                  ?>
                  <div class="about-info"><?php echo $info ?></div>
                </div>
              </div>
              <?php $count++;} ?>
            </div>
            <!--END .post-content -->
          </div>
        <!--END .hentry-->  
        </div>
      </div>
    <?php endwhile; else : ?>
    <?php endif; ?>
  </div>
<!-- /#hentry-wrap -->
</div>
<!-- #content -->
<?php get_footer(); ?>