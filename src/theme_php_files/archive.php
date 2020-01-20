<?php
 get_header();

     $archiveTitle = '';
     $splitTitle = explode(':',get_the_archive_title());
     if ($splitTitle[0] === 'Author') {
         $archiveTitle = 'Created By '.$splitTitle[1];
     }else {
         $archiveTitle = $splitTitle[0];
     }

 page_banner(array(
   'title'=> $archiveTitle,
   'sub_title'=> get_the_archive_description()
 ))
?>

<div class="container container--narrow page-section">
<?php
  while (have_posts()) {
    the_post()?>
      <div class="post-item">
        <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
        <div class="metabox">
          <p>Posted By <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
        </div>
        <div class="generic-content">
          <?php the_excerpt(); ?>
          <p> <a class="btn btn--blue" href="<?php the_permalink()?>">Read More &raquo;</a> </p>
        </div>
      </div>
    <?php
  }
?>
</div>

<?php get_footer();?>
