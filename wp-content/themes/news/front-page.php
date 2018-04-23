<?php
/* Template Name: Home */
get_header();
?>
    <div class="slider-section">
        <div class="container-fluid">
            <div class="row">
                <?php
                    $args = array(
                        'post_type'  => 'post',
                        'meta_query' => array(
                            array(
                                'key'     => 'my_meta_box_check',
                                'value'   => 'yes',
                                'compare' => '=',
                            )
                        ),
                    );

                    $posts = get_posts( $args );
                ?>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                            foreach($posts as $post):
                                $featured_img_url = get_the_post_thumbnail_url($post->ID,'full');
                               ?>
                                <div class="swiper-slide">

                                    <div class="col-md-4 post-content d-flex justify-content-between flex-column">
                                        <div class="post-title">
                                            <h4><?php echo $post->post_title;?></h4>
                                        </div>
                                        <div class="post-info">
                                            <div class="post-time">
                                                <span class="post-date"><?php echo get_the_date( "j F, Y", $post->ID );?></span>
                                            </div>
                                            <div class="post-category">
                                                <?php
                                                $terms = get_the_terms($post->ID, 'category');
                                                if (! empty($terms)) {
                                                    foreach ($terms as $term) {
                                                        $url = get_term_link($term->slug, 'category');
                                                        echo "<a class=\"btn btn-light btn-sm\" href='{$url}'>{$term->name}</a>";
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="featured-image" style="background-image: url(<?php echo $featured_img_url;?>);"></div>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach;
                        wp_reset_postdata();
                        ?>

                    </div>
                    <div class="slider-nav">
                        <div class="swiper-button_prev"></div>
                        <div class="seperator"></div>
                        <div class="swiper-button_next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 about-column">
                    <div class="row">
                        <div class="about-title content-title">
                            <h4>О Нас</h4>
                        </div>
                        <div class="about-content">
                            <?php
                            $about = get_post_meta(get_the_ID(),'cm_meta_content',true);
                            echo '<p>'.$about.'</p>';
                            ?>
                        </div>
                    </div>

                </div>
                <div class="col-md-8 news-column">
                    <div class="content-title">
                        <h4>Новости</h4>
                    </div>
                    <div class="latest-news ">
                        <?php
                            $args = array(
                                'post_type'  => 'post',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'category',
                                        'field' => 'name',
                                        'terms' => 'Новости', // Where term_id of Term 1 is "1".
                                        'include_children' => false
                                    )
                                )
                            );

                            $posts = get_posts( $args );
                            foreach ($posts as $post):
                                $featured_img_url = get_the_post_thumbnail_url($post->ID,'full');
                            $checked = get_post_meta($post->ID,'my_meta_box_check');
                            if($checked[0]=='yes') continue;
                        ?>
                                <div class="news d-flex">
                                    <div class="col-md-2 post-img" style="background-image: url(<?php echo $featured_img_url;?>)">

                                    </div>
                                    <div class="col-md-10 ">
                                        <div class="post-content d-flex justify-content-between flex-column">
                                            <div class="post-date ">
                                                <span class="post-time"><?php echo get_the_date( "j F, Y", $post->ID );?></span>
                                            </div>
                                            <div class="post-title">
                                                <?php echo $post->post_title;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;
                                wp_reset_postdata();
                                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="default-content">
        <?php the_content();?>
    </div>

<?php
 get_footer();
?>