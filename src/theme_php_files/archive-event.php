<?php
 get_header();
 page_banner(array(
   'title' => 'See Our All Events',
   'sub_title' => 'Keep track of us'
 ));
?>

<div class="container container--narrow page-section">
    <?php
      while (have_posts()) {
        the_post();
        get_template_part('template-parts/event');
      }
    ?>
</div>
<hr class="section-break">
<p style="text-align: center"><a href="<?php echo site_url('index.php/past-events');?>">Past Post</a></p>
<?php get_footer();?>
