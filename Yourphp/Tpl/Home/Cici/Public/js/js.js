$(function(){
		function selects(){
				/*select*/
		$('.mm-g-drop-menu').hover(function(event){
			  event.stopPropagation();  //阻止事件冒泡
			  $('.mm-g-drop-menu').removeClass("hover");
			  $(this).addClass("hover");
			  $(this).find(".mm-g-sub").toggle();
			  $(this).parent().siblings().find(".setbox").hide();
			},function(){
				$('.mm-g-drop-menu').removeClass("hover");
				})
		$(document).click(function(event){
			var eo = $(event.target);
			if($(".mm-g-drop-menu").is(":visible") && eo.attr("class")!="option" && !eo.parent(".mm-g-sub .J_OptLocation").length)	
			$(".mm-g-sub").hide();
			$('.mm-g-drop-menu').removeClass("hover");
		})
		$(".mm-g-sub .J_OptLocation dd").click(function(){
			var value = $(this).text();
			$('.mm-g-drop-menu').removeClass("hover");
			$(this).parent().parent().parent().siblings(".mm-g-drop-main").find('span').text(value);
			$(".mm-g-sub").hide();
		})
		}
	selects();
	/* 筛选*/
	 function Filter(){
		$('.mdContent .ff li').click(function(){
		$(this).parents('.ff').find('a').removeClass('current');
		$('.mdContent .ff li a').removeClass('current');
		$(this).addClass('current');
		})
		}
		Filter();
	/*导航*/
	function navtab(){
		$(".menu-item-dh").hover(
                function () {
                    $(this).addClass("hover");
                },
                function () {
                    $(this).removeClass("hover");
                });
		$('.mm-g-drop-menu').hover(function(){
			$('.mm-g-drop-menu').find('.mm-g-drop-sub').hide()
			 $(this).addClass("hover");
			 $(this).find('.mm-g-drop-sub').show();
			},function(){
				 $(this).removeClass("hover");
				 $(this).find('.mm-g-drop-sub').hide();
				})
		}
		navtab()
		
		
		
	 $(".menu-item-dh").hover(
                function () {
                    $(this).addClass("hover");
                },
                function () {
                    $(this).removeClass("hover");
                });
	$('.mm-g-drop-menu').hover(function(){
		$('.mm-g-drop-menu').find('.mm-g-drop-sub').hide()
		 $(this).addClass("hover");
		 $(this).find('.mm-g-drop-sub').show();
		},function(){
			 $(this).removeClass("hover");
			 $(this).find('.mm-g-drop-sub').hide();
			})
	})