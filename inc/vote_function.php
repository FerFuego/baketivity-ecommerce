<?php
// Gravity Forms Custom Address Hook (Australia)
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
// Add the custom columns to the book post type:
add_filter('manage_recipe_posts_columns', 'set_custom_edit_book_columns');
function set_custom_edit_book_columns($columns)
{
	$columns['vote'] = __('Vote', 'baketivity');
	return $columns;
}

// Add the data to the custom columns for the book post type:
add_action('manage_recipe_posts_custom_column', 'custom_book_column', 10, 2);
function custom_book_column($column, $post_id)
{
	switch ($column) {
		case 'vote':
			echo get_post_meta($post_id, '_vote_meta', true);
			break;
	}
}

add_filter('manage_edit-recipe_sortable_columns', 'my_sortable_cake_column');
function my_sortable_cake_column($columns)
{
	$columns['vote'] = 'vote';
	return $columns;
}

add_action('pre_get_posts', 'my_slice_orderby');
function my_slice_orderby($query)
{
	if (!is_admin())
		return;

	$orderby = $query->get('orderby');

	if ('vote' == $orderby) {
		$query->set('meta_key', '_vote_meta');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'DESC');
	}
}

add_action('add_meta_boxes', 'add_vote_box');
function add_vote_box()
{
	$screens = ['recipe'];
	foreach ($screens as $screen) {
		add_meta_box(
			'vote_box', // Unique ID
			'Vote box', // Box title
			'vote_box_function', // Content callback, must be of type callable
			$screen // Post type
		);
	}
}

function vote_box_function($post)
{
	$value = get_post_meta($post->ID, '_vote_meta', true);
	$ip = get_post_meta($post->ID, '_vote_ip', true);
?>
	<input type="number" name="_vote_meta" value="<?php echo $value; ?>">
	<input type="text" name="_vote_ip" value="<?php echo $ip; ?>">
<?php
}

add_action('save_post', 'vote_save_postdata');
function vote_save_postdata($post_id)
{
	if (array_key_exists('_vote_meta', $_POST)) {
		update_post_meta(
			$post_id,
			'_vote_meta',
			$_POST['_vote_meta']
		);
	}
	if (array_key_exists('_vote_ip', $_POST)) {
		update_post_meta(
			$post_id,
			'_vote_ip',
			$_POST['_vote_ip']
		);
	}
}

add_action('wp_insert_post', 'new_recipe', 10, 3);
function new_recipe($post_id, $post, $update)
{
	if ($post->post_type == 'recipe' && $post->post_status == 'pending') {
		$excerpt = $post->post_excerpt;
		if (!empty($excerpt) && isset($excerpt)) {
			$data = explode("||", $excerpt);

			if (empty(get_post_meta($post_id, 'parentlegal_guardian_first_name', true))) {
				update_post_meta($post_id, 'parentlegal_guardian_first_name', $data[0]);
			}

			if (empty(get_post_meta($post_id, 'parentlegal_last_name', true))) {
				update_post_meta($post_id, 'parentlegal_last_name', $data[1]);
			}

			if (empty(get_post_meta($post_id, 'street_address', true))) {
				update_post_meta($post_id, 'street_address', $data[2]);
			}

			if (empty(get_post_meta($post_id, 'apt_suite', true))) {
				update_post_meta($post_id, 'apt_suite', $data[16]);
			}

			if (empty(get_post_meta($post_id, 'country', true))) {
				update_post_meta($post_id, 'country', $data[6]);
			}

			if (empty(get_post_meta($post_id, 'state', true))) {
				update_post_meta($post_id, 'state', $data[4]);
			}

			if (empty(get_post_meta($post_id, 'town__city', true))) {
				update_post_meta($post_id, 'town__city', $data[3]);
			}

			if (empty(get_post_meta($post_id, 'zip', true))) {
				update_post_meta($post_id, 'zip', $data[5]);
			}

			if (empty(get_post_meta($post_id, 'phone', true))) {
				update_post_meta($post_id, 'phone', $data[12]);
			}

			if (empty(get_post_meta($post_id, 'email_address', true))) {
				update_post_meta($post_id, 'email_address', $data[13]);
			}

			if (empty(get_post_meta($post_id, 'child_first_name', true))) {
				update_post_meta($post_id, 'child_first_name', $data[7]);
			}

			if (empty(get_post_meta($post_id, 'child_last_name', true))) {
				update_post_meta($post_id, 'child_last_name', $data[8]);
			}

			if (empty(get_post_meta($post_id, 'child_birthday', true))) {
				update_post_meta($post_id, 'child_birthday', $data[10]);
			}

			if (empty(get_post_meta($post_id, 'how_did_you_hear_about_this', true))) {
				update_post_meta($post_id, 'how_did_you_hear_about_this', $data[11]);
			}

			if (empty(get_post_meta($post_id, 'are_you_a_baketivity_subscriber', true))) {
				update_post_meta($post_id, 'are_you_a_baketivity_subscriber', $data[9]);
			}

			if (empty(get_post_meta($post_id, 'video_', true))) {
				update_post_meta($post_id, 'video_', $data[14]);
			}

			$post->post_excerpt = '';
		}
		# And update the meta so it wont run again
		// update_post_meta( $post_id, 'check_if_run_once', true );
	}
	//file_put_contents(__FILE__.'.log', "\n");
	//file_put_contents(__FILE__.'.log', '---'."\n".print_r($post,1)."\n".print_r($_SERVER,1)."\n\n", FILE_APPEND);
}

add_action('wp_enqueue_scripts', 'vote_enqueue_assets');
function vote_enqueue_assets()
{
	if (!is_cart() && !is_checkout()) {
		// JavaScript
		wp_enqueue_script('vote_js', get_stylesheet_directory_uri() . '/js/vote-d.js', array('jquery'), '1.0', true);
		wp_localize_script('vote_js', 'NG_VOTE', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce'   => wp_create_nonce('cast_tweak_me_vote')
		));
	}
}

add_action('wp_ajax_nopriv_recipe_vote', 'recipe_vote');
add_action('wp_ajax_recipe_vote', 'recipe_vote');
function recipe_vote()
{
	// Security check. If this doesn't validate, the script will automatically die.
	check_ajax_referer('cast_tweak_me_vote', 'nonce');
	// Get the id they're voting for.
	$id = intval(strip_tags($_POST['id']));
	$email = strip_tags($_POST['email']);
	$first_name = strip_tags($_POST['first_name']);
	$last_name = strip_tags($_POST['last_name']);
	$phone_number = strip_tags($_POST['phone_number']);
	// If they've already voted, they can't vote again.
	if (is_user_voted($id, $email)) {
		wp_send_json_error('You have already voted!');
		exit;
	}
	set_user_voted($id, $email);

	// Set a cookie. Change "August 15, 2016" to the date you want the cookie to expire.
	setcookie('ng_vote_tweak_me', $ip, strtotime('August 15, 2024'), COOKIEPATH, COOKIE_DOMAIN, false, false);

	// Update their vote.
	$votes              = get_post_meta($id, '_vote_meta', true);
	$number_votes       = is_numeric($votes) ? $votes + 1 : 1;
	//$votes[ $blog_url ] = $number_votes;

	// Update the votes in the database.
	update_post_meta($id, '_vote_meta', $number_votes);
	do_action('baketivity_add_vote', $id, $email, $first_name, $last_name, $phone_number);
	wp_send_json_success($number_votes);
}

function has_voted($id)
{
	$ip        = get_ip();
	$voted_ips = explode(',', get_post_meta($id, '_vote_ip', true));

	// If their IP is in the array of voted IPs, they've voted.
	if (in_array($ip, $voted_ips)) {
		return true;
	}

	return false;
}

function is_user_voted($id, $email)
{
	// if email isn't correct we return true to prevent the vote
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	$voted_emails = explode(',', get_post_meta($id, '_vote_email', true));
	if (in_array($email, $voted_emails)) {
		return true;
	}
	return false;
}

function set_user_voted($id, $email)
{
	$voted_emails = explode(',', get_post_meta($id, '_vote_email', true));
	$voted_emails[] = $email;
	$voted_emails = array_unique($voted_emails);
	$voted_emails = implode(',', $voted_emails);
	update_post_meta($id, '_vote_email', $voted_emails);
}


function get_ip()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		//check ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		//to check ip is pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	return $ip;
}



add_action('wp_head', 'vote_js');
function vote_js()
{
?>
	<script type="text/javascript">
		jQuery.noConflict();

		jQuery(document).ready(function($) {
			jQuery(document).on('click', '.d-video', function() {
				jQuery(this).find('video').trigger("play");
				jQuery(this).addClass('active');
			})

			jQuery('.d-video video').bind('stop pause', function(e) {
				jQuery(this).parent().removeClass('active');
			});

			jQuery(document).on('click', 'a.btn-vote', function(e) {
				var btn = jQuery(this);
				// Prevent them from actually visiting the URL when clicking.
				e.preventDefault();
				// Get some useful variables rollin'.
				var isDisabled = $(this).attr('disabled');
				var id = $(this).attr('data-id');

				if (typeof isDisabled !== typeof undefined && isDisabled !== false) {
					alert('You have already voted!');
					return false;
				}
				jQuery('.d-section-rp').addClass('loading');

				$(this).attr('disabled', true);

				// Add a little 'waiting' thingie to the cursor.
				$(document.body).css({
					'cursor': 'wait'
				});

				$.ajax({
					type: 'POST',
					url: NG_VOTE.ajaxurl,
					data: {
						action: 'recipe_vote', // Ajax hooked into WordPress
						id: id, // The blog URL
						nonce: NG_VOTE.nonce // Our security nonce
					},
					dataType: 'json',
					beforeSend: function() {
						// jQuery(this).addClass('loading');
					},
					success: function(response) {
						// Change the cursor back to normal.
						$(document.body).css({
							'cursor': 'default'
						});
						jQuery('.d-section-rp').removeClass('loading');
						if (true === response.success) {
							var vote = response.data;
							if (vote == 1) {
								jQuery(btn).parents('.vote-btn').find('.total-vote').html('<span class="vote-number">1</span> Vote')
							} else {
								jQuery(btn).parents('.vote-btn').find('.total-vote').html('<span class="vote-number">' + vote + '</span> Votes')
							}
						} else {
							alert(response.data);
						}
					}
				}).fail(function(response) {
					// This stuff only happens if things fail miserably.
					$(document.body).css({
						'cursor': 'default'
					});
					if (window.console && window.console.log) {
						// console.log(response);
					}
				});

			});

			//NEW VOTE
			jQuery(document).on('click', 'a.btn-vote-modal', function(e) {
				e.preventDefault();

				var btn = jQuery(this);
				var id = btn.attr('data-id');
				var title = jQuery.trim(btn.closest('.d-recipe').find('h3').text());
				var address = jQuery.trim(btn.closest('.d-recipe').find('.address').text());

				jQuery('#voteModal .bake-away-vote-modal__left').css('background-image', 'url(' + btn.attr('data-img') + ')');
				jQuery('#voteModal .bake-away-vote-modal__name').text(title);
				jQuery('#voteModal .bake-away-vote-modal__locality').text(address);
				jQuery('#voteModal').modal();

				jQuery(document).on("submit", ".bake-away-vote-modal form", function(e) {
					var isFormValid = true;

					jQuery.each($('.bake-away-vote-modal form input[type="text"]'), function(index, value) {
						if (!jQuery(value).val()) {
							isFormValid = false;
						}
					});

					if (isFormValid) {
						var voteSubmit = new Promise((resolve, reject) => {
							jQuery.ajax({
								type: 'POST',
								url: NG_VOTE.ajaxurl,
								data: {
									action: 'recipe_vote',
									id: id,
									nonce: NG_VOTE.nonce,
									first_name: jQuery('input[name="input_1"]').val(),
									last_name: jQuery('input[name="input_2"]').val(),
									phone_number: jQuery('input[name="input_3"]').val(),
									email: jQuery('input[name="input_4"]').val(),
								},
								dataType: 'json',
								beforeSend: function() {},
								success: function(response) {
									if (true === response.success) {
										resolve(response, btn);
									} else {
										reject(response);
									}
								}
							}).fail(function(response) {
								reject(response);
							});
						});

						voteSubmit.then(
							(response, btn) => {
								jQuery(document.body).css({
									'cursor': 'default'
								});
								jQuery('.d-section-rp').removeClass('loading');

								var vote = response.data;

								if (vote == 1) {
									jQuery(btn).parents('.vote-btn').find('.total-vote').html('<span class="vote-number">1</span> Vote')
								} else {
									jQuery(btn).parents('.vote-btn').find('.total-vote').html('<span class="vote-number">' + vote + '</span> Votes')
								}

							},
							(response) => {
								jQuery(document.body).css({
									'cursor': 'default'
								});

								if (typeof(response) != 'undefined' && typeof(response.data) != 'undefined') {
									alert(response.data);
								}

								window.location.reload(true);
							}
						);
					}
				});
			});
		});
	</script>
<?php
}
