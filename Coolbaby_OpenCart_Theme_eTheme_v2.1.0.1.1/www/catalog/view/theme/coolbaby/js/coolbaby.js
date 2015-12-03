/* jquery.easypiechart.min.js */
/**!
 * easyPieChart
 * Lightweight plugin to render simple, animated and retina optimized pie charts
 *
 * @license
 * @author Robert Fleischmann <rendro87@gmail.com> (http://robert-fleischmann.de)
 * @version 2.1.5
 **/
!function(a,b){"object"==typeof exports?module.exports=b(require("jquery")):"function"==typeof define&&define.amd?define(["jquery"],b):b(a.jQuery)}(this,function(a){var b=function(a,b){var c,d=document.createElement("canvas");a.appendChild(d),"undefined"!=typeof G_vmlCanvasManager&&G_vmlCanvasManager.initElement(d);var e=d.getContext("2d");d.width=d.height=b.size;var f=1;window.devicePixelRatio>1&&(f=window.devicePixelRatio,d.style.width=d.style.height=[b.size,"px"].join(""),d.width=d.height=b.size*f,e.scale(f,f)),e.translate(b.size/2,b.size/2),e.rotate((-0.5+b.rotate/180)*Math.PI);var g=(b.size-b.lineWidth)/2;b.scaleColor&&b.scaleLength&&(g-=b.scaleLength+2),Date.now=Date.now||function(){return+new Date};var h=function(a,b,c){c=Math.min(Math.max(-1,c||0),1);var d=0>=c?!0:!1;e.beginPath(),e.arc(0,0,g,0,2*Math.PI*c,d),e.strokeStyle=a,e.lineWidth=b,e.stroke()},i=function(){var a,c;e.lineWidth=1,e.fillStyle=b.scaleColor,e.save();for(var d=24;d>0;--d)d%6===0?(c=b.scaleLength,a=0):(c=.6*b.scaleLength,a=b.scaleLength-c),e.fillRect(-b.size/2+a,0,c,1),e.rotate(Math.PI/12);e.restore()},j=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(a){window.setTimeout(a,1e3/60)}}(),k=function(){b.scaleColor&&i(),b.trackColor&&h(b.trackColor,b.lineWidth,1)};this.getCanvas=function(){return d},this.getCtx=function(){return e},this.clear=function(){e.clearRect(b.size/-2,b.size/-2,b.size,b.size)},this.draw=function(a){b.scaleColor||b.trackColor?e.getImageData&&e.putImageData?c?e.putImageData(c,0,0):(k(),c=e.getImageData(0,0,b.size*f,b.size*f)):(this.clear(),k()):this.clear(),e.lineCap=b.lineCap;var d;d="function"==typeof b.barColor?b.barColor(a):b.barColor,h(d,b.lineWidth,a/100)}.bind(this),this.animate=function(a,c){var d=Date.now();b.onStart(a,c);var e=function(){var f=Math.min(Date.now()-d,b.animate.duration),g=b.easing(this,f,a,c-a,b.animate.duration);this.draw(g),b.onStep(a,c,g),f>=b.animate.duration?b.onStop(a,c):j(e)}.bind(this);j(e)}.bind(this)},c=function(a,c){var d={barColor:"#ef1e25",trackColor:"#f9f9f9",scaleColor:"#dfe0e0",scaleLength:5,lineCap:"round",lineWidth:3,size:110,rotate:0,animate:{duration:1e3,enabled:!0},easing:function(a,b,c,d,e){return b/=e/2,1>b?d/2*b*b+c:-d/2*(--b*(b-2)-1)+c},onStart:function(){},onStep:function(){},onStop:function(){}};if("undefined"!=typeof b)d.renderer=b;else{if("undefined"==typeof SVGRenderer)throw new Error("Please load either the SVG- or the CanvasRenderer");d.renderer=SVGRenderer}var e={},f=0,g=function(){this.el=a,this.options=e;for(var b in d)d.hasOwnProperty(b)&&(e[b]=c&&"undefined"!=typeof c[b]?c[b]:d[b],"function"==typeof e[b]&&(e[b]=e[b].bind(this)));e.easing="string"==typeof e.easing&&"undefined"!=typeof jQuery&&jQuery.isFunction(jQuery.easing[e.easing])?jQuery.easing[e.easing]:d.easing,"number"==typeof e.animate&&(e.animate={duration:e.animate,enabled:!0}),"boolean"!=typeof e.animate||e.animate||(e.animate={duration:1e3,enabled:e.animate}),this.renderer=new e.renderer(a,e),this.renderer.draw(f),a.dataset&&a.dataset.percent?this.update(parseFloat(a.dataset.percent)):a.getAttribute&&a.getAttribute("data-percent")&&this.update(parseFloat(a.getAttribute("data-percent")))}.bind(this);this.update=function(a){return a=parseFloat(a),e.animate.enabled?this.renderer.animate(f,a):this.renderer.draw(a),f=a,this}.bind(this),this.disableAnimation=function(){return e.animate.enabled=!1,this},this.enableAnimation=function(){return e.animate.enabled=!0,this},g()};a.fn.easyPieChart=function(b){return this.each(function(){var d;a.data(this,"easyPieChart")||(d=a.extend({},b,a(this).data()),a.data(this,"easyPieChart",new c(this,d)))})}});
/* end jquery.easypiechart.min.js */


//var $j = jQuery.noConflict();
var $j = $;

jQuery(function($) {
    "use strict";
    var iOS = (navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false);
    if (iOS) {
        $j('body').addClass('ios');
    }

})


jQuery(function($) {
    "use strict";
    var usualmenu = $j("ul.sf-menu");
    if (usualmenu.length != 0) usualmenu.supersubs({
        minWidth: 18,
        maxWidth: 27,
        extraWidth: 1
    }).superfish({
        delay: 0,
        speed: 0,
        speedOut: 0,
        onBeforeShow: function() {
            if ($j(this).parents("ul").length > 1) {
                var w = $j(window).width();
                var ul_offset = $j(this).parents("ul").offset();
                var ul_width = $j(this).parents("ul").outerWidth();
                ul_width = ul_width + 50;
                if ((ul_offset.left + ul_width > w - (ul_width / 2)) && (ul_offset.left - ul_width > 0)) {
                    $j(this).addClass('offscreen_fix');
                } else {
                    $j(this).removeClass('offscreen_fix');
                }
            };
        }
    })
});


jQuery(function($) {
	"use strict";
    // countdown ini
    if ($j("#countdown1").length > 0) {
        $j('#countdown1').countdown({
            until: new Date() + 100000
        });
    }
    // customize selects
    if ($j(".selectpicker").length > 0) {
        $j('.selectpicker').selectpicker({});
    }
});

jQuery(function($) {
    "use strict";
    if ($j(".chart").length > 0) {
        $j('.chart').easyPieChart({
            barColor: '#c69c6d',
            lineWidth: 4,
            size: 93,
            scaleColor: false,
            easing: 'easeOutBounce',
            onStep: function(from, to, percent) {
                $j(this.el).find('.percent').text(Math.round(percent));
            }
        });
    }
});

jQuery(function($) {
    "use strict";
    if ($j('.video-popup').length > 0) {
        $j('.video-popup').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    }


    if ($j('.image-thumbnail a.gallery-group').length > 0) {
        $j('.image-thumbnail a.gallery-group').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    }
});

jQuery(function($) {
	"use strict";
    $j(document).bind('cbox_open', function() {
        $j('html').css({
            overflow: 'hidden'
        });
    }).bind('cbox_closed', function() {
        $j('html').css({
            overflow: ''
        });
    });


    // check if RTL mode
    var colorBoxMenuPosL = ($j("body").hasClass('rtl')) ? 'none' : '0';
    var colorBoxMenuPosR = ($j("body").hasClass('rtl')) ? '0' : 'none';

    $j("#off-canvas-menu-toggle").colorbox({
        inline: true,
        opacity: 0.55,
        transition: "none",
        arrowKey: false,
        width: "300",
        height: "100%",
        fixed: true,
        className: 'canvas-menu',
        top: 0,
        right: colorBoxMenuPosR,
        left: colorBoxMenuPosL,
        colorBoxCartPos: 0
    })

    // check if RTL mode
    var colorBoxCartPosL = ($j("body").hasClass('rtl')) ? '0' : 'none';
    var colorBoxCartPosR = ($j("body").hasClass('rtl')) ? 'none' : '0';

    $j(".open-cart").colorbox({
        inline: true,
        opacity: 0.55,
        transition: "fade",
        speed: 300,
        arrowKey: false,
        width: "320",
        height: "100%",
        fixed: true,
        top: 0,
        right: colorBoxCartPosR,
        left: colorBoxCartPosL,
        onComplete: function() {
            $j("#cboxClose, #cboxOverlay").on("click", function(e) {
                e.preventDefault();
                $j("#drop-shopcart").find('.animated').removeClass('animated');
            })
        }
    });
    var addToCart = function (button) {
        //var $link = button.closest('.product-preview').find('.preview-image').clone();
        //var $title = button.closest('.product-preview').find('.title a').clone();
        //var $price = button.closest('.product-preview').find('span.price:first').clone();
        //var $template = $j("#liTemplate > div").clone().appendTo('#drop-shopcart .list');
        //$link.find("img.img-second").remove().end().appendTo('#drop-shopcart .list > div:last .image');
        //$title.appendTo('#drop-shopcart .list > div:last .description .product-name');
        //$price.appendTo('#drop-shopcart .list > div:last .description .price');
        //$j('#drop-shopcart .list > div:last .description .price').removeClass('new');
        $j('.remove-from-cart').on("click", function () {
            $j(this).closest('.item').fadeIn().remove();
            if ($j("#drop-shopcart .list > div").length == 0) {
                $j("#drop-shopcart .total").hide();
                $j("#drop-shopcart .empty").show();
            }
        })
        var checkAnimated = function () {
            if ($j("#drop-shopcart .list > div.item").prev("li").hasClass("animated")) {
                $j('#drop-shopcart .list > div.item').addClass('animated');
                clearTimeout(intrvl);
            }
        }
        var intrvl = setInterval(checkAnimated, 300);
    }
    $j(".add-to-cart").on("click", function (e) {
      addToCart($j(this))
 	  if (!$j("#drop-shopcart .total").is(':visible')){$j("#drop-shopcart .total").show();$j("#drop-shopcart .empty").hide();}
   });
    $j('.remove-from-cart').on("click", function (e) {
        e.preventDefault();
        $j(this).closest('.item').fadeIn().remove();
		if ($j("#drop-shopcart .list > div").length == 0){$j("#drop-shopcart .total").hide(); $j("#drop-shopcart .empty").show();}
    })

});

jQuery(function ($) {
    "use strict";
    $j(".anim-icon").hover(
		function(){
			var newimg = $j(this).find('img').attr('data-hover');
			var oldimg = $j(this).find('img').attr('src'); 
			$j(this).find('img').attr('src', newimg).attr('data-hover',oldimg)
		},
		function(){
			var newimg = $j(this).find('img').attr('data-hover');
			var oldimg = $j(this).find('img').attr('src'); 
			$j(this).find('img').attr('src', newimg).attr('data-hover',oldimg)
		}
	)
});

jQuery(function ($j) {
	"use strict";

    var windowWidth = window.innerWidth || document.documentElement.clientWidth;


    if (windowWidth > 991) {
        footerIni()
    }
    $j(window).resize(function () {

        var windowWidthR = window.innerWidth || document.documentElement.clientWidth;
        if ( windowWidthR != windowWidth) {
        var footerCollapsed = $j('#footer-collapsed');

        if (windowWidthR > 991) {
            if (!footerCollapsed.hasClass('ini')) {
                footerIni();
            }
            else {
                var footerStartHeight = 74;
                footerCollapsed.find('.collapsed-block').css({'width': ''});
                footerCollapsed.stop().css({'height': footerStartHeight});
            }
        } else {
            footerCollapsed.css({'height': 'auto'});
            footerCollapsed.find('.collapsed-block').css({'width': ''});
        }
            windowWidth = windowWidthR;
        }
    });

})
function footerIni() {
	"use strict";
    var footerCollapsed = $j('#footer-collapsed');
    var footerHeight = footerCollapsed.prop('scrollHeight'),
        footerStartHeight = 74,
        collapsedBlockN = footerCollapsed.find('.collapsed-block:visible').length,
        collapsedBlockW = 100 / collapsedBlockN - 1 + '%',
        slideSpeed = 500;

	
	if (footerCollapsed.hasClass('no-popup')) {
			footerCollapsed.css({'height': footerStartHeight});
			footerCollapsed.find('.collapsed-block').css({'width': ''});
		    footerCollapsed.addClass('open').removeClass('closed');
            footerCollapsed.find('.collapsed-block').animate({
                width: collapsedBlockW
            }, slideSpeed);
            footerHeight = footerCollapsed.prop('scrollHeight');
            setTimeout(function () {
                footerHeight = footerCollapsed.prop('scrollHeight');
                footerCollapsed.stop().animate({
                    height: footerHeight
                }, slideSpeed, function () {
                });
            }, 0)
		
		}
	else {
    footerCollapsed.css({'height': footerStartHeight}).removeClass('open').addClass('closed ini');
    footerCollapsed.find('.collapsed-block').css({'width': ''});
    footerCollapsed.find('.link').click(function (e) {
		footerCollapsed.addClass('blockHeader');
        e.preventDefault();
        if (footerCollapsed.hasClass('closed')) {
            footerCollapsed.addClass('open').removeClass('closed');
            footerCollapsed.find('.collapsed-block').animate({
                width: collapsedBlockW
            }, slideSpeed);
            footerHeight = footerCollapsed.prop('scrollHeight');
            setTimeout(function () {
                footerHeight = footerCollapsed.prop('scrollHeight');
                footerCollapsed.stop().animate({
                    height: footerHeight
                }, slideSpeed, function () {
                });
                $j("html, body").animate({
                    scrollTop: $j(document).height()
                }, slideSpeed);
            }, slideSpeed + 200)
        } else {
            footerCollapsed.removeClass('open').addClass('closed');
            footerCollapsed.find('.collapsed-block').each(function () {
                $j(this).stop(true, false).animate({
                    'width': $j(this).find('.inside').prop('scrollWidth')
                }, slideSpeed);
            })
            footerCollapsed.stop().animate({
                height: footerStartHeight
            }, slideSpeed, function () {
            });
        }
	setTimeout(function () {
		footerCollapsed.removeClass('blockHeader');
    }, slideSpeed*4)
    })}
}
function footerStick() {
	"use strict";
    var windowH = $j(window).outerHeight();
    var contentH = $j('#outer').outerHeight();
    if (windowH > contentH) {
        $j('footer').css({'paddingTop':windowH-contentH +'px'});
    } else {$j('footer').css({'paddingTop':0});}
}
function slideHoverWidth() {
    var windowWidth = document.documentElement.clientWidth || document.body.clientWidth,
        w = $j(".container").outerWidth(),
        padLR = (windowWidth - w) / 2;

    $j('#hover-left').css({
        width: padLR,
        left: -padLR
    });
    $j('#hover-right').css({
        width: padLR + w * 2 / 3 + 1,
        right: -padLR
    });
}
function equalHeight(container) {
	"use strict";
var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $j(container).each(function() {

   $el = $j(this);
   $j($el).height('auto')
   var topPostion = $el.position().top;
     var currentDiv;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
	

}

function carouselProductNoSpace() {
	"use strict";
    var windowWidth = window.innerWidth || document.documentElement.clientWidth,
        containerWidth = $j(".container").width(),
        productInContainer = 5,
        productInRow = Math.ceil(windowWidth * productInContainer / containerWidth),
        productRowWidth = productInRow * 100 / productInContainer,
        productRowLeft = (productInRow - productInContainer) * 0.5 * 100 / productInContainer;

    var $showArrowMulti = false;
	
	$j('section.content .products-nospace-outer .products-nospace .slides').each(function () {
		jQuery(this).parent().parent().parent('section.content').hide();
	})
    $j('.products-nospace .slides').each(function () {

        var $jthis = jQuery(this);
        var countProduct = $jthis.find(".carousel-item").length;
        $jthis.unslick();
		if (countProduct > 0) { 
			$jthis.parent().parent().parent('section.content').show();	
		}
        if (countProduct <= 5) {
            productRowLeft = 0
        }
        if (!$j('body').hasClass('boxed')) {
            $jthis.parent('.products-nospace').css({
                width: productRowWidth + '%',
                marginLeft: -productRowLeft + '%'
            });
        }

        if (countProduct > 5) {
            $showArrowMulti = true;
            var cloneCount = Math.ceil((productInRow + 1) / countProduct) - 1;

            var productsToClone = $jthis.children();

            for (var i = 0; i < cloneCount; i++)
                productsToClone.clone().prependTo($jthis);
        }

        $jthis.slick({
            dots: false,
            infinite: true,
            arrows: false,
            speed: 300,
            slidesToShow: productInRow, // important, don't change
            slidesToScroll: 2,
            centerMode: false,
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    centerMode: false
                }
            }, {
                breakpoint: 769,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    centerMode: true
                }
            }, {
                breakpoint: 481,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    centerMode: true
                }
            }, {
                breakpoint: 321,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true
                }
            }]
        });
    })
    if ($showArrowMulti) {
        $j('#nextSlick').click(function (e) {
            $j(".products-nospace .slides").slickNext();
            e.preventDefault();
        })
        $j('#prevSlick').click(function (e) {
            $j(".products-nospace .slides").slickPrev();
            e.preventDefault();
        })

    } else {
        $j('.slick-arrows').hide().prev('.subtitle.right-space').removeClass('right-space')
    }

}
function carouselAccordionIni() {
	"use strict";
    $j('.products-widget.vertical .slides').slick({
        dots: false,
        infinite: true,
        vertical: true,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
        speed: 500,
        slidesToShow: 2,
        slidesToScroll: 2,
		touchMove: false
    });
    $j('.blog-widget-small.vertical .slides').slick({
        dots: false,
        infinite: true,
        vertical: true,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
        speed: 500,
        slidesToShow: 2,
        slidesToScroll: 2,
		touchMove: false
    });
}

function horisontalAccordion() {
	"use strict";
    var w = $j('#mobileAccord').width(),
        panelW = 35,
        slideSpeed = 300,
        panel = $j('#mobileAccord .accord-panel'),
        panelBut = $j("#mobileAccord .vertical_title_outer"),
        panelN = panel.length,
        openPanelW = w - (panelN - 1) * panelW;
	
	panelBut.unbind( "click" );
    panelBut.click(function () {
        $j('#mobileAccord').addClass('historyOpened');
		if ($j(this).parent().hasClass('open')) {
            $j(this).parent().removeClass('open').removeClass('historyOpen').addClass('closed').stop().animate({
                width: panelW
            }, slideSpeed);
        } else {
            $j('#mobileAccord .accord-panel').removeClass('open').removeClass('historyOpen').addClass('closed').stop().animate({
                width: panelW
            }, slideSpeed);
            $j(this).parent().removeClass('closed').addClass('open').addClass('historyOpen').stop().animate({
                width: openPanelW
            }, slideSpeed);
        }
    });
	
    panel.addClass('open').removeAttr("style");
    carouselAccordionIni()
    setTimeout(function () {
        panel.removeClass('open').addClass('closed').animate({
            width: panelW
        }, 0);
		panel.each(function () {
		if( $j(this).hasClass('historyOpen'))  {
			$j(this).removeClass('historyOpen').removeClass('closed').addClass('open').animate({
            width: openPanelW
        }, 0);		}
		});		
		if(!$j('#mobileAccord').hasClass('historyOpened'))		{
        $j('#mobileAccord .accord-panel:first-child').removeClass('closed').addClass('open').animate({
            width: openPanelW
        }, 0);
		}

    }, 100)
}


jQuery(function ($j) {
    "use strict";
    var footerExpander = $j('.expander');
    footerExpander.click(function (e) {
        var top = $j(this).offset().top - 50;
        $j("html, body").animate({scrollTop: top}, 500);
    });
});

jQuery(function ($j) {
    "use strict";
	// Android doesn't support autoplay
	var video = $j('.video-autoplay');
	var isAndroid = /(android)/i.test(navigator.userAgent);
	if(isAndroid) {
		video.hide();
	}
});

jQuery(function ($j) {
	"use strict";
    function backgroundScroll(el, width, speed) {
        el.animate({'background-position': '-' + width + 'px'}, speed, 'linear', function () {
            el.css('background-position', '0');
            backgroundScroll(el, width, speed);
        });
    }
	var isSafari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/)
	if (!isSafari){
		var scrollImageWidth = 1378;
		var scrollSpeed = 4;
		backgroundScroll($j('.no-touch .animate-bg'), scrollImageWidth, scrollSpeed * 10000);
	}
});

jQuery(function ($j) {
    "use strict";
    var windowWidth = window.innerWidth || document.documentElement.clientWidth;


    if (windowWidth < 481) {
       horisontalAccordion();
    } else carouselAccordionIni();


	$j(window).resize(function () {
        var windowWidthR = window.innerWidth || document.documentElement.clientWidth;
        if ( windowWidthR != windowWidth) {
        clearTimeout(window.resizeEvt);
        window.resizeEvt = setTimeout(function () {
            var windowWidth = window.innerWidth || document.documentElement.clientWidth,
                panel = $j('#mobileAccord .accord-panel')
            if (windowWidth < 481) {
                horisontalAccordion();
            } else 
			 { panel.addClass('open').removeClass('close').removeClass('historyOpen').removeAttr("style");
			 $j('#mobileAccord').removeClass('historyOpened');}
        }, 500);
            windowWidth = windowWidthR;
        }    
    });


});

jQuery(function ($j) {
    "use strict";


    var duration = {
        searchShow: 200,
        searchHide: 200
    }

    $j('header .btn-search').click(function (e) {
        e.preventDefault();
		$j(this).fadeOut(duration.searchShow);
        if (!$j("#openSearch").hasClass('open')) {
            $j("#openSearch").stop(true, false).addClass('open').animate({
                height: 48
            }, duration.searchShow);
        } else {
            $j("#openSearch").stop(true, false).removeClass('open').animate({
                height: 0
            }, duration.searchHide);
        }
    })

    $j('#openSearch .search-close').click(function (e) {
		$j('header .btn-search').fadeIn(duration.searchHide);
        $j("#openSearch").stop(true, false).removeClass('open').animate({
            height: 0
        }, duration.searchHide);
    })

    var hiddenBut = $j('header .btn-group .dropdown-toggle')

    hiddenBut.click(function (e) {
        e.preventDefault();
        e.stopPropagation();
    });


});
(function () {
	"use strict";
    var isBootstrapEvent = false;
    if (window.jQuery) {
        var all = jQuery('*');
        jQuery.each(['hide.bs.dropdown',
            'hide.bs.collapse',
            'hide.bs.modal',
            'hide.bs.tooltip'
        ], function (index, eventName) {
            all.on(eventName, function (event) {
                isBootstrapEvent = true;
            });
        });
    }
    var originalHide = Element.hide;
    Element.addMethods({
        hide: function (element) {
            if (isBootstrapEvent) {
                isBootstrapEvent = false;
                return element;
            }
            return originalHide(element);
        }
    });
})();
(function () {
	"use strict";
    var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
        ua = navigator.userAgent,
        gestureStart = function () {
            viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6"
        },
        scaleFix = function () {
            if (viewportmeta && (/iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua))) {
                viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
                document.addEventListener("gesturestart", gestureStart, false)
            }
        };
    scaleFix()
})();

jQuery(function ($j) {
    "use strict";
    var viewGrid = $j(".view-grid"),
        viewList = $j(".view-list"),
        productList = $j(".products-list");
    viewGrid.click(function (e) {
		viewGrid.addClass('active');
		viewList.removeClass('active');
        productList.removeClass("products-list-in-row").addClass("products-list-in-column");
        e.preventDefault()
    });
    viewList.click(function (e) {
		viewList.addClass('active');
		viewGrid.removeClass('active');
        productList.removeClass("products-list-in-column").addClass("products-list-in-row");
        e.preventDefault()
    })
});

jQuery(function ($j) {
    "use strict";
    var calculateProductsInRow = function (row) {
        $j(".product-view-ajax-container.temp").each(function () {
            $j(this).remove()
        });
        var productsInRow = 0;
        $j(row).children(".product-preview-outer").each(function () {
            if ($j(this).prev().length > 0) {
                if ($j(this).position().top != $j(this).prev().position().top) return false;
                productsInRow++
            } else productsInRow++
        });
        $j(row).children(":nth-child(" + productsInRow + "n)").after('<div class="product-view-ajax-container temp"></div>')
    };
    $j(".products-list").each(function () {
        calculateProductsInRow(this)
    });
	
	var windowWidth = window.innerWidth || document.documentElement.clientWidth;
	$j(window).resize(function () {
        var windowWidthR = window.innerWidth || document.documentElement.clientWidth;
        if ( windowWidthR != windowWidth) {
        $j(".products-list").each(function () {
            calculateProductsInRow(this)
        })
            windowWidth = windowWidthR;
        }    
    });
});


/* MENU */
jQuery(function ($j) {
    "use strict";
    var duration = {
            menuShow: 400,
            menuCompactShow: 800,
            menuShowShort: 700,
            menuSlide: 400,
            headerTransform: 400,
            switcherFade: 400
        },
        $jheader = $j("header .navbar"),
        $jwindow = $j(window),
        $jbackToTop = $j("header .back-to-top"),
        $jbody = $j("body"),
        $jswitcher = $j(".navbar-switcher", $jheader),
        $jmenu = $j(".navbar-main-menu", $jheader),
        $jmenuItems = $j(".item", $jmenu),
        $jmenuContainer = $j("<div id='menuScrollerWrapper'></div>"),
        $jmenuScrollerOuter = $j("<div class='container' style='overflow: hidden;'></div>"),
        $jmenuScroller = $j("<div style='overflow: hidden;' id='menuScroller'></div>"),
        $jmenuHeight = $j("header .navbar-compact"),
        menuHeightInner = $j("header .navbar-height-inner"),
        menuInner = $j("header .navbar-height-inner").length,
        $jmenuForSlide =
            $jmenuContainer.add($jmenuHeight),
        menuWidth = 0,
        menuActive = false,
        headerHeight = $jheader.outerHeight(),
        latent = $jwindow.scrollTop() >= headerHeight,
        positionHeader = false,
        active = false,
        activeDropHeight = false;

    var reculcPosHeader = function () {
        var headerCompact = false,
            menuShow = false;
        if (menuActive) {
            menuShow = true
        }
        if ($jheader.hasClass("navbar-compact")) {
            headerCompact = true;
            $jheader.removeClass("navbar-compact");
        }
        headerHeight = $jheader.outerHeight();
        positionHeader = 0;
        if (headerCompact) {
            $jheader.addClass("navbar-compact");
        }
        if (menuShow) $jmenuForSlide.show();
        if (parseInt($jheader.css("top")) < -1) {
            $jheader.animate({
                top: positionHeader + "px"
            }, duration.menuCompactShow, 'easeOutBack');
            $jbody.animate({
                'marginTop': headerHeight + "px"
            }, 0);
            if ($j('body').is(':hover')) {
                $j('html, body').animate({
                    scrollTop: $jwindow.scrollTop() + headerHeight
                }, 0);
            }
        }
    };
    if (latent) {
        $jheader.addClass("navbar-compact").animate({
            top: positionHeader + "px"
        }, duration.menuCompactShow, 'easeOutBack');
        $jbody.css({
            'marginTop': headerHeight + "px"
        });
    }

    $j(window).load(function() {
        reculcPosHeader();
    })

    $jbackToTop.click(function() {
        $j("html, body").animate({
            scrollTop: 0
        }, 400)
    });

    $j(window).resize(function() {
        reculcPosHeader();
    });

    var menuTimer;
    $jmenuItems.each(function() {
        var $jthis = $j(this),
            $jdropdown = $jthis.next("dd.item-content");
        if ($jdropdown.length) {
            var pos = menuWidth;
            menuWidth += 100;
            if ($jdropdown.hasClass('content-small')) {
                $jdropdown = $j("<div style='width: 50%; float: left;' class='dropdown-small dropdown dropdown" + pos * 0.01 + "'></div>").append($jdropdown.html());
            } else $jdropdown = $j("<div style='width: 50%; float: left;' class='dropdown dropdown" + pos * 0.01 + "'></div>").append($jdropdown.html());
            $jmenuScroller.append($jdropdown);
            $jthis.addClass("with-sub").mouseenter(function(e) {
                e.preventDefault();
                if (menuTimer) {
                    clearTimeout(menuTimer);
                }
                if (menuActive || menuActive === 0) {

                    if (menuActive !== pos) {
                        var posN = pos / 100;
                        menuActive = pos;

                        if (menuTimer) {
                            clearTimeout(menuTimer);
                        }
                        menuTimer = setTimeout(function() {
                            $jmenuItems.removeClass("active");
                            $jthis.addClass("active");
                            var posClass = '.dropdown' + posN;
                            $jmenuScroller.find('.dropdown').removeClass("active");
                            $jmenuScroller.find(posClass).addClass("active");
                            activeDropHeight = $jmenuScroller.find(posClass).height();
                            $jmenuScroller.css({
                                marginLeft: -pos + "%"
                            });
                            if ($jmenuScroller.find(posClass).hasClass('dropdown-small')) {
                                $j("#menuScrollerWrapper").addClass('color');
                                $j("#menuScrollerWrapper").stop().animate({
                                    height: activeDropHeight
                                }, duration.menuShowShort, function() {
                                    reculcPosHeader();
                                })
                            } else {
                                $j("#menuScrollerWrapper").removeClass('color');
                                $j("#menuScrollerWrapper").stop().animate({
                                    height: activeDropHeight
                                }, duration.menuShow, function() {
                                    reculcPosHeader();
                                })
                            }
                        }, 300);
                    }
                } else {
                    if (menuTimer) {
                        clearTimeout(menuTimer);
                    }
                    menuTimer = setTimeout(function() {

                        $jmenuScroller.css({
                            marginLeft: -pos + "%"
                        });
                        menuActive = pos;
                        $jmenuItems.removeClass("active");
                        $jthis.addClass("active");
                        var posN = pos / 100;
                        $j("#menuScrollerWrapper").css({
                            display: 'block'
                        });
                        $j("#menuScrollerWrapper").css({
                            "height": '0'
                        });
                        var posClass = '.dropdown' + posN;
                        $jmenuScroller.find('.dropdown').removeClass("active");
                        $jmenuScroller.find(posClass).addClass("active");
                        activeDropHeight = $jmenuScroller.find(posClass).height();
                        if (activeDropHeight == 0) {
                            activeDropHeight = $jmenuScroller.parent().css({
                                display: 'block'
                            }).find(posClass).height();
                            $jmenuScroller.parent().css({
                                display: 'none'
                            });
                        }

                        if ($jmenuScroller.find(posClass).hasClass('dropdown-small')) {
                            $j("#menuScrollerWrapper").addClass('color')
                        } else $j("#menuScrollerWrapper").removeClass('color');
                        $j("#menuScrollerWrapper").stop(false, false).animate({
                            height: activeDropHeight
                        }, duration.menuShow, function() {
                            reculcPosHeader();
                        });
                    }, 300);

                }
            }).mouseleave(function(e) {
                if (menuTimer) {
                    clearTimeout(menuTimer);
                }
                menuTimer = setTimeout(function() {
                    $jmenuItems.removeClass("active");
                    $jmenuScroller.find('.dropdown').removeClass("active");
                    $j("#menuScrollerWrapper").stop(false, false).animate({
                        height: 0
                    }, duration.menuShow, function() {
                        reculcPosHeader();
                    });
                    menuActive = false;
                }, 300);
            });
        }
    });
    $jmenuScroller.mouseenter(function(e) {
            if (menuTimer) {
                clearTimeout(menuTimer);
            }
        })
        .mouseleave(function(e) {
            if (menuTimer) {
                clearTimeout(menuTimer);
            }
            menuTimer = setTimeout(function() {
                $jmenuItems.removeClass("active");
                $j("#menuScrollerWrapper").stop().animate({
                    height: 0
                }, duration.menuShow, function() {
                    reculcPosHeader();
                });
                menuActive = false;
            }, 300);
        });

    $jmenuScroller.css("width", menuWidth + "%");
    $jmenuScroller.children("div").css("width", 100 / (menuWidth / 100) + "%");
    $j('.navbar .background').append($jmenuContainer.append($jmenuScrollerOuter.append($jmenuScroller)));
    $jmenuHeight.css({
        height: $jmenuContainer.height() + (menuInner ? 0 : headerHeight - 14) + "px",
        display: "none"
    });
    $jwindow.scroll(function() {
        if (!latent && $jwindow.scrollTop() >= headerHeight) {
            if (!$j('#footer-collapsed').hasClass('blockHeader')) {
                menuActive = false;
                $jbackToTop.stop().fadeIn(300);
                if ($j('html').hasClass('no-touch')) {
                    $jheader.addClass("navbar-compact");
                    reculcPosHeader();
                    $jheader.stop().animate({
                        top: positionHeader + "px"
                    }, duration.menuCompactShow, 'easeOutBack');
                }
                latent = true;
            }
        } else if (latent && $jwindow.scrollTop() < headerHeight) {
            if ($j('html').hasClass('no-touch')) {
                $jheader.stop().css("top", "").removeClass("navbar-compact");
                $jbody.css("marginTop", "")
            }
            $jbackToTop.stop().fadeOut(300);
            active = false;
            latent = false;
        }
    });

    var $jmenuClose = $j('.megamenuClose');
    $jmenuClose.on("click", function(e) {
        if (menuTimer) {
            clearTimeout(menuTimer);
        }
        menuTimer = setTimeout(function() {
            $jmenuItems.removeClass("active");
            $j("#menuScrollerWrapper").stop().animate({
                height: 0
            }, duration.menuShow, function() {
                reculcPosHeader();
            });
            menuActive = false;
        }, 300);
    })

});

jQuery(function($j) {
    "use strict";
    $j(".social-widgets .item").each(function() {
        var $jthis = $j(this),
            timer;
        $jthis.on("mouseenter", function() {
            var $jthis = $j(this);
            if (timer) clearTimeout(timer);
            timer = setTimeout(function() {
                $jthis.addClass("active")
            }, 200)
        }).on("mouseleave", function() {
            var $jthis = $j(this);
            if (timer) clearTimeout(timer);
            timer = setTimeout(function() {
                $jthis.removeClass("active")
            }, 100)
        }).on("click", function(e) {
            e.preventDefault()
        })
    })
});
jQuery(function($j) {
    "use strict";
    $j(".live-chat").each(function() {
        var $jthis = $j(this),
            timer;
        $jthis.on("mouseenter", function() {
            var $jthis = $j(this);
            if (timer) clearTimeout(timer);
            timer = setTimeout(function() {
                $jthis.addClass("active")
            }, 200)
        }).on("mouseleave", function() {
            var $jthis = $j(this);
            if (timer) clearTimeout(timer);
            timer = setTimeout(function() {
                $jthis.removeClass("active")
            }, 100)
        }).on("click", function(e) {
            e.preventDefault()
        })
    })
});
jQuery(function($j) {
    "use strict";
    var $jsliderRange = $j(".slider-range");
    if ($jsliderRange.length > 0) {
        $jsliderRange.noUiSlider({
            start: [0, 320],
            connect: true,
            range: {
                'min': 0,
                'max': 400
            }
        });

        $jsliderRange.Link('lower').to($j("#value-lower"));

        $jsliderRange.Link('upper').to($j("#value-upper"));
    }
});
jQuery(function($j) {
    "use strict";
    $j(".expander-list").find("ul").hide().end().find(" .expander").text("+").end().find(".active").each(function() {
        $j(this).parents("li ").each(function() {
            var $jthis = $j(this),
                $jul = $jthis.find("> ul"),
                $jname = $jthis.find("> .name a"),
                $jexpander = $jthis.find("> .name .expander");
            $jul.show();
            $jname.css("font-weight", "bold");
            $jexpander.html("&minus;")
        })
    }).end().find(" .expander").each(function() {
        var $jthis = $j(this),
            hide = $jthis.text() === "+",
            $jul = $jthis.parent(".name").next("ul"),
            $jname = $jthis.next("a");
        $jthis.click(function() {
            if ($jul.css("display") ==
                "block") $jul.slideUp("slow");
            else $jul.slideDown("slow");
            $j(this).html(hide ? "&minus;" : "+");
            $jname.css("font-weight", hide ? "bold" : "normal");
            hide = !hide
        })
    })
});
jQuery(function($j) {
    "use strict";
    $j(".collapsed-block .expander").click(function(e) {
        var collapse_content_selector = $j(this).attr("href");
        var expander = $j(this);
        if (!$j(collapse_content_selector).hasClass("open")) expander.addClass("open").html("&minus;");
        else expander.removeClass("open").html("+");
        if (!$j(collapse_content_selector).hasClass("open")) $j(collapse_content_selector).addClass("open").slideDown("normal");
        else $j(collapse_content_selector).removeClass("open").slideUp("normal");
        e.preventDefault()
    })
});

jQuery(function($j) {
    "use strict";
    if ($j(".no-touch .cloudzoom").length) {
        CloudZoom.quickStart();
    }
});
jQuery(function($j) {
    "use strict";

    carouselProductNoSpace();

    var $jmainContainer = $j(".container"),
        $jsection = $j(".products-list"),
        $jlinks = $j(".quick-view:not(.fancybox)"),
        $jview = $j(".product-view-ajax"),
        $jcontainer = $j(".product-view-container", $jview),
        $jloader = $j(".ajax-loader", $jview),
        $jlayar = $j(".layar", $jview),
        $jslider;
    var initProductView = function($jproductView) {
        var $jclose = $j(".close-view", $jproductView);
        $jclose.click(function(e) {
            e.preventDefault();
            $jcontainer.slideUp(500, function() {
                $jcontainer.empty();
                $jview.hide();
                $jcontainer.show()
            })
            setTimeout(function() {
                $j('html, body').animate({
                    scrollTop: $j(".product-preview.active").offset().top - 70
                }, 500, function() {
                    $j(".product-preview.active").removeClass('active');
                });
            }, 500)
        })
    };
    $jlinks.click(function(e) {
        if ($j(".hidden-xs").is(":visible")) {
            e.preventDefault();
            var $jthis = $j(this),
                url = $jthis.attr("href");
            $jthis.closest(".product-preview").addClass('active');
            if ($jthis.closest(".product-carousel").length > 0) {
                $jthis.closest(".product-carousel").next(".product-view-ajax-container").first().append($jview);
            } else if ($jthis.closest(".products-nospace-outer.products-list").length > 0) {
                $jthis.closest(".listing-row").nextAll('.product-view-ajax-container:first').append($jview);
            } else if ($jthis.closest(".products-list").length > 0) {
                $jthis.closest(".product-preview-outer").nextAll('.product-view-ajax-container:first').append($jview);
            } else if ($jthis.closest(".products-nospace-outer").length > 0) {
                $jthis.closest(".products-nospace-outer").nextAll('.product-view-ajax-container:first').append($jview);
            } else {
                $jthis.parent().parent().nextAll('.product-view-ajax-container:first').append($jview);
            }
            $jview.show();
            $jlayar.show();
            $jloader.show();
            $j('html, body').animate({
                scrollTop: $jthis.closest(".product-preview").offset().top
            }, 500);
            setTimeout(function() {
                $j.ajax({
                    url: url,
                    cache: false,
                    success: function(data) {
                        var $jdata = $j(data);
                        initProductView($jdata);
                        $jloader.hide();
                        $jlayar.hide();
                        if (!$jcontainer.text()) {
                            $jdata.hide();
                            $jcontainer.empty().append($jdata);
                            $jdata.slideDown(500)
                        } else $jcontainer.empty().append($jdata)
                    },
                    complete: function() {
                        //console.log("ajax complete");
                        $j('html, body').animate({
                            scrollTop: $jview.offset().top - 100
                        }, 500);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $jloader.hide();
                        $jcontainer.html(textStatus)
                    }
                })

            }, 1000);
        }
    });
    initProductView();

    var productCarousel = $j(".product-carousel");

    productCarousel.slick({
        dots: false,
        infinite: false,
        speed: 500,
        slidesToShow: 6,
        slidesToScroll: 6,
        responsive: [{
            breakpoint: 1199,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 5
            }
        }, 
		{
            breakpoint: 992,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4
            }
        }, {
            breakpoint: 769,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        }, {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },  {
            breakpoint: 481,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 321,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    });


    $j(".single-product-carousel").slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-nav',
        responsive: [{
            breakpoint: 481,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }, {
            breakpoint: 321,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }]
    })


    if ($j('.slider-nav').length) {

        var slidernavItem = 3;

        if (!$j('.slider-nav').parent().find('.video-link').length) {
            slidernavItem = 4;
            $j('.slider-nav').css({
                'width': '100%'
            })
        }

        $j('.responsive .slider-nav').slick({
            slidesToShow: slidernavItem,
            slidesToScroll: 1,
            asNavFor: '.single-product-carousel',
            speed: 300,
            dots: false,
            arrows: false,
            centerMode: false,
            focusOnSelect: true,
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: slidernavItem,
                    slidesToScroll: 1,
                    centerMode: false
                }

            }]
         });
    }

    $j(".single-product").slick({
        dots: false,
        infinite: true,
        speed: 300,
		fade: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.slider-nav-simple',
        responsive: [{
            breakpoint: 481,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }, {
            breakpoint: 321,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }]
    })
	if ($j('.slider-nav-simple').length)	{
		
		var slidernavItem = 3;
		
		if (!$j('.slider-nav-simple').parent().find('.video-link').length){
			slidernavItem = 4;
			$j('.slider-nav-simple').css({'width':'100%'})
		}
		$j('.slider-nav-simple').slick({
			slidesToShow: slidernavItem,
			slidesToScroll: 1,
			asNavFor: '.single-product',
			speed: 300,
			dots: false,
			arrows: false,
			centerMode: false,
			focusOnSelect: true,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: slidernavItem,
					slidesToScroll: 1,
					centerMode: false
				}

			}]
		});
		
	}


    $j('.testimonials-widget .slides').slick({
        dots: false,
        infinite: false,
        vertical: true,
        arrows: true,
        autoplay: false,
        speed: 500,
        slidesToScroll: 1,
        slidesToShow: 1,
		touchMove: false
        //variableWidth: true
    });

	
    $j(".circle_banners .row").slick({
        dots: false,
        infinite: false,
		draggable: false,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 769,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
				arrows: false,
				draggable: true
            }
        }
		]
    });

    $j(".blog-widget .slides").slick({
        dots: false,
        infinite: false,
		draggable: false,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 769,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 681,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 321,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    });

    //	category banner  carousel

    var categoryCarousel = $j('.category-slider');
    categoryCarousel.slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1
    });


    //	news carousel

    var newsCarousel = $j('#newsCarousel');
    newsCarousel.slick({
        dots: false,
        infinite: false,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1
    });

    //	news marquee
    $j('#newsCarousel .marquee').liMarquee();

    $j(".blog-widget .slides button").hover(function () {
        $j(this).parent().find(".slick-list").toggleClass('nav-hover')
    });



    /* remove titles right space if no carousel arrows */

    $j('.slick-slider').each(function () {
        var $jthis = $j(this);
        if (!$jthis.find('button').length) {
			//console.log('no');
           $jthis.parent().prev('.right-space').addClass('no-right-space');
           $jthis.parent().prev().prev('.right-space').addClass('no-right-space');
        }
    })
	
		var windowWidth = window.innerWidth || document.documentElement.clientWidth;	
		$j(window).resize(function () {
        var windowWidthR = window.innerWidth || document.documentElement.clientWidth;
        if ( windowWidthR != windowWidth) {
        clearTimeout(window.resizeEvt);
        window.resizeEvt = setTimeout(function () {
			$j('.slick-slider').each(function () {
				var $jthis = $j(this);
				if (!$jthis.find('button').length) {
					//console.log('no');
					$jthis.parent().prev('.right-space').addClass('no-right-space');
					$jthis.parent().prev().prev('.right-space').addClass('no-right-space');
				} else {
					//console.log('yes');
					$jthis.parent().prev('.right-space').removeClass('no-right-space');
					$jthis.parent().prev().prev('.right-space').removeClass('no-right-space');
				}
			})
        }, 500);
            windowWidth = windowWidthR;
        }    
    });	
});
$j(window).load(function () {

	"use strict";
	
            var loadcontainer = $j('.facebook-widget').find(".loading");
            $j.ajax({
                url: $j('.facebook-widget a').attr("href"),
                cache: false,
                success: function (data) {
                    setTimeout(function () {
                        loadcontainer.html(data)
                    }, 1000)
                }
            });

    slideHoverWidth();
	
	equalHeight('.rect-equal-height');
	
	//setTimeout(function() {
	 //if ($j('#popup-box').length) {
	   //$j.magnificPopup.open({
		//items: {
			//src: '#popup-box'
		//},
		//mainClass: 'mfp-fade',
		//closeBtnInside:true,
		//closeMarkup: '<button title="%title%" class="mfp-close">&times;</button>',
		//type: 'inline'
		  //});
	   //}
	 //}, 1000);

    $j('#menuScrollerWrapper').css({
        display: 'block'
    });
    $j('.header-product-carousel').slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $j('#menuScrollerWrapper').css({
        display: 'none'
    });


    $j("body").width($j("body").width() + 1).width("auto");

    var windowWidth = window.innerWidth || document.documentElement.clientWidth;
    var animate = $j(".animate");
    var animateDelay = $j(".animate-delay-outer");
    var animateDelayItem = $j(".animate-delay");
    if (windowWidth > 767) {
        animate.bind("inview", function (event, visible) {
            if (visible && !$j(this).hasClass("animated")) $j(this).addClass("animated")
        });
        animateDelay.bind("inview", function (event, visible) {
            if (visible && !$j(this).hasClass("animated")) {
                var j = -1;
                var $jthis = $j(this).find(".animate-delay");
                $jthis.each(function () {
                    var $jthis = jQuery(this);
                    j++;
                    setTimeout(function () {
                        $jthis.addClass("animated")
                    }, 200 * j)
                });
                $j(this).addClass("animated")
            }
        })
    } else {
        animate.each(function () {
            $j(this).removeClass("animate")
        });
        animateDelayItem.each(function () {
            $j(this).removeClass("animate-delay")
        })
    }

    var counter = $j(".counter")

    if (counter.length > 0) {
        $j('.counter').countTo();
    }

    var tabsLeftTabs = $j(".responsive .tabs-left .nav-tabs"),
        tabsLeftContent = $j('.responsive .tabs-left .tab-content');

    if (tabsLeftContent.length > 0) {
        tabsLeftContent.css({
            'min-height': tabsLeftTabs.height() - 3
        });
    }


    $j(".preview.hover-slide .preview-image").each(function () {
        var imageHeight = $j(this).find("img").height();
        $j(this).css({
            "height": imageHeight
        })
    });
    $j("body > .loader").fadeOut("slow");
    if ($j(".no-touch .parallax").length > 0) $j(".no-touch .parallax").parallax({
        speed: 0,
        axis: "y"
    });

/*var $jisotop = $j(".products-nospace.products-isotope")
if ($jisotop.length) {
        $jisotop.isotope({
            itemSelector: ".product-preview,.banner",
			masonry: {
			  columnWidth: function() {
				// 5 columns
				return this.size.innerWidth / 5;
			  }
			}
        });}

*/
    var $jisotop = $j(".products-isotope")
    if ($jisotop.length) {
	if($jisotop.children().length == 0) { 
		$jisotop.parent().parent('section.content').hide();
	}
	else { 
		// add columnWidth function to Masonry
		var MasonryMode = Isotope.LayoutMode.modes.masonry;
		MasonryMode.prototype._getMeasurement = function( measurement, size ) {
		  var option = this.options[ measurement ];
		  var elem;
		  if ( !option ) {
			// default to 0
			this[ measurement ] = 0;
		  } else if ( typeof option === 'function' ) {
			this[ measurement ] = option.call( this );
		  } else {
			// use option as an element
			if ( typeof option === 'string' ) {
			  elem = this.element.querySelector( option );
			} else if ( isElement( option ) ) {
			  elem = option;
			}
			// use size of element, if element
			this[ measurement ] = elem ? getSize( elem )[ size ] : option;
		  }
		};
			
			$jisotop.isotope({
				itemSelector: ".product-preview,.banner,.item",
				masonry: {
				  columnWidth: function() {
					return this.size.innerWidth / 60;
				  }
				}
			});
			var $optionSets = $j(".filters-by-category .option-set"),
				$optionLinks = $optionSets.find("a");
			$optionLinks.click(function () {
				var $this = $j(this);
				if ($this.hasClass("selected")) return false;
				var $optionSet = $this.parents(".option-set");
				$optionSet.find(".selected").removeClass("selected");
				$this.addClass("selected");
				var options = {},
					key = $optionSet.attr("data-option-key"),
					value = $this.attr("data-option-value");
				value = value === "false" ? false : value;
				options[key] = value;
				if (key === "layoutMode" && typeof changeLayoutMode === "function") changeLayoutMode($this, options);
				else $jisotop.isotope(options);
				return false
			})
		}
	 }

	var $jisotopPost = $j(".blog-posts")
    if ($jisotopPost.length) {
        $jisotopPost.isotope({
            itemSelector: ".blog-post"
        });
        var $optionSets = $j(".filters-by-category .option-set"),
            $optionLinks = $optionSets.find("a");
        $optionLinks.click(function () {
            var $this = $j(this);
            if ($this.hasClass("selected")) return false;
            var $optionSet = $this.parents(".option-set");
            $optionSet.find(".selected").removeClass("selected");
            $this.addClass("selected");
            var options = {},
                key = $optionSet.attr("data-option-key"),
                value = $this.attr("data-option-value");
            value = value === "false" ? false : value;
            options[key] = value;
            if (key === "layoutMode" && typeof changeLayoutMode === "function") changeLayoutMode($this, options);
            else $jisotopPost.isotope(options);
            return false
        })

    }
		$j('.marina .product-preview .preview-image, .marina .products-widget .preview-image, .marina .blog-widget-small .preview-image, .marina .single-product-wrapper, .marina .elevatezoom-gallery, .marina .video-link .img-outer').each(function() {
			$j(this).height($j(this).width());
		});
		
	footerStick();
	

	if ($j(".product-images-cell").length){
		 var productViewHeight =  $j(".product-images-cell").height();
		 $j(".product-view").css({'min-height': productViewHeight+'px'});
	}

	var windowWidth = window.innerWidth || document.documentElement.clientWidth;
	$j(window).resize(function () {
		footerStick();
        var windowWidthR = window.innerWidth || document.documentElement.clientWidth;
        if ( windowWidthR != windowWidth) {
			$j('.marina .product-preview .preview-image, .marina .products-widget .preview-image, .marina .blog-widget-small .preview-image, .marina .single-product-wrapper, .marina .elevatezoom-gallery, .marina .video-link .img-outer').each(function() {
				$j(this).height($j(this).width());
			});
			carouselProductNoSpace();
			slideHoverWidth();
			//if ($j("#popup-box").length > 0 && $j("#colorbox").is(":visible")) {
				//$j.colorbox({inline: true, href: "#popup-box", preloading: false, fixed: true, opacity: 0.75});
			//}
            setTimeout(function () {
                if ($j(".product-images-cell").length){
                    $j(".product-view").css({'min-height': 0 });
                    var productViewHeight =  $j(".product-images-cell").height();
                    $j(".product-view").css({'min-height': productViewHeight+'px'});
                }
            }, 500)
            windowWidth = windowWidthR;
        }    
    });	
});



/************************************************** web-developer scripts */
$j(function ($j) {
    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
});

/* mailing-list.js */
$j(document).ready(function() {
    $j('#signup').submit(function() {
        // update user interface
        $j('#response').html('Adding email address...');
        //window.alert('ajax=true&email=' + escape($('#email').val())+'&apikey=' + escape($('#apikey').val())+'&listid=' + escape($('#listid').val()));
        // Prepare query string and send AJAX request
        $.ajax({
            url: 'image/inc/store-address.php',
            data: 'ajax=true&email=' + escape($('#email').val())+'&apikey=' + escape($('#apikey').val())+'&listid=' + escape($('#listid').val()),
            success: function(msg) {
                $j('#response').html(msg);
            }
        });

        return false;
    });

    $j('#signup1').submit(function() {
        $j('#response1').html('Adding email address...');
        $.ajax({
            url: 'image/inc/store-address1.php',
            data: 'ajax=true&email1=' + escape($('#email1').val())+'&apikey1=' + escape($('#apikey1').val())+'&listid1=' + escape($('#listid1').val()),
            success: function(msg) {
                $j('#response1').html(msg);
            }
        });

        return false;
    });

});
/* end mailing-list.js */

var cart_theme = {
    'add': function(product_id, quantity) {
        $.ajax({
            url: 'index.php?route=checkout/cart/add',
            type: 'post',
            data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
            dataType: 'json',
            beforeSend: function() {
                //$('.cart > a').button('loading');
            },
            success: function(json) {
                $('.alert, .text-danger').remove();

                $('.cart > a').button('reset');

                if (json['redirect']) {
                    location = json['redirect'];
                }

                if (json['success']) {
                    //$('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('#notification').parent().before('<div class="preloader"><div class="success_ev" style="display: none;">' + json['success'] + '</div></div>');
                    $('.success_ev').fadeIn();


                    var str=json['total'];
                    var myArray = str.split(' ');
                    var str1=myArray[0];

                    $('.cart-total-number').html(str1);

                    $('.cart > ul').load('index.php?route=common/cart/info ul li');
                    setTimeout(function(){
                        jQuery('.success_ev').fadeOut();
                        jQuery('.preloader').remove();
                    },1500)
                    //$('#open-cart').click();
                }
            }
        });
    },
    'update': function(key, quantity) {
        $.ajax({
            url: 'index.php?route=checkout/cart/edit',
            type: 'post',
            data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
            dataType: 'json',
            beforeSend: function() {
                //$('.cart > a').button('loading');
            },
            success: function(json) {
                $('.cart > a').button('reset');

                var str=json['total'];
                var myArray = str.split(' ');
                var str1=myArray[0];

                $('.cart-total-number').html(str1);


                if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
                    location = 'index.php?route=checkout/cart';
                } else {
                    $('.cart > ul').load('index.php?route=common/cart/info ul li');
                }
            }
        });
    },
    'remove': function(key,item) {
        $.ajax({
            url: 'index.php?route=checkout/cart/remove',
            type: 'post',
            data: 'key=' + key,
            dataType: 'json',
            beforeSend: function() {
                //$('.cart > button').button('loading');
            },
            success: function(json) {
                $('.cart > a').button('reset');


                var str=json['total'];
                var myArray = str.split(' ');
                var str1=myArray[0];

                    $('.cart-total-number').html(str1);

                    //$('#drop-shopcart .item'+item).remove();

                    //if ($j("#drop-shopcart .list > div.item").length == 0){
                        //$j("#drop-shopcart .total").hide();
                        //$j("#drop-shopcart .cart_buttons").hide();

                        //$j("#drop-shopcart #empty_cart").show();
                    //}


                if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
                    location = 'index.php?route=checkout/cart';
                } else {
                    $('.cart > ul').load('index.php?route=common/cart/info ul li');

                    window.location.reload();
                }
            }
        });
    }
}


var voucher = {
    'add': function() {

    },
    'remove': function(key) {
        $.ajax({
            url: 'index.php?route=checkout/cart/remove',
            type: 'post',
            data: 'key=' + key,
            dataType: 'json',
            beforeSend: function() {
                $('.cart > a').button('loading');
            },
            complete: function() {
                $('.cart > a').button('reset');
            },
            success: function(json) {
                // Need to set timeout otherwise it wont update the total
                setTimeout(function () {
                    $('.cart > a').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
                }, 100);

                if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
                    location = 'index.php?route=checkout/cart';
                } else {
                    $('.cart > ul').load('index.php?route=common/cart/info ul li');
                }
            }
        });
    }
}


var wishlist_theme = {
    'add': function(product_id) {
        $.ajax({
            url: 'index.php?route=account/wishlist/add',
            type: 'post',
            data: 'product_id=' + product_id,
            dataType: 'json',
            success: function(json) {
                $('.alert').remove();

                if (json['success']) {
                    //$('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('#notification').parent().before('<div class="preloader"><div class="success_ev" style="display: none;">' + json['success'] + '</div></div>');
                    $('.success_ev').fadeIn('slow');

                }

                if (json['info']) {
                    //$('#content').parent().before('<div class="alert alert-info"><i class="fa fa-info-circle"></i> ' + json['info'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('#notification').parent().before('<div class="preloader"><div class="success_ev" style="display: none;">' + json['info'] + '</div></div>');
                    $('.success_ev').fadeIn('slow');

                }

                $('#wishlist-total').html(json['total']);

                setTimeout(function(){
                    jQuery('.success_ev').fadeOut();
                    jQuery('.preloader').remove();
                },1500)


            }
        });
    },
    'remove': function() {

    }
}

var compare_theme = {
    'add': function(product_id) {
        $.ajax({
            url: 'index.php?route=product/compare/add',
            type: 'post',
            data: 'product_id=' + product_id,
            dataType: 'json',
            success: function(json) {
                $('.alert').remove();

                if (json['success']) {
                    //$('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('#notification').parent().before('<div class="preloader"><div class="success_ev" style="display: none;">' + json['success'] + '</div></div>');
                    $('.success_ev').fadeIn('slow');

                    $('#compare-total').html(json['total']);

                    setTimeout(function(){
                        jQuery('.success_ev').fadeOut();
                        jQuery('.preloader').remove();
                    },1500)

                }
            }
        });
    },
    'remove': function() {

    }
}

jQuery(function ($) {
    "use strict";
    var iconcolor = $(".icon-color:not(.disable)");
    var iconsize = $(".icon-size:not(.disable)");
    iconcolor.click(function () {
        if ($(this).hasClass("selected")) iconcolor.each(function () {
            $(this).removeClass("selected")
        });
        else {
            iconcolor.each(function () {
                $(this).removeClass("selected")
            });
            $(this).addClass("selected")
        }
    });
    iconsize.click(function () {
        if ($(this).hasClass("selected")) iconsize.each(function () {
            $(this).removeClass("selected")
        });
        else {
            iconsize.each(function () {
                $(this).removeClass("selected")
            });
            $(this).addClass("selected")
        }
    });
    var iconcolorPreview = $(".product-preview .icon-color:not(.disable)");
    iconcolorPreview.click(function (e) {
        var url = $(this).data("href");
        $(this).closest(".product-preview").find(".preview-image img").prop("src", url);
        return false
    })
});


jQuery(function ($) {
    "use strict";
    $.initQuantity = function ($control) {
        $control.each(function () {
            var $this = $(this),
                data = $this.data("inited-control"),
                $plus = $(".input-group-addon:last", $this),
                $minus = $(".input-group-addon:first", $this),
                $value = $(".form-control", $this);
            if (!data) {
                $control.attr("unselectable", "on").css({
                    "-moz-user-select": "none",
                    "-o-user-select": "none",
                    "-khtml-user-select": "none",
                    "-webkit-user-select": "none",
                    "-ms-user-select": "none",
                    "user-select": "none"
                }).bind("selectstart", function () {
                        return false
                    });
                $plus.click(function () {
                    var val =
                        parseInt($value.val()) + 1;
                    $value.val(val);
                    return false
                });
                $minus.click(function () {
                    var val = parseInt($value.val()) - 1;
                    $value.val(val > 0 ? val : 1);
                    return false
                });
                $value.blur(function () {
                    var val = parseInt($value.val());
                    $value.val(val > 0 ? val : 1)
                })
            }
        })
    };
    $.initQuantity($(".quantity-control"));
    $.initSelect = function ($select) {
        $select.each(function () {
            var $this = $(this),
                data = $this.data("inited-select"),
                $value = $(".value", $this),
                $hidden = $(".input-hidden", $this),
                $items = $(".dropdown-menu li > a", $this);
            if (!data) {
                $items.click(function (e) {
                    if ($(this).closest(".sort-isotope").length >
                        0) e.preventDefault();
                    var data = $(this).attr("data-value"),
                        dataHTML = $(this).html();
                    $this.trigger("change", {
                        value: data,
                        html: dataHTML
                    });
                    $value.html(dataHTML);
                    if ($hidden.length) $hidden.val(data)
                });
                $this.data("inited-select", true)
            }
        })
    };
    $.initSelect($(".btn-select"))


});

function heightServiceBlocks() {
    var height_block1 = $(".services-block .item1").height();
    var height_block2 = $(".services-block .item2").height();
    var height_block3 = $(".services-block .item3").height();

    var _array = [height_block1,height_block2,height_block3];
    var max_height = Math.max.apply(Math,_array);
    $(".services-block .service_item").css({
        "min-height": max_height + 'px'
    });
}


$(function ($) {
    heightServiceBlocks();



});

/*cookies*/
/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // CommonJS
        factory(require('jquery'));
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {

    var pluses = /\+/g;

    function encode(s) {
        return config.raw ? s : encodeURIComponent(s);
    }

    function decode(s) {
        return config.raw ? s : decodeURIComponent(s);
    }

    function stringifyCookieValue(value) {
        return encode(config.json ? JSON.stringify(value) : String(value));
    }

    function parseCookieValue(s) {
        if (s.indexOf('"') === 0) {
            // This is a quoted cookie as according to RFC2068, unescape...
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }

        try {
            // Replace server-side written pluses with spaces.
            // If we can't decode the cookie, ignore it, it's unusable.
            // If we can't parse the cookie, ignore it, it's unusable.
            s = decodeURIComponent(s.replace(pluses, ' '));
            return config.json ? JSON.parse(s) : s;
        } catch(e) {}
    }

    function read(s, converter) {
        var value = config.raw ? s : parseCookieValue(s);
        return $.isFunction(converter) ? converter(value) : value;
    }

    var config = $.cookie = function (key, value, options) {

        // Write

        if (value !== undefined && !$.isFunction(value)) {
            options = $.extend({}, config.defaults, options);

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setTime(+t + days * 864e+5);
            }

            return (document.cookie = [
                encode(key), '=', stringifyCookieValue(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }

        // Read

        var result = key ? undefined : {};

        // To prevent the for loop in the first place assign an empty array
        // in case there are no cookies at all. Also prevents odd result when
        // calling $.cookie().
        var cookies = document.cookie ? document.cookie.split('; ') : [];

        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            var name = decode(parts.shift());
            var cookie = parts.join('=');

            if (key && key === name) {
                // If second argument (value) is a function it's a converter...
                result = read(cookie, value);
                break;
            }

            // Prevent storing a cookie that we couldn't decode.
            if (!key && (cookie = read(cookie)) !== undefined) {
                result[name] = cookie;
            }
        }

        return result;
    };

    config.defaults = {};

    $.removeCookie = function (key, options) {
        if ($.cookie(key) === undefined) {
            return false;
        }

        // Must not alter options, thus extending a fresh object...
        $.cookie(key, '', $.extend({}, options, { expires: -1 }));
        return !$.cookie(key);
    };

}));


function openNewsletterPopup(){
    setTimeout(function() {
        if ($j('#popup-box').length) {
            $j.magnificPopup.open({
                items: {
                    src: '#popup-box'
                },
                mainClass: 'mfp-fade',
                closeBtnInside:true,
                closeMarkup: '<button title="%title%" class="mfp-close">&times;</button>',
                type: 'inline'
            });
        }
    }, 1000);
}

$j(function(){
    if ($j(window).width() > 768) {
        show_popup= $j.cookie('show_popup');
        if(show_popup == null || show_popup=='enabled'){
            openNewsletterPopup()
        }
        $j('#donot_show_checkbox').change(function() {
            show_popup= $j.cookie('show_popup');
            if($j(this).is(":checked")) {
                show_popup= $j.cookie('show_popup','disabled');
            } else {
                show_popup= $j.cookie('show_popup','enabled');
            }
        });
    }
})

$(window).resize(function() {
    heightServiceBlocks();
});

/* layout panel */
jQuery(function ($) {

    $j('#layout-panel .btn-toggle').click(function(e){
        e.preventDefault();
        if ($j('#layout-panel').hasClass('open')){
            $j('#layout-panel').removeClass('open').animate({ 'right':-320 },600);
        } else {
            $j('#layout-panel').addClass('open').animate({ 'right':0 },400);
        }
    });

    $j('#layout-panel .demos').css({'height': $j('#layout-panel').height()} )


    function debouncer( func , timeout ) {
        var timeoutID , timeout = timeout || 200;
        return function () {
            var scope = this , args = arguments;
            clearTimeout( timeoutID );
            timeoutID = setTimeout( function () {
                func.apply( scope , Array.prototype.slice.call( args ) );
            } , timeout );
        }
    }


    $j( window ).resize( debouncer( function ( e ) {
        $j('#layout-panel .demos').css({'height': $j('#layout-panel').height()} )
    } ) );

});
/* layout panel */
