<?php
add_action( 'admin_menu', 'add_settings_hidden_content' );
function add_settings_hidden_content() {
    add_menu_page(
        'Work Flow Settings',
        'Work Flow Settings',
        'manage_options',
        'work_flow_settings',
        'function_work_flow_settings',
        false,
        6
    );
}


function function_work_flow_settings(){
    $message = '';
    if(isset($_POST['subscriber_id'])){
        $subscriber_id = intval($_POST['subscriber_id']);
        $post = get_post($subscriber_id);
        if($post->post_type == 'shop_subscription'){
            $user_id = get_post_meta($subscriber_id, '_customer_user', true);
            $message = add_manual_workflow(
                $subscriber_id, $user_id
            ) ? 'Workflow added successfully' : 'Try later' ;
        }
        unset($_POST['subscriber_id']);
    }
    get_template_part( 'inc/template/restart_workflow_template', null, array(
        'message' => $message
    ) );
}

function add_manual_workflow($subscription_id, $user_id){
    global $wpdb;
    //3m - 1922
    //6m - 1904
    //1y - 1901
    $subscription = $wpdb->get_var("SELECT order_item_name FROM {$wpdb->prefix}woocommerce_order_items WHERE order_item_type = 'line_item' 
      AND order_id = $subscription_id");
    switch (strtoupper($subscription)){
        case '3 MONTHS':
            $workflow_id = 1922;
            break;
        case '6 MONTHS':
            $workflow_id = 1904;
            break;
        case 'YEARLY':
            $workflow_id = 1901;
            break;
        case 'HOME COOKING 3 MONTHS SUBSCRIPTION':
            $workflow_id = 329898;
            break;
        case 'HOME COOKING 6 MONTHS SUBSCRIPTION':
            $workflow_id = 330064;
            break;
        case 'HOME COOKING YEARLY SUBSCRIPTION':
            $workflow_id = 330074;
            break;
        default:
            $workflow_id = false;
    }

    if( !$workflow_id ) return false;

    $wpdb->insert( $wpdb->prefix . 'automatewoo_queue', array(
        'workflow_id' => $workflow_id,
        'created' => date('Y-m-d H:i:s'),
        'date' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
        'failed' => 0,
        'failure_code' => 0,
    ) );
    $queue_id = $wpdb->insert_id;

    $wpdb->insert( $wpdb->prefix . 'automatewoo_queue_meta', array(
        'event_id' => $queue_id,
        'meta_key' => 'data_item_subscription',
        'meta_value' => $subscription_id,
    ) );

    $customer_id = $wpdb->get_var("SELECT post_id FROM {$wpdb->prefix}automatewoo_customers WHERE user_id = $user_id 
        ORDER BY id DESC LIMIT 1");

    if($customer_id){
        $wpdb->insert( $wpdb->prefix . 'automatewoo_queue_meta', array(
            'event_id' => $queue_id,
            'meta_key' => 'data_item_customer',
            'meta_value' => $customer_id,
        ) );
    }

    $order_id = $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_key LIKE '_subscription_renewal' 
          AND meta_value=$subscription_id ORDER BY meta_id DESC LIMIT 1");

    if($order_id){
        $wpdb->insert( $wpdb->prefix . 'automatewoo_queue_meta', array(
            'event_id' => $queue_id,
            'meta_key' => 'data_item_order',
            'meta_value' => $order_id,
        ) );
    }

    $wpdb->insert( $wpdb->prefix . 'automatewoo_queue_meta', array(
        'event_id' => $queue_id,
        'meta_key' => 'data_item_user',
        'meta_value' => $user_id,
    ) );

    return true;
}

