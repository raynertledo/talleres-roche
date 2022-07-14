<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package roche
 */

?>

	<footer id="colophon" class="site-footer">
        <div class="container-md">
            <div class="seccion1">
                <div class="left-footer">
                    <div class="logo-escuela">
                        <?php if( get_field('logo_escuelas', 'option') ): ?>
                            <img src="<?php the_field('logo_escuelas', 'option'); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="logo-talleres mobile-hidden">
                        <p><?php the_field('talleres_texto', 'option'); ?></p>
                        <?php if( get_field('logo_talleres', 'option') ): ?>
                            <img src="<?php the_field('logo_talleres', 'option'); ?>" />
                        <?php endif; ?>
                    </div>
                </div>

                <div class="seccion1a">
                    <div class="logo-footer">
                        <?php the_custom_logo(); ?>
                    </div>
                    <div class="direccion">
                        <?php the_field('direccion', 'option'); ?>
                    </div>
                    <div class="logo-talleres mobile-visible">
                        <p><?php the_field('talleres_texto', 'option'); ?></p>
                        <?php if( get_field('logo_talleres', 'option') ): ?>
                            <img src="<?php the_field('logo_talleres', 'option'); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <hr class="separador">
            <div class="site-info">
                <div class="creditos">
                    <?php the_field('creditos', 'option'); ?>
                </div>
                <div class="politicas">
                    <?php if( have_rows('politicas', 'option') ): ?>
                        <ul class="slides">
                            <?php while( have_rows('politicas', 'option') ): the_row();
                                ?>
                                <li>
                                    <?php
                                    $link = get_sub_field('link', 'option');
                                    if( $link ):
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                        <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                    <?php endif; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div><!-- .site-info -->
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
