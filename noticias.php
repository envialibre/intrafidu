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

	<div class="col-md-10 order-md-2">
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'content body-workspace' ); ?>>
			<?php
				the_content();
			?>

			<div class="row">
				<?php include('inc/subheader.php') ?>
				<div class="col-md-12"><h1><?php echo esc_html( get_the_title() ); ?></h1></div>
				<div class="col-md-7">
					<div class="my-4">
						<span class="subtitulos">Noticia Más Reciente</span>
					</div>
			<?php
			$postslist = get_posts( array(
				'posts_per_page' => 1,
				'post_status' => 'publish',
				'order'          => 'DESC',
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
						<div class="ver-mas">
							<a class="btn-naranja" href="<?php echo esc_html( get_the_permalink()); ?>">Ver más</a>
						</div>
				    </div>


					</div>
				<?php
				endforeach; 
				wp_reset_postdata();
			}
			?>
				
				</div>
				<div class="col-md-5 pt-5">
					<h2>La noticia más leida</h2>

					<div class="px-5">

					<?php
				$popularpostbyview = array(
					'meta_key'  => 'wp_post_views_count', // set custom meta key
					'post_status' => 'publish',
					'orderby'    => 'meta_value_num',
					'order'      => 'DESC',
					'posts_per_page' => 1
				);
				$prime_posts = new WP_Query( $popularpostbyview );
				if ( $prime_posts->have_posts() ) :?>
					<?php
						while ( $prime_posts->have_posts() ) : $prime_posts->the_post();
						?>
						<div class="fecha-masreciente"><span><?php echo esc_html( get_the_date() ); ?></span></div>
						<div class="titulo-masreciente"><h2><?php  echo esc_html( get_the_title() ); ?></h2></div>
						<div class="ver-mas">
						<a class="btn-naranja" href="<?php echo esc_html( get_the_permalink()); ?>">Ver más</a>
						</div>	

						<?php
						endwhile;
						wp_reset_postdata();
					?>
				<?php 
				endif;
				?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 p-4">
				   <span class="subtitulos">Otras Noticias</span>
				</div>
			</div>				

			<div class="row d-flex align-items-stretch">

				<div class="col-md-5">

				<?php
			$postslist = get_posts( array(
				'posts_per_page' => 2,
				'order'          => 'DESC',
				'post_status' => 'publish',
				'orderby'        => 'date',
				'offset'        => '1'
			) );

			if ( $postslist ) {
				foreach ( $postslist as $post ) :
					setup_postdata( $post );
					?>

					<div class="row box-noti2 mb-4">
						<div class="col-xs-6 col-md-6 img-otrasnoticias2" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID); ?>)"></div>
						<div class="col-xs-6 col-md-6 box-otrasnoticias2 p-3">
							<div class="fecha-masreciente"><span><?php echo esc_html( get_the_date() ); ?></span></div>
							<div class="titulo-masreciente"><h2><?php  echo esc_html( get_the_title() ); ?></h2></div>
							<div class="txt-otrasnoticias1"><p><?php echo esc_html( get_the_excerpt()); ?></p></div>
							<div class="ver-mas">
								<a class="btn-naranja" href="<?php echo esc_html( get_the_permalink()); ?>">Ver más</a>
							</div>							
						</div>
					</div>

					<?php
				endforeach; 
				wp_reset_postdata();
			}
			?>



				</div>

				<div class="col-md-7">
				<div id="notiCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
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
          <div class="noti-principal">
            <div class="img-masreciente">
              <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-fluid')); ?>
            </div>
            <div class="box-recientes">
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
                  if (strlen($extracto) > 600) {
                    $extracto = substr($extracto, 0, 600) . '...';
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

  <div class="carousel-indicators">
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
