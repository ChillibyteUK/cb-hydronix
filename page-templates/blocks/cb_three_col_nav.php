<!-- three_col_nav -->
<section class="three_col_nav py-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-4 mb-4 three_col_nav__card">
                <div class="three_col_nav__inner">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/icon--applications.svg" alt="" class="icon">
                    <h2 class="three_col_nav__title"><?=__('Industries','cb-hydronix')?></h2>
                    <div class="three_col_nav__content"><?=get_field('app_content')?></div>
                </div>
                <select class="form-select mb-4" name="" id="byApplication">
                    <option value=""><?=__('Select Industry','cb-hydronix')?></option>
                    <?php
                    $applications = get_terms(array('taxonomy' => 'industries', 'parent' => 0, 'hide_empty' => false,));
                    if ($applications) {
                        foreach ($applications as $p) {
                            echo '<option value="' . $p->slug . '">' . $p->name . '</option>';
                        }
                    }
                    echo '<option value="your-application">' . __('Your Application','cb-hydronix') . '</option>';
                    ?>
                </select>
            </div>
            <div class="col-lg-4 mb-4 three_col_nav__card">
                <div class="three_col_nav__inner">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/icon--benefits.svg" alt="" class="icon">
                    <h2 class="three_col_nav__title"><?=__('Benefits','cb-hydronix')?></h2>
                    <div class="three_col_nav__content"><?=get_field('ben_content')?></div>
                </div>
                <div class="mb-4">
                    <a class="btn btn--orange mx-auto" href="/moisture-measurement/"><?=__('Read more','cb-hydronix')?></a>
                </div>
            </div>
            <div class="col-lg-4 mb-4 three_col_nav__card">
                <div class="three_col_nav__inner">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/icon--process-control.svg" alt="" class="icon">
                    <h2 class="three_col_nav__title"><?=__('Process control','cb-hydronix')?></h2>
                    <div class="three_col_nav__content"><?=get_field('pc_content')?></div>
                </div>
                <select class="form-select mb-4" name="" id="byProcess">
                    <option value=""><?=__('Select Process','cb-hydronix')?></option>
                    <?php
                    $processes = get_terms(array('taxonomy' => 'process','hide_empty' => false,));
                    foreach ($processes as $p) {
                        echo '<option value="' . $p->slug . '">' . $p->name . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
</section>
<?php
add_action('wp_footer',function(){
    ?>
<script>
(function($){
    $('#byApplication').on('change',function(){
        var page = $(this).val();
        if (page === 'your-application') {
            window.location.href="/"+page+"/";
        }
        else {
            window.location.href="/industries/"+page+"/";
        }
    });
    $('#byProcess').on('change',function(){
        var page = $(this).val();
        window.location.href="/process-control/"+page+"/";
    });

})(jQuery);
</script>
    <?php
},9999);