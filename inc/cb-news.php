<?php

function exclude_category_events( $query ) {
	if ( $query->is_home ) {
		$query->set( 'cat', '-170' );
	}
	return $query;
}
 
add_filter( 'pre_get_posts', 'exclude_category_events' );

function past_events() {
	ob_start();

	$q = new WP_Query(array(
		'post_type' => 'events',
		'meta_query' => array(
			array(
				'key' => 'event_date',
				'value' => date('Ymd'),
				'type' => 'DATE',
				'compare' => '<'
			)
		),
		'order' => 'ASC',
		'orderby' => 'meta_value',
		'meta_key' => 'event_date',
		'meta_type' => 'DATETIME'
	));
	$curr_mon = '';
	if ($q->have_posts()) {
		while ($q->have_posts()) {
			$q->the_post();
			// get the date
			preg_match_all('~^(\w+) (\d+), (\d{4})~',date("F j, Y",strtotime(get_field('event_date',get_the_ID()))),$date);
			if ($curr_mon != $date[1][0]) {
				$curr_mon = $date[1][0];
				echo '<div class="col-12 mb-4"><div class="h2 border-bottom">' . $curr_mon . ' ' . $date[3][0] . '</div></div>';
			}
			?>
			<div class="event mb-4 pt-2 pb-4">
				<a href="<?=get_the_permalink()?>">
					<div class="row event__inner">
						<div class="col-md-3 col-lg-2">
							<div class="event__date">
								<?=date("jS",strtotime(get_field('event_date',get_the_ID())))?>
								<div class="event__month"><?=date("F",strtotime(get_field('event_date',get_the_ID())))?></div>
							</div>
						</div>
						<div class="col-md-9 col-lg-10">
							<div class="event__detail">
								<div class="event__title"><?=get_the_title()?></div>
								<div class="event__loca"><?=get_field('event_location')?></div>
								<?php
									if (get_field('event_end')) {
										echo '<div class="event__dates">' . date("F jS, Y",strtotime(get_field('event_date',get_the_ID()))) . ' - ' . date("F jS, Y",strtotime(get_field('event_end',get_the_ID()))) . '</div>';
									}
								?>
								<div class="event__intro"><?=get_field('event_intro')?></div>
								<div class="event__link">Find out more</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php
		}
	}

	wp_reset_postdata();
	return ob_get_clean();
}
add_shortcode('past_events','past_events');


function numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
 
    echo '</ul></div>' . "\n";
 
}


add_action('wp_head', 'fix_wpml_hreflang_on_pagination', 1);

function fix_wpml_hreflang_on_pagination() {
    if (!function_exists('icl_get_languages') || !is_archive()) {
        return;
    }

    global $wp_query;

    $current_page = max(1, get_query_var('paged'));
    $languages = icl_get_languages('skip_missing=0');

    if (empty($languages)) {
        return;
    }

    foreach ($languages as $lang) {
        // Get translated URL for current archive page
        $url = get_permalink(get_queried_object_id());

        // For archives, use wpml_permalink if available
        if (function_exists('wpml_permalink')) {
            $url = wpml_permalink($url, $lang['language_code']);
        }

        // Append pagination if needed
        if ($current_page > 1) {
            $url = trailingslashit($url) . 'page/' . $current_page . '/';
        }

        echo '<link rel="alternate" hreflang="' . esc_attr($lang['language_code']) . '" href="' . esc_url($url) . '" />' . "\n";
    }

    // Add x-default if needed
    $default_lang = apply_filters('wpml_default_language', null);
    if ($default_lang && isset($languages[$default_lang])) {
        $default_url = $languages[$default_lang]['url'];
        if ($current_page > 1) {
            $default_url = trailingslashit($default_url) . 'page/' . $current_page . '/';
        }

        echo '<link rel="alternate" hreflang="x-default" href="' . esc_url($default_url) . '" />' . "\n";
    }
}
