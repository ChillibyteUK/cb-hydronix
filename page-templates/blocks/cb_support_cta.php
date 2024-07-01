<!-- support_cta -->
<section class="support_cta py-5">
    <div class="container-xl">
        <h2><?=__('Support','cb-hydronix')?></h2>
        <div class="row">
            <div class="col-lg-9">
                <div class="fs-4 mb-4"><?=__('Check out our technical resources for self-help.','cb-hydronix')?></div>
                <div class="row gx-5 gy-2">
                    <div class="col-md-6">
                        <strong><?=__('For further support with your Hydronix installation, please contact our friendly support team.','cb-hydronix')?></strong>
                    </div>
                    <?php
                    /*
                    <div class="col-md-6 mb-4">
                        <strong><?=__('Please note our working hours:','cb-hydronix')?></strong><br>
                        <?=__('Monday to Thursday:','cb-hydronix')?> <strong>08:30 &dash; 16:45</strong><br>
                        <?=__('Friday:','cb-hydronix')?> <strong>08:30 &dash; 16:00</strong>
                    </div>
                    */
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <?php
                $suppID = get_page_by_path('contact-support');
                $suppIDLang = apply_filters( 'wpml_object_id', $suppID->ID, 'page' );
                $suppLink = get_the_permalink($suppIDLang);
                $resID = get_page_by_path('resources/downloads');
                $resIDLang = apply_filters( 'wpml_object_id', $resID->ID, 'page' );
                $resLink = get_the_permalink($resIDLang);
                $trgID = get_page_by_path('training');
                $trgIDLang = apply_filters( 'wpml_object_id', $trgID->ID, 'page' );
                $trgLink = get_the_permalink($trgIDLang);
                ?>
                <a href="<?=$suppLink?>" class="btn btn--orange mb-2"><?=__('Contact Support','cb-hydronix')?></a>
                <a href="<?=$resLink?>" class="btn btn--green mb-2"><?=__('Download Technical Resources','cb-hydronix')?></a>
                <?php
                if ($trgLink ?? null) {
                    ?>
                <a href="<?=$trgLink?>" class="btn btn--grey"><?=__('View Training','cb-hydronix')?></a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>