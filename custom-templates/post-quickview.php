<div class="post-quickview">
	<h1 class="quickview-title"><?php the_title(); ?></h1>
	<div class="quickview-featured-image"><?php the_post_thumbnail( 'large' ); ?></div>
	<?php the_excerpt(); ?>
</div>