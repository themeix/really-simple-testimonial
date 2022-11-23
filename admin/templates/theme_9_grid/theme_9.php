<?php

if (!defined('ABSPATH')) {
    exit;
}

if ($rst_testimonial_themes == 9) {

    wp_enqueue_style('rst_theme_9_style_1', plugin_dir_url(__FILE__) . 'assets/css/custom.css', array(), time(), 'all');
    wp_enqueue_style('rst_theme_9_style_2', plugin_dir_url(__FILE__) . 'assets/css/tailwind.min.css', array(), time(), 'all');

    $args = array(
        'post_type' => 'rst_testimonial',
        'post_status' => 'publish',
        'posts_per_page' => $dpstotoal_items,
    );

    $rst_query_theme_9 = new WP_Query($args);


    if ($rst_query_theme_9->have_posts()) {
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

        <div class="rst-box-4 rst_<?php echo esc_attr($postid); ?>">
            <div class="rst-container">

                <div class="grid  lg:grid-cols-3  md:grid-cols-2 gap-6">
                    <?php
                    while ($rst_query_theme_9->have_posts()) {
                        $rst_query_theme_9->the_post();

                        $rst_content = substr(get_post_meta(get_the_ID(), 'testimonial_text', true), 0, 100);
                        $rst_author_position = get_post_meta(get_the_ID(), 'position', true);
                        $rst_author_name = get_the_title();
                        $rst_author_rating = get_post_meta(get_the_ID(), 'company_rating_target', true);
                        $rst_author_image = wp_get_attachment_image_src(get_post_thumbnail_id());
                        $rst_author_company_name = get_post_meta(get_the_ID(), 'company', true);
                        $rst_author_company_url = get_post_meta(get_the_ID(), 'company_website', true);


                        ?>
                        <div class="rst-item md:flex bg-gray-50 items-center p-10  rounded-md rst_testimonial_item">
                            <div class="rst-author-26-box md:mr-6 mb-4 md:mb-0 text-center">
                                <div class="rst-images inline-block ">
                                    <img class="h-25 w-25 rounded-full inline-block rst_author_image"
                                         src="<?php echo $rst_author_image[0]; ?>"
                                         alt="author">
                                </div>
                                <h4 class="rst-author-name text-xl font-bold text-coolGray-900  mt-4 rst_author_name">
                                    <?php if (!empty($rst_author_name)) echo $rst_author_name; ?>
                                </h4>
                                <p class="rst-author-title text-coolGray-600 opacity-50  text-base">
                                    <span class="rst_author_position"><?php if (!empty($rst_author_position)) echo $rst_author_position; ?></span>
                                    <span class="rst_author_position_separator"><?php if ($rst_designation_show_hide == 1 && $rst_company_show_hide == 1) echo '-'; ?></span>
                                    <span class="rst_author_company_name"><a target="_blank"
                                                                             href="<?php echo $rst_author_company_url ?>"><?php if (!empty($rst_author_company_name)) echo $rst_author_company_name; ?></a></span>
                                </p>
                            </div>
                            <div class="flex-col md:w-7/12">
                                <div class="rst-quotes-dual relative inline-block text-center">
                                    <svg width="52" height="41" viewBox="0 0 52 41" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.1"
                                              d="M5.06138 6.23C8.59827 2.4275 13.9502 0.5 20.966 0.5H23.487V7.5475L21.4601 7.95C18.0064 8.635 15.604 9.9825 14.3183 11.96C13.6475 13.0253 13.267 14.2451 13.2141 15.5H20.966C21.6346 15.5 22.2758 15.7634 22.7486 16.2322C23.2214 16.7011 23.487 17.337 23.487 18V35.5C23.487 38.2575 21.2257 40.5 18.4451 40.5H3.31941C2.65081 40.5 2.0096 40.2366 1.53683 39.7678C1.06406 39.2989 0.798459 38.663 0.798459 38V25.5L0.806022 18.2025C0.783334 17.925 0.304354 11.35 5.06138 6.23ZM46.1755 40.5H31.0498C30.3812 40.5 29.74 40.2366 29.2672 39.7678C28.7945 39.2989 28.5289 38.663 28.5289 38V25.5L28.5364 18.2025C28.5137 17.925 28.0348 11.35 32.7918 6.23C36.3287 2.4275 41.6806 0.5 48.6964 0.5H51.2174V7.5475L49.1905 7.95C45.7368 8.635 43.3344 9.9825 42.0487 11.96C41.3779 13.0253 40.9974 14.2451 40.9445 15.5H48.6964C49.365 15.5 50.0063 15.7634 50.479 16.2322C50.9518 16.7011 51.2174 17.337 51.2174 18V35.5C51.2174 38.2575 48.9561 40.5 46.1755 40.5Z"
                                              fill="url(#paint0_linear_45_402)"></path>
                                        <defs>
                                            <linearGradient id="paint0_linear_45_402" x1="0.782608" y1="20.5"
                                                            x2="51.2174"
                                                            y2="20.5" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#C84E89"></stop>
                                                <stop offset="1" stop-color="#F15F79"></stop>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <span class="rst-quotes-small absolute top-2 right-0 w-full h-full">
                        <svg class="inline-block" width="26" height="21" viewBox="0 0 26 21" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                           <path d="M2.5307 3.365C4.29914 1.46375 6.97513 0.5 10.483 0.5H11.7435V4.02375L10.7301 4.225C9.00323 4.5675 7.802 5.24125 7.15915 6.23C6.82373 6.76266 6.6335 7.37255 6.60707 8H10.483C10.8173 8 11.1379 8.1317 11.3743 8.36612C11.6107 8.60054 11.7435 8.91848 11.7435 9.25V18C11.7435 19.3787 10.6129 20.5 9.22255 20.5H1.65971C1.32541 20.5 1.00481 20.3683 0.768421 20.1339C0.532037 19.8995 0.399237 19.5815 0.399237 19.25V13L0.403019 9.35125C0.391674 9.2125 0.152185 5.925 2.5307 3.365ZM23.0878 20.5H15.5249C15.1906 20.5 14.87 20.3683 14.6336 20.1339C14.3972 19.8995 14.2644 19.5815 14.2644 19.25V13L14.2682 9.35125C14.2569 9.2125 14.0174 5.925 16.3959 3.365C18.1643 1.46375 20.8403 0.5 24.3482 0.5H25.6087V4.02375L24.5953 4.225C22.8684 4.5675 21.6672 5.24125 21.0244 6.23C20.6889 6.76266 20.4987 7.37255 20.4723 8H24.3482C24.6825 8 25.0031 8.1317 25.2395 8.36612C25.4759 8.60054 25.6087 8.91848 25.6087 9.25V18C25.6087 19.3787 24.4781 20.5 23.0878 20.5Z"
                                 fill="url(#paint0_linear_45_403)"></path>
                           <defs>
                              <linearGradient id="paint0_linear_45_403" x1="0.391312" y1="10.5" x2="25.6087" y2="10.5"
                                              gradientUnits="userSpaceOnUse">
                                 <stop stop-color="#C84E89"></stop>
                                 <stop offset="1" stop-color="#F15F79"></stop>
                              </linearGradient>
                           </defs>
                        </svg>
                     </span>
                                </div>
                                <h6 class="rst-text text-coolGray-600 text-2xl
                        italic leading-40.8 border-l-3 border-red-500 pl-6 mt-3 rst_content">
                                    <?php if (!empty($rst_content)) {
                                        echo $rst_content;
                                    } ?>
                                </h6>
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