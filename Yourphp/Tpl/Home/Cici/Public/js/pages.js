//下拉框
function down_arrow_hover(a,b,c,d,e){
	var ele_a = $('#'+a);
	var ele_b = ele_a.find('.'+b);
	ele_b.hover(function(){
		var _this = $(this);
		_this.find('.down_arrow').addClass(c);
		_this.addClass(d);
		_this.parent().addClass(d);
		_this.next().removeClass(e);
		var down_menu = _this.parent();
		down_menu.find('.hover_leave').hover(function(){
			_this.find('.down_arrow').removeClass(c);
			_this.parent().removeClass(d);
			_this.removeClass(d);
			_this.next().addClass(e);
		});
		down_menu.mouseleave(function(){
			_this.find('.down_arrow').removeClass(c);
			_this.parent().removeClass(d);
			_this.removeClass(d);
			_this.next().addClass(e);
		});
	});
}

down_arrow_hover('down_arrow_span','nameX','up_arrow','hover','none');

//隐藏最后一个border
function hide_last_border(a,b,c,d){
	var $ele_a = $('.'+a);
	var $ele_b = $ele_a.find(b);
	var $ele_b_size = $ele_b.size();
	j = Math.ceil($ele_b_size / c) ;
	for( var i = 1 ; i<= j ;i++ ){
		$ele_b.eq(i*c - 1).addClass(d);
	}
}
hide_last_border('pr_list01','li',3,'noMargin');

function ele_click(a,b,c){
	var	ele_a = $('#'+a);
	ele_a.find(b).click(function(){
		$(this).addClass(c).siblings().removeClass(c);
	});
}
ele_click('click_exchange','a','active');

function ele_hover(a,b,c){
	var	ele_a = $('.'+a);
	ele_a.find(b).hover(function(){
		$(this).addClass(c).parent().siblings().find(b).removeClass(c);
	});
}
ele_hover('nav_ul','a','hover_bg');


function ele_hover_change(a,b,c,d,e){
	var ele_a = $('.'+a);
	ele_a.find(b).hover(function(){
		var _index = $(this).index();
		$(this).addClass(e).siblings().removeClass(e);
		ele_a.parent().find('.'+c).eq(_index).removeClass(d).siblings().addClass(d);
	});
}
ele_hover_change('change_ul','li','change_list','none','active');
ele_hover_change('change_ul01','li','change_list','none','active');


function startmarquee(lh,speed,delay,index){ 
				var t; 
				var p=false; 
				var o=document.getElementById("marqueebox"+index); 
				o.innerHTML+=o.innerHTML; 
				o.onmouseover=function(){p=true} 
				o.onmouseout=function(){p=false} 
				o.scrollTop = 0; 
				function start(){ 
					t=setInterval(scrolling,speed); 
					if(!p) o.scrollTop += 2; 
				} 
				function scrolling(){ 
					if(o.scrollTop%lh!=0){ 
						o.scrollTop += 2; 
						if(o.scrollTop>=o.scrollHeight/2) o.scrollTop = 0; 
					}else{ 
						clearInterval(t); 
						setTimeout(start,delay); 
					} 
				} 
				setTimeout(start,delay); 
} 
startmarquee(30,50,3000,0); 
/**startmarquee(一次滚动高度,速度,停留时间,图层标记);**/ 
//--> 

(function($){
	$.fn.extend({
		"slidelf":function(value){
			value = $.extend({
				"prev":"",
				"next":"",
				"speed":""	
			},value)
			
			var dom_this = $(this).get(0);	//将jquery对象转换成DOM对象;以便其它函数中调用；
			var marginl = parseInt($("ul li:first",this).css("margin-left")); //每个图片margin的数值
			var movew = $("ul li:first",this).outerWidth()+marginl;	//需要滑动的数值
			
			//左边的动画
			function leftani(){
				$("ul li:first",dom_this).animate({"margin-left":-movew},value.speed,function(){
						$(this).css("margin-left",marginl).appendTo($("ul",dom_this));	
				});	
			}
			//右边的动画
			function rightani(){
				$("ul li:last",dom_this).prependTo($("ul",dom_this));
				$("ul li:first",dom_this).css("margin-left",-movew).animate({"margin-left":marginl},value.speed);
			}
			
			//点击左边
			$("."+value.prev).click(function(){
				if(!$("ul li:first",dom_this).is(":animated")){
					leftani();
				}	
			});
			function Marquee(){
				$("."+value.prev).trigger('click');
			}
			var MyMar=setInterval(Marquee,2000);
			$('#demo').mouseover(function(){
				clearInterval(MyMar);
			});
			$('#demo').mouseout(function(){
				MyMar=setInterval(Marquee,2000);
			});
			//点击左边
			$("."+value.next).click(function(){
				if(!$("ul li:first",dom_this).is(":animated")){
					rightani();
				}	
			})
		}	
	});	
})(jQuery)

$(function(){
	$("#demo").slidelf({
		"prev":"left-arrow",
		"next":"right-arrow",
		"speed":1000
	});

})


