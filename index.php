<?php
/**
 * Template Name: Blog Index
 * Description: The template for displaying the Blog index /blog.
 *
 */

get_header();

$page_id = get_option( 'page_for_posts' );
?>
<div class="row">
	<?php get_sidebar(); ?>
	<div class="col-md-10">
		<div class="body-workspace">
			<?php include('inc/subheader.php') ?>
			<?php
				echo apply_filters( 'the_content', get_post_field( 'post_content', $page_id ) );

				edit_post_link( __( 'Edit', 'intranet' ), '<span class="edit-link">', '</span>', $page_id );
			?>
			<?php
				get_template_part( 'archive', 'loop' );
			?>
		</div>
	</div>	
</div><!-- /.row -->
<?php
get_footer();
