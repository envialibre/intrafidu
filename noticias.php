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
						<div class="img-masreciente"><?php echo get_the_post_thumbnail( $post->ID, 'full', array( 'class' => 'img-fluid' ) ); ?></div>
					<div class="box-recientes">
						<div class="fecha-masreciente"><span><?php echo esc_html( get_the_date() ); ?></span></div>
						<div class="titulo-masreciente"><h2><?php  echo esc_html( get_the_title() ); ?></h2></div>
						<div class="txt-masreciente"><p><?php echo esc_html( get_the_excerpt()); ?></p></div>
				    </div>


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

			<div class="row">
				<div class="col-md-12">
				   <span class="subtitulos">Otras Noticias</span>
				</div>
				
				Revisar

				<div class="col-md-5">
						<div class="img-otrasnoticias1"><?php echo get_the_post_thumbnail( $post->ID, 'full', array( 'class' => 'img-fluid' ) ); ?></div>
					<div class="box-otrasnoticias1">
						<div class="fecha-otrasnoticias1"><span><?php echo esc_html( get_the_date() ); ?></span></div>
						<div class="titulo-otrasnoticias1"><h2><?php  echo esc_html( get_the_title() ); ?></h2></div>
						<div class="txt-otrasnoticias1"><p><?php echo esc_html( get_the_excerpt()); ?></p></div>
				    </div>

				<div class="col-md-5">
					<div class="img-otrasnoticias1"><?php echo get_the_post_thumbnail( $post->ID, 'full', array( 'class' => 'img-fluid' ) ); ?></div>
					<div class="box-otrasnoticias1">
						<div class="fecha-otrasnoticias1"><span><?php echo esc_html( get_the_date() ); ?></span></div>
						<div class="titulo-otrasnoticias1"><h2><?php  echo esc_html( get_the_title() ); ?></h2></div>
						<div class="txt-otrasnoticias1"><p><?php echo esc_html( get_the_excerpt()); ?></p></div>
				    </div>

				<div class="col-md-7">
					<div class="img-otrasnoticias1"><?php echo get_the_post_thumbnail( $post->ID, 'full', array( 'class' => 'img-fluid' ) ); ?></div>
					<div class="box-otrasnoticias1">
						<div class="fecha-otrasnoticias1"><span><?php echo esc_html( get_the_date() ); ?></span></div>
						<div class="titulo-otrasnoticias1"><h2><?php  echo esc_html( get_the_title() ); ?></h2></div>
						<div class="txt-otrasnoticias1"><p><?php echo esc_html( get_the_excerpt()); ?></p></div>
				    </div>


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
