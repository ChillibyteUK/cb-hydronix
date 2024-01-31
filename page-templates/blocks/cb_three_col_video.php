<?php
$background = get_field('background');
$bg = !empty($background) && $background[0] === 'dark' ? 'bg--blue-100' : '';

$classes = $block['className'] ?? null;
?>
<style>
.video-grid {
    display: grid;
    gap: 1rem;
}
@media (min-width:992px) {
    .video-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (min-width:1200px) {
    .video-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}
lite-vimeo {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
.video-description {
    background-color: #0078a9;
    color: white;
    min-height: 4rem;
}
</style>
<section class="three_col_video py-5 <?=$bg?> <?=$classes?>">
    <div class="container-xl">
        <?php
        if (get_field('three_col_video__title')) {
            ?>
        <h2><?=get_field('three_col_video__title')?></h2>
            <?php
        }

        echo '<div class="video-grid">';

        while (have_rows('videos')) {
            the_row();
            // $bg = get_vimeo_data_from_id(get_sub_field('vimeo_id'), 'thumbnail_url');
            ?>
        <div class="video-container">
            <div class="video-preview">
                <?php
                $videometa = mmd_get_vimeo_info(get_sub_field('vimeo_id'));
                $bg = $videometa['thumbnail_url'];
                ?>
                <lite-vimeo videoid="<?=get_sub_field('vimeo_id')?>" style="background-image:url('<?=$bg?>');"></lite-vimeo>
            </div>
            <div class="video-description p-2">
                <?=get_sub_field('video_description')?>
            </div>
        </div>
            <?php
        }

        echo '</div>';

        ?>
    </div>
</section>
<script type=module src="<?=get_stylesheet_directory_uri()?>/js/lite-vimeo.js" defer></script>
<?php
/*
// forked lite-vimeo.js locally due to #shadow-root and unlisted Vimeo videos
<script type=module src="https://cdn.jsdelivr.net/npm/@slightlyoff/lite-vimeo@0.1.1/lite-vimeo.js" defer></script>
<script>

    // // Nope 1
    // document.querySelector('.video-grid').shadowRoot.querySelector('#fallbackPlaceholder').setAttribute('display', 'none');

    // // Nope 2
    // var sheet = new CSSStyleSheet
    // sheet.replaceSync( `#fallbackPlaceholder { display: none }`)
    // host.shadowRoot.adoptedStyleSheets = [ sheet ] 

    
    // // Nope 3
    // var style = document.createElement( 'style' )
    // style.innerHTML = '#fallbackPlaceholder { display: none; }'
    // host.shadowRoot.appendChild( style )

    // // Nope 4
    // customElements.define('my-shadow', class extends HTMLElement {
    //   connectedCallback() {
    //     this.attachShadow({mode: 'open'});
    //     this.shadowRoot.innerHTML = `
    //       <style>
    //       #fallbackPlaceholder { display: none; }
    //       </style>
    //     `;
    //   }
    // });

</script>
*/
?>