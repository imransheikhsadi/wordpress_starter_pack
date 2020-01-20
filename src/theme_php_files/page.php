<?php get_header();
    while(have_posts()){
        the_post();
        page_banner();
?>


  <div class="container container--narrow page-section">
  <?php
  $parentElement = wp_get_post_parent_id(get_the_id());
    if ($parentElement) { ?>
      <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($parentElement);?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($parentElement);?></a> <span class="metabox__main"><?php the_title();?></span></p>
    </div>
    <?php }
  ?>

    <?php
    $testArray = get_pages(array(
      'child_of' => get_the_ID()
    ));
    if($parentElement or $testArray){ ?>
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_the_permalink($parentElement);?>"><?php echo get_the_title($parentElement);?></a></h2>
      <ul class="min-list">
        <?php
          if ($parentElement) {
            $findChild = $parentElement;
          } else{
            $findChild = get_the_ID();
          }

          wp_list_pages(array(
            'title_li'=> NULL,
            'child_of'=> $findChild
          ));
        ?>
      </ul>
    </div>
        <?php }?>

    <div class="generic-content">
      <?php the_content();?>
    </div>

  </div>

   <?php }

 get_footer();?>
