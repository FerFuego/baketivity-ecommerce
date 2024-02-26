<?php


add_filter( 'gform_confirmation_15', 'invitation_opend_pdf_file', 10, 4 );
function invitation_opend_pdf_file( $confirmation, $form, $entry, $ajax ) {
    $template_id = null;
    $pdf = null;
    $args = array(
        'host' => null,
        'name' => null,
        'date' => null,
        'time' => null,
        'contact' => null,
        'apt' => null,
        'location' => null,
        'city' => null,
        'zip' => null,
        'template_id' => null,
    );

    foreach ( $form['fields'] as $field ) {
        //dumper($field->id.' - '.rgar( $entry, (string) $field->id ));
        if($field->id == 1){
            $args['host'] = rgar( $entry, (string) $field->id );
        }
        if($field->id == 10){
            $args['name'] = rgar( $entry, (string) $field->id );
        }
        if($field->id == 9){
            $args['contact'] = rgar( $entry, (string) $field->id );
        }
        if($field->id == 2){
            $args['date'] = rgar( $entry, (string) $field->id );
        }
        if($field->id == 16){
            $args['time'] = rgar( $entry, (string) $field->id );
        }
        if($field->id == 4){
            $args['location'] = rgar( $entry, (string) $field->id );
        }
        if($field->id == 5){
            $args['apt'] = rgar( $entry, (string) $field->id );
        }
        if($field->id == 8){
            $args['zip'] = rgar( $entry, (string) $field->id );
        }
        if($field->id == 7){
            $args['city'] = rgar( $entry, (string) $field->id );
        }
        if($field->id == 13){
            $args['template_id'] = str_replace('inv-', '', rgar( $entry, (string) $field->id ));
        }
    }


    if(!empty($args['apt'])) $args['apt'] .= ',';

    $args['location'] = $args['city'] . ', ' . $args['location'] . ', ' . $args['apt'] . $args['zip'];

    if($args['template_id']){
        include_once get_theme_file_path().'/inc/dompdf/pdf.php';
        $PDFGenerator = new PDFGenerator( $args );
        $pdf = $PDFGenerator->generate_pdf();
        $entry[13] = $pdf;
        gform_update_meta( $entry['id'], 13, $pdf );
    }


    if(isset($entry[15]) && $entry[15] == 'is_email'){
        $url = get_site_url('','/email-information/').'?entry=' . $entry['id'];

        if(!$ajax) {
            return wp_redirect($url);
        }

        return array( 'redirect' => $url);
    }


    if($pdf){
        $pdf_url = get_site_url('','wp-content/themes/baketivity/pdf/'.$pdf);
        $confirmation .= "
        <script>
            if(document.querySelector('body').getAttribute('pdf_open') == undefined){
                document.querySelector('body').setAttribute('pdf_open', 'true')
                window.open('$pdf_url', '_blank');//.focus();
                setTimeout(function(){
                   location.href = './choose-your-template/'; 
                }, 2000) 
            }
        </script>";
    }
    return $confirmation;
}



add_action( 'gform_after_submission_16', 'invitation_mail_pdf_recipient', 10, 2 );
function invitation_mail_pdf_recipient( $entry, $form ) {
    if(isset($entry[27])){
        for($i=1; $i< 26; $i++){
            if(isset($entry[$i]) && !empty($entry[$i]) && filter_var($entry[$i], FILTER_VALIDATE_EMAIL) ){
                $headers = 'From: Info <info@>'.$_SERVER['SERVER_NAME'] . "\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type: text/html; charset=utf8 \n";
                $pdf_path = WP_CONTENT_DIR  . '/themes/baketivity/pdf/' . $entry[27];
                $message = '<p>Hello. Please find attached my personal invitation. Let’s give back together and have fun while we do it.</p><p>Hope to see you.</p>';

                if(is_file($pdf_path)){
                    wp_mail($entry[$i], 'Kids helping kids. You\'re invited!', $message, $headers, $pdf_path);
                }

            }
        }
    }
}


add_shortcode( 'invitation_email_js', 'invitation_callback_email_js');
function invitation_callback_email_js( $atts ){
    $response = '';
    if(isset($_GET['entry'])){
        $entry = GFAPI::get_entry($_GET['entry']);
        if(is_wp_error($entry)) return $response;
        if(isset($entry[12]) && isset($entry[13])){
            $response .= '<script>
                document.addEventListener(\'DOMContentLoaded\', function () {                
                    let template = "'.$entry[12].'", 
                        invitation_email_image = document.getElementById(template),
                        invitation_form_email_pdf = document.getElementById("field_16_27");
                        
                    console.log(template);
                    
                    if(invitation_email_image){ 
                        invitation_email_image.classList.remove(\'hidden\')
                    }
                    
                    if(invitation_form_email_pdf){
                        invitation_form_email_pdf.querySelector("input").value = "'.$entry[13].'";
                    }
                    
                    
                }, false);
            </script>';
        }
    }
    return $response;
};

add_action( 'gform_enqueue_scripts_15', 'invitation_add_scripts' );
function invitation_add_scripts($form) {
    echo '<script>
            document.addEventListener( "DOMContentLoaded", function( e ) {
                if ( typeof jQuery !== "undefined" ) {
                    jQuery(document).on( "submit", "#gform_15", function() {
                        jQuery(".gform_footer").hide();
                    });
                    jQuery("#input_15_1").attr("maxlength", "10");
                    jQuery("#input_15_4").attr("maxlength", "20");
                    jQuery("#input_15_5").attr("maxlength", "20");
                    jQuery("#input_15_7").attr("maxlength", "16");
                    jQuery("#input_15_8").attr("maxlength", "6");
                    jQuery("#input_15_9").attr("maxlength", "26");
                    jQuery("#input_15_10").attr("maxlength", "26");
                }
            });
        </script>';
}


add_filter( 'gform_confirmation_16', 'invitation_redirect_after_email', 10, 4 );
function invitation_redirect_after_email( $confirmation, $form, $entry, $ajax ) {
    $confirmation .= "
    
    <script>
        setTimeout(function(){
           location.href = './choose-your-template/'; 
        }, 2000)        
    </script>";
    return $confirmation;
}
