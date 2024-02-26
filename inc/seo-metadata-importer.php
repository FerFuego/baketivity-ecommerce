<?php

/**
 * 
 * Import Meta Data SEO to Post
 * 
 * @package BAKETIVITY
 * @author Fer Catalano
 * 
 **/

class Meta_Data_SEO_Importer {

    private $data = [];
    public $log = [];

    public function __construct() {
        // define csv path
        define('CSV_PATH', get_stylesheet_directory() .'/inc/csv/csv_importer_prod.csv');
        // init process
        $this->init_process();
    }

    public function init_process() {
        // get csv
        $this->data = $this->get_csv_file();

        $this->log = [
            'posts' => [],
            'total_insert' => 0,
            'total_update' => 0,
            'time' => 0
        ];

        // init query
        if (!empty($this->data)) {

            // start time
            $start = microtime(true);

            // process
            foreach ($this->data as $data) :
                $this->prepare_query($data);
            endforeach;

            // end time
            $end = microtime(true);
            $this->log['time'] = $end - $start;

            // write log
            if (function_exists('write_log')) {
                write_log('==================================');
                write_log($this->log);
                write_log('==================================');
            }
        }

        return $this->log;
    }

    public function get_csv_file() {

        $array = array();
 
        if (($open = fopen(CSV_PATH, "r")) !== false) {

            while (($data = fgetcsv($open, 1000, ",")) !== false) {
                
                $post_id = url_to_postid($data[0]);

                if (!empty($post_id) && $post_id > 0) {
                    array_push($array, [
                        'post_id' => $post_id,
                        'url' => $data[0],
                        'meta_title' => $data[1],
                        'meta_description' => $data[2]
                    ]);
                }

            }

            fclose($open);
        }

        return $array;
    }

    private function prepare_query ($data) {

        global $wpdb;

        $table_seo        = $wpdb->prefix.'aioseo_posts';
        $post_id          = $data['post_id'];
        $meta_title       = str_replace("'", "", $data['meta_title']);
        $meta_description = str_replace("'", "",$data['meta_description']);

        /* ======================================= */

        // Meta Title
        $rows_title = $wpdb->get_results( 
            "SELECT meta_id FROM $wpdb->postmeta 
            WHERE meta_key = '_aioseo_title' AND post_id = $post_id", ARRAY_A );
            
        if (!empty($rows_title)) {

            // update
            $wpdb->query( 
                $wpdb->prepare( 
                    "UPDATE `$wpdb->postmeta`
                    SET `meta_value` = '$meta_title'
                    WHERE `post_id` = '$post_id' AND `meta_key` = '_aioseo_title'",
                ) 
            );

            // update log
            $this->log['total_update']++;
            $this->log['posts'][] = $post_id . ' meta_title ' .$wpdb->postmeta. '  updated';
            
        } else {

            // insert
            $wpdb->query(
                $wpdb->prepare(
                   "INSERT INTO `$wpdb->postmeta`
                   ( post_id, meta_key, meta_value )
                   VALUES ( %d, %s, %s )",
                   $post_id,
                   '_aioseo_title',
                   $meta_title,
                )
            );

            // update log
            $this->log['total_insert']++;
            $this->log['posts'][] = $post_id . ' meta_title ' .$wpdb->postmeta. ' inserted';

        }

        /* ======================================= */

        // Meta Description
        $rows_desc = $wpdb->get_results( 
            "SELECT meta_id FROM $wpdb->postmeta 
            WHERE meta_key = '_aioseo_description' AND post_id = $post_id", ARRAY_A );
            
        if (!empty($rows_desc)) {

            // update
            $wpdb->query( 
                $wpdb->prepare( 
                    "UPDATE `$wpdb->postmeta`
                    SET `meta_value` = '$meta_title' 
                    WHERE `post_id` = '$post_id' AND `meta_key` = '_aioseo_description'",
                ) 
            );

            // update log
            $this->log['total_update']++;
            $this->log['posts'][] = $post_id . ' meta_description ' .$wpdb->postmeta. ' updated';

        } else {

            // insert
            $wpdb->query(
                $wpdb->prepare(
                   "INSERT INTO `$wpdb->postmeta`
                   ( post_id, meta_key, meta_value )
                   VALUES ( %d, %s, %s )",
                   $post_id,
                   '_aioseo_description',
                   $meta_description,
                )
            );

            // update log
            $this->log['total_insert']++;
            $this->log['posts'][] = $post_id . ' meta_description ' .$wpdb->postmeta. ' inserted';
        }

        /* ======================================= */

        // AIOSEO Data
        $rows_data = $wpdb->get_results( 
            "SELECT id, post_id, title, description FROM $table_seo
            WHERE  post_id = $post_id", ARRAY_A );

        if (!empty($rows_data)) {

            // update
            $wpdb->query( 
                $wpdb->prepare( 
                    "UPDATE `$table_seo`
                    SET `title` = '$meta_title', `description` = '$meta_description'
                    WHERE `post_id` = '$post_id'"
                ) 
            );
                
            // update log
            $this->log['total_update']++;
            $this->log['posts'][] = $post_id . ' title and description ' .$table_seo. ' updated';

        } else {
                
            // insert
            $wpdb->query(
                $wpdb->prepare(
                    "INSERT INTO `$table_seo`
                    ( post_id, title, description )
                    VALUES ( %d, %s, %s )",
                    $post_id,
                    $meta_title,
                    $meta_description,
                )
            );

            // update log
            $this->log['total_insert']++;
            $this->log['posts'][] = $post_id . ' title and description ' .$table_seo. ' inserted';

        }

        /* ======================================= */
    }

}

function shortcode_importer_bulk_data () {

    ob_start();
    
    $result = new Meta_Data_SEO_Importer();

    echo '<pre>';
    print_r($result);
    echo '</pre>';
}

add_shortcode('Meta_Data_SEO_Importer','shortcode_importer_bulk_data');

