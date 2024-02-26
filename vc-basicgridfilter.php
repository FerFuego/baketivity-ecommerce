<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 */
//global $att;
//var_dump($atts);
$atts = $attribute['atts'];
$filter_terms = $attribute['filter_terms'];
//echo '<pre>'; print_r($atts); echo '</pre>';
$output = '';
//cho '1232';
if ( 'yes' === $atts['show_filter'] && ! empty( $filter_terms ) ) {
	$unique_terms = array_unique( $filter_terms );
	$terms_ids = ! empty( $atts['exclude_filter'] ) ? array_diff( $unique_terms, // Posts filter terms
		array_map( 'abs', preg_split( '/\s*\,\s*/', $atts['exclude_filter'] ) ) ) : $unique_terms;
	$terms = count( $terms_ids ) > 0 ? get_terms( $atts['filter_source'], array(
		'include' => implode( ',', $terms_ids ),
		'with_thumbnail' => true
	) ) : array();

	$filter_default = $atts['filter_default_title'];
	if ( empty( $filter_default ) ) {
		$filter_default = esc_html__( 'All 12 1', 'js_composer' );
	}
	if ( 'dropdown' !== $atts['filter_style'] ) {
		$output .= '<ul class="vc_grid-filter 123213 vc_clearfix vc_grid-filter-' . esc_attr( $atts['filter_style'] ) . ' vc_grid-filter-size-' . esc_attr( $atts['filter_size'] ) . ' vc_grid-filter-' . esc_attr( $atts['filter_align'] ) . ' vc_grid-filter-color-' . esc_attr( $atts['filter_color'] ) . '" data-vc-grid-filter="' . esc_attr( $atts['filter_source'] ) . '">';
		$i = 0;
		
		foreach ( $terms as $term ) {
			$active ='';
			$icon = get_field('icon', $term->taxonomy . '_' . $term->term_id);
/*			if(wp_is_mobile()){
				$image_id           = get_term_meta( $term->term_id, 'thumbnail_id', true );
				$post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'large' );
				$icon = $post_thumbnail_img[0];
			}*/
			if($i == 0){
				$active = 'vc_active';
			}

			$output .= '<li class="vc_grid-filter-item '.$active .'">';
/*			if (wp_is_mobile()) {
				$output .= '<div id="fc-custom-icon"">';
				$output .= '<img  src="'. $icon .'">';
				$output .= '</div>';
			} else {
				$output .= $icon;
			}*/
			$output .= $icon;
			$output .= '<span' . ' data-vc-grid-filter-value=".vc_grid-term-' . esc_attr( $term->term_id ) . '">';
			$output .= esc_attr( $term->name );
			$output .= '</span></li>';
			$i++;
		}
		$output .= '<li class="vc_grid-filter-item all-css"><span data-vc-grid-filter-value="*">';
		$output .= esc_attr( $filter_default );

		$output .= '</span></li>';
		$output .= '</ul>';
	}

	$output .= '<div class="' . ( 'dropdown' === $atts['filter_style'] ? 'vc_grid-filter-dropdown' : 'vc_grid-filter-select' ) . ' vc_grid-filter-' . esc_attr( $atts['filter_align'] ) . ' vc_grid-filter-color-' . esc_attr( $atts['filter_color'] ) . '" data-vc-grid-filter-select="' . esc_attr( $atts['filter_source'] ) . '"><div class="vc_grid-styled-select"><select data-filter="' . esc_attr( $atts['filter_source'] ) . '"><option class="vc_active" value="*">' . esc_attr( $filter_default ) . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';

	foreach ( $terms as $term ) {
		$output .= '<option value=".vc_grid-term-' . esc_attr( $term->term_id ) . '">' . esc_html( $term->name ) . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
	}
	$output .= '</select><i class="vc_arrow-icon-navicon"></i>
		</div>
	</div>';
	
}


echo $output;
