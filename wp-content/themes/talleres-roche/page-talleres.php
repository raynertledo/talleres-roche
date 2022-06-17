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
		</header>

		<?php if(get_field('pag_talleres_descripcion')): ?>
			<section class="d-none d-md-block">
				<div class="w-100 mx-auto talleres_descripcion"><?php echo get_field('pag_talleres_descripcion'); ?></div>
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
						<div class="taller-post-item text-center">
							<article class="">
								<a href="<?php echo "#".get_the_ID(); ?>">				
									<?php roche_post_thumbnail(); ?>
									
									<div class="taller-article-content">
										<?php the_title( '<h3 class="entry-title text-center">', '</h3>' ); ?>
										<div class="text-center"><?php echo get_field('taller_subtitulo'); ?></div>
										<?php $meses = ['january'=>'Enero', 'february'=>'Febrero', 'march'=>'Marzo','april'=>'Abril', 'may'=>'Mayo', 'june'=>'Junio', 'july'=>'Julio','august'=>'Agosto', 'september'=>'Septiembre', 'october'=>'Octubre','november'=>'Noviembre','december'=>'Diciembre']; $de = __('de','roche'); ?>
										<div class="text-center"><?php echo get_the_date('j ')." $de ".$meses[strtolower(get_the_date('F'))]; ?></div>
										<span class="text-center"><?php _e('Revive el taller', 'roche'); ?></span>
									</div>
								</a>															
							</article>							
						</div>
			<?php	endwhile; ?>
				</div>
				</section>
			<?php	while ( $result->have_posts() ) : $result->the_post(); ?>
					<section class="taller-single-post">
						<article id="<?php echo get_the_ID(); ?>" class="w-100 mx-auto ">
							<?php roche_post_thumbnail(); ?>
							<?php the_title( '<h3 class="entry-title text-center">', '</h3>' ); ?>
							<div class="text-center single-taller-description"><?php echo get_field('taller_subtitulo'); ?></div>
							<div class="single-taller-especialista d-flex">
								<div><?php 
									if(!empty(get_field('taller_imagen_del_especialista'))): ?>
										<img src="<?php echo esc_url(get_field('taller_imagen_del_especialista')['url']); ?>" alt="<?php echo esc_attr(get_field('taller_imagen_del_especialista')['alt']); ?>" />
							<?php	endif; ?>
								</div>
								<div class="d-flex nombre-especialidad"><span class="w-100 d-flex"><?php echo get_field('taller_nombre_del_especialista'); ?></span><span class="w-100 d-flex"><?php echo get_field('taller_especialidad'); ?></span></div>	
							</div>
							<div class="title-taller-description cerrado"><span class="d-block visible description-hidden cerrado">+</span><span class="invisible d-none description-showed">-</span><div class=""><?php _e('Descripción del taller', 'roche'); ?></div></div>
							<div class="content-taller-description d-none invisible"><?php echo get_field('taller_descripcion'); ?></div>
							<!--<div class="content-taller-description"><?php //echo get_field('taller_descripcion'); ?></div>-->
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
						</article>
					</section>
			<?php	endwhile; ?>	
	<?php	endif;	?>

	</main><!-- #main -->

<?php
get_footer();