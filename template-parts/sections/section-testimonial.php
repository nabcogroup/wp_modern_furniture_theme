<?php

$visible = get_theme_mod('mf_testimonial_visible','show');
$image_path = get_theme_mod('mf_testimonial_bg', '' );
$shortcode = get_theme_mod('mf_testimonial_shortcode','bizpack');

if($shortcode == 'custom') {
    $shortcode = get_theme_mod('mf_testimonial_custom_shortcode');
}

if($visible == 'hide') return false;

?>

<section class="site-wide-section testimony-section" 
    <?php if(!empty($image_path)) : ?>
		style="background: url(<?php echo $image_path; ?>) top left no-repeat;background-size:cover;"
	<?php endif; ?>
>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                    if($shortcode == 'bizpack') {
                        echo do_shortcode('[bizpack-testimonial]');
                    }
                    else {
                        echo do_shortcode($shortcode);
                    }
                ?>
            </div>
        </div>
    </div>

</section>
