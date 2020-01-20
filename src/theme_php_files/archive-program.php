<?php
 get_header();
 page_banner(array(
   'title' => 'All Programs',
   'sub_title' => 'There have something for everyone.Have a look Palase!'
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
