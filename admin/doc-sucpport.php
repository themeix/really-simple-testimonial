<?php

// if direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//Add Submenu Page

function rst_testimonials_custom_submenu_page() {
	add_submenu_page( 'edit.php?post_type=rst_testimonial', 'Doc & Support', 'Doc & Support', 'manage_options', 'rst-support', 'rst_testimonials_custom_shortcode_callback' );
}

function rst_testimonials_custom_shortcode_callback() {

	?>
    <div class="wrap about-wrap full-width-layout">
        <h1><?php _e( 'Welcome to Really Simple Testimonial', 'rst-testimonial' ); ?></h1>
        <p id="tp_testimonials_shortcode_para">
        <p class="about-text">Thanks for installing our plugin super testimonial. If you have any Question or need any
            helps, please don't hesitate to post it on <a href="https://www.themeix.com"
                                                          target="_blank">WordPress.org Support Forum</a> or <a
                    href="https://www.themeix.com" target="_blank">Themeix.com Support Forum</a>.
        </p>
        <div class="changelog point-releases">
            <h3>Submit a Review</h3>
            <p>We spend plenty of time to develop a plugin like this and give you freely to make your life easier. If
                you like this plugin, please <a style="color:red;"
                                                href="https://www.themeix.com"
                                                target="_blank">rate it 5 stars</a>. If you have any problems with the
                plugin, please <a href="https://www.themeix.com" target="_blank">let us know</a>
                before leaving a review.</p>
        </div>
        </p>
        <div class="testimonials_btn_area">
            <a target="_blank" href="https://www.themeix.com" class="testimonials_btn">Upgrade
                Pro</a>
            <a target="_blank" href="https://www.themeix.com" class="testimonials_btn">Live Preview</a>
            <a target="_blank" href="https://www.themeix.com" class="testimonials_btn">Documentation</a>
            <a target="_blank" href="https://www.themeix.com" class="testimonials_btn">Support</a><br/>
        </div>
    </div>
	<?php
}

add_action( 'admin_menu', 'rst_testimonials_custom_submenu_page' );
