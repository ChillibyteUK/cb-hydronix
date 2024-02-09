<?php
/*
Template Name: Downloads
*/

get_header();
?>
<main id="main">
    <div class="container py-5">
        <h1 class="mb-4">
            <?=__('Hydronix Downloads', 'cb-hydronix')?>
        </h1>
        <?php
$dtype = $_REQUEST['dtype'] ?? null;
$dlang = $_REQUEST['dlang'] ?? null;
$dtext = $_REQUEST['dtext'] ?? null;
$dind = $_REQUEST['dind'] ?? null;
$dsub = $_REQUEST['dsub'] ?? null;

?>
        <style>
            .dinfo {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 0 1rem;
                max-width: 350px;
            }

            .dinfo :last-child {
                margin-bottom: 1rem;
            }

            .thumbnail {
                height: 70px;
                margin: auto;
                display: flex;
            }

            .mw-100px {
                max-width: 100px;
            }
        </style>
        <?php

echo '<div class="dinfo">';
if ($dtype) {
    echo '<div>Download Type:</div><div>' . get_term_by('slug', $dtype, 'attachment_category')->name . '</div>';
}
if ($dlang) {
    echo '<div>Download Language:</div><div>' . get_term_by('slug', $dlang, 'doclang')->name . '</div>';
}
if ($dind) {
    echo '<div>Industry:</div><div>' . get_term_by('slug', $dind, 'industries')->name . '</div>';
}
if ($dsub) {
    echo '<div>Product:</div><div>' . get_term_by('slug', $dsub, 'docprod')->name . '</div>';
}
echo '</div>';

if (!$dtype) {
    $dtypes = get_terms(array(
        'taxonomy' => 'attachment_category',
        'hide_empty' => true,
        'parent'        => 0,
    ));
    $dtype = wp_list_pluck($dtypes, 'slug');
}

?>
        <!--<pre><?=$dlang?></pre>-->
        <?php

$dsub_tax  = $dsub  == '' ? '' : array('taxonomy' => 'docprod',  'field' => 'slug', 'terms' => $dsub);
$dtype_tax = $dtype == '' ? '' : array('taxonomy' => 'attachment_category', 'field' => 'slug', 'terms' => $dtype, 'operator' => 'IN');
$dlang_tax = $dlang == '' ? '' : array('taxonomy' => 'doclang', 'field' => 'slug', 'terms' => $dlang);
$dind_tax = $dind == '' ? '' : array('taxonomy' => 'industries', 'field' => 'slug', 'terms' => $dind);

$q = new WP_Query(array(
    'post_type' => 'attachment',
    'post_status' => 'any',
    // 'post_parent' => null,
    'posts_per_page' => -1,
    's' => $dtext,
    'tax_query' => array(
        array('relation' => 'AND'),
        $dsub_tax,
        $dtype_tax,
        $dind_tax,
        $dlang_tax
    ),
));

$downloads = array();
$types = array();
$langs = array();
$inds = array();

?>
        <div class="table-responsive">
            <table id="dlContainer" class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th style="width:100px">
                            <?=__('Type', 'cb-hydronix')?>
                        </th>
                        <th><?=__('Description', 'cb-hydronix')?>
                        </th>
                        <th><?=__('File Name', 'cb-hydronix')?>
                        </th>
                        <th class="text-center" style="width:100px">&nbsp;</th>
                        <th class="text-center" style="width:100px">
                            <?=__('Download', 'cb-hydronix')?>
                        </th>
                        <th class="text-center" style="width:100px">
                            <?=__('Lang', 'cb-hydronix')?>
                        </th>
                    </tr>
                </thead>
                <tbody id="dlBody">
                    <?php

if ($q->have_posts()) {
    if ($DEBUG  ?? null) {
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
        if (! $lang) {
            $lang[0]->slug = 'zz';
            $lang[0]->name = 'All';
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

        $image = wp_get_attachment_image_url($ID, 'medium') ?: '/wp-content/themes/cb-hydronix/img/missing-image.png';
        $rtl = $lang[0]->slug == 'fa' ? 'rtl' : '';
        ?>

                    <tr class='dl' data-url='<?=$furl?>'>
                        <td class='text-center align-middle fs-7 mw-100px'>
                            <?=$type_icon?></td>
                        <td class='align-middle'><?=$fdesc?></td>
                        <td dir='<?=$rtl?>'
                            style='vertical-align:middle'>
                            <i class='fa fa-file-<?=$ftype?>-o'></i>
                            <strong><?=$title?></strong><br>
                            <small class='text--blue'><?=$docVer?> -
                                <?=$fsize?></small>
                        </td>
                        <td><img src='<?=$image?>' class='thumbnail'>
                        </td>
                        <td class='text-center align-middle'><a
                                href='<?=$furl?>' target='_blank'><i
                                    class='fa fa-download'></i></a></td>
                        <td class='text-center align-middle'>
                            <img src='/wp-content/plugins/sitepress-multilingual-cms/res/flags/<?=$lang[0]->slug?>.png'
                                alt='<?=$lang[0]->name?>'>
                            <br>
                            <div class='small'><?=$lang[0]->name?>
                            </div>
                        </td>
                    </tr>
                    <?php
    }
}
?>
                </tbody>
            </table>
        </div>
</main>
<?php

get_footer();
?>