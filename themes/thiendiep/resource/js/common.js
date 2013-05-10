var jQuery = jQuery.noConflict(); // Use jQuery via jQuery(...)

jQuery(document).ready(function(){
	sprNewSlide();
	jQuery('#relate-products').initHorzRoundGallery({
		auto: true,
		timeIntervall: 4000
	});
	initMenuLeft();
	initSlider();
	zTabs();
	
	jQuery('.recommended-inner').each(function(){
		zvertgallerysync(this, {thumbwarp: '.list-logos ul:first', next: '.btn-down', prev: '.btn-up'});
	});
});

//////////////////
(function($) {
	$.fn.initHorzRoundGallery = function(options){
	var defaults = {
		auto: false,
		timeIntervall: 3000,
		duration: 2000,
		jdisplay: '.list-products-2',
		jnext: '.btn-next',
		jprev: '.btn-prev'
	};
		
	options = $.extend(defaults, options);
	
	return this.each(function(){
		var jcontainer = jQuery(this),
		jdislay = jcontainer.find(options.jdisplay),
		jwrap = jdislay.find('ul:first'),
		jitems = jwrap.children(),
		jnext = jcontainer.find(options.jnext),
		jprev = jcontainer.find(options.jprev);		
		if(jitems.length < 1){
			return;
		}
		var curitem = 0,
			nitem = jitems.length,
			wndwidth = jdislay.width(),
			itemwidth = jitems.eq(0).outerWidth(true),
			zmargin = (wndwidth % itemwidth) / 2,
			animcomplete = true,
			timerId = null,
			visible = Math.ceil(wndwidth / itemwidth);
		zmargin = 0;
		if(nitem <= visible){
			jprev.css('visibility', 'hidden');
			jnext.css('visibility', 'hidden');
			
			return false;
		}
		
		var ndups = Math.ceil(visible / 2) + 2;
		for(var i = 0; i < ndups; i++){
			jitems.eq(i).clone(true).appendTo(jwrap);
			jitems.eq(nitem -i -1).clone(true).prependTo(jwrap);
		}
		
		jitems = jwrap.children();
		
		jwrap.css({
			width: jitems.length * itemwidth,
			marginLeft: -(itemwidth * (ndups + curitem)) + zmargin
		});
		
		
		function next(){
			if(!animcomplete){
				return false;
			}
			
			clearTimeout(timerId);
			
			if(curitem >= nitem){
				curitem = 0;
				jwrap.css('marginLeft', -(itemwidth * (ndups + curitem)) + zmargin);
			}
			
			curitem++;
			animcomplete = false;
		
			jwrap.animate({
				marginLeft: -(itemwidth * (ndups + curitem)) + zmargin
			}, function(){
				animcomplete = true;
				
				if(curitem >= nitem){
					curitem = 0;
					jwrap.css('marginLeft', -(itemwidth * (ndups + curitem)) + zmargin);
				}
			});
			
			//timerId = setTimeout(next, 5000);
			
			return false;
		};
		
		function prev(){
			if(!animcomplete){
				return false;
			}
			
			clearTimeout(timerId);
			
			if(curitem < 0){
				curitem = nitem -1;
				jwrap.css('marginLeft', -(itemwidth * (ndups + curitem)) + zmargin);
			}
			
			curitem--;
			animcomplete = false;
			
			jwrap.stop().animate({
				'marginLeft': -(itemwidth * (ndups + curitem)) + zmargin
			}, function(){
				animcomplete = true;
				if(curitem < 0){
					curitem = nitem -1;
					jwrap.css('marginLeft', -(itemwidth * (ndups + curitem)) + zmargin);
				}				
			});
			
			//timerId = setTimeout(next, 5000);
			
			return false;
		};
		
		//timerId = setTimeout(next, 5000);
		
		jnext.bind('click.zhgn', next);
		jprev.bind('click.zhgn', prev);
		if(options.auto) {
			setInterval(function(){
				next();
			}, options.timeIntervall);
		}
	});
};
	
})(jQuery);
function initSlider(){
	var container = jQuery('#list-pro-thumb');
	var prev = container.find('.btn-up a');
	var next = container.find('.btn-down a');
	var slideObj = jQuery(container).find('div.lstContent > ul');
	var arrThumbs = slideObj.find('a');
	var _HEIGHT = 73;
	productSlider(prev, next, slideObj, arrThumbs, _HEIGHT, 3, false);
	
	var images = new  Array();
	var current = 0;
	arrThumbs.each(function(i, thumb){
		images.push([jQuery(thumb).attr('rel'), jQuery(thumb).attr('title')]);
		jQuery(thumb).bind('click', function(e){
			current = i;
			loadVisual(jQuery(thumb).attr('href'), jQuery(thumb).attr('rel'));
			jQuery(container).find('div.lstContent > ul > .current').removeClass('current');
			jQuery(thumb).parent().addClass('current');
			return false;
		});
	}); 
	
	function loadVisual(src, srcLarge){	
		jQuery('.zoom-product').attr('href', srcLarge);
		jQuery('.zoom-product img').attr('src', src);		
		jQuery('.zoom a').attr('href', srcLarge); 
	}
	jQuery('.zoom-product').click(function(){
		jQuery.slimbox(images, current, {
			overlayOpacity: 0.6,
			counterText: "Hình {x}/{y}",
			closeKeys: [27, 70],
			nextKeys: [39, 83]
		});
		return false;
	});
	jQuery('.zoom a').click(function(){
		jQuery.slimbox(images, current, {
			overlayOpacity: 0.6,
			counterText: "Hình {x}/{y}",
			closeKeys: [27, 70],
			nextKeys: [39, 83]
		});
		
		return false;
	});
	jQuery(arrThumbs[0]).trigger('click');
}

function zTabs(){
		var tabs = jQuery('.tabContainer');
		if(tabs.length > 0) {
			tabs.each(function(index, tab){
				tab = jQuery(tab);
				tab.toggles = tab.find('.tabToggle > li a');
				tab.conents = tab.find('.tabContent');
				
				tab.toggles.each(function(i, toggle){
					toggle = jQuery(toggle);
					toggle.bind('click', function(){
						tab.toggles.removeClass('active');
						jQuery(tab.toggles[i]).addClass('active');
						tab.conents.addClass('hidden');
						jQuery(tab.conents[i]).removeClass('hidden');
						return false;
					});
					if(toggle.hasClass('active')) {
						toggle.trigger('click');
					}
				});
				
			});
		}
	}
function zshowpopup(sel, options){
	var jpopup = jQuery(sel);
	
	if (jpopup.length) {
		jwindow = jQuery(window),
		jhtml = jQuery('body'),
		inittop = jwindow.scrollTop();

		var opt = {
			zIndex: 1999,
			opacity: 0.7,
			closes: ['close'],
			masktime: 500,
			outsideclose: false,
			layertime: 700,
			onclose: false
		};

		jQuery.extend(opt, options);
		
		var zinstance = 'zsinryu' + new Date().getTime();
		var overlay = jQuery('#zmask');
		
		if (!overlay.length) {
			overlay = jQuery('<div id="zmask"></div>').appendTo(document.body);
		}
		overlay.css({
				position: 'fixed',
				top: 0,
				left: 0,
				width: jhtml.innerWidth(),
				height: jhtml.innerHeight(),
				zIndex: opt.zIndex,
				backgroundColor: '#000',
				opacity: 0
			});
		jpopup.insertAfter(overlay);

		var zposition = function(){
			return { top: Math.max(0, (jwindow.height() - jpopup.outerHeight(true)) / 2), left: Math.max(0, (jwindow.width() - jpopup.outerWidth(true)) / 2) };
		}, scroll = function () {
			if (jwindow.height() < jpopup.outerHeight(true) || jwindow.width() < jpopup.outerWidth(true)) {
				jpopup.css({
					'position': 'absolute',
					'top': inittop
				});
				 
			} else {
				if (jpopup.css('position') != 'fixed') {
					var newpos = zposition();

					jpopup.css({
						'position': 'fixed',
						'top': newpos.top
					});
				}
				
			}			
		}, resize = function () {
			var newpos = zposition();
			jpopup.css({
				'position': ((jwindow.height() < jpopup.outerHeight(true)) || (jwindow.width() < jpopup.outerWidth(true))) ? 'absolute' : 'fixed',
				'top': newpos.top,
				'left': newpos.left
			});

			if (overlay) {
				overlay.css({
					'width': jhtml.innerWidth(),
					'height': jhtml.innerHeight()
				});
			}
		}, close = function(){
			if (jQuery.browser.msie && parseInt(jQuery.browser.version) < 9) {
				setTimeout(function () {
					jpopup.css({ 'visibility': 'hidden', 'top': -5000 });
				}, opt.layertime / 3);

			} else {
				jpopup.fadeTo(opt.layertime, 0, function(){
					jpopup.css('top', -5000);
				});
			}

			if (overlay) {
				overlay.fadeTo(opt.masktime, 0, function(){
					overlay.remove();
				});
			}

			jwindow.unbind('scroll.' + zinstance, scroll);
			jwindow.unbind('scroll.' + zinstance, resize);
			
			if(opt.onclose){
				opt.onclose.call(this);
			}
			
			return false;
		};

		jwindow.bind('scroll.' + zinstance, scroll);
		jwindow.bind('resize.' + zinstance, resize);
		jQuery(".btnClose").unbind('click').bind('click', close);
		var closebtn = jpopup.find('.' + opt.closes[0]);
		if(closebtn){
			closebtn.unbind('click').bind('click', close);
			closebtn.css({
				'zIndex': opt.zIndex + 2
			});
		}
		
		if(opt.outsideclose && overlay.length){
			overlay.unbind('click.' + zinstance).bind('click.' + zinstance, close);
		}

		var pos = zposition();

		jpopup.css({
			'position': ((jwindow.height() < jpopup.outerHeight(true)) || (jwindow.width() < jpopup.outerWidth(true))) ? 'absolute' : 'fixed',
			'top': pos.top,
			'left': pos.left,
			'zIndex': opt.zIndex + 1
		});

		overlay.fadeTo(opt.masktime, opt.opacity);

		if (jQuery.browser.msie && parseInt(jQuery.browser.version) < 9) {
			setTimeout(function () {
				jpopup.css('visibility', 'visible');
			}, opt.layertime / 3);
		} else {
			jpopup.css('opacity', 0).fadeTo(opt.layertime, 1);
		}
	}
};
function marquee(){
	jQuery('.zmarquee').each(function(){
		var jmarquee = jQuery(this),
			jwrap = jmarquee.find('ul:first'),
			jitems = jwrap.children(),
			displaywidth = jmarquee.outerWidth(true),
			itemwidth = jitems.eq(0).outerWidth(true),
			nvisible = Math.ceil(displaywidth / itemwidth),
			nitems = jitems.length,
			totalwidth = 0,
			ndups = Math.round(nvisible + 3);
		
		for(var i = 0; i < nitems; i++){
			totalwidth += jitems.eq(i).outerWidth(true);
		}
		
		for(var i = 0; i < ndups; i++){
			jitems.eq(i).clone(true).appendTo(jwrap);
		}
		
		var marginleft = 0,
			run = function(){
				marginleft++;
				if(marginleft >= totalwidth){
					marginleft = 0;
				}
				
				jwrap.css('marginLeft', -marginleft);
			},
			runid = null;
			
		runid = setInterval(run, 17);
		
		jmarquee.mouseenter(function(){
			clearInterval(runid);
		}).mouseleave(function(){
			clearInterval(runid);
			runid = setInterval(run, 17);
		});
	});
	
}

// Bino add from here

(function($, undefined) {
$.fn.binoSlide = function(options) {
	var defaults = {
		view: '.slideshow-frame-inner',
		container: '.slideshow-thumb',
		prev: '.lnk-prev',
		next: '.lnk-next',
		itemsPerSlide: 3
	};
	options = $.extend({}, defaults, options);
	return this.each(function() {
		var that = $(this),
			container = that.find(options.container),
			btnNext = that.find(options.next),
			btnPrev = that.find(options.prev),			
			items = container.children(),
			i = 0;
		var slideNumber = Math.ceil(items.length / options.itemsPerSlide);
		var slideNumber = items.length - options.itemsPerSlide + 1;
		
		if(typeof(options.view) == 'string') {
			var width = that.find(options.view).outerWidth();
		} else {
			var width = options.view;
		}
		if (slideNumber < 2) {
			btnNext.css('visibility', 'hidden');
			btnPrev.css('visibility', 'hidden');
			return;
		}
		
		btnNext.bind('click.binoSlide', function() {
			container.animate({
				'margin-left': -(width * ++i)
			}, 300, function() {
				if (i >= slideNumber - 1) {
					btnNext.css('visibility', 'hidden');
				}
				if (btnPrev.css('visibility') === 'hidden') {
					btnPrev.css('visibility', 'visible');
				}
			});
			return false;
		});
		
		btnPrev.css('visibility', 'hidden').bind('click.binoSlide', function() {
			container.animate({
				'margin-left': -(width * --i)
			}, 300, function() {
				if (i <= 0) {
					btnPrev.css('visibility', 'hidden');
				}
				if (btnNext.css('visibility') === 'hidden') {
					btnNext.css('visibility', 'visible');
				}
			});
			return false;
		});
		
		container.delegate('a', 'click.binoSlide', function() {
			$.isFunction(options.onselect) && options.onselect.call(this);
			return false;
		});
	});
};
})(jQuery);


function productSlider(prev, next, slideObj, arrImgs, _HEIGHT, _LENGTH, auto){
	
	var isClick = true;
	var currentIndex = 0;
	var currentText = 0;
	var _opacity = 0.1;
	var timeDuration = 500;
	var timeDelay = 3000;
	
	if(arrImgs.length <= _LENGTH) {
		prev.css({
				opacity: _opacity,
				cursor: 'default'
			});
		next.css({
				opacity: _opacity,
				cursor: 'default'
			});
	}
	if(arrImgs.length < _LENGTH) {		
		slideObj.css({			
			'height': arrImgs.length * _HEIGHT
		});			
		return;
	}
	if(arrImgs.length <= 1) return;
	prev.bind("click", function(evt) {			
		showProduct(currentImage - 1);
		clearTimeout(timeDelay);
		return false;
	});
	
	next.bind("click", function(evt) {
		showProduct(currentImage + 1);
		clearTimeout(timeDelay);		
		return false;
	});
	
	var isMoving = false;
	var currentImage = 0;
	
	function showProduct(index) {
		if(!auto) {
			if (isMoving) { return; }
			isMoving = true;			
			if (index > 0) {
				prev.css({opacity: 1, cursor: 'pointer'});
			} else {
				prev.css({ opacity: _opacity, cursor: 'default' });
			}			
			if (index <= arrImgs.length - (_LENGTH + 1)) {
				next.css({ opacity: 1, cursor: 'pointer' });
			} else {
				next.css({ 	opacity: _opacity, cursor: 'default' });
			}
		} else {
			if (index < 0) {
				showProduct(arrImgs.length - 1);	
				return false;
			} else if (index > arrImgs.length - 1) {
				showProduct(0);
				return false;
			}
		}
		if (index < 0) {			
			currentImage = 0;
			slideObj.stop().animate({
				"margin-top": 0
			}, timeDuration, function(){
				isMoving = false;
			});
		} else if(index < arrImgs.length - (_LENGTH - 1)) {
			currentImage = index;
			slideObj.stop().animate({
				"margin-top": -currentImage * _HEIGHT
			}, timeDuration, function(){
				isMoving = false;
				
			});
		} else {
			currentImage = arrImgs.length-_LENGTH;
			slideObj.stop().animate({
				"margin-top": -(arrImgs.length-_LENGTH) * _HEIGHT
			}, timeDuration, function(){
				isMoving = false;
			});
		}
	}
	showProduct(0);	
	if(auto) {
		timeDelay = setInterval(function(){
			showProduct(currentImage + _LENGTH);
		}, timeDelay);
	}
} 
function initPopup(){
	jQuery('.view-login').bind('click', function(){		
		zshowpopup(jQuery('#loginPopup'), {closes: ['btnClose']});
	});
	jQuery('#size-guide').bind('click', function(){		
		zshowpopup(jQuery('#size-guide-popup'), {closes: ['btnClose']});
	});
}
function bannerSlider(prev, next, slideObj, arrImgs, _WIDTH, _LENGTH, auto){
	var direction = 1;
	var isClick = true;
	var currentIndex = 0;
	var currentText = 0;
	var _opacity = 0.1;
	var timeDuration = 500;
	var timer;
	var timeDelay = 3000;
	var isMoving = false;
	var currentImage = 0;
	if(arrImgs.length <= _LENGTH) {
		prev.css({
				opacity: _opacity,
				cursor: 'default'
			});
		next.css({
				opacity: _opacity,
				cursor: 'default'
			});
	}
	if(arrImgs.length < _LENGTH) {		
		slideObj.css({			
			'width': arrImgs.length * _WIDTH
		});			
		return;
	}
	if(arrImgs.length <= 1) return;
	prev.bind("click", function(evt) {			
		showProduct(currentImage - 1);
		direction = -1;
		return false;
	});
	
	next.bind("click", function(evt) {
		showProduct(currentImage + 1);
		direction = 1;	
		return false;
	});
	function showProduct(index) {
		if(!auto) {
			if (isMoving) { return; }
			isMoving = true;			
			if (index > 0) {
				prev.css({opacity: 1, cursor: 'pointer'});
			} else {
				prev.css({ opacity: _opacity, cursor: 'default' });
			}			
			if (index <= arrImgs.length - (_LENGTH + 1)) {
				next.css({ opacity: 1, cursor: 'pointer' });
			} else {
				next.css({ 	opacity: _opacity, cursor: 'default' });
			}
		} else {
			if (index < 0) {
				showProduct(arrImgs.length - 1);	
				return false;
			} else if (index > arrImgs.length - 1) {
				showProduct(0);
				return false;
			}
		}
		if(index < arrImgs.length) {
			jQuery(jQuery('.nivo-control')[index]).trigger('click');
			arrImgs.removeClass('current');
			jQuery(arrImgs[index]).addClass('current');
			currentImage = index;
			if(index < arrImgs.length - _LENGTH + 1) {
				slideObj.stop().animate({
					"margin-left": -currentImage * _WIDTH
				}, timeDuration, function(){
					isMoving = false;
					
				});
			}
		}else {
			currentImage = 0;
			slideObj.stop().animate({
				"margin-left": 0
			}, timeDuration, function(){
				isMoving = false;
			});
		}
		
	}
	showProduct(0);	
	if(auto) {
		timer = setInterval(function(){
			showProduct(currentImage + direction);
		}, timeDelay);
	}
} 
function initHomeBanner(){
	var _current = 0;
	var _durationTime = 3000;
	var timer;
	var currentSlide;
	var totalSlides;
	var _nivo = jQuery('.home-banner .nivoSlider').nivoSlider({
		manualAdvance: true,
		beforeChange: function(){
		},
		afterChange: function(){
		},
		afterLoad: function(){
		}		
	});
	jQuery( '.nivo-controlNav a' ).click( function( e ) {
		e.preventDefault();
	});
	var container = jQuery('.slideshow-thumb');
	container = jQuery(container);
	var prev = container.find('.lnk-prev');
	var next = container.find('.lnk-next');
	var slideObj = jQuery(container).find('.lst-thumb-pic');
	var arrThumbs = slideObj.find('a');
	var _WIDTH = 127;
	
	bannerSlider(prev, next, slideObj, arrThumbs, _WIDTH, 5, true);
	
	var lstThumbs = jQuery('.lst-thumb-pic li a');	
	lstThumbs.each(function(index, me){
		me = jQuery(me);
		me.bind('click', function(e){
			jQuery(jQuery('.nivo-control')[index]).trigger('click');
			lstThumbs.removeClass('current');
			me.addClass('current');
			_current = index;
			return false;
		});
	});
}

function zvertgallerysync(gal, info){
	var jelm = jQuery(gal);
	
	if(!jelm.length){
		return;
	}
	
	var jdispimg = jelm.find(info.dispimg),
		jthumbwarp = jelm.find(info.thumbwarp),
		jthumbitems = jthumbwarp.children(),
		jnext = jelm.find(info.next),
		jprev = jelm.find(info.prev);
		
		
	if(jthumbitems.length < 1){
		return;
	}
	
	var visible = 3,
		curitem = 0,
		preitem = 0,
		curview = 0,
		nitem = jthumbitems.length,
		itemheight = jthumbitems.eq(0).outerHeight(true),
		maxview = nitem - visible,
		ndup = Math.round(visible / 2) + 1,
		iidauto = null,
		animend = true;
		
	for(var i = 0; i < nitem; i++){
		if(jthumbitems.eq(i).hasClass('current')){
			curitem = i;
		}
		
		jthumbitems[i]._idx = i;
	};
	
	jthumbitems.removeClass('current');
	
	for(var i = 0; i < ndup; i++){
		jthumbitems.eq(i).clone(true).appendTo(jthumbwarp)[0]._idx = jthumbitems[i]._idx;
		jthumbitems.eq(nitem - i - 1).clone(true).prependTo(jthumbwarp)[0]._idx = jthumbitems[nitem - i - 1]._idx;
	}
	
	jthumbitems.eq(curitem).addClass('current');
	
	jthumbwarp.css({
		height: (nitem + ndup * 2) * itemheight,
		marginTop: -(curitem + ndup) * itemheight
	});
	
	function next(){
		if(!animend){
			return false;
		}
		
		clearInterval(iidauto);
		
		animend = false;
		
		preitem = curitem;
		curitem++;
		
		jthumbwarp.stop(true).animate({
			marginTop: -(curitem + ndup) * itemheight
		}, function(){
			animend = true;
			
			if(curitem > nitem -1){
				curitem = 0;
				jthumbwarp.css('marginTop', -(curitem + ndup) * itemheight);
			}
		});
		
		var titem = curitem > nitem -1 ? 0 : curitem;
		
		jthumbwarp.children().removeClass('current').filter(function(){
			if(this._idx == titem){
				jQuery(this).addClass('current');
			}
		});
		
		jdispimg.find('img').stop().fadeTo(700, 0.3, function(){
			jQuery(this).attr('src', jthumbitems.eq((curitem > nitem -1 ? 0 : curitem)).find('a:first').attr('rel')).fadeTo(500, 1);
		});
		
		autorun(false);
		
		return false;
	};
	
	function prev(){
		if(!animend){
			return false;
		}
		
		clearInterval(iidauto);
		
		animend = false;
		
		preitem = curitem;
		curitem--;
		
		jthumbwarp.stop(true).animate({
			marginTop: -(curitem + ndup) * itemheight
		}, function(){
			animend = true;
			
			if(curitem < 0){
				curitem = nitem -1;
				jthumbwarp.css('marginTop', -(curitem + ndup) * itemheight);
			}
			
			preitem = curitem;
		});
		
		var titem = curitem < 0 ? nitem -1 : curitem;
		
		jthumbwarp.children().removeClass('current').filter(function(){
			if(this._idx == titem){
				jQuery(this).addClass('current');
			}
		});
		
		jdispimg.find('img').stop().fadeTo(700, 0.3, function(){
			jQuery(this).attr('src', jthumbitems.eq(curitem < 0 ? nitem -1 : curitem).find('a:first').attr('rel')).fadeTo(500, 1);
		});
		
		autorun(true);
		
		return false;
	};
		
	jnext.click(next);
	jprev.click(prev);
	
	function autorun(back){
		clearInterval(iidauto);
		iidauto = setInterval((back? prev : next), 3000);
	}
	
	autorun(false);
};
function initMenuLeft(){
	var subMenus = jQuery('.menu-left-sub');
	var showIndex = -1;
	subMenus.each(function(i, me){
		me = jQuery(me);
		me.prev().bind('click', function(e){
			if(showIndex != -1 && showIndex != i) {
				jQuery(subMenus[showIndex]).slideUp();
			} 
			
			me.slideToggle(function(){
				showIndex = i;
			});
			return false;
		});
		if(me.prev().hasClass('current')) {
			me.slideDown();
			showIndex = i;
		}
	});
} 

function sprNewSlide(){
	jQuery('.slider')._TMS({
	   show:0,
	   pauseOnHover:true,
	   prevBu:'.prev',
	   nextBu:'.next',
	   playBu:'.play',
	   duration:800,
	   preset:'fade',
	   pagination:'.pags',
	   pagNums:false,
	   slideshow:7000,
	   numStatus:false,
	   banners: 'fade',
	   waitBannerAnimation:false,
	   progressBar:'<div class="progbar"></div>'
	});
}
function sprLightbox() {
	jQuery(".art-cont img").each(function(){
		jQuery(this).load(function(){
			var wImg = this.width;
			if (wImg>500)
			{
				var urlImg = jQuery(this).attr("src");
				var lightbox = '<a href="'+urlImg+'" rel="lightbox" class="imgLight"/>';
				var lightdes = '<span>Hình ảnh đã được thu nhỏ, click để phòng to</span>';
				jQuery(this).wrap(lightbox);
				jQuery(this).after(lightdes);
			}
		});
	});
}
function sprThumbnail() {
	jQuery(".art-ign img:first").remove();
}
function sprClick() {
	jQuery(".sum a").click(function(){
		var m = jQuery(this).closest("li").index();
		var slideClick = ".index-" + m;
		if (!jQuery(this).closest("li").hasClass("current"))
		{
		jQuery(".sumitem").removeClass("current").removeClass("active");
		jQuery(".activebar").stop(true,false);
		jQuery(".item").removeClass("active");
		jQuery(slideClick).addClass("active");
		jQuery(slideClick).animate({top: "0"}, 300, function(){
			jQuery(slideClick).prevAll("li").css("top","-275px");
			jQuery(slideClick).nextAll("li").css("top","-275px");
		});
		jQuery(this).closest("li").addClass("current").find(".activebar").css("width","100%");
		jQuery(".current").prevAll("li").addClass("previous").find(".activebar").css("width","100%");
		jQuery(".current").nextAll("li").removeClass("previous").find(".activebar").css("width","0%");
		} else {
			jQuery(this).closest("li").removeClass("current").addClass("previous").find(".activebar").css("width","100%");
			sprSlide(m+1);
		}
	});
}
function sprSlide(number){
	if (number >= 0 && number <= 4)
	{
	var n = number + 1;
	var sumClass = ".sum-" + number;
	var barClass = ".sum-" + number + " .activebar";
	if (number <4)
	{
		var slideClass = ".index-" + n;
	} else {
		var slideClass = ".index-0";
		jQuery(slideClass).css("top","-275px");
	}
	jQuery(".item").removeClass("active");
	jQuery(".sumitem").removeClass("active");
	jQuery(sumClass).addClass("active");
	jQuery(slideClass).addClass("active")
	jQuery(barClass).animate({
		width: '100%'
	}, 6000, function(){
		jQuery(slideClass).animate({top:0}, 300);
		jQuery(sumClass).addClass("previous");
		sprSlide(n);
	});
	} else {
		jQuery(".sumitem").removeClass("previous");
		jQuery(".activebar").css("width","0px");
		jQuery(".item").css("top","-275px");
		jQuery(".sprSlide li:first-child").css("top","0px");
		sprSlide(0);
	}
}
function sprFL(){
	jQuery(".top-photos li:first-child").addClass("first");
	jQuery(".navi-list li:first-child").addClass("first");
	jQuery(".sum li:first-child").addClass("first");
	jQuery(".navi-list li:last-child").addClass("last");
	jQuery(".featured li:last-child").addClass("last");
	jQuery(".blog-top4 li:last-child").addClass("last");
	jQuery(".block li:last-child").addClass("last");
	jQuery(".games-news li:last-child").addClass("last");
	jQuery(".news-latest li:last-child").addClass("last");
	jQuery(".art-cmt li:last-child").addClass("last");
	jQuery(".cmt-rep li:last-child").addClass("last");
	jQuery(".list-col .col:last-child").addClass("last");
}
function sprFeatured(){
	var myTimeout;
	var mySubmenu;
	jQuery(".featured li").hover(
	function(){
		var b = this;
		myTimeout = setTimeout(function(){
			jQuery(b).addClass("active");
			jQuery(b).find(".wrap").animate({top :"0px"});
		}, 800);
	},
	function(){
		var b = this;
		clearTimeout(myTimeout);
		jQuery(b).find(".wrap").animate({top: "175px"}, function(){
			jQuery(b).closest("li").removeClass("active");
		});
	});
	jQuery(".navi-list .main").hover(
	function(){
		var b = this;
		mySubmenu = setTimeout(function(){
			jQuery(b).find(".sub").fadeIn('fast');
			jQuery(b).find(".arrow").fadeIn('fast');
		}, 500);
	},
	function(){
		var b = this;
		clearTimeout(mySubmenu);
		jQuery(b).find(".arrow").fadeOut('fast');
		jQuery(b).find(".sub").fadeOut('fast');
	});
	jQuery(".art-more a").hover(
	function(){
		var b = this;
		jQuery(b).find("div").fadeIn('fast');
	},
	function(){
		var b = this;
		jQuery(b).find("div").fadeOut('fast');
	});
}
function topBar(){
	jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 148) {
				jQuery('#navi-wrap').addClass("fixpos");
			} else {
				jQuery('#navi-wrap').removeClass("fixpos");
			}
	});
}
function sprTop(){
	jQuery(".games-a").click(function(){
		if (jQuery(this).closest(".games-topli").hasClass("active"))
		{
			return false;
		} else {
			jQuery(".active .overlay").slideUp('300', function(){
				jQuery(".games-topli").removeClass("active");
			});
			jQuery(this).next(".overlay").slideToggle('300', function(){
				jQuery(this).closest(".games-topli").addClass("active")
			})
		}
	});
}
function toTop(){
// hide #back-top first
	jQuery("#back-top").hide();
	
	// fade in #back-top
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('#back-top').fadeIn();
			} else {
				jQuery('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		jQuery('#back-top a.default').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		jQuery('#back-top a.totop').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
}



/*!
	Slimbox v2.04 - The ultimate lightweight Lightbox clone for jQuery
	(c) 2007-2010 Christophe Beyls <http://www.digitalia.be>
	MIT-style license.
*/

(function($) {

	// Global variables, accessible to Slimbox only
	var win = $(window), options, images, activeImage = -1, activeURL, prevImage, nextImage, compatibleOverlay, middle, centerWidth, centerHeight,
		ie6 = !window.XMLHttpRequest, hiddenElements = [], documentElement = document.documentElement,

	// Preload images
	preload = {}, preloadPrev = new Image(), preloadNext = new Image(),

	// DOM elements
	overlay, center, image, sizer, prevLink, nextLink, bottomContainer, bottom, caption, number;

	/*
		Initialization
	*/

	$(function() {
		// Append the Slimbox HTML code at the bottom of the document
		$("body").append(
			$([
				overlay = $('<div id="lbOverlay" />')[0],
				center = $('<div id="lbCenter" />')[0],
				bottomContainer = $('<div id="lbBottomContainer" />')[0]
			]).css("display", "none")
		);

		image = $('<div id="lbImage" />').appendTo(center).append(
			sizer = $('<div style="position: relative;" />').append([
				prevLink = $('<a id="lbPrevLink" href="#" />').click(previous)[0],
				nextLink = $('<a id="lbNextLink" href="#" />').click(next)[0]
			])[0]
		)[0];

		bottom = $('<div id="lbBottom" />').appendTo(bottomContainer).append([
			$('<a id="lbCloseLink" href="#" />').add(overlay).click(close)[0],
			caption = $('<div id="lbCaption" />')[0],
			number = $('<div id="lbNumber" />')[0],
			$('<div style="clear: both;" />')[0]
		])[0];
	});


	/*
		API
	*/

	// Open Slimbox with the specified parameters
	$.slimbox = function(_images, startImage, _options) {
		options = $.extend({
			loop: false,				// Allows to navigate between first and last images
			overlayOpacity: 0.8,			// 1 is opaque, 0 is completely transparent (change the color in the CSS file)
			overlayFadeDuration: 400,		// Duration of the overlay fade-in and fade-out animations (in milliseconds)
			resizeDuration: 400,			// Duration of each of the box resize animations (in milliseconds)
			resizeEasing: "swing",			// "swing" is jQuery's default easing
			initialWidth: 250,			// Initial width of the box (in pixels)
			initialHeight: 250,			// Initial height of the box (in pixels)
			imageFadeDuration: 400,			// Duration of the image fade-in animation (in milliseconds)
			captionAnimationDuration: 400,		// Duration of the caption animation (in milliseconds)
			counterText: "Image {x} of {y}",	// Translate or change as you wish, or set it to false to disable counter text for image groups
			closeKeys: [27, 88, 67],		// Array of keycodes to close Slimbox, default: Esc (27), 'x' (88), 'c' (67)
			previousKeys: [37, 80],			// Array of keycodes to navigate to the previous image, default: Left arrow (37), 'p' (80)
			nextKeys: [39, 78]			// Array of keycodes to navigate to the next image, default: Right arrow (39), 'n' (78)
		}, _options);

		// The function is called for a single image, with URL and Title as first two arguments
		if (typeof _images == "string") {
			_images = [[_images, startImage]];
			startImage = 0;
		}

		middle = win.scrollTop() + (win.height() / 2);
		centerWidth = options.initialWidth;
		centerHeight = options.initialHeight;
		$(center).css({top: Math.max(0, middle - (centerHeight / 2)), width: centerWidth, height: centerHeight, marginLeft: -centerWidth/2}).show();
		compatibleOverlay = ie6 || (overlay.currentStyle && (overlay.currentStyle.position != "fixed"));
		if (compatibleOverlay) overlay.style.position = "absolute";
		$(overlay).css("opacity", options.overlayOpacity).fadeIn(options.overlayFadeDuration);
		position();
		setup(1);

		images = _images;
		options.loop = options.loop && (images.length > 1);
		return changeImage(startImage);
	};

	/*
		options:	Optional options object, see jQuery.slimbox()
		linkMapper:	Optional function taking a link DOM element and an index as arguments and returning an array containing 2 elements:
				the image URL and the image caption (may contain HTML)
		linksFilter:	Optional function taking a link DOM element and an index as arguments and returning true if the element is part of
				the image collection that will be shown on click, false if not. "this" refers to the element that was clicked.
				This function must always return true when the DOM element argument is "this".
	*/
	$.fn.slimbox = function(_options, linkMapper, linksFilter) {
		linkMapper = linkMapper || function(el) {
			return [el.href, el.title];
		};

		linksFilter = linksFilter || function() {
			return true;
		};

		var links = this;

		return links.unbind("click").click(function() {
			// Build the list of images that will be displayed
			var link = this, startIndex = 0, filteredLinks, i = 0, length;
			filteredLinks = $.grep(links, function(el, i) {
				return linksFilter.call(link, el, i);
			});

			// We cannot use jQuery.map() because it flattens the returned array
			for (length = filteredLinks.length; i < length; ++i) {
				if (filteredLinks[i] == link) startIndex = i;
				filteredLinks[i] = linkMapper(filteredLinks[i], i);
			}

			return $.slimbox(filteredLinks, startIndex, _options);
		});
	};


	/*
		Internal functions
	*/

	function position() {
		var l = win.scrollLeft(), w = win.width();
		$([center, bottomContainer]).css("left", l + (w / 2));
		if (compatibleOverlay) $(overlay).css({left: l, top: win.scrollTop(), width: w, height: win.height()});
	}

	function setup(open) {
		if (open) {
			$("object").add(ie6 ? "select" : "embed").each(function(index, el) {
				hiddenElements[index] = [el, el.style.visibility];
				el.style.visibility = "hidden";
			});
		} else {
			$.each(hiddenElements, function(index, el) {
				el[0].style.visibility = el[1];
			});
			hiddenElements = [];
		}
		var fn = open ? "bind" : "unbind";
		win[fn]("scroll resize", position);
		$(document)[fn]("keydown", keyDown);
	}

	function keyDown(event) {
		var code = event.keyCode, fn = $.inArray;
		// Prevent default keyboard action (like navigating inside the page)
		return (fn(code, options.closeKeys) >= 0) ? close()
			: (fn(code, options.nextKeys) >= 0) ? next()
			: (fn(code, options.previousKeys) >= 0) ? previous()
			: false;
	}

	function previous() {
		return changeImage(prevImage);
	}

	function next() {
		return changeImage(nextImage);
	}

	function changeImage(imageIndex) {
		if (imageIndex >= 0) {
			activeImage = imageIndex;
			activeURL = images[activeImage][0];
			prevImage = (activeImage || (options.loop ? images.length : 0)) - 1;
			nextImage = ((activeImage + 1) % images.length) || (options.loop ? 0 : -1);

			stop();
			center.className = "lbLoading";

			preload = new Image();
			preload.onload = animateBox;
			preload.src = activeURL;
		}

		return false;
	}

	function animateBox() {
		center.className = "";
		$(image).css({backgroundImage: "url(" + activeURL + ")", visibility: "hidden", display: ""});
		$(sizer).width(preload.width);
		$([sizer, prevLink, nextLink]).height(preload.height);

		$(caption).html(images[activeImage][1] || "");
		$(number).html((((images.length > 1) && options.counterText) || "").replace(/{x}/, activeImage + 1).replace(/{y}/, images.length));

		if (prevImage >= 0) preloadPrev.src = images[prevImage][0];
		if (nextImage >= 0) preloadNext.src = images[nextImage][0];

		centerWidth = image.offsetWidth;
		centerHeight = image.offsetHeight;
		var top = Math.max(0, middle - (centerHeight / 2));
		if (center.offsetHeight != centerHeight) {
			$(center).animate({height: centerHeight, top: top}, options.resizeDuration, options.resizeEasing);
		}
		if (center.offsetWidth != centerWidth) {
			$(center).animate({width: centerWidth, marginLeft: -centerWidth/2}, options.resizeDuration, options.resizeEasing);
		}
		$(center).queue(function() {
			$(bottomContainer).css({width: centerWidth, top: top + centerHeight, marginLeft: -centerWidth/2, visibility: "hidden", display: ""});
			$(image).css({display: "none", visibility: "", opacity: ""}).fadeIn(options.imageFadeDuration, animateCaption);
		});
	}

	function animateCaption() {
		if (prevImage >= 0) $(prevLink).show();
		if (nextImage >= 0) $(nextLink).show();
		$(bottom).css("marginTop", -bottom.offsetHeight).animate({marginTop: 0}, options.captionAnimationDuration);
		bottomContainer.style.visibility = "";
	}

	function stop() {
		preload.onload = null;
		preload.src = preloadPrev.src = preloadNext.src = activeURL;
		$([center, image, bottom]).stop(true);
		$([prevLink, nextLink, image, bottomContainer]).hide();
	}

	function close() {
		if (activeImage >= 0) {
			stop();
			activeImage = prevImage = nextImage = -1;
			$(center).hide();
			$(overlay).stop().fadeOut(options.overlayFadeDuration, setup);
		}

		return false;
	}

})(jQuery);

/*
 * jQuery Nivo Slider v2.7.1
 * http://nivo.dev7studios.com
 *
 * Copyright 2011, Gilbert Pellegrom
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * March 2010
 */

(function($) {

    var NivoSlider = function(element, options){
		//Defaults are below
		var settings = $.extend({}, $.fn.nivoSlider.defaults, options);

        //Useful variables. Play carefully.
        var vars = {
            currentSlide: 0,
            currentImage: '',
            totalSlides: 0,
            running: false,
            paused: false,
            stop: false
        };
    
        //Get this slider
        var slider = $(element);
        slider.data('nivo:vars', vars);
        slider.css('position','relative');
        slider.addClass('nivoSlider');
        
        //Find our slider children
        var kids = slider.children();
        kids.each(function() {
            var child = $(this);
            var link = '';
            if(!child.is('img')){
                if(child.is('a')){
                    child.addClass('nivo-imageLink');
                    link = child;
                }
                child = child.find('img:first');
            }
            //Get img width & height
            var childWidth = child.width();
            if(childWidth == 0) childWidth = child.attr('width');
            var childHeight = child.height();
            if(childHeight == 0) childHeight = child.attr('height');
            //Resize the slider
            if(childWidth > slider.width()){
                slider.width(childWidth);
            }
            if(childHeight > slider.height()){
                slider.height(childHeight);
            }
            if(link != ''){
                link.css('display','none');
            }
            child.css('display','none');
            vars.totalSlides++;
        });
        
        //If randomStart
        if(settings.randomStart){
        	settings.startSlide = Math.floor(Math.random() * vars.totalSlides);
        }
        
        //Set startSlide
        if(settings.startSlide > 0){
            if(settings.startSlide >= vars.totalSlides) settings.startSlide = vars.totalSlides - 1;
            vars.currentSlide = settings.startSlide;
        }
        
        //Get initial image
        if($(kids[vars.currentSlide]).is('img')){
            vars.currentImage = $(kids[vars.currentSlide]);
        } else {
            vars.currentImage = $(kids[vars.currentSlide]).find('img:first');
        }
        
        //Show initial link
        if($(kids[vars.currentSlide]).is('a')){
            $(kids[vars.currentSlide]).css('display','block');
        }
        
        //Set first background
        slider.css('background','url("'+ vars.currentImage.attr('src') +'") no-repeat');

        //Create caption
        slider.append(
            $('<div class="nivo-caption"><p></p></div>').css({ display:'none', opacity:settings.captionOpacity })
        );		
        
        // Cross browser default caption opacity
        $('.nivo-caption', slider).css('opacity', 0);
		
		// Process caption function
		var processCaption = function(settings){
			var nivoCaption = $('.nivo-caption', slider);
			if(vars.currentImage.attr('title') != '' && vars.currentImage.attr('title') != undefined){
				var title = vars.currentImage.attr('title');
				if(title.substr(0,1) == '#') title = $(title).html();	

				if(nivoCaption.css('opacity') != 0){
					nivoCaption.find('p').stop().fadeTo(settings.animSpeed, 0, function(){
						$(this).html(title);
						$(this).stop().fadeTo(settings.animSpeed, 1);
					});
				} else {
					nivoCaption.find('p').html(title);
				}					
				nivoCaption.stop().fadeTo(settings.animSpeed, settings.captionOpacity);
			} else {
				nivoCaption.stop().fadeTo(settings.animSpeed, 0);
			}
		}
		
        //Process initial  caption
        processCaption(settings);
        
        //In the words of Super Mario "let's a go!"
        var timer = 0;
        if(!settings.manualAdvance && kids.length > 1){
            timer = setInterval(function(){ nivoRun(slider, kids, settings, false); }, settings.pauseTime);
        }

        //Add Direction nav
        if(settings.directionNav){
            slider.append('<div class="nivo-directionNav"><a class="nivo-prevNav">'+ settings.prevText +'</a><a class="nivo-nextNav">'+ settings.nextText +'</a></div>');
            
            //Hide Direction nav
            if(settings.directionNavHide){
                $('.nivo-directionNav', slider).hide();
                slider.hover(function(){
                    $('.nivo-directionNav', slider).show();
                }, function(){
                    $('.nivo-directionNav', slider).hide();
                });
            }
            
            $('a.nivo-prevNav', slider).live('click', function(){
                if(vars.running) return false;
                clearInterval(timer);
                timer = '';
                vars.currentSlide -= 2;
                nivoRun(slider, kids, settings, 'prev');
            });
            
            $('a.nivo-nextNav', slider).live('click', function(){
                if(vars.running) return false;
                clearInterval(timer);
                timer = '';
                nivoRun(slider, kids, settings, 'next');
            });
        }
        
        //Add Control nav
        if(settings.controlNav){
            var nivoControl = $('<div class="nivo-controlNav"></div>');
            slider.append(nivoControl);
            for(var i = 0; i < kids.length; i++){
                if(settings.controlNavThumbs){
                    var child = kids.eq(i);
                    if(!child.is('img')){
                        child = child.find('img:first');
                    }
                    if (settings.controlNavThumbsFromRel) {
                        nivoControl.append('<a class="nivo-control" rel="'+ i +'"><img src="'+ child.attr('rel') + '" alt="" /></a>');
                    } else {
                        nivoControl.append('<a class="nivo-control" rel="'+ i +'"><img src="'+ child.attr('src').replace(settings.controlNavThumbsSearch, settings.controlNavThumbsReplace) +'" alt="" /></a>');
                    }
                } else {
                    nivoControl.append('<a class="nivo-control" rel="'+ i +'">'+ (i + 1) +'</a>');
                }
                
            }
            //Set initial active link
            $('.nivo-controlNav a:eq('+ vars.currentSlide +')', slider).addClass('active');
            
            $('.nivo-controlNav a', slider).live('click', function(){
                if(vars.running) return false;
                if($(this).hasClass('active')) return false;
                clearInterval(timer);
                timer = '';
                slider.css('background','url("'+ vars.currentImage.attr('src') +'") no-repeat');
                vars.currentSlide = $(this).attr('rel') - 1;
                nivoRun(slider, kids, settings, 'control');
            });
        }
        
        //Keyboard Navigation
        if(settings.keyboardNav){
            $(window).keypress(function(event){
                //Left
                if(event.keyCode == '37'){
                    if(vars.running) return false;
                    clearInterval(timer);
                    timer = '';
                    vars.currentSlide-=2;
                    nivoRun(slider, kids, settings, 'prev');
                }
                //Right
                if(event.keyCode == '39'){
                    if(vars.running) return false;
                    clearInterval(timer);
                    timer = '';
                    nivoRun(slider, kids, settings, 'next');
                }
            });
        }
        
        //For pauseOnHover setting
        if(settings.pauseOnHover){
            slider.hover(function(){
                vars.paused = true;
                clearInterval(timer);
                timer = '';
            }, function(){
                vars.paused = false;
                //Restart the timer
                if(timer == '' && !settings.manualAdvance){
                    timer = setInterval(function(){ nivoRun(slider, kids, settings, false); }, settings.pauseTime);
                }
            });
        }
        
        //Event when Animation finishes
        slider.bind('nivo:animFinished', function(){ 
            vars.running = false; 
            //Hide child links
            $(kids).each(function(){
                if($(this).is('a')){
                    $(this).css('display','none');
                }
            });
            //Show current link
            if($(kids[vars.currentSlide]).is('a')){
                $(kids[vars.currentSlide]).css('display','block');
            }
            //Restart the timer
            if(timer == '' && !vars.paused && !settings.manualAdvance){
                timer = setInterval(function(){ nivoRun(slider, kids, settings, false); }, settings.pauseTime);
            }
            //Trigger the afterChange callback
            settings.afterChange.call(this);
        });
        
        // Add slices for slice animations
        var createSlices = function(slider, settings, vars){
            for(var i = 0; i < settings.slices; i++){
				var sliceWidth = Math.round(slider.width()/settings.slices);
				if(i == settings.slices-1){
					slider.append(
						$('<div class="nivo-slice"></div>').css({ 
							left:(sliceWidth*i)+'px', width:(slider.width()-(sliceWidth*i))+'px',
							height:'0px', 
							opacity:'0', 
							background: 'url("'+ vars.currentImage.attr('src') +'") no-repeat -'+ ((sliceWidth + (i * sliceWidth)) - sliceWidth) +'px 0%'
						})
					);
				} else {
					slider.append(
						$('<div class="nivo-slice"></div>').css({ 
							left:(sliceWidth*i)+'px', width:sliceWidth+'px',
							height:'0px', 
							opacity:'0', 
							background: 'url("'+ vars.currentImage.attr('src') +'") no-repeat -'+ ((sliceWidth + (i * sliceWidth)) - sliceWidth) +'px 0%'
						})
					);
				}
			}
        }
		
		// Add boxes for box animations
		var createBoxes = function(slider, settings, vars){
			var boxWidth = Math.round(slider.width()/settings.boxCols);
			var boxHeight = Math.round(slider.height()/settings.boxRows);
			
			for(var rows = 0; rows < settings.boxRows; rows++){
				for(var cols = 0; cols < settings.boxCols; cols++){
					if(cols == settings.boxCols-1){
						slider.append(
							$('<div class="nivo-box"></div>').css({ 
								opacity:0,
								left:(boxWidth*cols)+'px', 
								top:(boxHeight*rows)+'px',
								width:(slider.width()-(boxWidth*cols))+'px',
								height:boxHeight+'px',
								background: 'url("'+ vars.currentImage.attr('src') +'") no-repeat -'+ ((boxWidth + (cols * boxWidth)) - boxWidth) +'px -'+ ((boxHeight + (rows * boxHeight)) - boxHeight) +'px'
							})
						);
					} else {
						slider.append(
							$('<div class="nivo-box"></div>').css({ 
								opacity:0,
								left:(boxWidth*cols)+'px', 
								top:(boxHeight*rows)+'px',
								width:boxWidth+'px',
								height:boxHeight+'px',
								background: 'url("'+ vars.currentImage.attr('src') +'") no-repeat -'+ ((boxWidth + (cols * boxWidth)) - boxWidth) +'px -'+ ((boxHeight + (rows * boxHeight)) - boxHeight) +'px'
							})
						);
					}
				}
			}
		}

        // Private run method
		var nivoRun = function(slider, kids, settings, nudge){
			//Get our vars
			var vars = slider.data('nivo:vars');
            
            //Trigger the lastSlide callback
            if(vars && (vars.currentSlide == vars.totalSlides - 1)){ 
				settings.lastSlide.call(this);
			}
            
            // Stop
			if((!vars || vars.stop) && !nudge) return false;
			
			//Trigger the beforeChange callback
			settings.beforeChange.call(this);
					
			//Set current background before change
			if(!nudge){
				slider.css('background','url("'+ vars.currentImage.attr('src') +'") no-repeat');
			} else {
				if(nudge == 'prev'){
					slider.css('background','url("'+ vars.currentImage.attr('src') +'") no-repeat');
				}
				if(nudge == 'next'){
					slider.css('background','url("'+ vars.currentImage.attr('src') +'") no-repeat');
				}
			}
			vars.currentSlide++;
            //Trigger the slideshowEnd callback
			if(vars.currentSlide == vars.totalSlides){ 
				vars.currentSlide = 0;
				settings.slideshowEnd.call(this);
			}
			if(vars.currentSlide < 0) vars.currentSlide = (vars.totalSlides - 1);
			//Set vars.currentImage
			if($(kids[vars.currentSlide]).is('img')){
				vars.currentImage = $(kids[vars.currentSlide]);
			} else {
				vars.currentImage = $(kids[vars.currentSlide]).find('img:first');
			}
			
			//Set active links
			if(settings.controlNav){
				$('.nivo-controlNav a', slider).removeClass('active');
				$('.nivo-controlNav a:eq('+ vars.currentSlide +')', slider).addClass('active');
			}
			
			//Process caption
			processCaption(settings);
			
			// Remove any slices from last transition
			$('.nivo-slice', slider).remove();
			
			// Remove any boxes from last transition
			$('.nivo-box', slider).remove();
			
			var currentEffect = settings.effect;
			//Generate random effect
			if(settings.effect == 'random'){
				var anims = new Array('sliceDownRight','sliceDownLeft','sliceUpRight','sliceUpLeft','sliceUpDown','sliceUpDownLeft','fold','fade',
                'boxRandom','boxRain','boxRainReverse','boxRainGrow','boxRainGrowReverse');
				currentEffect = anims[Math.floor(Math.random()*(anims.length + 1))];
				if(currentEffect == undefined) currentEffect = 'fade';
			}
            
            //Run random effect from specified set (eg: effect:'fold,fade')
            if(settings.effect.indexOf(',') != -1){
                var anims = settings.effect.split(',');
                currentEffect = anims[Math.floor(Math.random()*(anims.length))];
				if(currentEffect == undefined) currentEffect = 'fade';
            }
            
            //Custom transition as defined by "data-transition" attribute
            if(vars.currentImage.attr('data-transition')){
            	currentEffect = vars.currentImage.attr('data-transition');
            }
		
			//Run effects
			vars.running = true;
			if(currentEffect == 'sliceDown' || currentEffect == 'sliceDownRight' || currentEffect == 'sliceDownLeft'){
				createSlices(slider, settings, vars);
				var timeBuff = 0;
				var i = 0;
				var slices = $('.nivo-slice', slider);
				if(currentEffect == 'sliceDownLeft') slices = $('.nivo-slice', slider)._reverse();
				
				slices.each(function(){
					var slice = $(this);
					slice.css({ 'top': '0px' });
					if(i == settings.slices-1){
						setTimeout(function(){
							slice.animate({ height:'100%', opacity:'1.0' }, settings.animSpeed, '', function(){ slider.trigger('nivo:animFinished'); });
						}, (100 + timeBuff));
					} else {
						setTimeout(function(){
							slice.animate({ height:'100%', opacity:'1.0' }, settings.animSpeed);
						}, (100 + timeBuff));
					}
					timeBuff += 50;
					i++;
				});
			} 
			else if(currentEffect == 'sliceUp' || currentEffect == 'sliceUpRight' || currentEffect == 'sliceUpLeft'){
				createSlices(slider, settings, vars);
				var timeBuff = 0;
				var i = 0;
				var slices = $('.nivo-slice', slider);
				if(currentEffect == 'sliceUpLeft') slices = $('.nivo-slice', slider)._reverse();
				
				slices.each(function(){
					var slice = $(this);
					slice.css({ 'bottom': '0px' });
					if(i == settings.slices-1){
						setTimeout(function(){
							slice.animate({ height:'100%', opacity:'1.0' }, settings.animSpeed, '', function(){ slider.trigger('nivo:animFinished'); });
						}, (100 + timeBuff));
					} else {
						setTimeout(function(){
							slice.animate({ height:'100%', opacity:'1.0' }, settings.animSpeed);
						}, (100 + timeBuff));
					}
					timeBuff += 50;
					i++;
				});
			} 
			else if(currentEffect == 'sliceUpDown' || currentEffect == 'sliceUpDownRight' || currentEffect == 'sliceUpDownLeft'){
				createSlices(slider, settings, vars);
				var timeBuff = 0;
				var i = 0;
				var v = 0;
				var slices = $('.nivo-slice', slider);
				if(currentEffect == 'sliceUpDownLeft') slices = $('.nivo-slice', slider)._reverse();
				
				slices.each(function(){
					var slice = $(this);
					if(i == 0){
						slice.css('top','0px');
						i++;
					} else {
						slice.css('bottom','0px');
						i = 0;
					}
					
					if(v == settings.slices-1){
						setTimeout(function(){
							slice.animate({ height:'100%', opacity:'1.0' }, settings.animSpeed, '', function(){ slider.trigger('nivo:animFinished'); });
						}, (100 + timeBuff));
					} else {
						setTimeout(function(){
							slice.animate({ height:'100%', opacity:'1.0' }, settings.animSpeed);
						}, (100 + timeBuff));
					}
					timeBuff += 50;
					v++;
				});
			} 
			else if(currentEffect == 'fold'){
				createSlices(slider, settings, vars);
				var timeBuff = 0;
				var i = 0;
				
				$('.nivo-slice', slider).each(function(){
					var slice = $(this);
					var origWidth = slice.width();
					slice.css({ top:'0px', height:'100%', width:'0px' });
					if(i == settings.slices-1){
						setTimeout(function(){
							slice.animate({ width:origWidth, opacity:'1.0' }, settings.animSpeed, '', function(){ slider.trigger('nivo:animFinished'); });
						}, (100 + timeBuff));
					} else {
						setTimeout(function(){
							slice.animate({ width:origWidth, opacity:'1.0' }, settings.animSpeed);
						}, (100 + timeBuff));
					}
					timeBuff += 50;
					i++;
				});
			}  
			else if(currentEffect == 'fade'){
				createSlices(slider, settings, vars);
				
				var firstSlice = $('.nivo-slice:first', slider);
                firstSlice.css({
                    'height': '100%',
                    'width': slider.width() + 'px'
                });
    
				firstSlice.animate({ opacity:'1.0' }, (settings.animSpeed*2), '', function(){ slider.trigger('nivo:animFinished'); });
			}          
            else if(currentEffect == 'slideInRight'){
				createSlices(slider, settings, vars);
				
                var firstSlice = $('.nivo-slice:first', slider);
                firstSlice.css({
                    'height': '100%',
                    'width': '0px',
                    'opacity': '1'
                });

                firstSlice.animate({ width: slider.width() + 'px' }, (settings.animSpeed*2), '', function(){ slider.trigger('nivo:animFinished'); });
            }
            else if(currentEffect == 'slideInLeft'){
				createSlices(slider, settings, vars);
				
                var firstSlice = $('.nivo-slice:first', slider);
                firstSlice.css({
                    'height': '100%',
                    'width': '0px',
                    'opacity': '1',
                    'left': '',
                    'right': '0px'
                });

                firstSlice.animate({ width: slider.width() + 'px' }, (settings.animSpeed*2), '', function(){ 
                    // Reset positioning
                    firstSlice.css({
                        'left': '0px',
                        'right': ''
                    });
                    slider.trigger('nivo:animFinished'); 
                });
            }
			else if(currentEffect == 'boxRandom'){
				createBoxes(slider, settings, vars);
				
				var totalBoxes = settings.boxCols * settings.boxRows;
				var i = 0;
				var timeBuff = 0;
				
				var boxes = shuffle($('.nivo-box', slider));
				boxes.each(function(){
					var box = $(this);
					if(i == totalBoxes-1){
						setTimeout(function(){
							box.animate({ opacity:'1' }, settings.animSpeed, '', function(){ slider.trigger('nivo:animFinished'); });
						}, (100 + timeBuff));
					} else {
						setTimeout(function(){
							box.animate({ opacity:'1' }, settings.animSpeed);
						}, (100 + timeBuff));
					}
					timeBuff += 20;
					i++;
				});
			}
			else if(currentEffect == 'boxRain' || currentEffect == 'boxRainReverse' || currentEffect == 'boxRainGrow' || currentEffect == 'boxRainGrowReverse'){
				createBoxes(slider, settings, vars);
				
				var totalBoxes = settings.boxCols * settings.boxRows;
				var i = 0;
				var timeBuff = 0;
				
				// Split boxes into 2D array
				var rowIndex = 0;
				var colIndex = 0;
				var box2Darr = new Array();
				box2Darr[rowIndex] = new Array();
				var boxes = $('.nivo-box', slider);
				if(currentEffect == 'boxRainReverse' || currentEffect == 'boxRainGrowReverse'){
					boxes = $('.nivo-box', slider)._reverse();
				}
				boxes.each(function(){
					box2Darr[rowIndex][colIndex] = $(this);
					colIndex++;
					if(colIndex == settings.boxCols){
						rowIndex++;
						colIndex = 0;
						box2Darr[rowIndex] = new Array();
					}
				});
				
				// Run animation
				for(var cols = 0; cols < (settings.boxCols * 2); cols++){
					var prevCol = cols;
					for(var rows = 0; rows < settings.boxRows; rows++){
						if(prevCol >= 0 && prevCol < settings.boxCols){
							/* Due to some weird JS bug with loop vars 
							being used in setTimeout, this is wrapped
							with an anonymous function call */
							(function(row, col, time, i, totalBoxes) {
								var box = $(box2Darr[row][col]);
                                var w = box.width();
                                var h = box.height();
                                if(currentEffect == 'boxRainGrow' || currentEffect == 'boxRainGrowReverse'){
                                    box.width(0).height(0);
                                }
								if(i == totalBoxes-1){
									setTimeout(function(){
										box.animate({ opacity:'1', width:w, height:h }, settings.animSpeed/1.3, '', function(){ slider.trigger('nivo:animFinished'); });
									}, (100 + time));
								} else {
									setTimeout(function(){
										box.animate({ opacity:'1', width:w, height:h }, settings.animSpeed/1.3);
									}, (100 + time));
								}
							})(rows, prevCol, timeBuff, i, totalBoxes);
							i++;
						}
						prevCol--;
					}
					timeBuff += 100;
				}
			}
		}
		
		// Shuffle an array
		var shuffle = function(arr){
			for(var j, x, i = arr.length; i; j = parseInt(Math.random() * i), x = arr[--i], arr[i] = arr[j], arr[j] = x);
			return arr;
		}
        
        // For debugging
        var trace = function(msg){
            if (this.console && typeof console.log != "undefined")
                console.log(msg);
        }
        
        // Start / Stop
        this.stop = function(){
            if(!$(element).data('nivo:vars').stop){
                $(element).data('nivo:vars').stop = true;
                trace('Stop Slider');
            }
        }
        
        this.start = function(){
            if($(element).data('nivo:vars').stop){
                $(element).data('nivo:vars').stop = false;
                trace('Start Slider');
            }
        }
        
        //Trigger the afterLoad callback
        settings.afterLoad.call(this);
		
		return this;
    };
        
    $.fn.nivoSlider = function(options) {
    
        return this.each(function(key, value){
            var element = $(this);
            // Return early if this element already has a plugin instance
            if (element.data('nivoslider')) return element.data('nivoslider');
            // Pass options to plugin constructor
            var nivoslider = new NivoSlider(this, options);
            // Store plugin object in this element's data
            element.data('nivoslider', nivoslider);
        });

	};
	
	//Default settings
	$.fn.nivoSlider.defaults = {
		effect: 'random',
		slices: 15,
		boxCols: 8,
		boxRows: 4,
		animSpeed: 500,
		pauseTime: 3000,
		startSlide: 0,
		directionNav: true,
		directionNavHide: true,
		controlNav: true,
		controlNavThumbs: false,
        controlNavThumbsFromRel: false,
		controlNavThumbsSearch: '.jpg',
		controlNavThumbsReplace: '_thumb.jpg',
		keyboardNav: true,
		pauseOnHover: true,
		manualAdvance: false,
		captionOpacity: 0.8,
		prevText: 'Prev',
		nextText: 'Next',
		randomStart: false,
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){},
        lastSlide: function(){},
        afterLoad: function(){}
	};
	
	$.fn._reverse = [].reverse;
	
})(jQuery);