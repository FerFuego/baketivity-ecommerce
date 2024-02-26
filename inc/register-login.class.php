<?php
class Register_Login
{

    public function __construct()
    {
        add_action('wp_ajax_send_sign_up', [$this, 'send_sign_up_callback']);
        add_action('wp_ajax_nopriv_send_sign_up', [$this, 'send_sign_up_callback']);
        add_action('wp_ajax_nopriv_baketivity_login', [$this, 'baketivity_login']);
        add_action('wp_ajax_baketivity_login', [$this, 'baketivity_login']);
        add_action('wp_ajax_nopriv_baketivity_register', [$this, 'baketivity_register']);
        add_action('wp_ajax_baketivity_register', [$this, 'baketivity_register']);
        add_action('user_register', [$this, 'baketivity_on_register_update_data'], 10, 1);
    }

    public function send_sign_up_callback()
    {
        $send = true;

        if ($send) {
            wp_send_json(['status' => 'success']);
        } else {
            wp_send_json(['status' => 'error']);
        }
    }

    public function baketivity_login()
    {
        // Custom LOG ERROR_REPORTING
        $log_event = new Log_Events();

        if ($_SERVER["REQUEST_METHOD"] == "POST") :

            $creds['user_login']      = sanitize_text_field($_POST['username']);
            $creds['user_password']   = sanitize_text_field($_POST['password']);
            $creds['remember']    = sanitize_text_field($_POST['rememberme']);

            $user = wp_signon($creds, true);

            if (is_wp_error($user)) {

                $log_event->log_error[] = 'Error login: ' . $user->get_error_message();
                $log_event->log_errors();

                wp_send_json_error([
                    'success'   => false,
                    'error'     => $user->get_error_message(),
                    'message'   => __('Wrong email or password.')
                ]);
            } else {
                wp_send_json_success([
                    'success'   => true,
                    'user'      => $user,
                    'message'   => __('Login successful, redirecting...')
                ]);
            }

        else :
            $log_event->log_error[] = 'Error login: error request method';
            $log_event->log_errors();

            wp_send_json_error('Ups! something went wrong');
        endif;
    }

    public function baketivity_register()
    {
        $login      = sanitize_text_field($_POST['login']);
        $user_email = sanitize_text_field($_POST['email']);
        $user_first = sanitize_text_field($_POST['firstname']);
        $user_last  = sanitize_text_field($_POST['lastname']);
        $user_pass  = sanitize_text_field($_POST['password']);
        $user_pass  = wp_hash_password($user_pass); // Hash password

        if (!email_exists($user_email)) {

            $i = 1;
            $user_new = $user_first;

            while (username_exists($user_new)) {
                $user_new = $user_first . $i++;
            }

            $userdata = array(
                'user_login'    => $user_new,
                'user_email'    => $user_email,
                'nickname'      => $user_new,
                'display_name'  => $user_first . ' ' . $user_last,
                'first_name'    => $user_first,
                'last_name'     => $user_last,
                'role'          => 'customer',
                'user_order'    => 0
            );

            if ($user_pass) {
                $userdata['user_pass'] = $user_pass;
            }

            // Create user
            $user_id = wp_insert_user($userdata);

            // verify errors
            if (is_wp_error($user_id)) {
                wp_send_json_error($user_id->get_error_message());
            }

            // Sign in
            if ($login) {
                $creds = array(
                    'user_login'    => $user_new,
                    'user_password' => $user_pass,
                    'remember'      => true
                );
                wp_signon($creds, false); // Sign in
            }

            wp_send_json_success("Your registration has been successful!</p>");
        } else {
            wp_send_json_error('Email already exists, please enter a new one.');
        }
    }

    public function baketivity_on_register_update_data($user_id)
    {

        $email      = sanitize_text_field($_POST['email']);
        $firstname  = sanitize_text_field($_POST['firstname']);
        $lastname   = sanitize_text_field($_POST['lastname']);
        $newsletter = sanitize_text_field($_POST['newsletter']);

        if ($firstname)
            update_user_meta($user_id, 'first_name', $_POST['firstname']);

        if ($lastname)
            update_user_meta($user_id, 'last_name', $_POST['lastname']);

        if ($newsletter) {
            if (!empty($email)) {
                $KLAVIYO_URL = 'https://a.klaviyo.com/api/v2';
                $KLAVIYO_LIST = 'JQEMdk'; // Customer List
                $KLAVIYO_API_KEY = 'pk_da64aa2b367f684a1baae8f4613f69af75';
                // url
                $url = $KLAVIYO_URL . '/list/' . $KLAVIYO_LIST . '/subscribe?api_key=' . $KLAVIYO_API_KEY;
                // data
                $data = array(
                    'profiles' => array(
                        array('email' => $email)
                    )
                );
                // curl send
                if (class_exists('cURL')) {
                    $curl = new cURL();
                    $response = $curl->callcURL('POST', $url, $data);
                }
            }
        }
    }
}
