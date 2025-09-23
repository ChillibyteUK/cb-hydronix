<?php
/**
 * Custom post type and Yoast meta box removal for Cement Calc Results.
 *
 * @package cb-hydronix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register Custom Post Type for Cement Calc Results.
 *
 * @return void
 */
function register_cement_results_cpt() {
    register_post_type(
		'cement_results',
		array(
			'labels'      => array(
				'name'          => 'Cement Calc Results',
				'singular_name' => 'Cement Calc Result',
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array(
				'slug'       => 'cement-results',
				'with_front' => false,
			),
			'supports'    => array( 'title' ),
		)
	);
}
add_action( 'init', 'register_cement_results_cpt' );

/**
 * Remove Yoast SEO meta box for Cement Calc Results post type.
 *
 * @return void
 */
function remove_yoast_meta_box_for_cement_results() {
    // Check if the current post type is 'cement_results'.
    if ( 'cement_results' === get_post_type() ) {
        // Remove the Yoast SEO meta box.
        remove_meta_box( 'wpseo_meta', 'cement_results', 'normal' );
    }
}
add_action( 'add_meta_boxes', 'remove_yoast_meta_box_for_cement_results', 99 );

/**
 * AJAX handler to send cement calc results email.
 *
 * @return void
 */
function handle_send_cement_results_email() {
    // Verify nonce for security.
    $nonce = sanitize_text_field( wp_unslash( $_POST['nonce'] ?? '' ) );
    if ( ! wp_verify_nonce( $nonce, 'cement_calc_nonce' ) ) {
        wp_die( 'Security check failed' );
    }

    // Sanitize and validate input data.
    $name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
    $company = sanitize_text_field( wp_unslash( $_POST['company'] ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $post_id = absint( $_POST['post_id'] ?? 0 );

    // Validate required fields.
    if ( empty( $name ) || empty( $company ) || empty( $email ) || empty( $post_id ) ) {
        wp_send_json_error( array( 'message' => 'All fields are required.' ) );
    }

    // Validate email format.
    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Please provide a valid email address.' ) );
    }

    // Check if the post exists and is of the correct type.
    $post = get_post( $post_id );
    if ( ! $post || 'cement_results' !== $post->post_type ) {
        wp_send_json_error( array( 'message' => 'Invalid results ID.' ) );
    }

    // Generate the results URL.
    $results_url = get_permalink( $post_id );

    // Prepare email content.
    $subject = 'Your Cement Calculator Results - Hydronix';
    
    $message = "
    <html>
    <head>
        <title>Your Cement Calculator Results</title>
    </head>
    <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
        <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
            <h2 style='color: #2c5282;'>Hello {$name},</h2>
            
            <p>Thank you for using the Hydronix Cement Calculator. Your personalized results are now ready!</p>
            
            <div style='background: #f7fafc; padding: 20px; border-radius: 8px; margin: 20px 0;'>
                <h3 style='margin-top: 0; color: #2c5282;'>Your Results Summary</h3>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Company:</strong> {$company}</p>
                <p><strong>Generated:</strong> " . gmdate( 'F j, Y g:i A' ) . "</p>
            </div>
            
            <div style='text-align: center; margin: 30px 0;'>
                <a href='{$results_url}' 
                   style='background: #3182ce; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block; font-weight: bold;'>
                   View Your Complete Results
                </a>
            </div>
            
            <p>This link will take you to your personalized cement calculator report, including:</p>
            <ul>
                <li>Your concrete mix design recipe</li>
                <li>Production data analysis</li>
                <li>Material moisture calculations</li>
                <li>Return on investment report</li>
            </ul>
            
            <p>If you have any questions about your results or would like to discuss how Hydronix moisture measurement solutions can benefit your operations, please don't hesitate to contact us.</p>
            
            <hr style='border: none; border-top: 1px solid #e2e8f0; margin: 30px 0;'>
            
            <p style='font-size: 14px; color: #718096;'>
                Best regards,<br>
                The Hydronix Team<br>
                <a href='https://hydronix.com' style='color: #3182ce;'>hydronix.com</a>
            </p>
        </div>
    </body>
    </html>
    ";

    // Set email headers for HTML.
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Hydronix <noreply@hydronix.com>',
    );

    // Send the email.
    $email_sent = wp_mail( $email, $subject, $message, $headers );

    if ( $email_sent ) {
        wp_send_json_success(
            array(
                'message'     => 'Results email sent successfully!',
                'results_url' => $results_url,
            )
        );
    } else {
        wp_send_json_error( array( 'message' => 'Failed to send email. Please try again.' ) );
    }
}

// Register AJAX handlers for both logged in and non-logged in users.
add_action( 'wp_ajax_send_cement_results_email', 'handle_send_cement_results_email' );
add_action( 'wp_ajax_nopriv_send_cement_results_email', 'handle_send_cement_results_email' );

