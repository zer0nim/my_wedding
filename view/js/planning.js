// javascript pour le plannings


// mini doc de ce qu'il y a d'important à savoir
/*
fonction pour supprimer un évenement par son id
$('#calendar').fullCalendar( 'removeEvents' ,idevent );

fonction qui met à jour le planning
$('#calendar').fullCalendar('updateEvents', event);

fonction qui ajoute un evenement
$('#calendar').fullCalendar( 'addEventSource', source ); source = comme dans view

fonction qui retourne un event source par l'id
$('#calendar').fullCalendar( 'getEventSourceById', id );

callback pour si l'utilisateur click sur un événement
eventClick: function(event, element) {
},

// fonction quand un évenemnt est changé de place
eventDrop: function(event, delta, revertFunc) {
},

objet event :
    id
    title
    start
    end
    color
    backgroundColor
    textColor
*/

// fonction pour afficher le planning modifiable
function afficheModifieEvenement(evenement){
    if (evenement == null){
	description = ""; start = null; end = null;
    }else{
	description = evenement.title; start = evenement.start; end = evenement.end;
    }
    
    // créér une popup de modification
    
}

// fonction pour caché le planning modifiable
function cacher(){
    // supprime la popup
}

// fonction pour ajouter un évenement à la bd
function addEvenement(){
	description = ;
	start = ; // récuperer les champs
	end = ;
    
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
	    if(xhttp.readyState === XMLHttpRequest.DONE){
		if (xhttp.status === 200){
		    $('#calendar').fullCalendar( 'addEventSource', 
			{
			id: this.responseText,
			title: description,
			start: start,
			end: end
			}
		    );
		    cacher();
		}else{
		    serverLost();
		}
	    }
	};

	xhttp.open("POST", "planning-modifie.php", true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send("action=addevenement&id=-1&description="+description+"&start="+start+"&end="+end);
}

// fonction pour supprimer un evenement de la bd
function delEvenement(id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
	    if(xhttp.readyState === XMLHttpRequest.DONE){
		if (xhttp.status === 200){
		    $('#calendar').fullCalendar( 'removeEvents' ,id);
		    cacher();
		}else{
		    serverLost();
		}
	    }
	};

	xhttp.open("POST", "planning-modifie.php", true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send("action=delevenement&id="+id);
}

// fonction pour enregister les modifications d'un evenement dans la bd
function modifEvenement(evenement){ // eventobject    
	if (evenement == null){
	    id = ; description = ; start = ; end = ; // recuperer les champs
	}else{
	    id = evenement.id; description = evenement.title; start = evenement.start; end = evenement.end;
	}
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
	    if(xhttp.readyState === XMLHttpRequest.DONE){
		if (xhttp.status === 200){
		    $('#calendar').fullCalendar( 'updateEvents' ,evenement);
		    cacher();
		}else{
		    serverLost();
		}
	    }
	};

	xhttp.open("POST", "planning-modifie.php", true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send("action=updateevenement&id="+id+"&description="+description+"&start="+start+"&end="+end);
}

// function pour si le client pert la connexion avec le serveur web
// (les requettes ne sont pas recus)
function serverLost(){
    swal({
		title: "Erreur",   
		text: "La connexion au serveur à été perdue !\nLes données ne peuvent pas être enregistrées ...",   
		type: "warning",   
		showCancelButton: false,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Ok"
		},  function(){
		// ne rien faire
    });
}