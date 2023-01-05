// HTML document is loaded
jQuery(window).on("load", function () {
  "use strict";


  $('#radioBtn a').on('click', function () {
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');

    $('#htype').val(sel);
    $('#' + tog).prop('value', sel);

    $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');

    

    setTimeout(
      function () {
        var cnameeta = getCurentFileName();
        if (cnameeta == 'results.php') {
          $('#headersearch').submit();
        }
        //console.log(getCurentFileName());
      }, 500);
  })

  var selradio = $('#htype').val();

  if (selradio == "Groceries") {
    console.log("Groceries");
    var select2 = $('#catSelect');
   
    $.ajax({
      url: 'includes/selcat_menu_gen.php?id=1',
      method: 'GET',
      success: function (data) {
        select2.append(data);
      }
    });

  } else {
    console.log("Recipes");
    var select2 = $('#catSelect');
    
    $.ajax({
      url: 'includes/selcat_menu_gen.php?id=2',
      method: 'GET',
      success: function (data) {
        select2.append(data);
      }
    });
  }

  function getCurentFileName() {
    var pagePathName = window.location.pathname;
    return pagePathName.substring(pagePathName.lastIndexOf("/") + 1);
  }

  function doThat() {
    $('#headersearch').submit();
  }
  // function changeThis(id) {
  //   console.log(id);
  // }
  // var preloader
  var loader = $('.preloader, .preloader-dark');
  var bgpreloader = $('.bg-preloader, .bg-preloader-dark');

  // var navigation
  var menublock = $('#menu-block');
  var menumobile = $('#main-menu');
  var navdefault = $('.navbar-default');
  var sTick = $(".navbar-fixed-top");
  var navicon = $('#nav-icon');
  var dropdwown = $(".dropdown-container");
  var blockmain = $(".block-main");
  var menuline = $(".menu-line, .menu-line1, .menu-line2");

  //contactform var
  var contactname = $('#name-contact');
  var contactemail = $('#email-contact, input#email-contact');
  var contactmessage = $('#message-contact');
  var contactsent = $('#send-contact');

  //form failed succes var
  var successent = $("#mail_success");
  var failedsent = $("#mail_failed");

  //totop var
  var totop = $('#totop');
  var bodyScroll = $('html,body');

  // start function
  loader.fadeOut('slow', function () {
    "use strict";

    // opening site
    bgpreloader.fadeOut(1000);
    $('body').fadeIn('slow');

    // animated transition & scroll onStep
    onStep();

  });
  // end function

  // menu
  $(window).scroll(function () {
    if ($(document).scrollTop() > 150) {
      sTick.addClass("sticky-nav");
      totop.fadeIn(300);
    }
    else {
      sTick.removeClass("sticky-nav");
      totop.fadeOut(300);
    }

  });
  $(document).height(function () {
    if ($(document).scrollTop() > 150) {
      sTick.addClass("sticky-nav");
      totop.fadeIn(300);
    }
    else {
      sTick.removeClass("sticky-nav");
      totop.fadeOut(300);
    }
  });

  // totop
  totop.on("click", function (e) {
    e.preventDefault();
    bodyScroll.animate({
      scrollTop: 0
    }, 600);
  });

  // mobile icon
  $(".navbar-toggle").on("click", function () {
    menumobile.toggleClass('menu-show');
    navdefault.toggleClass('fullHeight');
  });

  // full block menu
  navicon.on("click", function (e) {
    menublock.toggle('slide', {
      direction: 'right'
    }, 600);
    $(this).toggleClass('open');
    blockmain.fadeToggle(300);
    menuline.toggleClass('black');
    $('.init-menu').each(function (i) {
      var t = $(this);
      setTimeout(function () {
        t.toggleClass('show-menu');
      }, (i + 1) * 150);
    });
  });

  // block-main close block menu
  blockmain.on("click", function (e) {
    $(this).fadeToggle(300);
    menublock.toggle('slide', {
      direction: 'right'
    }, 600);
    navicon.toggleClass('open');
    menuline.toggleClass('black');
    $('.init-menu').each(function (i) {
      var t = $(this);
      setTimeout(function () {
        t.toggleClass('show-menu');
      }, (i + 1) * 150);
    });
  });


  //dropdown
  $('.dropdown').each(function () {
    var $dropdown = $(this);
    $("a.dropdown-link", $dropdown).on('click', function (e) {
      e.preventDefault();
      var $div = $(".dropdown-container", $dropdown);
      $div.slideToggle('fast');
      dropdwown.not($div).slideUp('fast');
      return false;
    });
  });

  $('html').on("click", function (e) {
    dropdwown.slideUp('fast');
  });


  // contact form
  $(function () {
    $('#send').on('click', function (e) {
      e.preventDefault(); var e = $('#name').val(), a = $('#email').val(), s = $('#message').val(), r = !1; if (0 == a.length || "-1" == a.indexOf("@") || "-1" == a.indexOf(".")) { var r = !0; $("#error_email").fadeIn(500) } else $("#error_email").fadeOut(500); if (0 == s.length) { var r = !0; $("#error_message").fadeIn(500) } else $("#error_message").fadeOut(500); return 0 == r && ($("#send").attr({ disabled: "true", value: "Loading..." }), $.ajax({ type: "POST", url: "send.php", data: "name=" + e + "&email=" + a + "&subject=You Got Email&message=" + s, success: function (e) { "success" == e ? ($(".smart-btn").remove(), $("#mail_success").fadeIn(500)) : ($("#mail_failed").html(e).fadeIn(500), $("#send").removeAttr("disabled").attr("value", "send").remove()) } })), !1
    })
  });

//   $(function() {

//     if ( $('.owl-2').length > 0 ) {
//           $('.owl-2').owlCarousel({
//               center: true,
//               loop: true,
//               //items: 1,
//               itemsDesktop : [1199,1],
//               itemsMobile : [479,1],
//               singleItem: true,
//               itemsScaleUp : true,
//               slideSpeed: 500,
//               autoPlay: 2000,
//               stopOnHover: true,
//               responsive: true,
//               responsiveRefreshRate : 200,
//               // responsive:{
//               //     0:{
//               //         items:1
//               //     },
//               //     600:{
//               //         margin: 20,   
//               //         nav: true,
//               //         items: 1
//               //     },
//               //     1200:{
//               //         margin: 20,
//               //         stagePadding: 0,
//               //         nav: true,
//               //       items: 4
//               //     }
//               // }
//           });            
//       }
  
//   })


});
// HTML document is loaded end


// Document ready
jQuery(document).on("ready", function () {


  $("#owl-demo1, #owl-demo2, #owl-demo3").owlCarousel({
    
    center: false,
    loop: true,
    responsive: true,
    items:10,
    itemsDesktop : [1599,10],
    itemsMobile: [414, 1],
    slideSpeed: 500,
    autoPlay: 2000,
    stopOnHover: true,
    // items : 10,
    lazyLoad : true,
    
    // pagination: false,
    responsiveRefreshRate: 100
    // animateOut: 'backslideOut',
    // animateIn: 'backslideIn',
    // navigation : true,
    // margin: 10
    // nav: true,
    // dots: true,

  });

  // $("#owl-demo3").owlCarousel({
  //   slideSpeed: 500,
  //   autoPlay: 2000,
  //   itemsDesktop : [1199,5],
  //   itemsMobile: [414, 1],
  //   stopOnHover: true,
  //   // items : 5,
  //   lazyLoad : true,
  //   loop: true,
  //   margin: 5
  // });

  $(".owl-2").owlCarousel({
    items: 2,
    itemsDesktop: [1366, 2],
    itemsDesktopSmall: [1024, 2],
    itemsTablet: [760, 1],
    itemsMobile: [414, 1],
    pagination: false,
    responsiveRefreshRate: 100,
    // padding: 10,
    afterInit: function (el) {
      el.find(".owl-item").eq(0).addClass("synced");
    }
    //navigation : true
  });

  // $(".carousel").swipe({
  //   swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
  //       if (direction == 'left') $(this).carousel('next');
  //       if (direction == 'right') $(this).carousel('prev');
        
  //   },
  //   allowPageScroll: "vertical",
  //   fingers:'all'

  // });

  $('.carousel[data-type="multi"] .item').each(function(){
    var next = $(this).next();
    if (!next.length) {
      next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
  
    for (var i=0;i<4;i++) {
      next=next.next();
      if (!next.length) {
        next = $(this).siblings(':first');
      }
      
      next.children(':first-child').clone().appendTo($(this));
    }
  });

  // navigation slide up gallery
  var galnav = $('#opengal');
  var galclose = $('.nav-bottom-close, .btn-content');
  var maingall = $('.bottom-option');
  galnav.on('click', function (e) {
    $(this).fadeOut(500);
    maingall.slideDown(600);
  });
  // navigation slide down gallery
  galclose.on('click', function (e) {
    galnav.fadeIn(500);
    maingall.slideUp(500);
  });

  // navigation info gallery home
  var galinfo = $('.info-gal0');
  var galinfoclose = $('.info-gal-close, .block-info-gal');
  var maininfogall = $('.main-info-gal');
  galinfo.on('click', function (e) {
    $(this).fadeOut(500);
    maininfogall.fadeIn(600);
  });
  // navigation slide down gallery
  galinfoclose.on('click', function (e) {
    galinfo.fadeIn(500);
    maininfogall.fadeOut(500);
  });

  $("a.link").on("click", function (e) {
    e.preventDefault();
    linkLocation = this.href;
    $("body").fadeOut(1000, redirectPage);
  });

  function redirectPage() {
    window.location = linkLocation;
  }

  /*************** Plugin Start ***************/

  //slideshow background
  var bgslideshow = $('#bgslideshow');
  $(function () {
    var slideBegin = 5000,
      transSpeed = 900,
      simple_slideshow = bgslideshow,
      listItems = simple_slideshow.children('.imgbg, .imgbg-page'),
      listLen = listItems.length,
      i = 0,
      changeList = function () {
        listItems.eq(i).fadeOut(transSpeed, function () {
          i += 1, i === listLen && (i = 0), listItems.eq(i).fadeIn(transSpeed)
        })
      };
    listItems.not(':first').hide(), setInterval(changeList, slideBegin);

  });

  // countDown
  $(function () {
    $('#given_date').countdowntimer({
      dateAndTime: "2019/01/01 00:00:00",
      size: "lg",
      regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
      regexpReplaceWith: "$1<span>days</span> $2<span>hours</span> $3<span>mnt</span> $4<span>sec</span>"
    });
  });


  // projects
  var $containerpro = $('#projects-wrap');
  $containerpro.isotope({
    itemSelector: '.item',
    filter: '*'
  });
  // $('.filt-projects').on("click", function(e) {
  //   e.preventDefault();
  //   var $this = $(this);
  //   if ($this.hasClass('active')) {
  //     return false;
  //   }
  //   var $optionSetpro = $this.parents();
  //   $optionSetpro.find('.active').removeClass('active');
  //   $this.addClass('active');

  //   var selector = $(this).attr('data-project');
  //   $containerpro.isotope({
  //     filter: selector,
  //   });
  //   return false;
  // });
  // layout Isotope after each image loads
  $containerpro.imagesLoaded().progress(function () {
    $containerpro.isotope('layout');
  });


  // Magnific Popup img
  $('.big-img').magnificPopup({
    delegate: 'a',
    type: 'image',
    tLoading: 'Loading image #%curr%...',
    mainClass: 'mfp-with-zoom mfp-img-mobile',
    gallery: {
      enabled: true,
      navigateByImgClick: false,
      preload: [0, 1]
    },
    image: {
      tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
      titleSrc: function (item) {
        return item.el.attr('title');
      }
    }

  });


  // owl slider home
  var time = 5; // time in seconds
  var owl = $("#owl-slider-home"),
    status = $("#owlStatus");
  var $progressBar,
    $bar,
    $elem,
    isPause,
    tick,
    percentTime;

  var projectsSmall = $("#projectsSmall");
  projectsSmall.owlCarousel({
    items: 5,
    itemsDesktop: [1366, 4],
    itemsDesktopSmall: [1024, 3],
    itemsTablet: [760, 2],
    itemsMobile: [414, 1],
    pagination: false,
    responsiveRefreshRate: 100,
    afterInit: function (el) {
      el.find(".owl-item").eq(0).addClass("synced");
    }
  });

  $("#projectsSmall").on("click", ".owl-item", function (e) {
    e.preventDefault();
    var number = $(this).data("owlItem");
    owl.trigger("owl.goTo", number);
    galnav.fadeIn(500);
    maingall.slideUp(500);
  });

  function center(number) {
    var projectsSmallvisible = projectsSmall.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for (var i in projectsSmallvisible) {
      if (num === projectsSmallvisible[i]) {
        var found = true;
      }
    }

    if (found === false) {
      if (num > projectsSmallvisible[projectsSmallvisible.length - 1]) {
        projectsSmall.trigger("owl.goTo", num - projectsSmallvisible.length + 2)
      } else {
        if (num - 1 === -1) {
          num = 0;
        }
        projectsSmall.trigger("owl.goTo", num);
      }
    } else if (num === projectsSmallvisible[projectsSmallvisible.length - 1]) {
      projectsSmall.trigger("owl.goTo", projectsSmallvisible[1])
    } else if (num === projectsSmallvisible[0]) {
      projectsSmall.trigger("owl.goTo", num - 1)
    }
  }


  // Init the carousel
  owl.owlCarousel({
    slideSpeed: 2000,
    paginationSpeed: 2000,
    pagination: false,
    singleItem: true,
    transitionStyle: 'fade',
    afterInit: progressBar,
    afterMove: moved,
    afterAction: afterAction,
    loop: true,
    autoHeight: true,
    touchDrag: false,
    mouseDrag: false,
    navigation: true,
    navigationText: [
      "<i class='fa fa-long-arrow-left'></i>",
      "<i class='fa fa-long-arrow-right'></i>"
    ]
  });

  function updateResult(pos, value) {
    status.find(pos).find(".result").text(value);
  }
  function afterAction() {
    var current = this.currentItem;
    $("#projectsSmall")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if ($("#projectsSmall").data("owlCarousel") !== undefined) {
      center(current)
    }
    updateResult(".owlItems", this.owl.owlItems.length);
    updateResult(".currentItem", this.owl.currentItem + 1);
  }

  // Init progressBar where elem is $("#owl-slider-home")
  function progressBar(elem) {
    $elem = elem;
    // build progress bar elements
    buildProgressBar();
    // start counting
    start();
  }

  // create div#progressBar and div#bar then prepend to $("#owl-slider-home")
  function buildProgressBar() {
    $progressBar = $("<div>", {
      id: "progressBar"
    });
    $bar = $("<div>", {
      id: "bar"
    });
    $progressBar.append($bar).prependTo($elem);
  }

  function start() {
    // reset timer
    percentTime = 0;
    isPause = false;
    // run interval every 0.01 second
    tick = setInterval(interval, 10);
  };

  function interval() {
    if (isPause === false) {
      percentTime += 1 / time;
      $bar.css({
        width: percentTime + "%"
      });
      // if percentTime is equal or greater than 100
      if (percentTime >= 100) {
        // slide to next item 
        $elem.trigger('owl.next')
      }
    }
  }

  // moved callback
  function moved() {
    // clear interval
    clearTimeout(tick);
    // start again
    start();
  }


  /*************** Plugin end ***************/

  // set height background	 
  $(function () {
    function i() {
      windowHeight = $win.innerHeight(), $(".mainbg").css("min-height", windowHeight)
    } i(), $win.resize(function () { i() })
  });

  // custom page background
  $('.h-bg').each(function () {
    $(this).find(".image-container").css("height", jQuery(this).find(".image-container").parent().css("height"));
  });


  /*************** Quagga SearchBAR ***************/
  //  JQUERY CODE TO TOGGLE QUAGGA WINDOW//////
  // $(document).on('click', '#scan', function (event) {
  //   $('#barcode-scanner').toggleClass('moreHeight');
  // });


  var _scannerIsRunning = false;

  function startScanner() {
    Quagga.init({
      inputStream: {
        name: "Live",
        type: "LiveStream",
        target: document.querySelector('#barcode-scanner'),
        constraints: {
          width: 480,
          height: 480,
          facingMode: "environment"
        },
      },
      decoder: {
        readers: [
          "upc_reader"
        ],
        debug: {
          showCanvas: true,
          showPatches: true,
          showFoundPatches: true,
          showSkeleton: true,
          showLabels: true,
          showPatchLabels: true,
          showRemainingPatchLabels: true,
          boxFromPatches: {
            showTransformed: true,
            showTransformedBox: true,
            showBB: true
          }
        }
      },

    }, function (err) {
      if (err) {
        console.log(err);
        //var mysrterr = err;
        // if(mysrterr.indexOf('Requested device not found') != -1){
        //   alert("No Device Found!");
        // }
        return
      }

      console.log("Initialization finished. Ready to start");
      Quagga.start();

      // Set flag to is running
      _scannerIsRunning = true;
    });

    Quagga.onProcessed(function (result) {
      var drawingCtx = Quagga.canvas.ctx.overlay,
        drawingCanvas = Quagga.canvas.dom.overlay;

      if (result) {
        if (result.boxes) {
          drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
          result.boxes.filter(function (box) {
            return box !== result.box;
          }).forEach(function (box) {
            Quagga.ImageDebug.drawPath(box, {
              x: 0,
              y: 1
            }, drawingCtx, {
              color: "green",
              lineWidth: 2
            });
          });
        }

        if (result.box) {
          Quagga.ImageDebug.drawPath(result.box, {
            x: 0,
            y: 1
          }, drawingCtx, {
            color: "#00F",
            lineWidth: 2
          });
        }

        if (result.codeResult && result.codeResult.code) {
          Quagga.ImageDebug.drawPath(result.line, {
            x: 'x',
            y: 'y'
          }, drawingCtx, {
            color: 'red',
            lineWidth: 3
          });
        }
      }
    });


    Quagga.onDetected(function (result) {
      //console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);
      $("#headersearchinput").val(result.codeResult.code);
      $("#headersearchbutton").click();
    });
  }


  // Start/stop scanner
  if (document.getElementById('scan') !=null) {

    document.getElementById("scan").addEventListener("click", function () {
      if (_scannerIsRunning) {
        Quagga.stop();
      } else {
        startScanner();
      }
    }, false);

  }
  

  

  
  ////////////////////Store Name and Address Autocomplete/////////////////////
  $(document).ready(function () {
    $(document).on('keyup', '#storeName', function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();

      if ($(this).val().length > 1) {
        // Enable submit button
        console.log('has something');
      } else {
        // Disable submit button
        console.log('has blank');
        $(".searchList").fadeOut();
      }

      if ($('.searchList').css('display') == 'none') {
        $(".searchList:hidden").show();
      }

      var query = $(this).val();
      if (query !== '') {
        $.ajax({
          url: 'includes/action.php',
          method: 'POST',
          data: {
            suggestion: query
          },
          success: function (data) {
            $('.searchList').html(data);
            //$('#storeAddress').html(data);
          }
        });
      }
    });
    
  });

  
  $(document).on('click', '.storeHint', function () {
    $('#storeName').val($(this).text());
    $('.searchList').fadeOut();

  });

  ////////////////////Search Autocomplete/////////////////////
  $(document).ready(function () {
    $(document).on('keyup', '#headersearchinput', function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      //console.log("hurray...");
      if ($(this).val().length > 1) {
        // Enable submit button
        console.log('has something');
      } else {
        // Disable submit button
        console.log('has blank');
        $(".productSearchList").fadeOut();
      }

      if ($('.productSearchList').css('display') == 'none') {
        $(".productSearchList:hidden").show();
      }
      var searchQuery = $(this).val() + '|' + $('#htype').val();
      if (searchQuery !== '') {
        $.ajax({
          url: 'includes/action.php',
          method: 'POST',
          data: {
            searchSuggestion: searchQuery
          },
          success: function (data) {
            $('.productSearchList').html(data);
          }
        });
      } //else {
      // $(".productSearchList").css('display') == 'none';
      //}
    });
  });

//----Registration Area--------------------------------------
$(document).on('click', '#signupForm', function (e) {
  e.preventDefault();
  
  //console.log("Registration Area!");
  var mcate = $("#signupFormNow #rcate option:selected").val();
  var ralergy = new Array();
      $('input[name="ralergy[]"]:checked').each(function(){
        ralergy.push($(this).val());
      });

  var first_name = $('#signupFormNow #first_name').val();
  var last_name = $('#signupFormNow #last_name').val().trim();
  var email_book = $('#signupFormNow #email_book').val().trim();
  var state = $('#signupFormNow #state option:selected').val();
  var city = $('#signupFormNow #city').val().trim();
  var username = $('#signupFormNow #username').val().trim();
  var password = $('#signupFormNow #password').val();
  var password2 = $('#signupFormNow #password2').val();
  //var agreement_check = $('#agreement_check').val();

  //console.log(state);
  //console.log($('#state').children('option:selected').index());
  if (mcate == "") {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please Select Your Diet.');
    $('#signupFormNow #rcate').focus();
    return false;
  }

  if (first_name.length < 3) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please enter a First Name 3 characters or more.');
    $('#first_name').focus();
    return false;
  } 

  if (last_name.length < 3) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please enter a Last Name 3 characters or more.');
    $('#last_name').focus();
    return false;
  } 

  emailReg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  if(!emailReg.test(email_book) || email_book == '') {
     alert('Please enter a valid email address.');
     $('#email_book').focus();
     return false;
  } else {
    $('#signupFormNow #username').val($('#signupFormNow #username').val());
  }

  if ($('#signupFormNow #state').children('option:selected').index() == 0) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please Choose any State.');
    $('#state').focus();
    return false;
  } 

  if (city.length < 3) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please enter a City.');
    $('#city').focus();
    return false;
  } 

  if (password.length < 8) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please enter a Password 8 characters or more.');
    $('#signupFormNow #password').focus();
    return false;
  } 

  if (password != password2) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Both Passwords are not equal');
    $('#signupFormNow #password2').focus();
    return false;
  } 

  if ($("#signupFormNow #agreement_check").is(":checked")) {
    console.log('checked');
    var formChecked = true;
    //$("#formResult_register").html("You must accept Terms & Conditions!");
    //$("#formResult_register").fadeIn();
  } else {
    var formChecked = false;
  console.log('un-checked'); //formResult_register
    $("#formResult_register").html("You must accept Terms & Conditions!");
    $("#formResult_register").fadeIn();
    return false;
  }

  //return
  //$('#formResult_login').html('UID: '+uid+' \nPWD: '+pwd);
  //$('#formResult_login').show();
  if ( formChecked == true ) {
    $.ajax({
      url: 'includes/signup.inc.php',
      type: 'post',
      data: { 
        'mcate': mcate,
        'ralergy': ralergy,
        'first_name': first_name, 
        'last_name': last_name,
        'email_book': email_book,
        'state': state,
        'city': city,
        'username': username,
        'password': password 
      },
      success: function (response) {
        var msg = "";
        if (response == "1") {
          // if (lurl == 'index.php'){
          //   window.location = lurl;//"index.php";
          // } else {
          //   window.location = "index.php";
          // }
          msg = 'User have been created please check your email to validate your account!';
        } else {
          msg = response;//"Invalid username and password!";
        }
        $("#signupFormNow #formResult_register").html(msg);
        $('#signupFormNow #formResult_register').fadeIn();
      }
    });
  } else {
    $("#signupFormNow #formResult_register").html('You must accept Terms & Conditions!');
    $('#signupFormNow #formResult_register').fadeIn();
  }

});
//----END Register Area--------------------------------------


//----Forget Password Area--------------------------------------
$(document).on('click', '#forget', function (e) {
  e.preventDefault();
  
  console.log("Forgot Password Area!");
  
  var email_addressforgot = $('#forgotform #email_addressforgot').val();
  
  //var agreement_check = $('#agreement_check').val();

  console.log(email_addressforgot);
  //console.log($('#state').children('option:selected').index());
 
  emailReg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  if(!emailReg.test(email_addressforgot) || email_addressforgot == '') {
     //alert('Please enter a valid email address.');
     $('#forgotform #email_addressforgot').focus();
     $("#forgotform #formResult_forget").html('Please enter a valid email address!');
     $('#forgotform #formResult_forget').fadeIn();
     return false;
  } else {
    var formChecked = true;
  }

  //return
  //$('#formResult_login').html('UID: '+uid+' \nPWD: '+pwd);
  //$('#formResult_login').show();
  if ( formChecked == true ) {
    $.ajax({
      url: 'includes/forgot_password.inc.php',
      type: 'post',
      data: { 
        'email_addressforgot': email_addressforgot 
      },
      success: function (response) {
        var msg = "";
        if (response == "1") {
          //msg = '';
          $('#forgotform #formResult_forget').fadeOut();
          $("#forgotform #formResult_forget_suc").html('Password Request Sent Successfully!');
          $('#forgotform #formResult_forget_suc').fadeIn();
        } else {
          msg = response;//"Invalid username and password!";
          $('#forgotform #formResult_forget_suc').fadeOut();
          $("#forgotform #formResult_forget").html(msg);
          $('#forgotform #formResult_forget').fadeIn();
        }
        
      }
    });
  } else {
    $('#forgotform #email_addressforgot').focus();
    $("#forgotform #formResult_forget").html('Please enter a valid email address!');
    $('#forgotform #formResult_forget').fadeIn();
  }

});
//----END forget password--------------------------------------

////////////////////City Autocomplete/////////////////////
  $(document).on('keyup', '#signupFormNow #city', function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  //console.log("city again...");

  if ($(this).val().length > 1) {
    // Enable submit button
    console.log('city something');
  } else {
    // Disable submit button
    console.log('city has blank');
    $(".citySearchList").fadeOut();
  }

  var cityQuery = $(this).val();
  var state = $('#state').val();
  if (cityQuery !== '' && state !== '' ) {
    $.ajax({
    url: 'includes/action.php',
    method: 'POST',
    data: {
    cityQuery: cityQuery,
    state: state
    },
    success: function(data) {
      if (data.length > 0) {
        $('.citySearchList').html(data);
        $('.citySearchList').fadeIn();
      } else {
        $('.citySearchList').fadeOut();
        $('.citySearchList').hide();
      }
      
    }
    });
  } else {
    alert ("First Select any State!");
    $(this).val("");
    $('#state').focus();
  }
  });
 

  $(document).on('click', '.cityHint', function() {
  $('#city').val($(this).text());
  $('.citySearchList').fadeOut();
  });

  //----Login Area--------------------------------------
  $(document).on('click', '#signinForm', function (e) {
    e.preventDefault();
    var uid = $('#uid').val().trim();
    var pwd = $('#pwd').val().trim();
    var lurl = $('#lurl').val();
    // return;
    alert("lkjlkj");
    console.log("helllooooooo");
    //$('#formResult_login').html('UID: '+uid+' \nPWD: '+pwd);
    //$('#formResult_login').show();
    if (uid != "" && pwd != "") {
      $.ajax({
        url: 'includes/login.inc.php',
        type: 'post',
        data: { uid: uid, pwd: pwd },
        success: function (response) {
          var msg = "";
          if (response == '1') {
            //if (lurl == 'index.php'){
            //  window.location = lurl;//"index.php";
            //} else {
              window.location = "dashboard.php";
            //}
            
          } else {
            msg = response;//"Invalid username and password!";
          }
          $("#formResult_login").html(msg);
          $('#formResult_login').show();
        }
      });
    } else {
      $("#formResult_login").html('Invalid username and password!');
      $('#formResult_login').show();
    }

  });
  //----END Login Area--------------------------------------

  $(document).on('click', '.searchHintContainer', function () {
    $('#headersearchinput').val($('.searchHintContainer:hover').find('.searchHint').text());
    $('.catSelectOption').val($('.searchHintContainer:hover').find('.inCat').text());
    console.log($('#htype').val());
    //console.log($('#radioBtn > a').attr("data-id"));

    $('.productSearchList').fadeOut();
    $("#headersearchbutton").click();
  });

  //////Adjust quick view quantity up//////////

  $(document).on('click', '.adjustUpBtn', function (event) {
    event.preventDefault();
    //alert("wait");
    var item_to_adjust_u = $(this).attr('id');
    var quantity = $(this).attr('qty');
    var uid = $(this).attr('uid');
    $.ajax({
      url: 'includes/action.php',
      method: 'POST',
      data: {
        'item_to_adjust_u': item_to_adjust_u,
        'quantity': quantity,
        'uid': uid
      },
      success: function () {
        displayFromDatabase();
      }
    });
  });

  ////////////////////Create Recipe Ingredient Search Autocomplete/////////////////////
  //$(document).ready(function() {
    $(document).on('keyup', '#ingredientsearchinput', function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();
    //var searchQuery = $(this).val();

    if ($(this).val().length > 1) {
      // Enable submit button
      console.log('has something');
    } else {
      // Disable submit button
      console.log('has blank');
      $(".recipeHintContainer").fadeOut();
    }

    if ($('.recipeHintContainer').css('display') == 'none') {
      $(".recipeHintContainer:hidden").show();
    }
    var searchQuery22 = $(this).val();
    if (searchQuery22 !== '') {
    $.ajax({
    url: 'includes/action.php',
    method: 'POST',
    data: {
    ingredientSuggestion: searchQuery22
    },
    success: function(data) {
    $('.ingredientSearchList').html(data);
    $('.ingredientSearchList').fadeIn();
    }
    });
    }
    });
   // });
    
    $(document).on('click', '.recipeHintContainer', function() {
    $('#ingredientsearchinput').val($('.recipeHintContainer:hover').find('.searchHint').text());
    $('#ingredient-cat').val($('.recipeHintContainer:hover').find('.inCat').text());
    $('#ingredient-upc').val($('.recipeHintContainer:hover').find('.hiddenUPC').text());
    $('.ingredientSearchList').fadeOut();
    });

  //////Adjust quick view quantity down//////////
  $(document).ready(function () {
    $(document).on('click', '.adjustDownBtn', function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      var item_to_adjust_d = $(this).attr('id');
      var quantity = $(this).attr('qty');
      var uid = $(this).attr('uid');
      $.ajax({
        url: 'includes/action.php',
        method: 'POST',
        data: {
          'item_to_adjust_d': item_to_adjust_d,
          'quantity': quantity,
          'uid': uid
        },
        success: function () {
          displayFromDatabase();
        }
      });
    });
  });


 ////////CHECK item off list in Shop page//////////////
  $(document).ready(function() {
    $(".check").on("change", "input:checkbox", function() {
        $(this.form).submit();
    });
  });

  ////////UNCHECK item off list in Shop page//////////////
  $(document).ready(function() {
    $(".uncheck").on("change", "input:checkbox", function() {
      $(this.form).submit();
    });
  });

  ////////////////Shop Page Price-Confirm-No Bring Up Price Entry Form///////////
  $(document).ready(function() {
    $("#priceConfirmNo").click(function() {
      $('#priceModalFormAreaYes').hide();
      $('#priceModalFormAreaNo').show();
    });
  });  

  ///////////Adds item to list//////////////////////
  $(document).ready(function () {
    $('.addButton').click(function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      var upc = $(this).attr('id');
      var uid = $(this).attr('uid');
      $.ajax({
        url: 'includes/action.php',
        method: 'POST',
        data: {
          'add': 1,
          'upc': upc,
          'uid': uid
        },
        success: function () {
          location.reload(true);
        }
      });
    });
  });

  $('textarea').keypress(function(e) {
    var tval = $('textarea').val(),
        tlength = tval.length,
        set = 150,
        remain = parseInt(set - tlength);
    $('#txtleft').text(remain);
    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('textarea').val((tval).substring(0, tlength - 1))
    }
})

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('.nav-tabs > li a[title]').tooltip();
    
//Wizard
$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

    var $target = $(e.target);

    if ($target.parent().hasClass('disabled')) {
        return false;
    }
});

$(".next-step").click(function (e) {

  var curStep = $(this).closest(".tab-pane"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.wizard div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='checkbox'],input[type='radio'],select,textarea"),
                isValid = true;
    var $active = $('.wizard .nav-tabs li.active');
    //var $active = $(this).closest('.wizard .nav-tabs li.active'),
    //curInputs = $active.find("input[type='text'],input[type='checkbox'],input[type='radio'],select"),
    //isValid = true;

    $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid ) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid) {
          $active.next().removeClass('disabled'); 
          nextStepWizard.removeAttr('disabled').trigger('click');
          nextTab($active);
        }

    //$active.next().removeClass('disabled');
    //nextTab($active);

});
$(".prev-step").click(function (e) {

    var $active = $('.wizard .nav-tabs li.active');
    prevTab($active);

});

function nextTab(elem) {
  $(elem).next().find('a[data-toggle="tab"]').click();
}

function prevTab(elem) {
  $(elem).prev().find('a[data-toggle="tab"]').click();
}

////////////////Toggle Past Purchases List By Clicking on Date////////////////////
$(document).ready(function() {
  $('.pastPurchases').click(function(event) {
  //event.stopImmediatePropagation();
  $('.cardArea', this).slideToggle(250);
  $('.downUpArrow', this).toggleClass('rotateArrow');
  });
  });
  
///////////Adds Ingredients//////////////////////
$(document).on('click', '#submitIngredient', function (event) {
  event.preventDefault();
  event.stopImmediatePropagation();

  if (typeof window.myJSON === 'undefined') { //true
    window.myJSON = [];
  }

  var iname = $('#iname').val();
  var ingredientsearchinput = $('#ingredientsearchinput').val();
  var ingredientupc = $('#ingredient-upc').val();
  var iqty = $('#iqty').val();
  var measurementSelect = $('#measurementSelect').val();
  var ingredientcat = $('#ingredient-cat').val();
 
  if (iname.length < 3) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please enter a Ingredient Name 3 characters or more.');
    $('#iname').focus();
    return false;
  }

  if (ingredientsearchinput.length < 3) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please enter a Preferred Exact Ingredient Name 3 characters or more.');
    $('#ingredientsearchinput').focus();
    return false;
  }

  if (iqty.length < 1) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please enter a Quantity atleast 1 or more.');
    $('#iqty').focus();
    return false;
  }

  item = {}
  item ["iname"] = iname;
  item ["ingredientsearchinput"] = ingredientsearchinput;
  item ["ingredientupc"] = ingredientupc;
  item ["iqty"] = iqty;
  item ["measurementSelect"] = measurementSelect;
  item ["ingredientcat"] = ingredientcat;
  window.myJSON.push(item);
  console.log(window.myJSON);
  appendData(window.myJSON);
  $("#iname").val("");
  $("#ingredientsearchinput").val("");
  $("#ingredient-upc").val("");
  $("#ingredient-cat").val("");
  $("#iqty").val("");
  //$("#measurementSelect").reset();
});

function appendData(data) {
  var div = document.createElement("div");
  //var mainContainer = $().html//document.getElementById("ilistshow");
  //mainContainer.empty();
  var champoo = "";
  // var champoo1 = "";
  // var champoo2 = "";
  var counter1 = 0;    
  for (var i = 0; i < data.length; i++) {
    counter1++;
    champoo += "<tr><td class='center'>"+ counter1 +"</td><td>"+ data[i].iname +"<br>"+ data[i].ingredientsearchinput +"<br>"+ data[i].ingredientupc +"</td><td class='center'>"+ data[i].iqty +"</td><td class='center'>"+ data[i].measurementSelect +"</td><td>"+ data[i].ingredientcat +"</td><td><button class='btn btn-danger' id='delIngredient' type='submit' name='delIngredient' data-value='"+i+"'>X</button></td></tr>";    
  }

  div.innerHTML = "<table class='table table-striped'><thead><tr><th style='width:25px;'>S.No.</th><th>Ingredient Name</th><th style='width:35px;'>Quantity</th><th style='width:55px;'>Measurement</th><th>Category</th></tr></thead><tbody>" + champoo + "</tbody></table>" ;
  
  //champoo1 + champoo2 +"</tbody></table>";
  $('#ilistshow').html(div);
  //mainContainer.appendChild(div); 
}

$(document).on('click', '#delIngredient', function (event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  //console.log( $(this).attr('value') );
  //alert($(this).attr('data-value'));
  var mrow = $(this).attr('data-value') ;
  window.myJSON.splice(mrow, 1);
  //console.log("itemRemoved: "+mrow)
  appendData(window.myJSON);
  //arr.splice(2,2);

});  

///////////Adds Steps or Direction//////////////////////
$(document).on('click', '#submitDirections', function (event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  if (typeof window.myJSONstep === 'undefined') { //true
    window.myJSONstep = [];
  } else {
    window.stepnum = window.myJSONstep.length;
  }
  var dstep = ($('#dstep').val()) * 1;
  var dtext = $('#dtext').val();
  
  if (dtext.length < 3) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please enter a your Step atleast 3 or more characters!');
    $('#dtext').focus();
    return false;
  }
  
  item = {}
  if (typeof window.stepnum === 'undefined') {
    item ["dstep"] = dstep;
    window.stepnum = dstep;
  } else {
    window.stepnum = dstep;
    item ["dstep"] = window.stepnum;
  }
  //item ["dstep"] = dstep;
  item ["dtext"] = dtext;
  window.myJSONstep.push(item);
  console.log(window.myJSONstep);
  appendDatastep(window.myJSONstep);
  
  console.log("stepnum: "+window.stepnum);
  $('#dstep').val(window.stepnum + 1);
  $("textarea#dtext").val("");
  //$("textarea#dtext").html("");
});

function appendDatastep(data) {
  var divv = document.createElement("div");
  //var mainContainer = $().html//document.getElementById("ilistshow");
  //mainContainer.empty();
  var champooo = "";
  
  for (var i = 0; i < data.length; i++) {
    
    //champooo += "<tr><td class='center'>"+ data[i].dstep +"</td><td>"+ data[i].dtext +"</td><td><button class='btn btn-danger' id='delStep' type='submit' name='delStep' data-value='"+i+"'>X</button></td></tr>";
    champooo += "<tr><td class='center'>"+ data[i].dstep +"</td><td>"+ data[i].dtext +"</td></tr>";
  }

  divv.innerHTML = "<table class='table table-striped'><thead><tr><th style='width:25px;'>S.No.</th><th>Step/Direction Details</th></tr></thead><tbody>" + champooo + "</tbody></table>" ;
  
  //champoo1 + champoo2 +"</tbody></table>";
  $('#istepshow').html(divv);
  //mainContainer.appendChild(div); 
}

$(document).on('click', '#delStep', function (event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  //console.log( $(this).attr('value') );
  //alert($(this).attr('data-value'));
  var srow = $(this).attr('data-value') ;
  window.myJSONstep.splice(srow, 1);
  //console.log("itemRemoved: "+mrow)
  appendDatastep(window.myJSONstep);
  //arr.splice(2,2);

});

///////////Adds Recipe to Database//////////////////////
$(document).on('click', '#submitRecipe', function (event) {
  
    event.preventDefault();
    event.stopImmediatePropagation();
    console.log('submitting Recipe WOW!');
    //return;
    //data: {my_json_data: JSON.stringify(window.myJSON)},    

    var rname = $('#rname').val();
    //var rcate = $('#rcate').val();
    var rcate = $( "#rcate option:selected" ).val(); //text()
    var ralergy = new Array();
      $('input[name="ralergy[]"]:checked').each(function(){
        ralergy.push($(this).val());
      });

    //var ralergy = $("input[name='ralergy']:checked").val();
    //var  = window.myJSON;
    //var Ralergy = JSON.stringify(ralergy); 
    var Ingredients = JSON.stringify(window.myJSON); 
    var Direction = JSON.stringify(window.myJSONstep);
    //var chkfile = $('#chkfile').val();
    
    if ($('#chkfile').is(":checked")) {
      console.log('checked picture upload');
      var checkFlag = 'checked';
      var haspic = $('#haspic')[0].files;
      var formData = new FormData();
                    if(haspic.length > 0 ){
                        //fd.append('file',files[0]);
                        console.log("I got the file size!");
                        //fd.append('file',haspic[0]);
                        formData.append('rname', rname);
                        formData.append('rcate', rcate);
                        formData.append('ralergy', ralergy);
                        formData.append('Ingredients', Ingredients);
                        formData.append('Direction', Direction);
                        //formData.append('rcate', rcate);
                        formData.append('chkfile', checkFlag);
                        formData.append('file', $('#haspic')[0].files[0]);
                    }
                    //------------------------------------------------------------------------------
                    $.ajax({
                      url: "includes/action.php",
                      type: "POST",
                      dataType: "json",
                      processData: false,  // tell jQuery not to process the data
                      contentType: false,  // tell jQuery not to set contentType                        
                      data: formData,
                      //data: { "cid": cid, "asset_name": asset_name, "asset_desc": asset_desc, "datetime1": datetime1, "datetime2": datetime2, "haspic": haspic },

                      success: function (response)
                       {
                          if (response.insertrecipe) {
                              //console.log(jsonSensor);
                              var seconds = 10;
          
                              $("#recipe_results").fadeIn();
                              setInterval(function () {
                                  seconds--;
                                  $("#recipe_results").html(response.status + "<br>Recipe Successfully Inserted! <br>After <strong>"+seconds+ "</strong> seconds the page will redirect to Recipie Page!");
                                  
                                  if (seconds == 0) {
                                      window.location = "recipe_details.php?rid="+response.insertrecipe;
                                      console.log("Countdown Finished!");
                                  }
                              }, 1000);
                              
                          } else {
                            $("#recipe_results").html(response);
                            $("#recipe_results").fadeIn();
                          }
                      }
                    });
                    //------------------------------------------------------------------------------
    } else {
      console.log('un-checked picture not to upload');
      var checkFlag = 'unchecked';
      $.ajax({
        url: 'includes/action.php',
        method: 'POST',
        dataType: "json",
        data: {
          'rname': rname,
          'rcate': rcate,
          'ralergy': ralergy,
          'Ingredients': Ingredients,
          'Direction': Direction,
          'chkfile' : checkFlag
          
        },
        success: function (response) {
          console.log(response);
          if (response.insertrecipe) {
            //console.log(jsonSensor);
            var seconds = 10;

            $("#recipe_results").fadeIn();
            setInterval(function () {
                seconds--;
                $("#recipe_results").html(response.status + "<br>Recipe Successfully Inserted! <br>After <strong>"+seconds+ "</strong> seconds the page will redirect to Recipie Page!");
                
                if (seconds == 0) {
                    window.location = "recipe_details.php?rid="+response.insertrecipe;
                    console.log("Countdown Finished!");
                }
            }, 1000);
            
        } else {
          $("#recipe_results").html(response);
          $("#recipe_results").fadeIn();
        }
  
          //location.reload(true);
        }
      });
    }
    //return;

  });

  
  ///////////Adds Rating Review//////////////////////
  $(document).on('click', '#submitRating', function (event) {
    //$('#submitRating').click(function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      var upc = $('#upc').val();
      var uid = $('#uid').val();
      var review = $('#review').val(); 
      var phprating = $('#phprating').val(); 
      console.log(upc +' | '+uid+' | '+review);
      //$('#myModal').modal('hide').fadeOut();
      $.ajax({
        url: 'includes/action.php',
        method: 'POST',
        data: {
          'review': review,
          'upc': upc,
          'uid': uid,
          'prorating': phprating
        },
        success: function (response) {
          console.log(response);
          if ( response == "true") {
            $("#ratresult").html("Rating Successfully Submited!");
            $("#ratresult").fadeIn();
            setTimeout(function() {
              //$("#successMessage").hide('blind', {}, 500)
              //location.reload(true);
          }, 3000);

          }
          $("#ratresult").html(response);
          $("#ratresult").fadeIn();

          //location.reload(true);
        }
      });
    });
  //});

  $(document).on('click', ':checkbox', function (event) {

  //$(":checkbox").click(function(event) {
    if ($(this).is(":checked")) {
      console.log('checked');
      $("#myupload").fadeIn();
    } else {
    console.log('un-checked');
      $("#myupload").fadeOut();
    }
  });

  
  $(document).on('click', '#loccity', function (e) {
      //alert("Location");
      e.preventDefault();
      e.stopImmediatePropagation();
      //alert("hello");
      var rid = $(this).attr("data-rid");
      // var hid_laststep = $('#hid_laststep').val();
      // hid_laststep = (hid_laststep * 1) + 1;
      //data-rid
      $.confirm({
          title: 'Update Your Location!',
          columnClass: 'small',
          content: '<div class="col-md-12" style="min-height:200px;" ><form method="post" action="">' + 
                      '<div class="form-group">' + 
                          '<label for="mylocat">Enter ZIP Code!' +
                          '<input class="form-control" type="text" name="mylocat" id="mylocat" style="width:100% !important;" required/> </label>' +
                      '</div>' +
                      '<div id="locsugg" style="display:none;"></div>' +
                  '</form></div>',
                  
          buttons: {
              formSubmit: {
                  text: 'Update Location Now',
                  btnClass: 'btn-blue',
                  action: function () {
                      
                      var mylocat = $('#mylocat').val(); 
                      if(!mylocat){
                          $.alert('You must enter zip code!');
                          return false;
                      }
                      //console.log(rid +' | '+ingredientsearchinput);
                      console.log("submit event");
                      

                      $.ajax({
                          url: 'includes/action.php',
                          type: "POST",
                          data: {
                            'mylocat': mylocat
                            },
                          success: function (response) {
                          console.log(response);
                          
                          //return false;
                          // if (response.indexOf("champa") >= 0) {
                          //     return false;
                          // } else {
                          //     location.reload(true);
                          //     return false

                          // }
                          
                          location.reload(true);
                          }
                      });
                  }
              },
              cancel: function () {
                  //close
              },
          },
          onContentReady: function () {
              // bind to events
              var jc = this;
              this.$content.find('form').on('submit', function (e) {
                  // if the user submits the form by pressing enter in the field. $$formSubmit
                  e.preventDefault();
                  jc.$formSubmit.trigger('click'); // reference the button and click it
                  });
              }
      });
    
    });

////////////////////City Autocomplete/////////////////////
$(document).on('keyup', '#mylocat', function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  //console.log("city again...");

  if ($(this).val().length > 1) {
    // Enable submit button
    console.log('Zip something');
  } else {
    // Disable submit button
    console.log('zip has blank');
    $("#locsugg").fadeOut();
  }

  var zipQuery = $(this).val();
  if (zipQuery !== '' ) {
    $.ajax({
    url: 'includes/action.php',
    method: 'POST',
    data: {
    zipQuery: zipQuery
    },
    success: function(data) {
      if (data.length > 0) {
        $('#locsugg').html(data);
        $('#locsugg').fadeIn();
      } else {
        $('#locsugg').fadeOut();
        $('#locsugg').hide();
      }
      
    }
    });
  } 
  });
 

  $(document).on('click', '.zipHint', function() {
  $('#mylocat').val($(this).text());
  $('#locsugg').fadeOut();
  });

  ////////////JQUERY AJAX FUNCTION TO REFRESH THE QUICK_VIEW, MY_LIST AND PANTRY PAGES////////////
  function displayFromDatabase() {
    $('#myList').load('results.php #myList');
    $('.compareList').load('my_list.php .compareList');
    $('.storeTileArea').load('my_list.php .storeTileArea');
    //$('.shop-compareList').load('shop.php .shop-compareList');
    //$('.shop-storeTileArea').load('shop.php .shop-storeTileArea');
    $('.pantry-area').load('pantry.php .pantry-area');
    $('.searchList').load('details.php .searchList');
    $('#storePriceContainer').load('details.php #storePriceContainer');
    $('#card-container').load(' #card-container');
  }

  /*************** SearchBAR END ***************/
  $('#thumbs img').click(function () {
    $('#largeImage').attr('src', $(this).attr('src').replace('thumb', 'large'));
    //$('#description').html($(this).attr('alt'));
  });
});
// Document ready end





