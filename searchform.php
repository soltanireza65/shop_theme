<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="input-group">
        <input type="search" class="form-control" placeholder="<?php _e( "جستجو", 'shop_theme' ) ?>"
               id="<?php echo $unique_id; ?>" value="<?php echo get_search_query(); ?>" name="s">
        <div class="input-group-append bg-danger border-0">
            <button class="btn" type="submit"><i class="fas fa-search text-white"></i></button>
        </div>
    </div>
</form>
