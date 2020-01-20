<?php
 get_header();
 page_banner();
?>

<?php while (have_posts()) : the_post(); ?>
    <div class="container container--narrow page-section">
          <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo site_url('index.php/blog'); ?>">
              <i class="fa fa-home" aria-hidden="true"></i> Blog Home</a>
              <span class="metabox__main"><?php the_time('n-j-y'); ?></span>
            </p>
          </div>
          <div class="post-item">
              <div class="generic-content">
                  <?php the_content(); ?>
              </div>
          </div>
    </div>
<?php endwhile; get_footer(); ?>
