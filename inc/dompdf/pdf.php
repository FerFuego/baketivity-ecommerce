<?php
require get_theme_file_path().'/inc/dompdf/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFGenerator{
    private $settings= array(
        'name' => null,
        'date' => null,
        'time' => null,
        'location' => null,
        'action' => null,
        'template_id' => null,
    );

    private $template_landscape = array(
        1,2,
    );

    function __construct( $settings){
        $this->settings = $settings;
    }

    public function generate_pdf(){

        ///I am ashamed to write this, but there is very little time. Please correct the classes in the template
        /// To do: correct
        switch( $this->settings['template_id']){
            case 1:
                $this->settings['action'] = $this->settings['host'].' invites you to a baking party and day of charity on';
                $this->settings['template_id'] = 5;
                break;
            case 2:
                $this->settings['action'] = 'Sugar, flour, me, and YOU!<br/>Let’s have some fun,and <br/>bake the world better too!';
                $this->settings['template_id'] = 4;
                break;
            case 3:
                $this->settings['action'] = 'Sugar, flour, me, and YOU!<br/>Let’s have some fun,and bake<br/>the world better too!';
                break;
            case 4:
                $this->settings['action'] = 'Sugar, flour, me, and YOU!<br/>Let’s have some fun,<br/>and bake the world better too!';
                $this->settings['template_id'] = 1;
                break;
            case 5:
                $this->settings['action'] = $this->settings['host'].' invites you to a baking party and day of charity on ';
                $this->settings['template_id'] = 2;
                break;
        }

        $html = $this->generate_template();

//        echo '<pre>';
//        var_dump($this->settings);
//        var_dump($html);
//        echo '</pre>';
//        die;

        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsRemoteEnabled(true);

        $dompdf = new Dompdf($options);

        $dompdf->setBasePath(substr(get_home_path(),0,-1));
        $dompdf->loadHtml($html);

        if(in_array($this->settings['template_id'], $this->template_landscape)){
            $dompdf->setPaper('A4', 'landscape');
        } else {
            $dompdf->setPaper('A4', 'portrait');
        }

        $dompdf->render();

        $output = $dompdf->output();
        $filename = uniqid().'-'.time() . ".pdf";
        file_put_contents(get_theme_file_path().'/pdf/'.$filename, $output);
        return $filename;
    }


    protected function  generate_template(){
        $args = $this->settings;
        $args['time'] = str_replace('am','<span>am</span>', $args['time']);
        $args['time'] = str_replace('pm','<span>pm</span>', $args['time']);
        $date_time = strtotime($args['date']);

        switch ($args['template_id']){
            case 1:
            case 3:
            case 4:
                $args['date'] = date('l, F j', $date_time);
                break;
            case 2:
            case 5:
                $args['date'] = date('F j', $date_time);
                break;
        }

        $args['date'] .= '<span>'.date('S', $date_time).'</span>';

        $template_id = $args['template_id'];

        ob_start();
        include("templates_for_pdf/1-5templates.php");
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}
