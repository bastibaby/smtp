<?php

function custom_save_post($post_ID, $post, $update)
{
    $post_type = get_post_type($post_ID);
    
    if ($post_type == 'acf-field-group' || $post_type == 'acf-field') {
        return;
    } else {
        global $wpdb;
        
        $query = $wpdb->get_col("SELECT meta_value FROM $wpdb->postmeta WHERE (meta_key LIKE '%text%' OR meta_key LIKE '%title%' OR meta_key LIKE '%description%' OR meta_key LIKE '%descript%') AND meta_value NOT LIKE '%field_%' AND post_id = $post_ID");
        
        $vars = implode('.', $query);
        
        $wpdb->query($wpdb->prepare("UPDATE $wpdb->posts SET post_content = %s WHERE ID = %d", $vars, $post_ID));
    }
}

add_action('save_post', 'custom_save_post', 10, 3);