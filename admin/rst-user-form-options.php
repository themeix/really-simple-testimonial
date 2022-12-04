<?php

// if direct access
if (!defined('ABSPATH')) {
    exit;
}

// Saving Selected fields data in option table
add_action('admin_init', 'rst_save_user_form_options');

function rst_save_user_form_options(){


    if (isset($_POST['rst_save_btn'])) {


        if(!isset($_POST['rst_user_form_nonce']) || !wp_verify_nonce($_POST['rst_user_form_nonce'], 'rst_user_form_action')) {
            return;
        } else {

            if (isset($_POST['rstoptions'])) {
                update_option('rst_user_fields', array_map('sanitize_text_field', $_POST['rstoptions']));
            }


            if (isset($_POST['rst_user_title'])) {
                update_option('rst_user_title', sanitize_text_field($_POST['rst_user_title']));
            }

            if (isset($_POST['rst_user_name'])) {
                update_option('rst_user_name', sanitize_text_field($_POST['rst_user_name']));
            }

            if (isset($_POST['rst_user_designation'])) {
                update_option('rst_user_designation', sanitize_text_field($_POST['rst_user_designation']));
            }

            if (isset($_POST['rst_user_company_name'])) {
                update_option('rst_user_company_name', sanitize_text_field($_POST['rst_user_company_name']));
            }


            if (isset($_POST['rst_user_company_url'])) {
                update_option('rst_user_company_url', sanitize_text_field($_POST['rst_user_company_url']));
            }

            if (isset($_POST['rst_user_rating'])) {
                update_option('rst_user_rating', sanitize_text_field($_POST['rst_user_rating']));
            }

            if (isset($_POST['rst_user_testi_text'])) {
                update_option('rst_user_testi_text', sanitize_text_field($_POST['rst_user_testi_text']));
            }

            if (isset($_POST['rst_user_categories'])) {
                update_option('rst_user_categories', sanitize_text_field($_POST['rst_user_categories']));
            }


            if (isset($_POST['rst_user_logo_img'])) {
                update_option('rst_user_logo_img', sanitize_text_field($_POST['rst_user_logo_img']));
            }

            if (isset($_POST['rst_user_calculate'])) {
                update_option('rst_user_calculate', sanitize_text_field($_POST['rst_user_calculate']));
            }

            if (isset($_POST['rst_post_status'])) {
                update_option('rst_post_status', sanitize_text_field($_POST['rst_post_status']));
            }

            if (isset($_POST['rst_user_submit_btn_text'])) {
                update_option('rst_user_submit_btn_text', sanitize_text_field($_POST['rst_user_submit_btn_text']));
            }

            if (isset($_POST['rst_save_success_text'])) {
                update_option('rst_save_success_text', sanitize_text_field($_POST['rst_save_success_text']));
            }

            if (isset($_POST['rst_save_error_text'])) {
                update_option('rst_save_error_text', sanitize_text_field($_POST['rst_save_error_text']));
            }

            if (isset($_POST['rst_file_mishmatch_text'])) {
                update_option('rst_file_mishmatch_text', sanitize_text_field($_POST['rst_file_mishmatch_text']));
            }

            if (isset($_POST['rst_calc_error_text'])) {
                update_option('rst_calc_error_text', sanitize_text_field($_POST['rst_calc_error_text']));
            }
        }

    }

}




// Check whether a field is selected or not
function rst_isOptionChecked($value)
{
    $options = get_option('rst_user_fields');
    if (isset($options) && !empty($options) && is_array($options) && in_array($value, $options)) {
        echo " checked ";
    }
}

// Retrive custom fields name
function rst_user_fields_name($field, $default)
{
    $field_name = get_option($field);
    if (isset($field_name) && !empty($field_name)) {
        echo esc_attr($field_name);
    } else {
        echo esc_attr($default);
    }
}

// Retrive custom success and error messages
function rst_user_retrive_messages($field, $default)
{
    $field_name = get_option($field);
    if (isset($field_name) && !empty($field_name)) {
        return $field_name;
    } else {
        return $default;
    }
}


// Add Submenu Page Front end form options
function rst_register_testimonial_user_options()
{
    add_submenu_page('edit.php?post_type=rst_testimonial', __('User Form', 'rst-testimonial'), sprintf('<span style="color:#ddd;">%s</span>', __('Frontend Submission', 'rst-testimonial')), 'manage_options', 'rst-user-form-options', 'rst_testimonial_user_options_page_layouts');
}

add_action('admin_menu', 'rst_register_testimonial_user_options');


// Callback function for admin_menu hook
function rst_testimonial_user_options_page_layouts()
{
    $rst_post_status = get_option('rst_post_status');

    ?>
    <div class="wrap">
        <h1><?php _e('Testimonial Submission Form :', 'rst_testimonial_pro'); ?></h1>
        <p>From the list below select and give the name of the field you want to show as input fields to the front end
            users to submit testimonials.</p>
        <p>
        <p>To display a form with fields selected here, just copy and paste this <input
                    onClick="this.select(); execCommand('copy');" type="text" name="" readonly
                    value="[rst_frontend_form]"> shortcode in a page or post. User will then see a form in frontend to
            submit their testimonial in that page or post.</p>
        </p>

        <h3 style="color:red;"><?php _e('Available Only Premium Version:', 'rst_testimonial_pro'); ?></h3>
        <form method="post" action="">
            <?php wp_nonce_field('rst_user_form_action', 'rst_user_form_nonce'); ?>

            <table>
                <tr>
                    <td>
                        <input type="checkbox" id="rst_user_title" name="rstoptions[]"
                               value="Title" <?php rst_isOptionChecked('Title'); ?>>
                        <label for="rst_user_title"><?php _e('Title', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_title"
                               value="<?php rst_user_fields_name('rst_user_title', 'We love to hear from our customers'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" id="rst_user_name" name="rstoptions[]"
                               value="Name" <?php rst_isOptionChecked('Name'); ?>>
                        <label for="rst_user_name"><?php _e('Name', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_name"
                               value="<?php rst_user_fields_name('rst_user_name', 'Name'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_designation" type="checkbox" name="rstoptions[]"
                               value="Designation" <?php rst_isOptionChecked('Designation'); ?>>
                        <label for="rst_user_designation"><?php _e('Designation', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_designation"
                               value="<?php rst_user_fields_name('rst_user_designation', 'Designation'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_company_name" type="checkbox" name="rstoptions[]"
                               value="Company Name" <?php rst_isOptionChecked('Company Name'); ?>>
                        <label for="rst_user_company_name"><?php _e('Company Name', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_company_name"
                               value="<?php rst_user_fields_name('rst_user_company_name', 'Company Name'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_company_url" type="checkbox" name="rstoptions[]"
                               value="Company URL" <?php rst_isOptionChecked('Company URL'); ?>>
                        <label for="rst_user_company_url"><?php _e('Company URL', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_company_url"
                               value="<?php rst_user_fields_name('rst_user_company_url', 'Company URL'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_rating" type="checkbox" name="rstoptions[]"
                               value="Rating" <?php rst_isOptionChecked('Rating'); ?>>
                        <label for="rst_user_rating"><?php _e('Rating', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_rating"
                               value="<?php rst_user_fields_name('rst_user_rating', 'Rating'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_testi_text" type="checkbox" name="rstoptions[]"
                               value="Testimonial Message" <?php rst_isOptionChecked('Testimonial Message'); ?>>
                        <label for="rst_user_testi_text"><?php _e('Testimonial Message', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_testi_text"
                               value="<?php rst_user_fields_name('rst_user_testi_text', 'Testimonial Message'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_categories" type="checkbox" name="rstoptions[]"
                               value="Categories" <?php rst_isOptionChecked('Categories'); ?>>
                        <label for="rst_user_categories"><?php _e('Categories', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td><input type="text" name="rst_user_categories"
                               value="<?php rst_user_fields_name('rst_user_categories', 'Categories'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_logo_img" type="checkbox" name="rstoptions[]"
                               value="User's Image/Logo" <?php rst_isOptionChecked("User's Image/Logo"); ?>>
                        <label for="rst_user_logo_img"><?php _e('User\'s Image/Logo', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_logo_img"
                               value="<?php rst_user_fields_name('rst_user_logo_img', "User's Image/Logo"); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_calculate" type="checkbox" name="rstoptions[]"
                               value="Calculate" <?php rst_isOptionChecked("Calculate"); ?>>
                        <label for="rst_user_calculate"><?php _e('User\'s Captcha', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_calculate"
                               value="<?php rst_user_fields_name('rst_user_calculate', "Calculate"); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_post_status"><?php _e('Select post status', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <select id="rst_post_status" name="rst_post_status">
                            <option value="draft" <?php if (isset($rst_post_status) && $rst_post_status == 'draft') echo 'selected'; ?>>
                                Draft
                            </option>
                            <option value="pending" <?php if (isset($rst_post_status) && $rst_post_status == 'pending') echo 'selected'; ?>>
                                Pending
                            </option>
                            <option value="publish" <?php if (isset($rst_post_status) && $rst_post_status == 'publish') echo 'selected'; ?>>
                                Publish
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_user_submit_btn_text"><?php _e('Submit button text', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <input id="rst_user_submit_btn_text" type="text" name="rst_user_submit_btn_text"
                               value="<?php rst_user_fields_name('rst_user_submit_btn_text', "Submit Testimonial"); ?>">
                    </td>
                </tr>
            </table>
            <h3> <?php _e('Testimonial Error and success messages for public users', 'rst_testimonial_pro'); ?></h3>
            <table>
                <tr>
                    <td>
                        <label for="rst_save_success_text"><?php _e('Data saved success message', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <textarea id="rst_save_success_text" rows="4" cols="50"
                                  name="rst_save_success_text"><?php echo esc_attr(rst_user_retrive_messages('rst_save_success_text', 'Thank you for your valuable comments. Stay with us.')); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_save_error_text"><?php _e('Data saved error message', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <textarea id="rst_save_error_text" rows="4" cols="50"
                                  name="rst_save_error_text"><?php echo esc_attr(rst_user_retrive_messages('rst_save_error_text', 'Please fill-up all the info again.')); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_file_mishmatch_text"><?php _e('File type mishmatch message', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <textarea id="rst_file_mishmatch_text" rows="4" cols="50"
                                  name="rst_file_mishmatch_text"><?php echo esc_attr(rst_user_retrive_messages('rst_file_mishmatch_text', 'Only jpg, png and jpeg is accepted. Please try again.')); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_calc_error_text"><?php _e('Calculation error message', 'rst_testimonial_pro'); ?></label>
                    </td>
                    <td>
                        <textarea id="rst_calc_error_text" rows="4" cols="50"
                                  name="rst_calc_error_text"><?php echo esc_attr(rst_user_retrive_messages('rst_calc_error_text', 'Calculation is incorrect. Please try again.')); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="button button-primary" name="rst_save_btn" value="Save Changes">
                    </td>
                </tr>
            </table>
        </form>
    </div>
<?php }


function rst_frontend_form_callback()
{
    ob_start();
    include (__DIR__ . '/rst-frontend-form.php');
    return ob_get_clean();
}

add_shortcode('rst_frontend_form', 'rst_frontend_form_callback');