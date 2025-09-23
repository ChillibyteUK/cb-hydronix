<?php
/**
 * Handles cement results form submission, creates a custom post, and redirects.
 *
 * @package cb-hydronix
 */

defined( 'ABSPATH' ) || exit;

require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

// Check if the request method is POST and the 'data' field is set.
if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['data'] ) ) {
    $data = json_decode( stripslashes( $_POST['data'] ), true );

    // Generate a random string for the slug.
    $post_slug = random_str( 32 );

    // Extract company and email from the POST data.
    $company = '';
    $email   = '';

    foreach ( $data as $entry ) {
        if ( 'company' === $entry['id'] ) {
            $company = $entry['value'];
        }
        if ( 'email' === $entry['id'] ) {
            $email = $entry['value'];
        }
    }

    // Construct the post title.
    $post_title = trim( $company . ' | ' . $email );

    if ( ! empty( $data ) ) {
        // Create a new post with the slug.
        $post_id = wp_insert_post(
			array(
				'post_title'  => $post_title,
				'post_name'   => $post_slug, // Set the slug.
				'post_type'   => 'cement_results',
				'post_status' => 'publish',
			)
		);

        // Save data as custom fields.
        foreach ( $data as $entry ) {
            if ( ! empty( $entry['id'] ) && isset( $entry['value'] ) ) {
                update_post_meta( $post_id, $entry['id'], $entry['value'] );
            }
        }

        // Redirect to the newly created post.
        wp_safe_redirect( home_url( '/cement-results/' . $post_slug ) );
        exit;
    }
}

// If something goes wrong, redirect to an error page.
wp_safe_redirect( home_url( '/error' ) );
exit;
