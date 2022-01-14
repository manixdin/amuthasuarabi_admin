$(document).ready(function() {
      
    $(document).on({
        mouseenter: function () {
            $('body').addClass("menu-depart-active");
            $('.cat-f-product').addClass("dep-active");
            $('.submenu').addClass("opened");
            // $('.subcategory').addClass("show");
            // $('.subcategory').addClass("cat-active");
            $('.subcategory:first').addClass("cat-show cat-active");

            var submenuheight = $('.submenu').height();
            var submenuwidth = $('.submenu').width();
            var menuheight = submenuheight + 42.4;
            // console.log(submenuheight)
            $('.subcategory').css('height', menuheight);
            $('.subcategory').css('left', submenuwidth);

        },
        mouseleave: function () {
            $('body').removeClass("menu-depart-active");
            $('.submenu').removeClass("opened");
            $('.subcategory').removeClass("cat-show cat-active");
        }
    }, ".menu-depart");
      
    $(document).on({
        mouseenter: function () {
            $('.header-bottom .menu-depart a').removeClass("dep-active");
            // $('.subcategory').addClass("show");
            // $('.subcategory').addClass("cat-active");
        },
        mouseleave: function () {
            $('.header-bottom .menu-depart a').removeClass("dep-active");
            $('.cat-f-product').addClass("dep-active");
        }
    }, ".header-bottom .menu-depart .submenu.opened");

    $(".increment-quantity,.decrement-quantity").on("click", function(ev) {
      var currentQty = $('input[name="quantity"]').val();
      var qtyDirection = $(this).data("direction");
      var newQty = 0;
      
      if (qtyDirection == "1") {
        newQty = parseInt(currentQty) + 1;
      }
      else if (qtyDirection == "-1") {
        newQty = parseInt(currentQty) - 1;
      }

      // make decrement disabled at 1
      if (newQty == 1) {
        $(".decrement-quantity").attr("disabled", "disabled");
      }
      
      // remove disabled attribute on subtract
      if (newQty > 1) {
        $(".decrement-quantity").removeAttr("disabled");
      }
      
      if (newQty > 0) {
        newQty = newQty.toString();
        $('input[name="quantity"]').val(newQty);
      }
      else {
        $('input[name="quantity"]').val("1");
      }
    });

    $('.login-modal').click(function(){
      $('#login-form').modal({
        modal:'show',
        backdrop: 'static',
        keyboard: false
      })
    });      

  // $('.header-account').on("click", function (e) {
  //   if ($(e.target).is(".header-account") === true) {
  //       $("#custom-logout").removeClass("show");
  //   }
  //   else if($(e.target).is(".header-account") === false)
  //   {
  //     $("#custom-logout").addClass("show");
  //   }
  // });

  var popElement = document.getElementsByClassName("header-account");
  document.addEventListener('click', function(event) {
      for(i=0; i < popElement.length; i++){
          popEl = popElement[i];
          var isClickInside = popEl.contains(event.target);
          if (!isClickInside) {
            var element = document.getElementById("custom-logout");
            if(element != '' ){
              // element.classList.remove("show");
              $("#custom-logout").removeClass("show");
            }
          } else {
            var element = document.getElementById("custom-logout");
            if(element != '' ){
              // element.classList.add("show");
              $("#custom-logout").addClass("show");
            }
            break;
          }
      }
  });



});

