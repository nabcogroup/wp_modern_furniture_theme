<?php


?>

<form class="form-horizontal mf-form" style="display:block;" method="get" action="<?php esc_url( home_url( '/' ) ) ?>">
    <div class="col-md-12">
        <div class="input-group">
            <input type="text" id="woocommerce-product-search-field-0" 
                        class="form-control" placeholder="<?php  __( 'Search products&hellip;', 'woocommerce' ) ?>" 
                        aria-label="Search" name="s" 
                        value="<?php get_search_query() ?>">
            <input type="hidden"   name="post_type" value="product" />
            <div class="input-group-append">
                <button class="input-group-text btn btn-primary" id="basic-addon1" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
</form>
