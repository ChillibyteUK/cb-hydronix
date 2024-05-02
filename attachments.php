<?php
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
$dind = $_REQUEST['dind'];
$dsub = $_REQUEST['dsub'];
$curr_lang = $_REQUEST['curr'];

if ($DEBUG == true) {
    cbdump($dlang);
    cbdump($curr_lang);
}

// If there's a specific document sub-category (dsub) set, use it for querying docprod taxonomy
$dsub_tax  = $dsub == '' ? array() : array('taxonomy' => 'docprod',  'field' => 'slug', 'terms' => $dsub);

// Set up taxonomy queries
$dtype_tax = empty($dtype) ? array() : array('taxonomy' => 'attachment_category', 'field' => 'slug', 'terms' => $dtype, 'operator' => 'IN');
// $dlang_tax = empty($dlang) ? array() : array('taxonomy' => 'doclang', 'field' => 'slug', 'terms' => $dlang);
$dlang_tax = ($dtype == 'software-firmware') ? array() : (empty($dlang) ? array() : array('taxonomy' => 'doclang', 'field' => 'slug', 'terms' => $dlang));
$dind_tax = empty($dind) ? array() : array('taxonomy' => 'industries', 'field' => 'slug', 'terms' => $dind);

// Exclusion criteria, if any
$exclude = array('taxonomy' => 'docprod', 'field' => 'slug', 'terms' => 'legacy', 'operator' => 'NOT IN');

// Constructing the query
$tax_query = array_filter(array(
    'relation' => 'AND',
    $dsub_tax,
    $dtype_tax,
    $dind_tax,
    $dlang_tax,
    $exclude
));

// Include 'docprod' taxonomy if dtext has a value
if (!empty($dtext)) {
    $tax_query[] = array('relation' => 'OR',
                         array('taxonomy' => 'docprod', 'field' => 'name', 'terms' => $dtext, 'operator' => 'LIKE'),
                         array('s' => $dtext));
}

$q = new WP_Query(array(
    'post_type' => 'attachment',
    'post_status' => 'any',
    'posts_per_page' => -1,
    'tax_query' => $tax_query
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
    echo '<h1>lang</h1>';
    cbdump($dlang_tax);
    // echo '<h1>text</h1>';
    // cbdump($dtext);
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
        if ($DEBUG == true) {
            echo 'LANG: ';
            if (count($lang) > 1) {
                echo $curr_lang;
            }
            cbdump($lang);
        }
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


        if ($ftype == 'image/jpeg') {
            $desc = $title;
            $title = $fdesc;
            $fdesc = $desc;
            $furl = 'https://www.chillibyte.co.uk/';
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
