<style>
    #spinner {
        width: 1rem;
        height: 1rem;
        margin-left: 0.5rem;
    }

    .thumbnail {
        height: 70px;
        margin: auto;
        display: flex;
    }

    .mw-100px {
        max-width: 100px;
    }

    @media (max-width:767px) {
        thead {
            display: none;
        }

        tr {
            display: grid;
            /* grid-template-columns: 1fr; */
            grid-template-areas:
                'type language'
                'description description'
                'file file'
                'download download'
            ;
        }

        /* td {
        display: grid;
        grid-template-columns: 15ch auto;
    } */
        /* td::before {
        content: attr(data-cell) ": ";
        font-weight: 700;
        text-transform: capitalize;
    } */
        /* td:first-child {
        padding-top: 1rem;
    } */
        td:last-child {
            padding-bottom: 1rem;
        }

        .mw-100px {
            max-width: 100%;
        }

        td.text-center {
            text-align: left !important;
        }

        td.fs-7 {
            font-size: 1rem;
        }

        td[data-cell="type"] {
            grid-area: type;
        }

        td[data-cell="description"] {
            grid-area: description;
        }

        td[data-cell="file name"] {
            grid-area: file;
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        td[data-cell="download"] {
            grid-area: download;
            text-align: center !important;
            font-size: 2rem;
        }

        td[data-cell="language"] {
            grid-area: language;
            display: grid;
            grid-template-columns: 3ch 0 1fr;
            align-items: center;
        }

    }
</style>
<?php

// product TODO
$dsubs = get_terms(array(
    'taxonomy' => 'docprod',
    'hide_empty' => true,
    'parent'        => 0,
));

$liveProducts = array();
$legacyProducts = array();
foreach ($dsubs as $d) {
    
    $checkbox_value = get_field('is_current', 'docprod_' . $d->term_id);
    
    // echo '<!--';
    // var_dump($checkbox_value);
    // echo '-->';

    if ($d->slug == 'ca-moisture-probe') {
        continue;
    }

    if ($checkbox_value[0] == 'Yes') {
        //$liveProducts[$d->slug] = $d->name;
    } else {
        //$legacyProducts[$d->slug] = $d->name;
    }
        $liveProducts[$d->slug] = $d->name;
    // if (preg_match('/\(/', $d->name)) {
    //     $legacyProducts[$d->slug] = $d->name;
    // } else {
    //     $liveProducts[$d->slug] = $d->name;
    // }
}

// industry
$dinds = get_terms(array(
    'taxonomy' => 'industries',
    'hide_empty' => false,
    'parent'        => 0,
));

$dtypes = get_terms(array(
    'taxonomy' => 'attachment_category',
    'hide_empty' => false,
    'parent'        => 0,
));

$dlangs = get_terms(array(
    'taxonomy'   => 'doclang',
    'hide_empty' => false,
    'parent'     => 0,
    'orderby'    => 'name',
    'order'      => 'ASC',
));

?>
<!-- downloads -->
<section class="downloads py-5">
    <div class="container-xl">
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="dsub"
                    class="form-label"><?=__('Product Name', 'cb-hydronix')?>:</label>
                <select name="dsub" id="dsub" data-field-name="dsub" class="form-select mb-4 filter">
                    <option value="">
                        <?=__('Select all', 'cb-hydronix')?>
                    </option>
                    <?php
                    $ca0022_slug = '';
$ca0022_name = '';
foreach ($liveProducts as $slug => $name) {
    echo '<option value="' . $slug . '">' . $name . '</option>';
}
?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dsub_model"
                    class="form-label"><?=__('Model Number', 'cb-hydronix')?>:</label>
                <select name="dsub_model" id="dsub_model" data-field-name="dsub_model" class="form-select mb-4 filter">
                    <option value="">
                        <?=__('Select all', 'cb-hydronix')?>
                    </option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dtype"
                    class="form-label"><?=__('Type', 'cb-hydronix')?>:</label>
                <select name="dtype" id="dtype" data-field-name="dtype" class="form-select mb-4 filter">
                    <option value="">
                        <?=__('Select all', 'cb-hydronix')?>
                    </option>
                    <?php
foreach ($dtypes as $dt) {
    echo '<option value="' . $dt->slug . '">' . $dt->name . '</option>';
}
?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dlang"
                    class="form-label"><?=__('Language', 'cb-hydronix')?>:</label>
                <select name="dlang" id="dlang" data-field-name="dlang" class="form-select mb-4 filter">
                    <option value="">
                        <?=__('Select all', 'cb-hydronix')?>
                    </option>
                    <?php
$curr_lang = apply_filters('wpml_current_language', null);
$selected = '';
foreach ($dlangs as $dl) {
    $test = preg_replace('/-.*$/', '', $dl->slug);
                        
    $selected = $test == $curr_lang ? 'selected' : '';
    // $selected = $dl->slug == $curr_lang ? 'selected' : '';
    echo '<option value="' . $dl->slug . '" ' . $selected . '>' . $dl->name . '</option>';
}
?>
                </select>
            </div>
            <div class="col-md-9">
                <label for="dtext"
                    class="form-label"><?=__('Search Text', 'cb-hydronix')?>:</label><input
                    type="text" class="form-control filter" id="dtext">
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <button id="submit" class="btn btn-primary me-2 mb-0 mt-3 btn--small">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/spinner.gif"
                        id="spinner">
                    <span
                        id="submitText"><?=__('Search', 'cb-hydronix')?></span>
                </button>
                <button id="reset" class="btn btn-secondary mb-0 mt-3 btn--small">
                    <span
                        id="resetText"><?=__('Reset', 'cb-hydronix')?></span>
                </button>
            </div>
        </div>
        <div id="resultCount"></div>
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
                        <th class=" d-none d-md-table-cell text-center" style="width:100px">&nbsp;</th>
                        <th class="text-center" style="width:100px">
                            <?=__('Download', 'cb-hydronix')?>
                        </th>
                        <th class="text-center" style="width:100px">
                            <?=__('Lang', 'cb-hydronix')?>
                        </th>
                    </tr>
                </thead>
                <tbody id="dlBody"></tbody>
            </table>
        </div>
    </div>
    <input type="hidden" name="hiddenDSub" id="hiddenDSub">
    <input type="hidden" name="hiddenDSubModel" id="hiddenDSubModel">
    <input type="hidden" name="hiddenDType" id="hiddenDType">
    <input type="hidden" name="hiddenDInd" id="hiddenDInd">
    <input type="hidden" name="hiddenDLang" id="hiddenDLang">
    <input type="hidden" name="hiddenDText" id="hiddenDText">
    <input type="hidden" name="currLang" id="currLang"
        value="<?=$curr_lang?>">
</section>
<?php
add_action('wp_footer', function () {
    ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    (function($) {
        $('#dsub').on('change', function() {
            var data = {
                action: 'nm_get_tax_children',
                parent_term_id: this.value
            };

            $.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function (response) {
                var options = '';
                options += '<option value="">Select all</option>';
                var response = $.parseJSON(response)
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].slug + '">' + response[i].name + '</option>';
                }
                $('#dsub_model').empty().append(options);
            });
        });

        $('#dtext').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();
                $('#submit').click();
                return false;
            }
        });

        $("#spinner").hide();
        $("#dlContainer").hide();

        $("#reset").on('click', function() {
            $("#dlContainer").hide();
            $("#dlBody").empty();
            $("#dsub").val($("#dsub option:first").val());
            $("#dsub_model").val($("#dsub_model option:first").val());
            $("#dlang").val($("#dlang option:first").val());
            $("#dtype").val($("#dtype option:first").val());
            $("#dind").val($("#dind option:first").val());
            $("#dtext").val("");
        });

        // $(".filter").change(function(){
        $("#submit").click(function() {
            let endpoint = '/wp-content/themes/cb-hydronix/attachments_new.php'
            $("#hiddenDSub").empty();
            $("#hiddenDSubModel").empty();
            $("#hiddenDType").empty();
            $("#hiddenDLang").empty();
            $("#hiddenDInd").empty();
            $("#hiddenDText").empty();

            $("#dlContainer").hide();
            $("#dlBody").empty();

            var selDSub = $('#dsub').val() == 'Select all' ? '' : $('#dsub').val();
            $("#hiddenDSub").val(selDSub);

            var selDSubModel = $('#dsub_model').val() == 'Select all' ? '' : $('#dsub_model').val();
            $("#hiddenDSubModel").val(selDSubModel);

            var selDType = $('#dtype').val() == 'Select all' ? '' : $('#dtype').val();;
            $("#hiddenDType").val(selDType);

            var selDInd = $('#dind').val() == 'Select all' ? '' : $('#dind').val();;
            $("#hiddenDInd").val(selDInd);

            var selDLang = $('#dlang').val() == 'Select all' ? '' : $('#dlang').val();
            $("#hiddenDLang").val(selDLang);

            var selDText = $('#dtext').val() == '' ? '' : $('#dtext').val();

            var currLang = $('#currLang').val();

            $("#submitText").hide();
            $("#spinner").show();
            /*
                            utf8_encode(wp_get_attachment_caption(get_the_ID())),       // [0]
                            $title,                                                     // [1]
                            $type[0]->name,                                             // [2]
                            $lang[0]->name,                                             // [3]
                            $lang[0]->slug,                                             // [4]
                            get_field('release_date',get_the_ID()),                     // [5]
                            $pVer,                                                      // [6]
                            $docVer,                                                    // [7]
                            $product,                                                   // [8]

                            "Sl0040 1 1 0":[
                                "Hydro-View - Touch Screen Display for viewing data and calibrating and configuring Hydronix Sensors\n",
                                "Sl0040 1 1 0",
                                "Brochure",
                                "English",
                                "en",
                                "07\/10\/2020",
                                "HV05",
                                "v1.1.0 - ",
                                "Hydro-View<br><small>(HV05)<\/small>"]
            */

            $.ajax({
                url: endpoint + "?dsub=" + selDSub + "&dsub_model=" + selDSubModel + "&dtype=" + selDType + "&dlang=" + selDLang +
                    "&dtext=" + selDText + "&dind=" + selDInd + "&curr=" + currLang,
                contentType: "text/plain",
                dataType: 'JSON',
                success: function(result) {
                    if (result.files) {
                        $.each(result.files, function(slug, vals) {
                            let rtl = vals[4] == 'fa' ? 'rtl' : '';
                            $("#dlBody").append(
                                "<tr class='dl' data-url='" + vals[11] + "'>" +
                                "<td data-cell='type' class='text-center align-middle fs-7 mw-100px'>"
                                /*
                                + "<i class='fa "
                                + vals[2] // type icon
                                + "' title='" + vals[12] + "'></i>"
                                */
                                +
                                vals[2] + "</td>" +
                                "<td data-cell='description' class='align-middle'>" +
                                vals[0] // desc
                                // + vals[8] // product
                                +
                                "</td>" +
                                "<td data-cell='file name' dir='" + rtl +
                                "' style='vertical-align:middle'>" +
                                "<i class='fa fa-file-" + vals[10] +
                                "-o'></i> <strong>" + vals[1] +
                                "</strong><br>" // doc title
                                // + decodeURIComponent(escape(vals[0]))  // desc
                                +
                                "<small class='text--blue'>" + vals[7] + " - " +
                                vals[9] + "</small>" // version
                                +
                                "</td>" +
                                "<td data-cell='thumbnail' class='d-none d-md-table-cell'><img src='" +
                                vals[13] + "' class='thumbnail'></td>" +
                                "<td data-cell='download' class='text-center align-middle'><a href='" +
                                vals[11] +
                                "' target='_blank'><i class='fa fa-download'></i></a></td>" +
                                "<td data-cell='language' class='text-center align-middle'>" +
                                "<img src='/wp-content/plugins/sitepress-multilingual-cms/res/flags/" +
                                vals[4] // lang code
                                +
                                ".png' alt='" + vals[3] + "'>" // lang name
                                +
                                "<br><div class='small'>" + vals[3] +
                                "</div>" // lang name
                                +
                                "</td>" +
                                "</tr>"
                            );
                        });
                        if (result && result.files && result.files.length > 0) {
                            document.getElementById('resultCount').textContent = 'Found ' +
                                result
                                .files.length;
                        }
                    } else {
                        $("#dlBody").append(
                            "<tr><td colspan='6'><?=__('We are sorry, there are no results that match your selection. Please revise your selection and try again.', 'cb-hydronix')?></td></tr>"
                        );
                    }

                    // type dropdown
                    // $('#dtype').empty();
                    // $("#dtype").append("<option>Select all</option>");
                    // let hDtype = $('#hiddenDType').val();
                    // $.each(result.types, function(slug,name) {
                    //     let curr = '';
                    //     if (slug === hDtype) {
                    //         curr = 'selected';
                    //     }
                    //     $("#dtype").append("<option value='" + slug + "' " + curr + ">" + name + "</option>");
                    // });

                    // lang dropdown
                    // $('#dlang').empty();
                    // $("#dlang").append("<option>Select all</option>");
                    // let hDlang = $('#hiddenDLang').val();
                    // $.each(result.langs, function(slug,name) {
                    //     let curr = '';
                    //     if (slug == hDlang) {
                    //         curr = 'selected';
                    //     }
                    //     $("#dlang").append("<option value='" + slug + "' " + curr + ">" + name + "</option>");
                    // });
                },
                complete: function() {
                    $("#spinner").hide();
                    $("#submitText").show();
                    $("#dlContainer").show();
                }
            });

        });

    })(jQuery);
</script>
<?php
}, 9999);
?>