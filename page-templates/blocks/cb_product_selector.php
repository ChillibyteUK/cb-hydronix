<style>
#spinner {
    width: 1rem;
    height: 1rem;
    margin-left: 0.5rem;
}
</style>
<?php

$industries = get_terms( array(
    'taxonomy' => 'industries',
    'hide_empty' => true,
    'parent'        => 0,
) );

global $sitepress;
$current_lang = apply_filters( 'wpml_current_language', NULL );
?>
<input type="hidden" id="currLang" value="<?=$current_lang?>">
<!-- product_selector -->
<section class="product_selector pb-5">
    <div class="container-xl">
        <div class="row mb-5">
            <div class="col-md-4">
                <label for="industry"><?=__('Industry','cb-hydronix')?>:</label>
                <select name="industry" id="industry" data-field-name="industry" class="form-select mb-4">
                    <option value=""><?=__('Select your industry','cb-hydronix')?></option>
                    <?php
                    foreach ($industries as $i) {
                        echo '<option value="' . $i->slug . '">' . $i->name . '</option>';
                    }
                    ?>
                    <option value="other"><?=__('Other','cb-hydronix')?></option>
                </select>
            </div>
            <div class="col-md-4">
                <div id="processContainer">
                    <label for="process"><?=__('Process','cb-hydronix')?>:</label>
                    <select name="process" id="process" data-field-name="process" class="form-select mb-4"></select>
                </div>
            </div>
            <div class="col-md-4">
                <div id="tempContainer">
                    <label for="temperature"><?=__('Material Temperature','cb-hydronix')?>:</label>
                    <select name="temperature" id="temperature" data-field-name="temperature" class="form-select mb-4"></select>
                </div>
            </div>
            <div class="col-md-4">
                <button id="reset" class="btn btn-secondary">
                    <span id="resetText"><?=__('Reset','cb-hydronix')?></span>
                    <img src="<?=get_stylesheet_directory_uri()?>/img/spinner.gif" id="spinner">
                </button>
            </div>
            <div class="col-12">
                <div id="productsContainer" class="my-4 p-4">
                    <h3 class="mb-3"><?=__('Available Products','cb-hydronix')?></h3>
                    <div class="row mb-4 g-3" id="products"></div>
                </div>
            </div>
        </div>
        <!-- hs_form -->
        <div class="<?=$class?>" id="<?=$anchor?>">
            <h2 class="h4"><?=__("Can't find what you're looking for? Please tell us more:",'cb-hydronix')?></h2>
            <!--[if lte IE 8]>
            <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
            <![endif]-->
            <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
            <script>
                <?php
                $region = get_field('form_region') ?: 'na1';
                $portal = get_field('form_portal_id') ?: '8142423';
                $formid = get_field('form_id') ?: '8c2650a8-2392-4d39-a2ec-9bfd93101b12';
                ?>
            hbspt.forms.create({
                region: "<?=$region?>",
                portalId: "<?=$portal?>",
                formId: "<?=$formid?>"
            });
            </script>
        </div>
        <input type="hidden" name="hiddenIndustry" id="hiddenIndustry">
        <input type="hidden" name="hiddenProcess" id="hiddenProcess">
        <input type="hidden" name="hiddenTemp" id="hiddenTemp">
    </div>
</section>
<?php
add_action('wp_footer',function(){
    ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
(function($){

$("#form").hide();

$("#industry").val($("#industry option:first").val());
$("#processContainer").hide();
$("#tempContainer").hide();
$("#productsContainer").hide();
$("#hiddenIndustry").empty();
$("#hiddenProcess").empty();
$("#hiddenTemp").empty();
$("#spinner").hide();

// const industry = [... new Set(json.map(data => data.industry))]
// $.each(industry, function(index, value) {
//     $("#industry").append("<option value='"+value+"'>"+value+"</option>");
// });

$("#industry").change(function(){
    let endpoint = '/wp-content/themes/cb-hydronix/processes_by_industry.php'
    $("#process").empty();
    $("#process").append("<option><?=__('Select the process','cb-hydronix')?></option>");
    $("#hiddenIndustry").empty();
    $("#tempContainer").hide();
    $("#productsContainer").hide();

    var selIndustry = $(this).val();
    $("#hiddenIndustry").val(selIndustry);

    var currLang = $('#currLang').val();

    $("#resetText").hide();
    $("#spinner").show();

    $.ajax({
        url: endpoint + "?lang=" + currLang + "&ind=" + selIndustry,
        contentType: "text/plain",
        dataType: 'JSON',
        success: function(result){
            $.each(result, function(slug,name) {
                $("#process").append("<option value='" + slug + "'>" + name + "</option>");
            });
        },
        complete: function () {
            $("#spinner").hide();
            $("#resetText").show();
            $("#processContainer").show();
        }
    });

});

$("#process").change(function(){
    let endpoint = '/wp-content/themes/cb-hydronix/products_by_industry_process.php'
    $("#temperature").empty();
    $("#productsContainer").hide();

    $("#temperature").append("<option><?=__('Select the material temperature','cb-hydronix')?></option>");

    var selProcess = $(this).val();
    $("#hiddenProcess").val(selProcess);

    var selIndustry = $('#hiddenIndustry').val();
    var currLang = $('#currLang').val();

    $("#resetText").hide();
    $("#spinner").show();

    $.ajax({
        url: endpoint + "?lang=" + currLang + "&ind=" + selIndustry + "&process=" + selProcess,
        contentType: "text/plain",
        dataType: 'JSON',
        success: function(result) {
            $.each(result, function(slug,name) {
                $("#temperature").append("<option value='" + slug + "'>" + name + "</option>");
            });
        },
        complete: function () {
            $("#spinner").hide();
            $("#resetText").show();
            $("#tempContainer").show();
        }
    });
    
});

$("#temperature").change(function(){
    let endpoint = '/wp-content/themes/cb-hydronix/products_by_industry_process_temp.php'
    $("#products").empty();
    $("#cbx").empty();

    var selTemp = $(this).val();
    $("#hiddenTemp").val(selTemp);

    var selIndustry = $("#hiddenIndustry").val();
    var selProcess = $("#hiddenProcess").val();
    var currLang = $('#currLang').val();

    $("#resetText").hide();
    $("#spinner").show();

    $.ajax({
        url: endpoint + "?lang=" + currLang + "&ind=" + selIndustry + "&process=" + selProcess + "&temp=" + selTemp,
        contentType: "text/plain",
        dataType: 'JSON',
        success: function(result) {
            $.each(result, function(id,meta) {
                var badges = '<div class="badges">';

                if (meta[4] == 1) {
                    badges += '<div class="badge badge--food-safe"></div>';
                }
                if (meta[5] == 1) {
                    badges += '<div class="badge badge--atex"></div>';
                    badges += '<div class="badge badge--etl"></div>';
                }
                if (meta[6] == 1) {
                    badges += '<div class="badge badge--high-temp"></div>';
                }
                badges += '</div>';
                $("#products").append(
                    '<div class="col-md-6 col-lg-4">'
                    +'<a class="product__card" href="'+meta[1]+'">'
                    +'<img src="'+meta[2]+'">'
                    +'<div class="product__title">'+meta[0]+'</div>'
                    +'<div class="product__subtitle">'+meta[3]+'</div>'
                    +badges
                    +'</a>'
                    +'</div>'
                );
                $("#cbx").append('<div class="form-check"><input class="form-check-input" type="checkbox" name="products" id="'+id+'" value="'+meta[0]+'" checked><label class="form-check-label" for="'+id+'">'+meta[0]+'</label></div>');
            });
            $('#form').show();
        },
        complete: function () {
            $("#spinner").hide();
            $("#resetText").show();
            $("#productsContainer").show();
        }
    });

});


$("#reset").on('click',function() {
    $("#industry").val($("#industry option:first").val());
    $("#processContainer").hide();
    $("#tempContainer").hide();
    $("#productsContainer").hide();
    $("#hiddenIndustry").empty();
    $("#hiddenProcess").empty();
    $("#hiddenTemp").empty();
    $("#form").hide();
});

})(jQuery);
</script>
    <?php
},9999);