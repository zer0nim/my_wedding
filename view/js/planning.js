// javascript pour le planning

/*
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function(){
if(xhttp.readyState === XMLHttpRequest.DONE){
    if (xhttp.status === 200){
	var reponse = this.responseText; reponse = array d'objet évenement en string
    }
}

xhttp.open("POST", "../controller/planning-get-events.php", true);
xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhttp.send("");
*/

$(document).ready(function() {
    $('#calendar').fullCalendar({

	header: {
	    left: 'prev,next today',
	    center: 'title',
	    right: 'month,listWeek,listDay'
	},

	// customize the button names,
	// otherwise they'd all just say "list"
	views: {
	    listDay: { buttonText: 'list day' },
	    listWeek: { buttonText: 'list week' }
	},

	defaultView: 'month',
	defaultDate: '2016-12-09',
	navLinks: true, // can click day/week names to navigate views
	editable: true,
	eventLimit: true, // allow "more" link when too many events
	
	events: [
	    {
		    title: 'All Day Event',
		    start: '2016-12-09'
		    //end
		    //id
		    //url
	    },
	    {
		    title: 'Long Event',
		    start: '2016-12-09',
		    end: '2016-12-10'
	    },
	    {
		    id: 999,
		    title: 'Repeating Event',
		    start: '2016-12-11T16:00:00'
	    },
	    {
		    id: 999,
		    title: 'Repeating Event',
		    start: '2016-12-09T16:00:00'
	    },
	    {
		    title: 'Conference',
		    start: '2016-12-11',
		    end: '2016-12-13'
	    },
	    {
		    title: 'Meeting',
		    start: '2016-12-12T10:30:00',
		    end: '2016-12-12T12:30:00'
	    },
	    {
		    title: 'Lunch',
		    start: '2016-12-12T12:00:00'
	    },
	    {
		    title: 'Meeting',
		    start: '2016-12-12T14:30:00'
	    },
	    {
		    title: 'Happy Hour',
		    start: '2016-12-12T17:30:00'
	    },
	    {
		    title: 'Dinner',
		    start: '2016-12-12T20:00:00'
	    },
	    {
		    title: 'Birthday Party',
		    start: '2016-12-13T07:00:00'
	    },
	    {
		    title: 'Click for Google',
		    url: 'http://google.com/',
		    start: '2016-12-28'
	    },
	    {
		    title: 'Test d\'évenement',
		    start: '2016-12-09'
	    }
	]
    });
});