<?php
/*
Template Name: Contact Page
*/
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$ho_enquiries_email = apply_filters( 'wpml_permalink', get_field('ho_enquiries_email','options'), ICL_LANGUAGE_CODE );
$ho_support_email = apply_filters( 'wpml_permalink', get_field('ho_support_email','options'), ICL_LANGUAGE_CODE );
$ho_service_email = apply_filters( 'wpml_permalink', get_field('ho_service_email','options'), ICL_LANGUAGE_CODE );

$url_path = get_field('ho_enquiries_email','options');
$full_url = home_url( $url_path );
$page_id = url_to_postid( $full_url );

echo 'Page ID: ' . $page_id;
?>
<main id="main">
    <div class="container py-5">
        <h1 class="mb-4"><?=__('Contact Us','cb-hydronix')?></h1>
        <div class="row g-4">
            <div class="col-lg-6">
                <?=get_the_content()?>
                <div class="d-flex w-100 justify-content-between flex-wrap">
                    <a class="btn btn-primary btn--small mb-2 noline" href="<?=$ho_enquiries_email?>"><i class="fa fa-envelope"></i>&nbsp;<?=__('Enquiries','cb-hydronix')?></a>
                    <a class="btn btn-primary btn--small mb-2 noline" href="<?=$ho_support_email?>"><i class="fa fa-envelope"></i>&nbsp;<?=__('Support','cb-hydronix')?></a>
                    <a class="btn btn-primary btn--small mb-2 noline" href="<?=$ho_service_email?>"><i class="fa fa-envelope"></i>&nbsp;<?=__('Service','cb-hydronix')?></a>
                </div>
            </div>
            <div id="form" class="col-lg-6">
                <!--[if lte IE 8]>
                <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
                <![endif]-->
                <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
                <?php
                $e = get_field('contact_form','options');
                ?>
                <script>
                hbspt.forms.create({
                                region: "<?=$e['region']?>",
                                portalId: "<?=$e['portal_id']?>",
                                formId: "<?=$e['form_id']?>"
                });
                </script>
            </div>
        </div>
    </div>
    <a id="addresses" class="anchor"></a>
    <section class="addresses bg--blue-200 py-5">
        <div class="container-xl">
            <h2 class="h2 text--white mb-4"><?=__('Addresses','cb-hydronix')?></h2>
            <div class="row g-4">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h3><?=__('Hydronix Head Office','cb-hydronix')?></h3>
                                <div class="mb-3"><em><?=get_field('ho_areas_served','options')?></em></div>
                                <div class="mb-3"><strong><?=get_field('ho_intro','options')?></strong></div>
                                <ul class="fa-ul">
                                    <li class="mb-4"><span class="fa-li"><i class="fa fa-map-marker"></i></span> <?=get_field('ho_address','options')?></li>
                                    <li class="mb-4"><span class="fa-li"><i class="fa fa-arrow-circle-o-up"></i></span> <a class="noline" href="<?=get_field('directions_link','options')?>" target="_blank"><?=__('Get directions','cb-hydronix')?></a></li>
                                    <li><span class="fa-li"><i class="fa fa-phone"></i></span> <a class="noline" href="tel:<?=parse_phone(get_field('ho_phone','options'))?>"><?=get_field('ho_phone','options')?></a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <iframe src="<?=get_field('ho_map_url','options')?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-4 h-100">
                        <h4><?=__('Hydronix Europe','cb-hydronix')?></h4>
                        <div class="mb-2"><em><?=get_field('eu_areas_served','options')?></em></div>
                        <div class="mb-3"><em><?=get_field('eu_locality','options')?></em></div>
                        <ul class="fa-ul">
                            <li class="mb-2"><span class="fa-li"><i class="fa fa-phone"></i></span> <a class="noline" href="tel:<?=parse_phone(get_field('eu_phone','options'))?>"><?=get_field('eu_phone','options')?></a></li>
                            <?php
                            if (get_field('eu_fax','options') ?? null) {
                                ?>
                            <li class="mb-2"><span class="fa-li"><i class="fa fa-fax"></i></span> <?=get_field('eu_fax','options')?></li>
                                <?php
                            }
                            ?>
                            <li class="mb-2"><span class="fa-li"><i class="fa fa-envelope"></i></span> <a class="noline" href="<?=get_field('eu_email','options')?>"><?=__('Hydronix Europe','cb-hydronix')?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-4 h-100">
                        <h4><?=__('Hydronix France','cb-hydronix')?></h4>
                        <div class="mb-2"><em><?=get_field('fr_areas_served','options')?></em></div>
                        <div class="mb-3"><em><?=get_field('fr_locality','options')?></em></div>
                        <ul class="fa-ul">
                            <li class="mb-2"><span class="fa-li"><i class="fa fa-phone"></i></span> <a class="noline" href="tel:<?=parse_phone(get_field('fr_phone','options'))?>"><?=get_field('fr_phone','options')?></a></li>
                            <li class="mb-2"><span class="fa-li"><i class="fa fa-envelope"></i></span> <a class="noline" href="<?=get_field('fr_email','options')?>"><?=__('Hydronix France','cb-hydronix')?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-4 h-100">
                        <h4><?=__('Hydronix China','cb-hydronix')?></h4>
                        <div class="mb-2"><em><?=get_field('cn_areas_served','options')?></em></div>
                        <div class="mb-3"><em><?=get_field('cn_locality','options')?></em></div>
                        <ul class="fa-ul">
                            <li class="mb-2"><span class="fa-li"><i class="fa fa-phone"></i></span> <a class="noline" href="tel:<?=parse_phone(get_field('cn_phone','options'))?>"><?=get_field('cn_phone','options')?></a></li>
                            <li class="mb-2"><span class="fa-li"><i class="fa fa-envelope"></i></span> <a class="noline" href="<?=get_field('cn_email','options')?>"><?=__('Hydronix China','cb-hydronix')?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-4 h-100">
                        <h4><?=__('Hydronix America','cb-hydronix')?></h3>
                        <div class="mb-2"><em><?=get_field('us_areas_served','options')?></em></div>
                        <div class="mb-3"><em><?=get_field('us_locality','options')?></em></div>
                            <ul class="fa-ul">
                                <li class="mb-4"><span class="fa-li"><i class="fa fa-map-marker"></i></span> <?=get_field('us_address','options')?></li>
                                <li class="mb-2"><span class="fa-li"><i class="fa fa-phone"></i></span> 
                                    <a class="noline" href="tel:<?=parse_phone(get_field('us_phone_tf','options'))?>"><?=get_field('us_phone_tf','options')?></a> <?=__('(Toll-free), or','cb-hydronix')?><br>
                                    <a class="noline" href="tel:<?=parse_phone(get_field('us_phone','options'))?>"><?=get_field('us_phone','options')?></a>
                                </li>
                                <li class="mb-4"><span class="fa-li"><i class="fa fa-mobile"></i></span>
                                    <a class="noline" href="tel:<?=parse_phone(get_field('us_mobile_tf','options'))?>"><?=get_field('us_mobile_tf','options')?></a> <?=__('(Toll-free), or','cb-hydronix')?><br>
                                    <a class="noline" href="tel:<?=parse_phone(get_field('us_mobile','options'))?>"><?=get_field('us_mobile','options')?></a></li>
                                <li class="mb-2"><span class="fa-li"><i class="fa fa-envelope"></i></span> <a class="noline" href="<?=get_field('us_email','options')?>"><?=__('Hydronix America','cb-hydronix')?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "Organization",
    "url": "https://www.hydronix.com",
    "contactPoint": [{
        "@type": "ContactPoint",
        "telephone": "<?=get_field('ho_phone','options')?>",
        "contactType": "sales, technical support",
        "contactOption": "",
        "areaServed": "Global"
    },{
        "@type": "ContactPoint",
        "telephone": "<?=get_field('us_phone','options')?>",	
        "contactType": "sales, technical support"
    },{
        "@type": "ContactPoint",
        "telephone": "<?=get_field('us_phone_tf','options')?>",	
        "contactType": "sales, technical support",
        "contactOption": ["TollFree"],
        "areaServed": "US"
    },{
        "@type": "ContactPoint",
        "telephone": "<?=get_field('eu_phone','options')?>",
        "contactType": "sales, technical support",
        "contactOption": "",
        "areaServed": "Europe, Southern Africa",
        "availableLanguage": "English, German,Dutch"
    },{
        "@type": "ContactPoint",
        "telephone": "<?=get_field('eu_phone','options')?>",
        "contactType": "technical support",
        "contactOption": "",
        "areaServed": "Europe, Southern Africa",
        "availableLanguage": "English, German,Dutch"
    },{
        "@type": "ContactPoint",
        "telephone": "<?=get_field('fr_phone','options')?>",
        "contactType": "sales, technical support",
        "areaServed": "France, Northern Africa"
    }]
}
</script>
<?php
get_footer();