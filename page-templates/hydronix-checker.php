<?php
/*
Plugin Name: Company Match Checker
Description: Loops through custom table and matches CompanyName to CPT "company" post titles.
Version: 1.0
Author: Chillibyte
*/

add_action('admin_menu', function() {
    add_menu_page(
        'Company Match Checker',
        'Company Match Checker',
        'manage_options',
        'company-match-checker',
        'cmc_render_admin_page'
    );
});

function cmc_render_admin_page() {
    global $wpdb;
    $table_name = 'final_data_us_canada_customers';

    echo '<div class="wrap"><h1>Company Match Checker</h1>';

    $results = $wpdb->get_results("SELECT CompanyName FROM $table_name", ARRAY_A);

    if ($results) {
        echo '<table class="widefat fixed" cellspacing="0">
            <thead><tr><th>Company Name</th><th>Status</th></tr></thead><tbody>';

        foreach ($results as $row) {
            $company_name = $row['CompanyName'];
            $post_id = $wpdb->get_var($wpdb->prepare(
                "SELECT ID FROM {$wpdb->prefix}posts WHERE post_title = %s AND post_type = 'company' AND post_status = 'publish' LIMIT 1",
                $company_name
            ));

            if ($post_id) {
                echo "<tr><td>{$company_name}</td><td style='color:green;'>✅ Found (Post ID: {$post_id})</td></tr>";
            } else {
                echo "<tr><td>{$company_name}</td><td style='color:red;'>❌ Not Found</td></tr>";
            }
        }

        echo '</tbody></table>';
    } else {
        echo '<p>No data found in custom table.</p>';
    }

    echo '</div>';
}
