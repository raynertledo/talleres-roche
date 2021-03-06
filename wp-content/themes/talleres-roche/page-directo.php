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
        <header class="entry-header-talleres" style="background:radial-gradient(at top left, rgb(101 131 158) 18%, rgb(188 188 188 / 28%) 97%), url(<?php echo get_the_post_thumbnail_url(); ?>);">
            <div class="w-100 mx-auto section-subtitle">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                <?php if(get_field('pag_talleres_subtitulo')): ?>
                    <p class="hero-directo"><?php echo get_field('pag_talleres_subtitulo'); ?></p>
                <?php endif; ?>
            </div>
        </header>

				
					<section class="taller-single-post page-directo">
							<div class="w-100 presentation-container">
								<div class="d-block t-video w-100 video <?php echo 'video_'.get_the_ID(); ?>">

									<iframe width="560" height="315" src="<?php echo get_field('directo_video');  ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

								</div>								
							</div>
					</section>
				<?php	if ( comments_open() || get_comments_number() ) : ?>
					<section class="directo-comments">
						<div class="comments-for-directo">
							<?php
								
									comments_template();
								
							?>
						</div>
					</section>
				<?php endif; ?>
	</main><!-- #main -->

<?php
get_footer();
