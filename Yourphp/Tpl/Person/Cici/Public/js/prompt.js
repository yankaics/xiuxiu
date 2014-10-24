$(function(){
function ele_prompt(a,c){
	var $ele = $('.'+a);
	var $value = $.trim($ele.attr('loadValue'));
	var $class = $ele.attr(c);
	$ele.focus(function(){
		var $this = $(this);
		var $valueRe = $.trim($this.attr('value'));
		if($valueRe.length > 0 && $valueRe !== $value){
			$this.removeClass($class);
		}else{
			$this.attr('value','');
		}
	});
	$ele.blur(function(){
		var $this = $(this);
		var $valueRe = $.trim($this.attr('value'));
		if($valueRe.length === 0 || $valueRe === $value){
			$this.attr('value', $value);
		}
		$this.addClass($class);
	});
}
ele_prompt('prompt','addClass');

function topFun(){
		var w= $(window).width();
		var r=(w-960)/2-80;
		$('.vote').css('right',r);
		}
		topFun();
	/*function contont(){
		 $("#contitle").click(function(){
		   $('#content').show();
		   $(this).hide();
		   })
		   $("#content .con-del").click(function(){
			    $('#contitle').show();
		 	  $("#content").hide();
			   })
		}
		contont();*/
		
	//my切换
	/*function change(){
		$('.usertab .m-t li').click(function(){
			var i=$('.usertab .m-t li').index(this);
			$('.usertab .m-t li').removeClass('active').eq(i).addClass('active');
			$('.usertab .m-c').hide().eq(i).show();
			})
		}
		change()*/
		function msg(){
				$(".rHead input").focus(function(){
		},function(){
			$(this).next('.wrong1').show();
			})
	$(".rHead input").blur(function(){
		},function(){
			$(this).next('.wrong1').hide();
			})
			}
			msg();
	function tab(){
		$("#details-ul li").click(function(){
			var i=$("#details-ul li").index(this);
			$("#details-ul li").removeClass('hover').eq(i).addClass('hover');
			$('.rHead .mtabContent').hide().eq(i).show();
			})
		}
		tab();
		function companyHide(){
		$(".companyBtn").click(function(){
			$(this).parent().next('.companyCon').slideToggle();
			})
		}
		companyHide();
		//品牌特卖
		function bgchange(){
			$('.outlets_list').hover(function(){
				$(this).addClass('bgcolorChange');
				},function(){
					$(this).removeClass('bgcolorChange');
					})
			}
			bgchange();
});


$(function(){
	$('#contitle .l').click(function(){
		if(!$(this).next().is(":hidden")){
			$(this).next().hide();
			$(this).css('background-image','url(images/nav_right.png)');
			$('#contitle').css('width','195px');
		}else{
			$(this).next().show();
			$(this).css('background-image','url(images/nav_left.png)');
			$('#contitle').css('width','305px');				
		}			
	});
	$('#contitle .c,#contitle .r').click(function(){
		$('#content').show();
		$('#contitle').hide();
	});
	$("#content .con-del,#content .x").click(function(){
		$('#contitle').show();
		$("#content").hide();
	});
	$("#content .closeX").click(function(){
		$('#contitle').show();
		$("#content").hide();
		if(!$('#contitle .l').next().is(":hidden")){
			$('#contitle .l').next().hide();
			$('#contitle .l').css('background-image','url(images/nav_right.png)');
			$('#contitle').css('width','195px');
		}else{
			$('#contitle .l').next().show();
			$('#contitle .l').css('background-image','url(images/nav_left.png)');
			$('#contitle').css('width','305px');				
		}
	});		
	$('#content .r .r-box .plist .sysinfo').click(function(){
		if(!$(this).hasClass('selected')){
			$(this).addClass('selected');
			$('#content .l .pp-content .item').hide();
			$('#content .r .r-box .plist .list ul li div').removeClass('selected');
			$('#content .l .sysinfo-content').show();
		}				
	});
	$('#content .r .r-box .plist .list ul li div').click(function(){
		if(!$(this).hasClass('selected')){
			$(this).parent().siblings().find('div').removeClass('selected');
			$(this).addClass('selected');
			$('#content .l .pp-content .item:eq(0)').show();
			$('#content .r .r-box .plist .sysinfo').removeClass('selected');
			$('#content .l .sysinfo-content').hide();
		}
	});
	$('#content .r .r-box .r-status').click(function(){
		if($(this).find('.online-info').is(":hidden")){
			$(this).find('.online-info').show();
		}else{
			$(this).find('.online-info').hide();
		}
	});
});