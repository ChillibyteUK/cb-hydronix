<?php
/*
Template Name: Contact Sidebar
*/
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<main id="main">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-9">
                <?php
                    the_post();
                    the_content(); 
                ?>
            </div>
            <div class="col-lg-3">
                <div class="card p-3 mb-4">
                    <strong class="fs-5">Hydronix Head Office</strong>
                    <div class="mb-3"><em><?=get_field('ho_areas_served','options')?></em></div>
                    <div class="fa-ul">
                        <li><span class="fa-li"><i class="fa fa-phone"></i></span> <a class="noline" href="tel:<?=parse_phone(get_field('ho_phone','options'))?>"><?=get_field('ho_phone','options')?></a></li>
                        <li><span class="fa-li"><i class="fa fa-envelope"></i></span> <a class="noline" href="mailto:<?=get_field('ho_enquiries_email','options')?>"><?=__('Enquiries','cb-hydronix')?></a></li>
                        <li><span class="fa-li"><i class="fa fa-envelope"></i></span> <a class="noline" href="mailto:<?=get_field('ho_support_email','options')?>"><?=__('Support','cb-hydronix')?></a></li>
                        <li><span class="fa-li"><i class="fa fa-envelope"></i></span> <a class="noline" href="mailto:<?=get_field('ho_service_email','options')?>"><?=__('Service','cb-hydronix')?></a></li>
                    </div>
                </div>
                <div class="card p-3 mb-4">
                    <strong class="fs-5">Hydronix America</strong>
                    <div class="mb-3"><em><?=get_field('us_areas_served','options')?></em></div>
                    <ul class="fa-ul">
                        <li class="mb-4"><span class="fa-li"><i class="fa fa-map-marker"></i></span> <?=get_field('us_address','options')?></li>
                        <li class="mb-2"><span class="fa-li"><i class="fa fa-phone"></i></span> <a class="noline" href="tel:<?=parse_phone(get_field('us_phone_tf','options'))?>"><?=get_field('us_phone_tf','options')?></a> (Toll-free),<br>or <a class="noline" href="tel:<?=parse_phone(get_field('us_phone','options'))?>"><?=get_field('us_phone','options')?></a></li>
                        <li class="mb-4"><span class="fa-li"><i class="fa fa-mobile"></i></span> <a class="noline" href="tel:<?=parse_phone(get_field('us_mobile_tf','options'))?>"><?=get_field('us_mobile_tf','options')?></a> (Toll-free),<br>or <a class="noline" href="tel:<?=parse_phone(get_field('us_phone','options'))?>"><?=get_field('us_phone','options')?></a></li>
                        <li class="mb-2"><span class="fa-li"><i class="fa fa-envelope"></i></span> <a class="noline" href="mailto:<?=get_field('us_email','options')?>">Hydronix America</a></li>
                    </ul>
                </div>
                <div class="card p-3 mb-4">
                    <strong class="fs-5">Hydronix Europe</strong>
                    <div class="mb-3"><em><?=get_field('eu_areas_served','options')?></em></div>
                    <ul class="fa-ul">
                        <li class="mb-2"><span class="fa-li"><i class="fa fa-phone"></i></span> <a class="noline" href="tel:<?=parse_phone(get_field('eu_phone','options'))?>"><?=get_field('eu_phone','options')?></a></li>
                        <li class="mb-2"><span class="fa-li"><i class="fa fa-fax"></i></span> <?=get_field('eu_fax','options')?></li>
                        <li class="mb-2"><span class="fa-li"><i class="fa fa-envelope"></i></span> <a class="noline" href="mailto:<?=get_field('eu_email','options')?>">Hydronix Europe</a></li>
                    </ul>
                </div>
                <div class="card p-3 mb-4">
                    <strong class="fs-5">Hydronix France</strong>
                    <div class="mb-3"><em><?=get_field('fr_areas_served','options')?></em></div>
                    <ul class="fa-ul">
                        <li class="mb-2"><span class="fa-li"><i class="fa fa-phone"></i></span> <a class="noline" href="tel:<?=parse_phone(get_field('fr_phone','options'))?>"><?=get_field('fr_phone','options')?></a></li>
                        <li class="mb-2"><span class="fa-li"><i class="fa fa-envelope"></i></span> <a class="noline" href="mailto:<?=get_field('fr_email','options')?>">Hydronix France</a></li>
                    </ul>
                </div>
                <div class="card p-3 mb-4">
                    <strong class="fs-5">Hydronix China</strong>
                    <div class="mb-3"><em><?=get_field('cn_areas_served','options')?></em></div>
                    <ul class="fa-ul">
                        <li class="mb-2"><span class="fa-li"><i class="fa fa-phone"></i></span> <a class="noline" href="tel:<?=parse_phone(get_field('cn_phone','options'))?>"><?=get_field('fr_phone','options')?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();