jQuery(function($){"use strict";!function(){var e=$("#basic"),n=e.children("ul").eq(0),a=e.parent();e.sly({horizontal:1,itemNav:"basic",smart:1,activateOn:"click",mouseDragging:1,touchDragging:1,releaseSwing:1,startAt:3,scrollBar:a.find(".scrollbar"),scrollBy:1,pagesBar:a.find(".pages"),activatePageOn:"click",speed:300,elasticBounds:1,easing:"easeOutExpo",dragHandle:1,dynamicHandle:1,clickBar:1,forward:a.find(".forward"),backward:a.find(".backward"),prev:a.find(".prev"),next:a.find(".next"),prevPage:a.find(".prevPage"),nextPage:a.find(".nextPage")}),a.find(".toStart").on("click",function(){var n=$(this).data("item");e.sly("toStart",n)}),a.find(".toCenter").on("click",function(){var n=$(this).data("item");e.sly("toCenter",n)}),a.find(".toEnd").on("click",function(){var n=$(this).data("item");e.sly("toEnd",n)}),a.find(".add").on("click",function(){e.sly("add","<li>"+n.children().length+"</li>")}),a.find(".remove").on("click",function(){e.sly("remove",-1)})}(),function(){var e=$("#centered"),n=e.parent();e.sly({horizontal:1,itemNav:"centered",smart:1,activateOn:"click",mouseDragging:1,touchDragging:1,releaseSwing:1,startAt:4,scrollBar:n.find(".scrollbar"),scrollBy:1,speed:300,elasticBounds:1,easing:"easeOutExpo",dragHandle:1,dynamicHandle:1,clickBar:1,prev:n.find(".prev"),next:n.find(".next")})}(),function(){var e=$("#forcecentered"),n=e.parent();e.sly({horizontal:1,itemNav:"forceCentered",smart:1,activateMiddle:1,activateOn:"click",mouseDragging:1,touchDragging:1,releaseSwing:1,startAt:0,scrollBar:n.find(".scrollbar"),scrollBy:1,speed:300,elasticBounds:1,easing:"easeOutExpo",dragHandle:1,dynamicHandle:1,clickBar:1,prev:n.find(".prev"),next:n.find(".next")})}(),function(){var e=$("#cycleitems"),n=e.parent();e.sly({horizontal:1,itemNav:"basic",smart:1,activateOn:"click",mouseDragging:1,touchDragging:1,releaseSwing:1,startAt:0,scrollBar:n.find(".scrollbar"),scrollBy:1,speed:300,elasticBounds:1,easing:"easeOutExpo",dragHandle:1,dynamicHandle:1,clickBar:1,cycleBy:"items",cycleInterval:1e3,pauseOnHover:1,prev:n.find(".prev"),next:n.find(".next")}),n.find(".pause").on("click",function(){e.sly("pause")}),n.find(".resume").on("click",function(){e.sly("resume")}),n.find(".toggle").on("click",function(){e.sly("toggle")})}()});