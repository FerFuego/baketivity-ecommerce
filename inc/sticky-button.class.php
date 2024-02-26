<?php

/**
 * Render a sticky button
 * This class is general
 */
class Sticky_Button
{

    private $active_desktop = false;
    private $active_mobile = false;
    private $styles_button = "";
    private $styles = "";
    private $link   = array();
    private $flash  = false;
    private $position  = "bottom-right";
    private $color  = "";
    private $text_color  = "";
    private $bg_color  = "";
    private $classes = array();

    public function __construct()
    {
        # if ACF class is not loaded, return
        if (!class_exists('ACF')) return;

        $this->active_desktop = get_field('sticky_button_active_desktop', 'option');
        $this->active_mobile  = get_field('sticky_button_active_mobile', 'option');
        $this->link           = get_field('sticky_button_link', 'option');
        $this->flash          = get_field('sticky_button_flash', 'option');
        $this->position       = get_field('sticky_button_position', 'option');
        $this->color          = get_field('sticky_button_color', 'option');
        $this->text_color     = get_field('sticky_button_text_color', 'option');
        $this->bg_color       = get_field('sticky_button_bg_color', 'option');

        // if not active, return
        if (!$this->active_desktop && !$this->active_mobile) return;

        // set styles
        $this->set_styles();

        // set classes
        $this->set_classes();

        if (!is_admin()) {
            // add script
            add_action('wp_footer', array($this, 'render_sticky_styles'));
            add_action('wp_footer', array($this, 'render_sticky_button'));
        }
    }

    private function set_styles()
    {
        switch ($this->position) {
            case "bottom-right":
                $this->styles .= "bottom: 20px; right: 20px;";
                break;
            case "bottom-left":
                $this->styles .= "bottom: 20px; left: 20px;";
                break;
            case "bottom-center":
                $this->styles .= "bottom: 20px; left: 50%; transform: translateX(-50%);";
                break;
            case "top-right":
                $this->styles .= "top: 20px; right: 20px;";
                break;
            case "top-left":
                $this->styles .= "top: 20px; left: 20px;";
                break;
        }

        $this->styles_button .= "background-color: {$this->color};";
        $this->styles_button .= "color: {$this->text_color};";
    }

    private function set_classes()
    {
        if (!$this->active_desktop) {
            $this->classes[] = "sticky-button--hidden-desktop";
        }
        if (!$this->active_mobile) {
            $this->classes[] = "sticky-button--hidden-mobile";
        }
    }

    public function render_sticky_styles()
    {
?>
        <style>
            .sticky-button {
                position: fixed;
                z-index: 999;
                <?php echo $this->styles; ?>
            }

            .sticky-button--hidden-desktop {
                display: none;
            }

            .sticky-button--hidden-mobile {
                display: none;
            }

            .sticky-button__button {
                <?php echo $this->styles_button; ?>
            }

            @media only screen and (max-width: 1024px) {
                .sticky-button {
                    background-color: <?php echo $this->bg_color; ?> !important;
                    bottom: 0 !important;
                    left: 0 !important;
                    right: 0 !important;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 2px 0;
                    transform: none !important;
                    width: 100%;
                }
            }
        </style>
    <?php
    }

    public function render_sticky_button()
    {
        if (is_checkout() || is_cart()) return;
    ?>
        <div class="sticky-button <?php echo implode(' ', $this->classes); ?>" id="sticky_button">
            <a class="sticky-button__button <?php echo ($this->flash) ? 'animate__flash' : ''; ?>" href="<?php echo (key_exists('url', $this->link)) ? $this->link['url'] : ''; ?>" target="<?php echo (key_exists('target', $this->link)) ? $this->link['target'] : ''; ?>">
                <?php echo (key_exists('title', $this->link)) ? $this->link['title'] : ''; ?>
            </a>
        </div>
<?php
    }
}
