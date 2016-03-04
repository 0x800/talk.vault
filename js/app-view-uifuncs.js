var keepPos;
var lastTrigger;
jQuery.fn.clearable = function(){
	function tog(v){return v?'addClass':'removeClass';} 
	$(this).addClass("clearable");
	$(this).on('input', function(){
		$(this)[tog(this.value)]('x');
	})
	$(this).mousemove(function(e){
		if($(this).hasClass("x")){
			$(this)[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');
		}
	})
	$(this).click(function(){
		if($(this).hasClass("onX")){
			$(this).removeClass('x onX').val('');
			$(this).trigger("keyup");
		}
	});
};
jQuery.fn.popover = function(obj){
	var triggerElement = $(this);
	var popover = obj;
	$("body").unbind("click.dismissPopover");
	keepPos = function(){
		if(triggerElement.is(":hidden"))
			return;
		if(popover.hasClass("popoverBottom")){
			var top = triggerElement.offset().top - triggerElement.outerHeight()/2 - popover.outerHeight();
		} else if(popover.hasClass("popoverRight") || popover.hasClass("popoverLeft")){
			var top = triggerElement.offset().top - popover.outerHeight()/2 + triggerElement.outerHeight()/2;
		} else {
			var top = triggerElement.offset().top + triggerElement.outerHeight() + 8;
		}
		if(popover.hasClass("popoverRight")){
			var left = triggerElement.offset().left + triggerElement.outerWidth() + 8;
		} else {
			var left = triggerElement.offset().left + (triggerElement.width()/2) - (popover.outerWidth()/2);
		}
		
		var leftCorrection = 0;
		var topCorrection = 0;
		if($(window).width()-left-popover.outerWidth() < 20){
			leftCorrection = 20 - ($(window).width()-left-popover.outerWidth());
		}
		if(top < 20){
			topCorrection -= 20 - top;
		}
		left -= leftCorrection;
		top -= topCorrection;
		
		popover.css("top", top);
		popover.css("left", left);
		if(popover.hasClass("popoverBottom")){
			// nothing
		} else if(popover.hasClass("popoverRight")){
			popover.find(".popoverCaret").css("top", popover.outerHeight()/2 - 8 + topCorrection);
		} else {
			var caretTop = top-16;
			popover.find(".popoverCaret").css("top", caretTop-top);
		}
		if(!popover.hasClass("popoverRight")){
			var caretLeft = triggerElement.offset().left + (triggerElement.width()/2) - left - 8;
			popover.find(".popoverCaret").css("left", caretLeft);
		}
	}
	
	$("body").on("mousedown.dismissPopover", function(event){
		if($(event.target).parents(".popover").length == 0 && !(($(event.target).is(triggerElement)) || $(triggerElement).children().is(event.target))){
			$("div[data-popover='true']").fadeOut().attr("data-popover", "");
			if(lastTrigger)
				lastTrigger.removeClass("active");
			keepPos = null;
			$("body").unbind("mousedown.dismissPopover");
		}
	});
	
	if(popover.attr("data-popover")){
		popover.fadeOut();
		triggerElement.removeClass("active");
		popover.attr("data-popover", "");
		keepPos = null;
	} else {
		$("div[data-popover='true']").fadeOut().attr("data-popover", "");
		if(lastTrigger)
			lastTrigger.removeClass("active");
		popover.finish().fadeIn();
		keepPos();
		triggerElement.addClass("active");
		popover.attr("data-popover", "true");
	}
	lastTrigger = triggerElement;
};
var activeModal;
$(document).ready(function(){
	$("#overlay,#modalClose").click(function(){
		(activeModal && $.modal('', 'hide'));
	});
	$("#modal").draggable();
});
function keepPosModals(){
	if(activeModal){
		var left = window.innerWidth/2 - activeModal.outerWidth()/2;
		if(window.innerWidth < 400)
			left = 0;
		var top = window.innerHeight/2 - activeModal.outerHeight()/2;
		activeModal.css({left: left+"px", top: top+"px"});
	}
}
jQuery.fn.moveCaretToEnd = function(){
	var el = $(this)[0];
    if (typeof el.selectionStart == "number") {
        el.selectionStart = el.selectionEnd = el.value.length;
    } else if (typeof el.createTextRange != "undefined") {
        el.focus();
        var range = el.createTextRange();
        range.collapse(false);
        range.select();
    }
}
jQuery.fn.draggable = function(){
	var dragging = false;
	var lastPos = [0,0];
	$(this).mousedown(function(event){
		if(event.target.tagName == "SELECT" || event.target.tagName == "P" || event.target.tagName == "SPAN" || event.target.tagName == "PRE")
			return;
		if(event.which===1){
			dragging = true;
			lastPos = [event.pageX, event.pageY];
		}
		var element = $(this)[0];
		$("body").on("mousemove.videoPanelDrag", function(event){
			var diffX = event.pageX - lastPos[0];
			var diffY = event.pageY - lastPos[1];
			var curX = parseInt(element.style.left.split("px")[0]);
			var curY = parseInt(element.style.top.split("px")[0]);
			element.style.left = (curX+diffX) + "px";
			element.style.top = (curY+diffY) + "px";
			lastPos = [event.pageX, event.pageY];	
		});
	});
	$(this).mouseup(function(){
		dragging = false;
		$("body").unbind("mousemove.videoPanelDrag");
	});
}
jQuery.modal = function(ref, state){
	var thisModal = $("#modal");
	if(!$(thisModal).is(":visible") && (!state || state == 'show')){
		activeModal = $(thisModal);
		thisModal.find("div[data-ref]").hide();
		thisModal.find("div[data-ref='" + ref + "']").show();
		$(thisModal).fadeIn(425);
		$("#overlay").css({"opacity": 0.5, "z-index": 10000});
		keepPosModals();
	} else if($(thisModal).is(":visible") && (!state || state == 'hide')){
		$(thisModal).fadeOut(425, function(){
			$("#overlay").css("z-index", -100);
		});
		$("#overlay").css("opacity", 0);
	}
}
jQuery.fn.shake = function(intShakes, intDistance, intDuration) {
	if(!intShakes)
		intShakes = 2; intDistance = 10; intDuration = 400;
    this.each(function() {
        $(this).css("position","relative"); 
        for (var x=1; x<=intShakes; x++) {
        $(this).animate({left:(intDistance*-1)}, (((intDuration/intShakes)/4)))
    .animate({left:intDistance}, ((intDuration/intShakes)/2))
    .animate({left:0}, (((intDuration/intShakes)/4)));
    }
  });
return this;
};
var baseFaviconImage = new Image();
baseFaviconImage.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAACuFBMVEW26+iX497///8ADgD7/v4AmYW97eqG4Nqq6OSG39m26+ij5uKx9fFwvLfB+vaW5N6i8u11wLu57Ol53da06+iD4Nq36+grWFbq//+O//qCOkCL7OXb//8AAACk2tdzurVHR15GRl5ERF7h4cw8PFU6OlVHR140NFCR4dyw6uaP4duF3tiq6OSl5+KK39q26+i26+jA7ett2NCF3tiI4dun5+Oq6OS67Ol93NaF3tiG39mv6eat6OWS4NuI0s6j5+Ki5eGM3tiF1M+26+i37Om06+eL4NuE4duj5uKW496s6eWn5+OI4NqF4tyG4Nqw6ea46+h7z8l6lJNOtK2s6OR7zci+///AAACs4d5ts6+p7Oi06ueL3tiF7OWf3NhvtrK1//+Fur2X5N9uvrm37OmB2tSF3tl0wr241MaUx8ed1NKCu7i46OZxubWI2dJ8vriCwbpYVWlCQ1tsaHuQkpmOkphXUWGKxsZ2u7bS2sp+w712uLLU1sPf3cnP1cNGRl1ZWnCQjZM2MkR8paim2M7z7t7Q2cfe3Mjb28dHR15HR15CQ1ttbXxpaHM6OVK72N2pydHMzMTz8eDe28fa28fb28fb28dHR15JSWFISGBISGFoaXWmmsOmmMhHR005OVNERF1CQlrb28dISF9GRl1JSWBISF9OUF5AQU1ISF9vb3rV1cPb28dHR15HR15HR15HR15HR15AQFVIRmtEQmtJSmBISGBISF95eYHLy7zb28dHR15HR15HR19FRllRT3VNSXRFRllHR19HR15HR1616+iI3den5+OF29Wp2NZ5vLed1tJ0uLSf5OB5xL+37eqL4tyT4dx6xcCg5eCHzces3tt+yMN/2NN0wLur4+B4vLlJSWCNioyc8ehuw73T3c/a28d4d4KgoaBHR19nYplaU5FJSGD///9+5bo8AAAAxXRSTlMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEBAAABAQACAQACAAACAAACAAAICgAACgoAA03l6loHB1zs6VIDAcXYBADSzgAA0OIfeIEd19wFA8DLqLPDywIEV3DA129lBAdu3v3/4fD35f395nwMfPz////////8jn7PxMq+2/7+477KxM6MAQM77P/8/P32UwMAAQEFi/v7qgQBAQAAASZCPz8/P0ItAQAAAAIDAwMDAwMCAHSmbD4AAAABYktHRAJmC3xkAAAAB3RJTUUH3wQMFCkU1VldGAAAARVJREFUGNNjYNBg1NRiYtbWYWHV1WNj0mbQZzAwNDJmNzHlMDO3sOS0YuCy5rax5bHj5bPnd3AUcBJkcBZycXVzF/bwFPHy9vEV9WPwFws4eiwwSDxYIuT4iVDJMIZwqYiTpyKjomNi406fiU+QZkiUSTp7Ljnl/IXUtIuX0mUzGDLlsi5fyc65ei037/qNfPkChsKi4pLSsvKbtyoqq6prausY6m83NN5par57r6X1flv7gw6Gzq7unt6+h/0THk2cNHnK1GkM0xVmKM6cNXvO3HnzFygtVF7EsHjJUpVlj5c/ebri2UrVVavXMKxdt15tw8ZNm7ds3bZdfcfOXQyyaIBBVmG3wp69+/YfOHjosMIRBVkAmnZqfX3znW4AAAAldEVYdGRhdGU6Y3JlYXRlADIwMTUtMDQtMTJUMjA6NDE6MjAtMDQ6MDB99eTrAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDE1LTA0LTEyVDIwOjQxOjIwLTA0OjAwDKhcVwAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAAASUVORK5CYII=";

setTimeout(function(){
	setFaviconBadge(0); // reset favicon on page load
}, 1); // Firefox workaround

function canvasLoadImage(context, src){
	var imageObj = new Image();
	imageObj.onload = function() {
	  context.drawImage(this, 0, 0);
	}
	imageObj.src = src;
}
function setFaviconBadge(badgeNumber){
	var faviconCanvas = document.createElement('canvas');
	faviconCanvas.width = 16;
	faviconCanvas.height = 16;
	var ctx = faviconCanvas.getContext('2d');
	ctx.drawImage(baseFaviconImage, 0, 0);
	
	// ASCII charCodes 90 -> 121 = 0 to 31 (5 bit, bit=1 means paint)
	var numberMasks = ['', '^`_^^^y', 'hkjf\\[y', 'hkjfjkh', 'kkkxjjj', 'y[[ijji', 'hk[ikkh', 'yjjb^^^', 'hkkhkkh', 'hkkxjjj', 'Z^^y^^Z'];
	
	if(badgeNumber != 0){
		ctx.fillStyle = '#FF955A';
		ctx.fillRect(9,7,7,9);
		
		ctx.fillStyle = '#FFFFFF';
		
		var numberMask = numberMasks[Math.min(badgeNumber, 10)];
		for(var i = 0; i < 7; i++){
			var currentMask = numberMask.charCodeAt(i)-90;
			if(currentMask & 1) ctx.fillRect(10,8+i,1,1);
			if(currentMask & 2) ctx.fillRect(11,8+i,1,1);
			if(currentMask & 4) ctx.fillRect(12,8+i,1,1);
			if(currentMask & 8) ctx.fillRect(13,8+i,1,1);
			if(currentMask & 16) ctx.fillRect(14,8+i,1,1);
		}
	}
	var imgDataUrl = faviconCanvas.toDataURL();
	$('#favicon').remove();
	var newFavicon = document.createElement('link');
	newFavicon.setAttribute('id', 'favicon');
	newFavicon.setAttribute('rel', 'icon');
	newFavicon.setAttribute('type', 'image/png');
	newFavicon.setAttribute('href', imgDataUrl);
	document.head.appendChild(newFavicon);
}
var titleAlertInterval = -1;
var originalTitle = "";
function startTitleAlert(title){
	originalTitle = title;
	clearInterval(titleAlertInterval);
	titleAlertInterval = setInterval(function(){
		if(document.title == originalTitle){
			document.title = "** " + originalTitle;
		} else {
			document.title = originalTitle;
		}
	}, 700);
}
function stopTitleAlert(){
	clearInterval(titleAlertInterval);
	document.title = originalTitle;
}
// Prevent the backspace key from navigating back.
var lastKeypressTime;
$(document).bind('keydown', function (event) {
    var doPrevent = false;
    if(!event.ctrlKey && !event.shiftKey)
		lastKeypressTime = new Date().getTime();
    if (event.which === 8) {
        var d = event.srcElement || event.target;
        if ((d.tagName.toUpperCase() === 'INPUT' && 
             (
                 d.type.toUpperCase() === 'TEXT' ||
                 d.type.toUpperCase() === 'PASSWORD' || 
                 d.type.toUpperCase() === 'FILE' || 
                 d.type.toUpperCase() === 'EMAIL' || 
                 d.type.toUpperCase() === 'SEARCH' || 
                 d.type.toUpperCase() === 'DATE' )
             ) || 
             d.tagName.toUpperCase() === 'TEXTAREA') {
            doPrevent = d.readOnly || d.disabled;
        }
        else {
            doPrevent = true;
        }
    }

    if (doPrevent) {
        event.preventDefault();
    }
});
// Ask for confirmation when closing tab if typed recently
window.onbeforeunload = function(event){
	if(!getProp("disableConfirmClosing") && appcore.profileBlob.props){
		if(lastKeypressTime > new Date().getTime() - 1.5 * 60 * 1000)
			return "Exit Subrosa?";
	}
}
