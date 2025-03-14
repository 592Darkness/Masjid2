/**
 * Main javascript file for the Guyana Auto Dealer theme
 *
 * Contains all the theme specific javascript functions
 */

(function($) {
    'use strict';

    /**
     * Mobile menu toggle
     */
    $('.menu-toggle').on('click', function() {
        $('.main-menu').toggleClass('active');
        $(this).attr('aria-expanded', $('.main-menu').hasClass('active'));
    });

    /**
     * Header search toggle
     */
    $('.header-search-toggle').on('click', function(e) {
        e.preventDefault();
        $('.header-search-form').toggleClass('active');
    });

    // Close search when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.header-search-toggle, .header-search-form').length) {
            $('.header-search-form').removeClass('active');
        }
    });

    /**
     * Vehicles gallery thumbnails
     */
    $('.vehicle-thumbnail').on('click', function() {
        var imgSrc = $(this).find('img').attr('src');
        var imgSrcset = $(this).find('img').attr('srcset');
        var imgAlt = $(this).find('img').attr('alt');
        
        // Remove active class from all thumbnails
        $('.vehicle-thumbnail').removeClass('active');
        // Add active class to clicked thumbnail
        $(this).addClass('active');
        
        // Replace main image
        var mainImg = $('.vehicle-main-image img');
        mainImg.attr('src', imgSrc);
        
        if (imgSrcset) {
            mainImg.attr('srcset', imgSrcset);
        }
        
        if (imgAlt) {
            mainImg.attr('alt', imgAlt);
        }
    });

    /**
     * Vehicle inquiry form modal
     */
    $('.inquiry-trigger').on('click', function() {
        $('.inquiry-form-modal').fadeIn(300);
        $('body').addClass('modal-open');
    });
    
    $('.inquiry-close').on('click', function() {
        $('.inquiry-form-modal').fadeOut(300);
        $('body').removeClass('modal-open');
    });
    
    // Close modal when clicking outside
    $('.inquiry-form-modal').on('click', function(e) {
        if (!$(e.target).closest('.inquiry-form-container').length) {
            $('.inquiry-form-modal').fadeOut(300);
            $('body').removeClass('modal-open');
        }
    });
    
    // If URL has inquiry=success or inquiry=error parameter, show the modal
    if (window.location.href.indexOf('inquiry=success') > -1 || window.location.href.indexOf('inquiry=error') > -1) {
        $('.inquiry-form-modal').fadeIn(300);
        $('body').addClass('modal-open');
    }

    /**
     * Ajax vehicle filter
     */
    function initVehicleFilter() {
        var filterForm = $('#vehicle-filter-form');
        
        if (filterForm.length) {
            // Handle model dropdown population when make changes
            $('#vehicle_make').on('change', function() {
                var makeSlug = $(this).val();
                var modelSelect = $('#vehicle_model');
                
                modelSelect.html('<option value="">' + guyana_auto_dealer_vars.all_models_text + '</option>');
                
                if (makeSlug) {
                    $.ajax({
                        url: guyana_auto_dealer_vars.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'get_models_by_make',
                            make: makeSlug,
                            nonce: guyana_auto_dealer_vars.nonce
                        },
                        beforeSend: function() {
                            modelSelect.prop('disabled', true);
                        },
                        success: function(response) {
                            if (response.success && response.data) {
                                $.each(response.data, function(index, model) {
                                    modelSelect.append('<option value="' + model.slug + '">' + model.name + '</option>');
                                });
                            }
                            modelSelect.prop('disabled', false);
                        },
                        error: function() {
                            modelSelect.prop('disabled', false);
                        }
                    });
                }
            });
            
            // Handle AJAX filtering in archive-vehicle.php
            if (typeof guyana_auto_dealer_vars !== 'undefined' && guyana_auto_dealer_vars.is_vehicle_archive) {
                filterForm.on('submit', function(e) {
                    e.preventDefault();
                    
                    var formData = $(this).serialize();
                    var resultsContainer = $('#vehicle-results');
                    
                    $.ajax({
                        url: guyana_auto_dealer_vars.ajax_url,
                        type: 'POST',
                        data: formData + '&action=vehicle_filter&paged=1&nonce=' + guyana_auto_dealer_vars.nonce,
                        beforeSend: function() {
                            resultsContainer.addClass('loading');
                            $('html, body').animate({
                                scrollTop: resultsContainer.offset().top - 100
                            }, 400);
                        },
                        success: function(response) {
                            if (response.success) {
                                resultsContainer.html(response.data);
                            } else {
                                resultsContainer.html('<p class="no-vehicles">' + response.data + '</p>');
                            }
                            resultsContainer.removeClass('loading');
                        },
                        error: function() {
                            resultsContainer.html('<p class="no-vehicles">' + guyana_auto_dealer_vars.ajax_error_text + '</p>');
                            resultsContainer.removeClass('loading');
                        }
                    });
                });
                
                // Handle filter reset
                filterForm.find('button[type="reset"]').on('click', function() {
                    setTimeout(function() {
                        filterForm.submit();
                    }, 10);
                });
            }
        }
    }
    
    // Initialize vehicle filter
    initVehicleFilter();

    /**
     * Testimonials slider
     */
    function initTestimonialsSlider() {
        if ($('.testimonials-slider').length && typeof $.fn.slick !== 'undefined') {
            $('.testimonials-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: true,
                autoplay: true,
                autoplaySpeed: 5000,
                adaptiveHeight: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>'
            });
        }
    }
    
    // Initialize testimonials slider if slick is available
    $(window).on('load', function() {
        initTestimonialsSlider();
    });

    /**
     * Sticky header on scroll
     */
    function stickyHeader() {
        var header = $('.site-header');
        var headerHeight = header.outerHeight();
        var scrollPosition = $(window).scrollTop();
        
        if (scrollPosition > headerHeight) {
            header.addClass('sticky');
            $('body').css('padding-top', headerHeight);
        } else {
            header.removeClass('sticky');
            $('body').css('padding-top', 0);
        }
    }
    
    // Initialize sticky header
    $(window).on('scroll', function() {
        stickyHeader();
    });
    
    // Initialize on page load
    stickyHeader();

    /**
     * Back to top button
     */
    var backToTopBtn = $('#back-to-top');
    
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            backToTopBtn.addClass('show');
        } else {
            backToTopBtn.removeClass('show');
        }
    });
    
    backToTopBtn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, 500);
    });

    /**
     * Woocommerce quantity buttons
     */
    function customWooQuantity() {
        $('body').on('click', '.quantity-button', function() {
            var $button = $(this);
            var $input = $button.siblings('.qty');
            var oldValue = parseFloat($input.val());
            var newVal;
            
            if ($button.hasClass('plus')) {
                newVal = oldValue + 1;
            } else {
                if (oldValue > 1) {
                    newVal = oldValue - 1;
                } else {
                    newVal = 1;
                }
            }
            
            $input.val(newVal).trigger('change');
        });
    }
    
    // Initialize WooCommerce quantity buttons
    if ($('.woocommerce').length) {
        customWooQuantity();
    }

})(jQuery);
