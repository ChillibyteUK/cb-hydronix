<!-- process_benefits -->
<section class="process_benefits mb-4">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-6">
                <?=get_field('intro')?>
            </div>
            <div class="col-md-6">
                <h2 class="fs-3 mb-4">Benefits</h2>
                <div class="card">
                <?php
                    $arr = explode( '<br />', get_field('benefits') );
                    echo '<ul class="mb-0">';
                    foreach ($arr as $a) {
                        echo '<li>' . trim($a) . '</li>';
                    }
                    echo '</ul>';
                ?>
                </div>
            </div>
        </div>
    </div>
</section>