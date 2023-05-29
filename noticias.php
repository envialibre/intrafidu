<?php
/**
 * Template Name: Noticias Principal
 * Description: Página principal de noticias
 *
 */

get_header();

the_post();
?>
<div class="row">

	<?php
		get_sidebar();
	?>

	<div class="col-md-10 order-md-2 col-sm-12">
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'content body-workspace' ); ?>>
			<?php
				the_content();
			?>

			<div class="row">
				<div class="col-md-12"><h1><?php echo esc_html( get_the_title() ); ?></h1></div>
				<div class="col-md-7">
					<div>
						<span class="subtitulos">Noticia Más Reciente</span>
					</div>
			<?php
			$postslist = get_posts( array(
				'posts_per_page' => 1,
				'order'          => 'ASC',
				'orderby'        => 'date'
			) );

			if ( $postslist ) {
				foreach ( $postslist as $post ) :
					setup_postdata( $post );
					?>
					<div class="noti-principal">
					<div><?php echo get_the_post_thumbnail( $post->ID, 'full', array( 'class' => 'img-fluid' ) ); ?></div>
						<div><span><?php echo esc_html( get_the_date() ); ?></span></div>
						<div><h2><?php  echo esc_html( get_the_title() ); ?></h2></div>
						<div><p><?php echo esc_html( get_the_excerpt()); ?></p></div>
					</div>
				<?php
				endforeach; 
				wp_reset_postdata();
			}
			?>
				

				</div>
				<div class="col-md-5">
					<h2>La noticias más leida</h2>
				</div>
			</div>



			<?php
				wp_link_pages(
					array(
						'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'intranet' ) . '">',
						'after'    => '</nav>',
						'pagelink' => esc_html__( 'Page %', 'intranet' ),
					)
				);
				edit_post_link(
					esc_attr__( 'Edit', 'intranet' ),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</div><!-- /#post-<?php the_ID(); ?> -->
		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		?>
	</div><!-- /.col -->

</div><!-- /.row -->
<?php
get_footer();
