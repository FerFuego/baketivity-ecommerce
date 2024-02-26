<style>
    div#countdown {
        position: absolute;
    }
    .countdown_wrapper{
        background: #d890b9;
        position: relative;
        overflow: hidden;
    }

    .countdown_wrapper #countdown {
        display: flex;
        justify-content: space-evenly;
        align-content: center;
        flex-wrap: nowrap;
    }
    .countdown_wrapper #countdown .title{
        color: white;
        text-align: center;
        display: block;
        white-space: nowrap;
        font-family: congenial;
        font-weight: lighter;
        color: #4e3cc5;
    }
    .countdown_wrapper #countdown .num{
        color: #4e3cc5;
        text-align: center;
        display: block;
        vertical-align: middle;
        background-size: 100%;
        /*font-family: congenial-light;*/
        /*font-family: 'CitrusGothicSolidRegular';*/
        font-family: 'CitrusGothicSolidRegular';
        font-weight: bolder;
    }
    .countdown_wrapper-children{
        width: fit-content;
        margin: 0 auto;
        position: relative;
    }
    @media all and (min-width: 721px){
        img.mobile_720, img.mobile_375{
            display: none;
        }
        img.desktop{
            display: block;
        }
    }
    @media all and (max-width: 720px) and (min-width: 376px){
        img.desktop, img.mobile_375{
            display: none;
        }
        img.mobile_720{
            display: block;
        }
    }
    @media all and (max-width: 375px){
        img.mobile_720, img.desktop{
            display: none;
        }
        img.mobile_375{
            display: block;
        }
    }

    @media all and (min-width: 1700px){
        div#countdown {
            width: 25%;
            top: 40%;
            left: 4%;
        }
        .countdown_wrapper #countdown .title{
            line-height: 1.2;
            font-size: 1.5em;
        }
        .countdown_wrapper #countdown .num{
            font-size: 3.5em;
        }
    }

    @media all and (min-width: 1401px) and (max-width: 1699px){
        div#countdown {
            width: 25%;
            top: 40%;
            left: 4%;
        }
        .countdown_wrapper #countdown .title{
            line-height: 1.2;
            font-size: 1.5em;
        }
        .countdown_wrapper #countdown .num{
            font-size: 3em;
        }
    }

    @media all and (min-width: 1201px) and (max-width: 1400px){
        div#countdown {
            width: 25%;
            top: 40%;
            left: 4%;
        }
        .countdown_wrapper #countdown .title{
            line-height: 1;
            font-size: 1.25em;
            margin-top: -10px;
        }
        .countdown_wrapper #countdown .num{
            font-size: 3em;
        }
    }

    @media all and (min-width: 1001px) and (max-width: 1200px){
        div#countdown {
            width: 25%;
            top: 40%;
            left: 4%;
        }
        .countdown_wrapper #countdown .title{
            line-height: 1;
            font-size: 1em;
            margin-top: -10px;
        }
        .countdown_wrapper #countdown .num{
            font-size: 2.5em;
        }
    }

    @media all and (min-width: 721px) and (max-width: 1000px){
        div#countdown {
            width: 25%;
            top: 40%;
            left: 4%;
        }
        .countdown_wrapper #countdown .title{
            line-height: 1;
            font-size: 0.8em;
            margin-top: -10px;
        }
        .countdown_wrapper #countdown .num{
            font-size: 1.75em;
        }
    }

    @media all and (max-width: 720px) and (min-width: 601px){
        div#countdown {
            width: 40%;
            top: 65%;
            left: 40%;
        }
        .countdown_wrapper #countdown .title{
            line-height: 1;
            font-size: 1em;
        }
        .countdown_wrapper #countdown .num{
            font-size: 2em;
            margin-bottom: -10px;
        }
    }

    @media all and (max-width: 600px) and (min-width: 500px){
        div#countdown {
            width: 40%;
            top: 60%;
            left: 40%;
        }
        .countdown_wrapper #countdown .title{
            line-height: 0.5;
            font-size: 1em;
            padding: 0 5px;
        }
        .countdown_wrapper #countdown .num{
            font-size: 1.75em;
            margin-bottom: -5px;
        }
    }

    @media all and (max-width: 499px) and (min-width: 376px){
        div#countdown {
            width: 40%;
            top: 63%;
            left: 40%;
        }
        .countdown_wrapper #countdown .title{
            line-height: 0.5;
            font-size: 0.75em;
            padding: 0 5px;
        }
        .countdown_wrapper #countdown .num{
            font-size: 1.5em;
            margin-bottom: -5px;
        }
    }

    @media all and (max-width: 375px){
        div#countdown {
            width: 55%;
            top: 60%;
            left: 40%;
        }
        .countdown_wrapper #countdown .title{
            line-height: 0.5;
            font-size: 0.75em;
        }
        .countdown_wrapper #countdown .num{
            font-size: 1em;
            margin-bottom: -5px;
        }
    }


</style>

<div class="countdown_wrapper" >
    <div class="countdown_wrapper-children">
        <div class="bar_countdown" id="countdown">
            <div>
                <span class="num">-</span>
                <span class="title">days</span>
            </div>
            <div>
                <span class="num">-</span>
                <span class="title">hours</span>
            </div>
            <div>
                <span class="num">-</span>
                <span class="title">minutes</span>
            </div>
            <div>
                <span class="num">-</span>
                <span class="title">seconds</span>
            </div>
        </div>
        <div class="bar_title">
            <a href="https://baketivity.com/duffgoldman/">
                <img src="https://baketivity.com/wp-content/uploads/2022/03/countdown_desktop.jpg" class="desktop" style="margin: 0 auto;" loading="lazy">
                <img src="https://baketivity.com/wp-content/uploads/2022/03/countdown_mobile_720.jpg" class="mobile_720" style="margin: 0 auto;" loading="lazy">
                <img src="https://baketivity.com/wp-content/uploads/2022/03/countdown_mobile_375.jpg" class="mobile_375" style="margin: 0 auto;" loading="lazy">
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let countDownDate = new Date("<?php echo $countdown_date;?>").getTime(); // .toLocaleString("en-US", {timeZone: "America/New_York"});//
        let loop = setInterval(function() {
            let now = new Date().getTime(),
                distance = countDownDate - now,
                days = Math.floor(distance / (1000 * 60 * 60 * 24)),
                hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
                minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
                seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML = '<div><span class="num">' + days + '</span><span class="title">days</span></div>' +
                '<div><span class="num">' + hours + '</span><span class="title">hours</span></div>' +
                '<div><span class="num">'+ minutes + '</span><span class="title">minutes</span></div>' +
                '<div><span class="num">' + seconds + '</span><span class="title">seconds</span></div>';

            if (distance < 0) {
                clearInterval(loop);
                document.getElementById("countdown").innerHTML = "EXPIRED";
            }
        }, 1000);
    });
</script>