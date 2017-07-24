$(document).ready(function(){
	$('time').each(function(i, e) {
		var datetime = moment($(e).attr('datetime'), 'YYYY-MM-DD HH:mm:ss');
		$(e).attr('datetime', datetime.format('YYYY-MM-DD'));
		transformDate($(e).children("span"));
	});
});

function transformDate(elem){
	var a = moment();
	var b = moment(elem.html());

	if(a.diff(b, 'seconds')<60){
		if(a.diff(b, 'seconds')<30)
			elem.html("il y a quelques secondes");
		else elem.html("il y a " + a.diff(b, 'seconds') + " sec");
	}
	else if(a.diff(b, 'minutes')<60)
		elem.html("il y a " + a.diff(b, 'minutes') + " min");
	else if(a.diff(b, 'hours')<24)
		elem.html("il y a " + a.diff(b, 'hours') + " h");
	else if(a.diff(b, 'days')<=30){
		if(a.diff(b, 'days') == 1)
			elem.html("hier, à " +  moment(elem.html()).format("HH[ h ]MM"));
		else if(a.diff(b, 'days')<7)
			elem.html(moment(elem.html()).format("dddd, à HH[ h ]MM"));
		else elem.html("le " + moment(elem.html()).format("DD MMMM, à HH[ h ]MM"));
	}
	else if(a.diff(b, 'months')<12){
		elem.html("le " + moment(elem.html()).format("DD MMMM, à HH[ h ]MM"));
	}
	else elem.html(moment(elem.html()).format("DD MMMM YYYY"));
}
