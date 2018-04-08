(function($){

	"use strict";

    var $main_header = $('.main_h');

    // If parent menu has submenu then add down arrow
    jQuery('#responsive-menu > li').each(function(){
        if( jQuery(this).find('ul').hasClass('sub-menu') ){
            jQuery(this).find('ul:first').prev('a').append('<i class="has_sub_menu_parent fa fa-angle-down"></i>');
        }
    });

    $(window).on( 'scroll' , function(event) {
        event.preventDefault();
        if ($(window).scrollTop() > 100) {
            $main_header.addClass('sticky');
        } 
        else {
            $main_header.removeClass('sticky');
        }
    });

    // Mobile Navigation
    $('.mobile-toggle').on( 'click' , function(event) {
        event.preventDefault();
        if ($main_header.hasClass('open-nav')) {
            $main_header.removeClass('open-nav');
        } 
        else {
            $main_header.addClass('open-nav');
        }
    });

    $('.main_h li a').on( 'click' , function(event) {
        event.preventDefault();
        if ($main_header.hasClass('open-nav')) {
            $('.navigation').removeClass('open-nav');
            $main_header.removeClass('open-nav');
        }
    });

    // navigation scroll lijepo radi materem
    // $('nav a').on( 'click' , function(event) {
    //     event.preventDefault();
    //     var id = $(this).attr("href");
    //     var offset = 70;
    //     var target = $(id).offset().top - offset;
    //     $('html, body').animate({
    //         scrollTop: target
    //     }, 500);
    //     event.preventDefault();
    // });

    // contact form
    $(document).on( 'submit' , '#main-contact-form1', function(e){
        e.preventDefault();
        $.ajax({
            url: "mail/contact.php",
            type:   'POST',
            data: $('#main-contact-form1').serialize(),
            success: function(msg){
                $( '#mail_success_message' ).empty().html( msg ).show();
            },
        });
        return;
    }); 

    $(' #da-thumbs > li ').each( function() { 
        $(this).hoverdir(); 
    });

    /**
    * Slicknav - a Mobile Menu
    */
    var $slicknav_label;
    $('#responsive-menu').slicknav({
        duration: 500,
        closedSymbol: '<i class="fa fa-plus"></i>',
        openedSymbol: '<i class="fa fa-minus"></i>',
        prependTo: '#slicknav-mobile',
        allowParentLinks: true,
        label:"" 
    });

        // Mouse-enter dropdown
    $('#navbar li').on("mouseenter", function() {
        $(this).find('ul').first().stop(true, true).delay(350).slideDown(500);
    });
    // Mouse-leave dropdown
    $('#navbar li').on("mouseleave", function() {
        $(this).find('ul').first().stop(true, true).delay(100).slideUp(150);
    });

    /**
     *  Arrow for Menu has sub-menu
     */
    if ($(window).width() > 992) {
        $(".navbar-arrow ul ul > li").has("ul").children("a").append("<i class='arrow-indicator fa fa-angle-right'></i>");
    }

     $(document).ready(function() {
      $('.progress .progress-bar').css("width",
                function() {
                    return $(this).attr("aria-valuenow") + "%";
                }
        )
    });

    $(window).on( 'scroll' , function(){
        if($(window).scrollTop() > 500){
            $("#back-to-top").fadeIn(200);
        } else{
            $("#back-to-top").fadeOut(200);
        }
    });

    $(document).on("click",'#back-to-top a',function() {
        $('html, body').animate({ scrollTop:0 },'slow');
        return false;
    }); 


})(jQuery);

// Photo gallery instagram style

jQuery(function($) {

    var updateArrows = function(){
        $('.carouselGallery-right').removeClass('disabled');
        $('.carouselGallery-left').removeClass('disabled');
        var curIndex = $('.carouselGallery-carousel.active').data('index');
        updateArrows.nbrOfItems = updateArrows.nbrOfItems || $('.carouselGallery-carousel').length -1;

        curIndex === updateArrows.nbrOfItems && $('.carouselGallery-right').addClass('disabled');
        curIndex === 0 && $('.carouselGallery-left').addClass('disabled');
    }
    $('.carouselGallery-carousel').on('click', function(e){
        scrollTo = $('body').scrollTop();
       $('body').addClass('noscroll');
       $('body').css('position', 'fixed');
        $('.carouselGallery-col-1, .carouselGallery-col-2').removeClass('active');
        $(this).addClass('active');
        showModal($(this));
        updateArrows();
    });

    $('body').on('click', '.carouselGallery-right, .carouselGallery-left', function(e){
        if($(this).hasClass('disabled')) return;
        var curIndex = $('.carouselGallery-carousel.active').data('index');
        var nextItemIndex = parseInt(curIndex+1);
        if($(this).hasClass('carouselGallery-left')){
            nextItemIndex-=2;
        }
        var nextItem = $('.carouselGallery-carousel[data-index='+nextItemIndex+']');
       // console.log(nextItemIndex);
        if(nextItem.length > 0){
            $('.carouselGallery-col-1, .carouselGallery-col-2').removeClass('active');
            $('body').find('.carouselGallery-wrapper').remove();
            showModal($(nextItem.get(0)));
            nextItem.first().addClass('active');
        }
        updateArrows();
    });

    var modalHtml = '';
    showModal = function(that){
     //   console.log(that);
        var username = that.data('username'),
        location = that.data('location'),
        imagetext = that.data('imagetext'),
        likes =  that.data('likes'),
        imagepath = that.data('imagepath'),
        carouselGalleryUrl = that.data('url');
        postURL =  that.data('posturl');

        maxHeight = $(window).height()-100;

        if ($('.carouselGallery-wrapper').length === 0) {
            if(typeof imagepath !== 'undefined') {
                modalHtml = "<div class='carouselGallery-wrapper'>";
                modalHtml += "<div class='carouselGallery-modal'><span class='carouselGallery-left'><span class='icons icon-arrow-left6'></span></span><span class='carouselGallery-right'><span class='icons icon-arrow-right6'></span></span>";
                modalHtml += "<div class='container'>";
                modalHtml += "<span class='icons iconscircle-cross close-icon'></span>";
                modalHtml += "<div class='carouselGallery-scrollbox' style='max-height:"+maxHeight+"px'><div class='carouselGallery-modal-image'>";
                modalHtml += "<img src='"+imagepath+"' alt='carouselGallery image'>";
                modalHtml += "</div>";
                modalHtml += "<div class='carouselGallery-modal-text'>";
                modalHtml += "<span class='carouselGallery-modal-username'><a href='javascript:void(0)'>"+username+"</a> </span>"
                modalHtml += "<span class='carouselGallery-modal-location'>"+location+"</span>";
                modalHtml += "<span class='carouselGallery-modal-imagetext'>";
                modalHtml += "<p>"+imagetext+"</p>";
                modalHtml += "</span></div></div></div></div></div>";
                $('body').append(modalHtml).fadeIn(2500);
            }
        }
    };

    $('body').on( 'click','.carouselGallery-wrapper', function(e) {
        if($(e.target).hasClass('.carouselGallery-wrapper')){
            removeModal();
        }
    });
    $('body').on('click', '.carouselGallery-modal .iconscircle-cross', function(e){
        removeModal();
    });

     var removeModal = function(){
        $('body').find('.carouselGallery-wrapper').remove();
        $('body').removeClass('noscroll');
        $('body').css('position', 'static');
        $('body').animate({scrollTop: scrollTo}, 0);
    };

    // Avoid break on small devices
    var carouselGalleryScrollMaxHeight = function() {
        if ($('.carouselGallery-scrollbox').length) {
            maxHeight = $(window).height()-100;
            $('.carouselGallery-scrollbox').css('max-height',maxHeight+'px');
        }
    }
    $(window).resize(function() { // set event on resize
        clearTimeout(this.id);
        this.id = setTimeout(carouselGalleryScrollMaxHeight, 100);
    });
    document.onkeydown = function(evt) {
        evt = evt || window.event;
        if (evt.keyCode == 27) {
            removeModal();
        }
    };

    $('.blog-listing').matchHeight();
    $('.comment-reply-link').addClass('btn-sm btn btn-primary');

});

function getTestimonialScrollbar( selector ){
    var custom = new scrollbot( selector );
    setScrollStyles(custom);
}

function setScrollStyles(custom3){

    custom3.setStyle({height:2});
    var onscrollfollower = document.createElement("div");
    onscrollfollower.style.width = "100%";
    onscrollfollower.style.height = "100%";
    onscrollfollower.style.backgroundColor = "#222222";
    onscrollfollower.style.position = "absolute";
    onscrollfollower.style.bottom = "100%";
    onscrollfollower.style.right = 0;
    custom3.scrollBarHolder.appendChild(onscrollfollower);
    custom3.onScroll(function(){onscrollfollower.style.bottom = 100 - parseFloat(this.scrollBar.style.top) + "%";})

}