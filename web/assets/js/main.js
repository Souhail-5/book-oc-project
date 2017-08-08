$(document).ready(function() {
	$('time').each(function(i, e) {
		var datetime = $(e).attr('datetime');
		$(e).children('.time-description').html(transformDate(datetime, 'YYYY-MM-DD HH:mm:ss'));
		$(e).attr('datetime', moment(datetime, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD'));
	});

	var current_textarea = $('#comment-textarea').val();
	if (typeof current_textarea !== "undefined") $('#text-length-help').text(current_textarea.length);
	$('#comment-textarea').on('input', function() {
	    $('#text-length-help').text(this.value.length);
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
	var showLineBreak = 4;
	var showChar = 280;
	var ellipsestext = "...";
	var moretext = "Voir plus";
	var lesstext = "Fermer";


	$('.more').each(function() {
		var content = $(this).html();
		var content_splitted = content.split(/\r\n|\r|\n/);
		var nbr_content_lines = content_splitted.length;

		if(content.length > showChar || nbr_content_lines > showLineBreak) {
			if (nbr_content_lines > showLineBreak) {
				var c = content_splitted.slice(0, showLineBreak).join('');
				var h = content_splitted.slice(showLineBreak).join('');
			} else {
				var c = content.substr(0, showChar);
				var h = content.substr(showChar, content.length - showChar);
			}

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
