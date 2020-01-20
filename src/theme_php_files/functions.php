<?php
// conlole log
  function console_log($args)
  {
    ?>
    <?php $js_array = json_encode($args);?>
    <?php $array_methods = json_encode(get_class_methods($args)); ?>
      <script type='text/javascript'>
          console.log(<?php echo $js_array; ?>);
          console.log(<?php echo $array_methods; ?>);
      </script>
    <?php
  }
?>
<?php 

  require get_theme_file_path('/inc/search-route.php');

?>

<?php
    function theme_custom_rest()
    {
      register_rest_field('post','authorName', array(
        'get_callback' => function (){return get_the_author();}
      ));
    }

    add_action('rest_api_init','theme_custom_rest');

    function theme_files(){

        wp_enqueue_script('bundlejs',get_theme_file_uri('/js/scripts-bundled.js'),NULL,'1.0.0',true);
        wp_enqueue_style('custom-google-font','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
        wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('theme_main_style',get_stylesheet_uri());
    }
    add_action('wp_enqueue_scripts','theme_files');

    function theme_features(){
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_image_size('professorLandscape',400,260,true);
        add_image_size('professorPortrait',480,650,true);
        add_image_size('pageBanner',1500,350,true);
    }

    add_action('after_setup_theme','theme_features');


    function event_archive_adjusment_query($query)
    {
        if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
            $query->set('posts_per_page' , -1);
            $query->set('orderby' , 'title');
            $query->set('order' , 'ASC');
        }

        if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
            $today = date('Ymd');
            $query->set('meta_key' , 'event_date');
            $query->set('orderby' , 'meta_value_num');
            $query->set('order' , 'ASC');
            $query->set('meta_query' , array(
                array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric'
                )
            ));
        }
    }
    add_action('pre_get_posts', 'event_archive_adjusment_query');
?>

<?php
    function page_banner($args=NULL)
    {
      //Logic goes hebre
      if (!$args['title']) {
        $args['title'] = get_the_title();
      }
      if (!$args['sub_title']) {
        $args['sub_title'] = get_field('page_banner_subtitle') ?? '';
      }
      if (!$args['image']) {
        $args['image'] =  get_field('page_banner_background_image')['sizes']['pageBanner'] ?? get_theme_file_uri('/images/ocean.jpg');
      }
      //returned html
      ?>
      <div class="page-banner">
          <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['image'] ?>)"></div>
          <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title']?></h1>
            <div class="page-banner__intro">
              <p><?php echo $args['sub_title']; ?></p>
            </div>
          </div>
      </div>
      <?php
    }
?>

<?php
  function mapKey($api){
    $api['key'] = 'AIzaSyDb13nj27_MCrNix_QUqiWaUyXIXJ9vnxA';
    return $api;
  }
  add_filter('acf/fields/google_map/api', 'mapKey');
?>
