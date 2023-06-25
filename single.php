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
    	<?php echo '<a href="'.get_site_url().'/noticias">Noticias/</a>'.$title; ?>
	</nav>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- /.entry-header -->

	<div class="entry-content row">
		<div class="col-md-8">
			<div class="bg-gris border-radius-10 p-4">
		<?php
			if ( 'post' === get_post_type() ) :
		?>
			<div class="">
				<div class="fecha-interna">
				<?php echo 'Fecha '; the_date(); ?>
				</div>
			</div><!-- /.entry-meta -->
		<?php
			endif;
		?>
		<?php
			if ( has_post_thumbnail() ) :
				echo '<div class="post-thumbnail">' . get_the_post_thumbnail( get_the_ID(), 'full' ) . '</div>';
			endif;

			the_content();
		?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="bg-gris border-radius-10 p-4">
			<div>
				<img class="img-fluid px-5" src="<?php echo get_template_directory_uri().'/img/articles.png' ?>" alt="articulos">
			</div>			
			<div class="titu-otros-articulos py-2">
				<span>OTROS ARTÍCULOS</span>
			</div>
			<?php
			$args = array(
				'posts_per_page' => 3, // Number of articles to retrieve
				'post_status' => 'publish', // Retrieve only published articles
				'orderby' => 'date', // Order by date
				'order' => 'DESC' // Sort in descending order (newest first)
			);

			$recent_posts = get_posts($args);
			?>
			<ul class="box-otros-articulos">
			<?php
			foreach ($recent_posts as $post) {
				// Access post data
				setup_postdata($post);
				?>
				<li class="list-articles">
				<?php
				the_title();
				?>
				</li>
				<?php
			}
			?>
			</ul>
			<?php
			wp_reset_postdata(); // Reset post data after the loop

			?>
			

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
