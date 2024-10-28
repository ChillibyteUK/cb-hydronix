<?php

/* v3 - Mighty Matt fixed the free text search to also search docprod */

define('WP_USE_THEMES', false); // Don't load theme support functionality
require_once("../../../wp-load.php");

$DEBUG = $_REQUEST['d'] == '1' ? true : false;

$dtype = $_REQUEST['dtype'];
if (!$dtype) {
    $dtypes = get_terms(array(
        'taxonomy' => 'attachment_category',
        'hide_empty' => true,
        'parent'        => 0,
    ));
    $dtype = wp_list_pluck($dtypes, 'slug');
}
$dlang = $_REQUEST['dlang'];
$dtext = $_REQUEST['dtext'];
$dsub = $_REQUEST['dsub'];
$curr_lang = $_REQUEST['curr'];
$dsub_model = $_REQUEST['dsub_model'];

if ($DEBUG == true) {
    cbdump($dlang);
    cbdump($curr_lang);
    cbdump($dtext);
    cbdump($dsub_model);
}

// If there's a specific document sub-category (dsub) set, use it for querying docprod taxonomy
if ( $dsub_model != "" ) {
    $dsub_tax  = $dsub == '' ? array() : array('taxonomy' => 'docprod',  'field' => 'slug', 'terms' => $dsub_model);
} else {
    $dsub_tax  = $dsub == '' ? array() : array('taxonomy' => 'docprod',  'field' => 'slug', 'terms' => $dsub);
}

// Set up taxonomy queries
$dtype_tax = empty($dtype) ? array() : array('taxonomy' => 'attachment_category', 'field' => 'slug', 'terms' => $dtype, 'operator' => 'IN');
// $dlang_tax = empty($dlang) ? array() : array('taxonomy' => 'doclang', 'field' => 'slug', 'terms' => $dlang);
$dlang_tax = ($dtype == 'software-firmware') ? array() : (empty($dlang) ? array() : array('taxonomy' => 'doclang', 'field' => 'slug', 'terms' => $dlang));

// Exclusion criteria, if any
// $exclude = array('taxonomy' => 'docprod', 'field' => 'slug', 'terms' => 'legacy', 'operator' => 'NOT IN');

// Include 'docprod' taxonomy if dtext has a value
$termIds = get_terms([
    'name__like' => $dtext,
    'fields' => 'ids'
]);
$dtext_query = empty($dtext) ? array() : array('taxonomy' => 'docprod', 'field' => 'id', 'terms' => $termIds );
// $dtext_query = empty($dtext) ? array() : array('taxonomy' => 'docprod', 'field' => 'name', 'terms' => $dtext );

// Constructing the query
$tax_query = array_filter(array(
    'relation' => 'AND',
    $dsub_tax,
    $dtype_tax,
    $dlang_tax,
    $dtext_query
));

$args = array(
    'post_type' => 'attachment',
    'post_status' => 'any',
    'posts_per_page' => -1,
    's' => $dtext,
    'tax_query' => $tax_query
);

$args_tags = array(
    'post_type' => 'attachment',
    'post_status' => 'any',
    'posts_per_page' => -1,
    'tax_query' => $tax_query
);

$q_search = get_posts( $args );

echo "<hr>";
print_r($args);
echo "<hr>";
print_r($q_search);
echo "<hr>";


$q_tax = get_posts( $args_tags );
$unique = array_unique( array_merge( $q_search, $q_tax), SORT_REGULAR);

$uniqueIds = array_map(function ($post) {
    return $post->ID;
}, $unique);

if (!$uniqueIds) {
    array_push($uniqueIds, "0");
}

$q = new WP_Query(array(
    'post_type' => 'attachment',
    'post_status' => 'any',
    'posts_per_page' => -1,
    'post__in' => $uniqueIds,
));

if ($DEBUG == true) {
    header('Content-Type: text/html; charset=utf-8');

    echo '<h1>QUERY</h1>';
    cbdump($q->query);
    // echo '<h1>REQUEST</h1>';
    // cbdump($_REQUEST);
    // echo '<h1>sub</h1>';
    // cbdump($dsub_tax);
    // echo '<h1>prod</h1>';
    // cbdump($dsub);
    // cbdump($dsub_tax);
    // echo '<h1>lang</h1>';
    // cbdump($dlang_tax);
    // echo '<h1>text</h1>';
    // cbdump($dtext);
    // echo '<h1>SQL</h1>';
    // echo $wpdb->last_query;

} else {
    header('Content-Type: application/json; charset=utf-8');
}

$downloads = array();
$types = array();
$langs = array();
$inds = array();

if ($q->have_posts()) {
    if ($DEBUG == true) {
        echo 'FOUND ' . $q->found_posts . ' posts';
    }
    while ($q->have_posts()) {
        $q->the_post();

        $ID = get_the_ID();

        $fdesc = wp_get_attachment_caption($ID);
        $furl = wp_get_attachment_url($ID, false);
        $title = get_the_title($ID);
        $lang = get_the_terms($ID, 'doclang');
        if ($lang[0]->slug == 'ptb') {
            $lang[0]->slug = 'br';
        }
        if (! $lang || count($lang) > 1) {
            $lang[0]->slug = $curr_lang;
            $lang[0]->name = 'Multiple';
        }
        // if ($DEBUG == true) {
        //     echo 'LANG: ';
        //     if (count($lang) > 1) {
        //         echo $curr_lang;
        //     }
        //     cbdump($lang);
        // }
        $type = get_the_terms($ID, 'attachment_category');

        $type_icon = 'fa-file';
        if     ($type[0]->slug == 'application-notes') {
            $type_icon = 'App Notes';
        } // { $type_icon = 'fa-file-text-o'; }
        elseif ($type[0]->slug == 'brochures') {
            $type_icon = 'Brochure';
        } // { $type_icon = 'fa-book'; }
        elseif ($type[0]->slug == 'software-firmware') {
            $type_icon = 'Software';
        } // { $type_icon = 'fa-file-code-o'; }
        elseif ($type[0]->slug == 'engineering-notes') {
            $type_icon = 'Eng Notes';
        } // { $type_icon = 'fa-flask'; }
        elseif ($type[0]->slug == 'user-guides') {
            $type_icon = 'Guide';
        } // { $type_icon = 'fa-graduation-cap'; }
        elseif ($type[0]->slug == 'articles') {
            $type_icon = 'Article';
        } // { $type_icon = 'fa-newspaper-o'; }
        elseif ($type[0]->slug == 'case-studies') {
            $type_icon = 'Case Study';
        } // { $type_icon = 'fa-briefcase'; }
        elseif ($type[0]->slug == 'presentations') {
            $type_icon = 'Presentation';
        } // { $type_icon = 'fa-film'; }

        $sub = 'NONE';
        $sub = get_the_terms(get_the_ID(), 'docprod');
        $product = wp_list_pluck($sub, 'name');
        $product = implode(', ', $product);
        // $pVer = get_field('product_version',get_the_ID());
        // if ($pVer) {
        //     $product = $product . '<br><small>(' . $pVer . ')</small>';
        // }

        $file = basename(get_attached_file($ID));
        $size = filesize(get_attached_file($ID));
        $ftype = get_post_mime_type($ID);
        $ftype = preg_replace('/application\//', '', $ftype);
        $fsize = formatBytes($size);

        $pVer = 'pver';
        preg_match('/(_[0-9])+/', $title, $matches);
        $docVer = $matches[0];
        $docVer = preg_replace('/^_/', 'v', $docVer);
        $docVer = preg_replace('/_/', '.', $docVer);

        // $product = 'product';


        if ($ftype == 'image/png') {
            $desc = $title;
            $title = '';
            $fdesc = $desc;
            $furl = wp_get_attachment_caption($ID);
            $pVer = '';
            $fsize = '';
        }


        $image = wp_get_attachment_image_url($ID, 'medium') ?: '/wp-content/themes/cb-hydronix/img/missing-image.png';
        

        // $ver = preg_match('');
        $downloads[$title] =  array(
            $fdesc,                                                     // [0]
            $title,                                                     // [1]
            $type_icon,                                                 // [2]
            $lang[0]->name,                                             // [3]
            $lang[0]->slug,                                             // [4]
            get_field('release_date', get_the_ID()),                     // [5]
            $pVer,                                                      // [6]
            $docVer,                                                    // [7]
            $product,                                                   // [8]
            $fsize,                                                     // [9]
            $ftype,                                                     // [10]
            $furl,                                                      // [11]
            $type[0]->name,                                             // [12]
            $image                                                      // [13]
        );

        // usort($downloads, function($a, $b) {
        //     return $a->
        // });

        $types[ $type[0]->slug ] = $type[0]->name;
        $langs[ $lang[0]->slug ] = $lang[0]->name;
    }

    usort($downloads, function ($a, $b) {
        return strcmp($a[12], $b[12]);
    });

    $results = array("types" => $types, "langs" => $langs, "inds" => $inds, "files" => $downloads);
    
    if ($DEBUG == true) {
        cbdump($downloads);
    } else {
        echo json_encode($results);
    }
} else {
    echo json_encode("nope");
}


die();