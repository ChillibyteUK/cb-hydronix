<?php
$e = get_field('hs_form');
$class = $block['className'];
$anchor = $block['anchor'];
?>
<!-- hs_form -->
<div class="<?=$class?>" id="<?=$anchor?>">
<?php
if (get_field('title')) {
    echo '<h2>' . get_field('title') . '</h2>';
}
?>
<!--[if lte IE 8]>
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
<![endif]-->
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
<script>
hbspt.forms.create({
    region: "<?=$e['region']?>",
    portalId: "<?=$e['portal_id']?>",
    formId: "<?=$e['form_id']?>"
});
</script>
</div>