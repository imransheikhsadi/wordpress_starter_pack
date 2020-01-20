<?php
  get_header();
  page_banner(array(
    'title' => 'See Our All Past Enents',
    'sub_title' => 'Keep track of us'
  ));
?>

<div class="container container--narrow page-section">
    <?php
        $todey = date('Ymd');
        $pastEvents = new WP_Query(array(
            'paged' => get_query_var('paged',1),
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    'compare' => '<',
                    'value' => $todey,
                    'type' => 'numeric'
                )
            )
        ));

  while ($pastEvents->have_posts()) {
    $pastEvents->the_post();
    get_template_part('template-parts/event');
   }
    echo paginate_links(array(
        'total' => $pastEvents->max_num_pages
    ));
?>

</div>

<?php get_footer();?>
