<?php
$properties_for_map = array(
                        'post_type' => 'property',
                        'posts_per_page' => -1
                    );

if( is_page_template('template-search.php') || is_page_template('template-search-sidebar.php') ){

    /* Apply Search Filter */
    $properties_for_map = apply_filters( 'real_homes_search_parameters', $properties_for_map );

}elseif(is_page_template('template-home.php')){

    /* Apply Homepage Properties Filter */
    $properties_for_map = apply_filters( 'real_homes_homepage_properties', $properties_for_map );

}elseif(is_tax()){

    global $wp_query;
    /* Taxonomy Query */
    $properties_for_map['tax_query'] = array(
                                            array(
                                                'taxonomy' => $wp_query->query_vars['taxonomy'],
                                                'field' => 'slug',
                                                'terms' => $wp_query->query_vars['term']
                                            )
                                        );

}

$properties_for_map_query = new WP_Query( $properties_for_map );

$properties_data = array();

if ( $properties_for_map_query->have_posts() ) :

    while ( $properties_for_map_query->have_posts() ) :

        $properties_for_map_query->the_post();

        $current_prop_array = array();

        /* Property Title */
        $current_prop_array['title'] = get_the_title();

        /* Property Price */
        $current_prop_array['price'] = get_property_price();

        /* Property Location */
        $property_location = get_post_meta($post->ID,'REAL_HOMES_property_location',true);
        if(!empty($property_location)){
            $lat_lng = explode(',',$property_location);
            $current_prop_array['lat'] = $lat_lng[0];
            $current_prop_array['lng'] = $lat_lng[1];
        }

        /* Property Thumbnail */
        if(has_post_thumbnail()){
            $image_id = get_post_thumbnail_id();
            $image_attributes = wp_get_attachment_image_src( $image_id, 'property-thumb-image' );
            if(!empty($image_attributes[0])){
                $current_prop_array['thumb'] = $image_attributes[0];
            }
        }

        /* Property Title */
        $current_prop_array['url'] = get_permalink();

        /* Property Map Icon Based on Property Type */
        $property_type_slug = 'single-family-home'; // Default Icon Slug

        $type_terms = get_the_terms( $post->ID,"property-type" );
        if(!empty($type_terms)){
            foreach($type_terms as $typ_trm){
                $property_type_slug = $typ_trm->slug;
                break;
            }
        }

        if(file_exists(get_template_directory().'/images/map/'.$property_type_slug.'-map-icon.png')){
            $current_prop_array['icon'] = get_template_directory_uri().'/images/map/'.$property_type_slug.'-map-icon.png';
        }else{
            $current_prop_array['icon'] = get_template_directory_uri().'/images/map/single-family-home-map-icon.png';
        }

        $properties_data[] = $current_prop_array;
    endwhile;
    wp_reset_query();
    ?>
    <script type="text/javascript">
        function initializePropertiesMap() {

            /* Properties Array */
            var properties = <?php echo json_encode( $properties_data ); ?>

            /* Map Center Location - From Theme Options */
            var location_center = new google.maps.LatLng(properties[0].lat,properties[0].lng);

            var mapOptions = {
                zoom: 12,
                maxZoom: 16,
                scrollwheel: false
            }

            var map = new google.maps.Map(document.getElementById("listing-map"), mapOptions);

            var bounds = new google.maps.LatLngBounds();

            /* Loop to generate marker and infowindow based on properties array */
            var markers = new Array();
            var info_windows = new Array();

            for (var i=0; i < properties.length; i++) {

                markers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(properties[i].lat,properties[i].lng),
                    map: map,
                    icon: properties[i].icon,
                    title: properties[i].title,
                    animation: google.maps.Animation.DROP,
                    visible: true
                });

                bounds.extend(markers[i].getPosition());

                var boxText = document.createElement("div");
                boxText.className = 'map-info-window';
                boxText.innerHTML = '<a class="thumb-link" href="'+properties[i].url+'">' +
                                        '<img class="prop-thumb" src="'+properties[i].thumb+'" alt="'+properties[i].title+'"/>' +
                                    '</a>' +
                                    '<h5 class="prop-title"><a class="title-link" href="'+properties[i].url+'">'+properties[i].title+'</a></h5>' +
                                    '<p><span class="price">'+properties[i].price+'</span></p>'+
                                    '<div class="arrow-down"></div>';


                var myOptions = {
                    content: boxText,
                    disableAutoPan: true,
                    maxWidth: 0,
                    alignBottom: true,
                    pixelOffset: new google.maps.Size( -122, -48 ),
                    zIndex: null,
                    closeBoxMargin: "0 0 -16px -16px",
                    closeBoxURL: "<?php echo get_template_directory_uri() . '/images/map/close.png'; ?>",
                    infoBoxClearance: new google.maps.Size( 1, 1 ),
                    isHidden: false,
                    pane: "floatPane",
                    enableEventPropagation: false
                };

                var ib = new InfoBox( myOptions );

                attachInfoBoxToMarker( map, markers[i], ib );
            }

            map.fitBounds(bounds);

            /* Marker Clusters */
            var markerClustererOptions = {
                ignoreHidden: true,
                maxZoom: 14,
                styles: [{
                    textColor: '#ffffff',
                    url: "<?php echo get_template_directory_uri() . '/images/map/cluster-icon.png'; ?>",
                    height: 48,
                    width: 48
                }]
            };

            var markerClusterer = new MarkerClusterer( map, markers, markerClustererOptions );

            function attachInfoBoxToMarker( map, marker, infoBox ){
                google.maps.event.addListener( marker, 'click', function(){
                    var scale = Math.pow( 2, map.getZoom() );
                    var offsety = ( (100/scale) || 0 );
                    var projection = map.getProjection();
                    var markerPosition = marker.getPosition();
                    var markerScreenPosition = projection.fromLatLngToPoint( markerPosition );
                    var pointHalfScreenAbove = new google.maps.Point( markerScreenPosition.x, markerScreenPosition.y - offsety );
                    var aboveMarkerLatLng = projection.fromPointToLatLng( pointHalfScreenAbove );
                    map.setCenter( aboveMarkerLatLng );
                    infoBox.open( map, marker );
                });
            }

        }

        google.maps.event.addDomListener( window, 'load', initializePropertiesMap );

    </script>

    <div id="map-head">
        <div id="listing-map"></div>
    </div>
    <!-- End Map Head -->

    <?php
else:
    if(is_tax()){
        get_template_part('banners/taxonomy_page_banner');
    }else{
        get_template_part('banners/default_page_banner');
    }
endif;
?>