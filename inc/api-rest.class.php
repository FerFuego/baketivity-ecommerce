<?php

/**
 * Class Api Rest
 * @date 2023-10-03
 * @author Fer Catalano
 */

class Api_Rest
{
    public function __construct()
    {
        add_action('rest_api_init', [$this, 'create_recipe_api']);
    }

    public function create_recipe_api()
    {
        register_rest_route('baketivity/v2/', 'create_recipe', [
            'methods' => 'POST',
            'callback' => [$this, 'create_recipe']
        ]);
    }

    public function create_recipe($request)
    {
        $recipe = $request->get_params();

        try {
            # create post
            $post = [
                'post_title'    => sanitize_text_field($recipe['post_title']),
                'post_author'   => sanitize_text_field($recipe['post_author']),
                'post_content'  => 'New recipe',
                'post_status'   => 'draft',
                'post_type'     => 'recipe',
                'meta_input'    => [
                    'child_first_name'   => sanitize_text_field($recipe['child_name']),
                    'child_birthday'     => date('d-m-Y H:i:s', strtotime(sanitize_text_field($recipe['child_birthday']))),
                    'email'              => sanitize_text_field($recipe['parent_email']),
                    'phone'              => sanitize_text_field($recipe['phone']),
                    'state'              => sanitize_text_field($recipe['state']),
                    'thumb_url'          => sanitize_text_field($recipe['thumb_url']),
                    'video_'             => sanitize_text_field($recipe['video_url']),
                ],
            ];

            $post_id = wp_insert_post($post, true);

            // Check if there was an error during post insertion
            if (is_wp_error($post_id)) {
                return [
                    'status' => 'error',
                    'message' => $post_id->get_error_message()
                ];
            } else {
                return [
                    'status' => 'success',
                    'message' => 'Recipe created',
                    'post_id' => $post_id
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
