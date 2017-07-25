$(document).ready(function(){
	$('time').each(function(i, e) {
		var datetime = $(e).attr('datetime');
		$(e).children("span").html(transformDate(datetime, 'YYYY-MM-DD HH:mm:ss'));
		$(e).attr('datetime', moment(datetime, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD'));
	});
});

function transformDate(string, format){
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
