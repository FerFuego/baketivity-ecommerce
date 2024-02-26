<div class="d-recipe" data-id="<?php the_ID(); ?>">
	<div class="d-recipe-content">
		<div class="d-video">
			<?php
			if ($video = get_field('video_')) :
				videoSupport([
					'video_url' => $video,
					'button_content' => '<svg xmlns="http://www.w3.org/2000/svg" width="118.369" height="75.225" viewBox="0 0 118.369 75.225"><g id="Grupo_77725" data-name="Grupo 77725" transform="translate(-438 -678)">
					  <rect id="Rectángulo_6412" data-name="Rectángulo 6412" width="118.369" height="75.225" rx="15" transform="translate(438 678)" fill="#c0dd52"/>
					  <path id="Polígono_6" data-name="Polígono 6" d="M23.231,0,46.463,39.825H0Z" transform="translate(520.969 692.381) rotate(90)" fill="#fff"/></g>
					  </svg>',
					'placeholder_url' => get_field('thumb_url'),
				]);
			endif; ?>
		</div>
	</div>
	<h3>
		<?php
		$age = '';
		if (get_field('child_birthday', false)) {

			$bday = new DateTime(get_field('child_birthday', false)); // Your date of birth
			$today = new Datetime(date('m.d.y'));

			if (strtotime('today') > strtotime($bday)) {
				$diff = $today->diff($bday);
				$age = $diff->y;
			}
		}

		$name = get_field('child_first_name') . ' ' . get_field('child_last_name');
		echo $name; ?><?php echo ', ' . $age; ?>
	</h3>
	<div class="address">
		<?php //if (get_field('town__city')) :
		//echo trim(get_field('town__city'));
		//endif; 
		?>
		<?php if (get_field('state')) :
			//echo ', ' . trim(get_field('state'));
			echo trim(get_field('state'));
		endif; ?>
	</div>
	<div class="d-recipe__vote-btn">
		<div class="like-btn">
			<a href="javascript:;" data-id="<?php echo get_the_ID(); ?>" class="btn-vote-modal" data-img="<?= get_field('thumb_url'); ?>">
				<img class="d-recipe__like" src="<?php echo get_stylesheet_directory_uri(); ?>/images/bake-away/like-video.svg" alt="like video">
			</a>
		</div>
		<div class="d-recipe__total-vote">
			<?php
			$vote = get_post_meta(get_the_ID(), '_vote_meta', true);

			if (empty($vote) || $vote == 0) {
				echo '<span class="vote-number">0</span> Vote recive';
			} elseif ($vote > 1) {
				echo '<span class="vote-number">' . $vote . '</span> Votes recived';
			} else {
				echo '<span class="vote-number">' . $vote . '</span> Vote recive';
			}
			?>
		</div>
	</div>
	<div class="video-share">
		<div class="addthis_inline_share_toolbox_tzp0" data-url="<?php echo home_url('/bake-away-vote/'); ?>" data-title="<?php the_title_attribute(); ?>"></div>
		<div class="addthis_inline_share_toolbox 123">
			<div class="at-share-btn-elements">
				<a class="at-share-btn" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_field('video_'); ?>">
					<img class="d-recipe__like" src="<?php echo get_stylesheet_directory_uri(); ?>/images/bake-away/facebook.svg" alt="share facebook">
				</a>

				<a class="at-share-btn" target="_blank" href="https://twitter.com/share?url=<?php echo get_field('video_'); ?> ">
					<img class="d-recipe__like" src="<?php echo get_stylesheet_directory_uri(); ?>/images/bake-away/twitter.svg" alt="share twitter">
				</a>

				<a class="at-share-btn" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo get_the_post_thumbnail_url(); ?>&description=<?php echo excerpt(20); ?>">
					<img class="d-recipe__like" src="<?php echo get_stylesheet_directory_uri(); ?>/images/bake-away/pinterest.svg" alt="share pinterest">
				</a>
			</div>
		</div>
	</div>
</div>