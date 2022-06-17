<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package roche
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<section class="hero" style="background:radial-gradient(at top left, rgb(101 131 158) 18%, rgb(188 188 188 / 28%) 97%), url(<?php the_field('hero_fondo'); ?>);">
            <div class="container">
                <div class="hero-left">
                    <h2><?php the_field('hero_titulo'); ?></h2>
                    <h5><?php the_field('hero_subtitulo'); ?></h5>
                    <?php
                    $link = get_field('hero_boton');
                    if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><span><?php echo esc_html( $link_title ); ?></span><span class="elementor-button-icon elementor-align-icon-right"><i aria-hidden="true" class="fas fa-angle-right"></i></span></a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <section class="seccion-experiencia">
            <div class="container">
                <div class="seccion-experiencia1">
                    <div class="seccion-experiencia1a">
                        <?php if( get_field('experiencia_imagen') ): ?>
                            <img src="<?php the_field('experiencia_imagen'); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="seccion-experiencia1b">
                        <h2><?php the_field('experiencia_titulo'); ?></h2>
                        <p><?php the_field('experiencia_descripcion'); ?></p>
                        <?php
                        $link = get_field('experiencia_boton');
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><span><?php echo esc_html( $link_title ); ?></span><span class="elementor-button-icon elementor-align-icon-right"><i aria-hidden="true" class="fas fa-angle-right"></i></span></a>
                        <?php endif; ?>
                    </div>
                </div>
                <hr class="separador">
                <div class="seccion-experiencia2">
                    <?php if( have_rows('experiencias') ): ?>
                        <ul class="slides">
                            <?php while( have_rows('experiencias') ): the_row();
                                ?>
                                <li>
                                    <?php if( get_sub_field('experiencias_imagen') ): ?>
                                        <img src="<?php the_sub_field('experiencias_imagen'); ?>" />
                                    <?php endif; ?>
                                    <h5><?php the_sub_field('experiencias_titulo'); ?></h5>
                                    <p><?php the_sub_field('experiencias_subtitulos'); ?></p>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <section class="imagen-fondo" style="background:radial-gradient(at top left, rgb(221 221 221) 10%, rgb(17 17 17 / 50%) 50%), url(<?php the_field('imagen'); ?>);">
        </section>
        <section class="talleres-realizados">
            <div class="container">
                <h2><?php the_field('talleres_realizados'); ?></h2>
            </div>
        </section>
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
        <?php	endif;	wp_reset_query(); ?>
        <section class="roche" style="background-image: linear-gradient(rgba(0,0,0,0.30),rgba(0,0,0,0.30)), url(<?php the_field('imagen_roche'); ?>);">
            <div class="container">
                <h2><?php the_field('roche_titulo'); ?></h2>
                <p><?php the_field('roche_descripcion'); ?></p>
            </div>
        </section>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
