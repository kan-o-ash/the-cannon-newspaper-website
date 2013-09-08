<?php
/*
Template Name: abouttemplate
*/
?>

<?php get_header(); ?>

<style type="text/css">
    .author-cell {
        padding: 0;
    }

    .author-link {
        width: 100%;
        margin: auto;
    }

    .author-inner{
        width: 240px;
        margin:auto;
    }

    .about-avatar {
        width: 160px;
        height: 200px;
        margin: 10px auto;
    }

    .about-avatar img{
        width: 160px;
    }

    .about-info {
        font-size: 1.2em;
        width:  240px;
        text-align: center;
        color: black;
    }

    table a {
        display:block;
        text-decoration:none;
    }

    .author-table tr:nth-child(odd) td {
        background-color: transparent;
    }

    .author-table tr td:hover {
        background: rgba(0,0,0,0.1);
    }

    tr:nth-child(even) {
        background-color: #f4f4f4;
    }

    .page-template-abouttemplate-php #content .post-content{
        padding:0;
    }

</style>
<script type="text/javascript">
    // function fitCell(){
    //     if ( $('.author-cell').width() <= $('.about-avatar').width() + $('.about-info').width() ){
    //         $('.about-info').css({
    //             'float' : 'left',
    //             'margin-top' : '1%'
    //         });
    //     }
    //     else {
    //         $('.about-info').css({
    //             'float' : 'right',
    //             'margin-top' : '5%'
    //         });
    //     }

    // }

    // $(document).ready(){
    //     fitCell();
    // }

    // $(window).resize(fitCell());

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
                        <h2 class="post-title" style="padding: 0; background:none;">Meet the team</h2>
                        <h2 class="post-title">1T2 - 1T3</h2>
                    </div>
                <!--END .post-header -->
                </div>
                    
                <!--BEGIN .post-content -->
                <div class="post-content">

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


                    $chunkedAuthors = array_chunk($authors, 3);
                 ?> 
                <table class="author-table"> 
                    <tbody>
                        <?php foreach ($chunkedAuthors as $currRow) { ?>
                        <tr>
                            <?php foreach ($currRow as $curauth) {?>
                            <td class="author-cell">
                            <a class="author-link" href="<?php echo get_author_posts_url($curauth->ID); ?>">
                                <div class="author-inner">
                                    <div class="about-avatar"> <?php //echo $curauth; ?>
                                        <img src="<?php echo bloginfo('template_directory');?>/images/authors/<?php echo $curauth->first_name; ?>-web.jpg"/>
                                    </div>
                                    <?php 
                                        $info = $curauth->first_name.' '.$curauth->last_name."<br />".$curauth->aim."<br />".$curauth->yim; 
                                    ?>
                                    <div class="about-info"><?php echo $info ?></div>
                                </div>
                            </a>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                    
                <!--END .post-content -->
                </div>
                
            <!--END .hentry-->  
            </div>

			<?php endwhile; else : ?>

			<?php endif; ?>
        </div>
        <!-- /#hentry-wrap -->
        
    </div><!-- #content -->
<?php get_footer(); ?>