<?php

// if direct access
if (!defined('ABSPATH')) {
    exit;
}

wp_enqueue_style('rst_frontend_from_style', plugin_dir_url(__FILE__) . 'css/frontend-form.css', array(), time(), 'all');

?>


<div class="smart-wrap rst_frontend_form">
    <div class="smart-forms smart-container wrap-2">
        <div class="form-header header-primary"><h4><?php _e("Please Give your feedback here", 'rst-testimonial'); ?></h4></div><!-- end .form-header section -->
        <form method="post" id="new_post" name="new_post"  action="" class="wpcf7-form" enctype="multipart/form-data">
            <div class="form-body">
                <div class="frm-row">
                    <div class="section colm colm6">
                        <label for="firstname" class="field prepend-icon">
                            <label for="firstname" class="field-icon"><?php _e("Name", 'rst-testimonial'); ?></label>
                            <input type="text" name="prospecto_nombre" id="firstname" class="gui-input" placeholder="Name">

                        </label>
                    </div><!-- end section -->

                    <div class="section colm colm6">
                        <label for="lastname" class="field prepend-icon">
                            <label for="lastname" class="field-icon"><?php _e("Position", 'rst-testimonial'); ?></label>
                            <input type="text" name="lastname" id="lastname" class="gui-input" placeholder="Position">

                        </label>
                    </div><!-- end section -->

                    <div class="section colm colm6">
                        <label for="lastname" class="field prepend-icon">
                            <label for="lastname" class="field-icon"><?php _e("Company Name", 'rst-testimonial'); ?></label>
                            <input type="text" name="lastname" id="lastname" class="gui-input" placeholder="Company Name">

                        </label>
                    </div><!-- end section -->
                </div><!-- end .frm-row section -->

                <div class="section">
                    <label for="website" class="field prepend-icon">
                        <label for="website" class="field-icon"><?php _e("Company Website", 'rst-testimonial'); ?></label>
                        <input type="url" name="website" id="website" class="gui-input" placeholder="Company website url">

                    </label>
                </div><!-- end section -->

                <div class="section">
                    <label class="field select">
                        <label for="website" class="field-icon"><?php _e("Select Ratting", 'rst-testimonial'); ?></label>
                        <select id="language" name="language">
                            <option value=""><?php _e("Select Ratting...", 'rst-testimonial'); ?></option>
                            <option value="5">5</option>
                            <option value="4.5">4.5</option>
                            <option value="4">4</option>
                            <option value="3.5">3.5</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                        <i class="arrow double"></i>
                    </label>
                </div><!-- end section -->

                <div class="section">
                    <label for="comment" class="field prepend-icon">
                        <label for="website" class="field-icon"><?php _e("Your Comment", 'rst-testimonial'); ?></label>
                        <textarea class="gui-textarea" rows="9" id="comment" name="comment" placeholder="Your comment"></textarea>
                    </label>
                </div><!-- end section -->

                <input type="submit">

</div><!-- end .smart-wrap section -->

