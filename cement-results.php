<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data'])) {
    $data = json_decode(stripslashes($_POST['data']), true);

    // Generate a random string for the slug
    $post_slug = random_str(32);

    // Extract company and email from the POST data
    $company = '';
    $email = '';

    foreach ($data as $entry) {
        if ($entry['id'] === 'company') {
            $company = $entry['value'];
        }
        if ($entry['id'] === 'email') {
            $email = $entry['value'];
        }
    }

    // Construct the post title
    $post_title = trim($company . ' | ' . $email);

    if (!empty($data)) {
        // Create a new post with the slug
        $post_id = wp_insert_post(array(
            'post_title'  => $post_title,
            'post_name'   => $post_slug, // Set the slug
            'post_type'   => 'cement_results',
            'post_status' => 'publish',
        ));

        // Save data as custom fields
        foreach ($data as $entry) {
            if (!empty($entry['id']) && isset($entry['value'])) {
                update_post_meta($post_id, $entry['id'], $entry['value']);
            }
        }

        // Redirect to the newly created post
        wp_redirect(home_url('/cement-results/' . $post_slug));
        exit;
    }
}

// If something goes wrong, redirect to an error page
wp_redirect(home_url('/error'));
exit;
?>
