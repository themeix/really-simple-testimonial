<?php

// if direct access
if (!defined('ABSPATH')) {
    exit;
}


//Adding Short Code in Sub Menu

if (!function_exists('rts_testimonials_add_submenu_items')) {
    function rts_testimonials_add_submenu_items()
    {
        add_submenu_page('edit.php?post_type=rst_testimonial', __('Generate Shortcode', 'rst-testimonial'), __('Generate Shortcode', 'rst-testimonial'), 'manage_options', 'post-new.php?post_type=rst_shortcode');
    }
}

add_action('admin_menu', 'rts_testimonials_add_submenu_items');

if (!function_exists('rst_testimonials_shortcode_generator_type')) {
    function rst_testimonials_shortcode_generator_type()
    {

        // Set UI labels for Custom Post Type
        $labels = array(
            'name' => _x('Testimonials', 'Post Type General Name', 'rst-testimonial'),
            'singular_name' => _x('Testimonial', 'Post Type Singular Name', 'rst-testimonial'),
            'menu_name' => __('Testimonials', 'rst-testimonial'),
            'parent_item_colon' => __('Parent Shortcode', 'rst-testimonial'),
            'all_items' => __('All Shortcode', 'rst-testimonial'),
            'view_item' => __('View Shortcode', 'rst-testimonial'),
            'add_new_item' => __('Generate Shortcode', 'rst-testimonial'),
            'add_new' => __('Generate New Shortcode', 'rst-testimonial'),
            'edit_item' => __('Edit Testimonial', 'rst-testimonial'),
            'update_item' => __('Update Testimonial', 'rst-testimonial'),
            'search_items' => __('Search Testimonial', 'rst-testimonial'),
            'not_found' => __('Not Found', 'rst-testimonial'),
            'not_found_in_trash' => __('Not found in Trash', 'rst-testimonial'),
        );

        // Set other options for Custom Post Type
        $args = array(
            'label' => __('Testimonial Shortcode', 'rst-testimonial'),
            'description' => __('Shortcode news and reviews', 'rst-testimonial'),
            'labels' => $labels,
            'supports' => array('title'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => 'edit.php?post_type=rst_testimonial',
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );
        // Registering your Custom Post Type
        register_post_type('rst_shortcode', $args);
    }
}
add_action('init', 'rst_testimonials_shortcode_generator_type');

if (!function_exists('rst_testimonials_shortcode_clmn')) {
    function rst_testimonials_shortcode_clmn($columns)
    {

        unset($columns['date']);

        return array_merge($columns,
            array(
                'rst_shortcode' => __('Shortcode', 'rst-testimonial'),
                'rst_doshortcode' => __('Template Shortcode', 'rst-testimonial'),
                "date" => __('Date', 'rst-testimonial'),
            )
        );
    }
}
add_filter('manage_rst_shortcode_posts_columns', 'rst_testimonials_shortcode_clmn');

if (!function_exists('rst_testimonials_shortcode_clmn_display')) {
    function rst_testimonials_shortcode_clmn_display($rstcp_column, $post_id)
    {
        if ($rstcp_column == 'rst_shortcode') {
            ?>
            <input style="background:#ddd" type="text" onClick="this.select(); execCommand('copy');"
                   value="[rstpro <?php echo 'id=&quot;' . esc_attr($post_id) . '&quot;'; ?>]" readonly/>
            <?php
        }
        if ($rstcp_column == 'rst_doshortcode') {
            ?>
            <textarea readonly cols="40" rows="2" style="background:#ddd;"
                      onClick="this.select(); execCommand('copy');"><?php echo '<?php echo do_shortcode( "[rstpro id=';
                echo "'" . esc_attr($post_id) . "']";
                echo '" ); ?>'; ?></textarea>
            <?php
        }
    }
}
add_action('manage_rst_shortcode_posts_custom_column', 'rst_testimonials_shortcode_clmn_display', 10, 2);


// Register Testimonial Meta Box
if (!function_exists('rst_testimonial_shortcode_register_meta_boxes')) {
    function rst_testimonial_shortcode_register_meta_boxes()
    {
        $attend = array('rst_shortcode');
        add_meta_box(
            'custom_meta_box_id',
            __('Testimonial Settings', 'rst-testimonial'),
            'rst_testimonials_display_post_type_func',
            $attend,
            'normal'
        );
    }
}
add_action('add_meta_boxes', 'rst_testimonial_shortcode_register_meta_boxes');

# Call Back Function...

if (!function_exists('rst_testimonials_display_post_type_func')) {
    function rst_testimonials_display_post_type_func($post, $args)
    {

        #Call get post meta.
        $testimonial_cat_name = get_post_meta($post->ID, 'testimonial_cat_name', true);
        $rst_testimonial_themes = get_post_meta($post->ID, 'rst_testimonial_themes', true);
        $rst_testimonial_theme_style = get_post_meta($post->ID, 'rst_testimonial_theme_style', true);
        $rst_order_by_option = get_post_meta($post->ID, 'rst_order_by_option', true);
        $rst_image_sizes = get_post_meta($post->ID, 'rst_image_sizes', true);
        $dpstotoal_items = get_post_meta($post->ID, 'dpstotoal_items', true);
        $rst_testimonial_textalign = get_post_meta($post->ID, 'rst_testimonial_textalign', true);
        $rst_img_show_hide = get_post_meta($post->ID, 'rst_img_show_hide', true);
        $rst_img_border_radius = get_post_meta($post->ID, 'rst_img_border_radius', true);
        $rst_imgborder_width_option = get_post_meta($post->ID, 'rst_imgborder_width_option', true);
        $rst_imgborder_color_option = get_post_meta($post->ID, 'rst_imgborder_color_option', true);
        $rst_name_color_option = get_post_meta($post->ID, 'rst_name_color_option', true);
        $rst_name_fontsize_option = get_post_meta($post->ID, 'rst_name_fontsize_option', true);
        $rst_name_font_case = get_post_meta($post->ID, 'rst_name_font_case', true);
        $rst_name_font_style = get_post_meta($post->ID, 'rst_name_font_style', true);
        $rst_designation_show_hide = get_post_meta($post->ID, 'rst_designation_show_hide', true);
        $rst_desig_fontsize_option = get_post_meta($post->ID, 'rst_desig_fontsize_option', true);
        $rst_designation_color_option = get_post_meta($post->ID, 'rst_designation_color_option', true);
        $rst_designation_case = get_post_meta($post->ID, 'rst_designation_case', true);
        $rst_designation_font_style = get_post_meta($post->ID, 'rst_designation_font_style', true);
        $rst_content_show_hide = get_post_meta($post->ID, 'rst_content_show_hide', true);
        $rst_content_color = get_post_meta($post->ID, 'rst_content_color', true);
        $rst_content_fontsize_option = get_post_meta($post->ID, 'rst_content_fontsize_option', true);
        $rst_content_bg_color = get_post_meta($post->ID, 'rst_content_bg_color', true);
        $rst_content_padding = get_post_meta($post->ID, 'rst_content_padding', true);
        $rst_content_border_radius = get_post_meta($post->ID, 'rst_content_border_radius', true);
        $rst_company_show_hide = get_post_meta($post->ID, 'rst_company_show_hide', true);
        $rst_company_url_color = get_post_meta($post->ID, 'rst_company_url_color', true);
        $rst_show_rating_option = get_post_meta($post->ID, 'rst_show_rating_option', true);
        $rst_show_item_bg_option = get_post_meta($post->ID, 'rst_show_item_bg_option', true);
        $rst_rating_color = get_post_meta($post->ID, 'rst_rating_color', true);
        $rst_item_bg_color = get_post_meta($post->ID, 'rst_item_bg_color', true);
        $rst_item_padding = get_post_meta($post->ID, 'rst_item_padding', true);
        $rst_item_border_radius = get_post_meta($post->ID, 'rst_item_border_radius', true);
        $rst_item_border_color = get_post_meta($post->ID, 'rst_item_border_color', true);
        $rst_rating_fontsize_option = get_post_meta($post->ID, 'rst_rating_fontsize_option', true);

        #Call get post meta for rst_slider settings.
        $item_no = get_post_meta($post->ID, 'item_no', true);
        $loop = get_post_meta($post->ID, 'loop', true);
        $margin = get_post_meta($post->ID, 'margin', true);
        $navigation = get_post_meta($post->ID, 'navigation', true);
        $pagination = get_post_meta($post->ID, 'pagination', true);
        $autoplay = get_post_meta($post->ID, 'autoplay', true);
        $autoplay_speed = get_post_meta($post->ID, 'autoplay_speed', true);
        $stop_hover = get_post_meta($post->ID, 'stop_hover', true);
        $itemsdesktop = get_post_meta($post->ID, 'itemsdesktop', true);
        $itemsdesktopsmall = get_post_meta($post->ID, 'itemsdesktopsmall', true);
        $itemsmobile = get_post_meta($post->ID, 'itemsmobile', true);
        $autoplaytimeout = get_post_meta($post->ID, 'autoplaytimeout', true);
        $nav_text_color = get_post_meta($post->ID, 'nav_text_color', true);
        $nav_text_color_hover = get_post_meta($post->ID, 'nav_text_color_hover', true);
        $nav_bg_color = get_post_meta($post->ID, 'nav_bg_color', true);
        $nav_bg_color_hover = get_post_meta($post->ID, 'nav_bg_color_hover', true);
        $navigation_align = get_post_meta($post->ID, 'navigation_align', true);
        $navigation_style = get_post_meta($post->ID, 'navigation_style', true);
        $pagination_bg_color = get_post_meta($post->ID, 'pagination_bg_color', true);
        $pagination_bg_color_active = get_post_meta($post->ID, 'pagination_bg_color_active', true);
        $grid_normal_column = get_post_meta($post->ID, 'grid_normal_column', true);
        $filter_menu_styles = get_post_meta($post->ID, 'filter_menu_styles', true);
        $filter_menu_alignment = get_post_meta($post->ID, 'filter_menu_alignment', true);
        $filter_menu_bg_color = get_post_meta($post->ID, 'filter_menu_bg_color', true);
        $filter_menu_bg_color_hover = get_post_meta($post->ID, 'filter_menu_bg_color_hover', true);
        $filter_menu_bg_color_active = get_post_meta($post->ID, 'filter_menu_bg_color_active', true);
        $filter_menu_font_color = get_post_meta($post->ID, 'filter_menu_font_color', true);
        $filter_menu_font_color_hover = get_post_meta($post->ID, 'filter_menu_font_color_hover', true);
        $filter_menu_font_color_active = get_post_meta($post->ID, 'filter_menu_font_color_active', true);
        $pagination_align = get_post_meta($post->ID, 'pagination_align', true);
        $pagination_style = get_post_meta($post->ID, 'pagination_style', true);
        $nav_value = get_post_meta($post->ID, 'nav_value', true);


        $rst_dots = get_post_meta($post->ID, 'dots', true);
        $rst_dots_bg_color = get_post_meta($post->ID, 'dots_bg_color', true);
        $rst_dots_text_color = get_post_meta($post->ID, 'dots_text_color', true);

        $rst_testimonial_theme_style = ($rst_testimonial_theme_style) ? $rst_testimonial_theme_style : 1;
        $grid_normal_column = ($grid_normal_column) ? $grid_normal_column : 3;
        $filter_menu_styles = ($filter_menu_styles) ? $filter_menu_styles : 1;
        $filter_menu_alignment = ($filter_menu_alignment) ? $filter_menu_alignment : 'center';
        $filter_menu_bg_color = ($filter_menu_bg_color) ? $filter_menu_bg_color : '#f8f8f8';
        $filter_menu_bg_color_hover = ($filter_menu_bg_color_hover) ? $filter_menu_bg_color_hover : '#003478';
        $filter_menu_bg_color_active = ($filter_menu_bg_color_active) ? $filter_menu_bg_color_active : '#003478';
        $filter_menu_font_color = ($filter_menu_font_color) ? $filter_menu_font_color : '#777777';
        $filter_menu_font_color_hover = ($filter_menu_font_color_hover) ? $filter_menu_font_color_hover : '#ffffff';
        $filter_menu_font_color_active = ($filter_menu_font_color_active) ? $filter_menu_font_color_active : '#ffffff';
        $nav_text_color_hover = ($nav_text_color_hover) ? $nav_text_color_hover : '#020202';
        $nav_bg_color_hover = ($nav_bg_color_hover) ? $nav_bg_color_hover : '#F43F5E';
        $nav_bg_color = ($nav_bg_color) ? $nav_bg_color : '#f2bccc';
        $pagination_bg_color_active = ($pagination_bg_color_active) ? $pagination_bg_color_active : '#9e9e9e';
        $navigation_style = ($navigation_style) ? $navigation_style : '0';
        $pagination_style = ($pagination_style) ? $pagination_style : '0';


        //declare a nonce field
        wp_nonce_field('rst_short_code_mt_box_action', 'rst_short_code_mt_box_nonce');


        ?>
        <div class="tupsetings post-grid-metabox">

            <!-- <div class="wrap"> -->
            <ul class="tab-nav">
                <li nav="1" class="nav1 <?php if ($nav_value == 1) {
                    echo "active";
                } ?>"><?php _e('Shortcodes', 'rst-testimonial'); ?></li>
                <li nav="2" class="nav2 <?php if ($nav_value == 2) {
                    echo "active";
                } ?>"><?php _e('Testimonial Query ', 'Testimonial-manager-free'); ?></li>
                <li nav="3" class="nav3 <?php if ($nav_value == 3) {
                    echo "active";
                } ?>"><?php _e('General Settings ', 'Testimonial-manager-free'); ?></li>
                <li nav="4" class="nav4 <?php if ($nav_value == 4) {
                    echo "active";
                } ?>"><?php _e('Slider Settings', 'Testimonial-manager-free'); ?></li>

                <li nav="6" class="nav6 <?php if ($nav_value == 6) {
                    echo "active";
                } ?>"><?php _e('Support & Doc', 'Testimonial-manager-free'); ?></li>
            </ul> <!-- tab-nav end -->

            <?php
            $getNavValue = "";
            if (!empty($nav_value)) {
                $getNavValue = $nav_value;
            } else {
                $getNavValue = 1;
            }
            ?>
            <input type="hidden" name="nav_value" id="nav_value" value="<?php echo esc_attr($getNavValue); ?>">


            <ul class="box">
                <!-- Tab 1 -->
                <li style="<?php if ($nav_value == 1) {
                    echo "display: block;";
                } else {
                    echo "display: none;";
                } ?>" class="box1 tab-box <?php if ($nav_value == 1) {
                    echo "active";
                } ?>">
                    <div class="option-box">
                        <p class="option-title"><?php _e('Shortcode', 'Testimonial-manager-free'); ?></p>
                        <p class="rst_option_alert"><?php _e('Use a unique shortcode only one time in same page / post', 'Testimonial-manager-free'); ?></p>
                        <p class="option-info"><?php _e('Copy this shortcode and paste on post, page or text widgets where you want to display Testimonial Showcase.', 'Testimonial-manager-free'); ?></p>
                        <textarea readonly cols="50" rows="1"
                                  onClick="this.select(); execCommand('copy'); ">[rstpro <?php echo 'id="' . esc_attr($post->ID) . '"'; ?>]</textarea>
                        <br/><br/>
                        <p class="option-info"><?php _e('PHP Code:', 'Testimonial-manager-free'); ?></p>
                        <p class="option-info"><?php _e('Use PHP code to your themes file to display Testimonial Showcase.', 'Testimonial-manager-free'); ?></p>
                        <textarea readonly cols="50" rows="2"
                                  onClick="this.select(); execCommand('copy');"><?php echo '<?php echo do_shortcode("[rstpro id=';
                            echo "'" . esc_attr($post->ID) . "']";
                            echo '"); ?>'; ?></textarea>
                    </div>
                </li>
                <!-- Tab 2 -->
                <li style="<?php if ($nav_value == 2) {
                    echo "display: block;";
                } else {
                    echo "display: none;";
                } ?>" class="box2 tab-box <?php if ($nav_value == 2) {
                    echo "active";
                } ?>">
                    <div class="wrap">
                        <div class="option-box">
                            <p class="option-title"><?php _e('Testimonial Query', 'Testimonial-manager-free'); ?></p>
                            <table class="form-table">

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="testimonial_cat_name"><?php _e('Categories', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <ul>
                                            <?php
                                            $args = array(
                                                'taxonomy' => 'rst_testimonial_category',
                                                'orderby' => 'name',
                                                'show_count' => 1,
                                                'pad_counts' => 1,
                                                'hierarchical' => 1,
                                                'echo' => 0
                                            );
                                            $allthecats = get_categories($args);

                                            foreach ($allthecats as $category):
                                                $cat_id = $category->cat_ID;
                                                $checked = (in_array($cat_id, ( array )$testimonial_cat_name) ? ' checked="checked"' : "");
                                                echo '<li id="cat-' . $cat_id . '"><input type="checkbox" name="testimonial_cat_name[]" id="' . $cat_id . '" value="' . $cat_id . '"' . $checked . '> <label for="' . $cat_id . '">' . __($category->cat_name, 'rst-testimonial') . '</label></li>';
                                            endforeach;
                                            ?>
                                        </ul>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Categories Names only show when you publish testimonial under any categories. You can select multiple categories if you want.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Testimonial Categories -->


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_testimonial_themes"><?php _e('Select Theme', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_testimonial_themes" id="rst_testimonial_themes"
                                                class="timezone_string">

                                            <option value="1" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '1');
                                            } ?>><?php _e('Theme 1 (Slider)', 'rst-testimonial') ?></option>

                                            <option value="2" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '2');
                                            } ?>><?php _e('Theme 2 (Slider)', 'rst-testimonial') ?></option>


                                            <option value="3" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '3');
                                            } ?>><?php _e('Theme 3 (Slider)', 'rst-testimonial') ?></option>

                                            <option value="4" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '4');
                                            } ?>><?php _e('Theme 4 (Slider)', 'rst-testimonial') ?></option>

                                            <option value="5" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '5');
                                            } ?>><?php _e('Theme 5 (Grid)', 'rst-testimonial') ?></option>

                                            <option value="6" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '6');
                                            } ?>><?php _e('Theme 6 (Grid)', 'rst-testimonial') ?></option>


                                            <option value="7" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '7');
                                            } ?>><?php _e('Theme 7 (Grid)', 'rst-testimonial') ?></option>

                                            <option value="8" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '8');
                                            } ?>><?php _e('Theme 8 (Grid)', 'rst-testimonial') ?></option>


                                            <option value="9" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '9');
                                            } ?>><?php _e('Theme 9 - Pro', 'rst-testimonial') ?></option>

                                            <option value="10" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '10');
                                            } ?>><?php _e('Theme 10 - Pro', 'rst-testimonial') ?></option>


                                            <option value="11" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '11');
                                            } ?>><?php _e('Theme 11 - Pro', 'rst-testimonial') ?></option>

                                            <option value="12" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '12');
                                            } ?>><?php _e('Theme 12 - Pro', 'rst-testimonial') ?></option>

                                            <option value="13" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '13');
                                            } ?>><?php _e('Theme 13 - Pro', 'rst-testimonial') ?></option>

                                            <option value="14" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '14');
                                            } ?>><?php _e('Theme 14 - Pro', 'rst-testimonial') ?></option>

                                            <option value="15" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '15');
                                            } ?>><?php _e('Theme 15 - Pro', 'rst-testimonial') ?></option>

                                            <option value="16" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '16');
                                            } ?>><?php _e('Theme 16 - Pro', 'rst-testimonial') ?></option>

                                            <option value="17" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '17');
                                            } ?>><?php _e('Theme 17 - Pro', 'rst-testimonial') ?></option>

                                            <option value="18" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '18');
                                            } ?>><?php _e('Theme 18 - Pro', 'rst-testimonial') ?></option>

                                            <option value="19" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '19');
                                            } ?>><?php _e('Theme 19 - Pro', 'rst-testimonial') ?></option>

                                            <option value="20" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '20');
                                            } ?>><?php _e('Theme 20 - Pro', 'rst-testimonial') ?></option>

                                        </select>

                                        <div id="rst_imagePreview" style="display: none;">
                                            <img src="" alt="screenshot" class="rst_testimonial_themes_img"/>

                                        </div>

                                        <span class="rststestimonial_manager_hint"><?php echo __('Select a theme to display testimonials.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Testimonial Themes -->


                                <script type="text/javascript">
                                    ;(function ($) {
                                        $(document).ready(function () {
                                            $('#rst_testimonial_themes').on('change', function () {
                                                var theme = $(this).val();

                                                if (theme == 1) {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo plugin_dir_url(__FILE__) . 'templates/screenshots/theme-1.png'; ?>');
                                                } else if (theme == 2) {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo plugin_dir_url(__FILE__) . 'templates/screenshots/theme-2.png'; ?>');
                                                } else if (theme == 3) {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo plugin_dir_url(__FILE__) . 'templates/screenshots/theme-3.png'; ?>');
                                                } else if (theme == 4) {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo plugin_dir_url(__FILE__) . 'templates/screenshots/theme-4.png'; ?>');
                                                } else if (theme == 5) {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo plugin_dir_url(__FILE__) . 'templates/screenshots/theme-5.png'; ?>');
                                                } else if (theme == 6) {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo plugin_dir_url(__FILE__) . 'templates/screenshots/theme-6.png'; ?>');
                                                } else if (theme == 7) {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo plugin_dir_url(__FILE__) . 'templates/screenshots/theme-7.png'; ?>');
                                                } else if (theme == 8) {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo plugin_dir_url(__FILE__) . 'templates/screenshots/theme-8.png'; ?>');
                                                } else {
                                                    $('#rst_imagePreview').hide();
                                                }

                                            });
                                        });
                                    })(jQuery);

                                </script>


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="dpstotoal_items"><?php _e('Display Total Items', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="number" name="dpstotoal_items" id="dpstotoal_items" maxlength="4"
                                               class="timezone_string" value="<?php if ($dpstotoal_items != '') {
                                            echo esc_attr($dpstotoal_items);
                                        } else {
                                            echo '12';
                                        } ?>">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose maximum number of items you want to display'); ?></span>
                                    </td>
                                </tr><!-- End Order By -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_order_by_option"><?php _e('Order By', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_order_by_option" id="rst_order_by_option"
                                                class="timezone_string">
                                            <option value="title" <?php if (isset ($rst_order_by_option)) {
                                                selected($rst_order_by_option, 'title');
                                            } ?>><?php _e('Title', 'rst-testimonial') ?></option>
                                            <option value="modified" <?php if (isset ($rst_order_by_option)) {
                                                selected($rst_order_by_option, 'modified');
                                            } ?>><?php _e('Modified', 'rst-testimonial') ?></option>
                                            <option value="rand" <?php if (isset ($rst_order_by_option)) {
                                                selected($rst_order_by_option, 'rand');
                                            } ?>><?php _e('Rand', 'rst-testimonial') ?></option>
                                            <option value="comment_count" <?php if (isset ($rst_order_by_option)) {
                                                selected($rst_order_by_option, 'comment_count');
                                            } ?>><?php _e('Popularity', 'rst-testimonial'); ?></option>
                                        </select>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Order testimonials By (Title, Modified, Random or Popularity).', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Order By -->

                                <tr>
                                    <th>
                                        <label for="rst_image_sizes"><?php _e('Image Sizes', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_image_sizes" id="rst_image_sizes" class="rst_image_sizes">
                                            <option value="thumbnail" <?php if (isset ($rst_image_sizes)) {
                                                selected($rst_image_sizes, 'thumbnail');
                                            } ?>><?php _e('Thumbnail', 'rst-testimonial') ?></option>
                                            <option value="medium" <?php if (isset ($rst_image_sizes)) {
                                                selected($rst_image_sizes, 'medium');
                                            } ?>><?php _e('Medium', 'rst-testimonial') ?></option>
                                            <option value="medium_large" <?php if (isset ($rst_image_sizes)) {
                                                selected($rst_image_sizes, 'medium_large');
                                            } ?>><?php _e('Medium large', 'rst-testimonial') ?></option>
                                            <option value="large" <?php if (isset ($rst_image_sizes)) {
                                                selected($rst_image_sizes, 'large');
                                            } ?>><?php _e('Large', 'rst-testimonial') ?></option>
                                            <option value="full" <?php if (isset ($rst_image_sizes)) {
                                                selected($rst_image_sizes, 'full');
                                            } ?>><?php _e('Full', 'rst-testimonial') ?></option>
                                        </select>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose an image size to display perfectly', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Image Size -->

                            </table>
                        </div>
                    </div>
                </li>


                <!-- Tab 3  General Settings Start Here-->


                <li style="<?php if ($nav_value == 3) {
                    echo "display: block;";
                } else {
                    echo "display: none;";
                } ?>" class="box3 tab-box <?php if ($nav_value == 3) {
                    echo "active";
                } ?>">
                    <div class="wrap">
                        <div class="option-box">
                            <p class="option-title"><?php _e('General Settings', 'rst-testimonial'); ?></p>
                            <table class="form-table">

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_testimonial_textalign"><?php _e('Text Align', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="radio-three" name="rst_testimonial_textalign"
                                                   value="left" <?php if ($rst_testimonial_textalign == 'left') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="radio-three"><?php _e('Left', 'rst-testimonial'); ?><span
                                                        class="mark"><?php _e('Pro', 'logoshowcase'); ?></span></label>
                                            <input type="radio" id="radio-four" name="rst_testimonial_textalign"
                                                   value="center" <?php if ($rst_testimonial_textalign == 'center') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="radio-four"><?php _e('Center', 'rst-testimonial'); ?></label>
                                            <input type="radio" id="radio-five" name="rst_testimonial_textalign"
                                                   value="right" <?php if ($rst_testimonial_textalign == 'right') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="radio-five"><?php _e('Right', 'rst-testimonial'); ?><span
                                                        class="mark"><?php _e('Pro', 'logoshowcase'); ?></span></label>
                                        </div>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose an option for the alignment of testimonials content.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Text Align -->

                                <!--=====================Name Area Start======================-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php _e('Name Settings Area', 'rst-testimonial') ?></label>
                                        <hr/>
                                    </th>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_name_color_option"><?php _e('Name Font Color', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_name_color_option" name="rst_name_color_option"
                                               value="<?php if ($rst_name_color_option != '') {
                                                   echo esc_attr($rst_name_color_option);
                                               } else {
                                                   echo "#020202";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for testimonial givers name.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Name Color -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_name_fontsize_option"><?php _e('Name Font Size', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="number" name="rst_name_fontsize_option"
                                               id="rst_name_fontsize_option"
                                               min="10" max="45" class="timezone_string" required
                                               value="<?php if ($rst_name_fontsize_option != '') {
                                                   echo esc_attr($rst_name_fontsize_option);
                                               } else {
                                                   echo '20';
                                               } ?>"> <br/>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose a font size for testimonial name.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Name Font Size-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_name_font_case"><?php _e('Name Text Transform', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_name_font_case" id="rst_name_font_case"
                                                class="timezone_string">
                                            <option value="none" <?php if (isset ($rst_name_font_case)) {
                                                selected($rst_name_font_case, 'none');
                                            } ?>><?php _e('Default', 'rst-testimonial') ?></option>
                                            <option value="capitalize" <?php if (isset ($rst_name_font_case)) {
                                                selected($rst_name_font_case, 'capitalize');
                                            } ?>><?php _e('Capitalize', 'rst-testimonial') ?></option>
                                            <option value="lowercase" <?php if (isset ($rst_name_font_case)) {
                                                selected($rst_name_font_case, 'lowercase');
                                            } ?>><?php _e('Lowercase', 'rst-testimonial') ?></option>
                                            <option value="uppercase" <?php if (isset ($rst_name_font_case)) {
                                                selected($rst_name_font_case, 'uppercase');
                                            } ?>><?php _e('Uppercase', 'rst-testimonial') ?></option>
                                        </select><br>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Select Name Text Transform', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End name text Transform -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_name_font_style"><?php _e('Name Text Style', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_name_font_style" id="rst_name_font_style"
                                                class="timezone_string">
                                            <option value="normal" <?php if (isset ($rst_name_font_style)) {
                                                selected($rst_name_font_style, 'normal');
                                            } ?>><?php _e('Default', 'rst-testimonial') ?></option>
                                            <option value="italic" <?php if (isset ($rst_name_font_style)) {
                                                selected($rst_name_font_style, 'italic');
                                            } ?>><?php _e('Italic', 'rst-testimonial') ?></option>
                                        </select><br>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Select Name Text style', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr> <!-- End name text style -->


                                <!--=====================Name Area End======================-->


                                <!--=====================Image Area Start======================-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php _e('Image Settings Area', 'rst-testimonial') ?></label>
                                        <hr/>
                                    </th>
                                </tr>


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_img_show_hide"><?php _e('Image Option', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="rst_img_show" name="rst_img_show_hide"
                                                   value="1" <?php if ($rst_img_show_hide == 1 || $rst_img_show_hide == '') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="rst_img_show"><?php _e('Show', 'rst-testimonial'); ?></label>
                                            <input type="radio" id="rst_img_hide" name="rst_img_show_hide"
                                                   value="2" <?php if ($rst_img_show_hide == 2) {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="rst_img_hide"><?php _e('Hide', 'rst-testimonial'); ?><span
                                                        class="mark"><?php _e('Pro', 'logoshowcase'); ?></span></label>
                                        </div>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose one option whether you want to show or hide the image of testimonial giver.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Image -->

                                <tr valign="top" id="imgBorderController" style="<?php if ($rst_img_show_hide == 2) {
                                    echo "display:none;";
                                } ?>">
                                    <th scope="row">
                                        <label for="rst_imgborder_width_option"><?php _e('Image Border Width', 'rst-testimonial') ?></label>
                                    </th>
                                    <td>
                                        <input type="number" name="rst_imgborder_width_option" min="0" max="10"
                                               value="<?php if ($rst_imgborder_width_option != '') {
                                                   echo esc_attr($rst_imgborder_width_option);
                                               } else {
                                                   echo 1;
                                               } ?>">
                                    </td>
                                </tr> <!-- End of image border width -->

                                <tr valign="top" id="imgColor_controller" style="<?php if ($rst_img_show_hide == 2) {
                                    echo "display:none;";
                                } ?>">
                                    <th scope="row">
                                        <label for="rst_imgborder_color_option"><?php _e('Image Border Color', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_imgborder_color_option"
                                               name="rst_imgborder_color_option"
                                               value="<?php if ($rst_imgborder_color_option != '') {
                                                   echo esc_attr($rst_imgborder_color_option);
                                               } else {
                                                   echo "transparent";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for image border.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Name Color -->

                                <tr valign="top" id="imgRadius_controller" style="<?php if ($rst_img_show_hide == 2) {
                                    echo "display:none;";
                                } ?>">
                                    <th scope="row">
                                        <label for="rst_testimonial_textalign"><?php _e('Image Border Radius', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_img_border_radius" id="rst_img_border_radius"
                                                class="timezone_string">

                                            <option value="50%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '100%');
                                            } ?>><?php _e('100%', 'rst-testimonial') ?></option>


                                            <option value="0%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '0%');
                                            } ?>><?php _e('0%', 'rst-testimonial') ?></option>


                                            <option value="10%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '10%');
                                            } ?>><?php _e('10%', 'rst-testimonial') ?></option>
                                            <option value="15%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '15%');
                                            } ?>><?php _e('15%', 'rst-testimonial') ?></option>
                                            <option value="20%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '20%');
                                            } ?>><?php _e('20%', 'rst-testimonial') ?></option>
                                            <option value="25%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '25%');
                                            } ?>><?php _e('25%', 'rst-testimonial') ?></option>
                                            <option value="30%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '30%');
                                            } ?>><?php _e('30%', 'rst-testimonial') ?></option>
                                            <option value="40%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '40%');
                                            } ?>><?php _e('40%', 'rst-testimonial') ?></option>

                                            <option value="50%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '50%');
                                            } ?>><?php _e('50%', 'rst-testimonial') ?></option>

                                            <option value="80%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '80%');
                                            } ?>><?php _e('80%', 'rst-testimonial') ?></option>


                                        </select>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Select an option for border radius of the images.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Border Radius -->

                                <!--=====================Image Area End======================-->


                                <!--=====================Designation Area Start======================-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php _e('Designation Settings Area', 'rst-testimonial') ?></label>
                                        <hr/>
                                    </th>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_show_hide"><?php _e('Designation Option', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="rst_designation_show"
                                                   name="rst_designation_show_hide"
                                                   value="1" <?php if ($rst_designation_show_hide == 1 || $rst_designation_show_hide == '') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="rst_designation_show"><?php _e('Show', 'rst-testimonial'); ?></label>
                                            <input type="radio" id="rst_designation_hide"
                                                   name="rst_designation_show_hide"
                                                   value="2" <?php if ($rst_designation_show_hide == 2) {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="rst_designation_hide"><?php _e('Hide', 'rst-testimonial'); ?>
                                                <span class="mark"><?php _e('Pro', 'logoshowcase'); ?></span></label>
                                        </div>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose one option whether you want to show or hide the designation of testimonial giver.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <tr valign="top" id="desig_size_controller"
                                    style="<?php if ($rst_designation_show_hide == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_desig_fontsize_option"><?php _e('Designation Font Size', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="number" name="rst_desig_fontsize_option"
                                               id="rst_desig_fontsize_option"
                                               min="10" max="45" class="timezone_string" required
                                               value="<?php if ($rst_desig_fontsize_option != '') {
                                                   echo esc_attr($rst_desig_fontsize_option);
                                               } else {
                                                   echo '16';
                                               } ?>"> <br/>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose a font size for testimonial designation.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>


                                <!-- End Designation Font Size-->

                                <tr valign="top" id="desig_color_controller"
                                    style="<?php if ($rst_designation_show_hide == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_designation_color_option"><?php _e('Designation Font Color', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_designation_color_option"
                                               name="rst_designation_color_option"
                                               value="<?php if ($rst_designation_color_option != '') {
                                                   echo esc_attr($rst_designation_color_option);
                                               } else {
                                                   echo "#666666";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for testimonial givers designation.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>


                                <!-- End Designation Font Color -->

                                <tr id="desig_text_trans_controller" valign="top"
                                    style="<?php if ($rst_designation_show_hide == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_designation_case"><?php _e('Designation Text Transform', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_designation_case" id="rst_designation_case"
                                                class="timezone_string">
                                            <option value="none" <?php if (isset ($rst_designation_case)) {
                                                selected($rst_designation_case, 'none');
                                            } ?>><?php _e('Default', 'rst-testimonial') ?></option>
                                            <option value="capitalize" <?php if (isset ($rst_designation_case)) {
                                                selected($rst_designation_case, 'capitalize');
                                            } ?>><?php _e('Capitalize', 'rst-testimonial') ?></option>
                                            <option value="lowercase" <?php if (isset ($rst_designation_case)) {
                                                selected($rst_designation_case, 'lowercase');
                                            } ?>><?php _e('Lowercase', 'rst-testimonial') ?></option>
                                            <option value="uppercase" <?php if (isset ($rst_designation_case)) {
                                                selected($rst_designation_case, 'uppercase');
                                            } ?>><?php _e('Uppercase', 'rst-testimonial') ?></option>
                                        </select><br>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Select Designation Text Transform', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>


                                <!-- End name text Transform -->

                                <tr valign="top" id="desig_text_style_controller"
                                    style="<?php if ($rst_designation_show_hide == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_designation_font_style"><?php _e('Designation Text Style', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_designation_font_style" id="rst_designation_font_style"
                                                class="timezone_string">
                                            <option value="normal" <?php if (isset ($rst_designation_font_style)) {
                                                selected($rst_designation_font_style, 'normal');
                                            } ?>><?php _e('Default', 'rst-testimonial') ?></option>
                                            <option value="italic" <?php if (isset ($rst_designation_font_style)) {
                                                selected($rst_designation_font_style, 'italic');
                                            } ?>><?php _e('Italic', 'rst-testimonial') ?></option>
                                        </select><br>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Select Designation Text style', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr> <!-- End name text style -->


                                <!--=====================Designation Area End======================-->

                                <!--=====================Company Area Start======================-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php _e('Company Settings Area', 'rst-testimonial') ?></label>
                                        <hr/>
                                    </th>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_company_show_hide"><?php _e('Company URL Option', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="rst_company_show" name="rst_company_show_hide"
                                                   value="1" <?php if ($rst_company_show_hide == 1 || $rst_company_show_hide == '') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="rst_company_show"><?php _e('Show', 'rst-testimonial'); ?></label>
                                            <input type="radio" id="rst_company_hide" name="rst_company_show_hide"
                                                   value="2" <?php if ($rst_company_show_hide == 2) {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="rst_company_hide"><?php _e('Hide', 'rst-testimonial'); ?><span
                                                        class="mark"><?php _e('Pro', 'logoshowcase'); ?></span></label>
                                        </div>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose one option whether you want to show or hide the company name and URL of testimonial giver.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Company Profiles Show/Hide -->

                                <tr valign="top" id="url_controller" style="<?php if ($rst_company_show_hide == 2) {
                                    echo "display:none;";
                                } ?>">
                                    <th scope="row">
                                        <label for="rst_company_url_color"><?php _e('Company URL Color', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_company_url_color" name="rst_company_url_color"
                                               value="<?php if ($rst_company_url_color != '') {
                                                   echo esc_attr($rst_company_url_color);
                                               } else {
                                                   echo "#666666";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for testimonial givers company name.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>
                                <!-- End Url  Color -->


                                <!--=====================Company Area Start======================-->


                                <!--=====================Content Area Start======================-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php _e('Content Settings Area', 'rst-testimonial') ?></label>
                                        <hr/>
                                    </th>
                                </tr>


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_content_show_hide"><?php _e('Content Option', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="rst_content_show" name="rst_content_show_hide"
                                                   value="1" <?php if ($rst_content_show_hide == 1 || $rst_content_show_hide == '') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="rst_content_show"><?php _e('Show', 'rst-testimonial'); ?></label>
                                            <input type="radio" id="rst_content_hide" name="rst_content_show_hide"
                                                   value="2" <?php if ($rst_content_show_hide == 2) {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="rst_content_hide"><?php _e('Hide', 'rst-testimonial'); ?>
                                                <span class="mark"><?php _e('Pro', 'logoshowcase'); ?></span></label>
                                        </div>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose one option whether you want to show or hide the designation of testimonial giver.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>


                                <tr valign="top" id="content_color_controller"
                                    style="<?php if ($rst_content_show_hide == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_content_color"><?php _e('Content Font Color', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_content_color" name="rst_content_color"
                                               value="<?php if ($rst_content_color != '') {
                                                   echo esc_attr($rst_content_color);
                                               } else {
                                                   echo "#000000";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for testimonial message.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Content Color -->

                                <tr valign="top" id="content_font_controller"
                                    style="<?php if ($rst_content_show_hide == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_content_fontsize_option"><?php _e('Content Font Size', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="number" name="rst_content_fontsize_option"
                                               id="rst_content_fontsize_option" min="10" max="45"
                                               class="timezone_string"
                                               required value="<?php if ($rst_content_fontsize_option != '') {
                                            echo esc_attr($rst_content_fontsize_option);
                                        } else {
                                            echo '16';
                                        } ?>"> <br/>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose a font size for testimonial message.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Content Font Size-->

                                <tr valign="top" id="content_bg_color_controller"
                                    style="<?php if ($rst_content_show_hide == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_content_bg_color"><?php _e('Content Background Color', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_content_bg_color" name="rst_content_bg_color"
                                               value="<?php if ($rst_content_bg_color != '') {
                                                   echo esc_attr($rst_content_bg_color);
                                               } else {
                                                   echo "transparent";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for content background.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <tr valign="top" id="content_padding_controller"
                                    style="<?php if ($rst_content_show_hide == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_content_padding"><?php _e('Content Padding', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_content_padding" id="rst_content_padding"
                                                class="timezone_string">

                                            <option value="5" <?php if (isset ($rst_content_padding)) {
                                                selected($rst_content_padding, '5');
                                            } ?>><?php _e('5px', 'rst-testimonial') ?></option>

                                            <option value="10" <?php if (isset ($rst_content_padding)) {
                                                selected($rst_content_padding, '10');
                                            } ?>><?php _e('10px', 'rst-testimonial') ?></option>

                                            <option value="20" <?php if (isset ($rst_content_padding)) {
                                                selected($rst_content_padding, '20');
                                            } ?>><?php _e('20px', 'rst-testimonial') ?></option>

                                        </select>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Select an option for content padding.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>
                                <!-- End Content Background Color -->

                                <tr valign="top" id="rst_content_border_radius_controller"
                                    style="<?php if ($rst_content_show_hide == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_content_border_radius"><?php _e('Content Border Radius', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_content_border_radius" id="rst_content_border_radius"
                                                class="timezone_string">


                                            <option value="0%" <?php if (isset ($rst_content_border_radius)) {
                                                selected($rst_content_border_radius, '0%');
                                            } ?>><?php _e('Default', 'rst-testimonial') ?></option>

                                            <option value="1%" <?php if (isset ($rst_content_border_radius)) {
                                                selected($rst_content_border_radius, '1%');
                                            } ?>><?php _e('1%', 'rst-testimonial') ?></option>

                                            <option value="2%" <?php if (isset ($rst_content_border_radius)) {
                                                selected($rst_content_border_radius, '2%');
                                            } ?>><?php _e('2%', 'rst-testimonial') ?></option>

                                            <option value="3%" <?php if (isset ($rst_content_border_radius)) {
                                                selected($rst_content_border_radius, '3%');
                                            } ?>><?php _e('3%', 'rst-testimonial') ?></option>

                                        </select>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Select an option for border radius of the content.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <!--=====================Content Area End======================-->


                                <!--=====================Ratting Area Start======================-->


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php _e('Rating Settings Area', 'rst-testimonial') ?></label>
                                        <hr/>
                                    </th>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_show_rating_option"><?php _e('Rating Option', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="rst_show_rating_option"
                                                   name="rst_show_rating_option"
                                                   value="1" <?php if ($rst_show_rating_option == 1 || $rst_show_rating_option == '') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="rst_show_rating_option"><?php _e('Show', 'rst-testimonial'); ?></label>
                                            <input type="radio" id="rst_hide_rating_option"
                                                   name="rst_show_rating_option"
                                                   value="2" <?php if ($rst_show_rating_option == 2) {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="rst_hide_rating_option"><?php _e('Hide', 'rst-testimonial'); ?>
                                                <span class="mark"><?php _e('Pro', 'logoshowcase'); ?></span></label>
                                        </div>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose one option whether you want to show or hide the rating of testimonial giver.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Rating -->

                                <tr valign="top" id="rating_controller" style="<?php if ($rst_show_rating_option == 2) {
                                    echo "display:none;";
                                } ?>">
                                    <th scope="row">
                                        <label for="rst_rating_color"><?php _e('Rating Icon Color', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_rating_color" name="rst_rating_color"
                                               value="<?php if ($rst_rating_color != '') {
                                                   echo esc_attr($rst_rating_color);
                                               } else {
                                                   echo "#ffa900";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for testimonial ratings.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Rating Color -->

                                <tr valign="top" id="rating_size_controller"
                                    style="<?php if ($rst_show_rating_option == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_rating_fontsize_option"><?php _e('Rating Font Size', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="number" name="rst_rating_fontsize_option"
                                               id="rst_rating_fontsize_option" min="10" max="45" class="timezone_string"
                                               required value="<?php if ($rst_rating_fontsize_option != '') {
                                            echo esc_attr($rst_rating_fontsize_option);
                                        } else {
                                            echo '16';
                                        } ?>"> <br/>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose a font size for testimonial ratings.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Content Font Size-->


                                <!--=====================Ratting Area End======================-->


                                <!--=====================Item Background Area Start======================-->


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_background"
                                               class="rst_area_info"><?php _e('Item Background Settings Area', 'rst-testimonial') ?></label>
                                        <hr/>
                                    </th>
                                </tr>


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_show_item_bg_option"><?php _e('Item Background', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="rst_show_item_bg_option"
                                                   name="rst_show_item_bg_option"
                                                   value="1" <?php if ($rst_show_item_bg_option == 1 || $rst_show_item_bg_option == '') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="rst_show_item_bg_option"><?php _e('Show', 'rst-testimonial'); ?></label>
                                            <input type="radio" id="rst_hide_item_bg_option"
                                                   name="rst_show_item_bg_option"
                                                   value="2" <?php if ($rst_show_item_bg_option == 2) {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="rst_hide_item_bg_option"><?php _e('Hide', 'rst-testimonial'); ?></label>
                                        </div>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose one option whether you want to show or hide background color for an item.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Item Background Color -->

                                <tr valign="top" id="item_backg_color_controller"
                                    style="<?php if ($rst_show_item_bg_option == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_item_bg_color"><?php _e('Background Color', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_item_bg_color" name="rst_item_bg_color"
                                               value="<?php if ($rst_item_bg_color != '') {
                                                   echo esc_attr($rst_item_bg_color);
                                               } else {
                                                   echo "transparent";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for item background.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Item Background Color -->

                                <tr valign="top" id="item_padding_controller"
                                    style="<?php if ($rst_show_item_bg_option == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_item_padding"><?php _e('Item Padding', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_item_padding" id="rst_item_padding"
                                                class="timezone_string">

                                            <option value="10" <?php if (isset ($rst_item_padding)) {
                                                selected($rst_item_padding, '10');
                                            } ?>><?php _e('10px', 'rst-testimonial') ?></option>

                                            <option value="20" <?php if (isset ($rst_item_padding)) {
                                                selected($rst_item_padding, '20');
                                            } ?>><?php _e('20px', 'rst-testimonial') ?></option>

                                            <option value="30" <?php if (isset ($rst_item_padding)) {
                                                selected($rst_item_padding, '30');
                                            } ?>><?php _e('30px', 'rst-testimonial') ?></option>

                                        </select>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Select Padding for items.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Item Padding -->

                                <tr valign="top" id="rst_item_border_radius_controller"
                                    style="<?php if ($rst_show_item_bg_option == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_item_border_radius"><?php _e('Item Border Radius', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_item_border_radius" id="rst_item_border_radius"
                                                class="timezone_string">


                                            <option value="0%" <?php if (isset ($rst_item_border_radius)) {
                                                selected($rst_item_border_radius, '0%');
                                            } ?>><?php _e('Default', 'rst-testimonial') ?></option>

                                            <option value="1%" <?php if (isset ($rst_item_border_radius)) {
                                                selected($rst_item_border_radius, '1%');
                                            } ?>><?php _e('1%', 'rst-testimonial') ?></option>

                                            <option value="2%" <?php if (isset ($rst_item_border_radius)) {
                                                selected($rst_item_border_radius, '2%');
                                            } ?>><?php _e('2%', 'rst-testimonial') ?></option>

                                            <option value="3%" <?php if (isset ($rst_item_border_radius)) {
                                                selected($rst_item_border_radius, '3%');
                                            } ?>><?php _e('3%', 'rst-testimonial') ?></option>

                                        </select>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Select an option for border radius of the Item.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>


                                <tr valign="top" id="item_border_color_controller"
                                    style="<?php if ($rst_show_item_bg_option == 2) {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_item_border_color"><?php _e('Border Color', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_item_border_color" name="rst_item_border_color"
                                               value="<?php if ($rst_item_border_color != '') {
                                                   echo esc_attr($rst_item_border_color);
                                               } else {
                                                   echo "#E8E8E8";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for item border.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </li>
                <!-- Tab 4 -->
                <li style="<?php if ($nav_value == 4) {
                    echo "display: block;";
                } else {
                    echo "display: none;";
                } ?>" class="box4 tab-box <?php if ($nav_value == 4) {
                    echo "active";
                } ?>">
                    <div class="wrap">
                        <div class="option-box">
                            <p class="option-title"><?php _e('Slider Settings', 'rst-testimonial'); ?></p>
                            <table class="form-table">
                                <tr valign="top">
                                    <th scope="row">
                                        <label for="autoplay"><?php _e('Autoplay', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="autoplay_true" name="autoplay"
                                                   value="true" <?php if ($autoplay == 'true' || $autoplay == '') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="autoplay_true"><?php _e('Yes', 'rst-testimonial'); ?></label>
                                            <input type="radio" id="autoplay_false" name="autoplay"
                                                   value="false" <?php if ($autoplay == 'false') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="autoplay_false"><?php _e('No', 'rst-testimonial'); ?></label>
                                        </div>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose an option whether you want the rst_slider autoplay or not.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr> <!-- End Autoplay -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="autoplay_speed"><?php _e('Slide Delay', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;" class="auto_play">

                                        <input type="range" step="100" min="100" max="5000"
                                               value="<?php if ($autoplay_speed != '') {
                                                   echo esc_attr($autoplay_speed);
                                               } else {
                                                   echo '700';
                                               } ?>" class="slider" id="myRange"><br>
                                        <input size="5" type="text" name="autoplay_speed" id="autoplay_speed"
                                               maxlength="4"
                                               class="timezone_string" readonly
                                               value="<?php if ($autoplay_speed != '') {
                                                   echo esc_attr($autoplay_speed);
                                               } else {
                                                   echo '700';
                                               } ?>">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Select a value for sliding speed.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr> <!-- End Slide Delay -->


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="item_no"><?php _e('Items No', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="item_no" id="item_no" class="timezone_string">
                                            <option value="3" <?php if (isset ($item_no)) {
                                                selected($item_no, '3');
                                            } ?>><?php _e('3', 'rst-testimonial') ?></option>
                                            <option value="1" <?php if (isset ($item_no)) {
                                                selected($item_no, '1');
                                            } ?>><?php _e('1', 'rst-testimonial') ?></option>
                                            <option value="2" <?php if (isset ($item_no)) {
                                                selected($item_no, '2');
                                            } ?>><?php _e('2', 'rst-testimonial') ?></option>
                                            <option value="4" <?php if (isset ($item_no)) {
                                                selected($item_no, '4');
                                            } ?>><?php _e('4', 'rst-testimonial') ?></option>
                                            <option value="5" <?php if (isset ($item_no)) {
                                                selected($item_no, '5');
                                            } ?>><?php _e('5', 'rst-testimonial') ?></option>

                                        </select>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Select number of items you want to show.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr> <!-- End Items No -->


                                <!--DOTS AREA SETTINGS START-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php _e('Dots Settings Area', 'rst-testimonial') ?></label>
                                        <hr/>
                                    </th>
                                </tr>


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="dots"><?php _e('Dots', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="dots_true" name="dots"
                                                   value="true" <?php if ($rst_dots == 'true' || $rst_dots == '') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="dots_true"><?php _e('Yes', 'rst-testimonial'); ?></label>
                                            <input type="radio" id="dots_false" name="dots"
                                                   value="false" <?php if ($rst_dots == 'false') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="dots_false"><?php _e('No', 'rst-testimonial'); ?><span
                                                        class="mark"><?php _e('Pro', 'logoshowcase'); ?></span></label>
                                        </div>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose an option whether you want dots option or not.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>


                                <tr valign="top" id="dots_color_controller" style="<?php if ($rst_dots == 'false') {
                                    echo "display:none;";
                                } ?>">
                                    <th scope="row">
                                        <label for="dots_text_color"><?php _e('Inactive Dots Color', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="dots_text_color" size="5" type="text"
                                               name="dots_text_color"
                                               value="<?php if ($rst_dots_text_color != '') {
                                                   echo esc_attr($rst_dots_text_color);
                                               } else {
                                                   echo "#f2bccc";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for Inactive Dots.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>


                                <tr valign="top" id="dots_bgcolor_controller" style="<?php if ($rst_dots == 'false') {
                                    echo "display:none;";
                                } ?>">
                                    <th scope="row">
                                        <label for="dots_bg_color"><?php _e('Active Dot Color', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input id="dots_bg_color" type="text" name="dots_bg_color"
                                               value="<?php if ($rst_dots_bg_color != '') {
                                                   echo esc_attr($rst_dots_bg_color);
                                               } else {
                                                   echo "#e45a7e";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for Active dots.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <!--DOTS AREA SETTINGS END-->


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php _e('Navigation Settings Area', 'rst-testimonial') ?></label>
                                        <hr/>
                                    </th>
                                </tr>


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="navigation"><?php _e('Navigation', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="navigation_true" name="navigation"
                                                   value="true" <?php if ($navigation == 'true' || $navigation == '') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="navigation_true"><?php _e('Yes', 'rst-testimonial'); ?></label>
                                            <input type="radio" id="navigation_false" name="navigation"
                                                   value="false" <?php if ($navigation == 'false') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="navigation_false"><?php _e('No', 'rst-testimonial'); ?><span
                                                        class="mark"><?php _e('Pro', 'logoshowcase'); ?></span></label>
                                        </div>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose an option whether you want navigation option or not.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>
                                <!-- End Navigation -->


                                <tr valign="top" id="navi_color_controller" style="<?php if ($navigation == 'false') {
                                    echo "display:none;";
                                } ?>">
                                    <th scope="row">
                                        <label for="nav_text_color"><?php _e('Navigation Color', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="nav_text_color" size="5" type="text"
                                               name="nav_text_color"
                                               value="<?php if ($nav_text_color != '') {
                                                   echo esc_attr($nav_text_color);
                                               } else {
                                                   echo "#E8E8E8";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for navigation tool.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>
                                <!-- End Navigation Color -->

                                <tr valign="top" id="navi_bgcolor_controller" style="<?php if ($navigation == 'false') {
                                    echo "display:none;";
                                } ?>">
                                    <th scope="row">
                                        <label for="nav_bg_color"><?php _e('Navigation Background', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input id="nav_bg_color" type="text" name="nav_bg_color"
                                               value="<?php if ($nav_bg_color != '') {
                                                   echo esc_attr($nav_bg_color);
                                               } else {
                                                   echo "#f2bccc";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for background of navigation tool.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>
                                <!-- End Navigation Background Color -->


                                <tr valign="top" id="navi_bgcolor_hover_controller"
                                    style="<?php if ($navigation == 'false') {
                                        echo "display:none;";
                                    } ?>">
                                    <th scope="row">
                                        <label for="nav_bg_color_hover"><?php _e('Navigation Hover Background', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input id="nav_bg_color_hover" type="text" name="nav_bg_color_hover"
                                               value="<?php if ($nav_bg_color_hover != '') {
                                                   echo esc_attr($nav_bg_color_hover);
                                               } else {
                                                   echo "#F43F5E";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for background of navigation tool in hover.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>
                                <!-- End Navigation Background Color -->


                            </table>
                        </div>
                    </div>
                </li>
                <!-- Tab 5 -->
                <li style="<?php if ($nav_value == 5) {
                    echo "display: block;";
                } else {
                    echo "display: none;";
                } ?>" class="box5 tab-box <?php if ($nav_value == 5) {
                    echo "active";
                } ?>">
                    <div class="wrap">
                        <div class="option-box">
                            <p class="option-title"><?php _e('Grid Normal Settings ( Premium Only )', 'rst-testimonial'); ?></p>
                            <table class="form-table">
                                <tr valign="top">
                                    <th scope="row">
                                        <label for="grid_normal_column"><?php _e('Number of columns', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="grid_normal_column" id="grid_normal_column"
                                                class="timezone_string">
                                            <option value="3" <?php if (isset ($grid_normal_column)) {
                                                selected($grid_normal_column, '3');
                                            } ?>><?php _e('3', 'rst-testimonial') ?></option>
                                            <option value="1" <?php if (isset ($grid_normal_column)) {
                                                selected($grid_normal_column, '1');
                                            } ?>><?php _e('1', 'rst-testimonial') ?></option>
                                            <option value="2" <?php if (isset ($grid_normal_column)) {
                                                selected($grid_normal_column, '2');
                                            } ?>><?php _e('2', 'rst-testimonial') ?></option>
                                            <option value="4" <?php if (isset ($grid_normal_column)) {
                                                selected($grid_normal_column, '4');
                                            } ?>><?php _e('4', 'rst-testimonial') ?></option>
                                            <option value="5" <?php if (isset ($grid_normal_column)) {
                                                selected($grid_normal_column, '5');
                                            } ?>><?php _e('5', 'rst-testimonial') ?></option>
                                            <option value="6" <?php if (isset ($grid_normal_column)) {
                                                selected($grid_normal_column, '6');
                                            } ?>><?php _e('6', 'rst-testimonial') ?></option>
                                        </select>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose an option for posts column.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="filter_menu_styles"><?php _e('Filter Menu Style', 'rst-testimonial') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="filter_menu_styles" id="filter_menu_styles"
                                                class="timezone_string">

                                            <option value="1" <?php if (isset ($filter_menu_styles)) {
                                                selected($filter_menu_styles, '1');
                                            } ?>><?php _e('Normal', 'rst-testimonial') ?></option>
                                            <option value="2" <?php if (isset ($filter_menu_styles)) {
                                                selected($filter_menu_styles, '2');
                                            } ?>><?php _e('Checkbox', 'rst-testimonial') ?></option>
                                            <option value="3" <?php if (isset ($filter_menu_styles)) {
                                                selected($filter_menu_styles, '3');
                                            } ?>><?php _e('Drop Down', 'rst-testimonial') ?></option>
                                        </select>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose an option for filter menu style.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr>

                                <tr>
                                    <th><u><?php echo __('Menu Styling', 'rst-testimonial'); ?></u></th>
                                    <td></td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="filter_menu_alignment"><?php _e('Menu Align', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="filter_menu_alignment1" name="filter_menu_alignment"
                                                   value="left" <?php if ($filter_menu_alignment == 'left') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="filter_menu_alignment1"><?php _e('Left', 'rst-testimonial'); ?></label>
                                            <input type="radio" id="filter_menu_alignment2" name="filter_menu_alignment"
                                                   value="center" <?php if ($filter_menu_alignment == 'center' || $filter_menu_alignment == '') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="filter_menu_alignment2"><?php _e('Center', 'rst-testimonial'); ?></label>
                                            <input type="radio" id="filter_menu_alignment3" name="filter_menu_alignment"
                                                   value="right" <?php if ($filter_menu_alignment == 'right') {
                                                echo 'checked';
                                            } ?>/>
                                            <label for="filter_menu_alignment3"><?php _e('Right', 'rst-testimonial'); ?></label>
                                        </div>
                                        <span class="rststestimonial_manager_hint"><?php echo __('Choose an option for the alignment of filter menu.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Menu Align -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="filter_menu_bg_color"><?php _e('Background Color', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="filter_menu_bg_color" name="filter_menu_bg_color"
                                               value="<?php if ($filter_menu_bg_color != '') {
                                                   echo esc_attr($filter_menu_bg_color);
                                               } else {
                                                   echo "#f8f8f8";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for filter menu background.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Menu bg color -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="filter_menu_font_color"><?php _e('Font Color', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="filter_menu_font_color" name="filter_menu_font_color"
                                               value="<?php if ($filter_menu_font_color != '') {
                                                   echo esc_attr($filter_menu_font_color);
                                               } else {
                                                   echo "#777777";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for text of filter menu.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Menu text color -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="filter_menu_bg_color_hover"><?php _e('Background Color(Hover)', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="filter_menu_bg_color_hover"
                                               name="filter_menu_bg_color_hover"
                                               value="<?php if ($filter_menu_bg_color_hover != '') {
                                                   echo esc_attr($filter_menu_bg_color_hover);
                                               } else {
                                                   echo "#003478";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for filter menu background on hover.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Menu bg color on hover -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="filter_menu_font_color_hover"><?php _e('Font Color(Hover)', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="filter_menu_font_color_hover"
                                               name="filter_menu_font_color_hover"
                                               value="<?php if ($filter_menu_font_color_hover != '') {
                                                   echo esc_attr($filter_menu_font_color_hover);
                                               } else {
                                                   echo "#ffffff";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for text of filter menu on hover.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Menu text color on hover -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="filter_menu_bg_color_active"><?php _e('Background Color(Active)', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="filter_menu_bg_color_active"
                                               name="filter_menu_bg_color_active"
                                               value="<?php if ($filter_menu_bg_color_active != '') {
                                                   echo esc_attr($filter_menu_bg_color_active);
                                               } else {
                                                   echo "#003478";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for filter menu background on hover.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Menu bg color when active -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="filter_menu_font_color_active"><?php _e('Font Color(Active)', 'rst-testimonial'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="filter_menu_font_color_active"
                                               name="filter_menu_font_color_active"
                                               value="<?php if ($filter_menu_font_color_active != '') {
                                                   echo esc_attr($filter_menu_font_color_active);
                                               } else {
                                                   echo "#ffffff";
                                               } ?>" class="timezone_string">
                                        <span class="rststestimonial_manager_hint"><?php echo __('Pick a color for text of filter menu on hover.', 'rst-testimonial'); ?></span>
                                    </td>
                                </tr><!-- End Menu text color when active -->

                            </table>
                        </div>
                    </div>
                </li>
                <!-- Tab 6 -->
                <li style="<?php if ($nav_value == 6) {
                    echo "display: block;";
                } else {
                    echo "display: none;";
                } ?>" class="box6 tab-box <?php if ($nav_value == 6) {
                    echo "active";
                } ?>">
                    <div class="wrap">
                        <div class="option-box">
                            <p class="option-title"><?php _e('Support & Documentation', 'rst-testimonial'); ?></p>
                            <div class="testimoinal-pro-features">
                                <div class="help-support">
                                    <div class="support-items">
                                        <div class="support-title">
                                            <?php echo __('Need Support', 'rst-testimonial'); ?>
                                        </div>
                                        <div class="support-details">
                                            <p><?php echo __('If you need any helps, please don\'t hesitate to post it on WordPress.org Support Forum or Themeix Support Forum', 'rst-testimonial'); ?></p>
                                        </div>
                                        <div class="support-link">
                                            <a target="_blank"
                                               href="https://wordpress.org/support/plugin/"
                                               class="button-1">WordPress.org</a>
                                            <a target="_blank" href="https://themeix.com"
                                               class="button-1">Themeix.com</a>
                                        </div>
                                    </div>
                                    <div class="support-items">
                                        <div class="support-title">
                                            <?php echo __('Happy User', 'rst-testimonial'); ?>
                                        </div>
                                        <div class="support-details">
                                            <p><?php echo __('If you are happy with the Testimonial Plugin, say it on wordpress.org and give RST Testimonial a nice review!', 'rst-testimonial'); ?></p>
                                        </div>
                                        <div class="support-link">
                                            <a target="_blank"
                                               href="https://wordpress.org/support/plugin">
                                                <div class="reviewteam">
                                                    <span class="dashicons dashicons-star-filled"></span>
                                                    <span class="dashicons dashicons-star-filled"></span>
                                                    <span class="dashicons dashicons-star-filled"></span>
                                                    <span class="dashicons dashicons-star-filled"></span>
                                                    <span class="dashicons dashicons-star-filled"></span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function (jQuery) {
                jQuery('#rst_item_bg_color, #rst_rating_color, #rst_content_bg_color, #rst_content_color, #rst_company_url_color, #rst_designation_color_option, #rst_name_color_option, #rst_imgborder_color_option, #nav_text_color, #nav_bg_color, #nav_text_color_hover, #nav_bg_color_hover, #pagination_bg_color, #pagination_bg_color_active, #filter_menu_bg_color, #filter_menu_font_color, #filter_menu_font_color_active, #filter_menu_bg_color_active, #filter_menu_font_color_hover, #filter_menu_bg_color_hover, #rst_item_border_color, #dots_bg_color, #dots_text_color').wpColorPicker();
            });
        </script>


    <?php }   //
}

# Data save in custom metabox field
if(!function_exists('rst_testimonial_meta_box_save_func')) {
    function rst_testimonial_meta_box_save_func($post_id)
    {
        #check nonce
        if (!isset($_POST['rst_short_code_mt_box_nonce']) || !wp_verify_nonce($_POST['rst_short_code_mt_box_nonce'], 'rst_short_code_mt_box_action')) {
            return;
        }


        # Doing autosave then return.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        #Checks for input and saves if needed
        if (isset($_POST['testimonial_cat_name'])) {
            update_post_meta($post_id, 'testimonial_cat_name', array_map('sanitize_text_field', $_POST['testimonial_cat_name']));
        } else {
            delete_post_meta($post_id, 'testimonial_cat_name');
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_name_color_option'])) {
            update_post_meta($post_id, 'rst_name_color_option', sanitize_hex_color($_POST['rst_name_color_option']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_designation_color_option'])) {
            update_post_meta($post_id, 'rst_designation_color_option', sanitize_hex_color($_POST['rst_designation_color_option']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_testimonial_themes'])) {
            update_post_meta($post_id, 'rst_testimonial_themes', sanitize_text_field($_POST['rst_testimonial_themes']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_testimonial_theme_style'])) {
            update_post_meta($post_id, 'rst_testimonial_theme_style', sanitize_text_field($_POST['rst_testimonial_theme_style']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_testimonial_textalign'])) {
            update_post_meta($post_id, 'rst_testimonial_textalign', sanitize_text_field($_POST['rst_testimonial_textalign']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_order_by_option'])) {
            update_post_meta($post_id, 'rst_order_by_option', sanitize_text_field($_POST['rst_order_by_option']));
        }
        #Checks for input and saves if needed
        if (isset($_POST['rst_image_sizes'])) {
            update_post_meta($post_id, 'rst_image_sizes', sanitize_text_field($_POST['rst_image_sizes']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['dpstotoal_items'])) {
            update_post_meta($post_id, 'dpstotoal_items', sanitize_text_field($_POST['dpstotoal_items']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_img_show_hide'])) {
            update_post_meta($post_id, 'rst_img_show_hide', sanitize_text_field($_POST['rst_img_show_hide']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_img_border_radius'])) {
            update_post_meta($post_id, 'rst_img_border_radius', sanitize_text_field($_POST['rst_img_border_radius']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_imgborder_width_option'])) {
            update_post_meta($post_id, 'rst_imgborder_width_option', sanitize_text_field($_POST['rst_imgborder_width_option']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_imgborder_color_option'])) {
            update_post_meta($post_id, 'rst_imgborder_color_option', sanitize_hex_color($_POST['rst_imgborder_color_option']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_designation_show_hide'])) {
            update_post_meta($post_id, 'rst_designation_show_hide', sanitize_text_field($_POST['rst_designation_show_hide']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_company_show_hide'])) {
            update_post_meta($post_id, 'rst_company_show_hide', sanitize_text_field($_POST['rst_company_show_hide']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_company_url_color'])) {
            update_post_meta($post_id, 'rst_company_url_color', sanitize_hex_color($_POST['rst_company_url_color']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_name_fontsize_option'])) {
            update_post_meta($post_id, 'rst_name_fontsize_option', sanitize_text_field($_POST['rst_name_fontsize_option']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_name_font_case'])) {
            update_post_meta($post_id, 'rst_name_font_case', sanitize_text_field($_POST['rst_name_font_case']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_name_font_style'])) {
            update_post_meta($post_id, 'rst_name_font_style', sanitize_text_field($_POST['rst_name_font_style']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_designation_case'])) {
            update_post_meta($post_id, 'rst_designation_case', sanitize_text_field($_POST['rst_designation_case']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_designation_font_style'])) {
            update_post_meta($post_id, 'rst_designation_font_style', sanitize_text_field($_POST['rst_designation_font_style']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_desig_fontsize_option'])) {
            update_post_meta($post_id, 'rst_desig_fontsize_option', sanitize_text_field($_POST['rst_desig_fontsize_option']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_content_show_hide'])) {
            update_post_meta($post_id, 'rst_content_show_hide', sanitize_text_field($_POST['rst_content_show_hide']));
        }


        #Checks for input and saves
        if (isset($_POST['rst_content_fontsize_option'])) {
            update_post_meta($post_id, 'rst_content_fontsize_option', sanitize_text_field($_POST['rst_content_fontsize_option']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_content_bg_color'])) {
            update_post_meta($post_id, 'rst_content_bg_color', sanitize_hex_color($_POST['rst_content_bg_color']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_content_padding'])) {
            update_post_meta($post_id, 'rst_content_padding', sanitize_text_field($_POST['rst_content_padding']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_rating_fontsize_option'])) {
            update_post_meta($post_id, 'rst_rating_fontsize_option', sanitize_text_field($_POST['rst_rating_fontsize_option']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_content_color'])) {
            update_post_meta($post_id, 'rst_content_color', sanitize_hex_color($_POST['rst_content_color']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_content_border_radius'])) {
            update_post_meta($post_id, 'rst_content_border_radius', sanitize_text_field($_POST['rst_content_border_radius']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_show_rating_option'])) {
            update_post_meta($post_id, 'rst_show_rating_option', sanitize_text_field($_POST['rst_show_rating_option']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_show_item_bg_option'])) {
            update_post_meta($post_id, 'rst_show_item_bg_option', sanitize_text_field($_POST['rst_show_item_bg_option']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_rating_color'])) {
            update_post_meta($post_id, 'rst_rating_color', sanitize_hex_color($_POST['rst_rating_color']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_item_bg_color'])) {
            update_post_meta($post_id, 'rst_item_bg_color', sanitize_hex_color($_POST['rst_item_bg_color']));
        }
        #Checks for input and saves
        if (isset($_POST['rst_item_padding'])) {
            update_post_meta($post_id, 'rst_item_padding', sanitize_text_field($_POST['rst_item_padding']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_item_border_radius'])) {
            update_post_meta($post_id, 'rst_item_border_radius', sanitize_text_field($_POST['rst_item_border_radius']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_item_border_color'])) {
            update_post_meta($post_id, 'rst_item_border_color', sanitize_hex_color($_POST['rst_item_border_color']));
        }

        // Carousal Settings

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['item_no']) && ($_POST['item_no'] != '')) {
            update_post_meta($post_id, 'item_no', sanitize_text_field($_POST['item_no']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['loop']) && ($_POST['loop'] != '')) {
            update_post_meta($post_id, 'loop', sanitize_text_field($_POST['loop']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['margin'])) {
            //print_r($_POST['margin']);die();
            update_post_meta($post_id, 'margin', sanitize_text_field($_POST['margin']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['dots']) && ($_POST['dots'] != '')) {
            update_post_meta($post_id, 'dots', sanitize_text_field($_POST['dots']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['dots_text_color']) && ($_POST['dots_text_color'] != '')) {
            update_post_meta($post_id, 'dots_text_color', sanitize_hex_color($_POST['dots_text_color']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['dots_bg_color']) && ($_POST['dots_bg_color'] != '')) {
            update_post_meta($post_id, 'dots_bg_color', sanitize_hex_color($_POST['dots_bg_color']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['navigation']) && ($_POST['navigation'] != '')) {
            update_post_meta($post_id, 'navigation', sanitize_text_field($_POST['navigation']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['navigation_align']) && ($_POST['navigation_align'] != '')) {
            update_post_meta($post_id, 'navigation_align', sanitize_text_field($_POST['navigation_align']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['navigation_style']) && ($_POST['navigation_style'] != '')) {
            update_post_meta($post_id, 'navigation_style', sanitize_text_field($_POST['navigation_style']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['pagination']) && ($_POST['pagination'] != '')) {
            update_post_meta($post_id, 'pagination', sanitize_text_field($_POST['pagination']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['pagination_align']) && ($_POST['pagination_align'] != '')) {
            update_post_meta($post_id, 'pagination_align', sanitize_text_field($_POST['pagination_align']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['pagination_style']) && ($_POST['pagination_style'] != '')) {
            update_post_meta($post_id, 'pagination_style', sanitize_text_field($_POST['pagination_style']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['grid_normal_column']) && ($_POST['grid_normal_column'] != '')) {
            update_post_meta($post_id, 'grid_normal_column', sanitize_text_field($_POST['grid_normal_column']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['filter_menu_styles']) && ($_POST['filter_menu_styles'] != '')) {
            update_post_meta($post_id, 'filter_menu_styles', sanitize_text_field($_POST['filter_menu_styles']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['filter_menu_alignment']) && ($_POST['filter_menu_alignment'] != '')) {
            update_post_meta($post_id, 'filter_menu_alignment', sanitize_text_field($_POST['filter_menu_alignment']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['filter_menu_bg_color']) && ($_POST['filter_menu_bg_color'] != '')) {
            update_post_meta($post_id, 'filter_menu_bg_color', sanitize_hex_color($_POST['filter_menu_bg_color']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['filter_menu_bg_color_hover']) && ($_POST['filter_menu_bg_color_hover'] != '')) {
            update_post_meta($post_id, 'filter_menu_bg_color_hover', sanitize_hex_color($_POST['filter_menu_bg_color_hover']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['filter_menu_bg_color_active']) && ($_POST['filter_menu_bg_color_active'] != '')) {
            update_post_meta($post_id, 'filter_menu_bg_color_active', sanitize_hex_color($_POST['filter_menu_bg_color_active']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['filter_menu_font_color']) && ($_POST['filter_menu_font_color'] != '')) {
            update_post_meta($post_id, 'filter_menu_font_color', sanitize_hex_color($_POST['filter_menu_font_color']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['filter_menu_font_color_hover']) && ($_POST['filter_menu_font_color_hover'] != '')) {
            update_post_meta($post_id, 'filter_menu_font_color_hover', sanitize_hex_color($_POST['filter_menu_font_color_hover']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['filter_menu_font_color_active']) && ($_POST['filter_menu_font_color_active'] != '')) {
            update_post_meta($post_id, 'filter_menu_font_color_active', sanitize_hex_color($_POST['filter_menu_font_color_active']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['pagination_bg_color']) && ($_POST['pagination_bg_color'] != '')) {
            update_post_meta($post_id, 'pagination_bg_color', sanitize_hex_color($_POST['pagination_bg_color']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['pagination_bg_color_active']) && ($_POST['pagination_bg_color_active'] != '')) {
            update_post_meta($post_id, 'pagination_bg_color_active', sanitize_hex_color($_POST['pagination_bg_color_active']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['autoplay']) && ($_POST['autoplay'] != '')) {
            update_post_meta($post_id, 'autoplay', sanitize_text_field($_POST['autoplay']));
        }

        #Checks for input and sanitizes/saves if needed
        if (!empty($_POST['autoplay_speed'])) {
            if (strlen($_POST['autoplay_speed']) > 4) {

            } else {

                if ($_POST['autoplay_speed'] == '' || is_null($_POST['autoplay_speed'])) {

                    update_post_meta($post_id, 'autoplay_speed', 700);
                } else {
                    if (is_numeric($_POST['autoplay_speed']) && strlen($_POST['autoplay_speed']) <= 4) {

                        update_post_meta($post_id, 'autoplay_speed', sanitize_text_field($_POST['autoplay_speed']));

                    }
                }
            }
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['stop_hover']) && ($_POST['stop_hover'] != '')) {
            update_post_meta($post_id, 'stop_hover', sanitize_text_field($_POST['stop_hover']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['itemsdesktop']) && ($_POST['itemsdesktop'] != '')) {
            update_post_meta($post_id, 'itemsdesktop', sanitize_text_field($_POST['itemsdesktop']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['itemsdesktopsmall']) && ($_POST['itemsdesktopsmall'] != '')) {
            update_post_meta($post_id, 'itemsdesktopsmall', sanitize_text_field($_POST['itemsdesktopsmall']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['itemsmobile']) && ($_POST['itemsmobile'] != '')) {
            update_post_meta($post_id, 'itemsmobile', sanitize_text_field($_POST['itemsmobile']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['autoplaytimeout']) && ($_POST['autoplaytimeout'] != '')) {
            update_post_meta($post_id, 'autoplaytimeout', sanitize_text_field($_POST['autoplaytimeout']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['nav_text_color']) && ($_POST['nav_text_color'] != '')) {
            update_post_meta($post_id, 'nav_text_color', sanitize_hex_color($_POST['nav_text_color']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['nav_text_color_hover']) && ($_POST['nav_text_color_hover'] != '')) {
            update_post_meta($post_id, 'nav_text_color_hover', sanitize_hex_color($_POST['nav_text_color_hover']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['nav_bg_color']) && ($_POST['nav_bg_color'] != '')) {
            update_post_meta($post_id, 'nav_bg_color', sanitize_hex_color($_POST['nav_bg_color']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['nav_bg_color_hover']) && ($_POST['nav_bg_color_hover'] != '')) {
            update_post_meta($post_id, 'nav_bg_color_hover', sanitize_hex_color($_POST['nav_bg_color_hover']));
        }

        #Value check and saves if needed
        if (isset($_POST['nav_value'])) {
            update_post_meta($post_id, 'nav_value', sanitize_text_field($_POST['nav_value']));
        } else {
            update_post_meta($post_id, 'nav_value', 1);
        }


    }
}
add_action('save_post', 'rst_testimonial_meta_box_save_func');
# Custom metabox field end




