<?php
/**
 * Template Name: Bienestar Principal
 * Description: Página principal de bienestar
 *
 */
get_header();

the_post();
$current_date = date('Ymd'); // Get the current date in the format d/m/Y
?>
<div class="row">

	<?php
		get_sidebar();
	?>

	<div class="col-md-10 order-md-2 col-sm-12">
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'content body-workspace' ); ?>>

			<div class="row">
				<div class="col-md-12">
                    <h1><?php echo esc_html( get_the_title() ); ?></h1>
                </div>
				
				<div class="col-md-5 pt-5">
					<h2><?php echo get_the_content(); ?></h2>
				</div>                
                
                <div class="col-md-7">
					<div class="img-masreciente">
                        <?php echo get_the_post_thumbnail( get_the_ID(), 'full', array('class' => 'img-fluid')); ?>
                    </div>                                                        
				</div>
			</div>

			<div class="row d-flex align-items-stretch">

				<?php

                    $args = array(
                        'posts_per_page' => 4,
						'post_status' => 'publish',
                        'post_type' => 'bienestar', // Set the post type to 'eventos'
                        'order' => 'DESC', // Ascending order

                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $resumen = get_post_meta(get_the_ID(), 'resumen', true);
                            $recursos = get_post_meta(get_the_ID(), 'recursos', true);
                            ?>
                <div class="col-md-6">
					<div class="row box-noti2 mb-4">
						<div class="col-xs-6 col-md-6 img-bienestar" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID); ?>)"></div>
						<div class="col-xs-6 col-md-6 box-otrasnoticias2 p-3 d-flex align-content-between flex-wrap">
                            <div class="">
                                <div class="titulo-item pb-2">
                                    <h5><?php echo esc_html(get_the_title()); ?></h5>
                                </div>                                
                                <div class="txt-resumen"><p class="pb-2"><?php echo $resumen; ?></p></div>
								<div class="title-recursos pt-2 pb-2"><p><strong>Recursos:</strong></p></div>
								<div class="box-recursos d-flex justify-content-between">
								<?php
								//Recorrer el array $recursos con un for
								//dentro del for debo colocar condicionales para si es Reunión ponga la imagen de reunión
								// y asi con cada recurso
								foreach ($recursos as $recurso ) {
									if( $recurso == 'Reunión' ){
										echo '<div class="box-single-recurso"><img class="img-links-1" src="'. get_template_directory_uri() .'/img/reunion1.png">';
										echo '<img class="img-links-2" src="'. get_template_directory_uri() .'/img/reunion2.png"></div>';
									}
									else if( $recurso == 'Video' ){
										echo '<div class="box-single-recurso"><img class="img-links-1" src="'. get_template_directory_uri() .'/img/video1.png">';
										echo '<img class="img-links-2" src="'. get_template_directory_uri() .'/img/video2.png"></div>';										
									}
									else if( $recurso == 'Documento' ){
										echo '<div class="box-single-recurso"><img class="img-links-1" src="'. get_template_directory_uri() .'/img/documento1.png">';
										echo '<img class="img-links-2" src="'. get_template_directory_uri() .'/img/documento2.png"></div>';										
									}
									else if( $recurso == 'Enlace' ){
										echo '<div class="box-single-recurso"><img class="img-links-1" src="'. get_template_directory_uri() .'/img/enlace1.png">';
										echo '<img class="img-links-2" src="'. get_template_directory_uri() .'/img/enlace2.png"></div>';		
									}																		
								}
								?>
								</div>
                        
                            </div>
                            <div class="ver-mas pt-4 pb-2">
                                <a class="btn-naranja" target="_blank" href="<?php echo esc_html(get_the_permalink()); ?>">Ver más</a>
                            </div>                            
						</div>
					</div>
                </div>

					<?php
				        
                    }
                } else {
                    // No events found
                }

                wp_reset_postdata();
			    ?>
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
	</div><!-- /.col -->

</div><!-- /.row -->
<?php
get_footer();
