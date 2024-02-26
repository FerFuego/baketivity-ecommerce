<?php
/**
 * Popup bone template
 *
 * @author  YITH
 * @package YITH WooCommerce Added to Cart Popup
 * @version 1.0.0
 */

if ( ! defined( 'YITH_WACP' ) ) {
	exit;
}
?>

<div id="yith-wacp-popup" class="<?php echo esc_attr( $animation ); ?>">

	<div class="yith-wacp-overlay"></div>

	<div class="yith-wacp-wrapper woocommerce">

		<div class="yith-wacp-main">

			<div class="yith-wacp-head">
				<div class="yith-wacp-close" style="cursor: pointer;">
					<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
						<g clip-path="url(#clip0_836_22700)">
						<path d="M1.42655 15.6537C1.22266 15.6537 1.01877 15.5762 0.863856 15.4202C0.552868 15.1094 0.552868 14.6056 0.863856 14.2948L14.7494 0.41911C15.0604 0.108344 15.5646 0.108344 15.8756 0.41911C16.1866 0.729877 16.1866 1.23371 15.8756 1.54467L1.99021 15.4202C1.83414 15.5752 1.63025 15.6537 1.42655 15.6537Z" fill="black"/>
						<path d="M15.3131 15.6537C15.1092 15.6537 14.9055 15.5762 14.7504 15.4202L0.863856 1.54467C0.552868 1.23371 0.552868 0.729877 0.863856 0.41911C1.17484 0.108344 1.67903 0.108344 1.99021 0.41911L15.8756 14.2948C16.1866 14.6056 16.1866 15.1094 15.8756 15.4202C15.7195 15.5752 15.5158 15.6537 15.3131 15.6537Z" fill="black"/>
						</g>
						<defs><clipPath id="clip0_836_22700"><rect width="15.4786" height="15.4676" fill="white" transform="translate(0.622559 0.186035)"/></clipPath></defs>
					</svg>
				</div>
				
				<div class="cart-count" id="d-cart-count">
					<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'Your Cart' ); ?>"><?php _e( 'Your Cart' ); ?></a>
				</div>
			</div>
			
			<h3 class="cart-list-title"><svg xmlns="http://www.w3.org/2000/svg" width="33.887" height="20.011" viewBox="0 0 33.887 20.011">
			  <g id="Group_1563" data-name="Group 1563" transform="translate(-2.5 78.102)">
			    <path id="Path_1935" data-name="Path 1935" d="M44.974-69.969l-1.569-3.638a3.594,3.594,0,0,0-3.317-2.176H37.555v-.928a1.392,1.392,0,0,0-1.39-1.39H18.473a.921.921,0,0,0-.928.928.945.945,0,0,0,.928.928H35.63V-69.4a1.523,1.523,0,0,0,1.534,1.534h6.171v4.316a.319.319,0,0,1-.32.32H41.871a3.433,3.433,0,0,0-2.961-1.712,3.509,3.509,0,0,0-2.961,1.712H26.427a3.433,3.433,0,0,0-2.961-1.712,3.509,3.509,0,0,0-2.961,1.712H17.225a.921.921,0,0,0-.928.928.921.921,0,0,0,.928.928h2.817a3.42,3.42,0,0,0,3.425,3.281,3.423,3.423,0,0,0,3.425-3.281h8.6a3.42,3.42,0,0,0,3.425,3.281,3.423,3.423,0,0,0,3.425-3.281h.75a2.186,2.186,0,0,0,2.176-2.176v-4.993a4.136,4.136,0,0,0-.288-1.428ZM23.466-59.946A1.583,1.583,0,0,1,21.9-61.515a1.583,1.583,0,0,1,1.569-1.569,1.583,1.583,0,0,1,1.569,1.569A1.581,1.581,0,0,1,23.466-59.946Zm15.444,0a1.583,1.583,0,0,1-1.569-1.569,1.583,1.583,0,0,1,1.569-1.569,1.583,1.583,0,0,1,1.569,1.569A1.581,1.581,0,0,1,38.911-59.946ZM37.52-73.893h2.533a1.672,1.672,0,0,1,1.569,1.034l1.356,3.139H37.52Z" transform="translate(-8.876)" fill="#ee324d"/>
			    <path id="Path_1936" data-name="Path 1936" d="M13.224-65.347h6.562a.921.921,0,0,0,.928-.928.921.921,0,0,0-.928-.928H13.224a.921.921,0,0,0-.928.928A.946.946,0,0,0,13.224-65.347Z" transform="translate(-6.302 -7.011)" fill="#ee324d"/>
			    <path id="Path_1937" data-name="Path 1937" d="M8.326-55.347h6.562a.921.921,0,0,0,.928-.928.921.921,0,0,0-.928-.928H8.326a.921.921,0,0,0-.928.928A.945.945,0,0,0,8.326-55.347Z" transform="translate(-3.151 -13.445)" fill="#ee324d"/>
			    <path id="Path_1938" data-name="Path 1938" d="M10.953-46.276a.921.921,0,0,0-.928-.928h-6.6a.921.921,0,0,0-.928.928.921.921,0,0,0,.928.928H9.99a.91.91,0,0,0,.963-.929Z" transform="translate(0 -19.878)" fill="#ee324d"/>
			  </g>
			</svg>
			<?php echo esc_html( apply_filters( 'yith_wacp_cart_popup_title', __( 'Now shipping to USA and Canada', 'yith-woocommerce-added-to-cart-popup' ) ) ); ?></h3>

			<div class="yith-wacp-content"></div>

		</div>

	</div>

</div>
