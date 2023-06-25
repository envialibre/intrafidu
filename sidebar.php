<?php
/**
 * Sidebar Template.
 */

if ( is_active_sidebar( 'primary_widget_area' ) || is_archive() || is_single() ) :
?>
<div id="sidebar" class="col-md-2 order-md-first">
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
				<?php $user_info = get_userdata($user->ID);
				
				if (isset($user_info->display_name)){
					$user_name = $user_info->display_name;
				}else{
					$user_name = 'Nombre: usuario no logueado';
				}
				
				if (isset($user_info->user_email)){
					$user_email = $user_info->user_email;
				}else{
					$user_email = 'Email: usuario no logueado';
				}
				?>
				<div class="user-fullname"><?php if ( isset($user_name) ) {echo $user_name;} ?></div>	
				<div class="user-email"><?php if ( isset($user_email) ) { echo $user_email; } ?></div>
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
	?>
</div><!-- /#sidebar -->
<?php
	endif;
?>
