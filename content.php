<?php
/**
 * @package brosco
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('masonry-entry'); ?>>
   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
   </a>
	<div class="entry-content">
			<header class="entry-header">

		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
		<?php if ( has_post_thumbnail() ) : ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	<?php the_post_thumbnail('category-thumb'); ?>
	</a>
<?php endif; ?>
		<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'brosco' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'brosco' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
