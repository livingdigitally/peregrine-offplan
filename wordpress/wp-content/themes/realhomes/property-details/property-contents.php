<article class="property-item clearfix">
    <div class="wrap clearfix">
        <h4 class="title">
            <?php

            /* Property ID if exists */
            $property_id = get_post_meta($post->ID, 'REAL_HOMES_property_id', true);
            if(!empty($property_id)){
                echo __('Property ID','framework').' : '.$property_id;
            }

            ?>
        </h4>
        <h5 class="price">
            <span class="status-label">
                <?php
                /* Property Status. For example: For Sale, For Rent */
                $status_terms = get_the_terms( $post->ID,"property-status" );
                if(!empty( $status_terms )){
                    $status_count = 0;
                    foreach( $status_terms as $term ){
                        if( $status_count > 0 ){
                            echo ', ';
                        }
                        echo $term->name;
                        $status_count++;
                    }
                }else{
                    echo '&nbsp;';
                }
                ?>
            </span>
            <span>
                <?php
                /* Property Price */
                property_price();

                /* Property Type. For example: Villa, Single Family Home */
                $type_terms = get_the_terms( $post->ID,"property-type" );
                $type_count = count($type_terms);
                if(!empty($type_terms)){
                    echo '<small> - ';
                    $loop_count = 1;
                    foreach($type_terms as $typ_trm){
                        echo $typ_trm->name;
                        if($loop_count < $type_count && $type_count > 1){
                            echo ', ';
                        }
                        $loop_count++;
                    }
                    echo '</small>';
                }else{
                    echo '&nbsp;';
                }
                ?>
            </span>
        </h5>
    </div>

    <div class="property-meta clearfix">
        <?php
        /* Property Icons */
        get_template_part('property-details/property-metas');

        $fav_button = get_option('theme_enable_fav_button');
        if( $fav_button == "true" ){
            ?>
            <!-- Add to favorite -->
            <span class="add-to-fav">
                <?php
                if( is_user_logged_in() ){
                    $user_id = get_current_user_id();
                    $property_id = get_the_ID();
                    if ( is_added_to_favorite( $user_id, $property_id ) ) {
                        ?>
                        <div id="fav_output" class="show"><i class="fa fa-star dim"></i>&nbsp;<span id="fav_target" class="dim"><?php _e('Added to Favorites','framework'); ?></span></div>
                        <?php
                    } else {
                        ?>
                        <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" id="add-to-favorite-form">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
                            <input type="hidden" name="property_id" value="<?php echo $property_id; ?>" />
                            <input type="hidden" name="action" value="add_to_favorite" />
                        </form>
                        <div id="fav_output"><i class="fa fa-star dim"></i>&nbsp;<span id="fav_target" class="dim"></span></div>
                        <a id="add-to-favorite" href="#"><i class="fa fa-star"></i>&nbsp;<?php _e('Add to Favorites','framework'); ?></a>
                        <?php
                    }
                }else{
                    ?><a href="#login-modal" data-toggle="modal"><i class="fa fa-star"></i>&nbsp;<?php _e('Add to Favorites','framework'); ?></a><?php
                }
                ?>
            </span>
        <?php } ?>

        <!-- Print link -->
        <span class="printer-icon"><a href="javascript:window.print()"><?php _e('Print','framework'); ?></a></span>
    </div>

    <div class="content clearfix">
        <?php
        the_content();

        // Property Additional Details
        get_template_part( 'property-details/property-additional-details' );
        ?>
    </div>


    <?php
    /* Property Features */
    $features_terms = get_the_terms( $post->ID,"property-feature" );
    if(!empty($features_terms)){
        ?>
        <div class="features">
            <?php
            $property_features_title = get_option('theme_property_features_title');
            if(!empty($property_features_title)){
                ?><h4 class="title"><?php echo $property_features_title; ?></h4><?php
            }
            ?>
            <ul class="arrow-bullet-list clearfix">
            <?php
            foreach($features_terms as $fet_trms){
                echo '<li><a href="'.get_term_link($fet_trms->slug, 'property-feature').'">'.$fet_trms->name.'</a></li>';
            }
            ?>
            </ul>
        </div>
        <?php
    }
    ?>
</article>