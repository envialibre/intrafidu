<?php
/**
 * Sidebar Template.
 */

if ( is_active_sidebar( 'primary_widget_area' ) || is_archive() || is_single() ) :
?>
<div id="sidebar" class="col-md-2 order-md-first col-sm-12 order-sm-first">
	<?php
		if ( is_active_sidebar( 'primary_widget_area' ) ) :
	?>
		<div id="widget-area" class="widget-area" role="complementary">

			<?php
			$user = wp_get_current_user();
			if ( $user ) :
				?>
			<div class="user-fulldata">
				<div class="profile-image-user">
					<div class="img-rounded-profile" style="background-image: url(<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>)"></div>
				</div>
				<?php $user_info = get_userdata($user->ID); ?>
				<?php $user_name = $user_info->display_name; ?>
				<?php $user_email = $user_info->user_email; ?>
				<div class="user-fullname"><?php echo $user_name; ?></div>	
				<div class="user-email"><?php echo $user_email; ?></div>
			</div>					

			<?php endif;?>


			<?php
				dynamic_sidebar( 'primary_widget_area' );

				if ( current_user_can( 'manage_options' ) ) :
			?>
				<span class="edit-link"><a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" class="badge bg-secondary"><?php esc_html_e( 'Edit', 'intranet' ); ?></a></span><!-- Show Edit Widget link -->
			<?php
				endif;
			?>

		</div><!-- /.widget-area -->
	<?php
		endif;

		if ( is_archive() || is_single() ) :
	?>
		<div class="bg-faded sidebar-nav">
			<div id="primary-two" class="widget-area">
				<?php
					$output = '<ul class="recentposts">';
						$recentposts_query = new WP_Query( array( 'posts_per_page' => 5 ) ); // Max. 5 posts in Sidebar!
						$month_check = null;
						if ( $recentposts_query->have_posts() ) :
							$output .= '<li><h3>' . esc_html__( 'Recent Posts', 'intranet' ) . '</h3></li>';
							while ( $recentposts_query->have_posts() ) :
								$recentposts_query->the_post();
								$output .= '<li>';
									// Show monthly archive and link to months.
									$month = get_the_date( 'F, Y' );
									if ( $month !== $month_check ) :
										$output .= '<a href="' . esc_url( get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) ) ) . '" title="' . esc_attr( get_the_date( 'F, Y' ) ) . '">' . esc_html( $month ) . '</a>';
									endif;
									$month_check = $month;

								$output .= '<h4><a href="' . esc_url( get_the_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'intranet' ), the_title_attribute( array( 'echo' => false ) ) ) . '" rel="bookmark">' . esc_html( get_the_title() ) . '</a></h4>';
								$output .= '</li>';
							endwhile;
						endif;
						wp_reset_postdata();
					$output .= '</ul>';

					echo $output;
				?>
				<br />
				<ul class="categories">
					<li><h3><?php esc_html_e( 'Categories', 'intranet' ); ?></h3></li>
					<?php
						wp_list_categories( array( 'title_li' => '' ) );

						if ( ! is_author() ) :
					?>
							<li>&nbsp;</li>
							<li><a href="<?php the_permalink( get_option( 'page_for_posts' ) ); ?>" class="btn btn-outline-secondary"><?php esc_html_e( 'more', 'intranet' ); ?></a></li>
					<?php
						endif;
					?>
				</ul>
			</div><!-- /#primary-two -->
		</div>
	<?php
		endif;
	?>
</div><!-- /#sidebar -->
<?php
	endif;
?>
