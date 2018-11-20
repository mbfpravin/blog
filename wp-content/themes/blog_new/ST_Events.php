<?php
/***************************
Template Name: Events
****************************/
get_header('main');
?>
<div id="page-contents">
  <div class="container">
    <div class="row">

      <!-- Newsfeed Common Side Bar Left
      ================================================= -->
      <div class="col-md-3 static">
          <h2><?php echo $post->post_title; ?></h2>
      </div>
 
      <div class="col-md-7">
        <?php
        
          global $post;
          $EventArgs = array(
              'post_type'     => 'Events',
              'numberposts' => -1,
              'order'         => 'DESC', 
              'orderby'       => 'post_date',
              'post_status'   => 'publish',
              'meta_query' => array(
                   array(
                       'key' => 'show_in_home',
                       'value' => 'yes'
                   )                                                
               ),   
          ); 
          $EventPages = get_posts($EventArgs);
        //     foreach($blogPages as $blogPage){
                 
        //  echo $postid = $blogPage->ID;
        // }
        // exit();
          foreach($EventPages as $EventPage){
                          $featImage = wp_get_attachment_url(get_post_thumbnail_id($EventPage->ID) );
                          $content = apply_filters('the_content',$EventPage->post_content);
          $usrid = get_current_user_id();
          $eventid = $EventPage->ID;
        ?>
        <div class="post-content">
          <img src="<?php echo $featImage ?>" alt="post-image" class="img-responsive post-image" />
          <div class="post-container">
            <div class="post-detail">
                <div class="user-info">
                  <h5><?php echo $EventPage->post_title; ?></h5>
                  <p class="text-muted">Posted on: <?php echo get_the_date( 'F jS, Y', $EventPage->ID); ?></p>
                </div>
                <div class="line-divider"></div>
                  <div class="post-text">
                    <p><?php echo $EventPage->post_excerpt; ?></p>
                     <a href="<?php echo get_permalink($EventPage->ID).'?id='.$EventPage->ID.''; ?>"><button  class="chBox" name="checkbox" > View more</button> </a>
                  </div>
            </div>
          </div>
        </div>
        <?php } ?>
    </div>
  </div>
</div>
<?php get_footer('main'); ?>