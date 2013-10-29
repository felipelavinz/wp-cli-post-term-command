<?php
/**
 * Manage post term associations
 *
 * @author Felipe Lavín Z. <felipe@yukei.net>
 */
class Post_Term extends \WP_CLI_Command{

	/**
	 * Add a term to a post
	 *
	 * @synopsis <id> <taxonomy> [--slug=<slug>] [--term-id=<term-id>] [--replace]
	 */
	public function add( $args, $assoc_args ){
		if ( empty($assoc_args['slug']) && empty($assoc_args['term-id']) ) {
			WP_CLI::error("You must specify the term slug or the term_id");
		}

		if ( ! empty($assoc_args['term-id']) ) {
			$term = \absint( $assoc_args['term-id'] );
		} else {
			$term = $assoc_args['slug'];
		}

		list( $post_id, $taxonomy ) = $args;

		if ( !isset($post_id) ){
			WP_CLI::error("You must specify the post ID");
		}
		if ( !isset($taxonomy) ){
			WP_CLI::error("You must specify the term taxonomy");
		}

		// if replace is set, then append is false
		$append = !! empty( $assoc_args['replace'] );

		$set_term = \wp_set_object_terms( $post_id, $term, $taxonomy, $append );

		if ( \is_wp_error($success) ) {
			WP_CLI::warning( $success->get_error_mesage() );
		} else {
			WP_CLI::success("Term $term successfully added to post ID $post_id");
		}

	}

	public function delete( $args, $assoc_args ){

	}

	public function get( $args, $assoc_args ){

	}

	public function update( $args, $assoc_args ){

	}

}

WP_CLI::add_command( 'post-term', 'Post_Term' );