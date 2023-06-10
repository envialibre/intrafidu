<?php
/**
 * Template Name: Eventos
 * Description: Página principal de eventos
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
			<?php
				the_content();
			?>

			<div class="row">
				<div class="col-md-12">
                    <h1><?php echo esc_html( get_the_title() ); ?></h1>
                </div>
				
				<div class="col-md-5 pt-5">
					<h2>Programate<br>
                        y asiste a<br>
                        nuestros eventos</h2>
				</div>                
                
                <div class="col-md-7">
					<div class="my-4">
						<span class="subtitulos">Evento Más Próximo</span>
					</div>
                    <?php
                    $args = array(
                        'posts_per_page' => 1,
                        'post_type' => 'eventos', // Set the post type to 'eventos'
                        'orderby' => 'fecha', // Order by the 'fecha' meta value
                        'order' => 'ASC', // Ascending order
                        'meta_query'    => array(
                            'relation'      => 'AND',
                            array(
                                'key'       => 'fecha',
                                'value'     => $current_date,
                                'compare'   => '>=',
                            ),
                        ),
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $fecha = get_post_meta(get_the_ID(), 'fecha', true);
                            $lugar = get_post_meta(get_the_ID(), 'lugar', true);
                            $hora = get_post_meta(get_the_ID(), 'hora', true);
                            $modalidad = get_post_meta(get_the_ID(), 'modalidad', true);
                            $formatted_fecha = convertFechaToSpanishFormat($fecha);
                            ?>
                            <div class="noti-principal">
                                <div class="img-masreciente">
                                    <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-fluid')); ?>
                                </div>
                                <div class="box-recientes">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="titulo-masreciente">
                                                <h2><?php echo esc_html(get_the_title()); ?></h2>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <p class="pb-2"><strong>Lugar:</strong> <?php echo esc_html($lugar); ?></p>
                                            <p class="pb-2"><strong>Fecha:</strong> <?php echo esc_html($formatted_fecha); ?></p>
                                            <p class="pb-2"><strong>Hora:</strong> <?php echo esc_html($hora); ?></p>
                                            <p class="pb-2"><strong>Modalidad: </strong><?php echo esc_html($modalidad); ?></p>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="txt-masreciente">
                                                <p>
                                                <?php
                                                $extracto = get_the_content();
                                                if (strlen($extracto) > 400) {
                                                    $extracto = substr($extracto, 0, 400) . '...';
                                                }
                                                echo $extracto;
                                                ?>                                              
                                                </p>
                                            </div>  
                                            <div class="ver-mas">
                                                <a class="btn-naranja" href="<?php echo esc_html(get_the_permalink()); ?>">Ver más</a>
                                            </div>
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
			</div>

			<div class="row">
				<div class="col-md-12 p-4">
				   <span class="subtitulos">Otras Noticias</span>
				</div>
			</div>				

			<div class="row d-flex align-items-stretch">

				<?php

                    $args = array(
                        'posts_per_page' => 4,
                        'post_type' => 'eventos', // Set the post type to 'eventos'
                        'orderby' => 'fecha', // Order by the 'fecha' meta value
                        'order' => 'ASC', // Ascending order
                        'offset' => 1,
                        'meta_query'    => array(
                            'relation'      => 'AND',
                            array(
                                'key'       => 'fecha',
                                'value'     => $current_date,
                                'compare'   => '>=',
                            ),
                        ),
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $fecha = get_post_meta(get_the_ID(), 'fecha', true);
                            $lugar = get_post_meta(get_the_ID(), 'lugar', true);
                            $hora = get_post_meta(get_the_ID(), 'hora', true);
                            $modalidad = get_post_meta(get_the_ID(), 'modalidad', true);
                            $formatted_fecha = convertFechaToSpanishFormat($fecha);
                            ?>
                <div class="col-md-6">
					<div class="row box-noti2 mb-4">
						<div class="col-xs-6 col-md-6 img-otrasnoticias2" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID); ?>)"></div>
						<div class="col-xs-6 col-md-6 box-otrasnoticias2 p-3">
                            <div>
                                <div class="titulo-masreciente pb-2">
                                    <h2><?php echo esc_html(get_the_title()); ?></h2>
                                </div>                                
                                <p class="pb-2"><strong>Lugar:</strong> <?php echo esc_html($lugar); ?></p>
                                <p class="pb-2"><strong>Fecha:</strong> <?php echo esc_html($formatted_fecha); ?></p>
                                <p class="pb-2"><strong>Hora:</strong> <?php echo esc_html($hora); ?></p>
                                <p class="pb-2"><strong>Modalidad: </strong><?php echo esc_html($modalidad); ?></p>
                            </div>
                            <div class="ver-mas">
                                <a class="btn-naranja" href="<?php echo esc_html(get_the_permalink()); ?>">Ver más</a>
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
