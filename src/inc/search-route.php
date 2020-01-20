<?php 
    add_action('rest_api_init','register_search_api');

    function register_search_api()
    {
        register_rest_route('university/v1','search',array(
            'methods' => WP_REST_SERVER::READABLE,
            'callback' => 'search_results'
        ));
    }

    function search_results($data)
    {
        $mainQuery = new WP_Query(array(
            'post_type' => array('post','page','event','campus','professor','program'),
            's' => sanitize_text_field($data['term'])
        ));

        $results = array(
            'flag' => false,
            'generalInfo' => array(),
            'professors' => array(),
            'programs' => array(),
            'events' => array(),
            'campuses' => array()
        );

        while ($mainQuery->have_posts()) {
            $mainQuery->the_post();


            if (get_post_type() == 'post' OR get_post_type() == 'page') {
                array_push($results[generalInfo],array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'content' => get_the_content(),
                    'id' => get_the_id()
                ));
                $results[flag] = true;
            }

            if (get_post_type() == 'professor') {
                array_push($results[professors],array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'content' => get_the_content(),
                    'id' => get_the_id(),
                    'imageUrl' => get_the_post_thumbnail_url(0,'professorLandscape')
                ));
                $results[flag] = true;
            }

            if (get_post_type() == 'event') {
                $eventDate = new DateTime(get_field('event_date'));
                array_push($results[events],array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'content' => get_the_content(),
                    'id' => get_the_id(),
                    'timeM' => $eventDate->format('M'),
                    'timed' => $eventDate->format('d'),
                    'excerpt' => wp_trim_words(get_the_excerpt(),6)
                ));
                $results[flag] = true;
            }

            if (get_post_type() == 'campus') {
                array_push($results[campuses],array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'content' => get_the_content(),
                    'id' => get_the_id()
                ));
                $results[flag] = true;
            }

            if (get_post_type() == 'program') {
                array_push($results[programs],array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'content' => get_the_content(),
                    'id' => get_the_id()
                ));
                $results[flag] = true;
            }
        }

        if ($results['programs']) {
            $program_meta_query = array('relation' => 'OR');

            foreach ($results['programs'] as $item) {
                array_push($program_meta_query,array(
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"'.$item['id'].'"'
                ));
            }
    
            $relatedPrograms = new WP_Query(array(
                'post_type' => array('professor','event'),
                'meta_query' => $program_meta_query
            ));
    
            while ($relatedPrograms->have_posts()) {
                $relatedPrograms->the_post();
    
                if (get_post_type() == 'professor') {
                    array_push($results[professors],array(
                        'title' => get_the_title(),
                        'permalink' => get_the_permalink(),
                        'content' => get_the_content(),
                        'id' => get_the_id(),
                        'imageUrl' => get_the_post_thumbnail_url(0,'professorLandscape')
                    ));
                    $results[flag] = true;
                }

                if (get_post_type() == 'event') {
                    $eventDate = new DateTime(get_field('event_date'));
                    array_push($results[events],array(
                        'title' => get_the_title(),
                        'permalink' => get_the_permalink(),
                        'content' => get_the_content(),
                        'id' => get_the_id(),
                        'timeM' => $eventDate->format('M'),
                        'timed' => $eventDate->format('d'),
                        'excerpt' => wp_trim_words(get_the_excerpt(),6)
                    ));
                    $results[flag] = true;
                }
            }
    
            $results['professors'] = array_values(array_unique($results['professors'],SORT_REGULAR));
            $results['events'] = array_values(array_unique($results['events'],SORT_REGULAR));
        }

        return $results;
    }

?>