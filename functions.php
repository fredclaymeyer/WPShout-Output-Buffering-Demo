<?php

// Writing lots of raw HTML into a function that returns a value rather than echoing it
add_filter( 'the_content', 'wpshout_add_single_post_footer' );
function wpshout_add_single_post_footer( $content ) {
	// Only on single Posts
	if( ! is_singular( 'post' ) ) {
		return $content;
	}

	// Start output buffering so we can "write" to the page
	ob_start(); ?>

	<hr />
	<div class="single-footer">
		<h3>Footer section</h2>
		<p>I can do all kinds of HTML here</p>
		<table>
			<tr>
				<td>How about a table?</td>
				<td>That seems</td>
				<td>Easy enough</td>
			</tr>
		</table>
	</div>

	<?php
	$footer = ob_get_clean();
	return $content . $footer;
}

add_shortcode( 'wpshout_quickview_post', 'wpshout_quickview_post' );
function wpshout_quickview_post( $atts ) {
	// If we didn't choose a post ID, return
	if( ! $atts || ! $atts['post_id'] ) {
		return 'No post ID specified.';
	}

	// Fetch current post object and set the global $post to point to it
	$this_post = get_post( $atts['post_id'] );
	global $post;
	$post = $this_post;
	setup_postdata( $post );

	ob_start();
		get_template_part( 'custom-templates/post-quickview' );
	$output = ob_get_clean();

	// Return $post to its original state
	wp_reset_postdata();

	return $output;
}