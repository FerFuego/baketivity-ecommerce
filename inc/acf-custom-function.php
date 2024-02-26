<?php
/**
 * Escape Wysiwyg
 */
function esc_wysiwyg($wysiwyg) {
    $wysiwyg = wp_kses($wysiwyg, 'post');
    return $wysiwyg;
}


/**
 * Custom Wysiwyg
 */ 
add_filter( 'acf/fields/wysiwyg/toolbars' , 'only_bold'  );
function only_bold( $toolbars ) {
    $toolbars['Only Bold'] = array();
    $toolbars['Only Bold'][1] = array('bold');
    return $toolbars;
}