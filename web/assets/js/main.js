$(document).ready(function() {
	$('time').each(function(i, e) {
		var datetime = $(e).attr('datetime');
		$(e).children("span").html(transformDate(datetime, 'YYYY-MM-DD HH:mm:ss'));
		$(e).attr('datetime', moment(datetime, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD'));
	});

	truncateText();
});

function transformDate(string, format) {
	var a = moment();
	var b = moment(string, format);

	if(a.diff(b, 'seconds')<60){
		if(a.diff(b, 'seconds')<30)
			string = "il y a quelques secondes";
		else string = "il y a " + a.diff(b, 'seconds') + " sec";
	}
	else if(a.diff(b, 'minutes')<60)
		string = "il y a " + a.diff(b, 'minutes') + " min";
	else if(a.diff(b, 'hours')<24)
		string = "il y a " + a.diff(b, 'hours') + " h";
	else if(a.diff(b, 'days')<=30){
		if(a.diff(b, 'days') == 1)
			string = "hier, à " +  b.format("HH[ h ]mm");
		else if(a.diff(b, 'days')<7)
			string = b.format("dddd[, à ]HH[ h ]mm");
		else string = "le " + b.format("DD MMMM[, à ]HH[ h ]mm");
	}
	else if(a.diff(b, 'months')<12){
		string = "le " + b.format("DD MMMM[, à ]HH[ h ]mm");
	}
	else string = b.format("DD MMMM YYYY");

	return string;
}

function truncateText() {
	var showChar = 280;
	var ellipsestext = "...";
	var moretext = "Voir plus";
	var lesstext = "Fermer";


	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar, content.length - showChar);

			var html = c + '<span class="moreellipses">' + ellipsestext + ' </span><span class="morecontent"><span>' + h + '</span> <a href="" class="morelink">' + moretext + '</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
}

//
// Auto-size input
// from https://github.com/yuanqing/autosize-input
//

$(document).ready(function() {
	(function(){var t=/\s/g;var e=/>/g;var n=/</g;function i(i){return i.replace(t,"&nbsp;").replace(e,"&lt;").replace(n,"&gt;")}var r="__autosizeInputGhost";function o(){var t=document.createElement("div");t.id=r;t.style.cssText="display:inline-block;height:0;overflow:hidden;position:absolute;top:0;visibility:hidden;white-space:nowrap;";document.body.appendChild(t);return t}var a=o();function d(t,e){var n=window.getComputedStyle(t);var d="box-sizing:"+n.boxSizing+";border-left:"+n.borderLeftWidth+" solid black"+";border-right:"+n.borderRightWidth+" solid black"+";font-family:"+n.fontFamily+";font-feature-settings:"+n.fontFeatureSettings+";font-kerning:"+n.fontKerning+";font-size:"+n.fontSize+";font-stretch:"+n.fontStretch+";font-style:"+n.fontStyle+";font-variant:"+n.fontVariant+";font-variant-caps:"+n.fontVariantCaps+";font-variant-ligatures:"+n.fontVariantLigatures+";font-variant-numeric:"+n.fontVariantNumeric+";font-weight:"+n.fontWeight+";letter-spacing:"+n.letterSpacing+";margin-left:"+n.marginLeft+";margin-right:"+n.marginRight+";padding-left:"+n.paddingLeft+";padding-right:"+n.paddingRight+";text-indent:"+n.textIndent+";text-transform:"+n.textTransform;function f(e){e=e||t.value||t.getAttribute("placeholder")||"";if(document.getElementById(r)===null){a=o()}a.style.cssText+=d;a.innerHTML=i(e);var n=window.getComputedStyle(a).width;t.style.width=n;return n}t.addEventListener("input",function(){f()});var l=f();if(e&&e.minWidth&&l!=="0px"){t.style.minWidth=l}return f}if(typeof module==="object"){module.exports=d}else{window.autosizeInput=d}})();

	autosizeInput(document.querySelector('#input-episode-number'), { minWidth: true });
	autosizeInput(document.querySelector('#input-episode-part'), { minWidth: true });
	autosizeInput(document.querySelector('#input-episode-slug'), { minWidth: true });
});
