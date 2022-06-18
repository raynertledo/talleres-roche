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

				
					<section class="taller-single-post page-directo">
							<div class="w-100 presentation-container">
								<div class="d-block t-video w-100 video <?php echo 'video_'.get_the_ID(); ?>">									
									<?php //the_field('directo_video');
									//echo do_shortcode('[embed width=" 600" height="600"] https://www.youtube.com/watch?v=gzar7WfQrdc&t=12s [/embed]');
									?>
									<iframe width="560" height="315" src="<?php echo get_field('directo_video');  ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									
									<?php //echo wp_oembed_get( get_field( 'directo_video' ) ); ?>
								</div>								
							</div>
					</section>
					<section class="directo-comments">
						<div class="comments-for-directo">
							<?php
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>
						</div>
					</section>
	</main><!-- #main -->

<?php
get_footer();
