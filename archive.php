<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package brosco
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="page-header">
				<!--<h1 class="page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'brosco' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'brosco' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'brosco' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'brosco' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'brosco' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'brosco' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'brosco' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'brosco' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'brosco' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'brosco' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'brosco' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'brosco' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'brosco' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'brosco' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'brosco' );

						else :
							_e( 'Archives', 'brosco' );

						endif;
					?>
				</h1> -->
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header --> 
					<?php if ( have_posts() ) : ?>
					<div id="masonry-loop">
					    <?php /* The loop */ ?>
					    <?php while ( have_posts() ) : the_post(); ?>
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>
					    <?php endwhile; ?>
					</div><!--/#masonry-loop-->

					<?php else : ?>
					    <?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
		</main><!-- #main -->
	</section><!-- #primary -->
	<?php get_footer(); ?>

	<script>
    //set the container that Masonry will be inside of in a var
    var container = document.querySelector('#masonry-loop');
    //create empty var msnry
    var msnry;
    // initialize Masonry after all images have loaded
    imagesLoaded( container, function() {
        msnry = new Masonry( container, {
            itemSelector: '.masonry-entry'
        });
    });
</script>


