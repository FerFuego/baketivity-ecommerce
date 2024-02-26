<style>
    @font-face {
        font-family: FilsonProBlack;
        font-display: swap;
        src: url("<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/fonts/FilsonProBlack.otf") format("opentype"),
        url('<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/fonts/FilsonProBlack.ttf')  format('truetype');
    }
    @font-face {
        font-family: FilsonProRegular;
        font-display: swap;
        src: url("<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/fonts/FilsonProRegular.otf") format("opentype"),
        url('<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/fonts/FilsonProRegular.ttf')  format('truetype');
    }
    @font-face {
        font-family: MinionPro-Regular;
        font-display: swap;
        src: url("<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/fonts/MinionPro-Regular.otf") format("opentype"),
        url('<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/fonts/MinionPro-Regular.ttf')  format('truetype');
    }
    @font-face {
        font-family: PlaylistScript;
        font-display: swap;
        src: url("<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/fonts/Playlist-Script.otf") format("opentype"),
        url('<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/fonts/Playlist-Script.ttf')  format('truetype');
    }

    .template{
        margin: 10px auto;
        border: none;
        background-size: 100% 100%;
        position: relative;
    }
    .template > div{
        position: absolute;
    }

    .template span {
        top: -8px;
        position: relative;
        text-transform: uppercase;
        font-size: 70%;
    }

    .template .action:first-letter {
        text-transform: uppercase;
    }

    .template .date div,
    .template .time div,
    .template .location div,
    .template .email div {
        display: inline;
        font-family: FilsonProRegular;
    }

    .template .date,
    .template .time,
    .template .email{
        font-family: FilsonProBlack;
        text-transform: capitalize;
        white-space: nowrap;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow-wrap: break-word;
    }

    .template .email{
        text-transform: unset;
        font-family: FilsonProBlack;
        white-space: nowrap;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow-wrap: break-word;
    }

    .template .location{
        font-family: FilsonProBlack;
        text-transform: capitalize;
    }

    .template .action{
        font-family: FilsonProBlack;
        text-transform: unset;
    }

    .template .name{
        font-family: PlaylistScript;
        text-transform: capitalize;
        white-space: nowrap;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow-wrap: break-word;
    }


    .template1 .date,
    .template1 .time,
    .template1 .location,
    .template1 .email,
    .template4 .date,
    .template4 .action,
    .template4 .time,
    .template4 .location{
        font-size: 12pt;
    }

    .template2 .date,
    .template2 .time,
    .template2 .location,
    .template2 .email,
    .template3 .date,
    .template3 .action,
    .template3 .time,
    .template3 .location,
    .template3 .email,
    .template5 .date,
    .template5 .action,
    .template5 .time,
    .template5 .location{
        font-size: 13pt;
    }

    .template1 .name{
        font-size: 24pt;
    }

    .template2 .name,
    .template3 .name,
    .template4 .name,
    .template5 .name {
        font-size: 22pt;
        letter-spacing: 1.2;
    }

    .template1, .template2{
        width: 792px;
        height: 612px;
        transform: scale(1.2);
        margin-top: 45px;
    }
    .template3, .template4, .template5{
        width: 612px;
        height: 792px;
        transform: scale(1.25);
        margin-top: 120px;
    }

    .template1 .date,
    .template1 .time,
    .template1 .location,
    .template2 .date,
    .template2 .time,
    .template2 .location,
    .template3 .date,
    .template3 .time,
    .template3 .location,
    .template5 .date,
    .template5 .time,
    .template5 .location{
        color: #e02346;
    }

    .template1 .email,
    .template1 .name,
    .template2 .email,
    .template2 .name,
    .template3 .email,
    .template3 .name{
        color: #3999a0;
    }

    .template4 .date,
    .template4 .action,
    .template4 .time,
    .template4 .location,
    .template4 .email,
    .template4 .name{
        color: #05a6b2;
    }

    .template5 .email,
    .template5 .name{
        color: #3999a0;
    }

    .template1{
        background: url(<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/images/background1.jpg);
    }
    .template1{
        background: url(<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/images/background1.jpg);
    }

    .template2{
        background: url(<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/images/background2.jpg);
    }

    .template3{
        background: url(<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/images/background3.jpg);
    }

    .template4{
        background: url(<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/images/background4.jpg);
    }

    .template5{
        background: url(<?php echo get_stylesheet_directory_uri();?>/inc/dompdf/assets/images/background5.jpg);
    }
    /*============template1============*/

    .template1 .date div,
    .template1 .time div,
    .template1 .location div,
    .template1 .email div{
        color: black;
    }


    .template1 .action{
        top: 205px;
        left: 442px;
        width: 300px;
        line-height: 1;
    }

    .template1 .date{
        top: 340px;
        left: 442px;
        width: 300px;
    }

    .template1 .time{
        top: 360px;
        left: 442px;
        width: 300px;
    }

    .template1 .location{
        top: 385px;
        left: 442px;
        width: 330px;
        line-height: 0.75;
        white-space: break-spaces;
    }

    .template1 .email{
        top: 473px;
        left: 442px;
        width: 300px;
    }
    .template1 .name{
        top: 480px;
        left: 442px;
        padding-right: 10px;
    }

    /*============template2============*/

    .template2 .action {
        left: 122px;
        width: 330px;
        top: 240px;
        line-height: 1;
    }

    .template2 .date div,
    .template2 .location div,
    .template2 .email div{
        color: black;
    }

    .template2 .date {
        top: 295px;
        left: 122px;
        width: 330px;
    }

    .template2 .time{
        top: 307px;
        left: 122px;
        width: 200px;
    }

    .template2 .location{
        top: 325px;
        left: 122px;
        width: 340px;
        line-height: 0.75;
        white-space: break-spaces;
    }

    .template2 .email{
        top: 470px;
        left: 122px;
        line-height: 1.2;
    }

    .template2 .name{
        top: 515px;
        left: 122px;
        padding-right: 10px;
    }

    /*============template3============*/

    .template3 .action{
        width: 300px;
        left: 156px;
        top: 230px;
        text-align: center;
        line-height: 0.9;
    }

    .template3 .date {
        top: 365px;
        width: 300px;
        left: 156px;
        text-align: center;
    }

    .template3 .time {
        top: 385px;
        width: 260px;
        left: 176px;
        text-align: center;
    }

    .template3 .location {
        top: 415px;
        width: 300px;
        left: 156px;
        text-align: center;
        line-height: 0.75;
        white-space: break-spaces;
    }

    .template3 .email div,
    .template3 .date div,
    .template3 .time div,
    .template3 .location div{
        color: black;
    }

    .template3 .email {
        top: 504px;
        left: 181px;
        width: 250px;
        text-align: center;
    }

    .template3 .name {
        top: 525px;
        left: 181px;
        width: 250px;
        text-align: center;
    }

    /*============template4============*/

    .template4 .action{
        left: 181px;
        width: 250px;
        text-align: center;
        top: 190px;
        line-height: 1.15;
    }

    .template4 .date {
        top: 360px;
        left: 181px;
        width: 250px;
        text-align: center;
    }

    .template4 .time {
        top: 425px;
        left: 181px;
        width: 250px;
        text-align: center;
    }

    .template4 .location {
        top: 490px;
        left: 181px;
        width: 250px;
        text-align: center;
        white-space: break-spaces;
    }

    .template4 .email {
        top: 655px;
        left: 235px;
        letter-spacing: 0.5px;
    }

    .template4 .name {
        top: 660px;
        left: 236px;
        letter-spacing: 1.2px;
        width: 300px;
    }
    /*============template5============*/

    .template5 .email div,
    .template5 .date div,
    .template5 .time div,
    .template5 .location div{
        color: black;
    }

    .template5 .action{
        left: 182px;
        width: 340px;
        top: 355px;
        line-height: 1;
    }

    .template5 .date{
        top: 415px;
        left: 185px;
        width: 330px;
        white-space: nowrap;
    }

    .template5 .time{
        top: 410px;
        left: 185px;
        width: 242px;
    }

    .template5 .location{
        top: 445px;
        left: 185px;
        width: 340px;
        line-height: 0.9;
        white-space: break-spaces;
    }

    .template5 .email{
        top: 570px;
        left: 185px;
        line-height: 1;
    }

    .template5 .name{
        left: 180px;
        top: 610px;
        line-height: 1;
    }
    /*============template5============*/

    sup {
        text-transform: uppercase;
    }

</style>


<div class="template template<?php echo $template_id; ?>">
    <div class="action"><?php echo $args['action'];?></div>
    <?php if(in_array($args['template_id'], array(2, 5))):?>
        <div class="date"><div>Date:</div> <?php echo $args['date'];?> <div>Time:</div> <?php echo $args['time'];?></div>
    <?php else:?>
        <div class="date"><div>Date:</div> <?php if(in_array($args['template_id'], array(4))) echo '<br/>';?><?php echo $args['date'];?></div>
        <div class="time"><div>Time:</div> <?php if(in_array($args['template_id'], array(4))) echo '<br/>';?><?php echo $args['time'];?></div>
    <?php endif;?>
    <div class="location"><div>Location:</div> <?php if(in_array($args['template_id'], array(4))) echo '<br/>';?><?php echo $args['location'];?></div>
    <div class="email"><div>RSVP to:</div> <?php if(in_array($args['template_id'], array(2,5))) echo '<br/>';?><?php echo $args['contact'];?></div>
    <div class="name"><?php echo $args['name'];?></div>
</div>