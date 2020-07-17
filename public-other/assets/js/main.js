// demo code
var $ = jQuery['noConflict']();
(function($) {
    'use strict';
    var _0xad78x2 = {
        ready: function() {
            _0xad78x2['fn_deviceDetect']();
            _0xad78x2['fn_form']();
            _0xad78x2['fn_utility']();
            _0xad78x2['fn_gallery']();
            _0xad78x2['fn_sticky']();
            _0xad78x2['fn_scrollTo']();
            _0xad78x2['fn_scrollspy']();
            _0xad78x2['fn_slideshow']();
            _0xad78x2['fn_youtube']();
            _0xad78x2['fn_popup']();
            _0xad78x2['fn_cloud']();
            _0xad78x2['fn_carousel']();
            _0xad78x2['fn_animate']();
            _0xad78x2['fn_navbar']()
        },
        load: function() {
            _0xad78x2['fn_pageLoader']();
            _0xad78x2['fn_hero']();
            _0xad78x2['fn_audio']();
            _0xad78x2['fn_demoPanel']()
        },
        scroll: function() {},
        resize: function() {},
        orientationchange: function() {
            fn_hero()
        },
        fn_demoPanel: function() {
            $('.demo-panel-toggle')['on']('click', function(_0xad78x3) {
                _0xad78x3['preventDefault']();
                _0xad78x30['toggleClass']('demo-panel-in')
            });
            var _0xad78x4 = $('[data-demo-panel-control="page-intro-size"]');
            var _0xad78x5 = _0xad78x4['find']('a');
            var _0xad78x6 = '';
            if ($('#home')['hasClass']('home-hero')) {
                _0xad78x6 = 'home-hero'
            };
            _0xad78x5['filter']('[data-value="' + _0xad78x6 + '"]')['addClass']('selected');
            _0xad78x5['on']('click', function(_0xad78x3) {
                _0xad78x3['preventDefault']();
                var _0xad78x7 = $(this);
                _0xad78x6 = _0xad78x7['attr']('data-value');
                _0xad78x5['filter']('.selected')['removeClass']('selected');
                _0xad78x7['addClass']('selected');
                $('#home')['removeClass']('home-hero');
                $('#home')['css']('height', '');
                $('#home')['addClass'](_0xad78x6);
                if (_0xad78x6 == 'home-hero') {
                    $('#home')['css']('height', $(window)['height']() + 'px')
                }
            });
            var _0xad78x8 = $('[data-demo-panel-control="navbar-style"]');
            var _0xad78x9 = _0xad78x8['find']('a');
            var _0xad78xa = '';
            if ($('#siteNavbar')['hasClass']('navbar-default')) {
                _0xad78xa = 'navbar-default'
            } else {
                if ($('#siteNavbar')['hasClass']('navbar-inverse')) {
                    _0xad78xa = 'navbar-inverse'
                }
            };
            _0xad78x9['each'](function() {
                var _0xad78x7 = $(this);
                var _0xad78xb = _0xad78x7['data']('color-1');
                _0xad78x7['css']('background-color', _0xad78xb)
            });
            _0xad78x9['filter']('[data-value="' + _0xad78xa + '"]')['addClass']('selected');
            _0xad78x9['on']('click', function(_0xad78x3) {
                _0xad78x3['preventDefault']();
                var _0xad78x7 = $(this);
                _0xad78xa = _0xad78x7['attr']('data-value');
                _0xad78x9['filter']('.selected')['removeClass']('selected');
                _0xad78x7['addClass']('selected');
                $('#siteNavbar')['removeClass']('navbar-default');
                $('#siteNavbar')['removeClass']('navbar-inverse');
                $('#siteNavbar')['addClass'](_0xad78xa)
            });
            var _0xad78xc = $('[data-demo-panel-control="theme"]');
            var _0xad78xd = _0xad78xc['find']('a');
            var _0xad78xe = $('#theme')['attr']('href')['replace']('assets/css/', '');
            _0xad78xd['each'](function() {
                var _0xad78x7 = $(this);
                var _0xad78xb = _0xad78x7['data']('color-1');
                var _0xad78xf = _0xad78x7['data']('color-2');
                _0xad78x7['css']('background', 'linear-gradient(to right, ' + _0xad78xb + ' 0%, ' + _0xad78xb + ' 50%, ' + _0xad78xf + ' 51%, ' + _0xad78xf + ' 100%)')
            });
            _0xad78xd['filter']('[data-value="' + _0xad78xe + '"]')['addClass']('selected');
            _0xad78xd['each'](function() {
                var _0xad78x7 = $(this);
                _0xad78x7['on']('click', function(_0xad78x3) {
                    _0xad78x3['preventDefault']();
                    _0xad78xe = _0xad78x7['attr']('data-value');
                    _0xad78xd['filter']('.selected')['removeClass']('selected');
                    _0xad78x7['addClass']('selected');
                    $('#theme')['attr']('href', 'assets/css/' + _0xad78xe)
                })
            });
            var _0xad78x10 = $('[data-demo-panel-control="remove-el"]');
            var _0xad78x11 = _0xad78x10['find']('a');
            _0xad78x11['each'](function() {
                var _0xad78x7 = $(this);
                var _0xad78x12 = _0xad78x7['data']('value');
                if (!$(_0xad78x12)['length']) {
                    _0xad78x7['remove']()
                };
                if ($(_0xad78x12)['is'](':visible')) {
                    _0xad78x7['addClass']('selected')
                };
                _0xad78x7['on']('click', function(_0xad78x3) {
                    _0xad78x3['preventDefault']();
                    $(_0xad78x7['data']('value'))['toggleClass']('hide');
                    _0xad78x7['toggleClass']('selected')
                })
            })
        },
        fn_pageLoader: function() {
            var _0xad78x13 = $('.page-loader');
            if (_0xad78x13['length']) {
                _0xad78x13['velocity']('fadeOut', {
                    duration: _0xad78x35,
                    easing: _0xad78x31,
                    complete: function() {
                        $(this)['remove']();
                        _0xad78x30['addClass']('is-loaded')
                    }
                })
            }
        },
        fn_animate: function() {
            window['sr'] = ScrollReveal({
                duration: 800,
                scale: 1,
                mobile: false,
                reset: true,
                viewFactor: 0.7
            });
            if (sr['isSupported']()) {
                document['documentElement']['classList']['add']('sr');
                $(window)['on']('load', function() {
                    setTimeout(function() {
                        if ($('[data-sr=top]')['length']) {
                            sr['reveal']('[data-sr=top]', {
                                origin: 'top'
                            })
                        };
                        if ($('[data-sr=right]')['length']) {
                            sr['reveal']('[data-sr=right]', {
                                origin: 'right'
                            })
                        };
                        if ($('[data-sr=bottom]')['length']) {
                            sr['reveal']('[data-sr=bottom]', {
                                origin: 'bottom'
                            })
                        };
                        if ($('[data-sr=left]')['length']) {
                            sr['reveal']('[data-sr=left]', {
                                origin: 'left'
                            })
                        }
                    }, _0xad78x35)
                })
            };
            if (!_0xad78x34 && !_0xad78x32) {
                $(window)['on']('load', function() {
                    setTimeout(function() {
                        var _0xad78x14 = new WOW();
                        _0xad78x14['init']();
                        $('.text-animate')['textillate']({ in: {
                                effect: 'fadeInUp',
                                delayScale: 0.3,
                                shuffle: true
                            }
                        })
                    }, _0xad78x35)
                })
            }
        },
        fn_navbar: function() {
            $(window)['on']('load resize orientationchange', function() {
                $('.navbar-collapse')['css']({
                    maxHeight: $(window)['height']() - $('.navbar-header')['height']() + 'px'
                })
            })
        },
        fn_scrollspy: function() {
            var _0xad78x15 = '#siteNavbar';
            var _0xad78x16 = $(_0xad78x15)['find']('.navbar-header')['outerHeight']() + 1;
            _0xad78x30['scrollspy']({
                target: _0xad78x15,
                offset: parseInt(_0xad78x16)
            })
        },
        fn_scrollTo: function() {
            $('[data-smooth-scroll="true"]')['on']('click', function(_0xad78x3) {
                _0xad78x3['preventDefault']();
                var _0xad78x12 = $(this)['attr']('href');
                if ($(_0xad78x12)['is'](':visible')) {
                    var _0xad78x16 = $(_0xad78x12)['offset']()['top'] - $('#siteNavbar')['find']('.navbar-header')['outerHeight']();
                    $('html, body')['stop']()['animate']({
                        scrollTop: _0xad78x16
                    }, 1250)
                }
            })
        },
        fn_sticky: function() {
            $(window)['on']('load scroll resize', function() {
                var _0xad78x16 = $('#siteNavbar')['find']('.navbar-header')['outerHeight']();
                if ($(window)['scrollTop']() >= 88) {
                    _0xad78x2f['addClass']('is-scrolled')
                } else {
                    _0xad78x2f['removeClass']('is-scrolled')
                }
            })
        },
        fn_hero: function() {
            var _0xad78x17 = $('.js-hero, .home-hero');
            _0xad78x17['css']('height', $(window)['height']() + 'px')
        },
        fn_carousel: function() {
            $('#screenshotCarousel')['imagesLoaded']()['always'](function(_0xad78x18) {
                var _0xad78x19 = $('#screenshotCarousel');
                _0xad78x19['slick']({
                    centerMode: true,
                    centerPadding: 0,
                    slidesToShow: 3,
                    swipeToSlide: true,
                    responsive: [{
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3
                        }
                    }, {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3
                        }
                    }, {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3
                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }]
                })
            })
        },
        fn_gallery: function() {
            $('.popup-gallery')['each'](function() {
                var _0xad78x1a = $(this);
                _0xad78x1a['magnificPopup']({
                    delegate: '.popup-gallery-link',
                    type: 'image',
                    gallery: {
                        enabled: true,
                        tCounter: ''
                    },
                    midClick: true,
                    fixedContentPos: true,
                    fixedBgPos: true
                })
            })
        },
        fn_popup: function() {
            var _0xad78x1b = $('.popup-youtube, .popup-vimeo, .popup-gmaps');
            _0xad78x1b['each'](function() {
                var _0xad78x7 = $(this);
                _0xad78x1b['magnificPopup']({
                    items: {
                        src: _0xad78x1b['data']('mfp-src')
                    },
                    type: 'iframe',
                    midClick: true,
                    fixedContentPos: true,
                    fixedBgPos: true,
                    callbacks: {
                        beforeOpen: function() {
                            if (!_0xad78x7['hasClass']('popup-gmaps')) {
                                $('.js-bg-youtube-is-playing')['each'](function() {
                                    $(this).YTPPause()['toggleClass']('js-bg-youtube-is-playing --js-bg-youtube-is-paused')
                                });
                                if (_0xad78x30['hasClass']('audio-playing')) {
                                    $('#audioPlayer')[0]['pause']();
                                    _0xad78x30['removeClass']('audio-playing')['addClass']('audio-paused --audio-paused')
                                }
                            }
                        },
                        afterClose: function() {
                            if (!_0xad78x7['hasClass']('popup-gmaps')) {
                                $('.--js-bg-youtube-is-paused')['each'](function() {
                                    $(this).YTPPlay()['toggleClass']('--js-bg-youtube-is-paused js-bg-youtube-is-playing')
                                });
                                if (_0xad78x30['hasClass']('audio-paused --audio-paused')) {
                                    $('#audioPlayer')[0]['play']();
                                    _0xad78x30['removeClass']('audio-paused --audio-paused')['addClass']('audio-playing')
                                }
                            }
                        }
                    }
                })
            });
            var _0xad78x1c = $('.popup-inline');
            _0xad78x1c['each'](function() {
                var _0xad78x1c = $(this);
                _0xad78x1c['magnificPopup']({
                    type: 'inline',
                    midClick: true,
                    closeBtnInside: true,
                    fixedContentPos: true,
                    fixedBgPos: true
                })
            })
        },
        fn_audio: function() {
            if ($('#audioPlayer')['length']) {
                var _0xad78x1d = $('#audioPlayer')[0];
                var _0xad78x1e = $('.audio-toggle')['find']('a');
                if (_0xad78x32) {
                    _0xad78x30['addClass']('audio-paused');
                    _0xad78x1d['pause']()
                } else {
                    _0xad78x30['addClass']('audio-playing');
                    _0xad78x1d['play']()
                };
                _0xad78x1e['on']('click', function(_0xad78x3) {
                    _0xad78x3['preventDefault']();
                    if (_0xad78x1d['paused']) {
                        _0xad78x30['removeClass']('audio-paused')['addClass']('audio-playing');
                        _0xad78x1d['play']()
                    } else {
                        _0xad78x30['removeClass']('audio-playing')['addClass']('audio-paused');
                        _0xad78x1d['pause']()
                    }
                })
            }
        },
        fn_utility: function() {
            $('[data-opacity]')['each'](function() {
                var _0xad78x7 = $(this);
                _0xad78x7['css']('opacity', _0xad78x7['data']('opacity'))
            });
            $('[data-bg-color]')['each'](function() {
                var _0xad78x7 = $(this);
                _0xad78x7['css']('background-color', _0xad78x7['data']('bg-color'))
            });
            $('[data-bg-img]')['each'](function() {
                var _0xad78x7 = $(this);
                _0xad78x7['css']('background-image', 'url(' + _0xad78x7['data']('bg-img') + ')')
            });
            $('[data-bg-img-mobile]')['each'](function() {
                if (_0xad78x32) {
                    var _0xad78x7 = $(this);
                    _0xad78x7['css']('background-image', 'url(' + _0xad78x7['data']('bg-img-mobile') + ')')
                }
            });
            $('[data-bg-img-desktop]')['each'](function() {
                if (_0xad78x33) {
                    var _0xad78x7 = $(this);
                    _0xad78x7['css']('background-image', 'url(' + _0xad78x7['data']('bg-img-desktop') + ')')
                }
            })
        },
        fn_deviceDetect: function() {
            if (_0xad78x2f['hasClass']('desktop')) {
                _0xad78x2f['addClass']('is-desktop');
                _0xad78x32 = false;
                _0xad78x33 = true
            } else {
                _0xad78x2f['addClass']('is-mobile');
                _0xad78x32 = true;
                _0xad78x33 = false
            };
            if (_0xad78x2f['hasClass']('ie9')) {
                _0xad78x34 = true
            }
        },
        fn_slideshow: function() {
            if ($('#homeBgSlideshow')['is'](':visible')) {
                $('#homeBgSlideshow')['vegas']({
                    slides: [{
                        src: 'assets/img/home/home-bg-slide-1.jpg'
                    }, {
                        src: 'assets/img/home/home-bg-slide-2.jpg'
                    }, {
                        src: 'assets/img/home/home-bg-slide-3.jpg'
                    }],
                    delay: 7000
                })
            }
        },
        fn_cloud: function() {
            if ($('#homeBgCloud')['is'](':visible')) {
                $('#homeBgCloud')['find']('.cloud')['each'](function() {
                    var _0xad78x7 = $(this);
                    (function _0xad78x1f() {
                        _0xad78x7['velocity']({
                            translateZ: '0',
                            translateX: ['-100%', '100%']
                        }, {
                            duration: _0xad78x7['data']('duration'),
                            easing: 'linear',
                            queue: false
                        });
                        setTimeout(_0xad78x1f, _0xad78x7['data']('duration'))
                    })()
                })
            }
        },
        
        fn_form: function() {
            $('.formjsm')['each'](function() {
                var _0xad78x20 = $(this);
                var _0xad78x21 = _0xad78x20['find']('.form-controlhjk');
                var _0xad78x22 = _0xad78x20['find']('.form-notifyjjk');
                var _0xad78x23 = _0xad78x20['data']('actionjkjk');
                _0xad78x21['each'](function() {
                    var _0xad78x7 = $(this);
                    _0xad78x7['on']('focus', function() {
                        $(this)['parent']('.form-group')['addClass']('focus')
                    })['on']('blur', function() {
                        $(this)['parent']('.form-group')['removeClass']('focus')
                    })
                });
                _0xad78x20['validate']({
                    onclick: false,
                    onfocusout: false,
                    onkeyup: false,
                    ignore: '.ignore',
                    rules: {
                        fname: {
                            required: true
                        },
                        lname: {
                            required: true
                        },
                        name: {
                            required: true
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        message: {
                            required: true
                        },
                        agree: {
                            required: true
                        }
                    },
                    errorPlacement: function(_0xad78x24, _0xad78x25) {},
                    highlight: function(_0xad78x25) {
                        $(_0xad78x25)['closest']('.form-group')['addClass']('error')
                    },
                    unhighlight: function(_0xad78x25) {
                        $(_0xad78x25)['closest']('.form-group')['removeClass']('error')
                    },
                    submitHandler: function(_0xad78x26) {
                        $['ajax']({
                            type: 'POST',
                            dataType: 'json',
                            url: _0xad78x23,
                            cache: false,
                            data: _0xad78x20['serialize'](),
                            success: function(_0xad78x27) {
                                if (_0xad78x27['type'] != 'success') {
                                    _0xad78x22['html']('<span class="form-icon-error"></span> ' + _0xad78x27['msg'])['show']()
                                } else {
                                    _0xad78x20['validate']()['resetForm']();
                                    _0xad78x20[0]['reset']();
                                    _0xad78x20['find']('.error')['removeClass']('error');
                                    _0xad78x20['addClass']('successfully');
                                    _0xad78x20['find']('button')['blur']();
                                    _0xad78x22['html']('<span class="form-icon-success"></span> ' + _0xad78x27['msg'])['show']()
                                }
                            },
                            error: function(_0xad78x28, _0xad78x29, _0xad78x2a) {
                                _0xad78x22['html']('<span class="form-icon-error"></span> An error occurred. Please try again later.')['show']()
                            }
                        })
                    },
                    invalidHandler: function(_0xad78x2b, _0xad78x2c) {
                        var _0xad78x2d = _0xad78x2c['numberOfInvalids']();
                        if (_0xad78x2d) {
                            var _0xad78x2e = _0xad78x2d == 1 ? '<span class="form-icon-error"></span>You missed 1 field. It has been highlighted.' : '<span class="form-icon-error"></span>You missed ' + _0xad78x2d + ' fields. They have been highlighted.';
                            _0xad78x22['html'](_0xad78x2e)['show']()
                        }
                    }
                })
            })
        },
        
        
        fn_youtube: function() {
            if ($('#homeBgYoutube')['is'](':visible')) {
                var _0xad78x1d = $('#homeBgYoutubePlayer');
                if (_0xad78x32) {
                    $('#homeBgYoutubePlaceholder')['remove']()
                } else {
                    $('#homeBgYoutubeFallback')['remove']();
                    _0xad78x1d.YTPlayer();
                    _0xad78x1d['on']('YTPPlay', function() {
                        $(this)['addClass']('js-bg-youtube-is-playing')['removeClass']('js-bg-youtube-is-paused')
                    });
                    _0xad78x1d['on']('YTPPause', function() {
                        $(this)['addClass']('js-bg-youtube-is-paused')['removeClass']('js-bg-youtube-is-playing')
                    })
                }
            }
        }
    };
    var _0xad78x2f = $('html'),
        _0xad78x30 = $('body'),
        _0xad78x31 = [0.770, 0.000, 0.175, 1.000],
        _0xad78x32, _0xad78x33, _0xad78x34, _0xad78x35 = 500;
    if ($('.page-loader')['length'] && typeof _0xad78x2['fn_pageLoader'] !== 'undefined' && $['isFunction'](_0xad78x2['fn_pageLoader'])) {
        _0xad78x35 = 1500
    };
    $(function() {
        _0xad78x2['ready']();
        $(window)['on']('scroll', function() {
            _0xad78x2['scroll']()
        });
        $(window)['on']('resize', function() {
            _0xad78x2['resize']()
        });
        $(window)['on']('load', function() {
            _0xad78x2['load']()
        })
    })
})(jQuery)