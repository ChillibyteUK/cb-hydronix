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

?>
<!-- product_selector -->
<section class="product_selector pb-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-12">
                        <label for="industry">Industry:</label>
                        <select name="industry" id="industry" data-field-name="industry" class="form-select mb-4">
                            <option value="">Select your industry</option>
                            <?php
                            foreach ($industries as $i) {
                                echo '<option value="' . $i->slug . '">' . $i->name . '</option>';
                            }
                            ?>
                            <option value="other">Other</option>
                        </select>
                        <div id="processContainer">
                            <label for="process">Process Step:</label>
                            <select name="process" id="process" data-field-name="process" class="form-select mb-4"></select>
                        </div>
                        <div id="tempContainer">
                            <label for="temperature">Material Temperature:</label>
                            <select name="temperature" id="temperature" data-field-name="temperature" class="form-select mb-4"></select>
                        </div>
                        <div class="pt-5">
                            <button id="reset" class="btn btn-secondary">
                                <span id="resetText">Reset</span>
                                <img src="<?=get_stylesheet_directory_uri()?>/img/spinner.gif" id="spinner">
                            </button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="productsContainer" class="m-4 p-4">
                            <h3 class="mb-3">Available Products</h3>
                            <!-- <div class="fs-5 fw-bold mb-3">Find Out More</div> -->
                            <div class="row mb-4 g-3" id="products"></div>
                            <div class="enquireContainer d-none">
                                <div class="fs-5 fw-bold mb-3">Enquire</div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div id="cbx"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <button class="btn btn-primary">Enquire</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- hs_form -->
                <div class="<?=$class?>" id="<?=$anchor?>">
                <h2><?=__("Can't find what you're looking for? Please tell us more:",'cb-hydronix')?></h2>
                <!--[if lte IE 8]>
                <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
                <![endif]-->
                <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
                <script>
                hbspt.forms.create({
                    region: "na1",
                    portalId: "8142423",
                    formId: "8c2650a8-2392-4d39-a2ec-9bfd93101b12"
                });
                </script>
                </div>
                
            </div>
        </div>
    </div>
    <input type="hidden" name="hiddenIndustry" id="hiddenIndustry">
    <input type="hidden" name="hiddenProcess" id="hiddenProcess">
    <input type="hidden" name="hiddenTemp" id="hiddenTemp">
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
    $("#process").append("<option>Select the process step</option>");
    $("#hiddenIndustry").empty();
    $("#tempContainer").hide();
    $("#productsContainer").hide();

    var selIndustry = $(this).val();
    $("#hiddenIndustry").val(selIndustry);

    $("#resetText").hide();
    $("#spinner").show();

    $.ajax({
        url: endpoint + "?ind=" + selIndustry,
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

    $("#temperature").append("<option>Select the material temperature</option>");

    var selProcess = $(this).val();
    $("#hiddenProcess").val(selProcess);

    var selIndustry = $('#hiddenIndustry').val();

    $("#resetText").hide();
    $("#spinner").show();

    $.ajax({
        url: endpoint + "?ind=" + selIndustry + "&process=" + selProcess,
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
    
    $("#resetText").hide();
    $("#spinner").show();

    $.ajax({
        url: endpoint + "?ind=" + selIndustry + "&process=" + selProcess + "&temp=" + selTemp,
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