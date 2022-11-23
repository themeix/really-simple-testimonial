<?php

if (!defined('ABSPATH')) {
    exit;
}

if ($rst_testimonial_themes == 8) {

    wp_enqueue_style('rst_theme_8_style_1', plugin_dir_url(__FILE__) . 'assets/css/custom.css', array(), time(), 'all');

    $args = array(
        'post_type' => 'rst_testimonial',
        'post_status' => 'publish',
        'posts_per_page' => $dpstotoal_items,
    );

    $rst_query_theme_8 = new WP_Query($args);

    if ($rst_query_theme_8->have_posts()) {

        ?>

        <style type="text/css">

            .rst_<?php echo esc_attr( $postid );?> .rst_testimonial_item {
            <?php if ($rst_show_item_bg_option == 1) { ?> background-color: <?php echo $rst_item_bg_color; ?> !important;
                padding: <?php echo $rst_item_padding; ?>px !important;

            <?php } ?>
            }

            .rst_<?php echo esc_attr( $postid );?> .rst-item {
                border-color: <?php echo $rst_item_border_color; ?> !important;
                border-radius: <?php echo $rst_item_border_radius; ?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_content {
                display: <?php if($rst_content_show_hide == 2) echo 'none'?> !important;
                color: <?php echo $rst_content_color; ?> !important;
                font-size: <?php echo $rst_content_fontsize_option; ?>px !important;
                background-color: <?php echo $rst_content_bg_color; ?> !important;
                padding: <?php echo $rst_content_padding; ?>px !important;
                text-align: <?php echo $rst_testimonial_textalign; ?> !important;
                border-radius: <?php echo $rst_content_border_radius; ?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_content_svg {
                display: <?php if($rst_content_show_hide == 2) echo 'none'?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_author_name {
                color: <?php echo $rst_name_color_option; ?> !important;
                font-size: <?php echo $rst_name_fontsize_option; ?>px !important;
                text-transform: <?php echo $rst_name_font_case; ?> !important;
                font-style: <?php echo $rst_name_font_style; ?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_author_position {
                display: <?php if($rst_designation_show_hide == 2) echo 'none'?> !important;
                color: <?php echo $rst_designation_color_option; ?> !important;
                font-size: <?php echo $rst_desig_fontsize_option; ?>px !important;
                text-transform: <?php echo $rst_designation_case; ?> !important;
                font-style: <?php echo $rst_designation_font_style; ?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_author_company_name a {
                display: <?php if($rst_company_show_hide == 2) echo 'none'?> !important;
                color: <?php echo $rst_company_url_color; ?> !important;
                font-size: <?php echo $rst_desig_fontsize_option; ?>px !important;
                text-decoration: none !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_author_position_separator {
                display: <?php if($rst_company_show_hide == 2) echo 'none'?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_author_image {
                display: <?php if($rst_img_show_hide == 2) echo 'none'?> !important;
                border-radius: <?php echo $rst_img_border_radius; ?> !important;
                border-width: <?php echo $rst_imgborder_width_option; ?>px !important;
                border-color: <?php echo $rst_imgborder_color_option; ?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_rating svg {
                display: <?php if($rst_show_rating_option == 2) echo 'none'?> !important;
                fill: <?php echo $rst_rating_color; ?> !important;
                width: <?php echo $rst_rating_fontsize_option; ?>px !important;
                height: <?php echo $rst_rating_fontsize_option; ?>px !important;
            }

        </style>

        <div class="rst-box-8 mt-20 rst_<?php echo esc_attr($postid); ?>">
            <div class="rst-container">

                <div class="grid sm:grid-cols-2 lg:grid-cols-3  gap-6">
                    <?php
                    while ($rst_query_theme_8->have_posts()) {
                        $rst_query_theme_8->the_post();

                        $rst_content = substr(get_post_meta(get_the_ID(), 'testimonial_text', true), 0, 100);
                        $rst_author_position = get_post_meta(get_the_ID(), 'position', true);
                        $rst_author_name = get_the_title();
                        $rst_author_rating = get_post_meta(get_the_ID(), 'company_rating_target', true);
                        $rst_author_image = wp_get_attachment_image_src(get_post_thumbnail_id());
                        $rst_author_company_name = get_post_meta(get_the_ID(), 'company', true);
                        $rst_author_company_url = get_post_meta(get_the_ID(), 'company_website', true);


                        ?>
                        <div class="rst-item border rounded-md p-6 text-center rst_testimonial_item">
                            <div class="rst-rating bg-gray-50 p-4 h-20 rounded-t-md flex rst_rating">
                  <span>
                     <svg class="inline-block mr-1" width="<?php echo $rst_rating_fontsize_option; ?>"
                          height="<?php echo $rst_rating_fontsize_option; ?>" viewBox="0 0 16 15" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.2255 5.28193L10.5166 4.59758L8.41164 0.330127C8.35415 0.213287 8.25957 0.118702 8.14273 0.0612089C7.8497 -0.0834504 7.49361 0.037099 7.3471 0.330127L5.24212 4.59758L0.533275 5.28193C0.403453 5.30047 0.284758 5.36167 0.193882 5.45441C0.0840183 5.56733 0.0234784 5.71924 0.0255649 5.87678C0.0276514 6.03431 0.0921937 6.18457 0.20501 6.29454L3.61192 9.61614L2.80702 14.3064C2.78815 14.4156 2.80022 14.5278 2.84187 14.6304C2.88353 14.733 2.95309 14.8218 3.04269 14.8869C3.13228 14.952 3.23831 14.9906 3.34875 14.9985C3.4592 15.0064 3.56964 14.9831 3.66756 14.9314L7.87937 12.717L12.0912 14.9314C12.2062 14.9926 12.3397 15.013 12.4677 14.9908C12.7904 14.9352 13.0074 14.6291 12.9517 14.3064L12.1468 9.61614L15.5537 6.29454C15.6465 6.20367 15.7077 6.08497 15.7262 5.95515C15.7763 5.63059 15.55 5.33015 15.2255 5.28193Z"
                              fill="<?php echo $rst_rating_color; ?>"></path>
                     </svg>
                  </span>
                                <span>

                                <?php if (!empty($rst_author_rating)) {
                                    echo $rst_author_rating;
                                } ?>

                  </span>
                            </div>
                            <div class="rst-author-images -mt-14 inline-block">
                                <img class="h-25 w-25 rounded-full inline-block rst_author_image"
                                     src="<?php echo $rst_author_image[0]; ?>" alt="author">
                            </div>
                            <h4 class="rst-author-name text-xl font-bold text-coolGray-900 mt-4 rst_author_name">
                                <?php if (!empty($rst_author_name)) echo $rst_author_name; ?>
                            </h4>
                            <p class="rst-author-title text-coolGray-600 opacity-50  text-base">
                                <span class="rst_author_position"><?php if (!empty($rst_author_position)) echo $rst_author_position; ?></span>
                                <span class="rst_author_position_separator"><?php if ($rst_designation_show_hide == 1 && $rst_company_show_hide == 1) echo '-'; ?></span>
                                <span class="rst_author_company_name"><a target="_blank"
                                                                         href="<?php echo $rst_author_company_url ?>"><?php if (!empty($rst_author_company_name)) echo $rst_author_company_name; ?></a></span>
                            </p>

                            <div class="rst-right-quotes mt-8 rst_content_svg">
                                <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.79286 0H8.52892L5.15843 10H0.422363L3.79286 0Z" fill="#10B981"></path>
                                    <path d="M11.6863 0H16.4224L13.0519 10H8.3158L11.6863 0Z" fill="#10B981"></path>
                                </svg>
                            </div>
                            <div class="rst-text mt-1">
                                <p class="text-coolGray-600 font-normal text-base rst_content">
                                    <?php if (!empty($rst_content)) {
                                        echo $rst_content;
                                    } ?>
                                </p>
                            </div>
                            <div class="rst-left-quotes  text-right rst_content_svg">
                                <svg class="inline-block" width="17" height="10" viewBox="0 0 17 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.79286 10H8.52892L5.15843 0H0.422363L3.79286 10Z" fill="#10B981"></path>
                                    <path d="M11.6863 10H16.4224L13.0519 0H8.3158L11.6863 10Z" fill="#10B981"></path>
                                </svg>
                            </div>
                        </div>

                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>

            </div>
        </div>

        <?php
    }

}