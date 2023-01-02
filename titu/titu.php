<?php
/**
* Plugin Name: Related Posts
*/







function relatedpostoutput($default){

    if(is_single()):

        $terms = get_the_terms(get_the_ID(),'category');


        $cate = array();

        foreach ($terms as $term) {
            $cate[] = $term->term_id;
        }
        $related_post = new WP_Query(array(
            'post_type' => 'post',
            'category__in' => $cate,
            'post__not_in' => array(get_the_ID())

        ));
        while ($related_post->have_posts()) : $related_post->the_post();
        $default .= "<ul>";
        $default .= "<li>".get_the_title()."</li>";
        $default .= "</ul>";
        endwhile;
       
       
    $default .= "<hr><h5>Related Posts</h5>";
    $default .= "<ul>";
    $default .= "<li>Post Title</li>";
    $default .= "</ul>";
       

    return $default;
    endif;


}

add_filter('the_content', 'relatedpostoutput')

?>