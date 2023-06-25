<?php
/**
 * Template Name: Aplicativos Principal
 * Description: Página principal de aplicativos
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

			<div class="row">
				<?php include('inc/subheader.php') ?>
				<div class="col-md-12">
                    <h1><?php echo esc_html( get_the_title() ); ?></h1>
                </div>
				
				<div class="col-md-12 pt-5">
					<h2><?php echo the_content(); ?></h2>
				</div>                
                
                <div class="col-md-7">
					<div class="img-masreciente">
                        <?php echo get_the_post_thumbnail( get_the_ID(), 'full', array('class' => 'img-fluid')); ?>
                    </div>                                                        
				</div>
			</div>



			
			<div class="row">
				<div class="col-md-12 p-4">
				   <span class="subtitulos">Los más usados</span>
				</div>
			</div>

			<div class="box-aplicativos">
				<div class="divider-hr">
					<div class="row py-3">
					<?php
					$args = array(
						'posts_per_page' => -1,
						'post_status' => 'publish',
						'post_type' => 'aplicativos',
						'order' => 'ASC',
						'orderby' => 'title date'
					);
					$query = new WP_Query($args);
					if ($query->have_posts()) {
						$count = 0;
						while ($query->have_posts()) {
							$query->the_post();
							$descripcion = get_post_meta(get_the_ID(), 'descripcion', true);
							$url = get_post_meta(get_the_ID(), 'enlace', true);
							$destacado = get_post_meta(get_the_ID(), 'destacar_item', true);
							$title = get_the_title();
							$first_letter = substr($title, 0, 1);
							if ( $destacado === 'Si' && $count < 3 ) {
							?>

							<div class="col-md-4">
								<div class="box-otrasnoticias2 p-3 ">
									<div class="">
										<div class="letra-aplicativo d-flex justify-content-center align-items-center mb-3"><?php echo $first_letter; ?></div>
										<div class="titulo-item pb-2">
											<h5><?php echo esc_html(get_the_title()); ?></h5>
										</div>
										<div class="txt-resumen">
											<p class="pb-2"><?php echo $descripcion; ?></p>
										</div>
									</div>
									<div class="ver-mas pb-2">
										<a class="btn-naranja" target="_blank" href="<?php echo esc_html($url); ?>">Ir</a>
									</div>
								</div>
							</div>
							
							<?php
							$count++;

							}
						}
					} else {
						// No events found
					}

					wp_reset_postdata();
					?>
					</div>
				</div>
			</div>




			<div class="row">
				<div class="col-md-12 p-4">
				   <span class="subtitulos">Listado de aplicativos</span>
				</div>
				<div class="col-md-7 mr-auto my-4">
					<div class="buscar-aplicativo">
						<input id="filterInput" class="inp-filtrar-app" type="search" placeholder="Digita tu búsqueda">				
					</div>					
				</div>
			</div>				
			<div class="box-aplicativos">
				<div class="divider-hr">
					<div class="row py-3">
					<?php
					$args = array(
						'posts_per_page' => -1,
						'post_status' => 'publish',
						'post_type' => 'aplicativos',
						'order' => 'ASC',
						'orderby' => 'title'
					);
					$query = new WP_Query($args);
					if ($query->have_posts()) {
						$count = 0;
						while ($query->have_posts()) {
							$query->the_post();
							$descripcion = get_post_meta(get_the_ID(), 'descripcion', true);
							$url = get_post_meta(get_the_ID(), 'enlace', true);
							$destacado = get_post_meta(get_the_ID(), 'destacar_item', true);
							$title = get_the_title();
							$first_letter = substr($title, 0, 1);
							?>
							<?php if ($count % 3 === 0 && $count !== 0): ?>
								</div></div><div class="divider-hr"><div class="row py-3">
							<?php endif; ?>

							<div class="col-md-4">
								<div class="box-otrasnoticias2 p-3 ">
									<div class="">
										<div class="letra-aplicativo d-flex justify-content-center align-items-center mb-3"><?php echo $first_letter; ?></div>
										<div class="titulo-item pb-2">
											<h5><?php echo esc_html(get_the_title()); ?></h5>
										</div>
										<div class="txt-resumen">
											<p class="pb-2"><?php echo $descripcion; ?></p>
										</div>
									</div>
									<div class="ver-mas pb-2">
										<a class="btn-naranja" target="_blank" href="<?php echo esc_html($url); ?>">Ir</a>
									</div>
								</div>
							</div>
							
							<?php
							$count++;
						}
					} else {
						// No events found
					}

					wp_reset_postdata();
					?>
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
	</div><!-- /.col -->

</div><!-- /.row -->
<?php
get_footer();
?>
<script>
        jQuery(document).ready(function () {
            jQuery('#reset').click(function () {
                jQuery(".box-aplicativos .col-md-4").removeClass("hide-important");
            });

            jQuery("#filterInput").on("keyup", function () {
                var value = jQuery(this).val().toLowerCase();
                jQuery(".box-aplicativos .col-md-4").each(function () {
                    var text = jQuery(this).find("h5").text().toLowerCase();

                    if (text.indexOf(value) > -1) {
                        jQuery(this).removeClass("hide-important");
                    } else {
                        jQuery(this).addClass("hide-important");
                    }
                });
            });
        });

</script>
