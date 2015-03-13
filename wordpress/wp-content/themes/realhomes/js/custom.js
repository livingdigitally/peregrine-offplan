(function($){

    "use strict";

    $(document).ready(function() {

        /*-----------------------------------------------------------------------------------*/
        /* For RTL Languages
         /*-----------------------------------------------------------------------------------*/
        if( $('body').hasClass('rtl') ) {
            $('.contact-number .fa-phone,' +
                '.more-details .fa-caret-right').addClass('fa-flip-horizontal');
        }

        /*-----------------------------------------------------------------------------------*/
        /* Cross Browser
        /*-----------------------------------------------------------------------------------*/
        $('.property-item .features span:last-child').css('border', 'none');
        $('.dsidx-prop-title').css('margin','0 0 15px 0');
        $('.dsidx-prop-summary a img').css('border','none');


        /*-----------------------------------------------------------------------------------*/
        /* Main Menu Dropdown Control
        /*-----------------------------------------------------------------------------------*/
        $('.main-menu ul li').hover(function(){
            $(this).children('ul').stop(true, true).slideDown(200);
        },function(){
            $(this).children('ul').stop(true, true).delay(50).slideUp(750);
        });


        /*-----------------------------------------------------------------------------------*/
        /*	Responsive Nav
        /*-----------------------------------------------------------------------------------*/
        var $mainNav    = $('.main-menu > div > ul');
        var optionsList = '<option value="" selected>'+ localized.nav_title +'</option>';

        $mainNav.find('li').each(function() {
            var $this   = $(this),
                $anchor = $this.children('a'),
                depth   = $this.parents('ul').length - 1,
                indent  = '';
            if( depth ) {
                while( depth > 0 ) {
                    indent += ' - ';
                    depth--;
                }
            }
            optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
        }).end().last()
            .after('<select class="responsive-nav">' + optionsList + '</select>');

        $('.responsive-nav').on('change', function() {
            window.location = $(this).val();
        });


        /*-----------------------------------------------------------------------------------*/
        /*	Flex Slider
        /*-----------------------------------------------------------------------------------*/
        if(jQuery().flexslider)
        {
            // Flex Slider for Homepage
            $('#home-flexslider .flexslider').flexslider({
                animation: "fade",
                slideshowSpeed: 7000,
                animationSpeed:	1500,
                directionNav: true,
                controlNav: false,
                keyboardNav: true,
                start: function (slider) {
                    slider.removeClass('loading');
                }
            });

            // Remove Flex Slider Navigation for Smaller Screens Like IPhone Portrait
            $('.slider-wrapper , .listing-slider').hover(function(){
                var mobile = $('body').hasClass('probably-mobile');
                if(!mobile)
                {
                    $('.flex-direction-nav').stop(true,true).fadeIn('slow');
                }
            },function(){
                $('.flex-direction-nav').stop(true,true).fadeOut('slow');
            });

            // Flex Slider for Detail Page
            $('#property-detail-flexslider .flexslider').flexslider({
                animation: "slide",
                directionNav: false,
                controlNav: "thumbnails"
            });

            // Flex Slider Gallery Post
            $('.listing-slider ').flexslider({
                animation: "slide"
            });

            /* Property detail page slider variation two */
            $('#property-carousel-two').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 113,
                itemMargin: 10,
                // move: 1,
                asNavFor: '#property-slider-two'
            });
            $('#property-slider-two').flexslider({
                animation: "slide",
                directionNav: true,
                controlNav: false,
                animationLoop: false,
                slideshow: true,
                sync: "#property-carousel-two",
                start: function (slider) {
                    slider.removeClass('loading');
                }
            });

        }


        /*-----------------------------------------------------------------------------------*/
        /*	jCarousel
        /*-----------------------------------------------------------------------------------*/
        if(jQuery().jcarousel){
            // Jcarousel for Detail Page
            jQuery('#property-detail-flexslider .flex-control-nav').jcarousel({
                vertical: true,
                scroll:1
            });

            // Jcarousel for partners
            jQuery('.brands-carousel .brands-carousel-list ').jcarousel({
                scroll:1
            });
        }


        /*-----------------------------------------------------------------------------------*/
        /*	Carousel - Elastislide
        /*-----------------------------------------------------------------------------------*/
        var param = {
            speed : 500,
            imageW : 245,
            minItems : 1,
            margin : 30,
            onClick : function($object) {
                window.location = $object.find('a').first().attr('href');
                return true;
            }
        };

        function cstatus(a,b,c){
            var temp = a.children("li");
            temp.last().attr('style', 'margin-right: 0px !important');
            if ( temp.length > c ) { b.elastislide(param); }
        };

        if(jQuery().elastislide){
            var fp = $('.featured-properties-carousel .es-carousel-wrapper ul'),
                fpCarousel = $('.featured-properties-carousel .carousel');

            cstatus(fp,fpCarousel,4);
        }


        /*-------------------------------------------------------*/
        /*	 Focus and Blur events with input elements
        /* -----------------------------------------------------*/
        var addFocusAndBlur = function($input, $val){
            $input.focus(function(){
                if ( $(this).value == $val ){
                    $(this).value = '';
                }
            });

            $input.blur(function(){
                if ( $(this).value == '' ) {
                    $(this).value = $val;
                }
            });
        };

        // Attach the events
        addFocusAndBlur(jQuery('#principal'),'Principal');
        addFocusAndBlur(jQuery('#interest'),'Interest');
        addFocusAndBlur(jQuery('#payment'),'Payment');
        addFocusAndBlur(jQuery('#texes'),'Texes');
        addFocusAndBlur(jQuery('#insurance'),'Insurance');
        addFocusAndBlur(jQuery('#pmi'),'PMI');
        addFocusAndBlur(jQuery('#extra'),'Extra');


        /*-----------------------------------------------------------------------------------*/
        /*	Apply Bootstrap Classes on Comment Form Fields to Make it Responsive
        /*-----------------------------------------------------------------------------------*/
        $('#respond #submit, #dsidx-contact-form-submit').addClass('real-btn');
        $('.pages-nav > a').addClass('real-btn');
        $('.dsidx-search-button .submit').addClass('real-btn');
        $('.wpcf7-submit').addClass('real-btn');

        /*----------------------------------------------------------------------------------*/
        /* Contact Form AJAX validation and submission
        /* Validation Plugin : http://bassistance.de/jquery-plugins/jquery-plugin-validation/
        /* Form Ajax Plugin : http://www.malsup.com/jquery/form/
        /*---------------------------------------------------------------------------------- */
        if(jQuery().validate && jQuery().ajaxSubmit)
        {
            // Contact Form Handling
            var contact_options = {
                target: '#message-sent',
                beforeSubmit: function(){
                    $('#contact-loader').fadeIn('fast');
                    $('#message-sent').fadeOut('fast');
                },
                success: function(){
                    $('#contact-loader').fadeOut('fast');
                    $('#message-sent').fadeIn('fast');
                }
            };

            $('#contact-form .contact-form').validate({
                errorLabelContainer: $("div.error-container"),
                submitHandler: function(form) {
                    $(form).ajaxSubmit(contact_options);
                }
            });


            // Agent Message Form Handling
            var agent_form_options = {
                target: '#message-sent',
                beforeSubmit: function(){
                    $('#contact-loader').fadeIn('fast');
                    $('#message-sent').fadeOut('fast');
                },
                success: function(){
                    $('#contact-loader').fadeOut('fast');
                    $('#message-sent').fadeIn('fast');
                }
            };

            $('#agent-contact-form').validate({
                errorLabelContainer: $("div.error-container"),
                submitHandler: function(form) {
                    $(form).ajaxSubmit(agent_form_options);
                }
            });

        }



        /*-----------------------------------------------------------------------------------*/
        /* Swipe Box Lightbox
        /*-----------------------------------------------------------------------------------*/
        if( jQuery().swipebox )
        {
            $(".swipebox").swipebox();
        }


        /*-----------------------------------------------------------------------------------*/
        /* Pretty Photo Lightbox
        /*-----------------------------------------------------------------------------------*/
        if( jQuery().prettyPhoto )
        {
            $(".pretty-photo").prettyPhoto({
                deeplinking: false,
                social_tools: false
            });

            $('a[data-rel]').each(function() {
                $(this).attr('rel', $(this).data('rel'));
            });

            $("a[rel^='prettyPhoto']").prettyPhoto({
                overlay_gallery: false,
                social_tools:false
            });
        }



        /*-------------------------------------------------------*/
        /*	Isotope
        /*------------------------------------------------------*/
        if( jQuery().isotope )
        {
            $(function() {

                var container = $('.isotope'),
                    filterLinks = $('#filter-by a');

                filterLinks.click(function(e){
                    var selector = $(this).attr('data-filter');
                    container.isotope({
                        filter : '.' + selector,
                        itemSelector : '.isotope-item',
                        layoutMode : 'fitRows',
                        animationEngine : 'best-available'
                    });

                    filterLinks.removeClass('active');
                    $('#filter-by li').removeClass('current-cat');
                    $(this).addClass('active');
                    e.preventDefault();
                });

                /* to fix floating bugs due to variation in height */
                setTimeout(function () {
                    container.isotope({
                        filter: "*",
                        layoutMode: 'fitRows',
                        itemSelector: '.isotope-item',
                        animationEngine: 'best-available'
                    });
                }, 1000);

            });
        }



        /* ---------------------------------------------------- */
        /*	Gallery Hover Effect
        /* ---------------------------------------------------- */

        var $mediaContainer=$('.gallery-item .media_container'),
            $media=$('.gallery-item .media_container a');

        var $margin= -($media.height()/2);
        $media.css('margin-top',$margin);

        $(function(){

            $('.gallery-item figure').hover(

                function(){
                    var media= $media.width(),
                        container= ($mediaContainer.width()/2)-(media+2);

                    $(this).children('.media_container').stop().fadeIn(300);
                    $(this).find('.media_container').children('a.link').stop().animate({'right':container}, 300);
                    $(this).find('.media_container').children('a.zoom').stop().animate({'left':container}, 300);
                },
                function(){
                    $(this).children('.media_container').stop().fadeOut(300);
                    $(this).find('.media_container').children('a.link').stop().animate({'right':'0'}, 300);
                    $(this).find('.media_container').children('a.zoom').stop().animate({'left':'0'}, 300);
                }

            );

        });



        /* ---------------------------------------------------- */
        /*  Sizing Header Outer Strip
        /* ---------------------------------------------------- */
        function outer_strip(){
            var $item    = $('.outer-strip'),
                $c_width = $('.header-wrapper .container').width(),
                $w_width = $(window).width(),
                $i_width = ($w_width -  $c_width)/2;

            if( $('body').hasClass('rtl') ){
                $item.css({
                    left: -$i_width,
                    width: $i_width
                });
            }else{
                $item.css({
                    right: -$i_width,
                    width: $i_width
                });
            }
        }

        outer_strip();
        $(window).resize(function(){
            outer_strip();
        });


        /* ---------------------------------------------------- */
        /*	Notification Hide Function
        /* ---------------------------------------------------- */
        $(".icon-remove").click(function() {
           $(this).parent().fadeOut(300);
        });


        /*-----------------------------------------------------------------------------------*/
        /*	Image Hover Effect
        /*-----------------------------------------------------------------------------------*/
        if(jQuery().transition)
        {
            $('.zoom_img_box img').hover(function(){
                $(this).stop(true,true).transition({
                    scale: 1.1
                },300);
            },function(){
                $(this).stop(true,true).transition({
                    scale: 1
                },150);
            });
        }


        /*-----------------------------------------------------------------------------------*/
        /*	Grid and Listing Toggle View
        /*-----------------------------------------------------------------------------------*/
        if($('.lisitng-grid-layout').hasClass('property-toggle')) {
            $('.listing-layout  .property-item-grid').hide();
            $('a.grid').on('click', function(){
                      $('.listing-layout').addClass('property-grid');
                      $('.property-item-grid').show();
                      $('.property-item-list').hide();
                      $('a.grid').addClass('active');
                      $('a.list').removeClass('active');
            });
            $('a.list').on('click', function(){
                $('.listing-layout').removeClass('property-grid');
                $('.property-item-grid').hide();
                $('.property-item-list').show();
                $('a.grid').removeClass('active');
                $('a.list').addClass('active');
            });
         }


        /*-----------------------------------------------------------------------------------*/
        /* Calendar Widget Border Fix
        /*-----------------------------------------------------------------------------------*/
        var $calendar = $('.sidebar .widget #wp-calendar');
        if( $calendar.length > 0){
            $calendar.each(function(){
                $(this).closest('.widget').css('border','none').css('background','transparent');
            });
        }

        var $single_listing = $('.sidebar .widget .dsidx-widget-single-listing');
        if( $single_listing.length > 0){
            $single_listing.each(function(){
                $(this).closest('.widget').css('border','none').css('background','transparent');
            });
        }

        /*-----------------------------------------------------------------------------------*/
        /*	Tags Cloud
        /*-----------------------------------------------------------------------------------*/
        $('.tagcloud').addClass('clearfix');
        $('.tagcloud a').removeAttr('style');

        /*-----------------------------------------------------------------------------------*/
        /*	Max and Min Price Related JavaScript - to show red outline of min is bigger than max
        /*-----------------------------------------------------------------------------------*/
        $('#select-min-price,#select-max-price').change(function(obj, e){
            var min_text_val = $('#select-min-price').val();
            var min_int_val = (isNaN(min_text_val))?0:parseInt(min_text_val);

            var max_text_val = $('#select-max-price').val();
            var max_int_val = (isNaN(max_text_val))?0:parseInt(max_text_val);

            if( (min_int_val >= max_int_val) && (min_int_val != 0) && (max_int_val != 0)){
                $('#select-max-price_input,#select-min-price_input').css('outline','2px solid red');
            }else{
                $('#select-max-price_input,#select-min-price_input').css('outline','none');
            }
        });

        $('#select-min-price-for-rent, #select-max-price-for-rent').change(function(obj, e){
            var min_text_val = $('#select-min-price-for-rent').val();
            var min_int_val = (isNaN(min_text_val))?0:parseInt(min_text_val);

            var max_text_val = $('#select-max-price-for-rent').val();
            var max_int_val = (isNaN(max_text_val))?0:parseInt(max_text_val);

            if( (min_int_val >= max_int_val) && (min_int_val != 0) && (max_int_val != 0)){
                $('#select-max-price-for-rent_input,#select-min-price-for-rent_input').css('outline','2px solid red');
            }else{
                $('#select-max-price-for-rent_input,#select-min-price-for-rent_input').css('outline','none');
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /*	Max and Min Area Related JavaScript - to show red outline of min is bigger than max
         /*-----------------------------------------------------------------------------------*/
        $('#min-area,#max-area').change(function(obj, e){
            var min_text_val = $('#min-area').val();
            var min_int_val = (isNaN(min_text_val))?0:parseInt(min_text_val);

            var max_text_val = $('#max-area').val();
            var max_int_val = (isNaN(max_text_val))?0:parseInt(max_text_val);

            if( (min_int_val >= max_int_val) && (min_int_val != 0) && (max_int_val != 0)){
                $('#min-area,#max-area').css('outline','2px solid red');
            }else{
                $('#min-area,#max-area').css('outline','none');
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /*	Property ID Change Event
        /*-----------------------------------------------------------------------------------*/
        /*$('.advance-search-form #property-id-txt').change(function(obj, e){
            var search_form = $(this).closest('form.advance-search-form');
            var input_controls = search_form.find('input').not('#property-id-txt, .real-btn');
            if( $(this).val().length > 0  ){
                input_controls.prop('disabled', true);
            }else{
                input_controls.prop('disabled', false);
            }
        });*/

        /*-----------------------------------------------------------------------------------*/
        /* Submit Property Page
        /*-----------------------------------------------------------------------------------*/



        /* Validate Form */
        if( jQuery().validate ){

            //Login
            $('#login-form').validate();

            //Register
            $('#register-form').validate();

            //Forgot Password
            $('#forgot-form').validate();

        }

        /* Forgot Form */
        $('.login-register #forgot-form').slideUp('fast');
        $('.login-register .toggle-forgot-form').click(function(event){
            event.preventDefault();
            $('.login-register #forgot-form').slideToggle('fast');
        });


        /* dsIDXpress */
        $('#dsidx-top-search #dsidx-search-form table td').removeClass('label');
        $('.dsidx-tag-pre-foreclosure br').replaceWith(' ');


        /*-----------------------------------------------------------------------------------*/
        /* Display Price Fields Based on Status Selection
        /*-----------------------------------------------------------------------------------*/
        if ( typeof localized.rent_slug !== "undefined" ){
            var property_status_changed = function( new_status ){
                var price_for_others = $('.advance-search-form .price-for-others');
                var price_for_rent = $('.advance-search-form .price-for-rent');
                if( price_for_others.length > 0 && price_for_rent.length > 0){
                    if( new_status == localized.rent_slug ){
                        price_for_others.addClass('hide-fields').find('select').prop('disabled', true);
                        price_for_rent.removeClass('hide-fields').find('select').prop('disabled', false);
                    }else{
                        price_for_rent.addClass('hide-fields').find('select').prop('disabled', true);
                        price_for_others.removeClass('hide-fields').find('select').prop('disabled', false);
                    }
                }
            }
            $('.advance-search-form #select-status').change(function(e){
                var selected_status = $(this).val();
                property_status_changed(selected_status);
            });
            /* On page load ( as on search page ) */
            var selected_status = $('.advance-search-form #select-status').val();
            if( selected_status == localized.rent_slug ){
                property_status_changed(selected_status);
            }
        }

        /*-----------------------------------------------------------------------------------*/
        /* Properties Sorting
        /*-----------------------------------------------------------------------------------*/
        function insertParam(key, value) {
            key = encodeURI(key);
            value = encodeURI(value);

            var kvp = document.location.search.substr(1).split('&');

            var i = kvp.length;
            var x;
            while (i--) {
                x = kvp[i].split('=');

                if (x[0] == key) {
                    x[1] = value;
                    kvp[i] = x.join('=');
                    break;
                }
            }

            if (i < 0) {
                kvp[kvp.length] = [key, value].join('=');
            }

            //this will reload the page, it's likely better to store this until finished
            document.location.search = kvp.join('&');
        }

        $('#sort-properties').on('change', function() {
            var key = 'sortby';
            var value = $(this).val();
            insertParam( key, value );
        });

        /*-----------------------------------------------------------------------------------*/
        /* Modal dialog for Login and Register
        /*-----------------------------------------------------------------------------------*/
        $('.activate-section').click(function(e){
            e.preventDefault();
            var $this = $(this);
            var target_section = $this.data('section');
            $this.closest('.modal-section').hide();
            $this.closest('.forms-modal').find('.'+target_section).show();
        });

        /*-----------------------------------------------------------------------------------*/
        /* Add to favorites
        /*-----------------------------------------------------------------------------------*/
        $('a#add-to-favorite').click(function(e){
            e.preventDefault();
            var $star = $(this).find('i');
            var add_to_fav_opptions = {
                target:        '#fav_target',   // target element(s) to be updated with server response
                beforeSubmit:  function(){
                    $star.addClass('fa-spin');
                },  // pre-submit callback
                success:       function(){
                    $star.removeClass('fa-spin');
                    $('#add-to-favorite').hide(0,function(){
                        $('#fav_output').delay(200).show();
                    });
                }
            };

            $('#add-to-favorite-form').ajaxSubmit( add_to_fav_opptions );
        });

        /*-----------------------------------------------------------------------------------*/
        /* Remove from favorites
        /*-----------------------------------------------------------------------------------*/
        $('a.remove-from-favorite').click(function(event){
            event.preventDefault();
            var $this = $(this);
            var property_item = $this.closest('.property-item');
            var loader = $this.siblings('.loader');
            var ajax_response = property_item.find('.ajax-response');

            $this.hide();
            loader.show();

            var remove_favorite_request = $.ajax({
                url: $this.attr('href'),
                type: "POST",
                data: {
                    property_id : $this.data('property-id'),
                    user_id : $this.data('user-id'),
                    action : "remove_from_favorites"
                },
                dataType: "html"
            });


            remove_favorite_request.done(function( msg ) {
                var code = parseInt(msg);
                loader.hide();

                if(code == 3){
                    property_item.remove();
                }else if( code == 2){
                    ajax_response.text("Failed to remove!");
                }else if( code == 1){
                    ajax_response.text("Invalide Parameters!");
                }else{
                    ajax_response.text("Unexpected Response: "+ msg);
                }

            });

            remove_favorite_request.fail(function( jqXHR, textStatus ) {
                ajax_response.text( "Request failed: " + textStatus );
            });
        });

        /*-----------------------------------------------------------------------------------*/
        /* Search Location Select Boxes
        /*-----------------------------------------------------------------------------------*/

        if ( typeof locationData !== "undefined" ) {

            /* initialize required variables to data passed by WordPress */
            var allLocations = locationData.all_locations;
            var selectIds = locationData.select_names;
            var selectCount = parseInt( locationData.select_count );
            var locationsInParams = locationData.locations_in_params;
            var any = locationData.any;
            var locationsCount = allLocations.length;

            /* Add child of given term id in provided select box */
            var addChildLocations = function( parentID, targetSelect, prefix, all_child ) {
                var childLocations = [];
                var childLocationsCounter = 0;

                // add 'Any' option to empty select
                if( targetSelect.has('option').length == 0 ){
                    targetSelect.append( '<option value="any" selected="selected">'+ any +'</option>' );
                }

                for( var i=0; i < locationsCount; i++ ) {
                    var currentLocation = allLocations[i];
                    if( parseInt( currentLocation['parent'] ) == parentID ) {
                        targetSelect.append( '<option value="' + currentLocation['slug'] + '">' + prefix + currentLocation['name'] + '</option>' );
                        childLocations[childLocationsCounter] = currentLocation;
                        childLocationsCounter++;
                        if( all_child ) {
                            var currentLocationID = parseInt( currentLocation['term_id'] );
                            addChildLocations ( currentLocationID, targetSelect, prefix + '- ', all_child );
                        }
                    }
                }
                return childLocations;
            };

            /* Get Related Term ID */
            var getRelatedTermID = function ( selectedLocation ){
                var termID = 0;
                var currentLocation;
                // loop through all locations and match selected slug with each one to find the related term id which will be used as parent id later on
                for( var i=0; i < locationsCount; i++ ){
                    currentLocation = allLocations[i];
                    if( currentLocation['slug'] == selectedLocation ) {
                        termID = parseInt( currentLocation['term_id'] );
                        break;
                    }
                }
                return termID;
            };

            /* Reset a Select Box */
            var resetSelect = function ( targetSelect ){
                targetSelect.empty();
                targetSelect.append( '<option value="any" selected="selected">'+ any +'</option>' );
            };

            /* Disable a Select Box and Next Possible Select Boxes */
            var disableSelect = function ( targetSelect ) {

                resetSelect( targetSelect );
                targetSelect.closest('.option-bar').addClass('disabled').find('.selectbox').val( any );

                var targetSelectID = targetSelect.attr('id');                    // target select box id
                var targetSelectIndex = selectIds.indexOf(targetSelectID);      // target select box index
                var nextSelectBoxesCount = selectCount - ( targetSelectIndex + 1 );

                // disable next select boxes
                if( nextSelectBoxesCount > 0 ) {
                    for ( var i = targetSelectIndex + 1; i < selectCount; i++ ) {
                        var tempSelect = $( '#' + selectIds[i] );
                        resetSelect( tempSelect );
                        tempSelect.closest('.option-bar').addClass('disabled').find('.selectbox').val( any );
                    }
                }
            };

            /* Enable Select Box */
            var enableSelect = function ( targetSelect ) {
                var optionWrapper = targetSelect.closest('.option-bar');
                if( optionWrapper.hasClass('disabled') ){
                    optionWrapper.removeClass('disabled');
                }
            };

            /* Parent Select Box Change Event */
            var updateChildSelect = function ( event ) {
                var selectedLocation = $(this).val();                                               // get selected slug
                var currentSelectIndex = selectIds.indexOf( $(this).attr('id') );                   // current select box index

                /* in case of any selection */
                if ( selectedLocation == 'any' && currentSelectIndex > -1 && currentSelectIndex < ( selectCount - 1 ) ) {  // no need to run this on last select box

                    for( var s = currentSelectIndex; s < ( selectCount - 1 ); s++ ) {

                        var childSelectIsLast = ( selectCount == ( s + 2 ) );

                        /* init required variables */
                        var childSelect = $( '#'+selectIds[ s + 1 ] );
                        var childSelectClone = childSelect.clone();                                 // clone child select box
                        childSelectClone.empty();                                                   // make it empty

                        /* loop through select options to find and add child locations into next select */
                        var anyChildLocations = [];
                        $( '#' + selectIds[s] + ' > option').each( function() {
                            var currentOptionVal = this.value;
                            if ( currentOptionVal != 'any' ) {
                                var relatedTermID = getRelatedTermID( currentOptionVal );
                                if ( relatedTermID > 0 ){
                                    var tempLocations = addChildLocations ( relatedTermID, childSelectClone, '', childSelectIsLast );
                                    if ( tempLocations.length > 0 ){
                                        anyChildLocations = $.merge( anyChildLocations, tempLocations );
                                    }
                                }
                            }
                        });

                        /* enable next select if options are added otherwise disable it */
                        if( anyChildLocations.length > 0 ) {
                            enableSelect( childSelect );                                    // enable child select box
                            var childSelectWrapper = childSelect.closest( '.selectwrap' );
                            childSelectWrapper.empty();                                     // remove the old select box

                            if( !childSelectIsLast ){
                                childSelectClone.change( updateChildSelect );
                            }

                            childSelectWrapper.append( childSelectClone );                  // add the newly created into it's wrapper
                            childSelectClone.selectbox();                                   // apply selectbox api on newly created select box
                        } else {
                            disableSelect( childSelect );
                            break;
                        }

                    }

                    /* in case of valid location selection */
                } else {
                    var parentID = getRelatedTermID( selectedLocation );                        // get related term id that will be used as parent id below
                    if( parentID > 0 ) {                                                        // We can only do something if term id is valid
                        var childLocations = [];
                        for( var n = currentSelectIndex + 1; n < selectCount; n++ ) {
                            var childSelect = $( '#'+selectIds[ n ] );                          // selector for next( child locations ) select box
                            var childSelectIsLast = ( selectCount == ( n + 1 ) );
                            var childSelectClone = childSelect.clone();                         // clone child select box
                            childSelectClone.empty();                                           // make it empty

                            if( childLocations.length == 0 ){    // 1st iteration
                                childLocations = addChildLocations( parentID, childSelectClone, '', childSelectIsLast );    // add all children
                            } else if( childLocations.length > 0 ) {  // 2nd and later iterations
                                var currentLocations = [];
                                for( var i = 0; i < childLocations.length; i++ ) {
                                    var tempLocations = addChildLocations ( parseInt( childLocations[i]['term_id']), childSelectClone, '', childSelectIsLast );
                                    if( tempLocations.length > 0 ) {
                                        currentLocations = $.merge( currentLocations, tempLocations );
                                    }
                                }
                                childLocations = currentLocations;
                            }

                            if( childLocations.length > 0 ) {
                                enableSelect( childSelect );                                    // enable child select box
                                var childSelectWrapper = childSelect.closest( '.selectwrap' );
                                childSelectWrapper.empty();                                     // remove the old select box
                                if( !childSelectIsLast ){
                                    childSelectClone.change( updateChildSelect );
                                }
                                childSelectWrapper.append( childSelectClone );                  // add the newly created into it's wrapper
                                childSelectClone.selectbox();                                   // apply selectbox api on newly created select box
                            } else {
                                disableSelect( childSelect );
                                break;
                            }

                        }
                    }
                }

            };

            /* Mark the current value in query params as selected */
            var selectRightOption = function ( targetSelect  ) {
                if( Object.keys(locationsInParams).length > 0 ){
                    var selectName = targetSelect.attr('name');
                    if ( typeof locationsInParams[ selectName ] != 'undefined' ) {
                        targetSelect.find( 'option[value="'+ locationsInParams[ selectName ] +'"]' ).prop('selected', true);
                    }
                }
            }

            /* Initialize Locations */
            var initLocations = function () {

                var parentLocations = [];
                for( var s=0; s < selectCount; s++ ){

                    var currentSelect = $( '#'+selectIds[s] );
                    var currentIsLast = ( selectCount == (s + 1) );

                    // 1st iteration
                    if( s == 0 ) {
                        parentLocations = addChildLocations ( 0, currentSelect, '', currentIsLast );

                    // later iterations
                    } else {
                        if( parentLocations.length > 0 ) {
                            var currentLocations = [];
                            var previousSelect = $( '#'+selectIds[s-1] );

                            // loop through all if value is any
                            if ( previousSelect.val() == 'any' ) {
                                for (var i = 0; i < parentLocations.length; i++) {
                                    var tempLocations = addChildLocations(parseInt(parentLocations[i]['term_id']), currentSelect, '', currentIsLast );
                                    if (tempLocations.length > 0) {
                                        currentLocations = $.merge(currentLocations, tempLocations);
                                    }
                                }

                            // else display only children of current value
                            } else {
                                var parentID = getRelatedTermID( previousSelect.val() );
                                if( parentID > 0 ) {
                                    currentLocations = addChildLocations( parentID, currentSelect, '', currentIsLast );
                                }
                            }
                            previousSelect.change( updateChildSelect );
                            parentLocations = currentLocations;
                        }
                    }

                    // based on what happens above
                    if ( parentLocations.length == 0 ) {
                        disableSelect( currentSelect );
                        break;
                    } else {
                        selectRightOption( currentSelect );
                    }

                }
            }

            /* Runs on Load */
            initLocations();

        }


        /*-------------------------------------------------------*/
        /*	Select Box
        /* -----------------------------------------------------*/
        if(jQuery().selectbox){
            $('.search-select').selectbox();

            /* dropdown fix - to close dropdown if opened by clicking anywhere out */
            $('body').on('click',function(e){
                if ($(e.target).hasClass('selectbox')) return;
                $('.selectbox-wrapper').css('display','none');
            });
        }

        /*-------------------------------------------------------*/
        /*	More Options in Search Form
        /* -----------------------------------------------------*/
        $ ( '.more-option-trigger > a').click( function(e) {
            e.preventDefault();
            var triggerIcon = $( this).find( 'i' );
            var moreOptionsWrapper = $( '.more-options-wrapper' );
            if( triggerIcon.hasClass( 'fa-plus-square-o' ) ) {
                triggerIcon.removeClass( 'fa-plus-square-o' ).addClass( 'fa-minus-square-o' );
                moreOptionsWrapper.removeClass( 'collapsed' );
            } else if ( triggerIcon.hasClass( 'fa-minus-square-o' ) ){
                triggerIcon.removeClass( 'fa-minus-square-o' ).addClass( 'fa-plus-square-o' );
                moreOptionsWrapper.addClass( 'collapsed' );
            }
        });

    });

})(jQuery);