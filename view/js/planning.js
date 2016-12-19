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
	// evenement == null : ajout d'un nouvel evenement
	
    if (evenement == null){
		id = -1; description = ""; start = null; end = null;
    }else{
		id = evenement.id;
		description = evenement.title;
		start = evenement.start.format();
		if (evenement.end != null){
			end = evenement.end.format();
		}else{
			end = evenement.start.format();
		}
    }
    
    // créér une popup de modification
	
    
}

// fonction pour caché le planning modifiable
function cacher(){
    // supprime la popup
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
	// evenement == null : planning modifier via les champs de modifications
	// evenement != null : planning modifié via le js du planning
	// id < 0 : nouvelle evenement
	// id >+ 0 / evenement modifié 
	
	if (evenement == null){
		// recuperer les champs de description
		/*id = ;
		description = ;
		start = ;
		end = ;*/
	}else{
		id = evenement.id;
		description = evenement.title;
		start = evenement.start.format();
		if (evenement.end != null){
			end = evenement.end.format();
		}else{
			end = evenement.start.format();
		}
	}

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
	    if(xhttp.readyState === XMLHttpRequest.DONE){
			if (xhttp.status === 200){

				if (evenement == null){
					if (id >= 0){
						$('#calendar').fullCalendar( 'removeEvents' ,id);
					}else{
						id = this.responseText;
					}
					$('#calendar').fullCalendar( 'addEventSource', 
						{
						id: id,
						title: description,
						start: start,
						end: end
						}
					);
				}

				cacher();
			}else{
				serverLost();
			}
	    }
	};

	xhttp.open("POST", "planning-modifie.php", true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	
	if (id < 0){
		xhttp.send("action=addevenement&id="+id+"&description="+description+"&start="+start+"&end="+end);
	}else{
		xhttp.send("action=updateevenement&id="+id+"&description="+description+"&start="+start+"&end="+end);
	}
	
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