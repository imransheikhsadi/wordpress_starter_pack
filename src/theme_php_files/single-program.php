<?php
    $relatedProfessor = new WP_Query(array(
      'posts_per_page'=> -1,
      'post_type' => 'professor',
      'orderby' => 'title',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'related_programs',
          'compare' => 'LIKE',
          'value' => '"'.get_the_ID().'"'
        )
      )
    ));

    $todey = date('Ymd');
    $relatedEvents = new WP_Query(array(
      'posts_per_page'=> 2,
      'post_type' => 'event',
      'meta_key' => 'event_date',
      'orderby' => 'meta_value_num',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $todey,
          'type' => 'numeric'
        ),
        array(
          'key' => 'related_programs',
          'compare' => 'LIKE',
          'value' => '"'.get_the_ID().'"'
        )
      )
    ));
?>


<?php
  get_header();
  page_banner();
?>

<div class="container container--narrow page-section">
    <?php while (have_posts()): the_post() ?>
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i>All Programs</a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>

    <div class="post-item">
        <div class="generic-content">
          <?php the_field('program_content'); ?>
        </div>
    </div>
    <?php endwhile; ?>

    <?php if ($relatedProfessor->have_posts()) :?>
    <h2><?php echo get_the_title();?> Professors</h2>
      <ul class="professor-cards">
      <?php while ($relatedProfessor->have_posts()) :$relatedProfessor->the_post();?>
        <li class="professor-card__list-item">
          <a class="professor-card" href="<?php the_permalink(); ?>">
            <img src="<?php the_post_thumbnail_url('professorLandscape'); ?>" class="professor-card__image" alt="">
            <span class="professor-card__name"><?php the_title(); ?></span>
          </a>
        </li>
      <?php endwhile; ?>
      </ul>
    <?php endif; ?>



<?php wp_reset_postdata(); ?>
<?php if ($relatedEvents->have_posts()) { ?>
    <h2><?php the_title();?> Events</h2>';
    <?php
      while ($relatedEvents->have_posts()) {
        $relatedEvents->the_post();
        get_template_part('template-parts/event');
      }
    }
    ?>
</div>
<?php get_footer();?>
