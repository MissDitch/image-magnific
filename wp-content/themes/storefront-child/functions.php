<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
// remove breadcrumbs
add_action( 'init', 'storefront_remove_storefront_breadcrumbs' );

function storefront_remove_storefront_breadcrumbs() {
   remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
}
// change fonts here
add_action( 'storefront_header', 'jk_storefront_header_content', 40 );
	function jk_storefront_header_content() { ?>
		<link href="https://fonts.googleapis.com/css?family=Londrina+Solid:300|Oswald:400|Raleway" rel="stylesheet">
		<?php
    }


    // Modify the default WooCommerce orderby dropdown
    //
    // Options: menu_order, popularity, rating, date, price, price-desc
    // In this example I'm removing price & price-desc but you can remove any of the options
    function patricks_woocommerce_catalog_orderby( $orderby ) {
        unset($orderby["menu_order"]);
        unset($orderby["popularity"]);
        unset($orderby["rating"]);
        return $orderby;
    }
    add_filter( "woocommerce_catalog_orderby", "patricks_woocommerce_catalog_orderby", 20 );

    // remove_action(storefront_footer, storefront_credit,20);

 /**
  * Display the theme credit
  *
  * @since  1.0.0
  * @return void
  */
  function storefront_credit() {
    ?>
    <div class="site-info">
        <?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
        <?php if ( apply_filters( 'storefront_credit_link', true ) ) { ?>
        <br /> <?php echo '<a href="https://woocommerce.com" target="_blank" title="' . esc_attr__( 'WooCommerce - The Best eCommerce Platform for WordPress', 'storefront' ) . '" rel="author">' . esc_html__( 'Built with Storefront &amp; WooCommerce', 'storefront' ) . '</a>' ?> by <a href="https://yourdomain.com" title="Your Company Name">Your Company Name</a>.
        <?php } ?>
    </div><!-- .site-info -->
    <?php
}