<?php
 get_header();
 page_banner(array(
   'title' => 'Our Campuses',
   'sub_title' => 'See our campus to learn more about us'
 ));
?>

<div class="container container--narrow page-section">
<ul class="link-list min-list">
    <?php
  while (have_posts()) {
    the_post()?>
  <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
    <?php

  }
?>
</ul>
</div>
<?php get_footer();?>
