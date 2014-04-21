jQuery( document ).ready(function( $ ){

    /**
     * Various functionality for our gallery
     */
    if ( $('body.attachment').length ){

        // remove overlay
        function pelham_remove_overlay(){
            $('.gallery-overlay').hide();
            $('#gallery-helper').removeClass('gallery-helper');
        }

        // add overlay
        function pelham_add_overlay(){
            $('.gallery-overlay').show();
            pelham_gallery_setup();
        }

        // Setup
        function pelham_gallery_setup(){
            if ( $('#gallery-helper').length ){
                $('#gallery-helper').addClass('gallery-helper');
            } else {
                $('body').wrapInner( '<div id="gallery-helper" class="gallery-helper" />' );
            }
        }

        // Gallery set-up
        $(window).load(function(){
            $('<div class="gallery-overlay" style="height: ' + $( document ).height() + 'px;"></div>').prependTo('body');
        });
        pelham_gallery_setup();



        // Would like to use .one
        $( document ).on('click', 'main .entry-attachment a', function( e ){
            if ( ! $('.gallery-helper').is(':visible') && ! $('.gallery-overlay').is(':visible') ){
                e.preventDefault();
                pelham_add_overlay();
            }
        });

        // When user clicks anywhere on the overlay, remove it
        $( document ).on('click', '.gallery-overlay', function(){
            window.location.assign( $('#post_parent_page').attr('href') );
        });

        // When the user presses the esc key remove the overlay
        $(document).keyup(function(e) {
            if (e.keyCode == 27) {
                window.location.assign( $('#post_parent_page').attr('href') );
            }
        });
    }

    /**
     * Add keyboard short code functionality to our single post pages
     */
    $(document).keyup(function(e) {
        if ( $('body.attachment').length ){
            // left
            if (e.keyCode == 37) {
                window.location.assign( $('.prev-next-post a:first-child').attr('href') );
            }

            // right
            if (e.keyCode == 39) {
                window.location.assign( $('.prev-next-post a:last-child').attr('href') );
            }
        }
    });


    /**
     * Fade out ALL but the current icon when user hovers over
     * an item in the gallery
     */
    $('.gallery-item').hover(function() {
        $(this).toggleClass('hover');
        $('.gallery-item').not(this).stop().animate({
            "opacity": .3
        }), 200;

        $('.gallery-caption', this).show();

        // Lets wrap the gallery caption in a link, since when
        // we are displaying it the users have no way to link to
        // the larger image.
        link = $('.gallery-icon a', this).attr('href');
        if ( $('.gallery-caption .link-helper', this).length == 0 ){
            $('.gallery-caption', this).wrapInner('<a href="'+link+'" class="link-helper" />')
        }
    }, function() {
        $('.gallery-item').stop().animate({
            "opacity": 1
        }), 200;
        $('.gallery-caption', this).hide();
    });


    /**
     * Add helper classes for Chat Post Format
     *
     * This assumes that your chat/transcript is in the format of:
     * <p>Alice: Hi</p>
     * <p>Bob: What's going on Alice!</p>
     */
    $('.format-chat .entry-content p').each(function(){

        // Split our chat based on ":"
        chat = $(this).text().split(":").slice(0);

        // Assign our first index to be the name
        user_name = chat[0];

        // 2nd index is our message
        user_message = chat[1];

        // Wrap the "user_name" with HTML and a class name so we can style it
        new_name = $(this).text().replace( user_name + ":", '<span class="user-name">'+user_name+'</span>');

        // Add our new HTML into the current HTML
        $(this).html( new_name );
    });


    /**
     * When users click on the down arrow below a post toggle the post meta area
     */
    $('.expand-footer-handle').toggle(function(e){
        $( 'span', this ).removeClass('genericon-expand');
        $( 'span', this ).addClass('genericon-collapse');
        $('.expand-footer-target').toggle();
    }, function(){
        $( 'span', this ).addClass('genericon-expand');
        $( 'span', this ).removeClass('genericon-collapse');
        $('.expand-footer-target').toggle();
    });


    $('#search_toggle_handle').on('click', function( e ){
        e.preventDefault();

        // If our mobile nav is present hide it, then show the search form
        if ( $('#site-navigation').hasClass('toggled') )
            $('#site-navigation').removeClass('toggled');

        $('#search_form_target').toggleClass('toggled');
        $('#search_form_target').toggle();
        $('#search_form_target input[type="search"]').focus();
    });

    // If our search form is present hide it, then show the menu
    $('#site-navigation').on('click', function(e){
        if ( $('#search_form_target').hasClass('toggled') ){
            $('#search_form_target').removeClass('toggled');
            $('#search_form_target').hide();
        }
    });

    // Show hide our header area for the respective area
    if ( $('body').width() > 782 ){
        $('.format-quote').hover(function() {
            $('header', this).toggleClass('show');
        });
    }

    pelham_long_title_helper();

    /**
     * Long titles that will exceed the site description space will have
     * a elliptical (...) add to them. Users can click on the title to
     * reveal the entire title.
     */
    function pelham_long_title_helper(){
        pl = parseInt( $( '.site-header .site-description' ).css('padding-left') );
        pr = parseInt( $( '.site-header .site-description' ).css('padding-right') );
        ml = parseInt( $( '.site-header .site-description' ).css('margin-left') );
        mr = parseInt( $( '.site-header .site-description' ).css('margin-right') );

        var total = pl + pr + ml + mr;
        var description_width = $('.long-title').width() + total;

        if ( $('.long-title').width() > $('.site-description').width() ){
            var desc_obj = $( '.site-header .site-description');
            desc_obj.css('cursor','pointer');
            desc_obj.hover(function(){
                desc_obj.delay( 100 ).animate({
                    'max-width': description_width
                });
            }, function(){
                desc_obj.delay( 600 ).animate({
                    'max-width': '210px'
                });
            });
        }
    }

    $('.menu-toggle').on('click',function(){
        $('body').toggleClass('has-mobile-menu');
        $('.has-mobile-menu #masthead .main-navigation ul').css('height', $(window).height() + 'px' );
    });
});