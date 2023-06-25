<?php
/**
 * The Template for displaying all single posts.
 */

get_header();

if ( have_posts() ) :

	positronx_set_post_views(get_the_ID());

	while ( have_posts() ) :
		the_post();
		$title = get_the_title();
	?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'content body-workspace' ); ?>>
	<?php include('inc/subheader.php') ?>
	<nav class="breadcrumb" aria-label="breadcrumb">
    	<?php echo '<a href="'.get_site_url().'/eventos">Eventos/</a>'.$title; ?>
	</nav>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- /.entry-header -->

	<div class="entry-content row">
		<div class="col-md-6">
			<div class="bg-gris border-radius-10 p-4">
			<?php
				if ( has_post_thumbnail() ) :
					echo '<div class="post-thumbnail">' . get_the_post_thumbnail( get_the_ID(), 'full' ) . '</div>';
				endif;
			?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="bg-gris border-radius-10 p-4">
				<?php

				$fecha = get_post_meta(get_the_ID(), 'fecha', true);
				$lugar = get_post_meta(get_the_ID(), 'lugar', true);
				$hora = get_post_meta(get_the_ID(), 'hora', true);
				$modalidad = get_post_meta(get_the_ID(), 'modalidad', true);
				$inscribirme_url = get_post_meta(get_the_ID(), 'inscribirme_url', true);
				$formatted_fecha = convertFechaToSpanishFormat($fecha);
				?>
				<div class="">
				<div class="row box-noti2 mb-4">
				<div class="col-xs-6 col-md-6">
				<img class="img-fluid py-4" src="<?php echo get_template_directory_uri().'/img/eventos-post.png' ?>" alt="eventos">
				</div>
				<div class="col-xs-6 col-md-6 box-otrasnoticias2 p-3">
				<div class="box-recientes-2">
					<p><strong><?php echo esc_html(get_the_title()); ?></strong></p>                               
					<p><strong>Lugar:</strong> <?php echo esc_html($lugar); ?></p>
					<p><strong>Fecha:</strong> <?php echo esc_html($formatted_fecha); ?></p>
					<p><strong>Hora:</strong> <?php echo esc_html($hora); ?></p>
					<p><strong>Modalidad: </strong><?php echo esc_html($modalidad); ?></p>
				</div>
				<div class="ver-mas pt-4">
					<a class="btn-naranja" target="_blank" href="<?php echo esc_html($inscribirme_url); ?>">Inscribirme</a>
				</div>                            
				</div>
				</div>
				</div>
			</div>
			<div class="py-3">
				<?php the_content(); ?>
			</div>
		</div>
	</div><!-- /.entry-content -->

	<footer class="">
	</footer>
</article><!-- /#post-<?php the_ID(); ?> -->	



	<?php
	endwhile;
endif;

wp_reset_postdata();


get_footer();
