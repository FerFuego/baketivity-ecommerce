<?php


class Tracking_Class
{

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_action('wp_head', [$this, 'add_head_scripts']);
        add_action('wp_footer', [$this, 'add_footer_scripts']);
    }


    public function add_head_scripts()
    {
        if (wp_get_environment_type() == "production") : ?>
            <!-- Begin: Northbeam pixel -->
            <!-- <script>
                (function() {
                    var r;
                    (e = r = r || {}).A = "identify", e.B = "trackPageView", e.C = "fireEmailCaptureEvent", e.D = "fireCustomGoal", e.E = "firePurchaseEvent";
                    var e = "//j.northbeam.io/ota-sp/c078ea32-2d8b-44e9-997f-5877eb3c8001.js";

                    function t(e) {
                        for (var n = [], r = 1; r < arguments.length; r++) n[r - 1] = arguments[r];
                        a.push({
                            fnName: e,
                            args: n
                        })
                    }
                    var a = [],
                        n = ((n = {
                            _q: a
                        })[r.A] = function(e, n) {
                            return t(r.A, e, n)
                        }, n[r.B] = function() {
                            return t(r.B)
                        }, n[r.C] = function(e, n) {
                            return t(r.C, e, n)
                        }, n[r.D] = function(e, n) {
                            return t(r.D, e, n)
                        }, n[r.E] = function(e) {
                            return t(r.E, e)
                        }, window.Northbeam = n, document.createElement("script"));
                    n.async = !0, n.src = e, document.head.appendChild(n);
                })()
            </script> -->
            <!-- End: Northbeam pixel -->
        <?php endif;
    }


    public function add_footer_scripts()
    {
        if (wp_get_environment_type() == "production") :
        ?>
            <!-- Threecolth -->
            <script type="text/javascript" id="UR_initiator">
                (function() {
                    var iid = 'uriid_da39a3ee5e6b4b0d3255bfef95601890afd80709';
                    if (!document._fpu_) document.getElementById('UR_initiator').setAttribute('id', iid);
                    var bsa = document.createElement('script');
                    bsa.type = 'text/javascript';
                    bsa.async = true;
                    bsa.src = 'https://static.onsitesupport.io/public/baketivity/sdk/chat-' + iid + '-13.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
                })();
            </script>
<?php endif;
    }
}
