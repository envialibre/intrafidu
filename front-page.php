<?php
/**
 * Template Name: Page (Default)
 * Description: Page template with Sidebar on the left side.
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

	<div class="col-md-10 order-md-2">
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'content body-workspace' ); ?>>
		<?php include('inc/subheader.php') ?>
			<?php
				the_content();
				?>

<div class="box-custom-home">
	<div class="row vuelta-al-sol">

		
	</div>
	<div class="row mix-eventos-noticias-encuesta">
		<div class="col-md-7">
			<div class="pb-3">
				<span class="subtitulos">Nuestro próximos eventos</span>
			</div>

			<div class="">
				<div class="row">

					<?php

						$args = array(
							'posts_per_page' => 4,
							'post_status' => 'publish',
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
					<div class="col-md-6 mb-4">
						<div class="box-noti2 flex-column h-100">
							<div class="img-eventos-home" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID); ?>)"></div>
							<div class="box-otrasnoticias2 p-3">
								<div class="box-recientes-2 text-center">
									<div class="titulo-masreciente pb-2">
									<p><strong><?php echo esc_html(get_the_title()); ?></strong></p>
									</div>                                
									<p><strong>Lugar:</strong> <?php echo esc_html($lugar); ?></p>
									<p><strong>Fecha:</strong> <?php echo esc_html($formatted_fecha); ?></p>
									<p><strong>Hora:</strong> <?php echo esc_html($hora); ?></p>
									<p><strong>Modalidad: </strong><?php echo esc_html($modalidad); ?></p>
								</div>
								<div class="ver-mas text-center py-3">
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
            </div>


			<div class="pb-3">
				<a class="btn-naranja" href="<?php echo esc_url( home_url() ); ?>/eventos">Ver todos los eventos</a>
			</div>


			<div class="pb-3">
					<span class="subtitulos">La encuesta del mes</span>
			</div>

			<div class="bg-gris border-radius-15">
				<?php
					$encuesta_home = get_field('encuesta_home', get_the_ID() );
					$formatted_fecha_home = convertFechaToSpanishFormat($encuesta_home['fecha_encuesta']);		
				?>
				<div class="row">
					<div class="col-md-6">
						<div class="box-recientes">
							<div class="fecha-masreciente">
								<span><?php echo esc_html($encuesta_home['fecha_encuesta']); ?></span>
							</div>
							<div class="titulo-masreciente">
								<h2><?php echo esc_html($encuesta_home['titulo']); ?></h2>
							</div>
							<div class="txt-masreciente">
								<p>
								<?php
								$extracto = $encuesta_home['mensaje'];
								if (strlen($extracto) > 40) {
									$extracto = substr($extracto, 0, 40) . '...';
								}
								echo $extracto;
								?>
								</p>
							</div>
							<div class="ver-mas py-3">
								<a class="btn-naranja" href="<?php echo esc_html($encuesta_home['link_del_boton']); ?>"><?php echo esc_html($encuesta_home['texto_del_boton']); ?></a>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="bg-gris border-radius-15">
							<img class="img-fluid px-5" src="<?php echo get_template_directory_uri().'/img/encuesta.png' ?>" alt="eventos">
						</div>
					</div>

				</div>
			</div>











		</div>
		<div class="col-md-5">
			<div class="d-flex flex-column h-100 bg-gris border-radius-15">
			<div id="notiCarousel" class="carousel slide noticias-home" data-bs-ride="carousel">
				<div class="pb-3 bg-white">
						<span class="subtitulos">Nuestras últimas noticias</span>
				</div>			
				<div class="carousel-inner bg-white">
					<?php
					$postslist = get_posts(array(
					'posts_per_page' => 3,
					'post_status' => 'publish',
					'order' => 'DESC',
					'orderby' => 'date',
					'offset' => 3
					));

					if ($postslist) {
					$counter = 0;
					foreach ($postslist as $post) :
						setup_postdata($post);
						$activeClass = ($counter === 0) ? 'active' : '';
						?>

						<div class="carousel-item <?php echo $activeClass; ?>">
						<div class="noti-principal-home">
							<div class="img-masreciente">
							<?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-fluid')); ?>
							</div>
							<div class="box-recientes-home p-4">
							<div class="fecha-masreciente">
								<span><?php echo esc_html(get_the_date()); ?></span>
							</div>
							<div class="titulo-masreciente">
								<h2><?php echo esc_html(get_the_title()); ?></h2>
							</div>
							<div class="txt-masreciente">
								<p>
								<?php
								$extracto = get_the_content();
								if (strlen($extracto) > 200) {
									$extracto = substr($extracto, 0, 200) . '...';
								}
								echo $extracto;
								?>
								</p>
							</div>
							<div class="ver-mas btn-abajo pb-3">
								<a class="btn-naranja" href="<?php echo esc_html(get_the_permalink()); ?>">Ver más</a>
							</div>
							</div>
						</div>
						</div>

					<?php
						$counter++;
					endforeach;
					wp_reset_postdata();
					}
					?>
				</div>

				<!--
				<button class="carousel-control-prev" type="button" data-bs-target="#notiCarousel" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#notiCarousel" data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
				-->

				<div class="carousel-indicators pb-4">
					<?php
					$postslist = get_posts(array(
					'posts_per_page' => 3,
					'post_status' => 'publish',
					'order' => 'DESC',
					'orderby' => 'date',
					'offset' => 3
					));

					if ($postslist) {
					$counter = 0;
					foreach ($postslist as $post) :
						setup_postdata($post);
						$activeClass = ($counter === 0) ? 'active' : '';
						?>

						<button type="button" data-bs-target="#notiCarousel" data-bs-slide-to="<?php echo $counter; ?>" class="carousel-dot <?php echo $activeClass; ?>"></button>

					<?php
						$counter++;
					endforeach;
					wp_reset_postdata();
					}
					?>
				</div>	
			</div>
		</div>	
		
	</div>

</div>


				<?php
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