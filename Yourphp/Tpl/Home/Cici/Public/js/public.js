$(function($) {
  //1
  $(".mm-g-drop-menu,.more,.menu-item-dh").hover(
	  function () {
		$(this).addClass("hover");
	  },
	  function () {
		$(this).removeClass("hover");
	  });
  
//2
 $(".tt li,.line-bottom a,.xc-tab li").click(
	  function () {
		$(this).addClass("current");
		$(this).siblings().removeClass("current");
	  });
  //3
  $('.mdpic').hover(
                function () {
                    $(this).children('.mdpicTop').slideDown(200);
                },
                function () {
                    $(this).children('.mdpicTop').slideUp(200);
                }
            );	
//4
$(".line-bottom a").click(
	  function () {
		$(this).addClass("current");
		$(this).siblings().removeClass("current");
	  });
//5
 $('.snPic').hover(
                function () {
                    $(this).children('.snPicNum1').slideDown(200);
					$(this).children('.snPicNum2').slideDown(200);
					$(this).children('.snPicNum3').slideDown(200);
                },
                function () {
                    $(this).children('.snPicNum1').slideUp(200);
					$(this).children('.snPicNum2').slideUp(200);
					$(this).children('.snPicNum3').slideUp(200);
                }
            );	
 //6
 $('#jglb').click(
                function () {
                    $('.wapper2').hide();
					$('.wapper1').show();
                }
            );	
 $('#jgzp').click(
                function () {
                    $('.wapper1').hide();
					$('.wapper2').show();
                }
            );	
 
 //7
 $('.rangpic,.rangPhoto').hover(
                function () {
                    $(this).children('.mdpicTop').slideDown(200);
					$(this).children('.rangMdInfo').slideDown(200);
                },
                function () {
                    $(this).children('.mdpicTop').slideUp(200);
					$(this).children('.rangMdInfo').slideUp(200);
                }
            );	
//8
 $(".rangBox-hd li").click(
	  function () {
		$(this).addClass("current");
		$(this).siblings().removeClass("current");
	  });
});


//会员左边菜单
jQuery(function(){	
function maColumn(){
	$('.maColumn dl dt').click(function(){
		if($(this).hasClass("on")){
			$(this).next('dd').show();
			$(this).removeClass('on');
			}else
			{
			$(this).next('dd').hide();
			$(this).addClass('on');	
			}
		})
	}
	maColumn()
function mbTab(){
	$('.subTab a').click(function(){
		var index=$('.subTab a').index(this);
		$('.subTab a').removeClass('tabselect').eq(index).addClass('tabselect');
		$('.rbigmin .leftbar').hide().eq(index).show();
		})
	$('#mbtab .tabtitle li').click(function(){
		var i=$('#mbtab .tabtitle li').index(this);
		$('#mbtab .tabtitle li').removeClass('on').eq(i).addClass('on');
		$('#mbtab .tabCon').hide().eq(i).show();
		})
	}
	mbTab();
function clickreadProtocolInfo(){
	$("#onagre").click(function(){
		$('#onlinetreat').toggle();
		})
	$('.mm-activity li').click(function(){
		var i=$('.mm-activity li').index(this);
		$('.mm-activity li').removeClass('current').eq(i).addClass('current');
		})
	}
	clickreadProtocolInfo()
	function SpreadShow(){
		$('.SpreadBtn').click(function(){
			$('.way').toggle();
			})
		$('.way p label a').hover(function(){
			$(this).find('span').toggle();
			})
		/*复选框*/
		$('.pt-seltime td').click(function(){
			$(this).toggleClass('iselect');
			})
		}
		SpreadShow();
	function closebox(){
		var h=$(document.body).height();
		var showH=$(window).height();
		var w=$(window).width();
		$('.video-item-add').click(function(){
			$('.ks-ext-mask').css({"width":w, "height":h}).show();
			$('.addPicture').css({"left":(w/2-100), "top":(showH/2)}).show();
			})
		$('.mm-o-win-close').click(function(){
			$('.ks-ext-mask').hide();
			$('.addPicture').hide();
			$('.addVideo').hide();
			$('.addAlbum').hide();
			})
		$('#btn-add-new-video').click(function(){
			$('.ks-ext-mask').css({"width":w, "height":h}).show();
			$('.addVideo').css({"left":(w/2-100), "top":(showH/2)}).show();
			})
		$('.mm-create-photo').click(function(){
			$('.ks-ext-mask').css({"width":w, "height":h}).show();
			$('.addAlbum').css({"left":(w/2-100), "top":(showH/2)}).show();
			})
		/*关注*/
		$('.friend-followed2').hover(function(){
			$(this).parent().next('p').find('a').css({"visibility":"visible"})
			},function(){
				$(this).parent().next('p').find('a').css({"visibility":"hidden"})
				})
		/*基本信息*/
		$('.btn_s').click(function(){
			$(this).parents('h2').next('form').find('.infoview').hide();
			$(this).parents('h2').next('form').find('.coexit').show();
			$(this).hide();
			
			})
		/*相册JS*/
		$('.mbAlbum li').hover(function(){
			$(this).find('.mm-png-24').show();
			$(this).find('.mm-photo-tool').show();
			},function(){
				$(this).find('.mm-png-24').hide();
			$(this).find('.mm-photo-tool').hide();
				})
		/*文章图片*/
		$('.articleImg ul li').hover(function(){
			$(this).find('.articleglay').toggle();
			})
		}
		/*视频*/
		$('.xiuxiubox li').hover(function(){
			$(this).find('.xiuxiuGray').toggle();
			$(this).find('.mm-png-24').toggle();
			$(this).find('.mm-photo-tool').toggle();
			})

		/*select*/
		$('.contedit').click(function(event){
			  event.stopPropagation();  //阻止事件冒泡
			  $(this).find(".setbox").toggle();
			  $(this).parent().siblings().find(".setbox").hide();
			})
		$(document).click(function(event){
			var eo = $(event.target);
			if($(".contedit").is(":visible") && eo.attr("class")!="option" && !eo.parent(".setbox").length)	
			$(".setbox").hide();
		})
		$(".setbox a").click(function(){
			var value = $(this).text();
			$(this).parent().parent().siblings(".selestyle").text(value);
		})

		/*三围select*/
		$('.mm-p-menuWarp .mm-p-text').hover(function(event){
			event.stopPropagation();  //阻止事件冒泡
			$(this).toggleClass('enter');
			$(this).siblings('.mm-p-submenu').show();
		    $(this).siblings().find(".mm-p-submenu").hide();
			},function(){
				$(this).siblings().find(".mm-p-submenu").hide();
				})
		$(".mm-p-submenu").mouseleave(function(){
			$(this).hide();
		})
		$(".mm-p-menuWarp").mouseleave(function(){
			$('.mm-p-submenu').hide();
		})
		
		$(document).click(function(event){
			var e = $(event.target);
			if($(".mm-p-menuWarp").is(":visible") && e.attr("class")!="option" && !e.parent(".mm-p-submenu").length)	
			$(".mm-p-submenu").hide();
		})
		$(".mm-p-submenu .mm-p-addbd ul li a").click(function(){
			var value = $(this).text();
			$(this).parent().parent().parent().parent().siblings(".mm-p-text").val(value);
			
		})

		/*相册展示页面*/
		$('.mm-photoW-cell-middle').hover(function(){
			$(this).find('.mm-png-24').toggle();
			$(this).find('.mm-photo-tool').toggle();
			$(this).find('.mm-cover').toggle()
			
			})
		$('#Expantool').click(function(){
			$('#Expanphoto').show();
			$(this).hide();
			$('#J_JsonPanel').show();
			$('#J_Photo_fall').hide();
			})
		$('#Expanphoto').click(function(){
			$('#Expantool').show();
			$(this).hide();
			$('#J_Photo_fall').show();
			$('#J_JsonPanel').hide();
			
			})
		$('.mm-photoW-cell').hover(function(){
			$(this).find('.mm-photo-tool').toggle();
			})
		/*我的模卡*/
		$('.wallno1 li').hover(function(){
			$(this).find('.mm-png-24').toggle();
			$(this).find('.mm-photo-tool').toggle();
			})
		/*我的秀友*/
		$('.wdxy ul li').hover(function(){
			$(this).find('.mm-png-24').toggle();
			$(this).find('.mm-photo-tool').toggle();
			})
		/*简历库select*/
		$('.search_city').click(function(){
			$(this).find('.zhankai').toggle();
			})
		$('.search_city').hover(function(){
			$(this).find('.selectlist').toggle();
			$(this).find('span').toggleClass('active');
			})
		$('.search_city .close').click(function(){
			$('#divLiveCity').hide();
			})
		$('#simplecondition').click(function(){
			$('#complex').toggle();
			$('#complexcondition').show();
			$(this).hide();
			})
		/*机构首页我要报名提示已经报名*/
		$('#commBtn').click(function(){
			$('#commShow').toggle();
			})
		/**/
		$('.showhideBtn').click(function(){
			$(this).next('.showhide').show();
			$(this).hide();
			})
		/*报名
		 $('.baoming').click(function(event){
        $('.join').css({'display':'block'});
		$('.ks-ext-mask').show();
        $('.update').animate({'opacity':"1.0"},500);
        event.stopPropagation();
        show = true;
   	 });*/

		$('.close').click(function(){
			$('.update').animate({'opacity':"0.0"},function(){
				$('.join').css({'display':'none'},600)
				$('.ks-ext-mask').hide();
			});
		});
		/*alert前台页面*/
		$('.mm-p-left').hover(function(){
			$(this).find('.mm-p-model-info').toggleClass('hover');
			$(this).find('.mbPopularity').toggle();
			})
		/*tab*/
		$('.xinxi-title li').click(function(){
			var i=$('.xinxi-title li').index(this);
			$(this).parents('.mtabContentBox').find('.mtabContent').hide();
			$(this).parents('.mtabContentBox').find('.mtabContent').eq(i).show();
			$(this).addClass('hover');
			})
		/*注册切换*/
		$('.regMenu span').click(function(){
			var i=$('.regMenu span').index(this);
			$('.regMenu span').removeClass('active').eq(i).addClass('active');
			$(this).parent().next().find('.regCon').hide().eq(i).show();
			})
		closebox()
})

function rewordTip(title,url,jifenimg){//标题 链接 图标
	var tipTimer;
	var tip = '<a href="'+url+'" target="_blank" onclick="removeDiv()">'+title+'</a>';
	var lightCss = '<style type="text/css">.lightCss1{background-image: linear-gradient(0deg,rgba(255,255,255,0),rgba(255,255,255,0.5),rgba(255,255,255,0));} .lightCss2{width: 68px;height: 68px;position: absolute;top: 0px;left: -68px;-webkit-transform: skew(-25deg);background-image: -webkit-linear-gradient(0deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.90), rgba(255, 255, 255, 0));-webkit-transition: 0.8s;transition: 0.8s;}</style>';
	var wd=$(window).width()/2;
	var hd=$(window).height()/2;
	
	$(document.body).append('<div class="myDivBig"></div>'+lightCss);
	$(".myDivBig").css({width:"354px",height:"76px",left:wd-354/2,top:hd-76,position:"absolute",zIndex:"100",overflow:"hidden"});
	$(".myDivBig").append('<div class="myDiv"></div>');
	$(".myDiv").css({width:"340px",height:"62px",padding:"5px",background:"#fff",border:"2px solid #c200a3",borderRadius:"5px",position:"absolute",zIndex:"101",bottom:"-77px"});
	$(".myDiv").append('<i id="ilight" class="lightCss1 lightCss2"></i><div class="textDiv"></div>');
	$(".textDiv").css({padding:"5px 10px",float:"left"});
	$(".textDiv").append('<p></p>')
	$("p",".textDiv").css({lineHeight:"25px"});
	$(".textDiv").append('<strong></strong>');
	$("strong",".textDiv").html(tip);
	$("a",".textDiv").css({lineHeight:"30px",fontSize:"16px",color:"#c200a3", textDecoration:"none"});
	$(".myDiv").append('<div class="picDiv"></div>');
	$(".picDiv").css({padding:"3px 10px",float:"right",marginRight:"10px"});
	$(".picDiv").html('<img src="images/'+jifenimg+'.jpg"/>');
	$(".myDiv").append('<i class="closed"></i>');
	$(".closed").css({position:"absolute",right:"5px",width:"13px",height:"13px",cursor:"pointer",backgroundImage:"url('/images/closedBtn.gif?11')"});
	$("i.closed").on("click",function(){removeDiv();});
	$(".myDiv").animate({bottom: 0}, 1000,"linear",function(){
		tipTimer = setTimeout("removeDiv()",2000);	
		$("#ilight").animate({left: 422}, 800);
	});
	$(".myDiv").on("mouseenter",function(){
		clearTimeout(tipTimer);
	});
	$(".myDiv").on("mouseleave",function(){
		tipTimer = setTimeout("removeDiv()",2000);
	});
}
function removeDiv()
{
	$(".myDiv").animate({bottom: -77}, 1000,"linear",function(){
		$(".myDivBig").remove();
	});
}
