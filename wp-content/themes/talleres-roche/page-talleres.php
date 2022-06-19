<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package roche
 */

get_header();
?>

	<main id="primary" class="site-main">
		<header class="entry-header-talleres" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">

			<div class="w-100 mx-auto section-subtitle">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php if(get_field('pag_talleres_subtitulo')): ?>
					   <p><?php echo get_field('pag_talleres_subtitulo'); ?></p>
				<?php endif; ?>
			</div>
			<div class="background-overlay"></div>	
		</header>

		<?php if(get_field('pag_talleres_descripcion')): ?>
			<section class="d-none d-md-block">
				<div class="w-100 mx-auto talleres_descripcion scroll-content1 fadeTop-effect"><?php echo get_field('pag_talleres_descripcion'); ?></div>
			</section>
		<?php endif; ?>


		<?php
			$args = array(
                'post_type' => 'post',
                'category_name' => 'taller',                
                'post_status' => 'publish',
                'posts_per_page' => -1
                );
			$result = new WP_Query($args);
			if ( $result->have_posts() ) : ?>
				<section class="d-none d-md-block"><div class="w-100 mx-auto d-flex talleres-posts">
			<?php	while ( $result->have_posts() ) : $result->the_post(); ?>
						<div class="taller-post-item text-center scroll-content1 fadeTop-effect">
							<article class="">
								<a href="<?php echo "#".get_the_ID(); ?>">				
									<?php roche_post_thumbnail(); ?>

									<div class="taller-article-content">
										<?php the_title( '<h3 class="entry-title text-center">', '</h3>' ); ?>
										<div class="text-center taller_subtitulo"><?php echo get_field('taller_subtitulo'); ?></div>
										<?php $de = __('de','roche'); $a_las = __('a las','roche'); $horas = __('h','roche');							
											if(get_field('fecha_del_taller')):
												$fecha_taller = new DateTime(get_field('fecha_del_taller'));
										?>
										<div class="text-center fecha-taller"><?php echo $fecha_taller->format('j')." ".$de." ".$fecha_taller->format('F')." ".$a_las." ".$fecha_taller->format('G:i').$horas; ?></div><?php endif; ?>
										<span class="text-center"><?php _e('Ver taller', 'roche'); ?></span>
									</div>
								</a>															
							</article>							
						</div>
			<?php	endwhile; ?>
				</div>
				</section>
			<?php	while ( $result->have_posts() ) : $result->the_post(); ?>
					<section class="taller-single-post scroll-content1 fadeTop-effect">
						<article id="<?php echo get_the_ID(); ?>" class="w-100 mx-auto">
							<?php roche_post_thumbnail(); ?>
							<?php the_title( '<h3 class="entry-title text-center">', '</h3>' ); ?>
							<div class="text-center fecha-taller"><?php echo $fecha_taller->format('j')." ".$de." ".$fecha_taller->format('F')." ".$a_las." ".$fecha_taller->format('G:i').$horas; ?></div>
							<div class="text-center single-taller-description"><?php echo get_field('taller_subtitulo'); ?></div>
							<?php if(have_rows('especialistas')): ?>
								<div class="d-flex w-100 especialistas-container">
								<?php while(have_rows('especialistas')): the_row(); ?>									
							<div class="single-taller-especialista d-flex">
								<div><?php 
									if(!empty(get_sub_field('taller_imagen_del_especialista'))): ?>
										<img src="<?php echo esc_url(get_sub_field('taller_imagen_del_especialista')['url']); ?>" alt="<?php echo esc_attr(get_sub_field('taller_imagen_del_especialista')['alt']); ?>" />
							<?php	endif; ?>
								</div>
								<div class="d-flex nombre-especialidad"><span class="w-100 d-flex"><?php echo get_sub_field('taller_nombre_del_especialista'); ?></span><span class="w-100 d-flex"><?php echo get_sub_field('taller_especialidad'); ?></span></div>	
							</div>
						<?php endwhile; ?>
						</div>
						<?php endif; ?>
							<div id="<?php echo 'title-taller-'.get_the_ID(); ?>" class="title-taller-description"><span class="d-none invisible description-hidden plus-sign"><i class="fas fa-plus"></i></span><span class="visible d-block description-showed minus-sign"><i class="fas fa-minus"></i></span><div class=""><?php _e('Descripción del taller', 'roche'); ?></div></div>	


							<div class="parent-container-taller-description"><div class="visible content-taller-description <?php echo 'content_taller_description_'.get_the_ID(); ?>"><?php echo get_field('taller_descripcion'); ?></div></div>						

							<?php if(get_field('mostrar_video-presentacion') && get_field('mostrar_video-presentacion') === true): ?>
							<div class="video-diapo d-flex w-100">
								<div id="<?php echo 'video_'.get_the_ID(); ?>" class="w-50 text-center taller-video-presentacion video active"><a class="text-center"><?php _e('Grabación del '.get_the_title(), 'roche'); ?></a></div>
								<div id="<?php echo 'presentacion_'.get_the_ID(); ?>" class="w-50 text-center taller-video-presentacion presentacion"><a class="text-center"><?php _e('Presentación de diapositivas', 'roche'); ?></a></div>
							</div>
							<div class="w-100 presentation-container">
								<div class="d-block t-video w-100 video <?php echo 'video_'.get_the_ID(); ?>">									
									<?php the_field('taller_video'); ?>
								</div>
								<div class="d-none t-presentation w-100 presentacion <?php echo 'presentacion_'.get_the_ID(); ?>"><iframe src="<?php echo get_field('taller_presentacion'); ?>"></iframe></div>
							</div>
						<?php endif; ?>
						</article>
					</section>
			<?php	endwhile; ?>	
	<?php	endif;	?>

	</main><!-- #main -->

<?php
get_footer();
