<div class="span6 ">
    <article class="property-item clearfix">
        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

        <figure>
            <a href="<?php the_permalink(); ?>">
                <?php
                global $post;
                if( has_post_thumbnail( $post->ID ) ) {
                    the_post_thumbnail( 'property-thumb-image' );
                } else {
                    inspiry_image_placeholder( 'property-thumb-image' );
                }
                ?>
            </a>

            <?php display_figcaption( $post->ID ); ?>

        </figure>

        <div class="detail">
            <h5 class="price">
                <?php
                property_price();
                $type_terms = get_the_terms( $post->ID,"property-type" );
                if(!empty($type_terms)){
                    echo '<small> - ';
                    foreach($type_terms as $term){
                        echo $term->name;
                        break;
                    }
                    echo '</small>';
                }
                ?>
            </h5>
            <p><?php framework_excerpt(12); ?></p>
            <a class="more-details" href="<?php the_permalink() ?>"><?php _e('More Details ','framework'); ?><i class="fa fa-caret-right"></i></a>
        </div>

        <div class="property-meta">
            <?php get_template_part('property-details/property-metas'); ?>
        </div>
    </article>
</div>