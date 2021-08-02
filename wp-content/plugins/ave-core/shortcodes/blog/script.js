(function ($) {

    $(document).on('ready', function () {

        const $blogPosts = $('.liquid-blog-posts');

        $blogPosts.each((i, posts) => {

            const $posts = $(posts);
            const pageNumbers = $('.page-numbers', $posts);
            const filterID = $posts.attr('data-filter-id');
            const $wrapper = $('[data-filter-id="' + filterID + '"] .liquid-blog-grid')
            const $paginationWrapper = $('.page-nav', $wrapper.parent());
    
            if (pageNumbers.length && $wrapper.length) {
    
                $(document).on('click', '.page-numbers', function (e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    ajaxRequest($wrapper, url, filterID, $paginationWrapper);
                });
    
            }

        })

        const ajaxRequest = ($wrapper, url, filterID, $paginationWrapper) => {

            $.ajax({
                type: 'GET',
                url: url,
                error: function error(MLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                },
                beforeSend: function () {
                    $wrapper.addClass('lqd-items-loading');
                },
                success: function (data) {
                    var $data = $(data);
                    var $newItemsWrapper = $data.find('[data-filter-id="' + filterID + '"] .liquid-blog-grid');
                    var $newItems = $newItemsWrapper.find('> div'),
                    $newPagination = $newItemsWrapper.parent().find('.page-nav').length ? $newItemsWrapper.parent().find('.page-nav') : '';
                    
                    if ($paginationWrapper.length) {
                        $paginationWrapper.html($newPagination);
                    }
                    
                    $newItems.imagesLoaded(function () {
                        $wrapper.empty();
                        $wrapper.append($newItems);
                        $wrapper.removeClass('lqd-items-loading');
                        if ( $wrapper.get(0).hasAttribute('data-liquid-masonry') ) {
                            $wrapper.isotope('appended', $newItems); // Calling function for the new items
                            $wrapper.isotope('layout');
                        }

                        $('html, body').animate({
							scrollTop: $wrapper.parent().offset().top - 150
						}, 300);

                        if (!$('body').hasClass('lazyload-enabled')) {
                            $('[data-responsive-bg=true]', $wrapper).liquidResponsiveBG();
                        }

                        if ($('body').hasClass('lazyload-enabled')) {
                            window.liquidLazyload = new LazyLoad({
                                elements_selector: '.ld-lazyload',
                                callback_loaded: function callback_loaded(e) {
                                    $(e).closest('[data-responsive-bg=true]').liquidResponsiveBG();
                                    $(e).parent().not('#wrap, #content').addClass('loaded');
                                }
                            });
                        }

                        $('[data-split-text]', $wrapper).filter(function (i, element) {
                            return !$(element).parents('[data-custom-animations]').length && !element.hasAttribute('data-custom-animations');
                        }).liquidSplitText();

                        $('[data-fittext]', $wrapper).liquidFitText();

                        $('[data-custom-animations]', $wrapper).map(function (i, element) {
                            var $element = $(element);
                            var $customAnimationParent = $element.parents('.wpb_wrapper[data-custom-animations]');

                            if ($customAnimationParent.length) {
                                $element.removeAttr('data-custom-animations');
                                $element.removeAttr('data-ca-options');
                            }
                        });

                        $('[data-custom-animations]', $wrapper).filter(function (i, element) {
                            var $element = $(element);
                            var $rowBgparent = $element.closest('.vc_row[data-row-bg]');
                            var $slideshowBgParent = $element.closest('.vc_row[data-slideshow-bg]');
                            return !$rowBgparent.length && !$slideshowBgParent.length;
                        }).liquidCustomAnimations();

                        $('[data-lqd-flickity]', $wrapper).liquidCarousel();
                        $('[data-parallax]', $wrapper).liquidParallax();
                        $('[data-hover3d=true]', $wrapper).liquidHover3d();

                    });
                }
            });
        }
    });

})(jQuery);