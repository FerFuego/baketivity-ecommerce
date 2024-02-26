<?php
define('LOG_EVENTS_PATH', get_stylesheet_directory() . '/inc/errors/logs/');
define('LOG_EVENTS_ERROR_FILE', get_stylesheet_directory() . '/inc/errors/logs/log_error_' . date("n.j.Y", current_time('timestamp', 0)) . '.log');
define('CSV_EVENTS_ERROR_FILE', get_stylesheet_directory() . '/inc/errors/logs/log_error_' . date("n.j.Y", current_time('timestamp', 0)) . '.csv');

class Log_Events
{

    var $log_error = array();
    var $csv_header = array('date', 'user', 'user_id', 'email', 'error_1', 'error_2', 'error_3', 'error_4', 'error_5');

    /*--------------------------------*/
    /* Constructor
    /*--------------------------------*/
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'load_custom_wp_admin_style'));
        add_action('admin_menu', array($this, 'log_events_admin_menu'));
        add_action('init', array($this, 'user_login_check'));
    }

    /*--------------------------------*/
    /* Settings Item - Admin Menu
    /*--------------------------------*/
    public function log_events_admin_menu()
    {
        add_options_page('Log Events Checkout', 'Log Events Checkout', 'manage_options', 'log_events', array($this, 'options_page'));
        add_settings_section('wcro_first_section', null, null, 'log_events');
        add_settings_field('wcro_log', 'Select the record you want to view:', array($this, 'selectLog'), 'log_events', 'wcro_first_section');
        register_setting('wcro_plugin', 'wcro_log', array('sanitize_callback' => 'sanitize_text_field', 'default' => ''));
    }

    /*--------------------------------*/
    /* Check if user is login
    /*--------------------------------*/
    public function user_login_check()
    {
        if (is_user_logged_in()) {
            $this->log_error['user_name'] = wp_get_current_user()->user_login;
            $this->log_error['user_id'] = wp_get_current_user()->ID;
            $this->log_error['user_email'] = wp_get_current_user()->user_email;
        } else {
            $this->log_error['user_name'] = 'Guest';
        }
    }

    /*--------------------------------*/
    /* Write Log Errors
    /*--------------------------------*/
    public function log_errors()
    {
        // LOG
        $log = date("F j, Y, g:i a", current_time('timestamp', 0)) . PHP_EOL;
        foreach ($this->log_error as $key => $value) {
            $log .= $key . ": " . $value . PHP_EOL;
        }
        $log .= "---------------------------------------------" . PHP_EOL;
        file_put_contents(LOG_EVENTS_ERROR_FILE, $log, FILE_APPEND);

        // CSV
        $csv_time = date("F j, Y, g:i a", current_time('timestamp', 0));

        $read = fopen(CSV_EVENTS_ERROR_FILE, 'r');

        if (!$read) {
            $csv = fopen(CSV_EVENTS_ERROR_FILE, 'a');
            fputcsv($csv, $this->csv_header, ",", '"', "\\");
        } else {
            $csv = fopen(CSV_EVENTS_ERROR_FILE, 'a');
        }

        array_unshift($this->log_error, $csv_time);

        if (count($this->log_error) < 4) {
            if (is_user_logged_in()) {
                $user = wp_get_current_user();
                $this->log_error = array_merge(array_slice($this->log_error, 0, 1), array($user->user_login), array_slice($this->log_error, 1));
                $this->log_error = array_merge(array_slice($this->log_error, 0, 2), array($user->ID), array_slice($this->log_error, 2));
                $this->log_error = array_merge(array_slice($this->log_error, 0, 3), array($user->user_email), array_slice($this->log_error, 3));
            } else {
                $this->log_error = array_merge(array_slice($this->log_error, 0, 1), array('guest'), array_slice($this->log_error, 1));
                $this->log_error = array_merge(array_slice($this->log_error, 0, 2), array(''), array_slice($this->log_error, 2));
                $this->log_error = array_merge(array_slice($this->log_error, 0, 3), array(''), array_slice($this->log_error, 3));
            }
        }

        if ($csv) {
            fputcsv($csv, $this->log_error, ",", '"', "\\");
            fclose($csv);
        }
    }

    /*--------------------------------*/
    /* Read Log File
    /*--------------------------------*/
    public function read_log_file()
    {
        $myfile = fopen(LOG_EVENTS_ERROR_FILE, 'rt');
        flock($myfile, LOCK_SH);
        $read = file_get_contents(LOG_EVENTS_ERROR_FILE);
        fclose($myfile);

        return $read;
    }

    /*--------------------------------*/
    /* Get Log File
    /*--------------------------------*/
    public function get_log_file($file)
    {
        $myfile = fopen($file, 'rt');
        flock($myfile, LOCK_SH);
        $read = file_get_contents($file);
        fclose($myfile);

        return $read;
    }

    /*--------------------------------*/
    /* Get CSV File
    /*--------------------------------*/
    public function get_csv_file($file)
    {
        $filename = str_replace('.log', '.csv', $file);
        return $filename;
    }

    /*--------------------------------*/
    /* Ajax events log
    /*--------------------------------*/
    public function log_event_apply_coupon()
    {
        $message = $_POST['message'];
        if (is_array($message)) {
            foreach ($message as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $k => $v) {
                        $this->log_error[$key][$k] = trim(strip_tags($v));
                    }
                } else {
                    $this->log_error[$key] = trim(strip_tags($value));
                }
            }
        } else {
            $this->log_error[] = trim(strip_tags($message));
        }
        $this->log_errors();
        wp_send_json_success();
    }

    /*--------------------------------*/
    /* Load Custom Styles for Admin */
    /*--------------------------------*/
    public function load_custom_wp_admin_style()
    {
?><style type="text/css">
            #form-log-errors {
                display: inline-flex;
                align-items: center;
                justify-content: space-between;
                margin-top: 0;
            }

            #form-log-errors table {
                margin-top: 0;
            }

            #form-log-errors th {
                vertical-align: top;
                padding: 0;
                line-height: 2;
                width: 100%;
            }

            #form-log-errors td {
                margin-bottom: 0;
                padding: 0 10px;
                line-height: 1;
            }

            #form-log-errors p.submit {
                margin: 0 10px 0 0;
                padding: 0;
            }
        </style><?php
            }

            /*--------------------------------*/
            /* Add Fields to Admin Menu Tab
    /*--------------------------------*/
            public function selectLog()
            { ?>
        <select name="selectLog">
            <?php foreach (glob(LOG_EVENTS_PATH . '*.log') as $file) { ?>
                <option value="<?php echo end(explode('/', $file)); ?>"><?php echo end(explode('/', $file)); ?></option>
            <?php } ?>
        </select>
    <?php }

            /*--------------------------------*/
            /* Page HTML
    /*--------------------------------*/
            public function options_page()
            {

                if ($_POST['selectLog']) {
                    $LogName    = $_POST['selectLog'];
                    $log        = new Log_Events();
                    $logFile    = $log->get_log_file(LOG_EVENTS_PATH . $LogName);
                    $csvFile    = $log->get_csv_file($LogName);
                }
    ?>
        <div class="wrap">
            <div class="container">
                <div class="postbox-container">
                    <h1>Log Events Checkout</h1>
                    <br>
                    <form id="form-log-errors" class="wcro-wrap__form" method="POST">
                        <?php
                        settings_errors();
                        settings_fields('wcro_plugin');
                        do_settings_sections('log_events');
                        submit_button($text = 'View', $type = 'primary', $name = 'submit', $wrap = true, $other_attributes = null);
                        ?>
                        <?php if ($LogName) : ?>
                            <a href="<?php echo '/wp-content/themes/baketivity/inc/errors/logs/' . $LogName; ?>" class="button" style="margin-right: 10px;" download>Download Log File</a>
                            <a href="<?php echo '/wp-content/themes/baketivity/inc/errors/logs/' . $csvFile; ?>" class="button" download>Download CSV File</a>
                        <?php endif; ?>
                    </form>
                    <br><br>
                    <b>Resumen</b>
                    <textarea class="form-control" rows="5" id="error_log_viewer" name="log" style="width:100%; height:800px; background-color:#fff;" readonly><?php echo $logFile ?? $this->read_log_file(); ?></textarea>
                </div>
            </div>
        </div>
<?php
            }
        }

        $log_event = new Log_Events();

        /*--------------------------------*/
        /* Actions Ajax
/*--------------------------------*/
        add_action('wp_ajax_log_event_apply_coupon', array($log_event, 'log_event_apply_coupon'));
        add_action('wp_ajax_nopriv_log_event_apply_coupon', array($log_event, 'log_event_apply_coupon'));
