// code javascript pour la fontion budget


// variables pour creer des id diférents à chaque ajout de budget ou depense
// les id doivent etre des nombres ...
var idbudadd = -1;
var iddepadd = -1;

var budgetglobale = +document.getElementById("champbudgetglobale").innerHTML;
var budgetglobaledepense = +document.getElementById("budgetglobaledepense").innerHTML;

// initialisation des couleurs pour les budgets dépasées
// ------------------------------------------------
if (budgetglobale - budgetglobaledepense < 0){
	document.getElementById("budgetglobalerestant").style.color = "red";
}

var listebudgetrestant = document.getElementsByClassName("totalrestant");
for (i = 0 ; i < listebudgetrestant.length ; i++){
	if (+listebudgetrestant[i].innerHTML < 0){
		listebudgetrestant[i].style.color = "red";
	}
}
// ------------------------------------------------


// fonction pour mettre à jour le champ budget global
function updatebudgetglobal(){
    document.getElementById("budgetglobaledepense").innerHTML = budgetglobaledepense;
    document.getElementById("budgetglobalerestant").innerHTML = budgetglobale - budgetglobaledepense;
	
	// modification couleur
	if (budgetglobale - budgetglobaledepense >= 0){
		document.getElementById("budgetglobalerestant").style.color = "black";
	}else{
		document.getElementById("budgetglobalerestant").style.color = "red";
	}
}

// fonction pour modifier le budget global
function modifierbudgetglobal(idmariage){
    document.getElementById("boutonmodifierbudgetglobal").innerHTML = "Valider";
    document.getElementById("boutonmodifierbudgetglobal").getAttributeNode("onClick").value = "validerbudgetglobal('"+idmariage+"')";
    $("#champbudgetglobale").replaceWith('<input id="champbudgetglobale" placeholder="prix" class="champ-value" name="value" type="number" min="0" max="2000000000" value="'+document.getElementById("champbudgetglobale").innerHTML+'">');
}


// fonction pour modifier le budget global
function validerbudgetglobal(idmariage){
    var value = +document.getElementById("champbudgetglobale").value;
	if (value < 0){value = 0;}
	if (value > 2000000000){value = 2000000000;}
    var xhttp5 = new XMLHttpRequest();
    xhttp5.onreadystatechange = function(){
        if(xhttp5.readyState === XMLHttpRequest.DONE){
            if (xhttp5.status === 200){
				budgetglobale = value;
				updatebudgetglobal();
				document.getElementById("boutonmodifierbudgetglobal").innerHTML = "Modifier";
				document.getElementById("boutonmodifierbudgetglobal").getAttributeNode("onClick").value = "modifierbudgetglobal('"+idmariage+"')";
				$("#champbudgetglobale").replaceWith('<b id="champbudgetglobale">'+budgetglobale+'</b>');
            }else{
                serverLost();
            }
        }
    };
    
    xhttp5.open("POST", "budget-modifie.php", true);
    xhttp5.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp5.send("action=updatebudgetglobal&idmariage="+idmariage+"&value="+value);
    
}


// fonction qui renvoie la forme html d'une dépense
function getHtmlDepenseModif(id, description, value){
    
    return  '<tr id="'+id+'" class="row">'
                +'<td><p class="btn btn-danger btn-sm" onclick="supp(\''+id+'\')"> X </p></td>'
                +'<td><input class="champ-description-depense" name="'+id+'depdescription" type="text" maxlength="50" value="'+description+'"></td>'
                +'<td class="text-right"><input class="champ-value" name="'+id+'depvalue" type="number" min="0" max="2000000000" value="'+value+'" €></td>'
            +'</tr>';

}


// fonction qui renvoie le forme html d'un budget avec des champs modifiables
function getHtmlBudgetModif(id, idmariage, description, value, tabDepenses){

    var depenses = "";
    for (i = 0 ; i < tabDepenses.length ; i++){
        depenses += getHtmlDepenseModif(tabDepenses[i][0], tabDepenses[i][1], tabDepenses[i][2]);
    }

    return  '<form id="form'+id+'" method="POST" action="budget-modifie.php">'

                +'<div class="row col-sm-12">'
                    +'<p><input placeholder="description" class="champ-description" name="description" type="text" maxlength="35" value="'+description+'"> : <input placeholder="prix" class="champ-value" name="value" type="number" min="0" max="2000000000" value="'+value+'"> €</p>'
                +'</div>'

                +'<table class="row scroll2 form-control">'
                    +'<tr class="row"><th class=""></th><th class="champ-description-depense text-center">Description</th><th class="text-right">Prix</th></tr>'
                    +depenses
                    +'<tr id="idadd'+id+'" class="row"></td><td><td><p class="col-sm-5 col-sm-offset-3 btn btn-success" onclick="add('+id+')">new</p></td><td></td></tr>'
                +'</table>'

                +'<div class="row bouton-margin">'
                    +'<p onclick="annuler('+id+', '+idmariage+')" class="btn-d col-sm-5 col-sm-offset-1 btn btn-primary">Annuler</p>'
                    +'<p onclick="valider('+id+', '+idmariage+')" class="btn-d col-sm-5 btn btn-primary">Valider</p>'
                +'</div>'

            +'</form>';

}

// fonction pour supprimer un budget (cree une popup)
function supprimer(idbudget, idmariage){

    var msg = "Êtes-vous sûr de vouloir supprimer ce budget ?\nToutes les données seront perdues !";
    
    swal({
		title: "Supression",   
		text: "Etes-vous sûr de vouloir supprimer ce budget ?\nToutes les données seront perdues !",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Supprimer", 
		cancelButtonText: "Annuler"
		},  function(){

			var xhttp0 = new XMLHttpRequest();
			xhttp0.onreadystatechange = function(){
				if(xhttp0.readyState === XMLHttpRequest.DONE){
					if (xhttp0.status === 200){
						budgetglobaledepense -= +document.getElementById("totaldepense"+idbudget).innerHTML.replace("€", "");
						updatebudgetglobal();

						document.getElementById(idbudget).remove();

					}else{
						serverLost();
					}
				}
			};

			xhttp0.open("POST", "budget-modifie.php", true);
			xhttp0.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhttp0.send("idbudget="+idbudget+"&action=supprimer&idmariage="+idmariage);
    });
}


// fonction pour afficher les champs quand l'utilisateur veut modifier un budget
function modifier(idbudget, idmariage){
    
    budgetglobaledepense -= +document.getElementById("totaldepense"+idbudget).innerHTML.replace("€", "");

    var description = document.getElementById("description"+idbudget).innerHTML;
    var value = document.getElementById("value"+idbudget).innerHTML;
    var tabDepenses = new Array();

    var tabhtml = document.getElementsByClassName("depense"+idbudget);
    for (i = 0 ; i < tabhtml.length ; i++){
        var depdescription = tabhtml[i].children[0].innerHTML;
        var depvalue = tabhtml[i].children[1].innerHTML.replace("€", "").trim();

        tabDepenses.push(new Array(
            tabhtml[i].id.replace("dep", ""),
            depdescription,
            depvalue));
    }

    document.getElementById(idbudget).innerHTML = getHtmlBudgetModif(idbudget, idmariage, description, value, tabDepenses);

}


// fonction pour ajouter un budget
function ajouter(idmariage){

    var tabDepenses = new Array();
    tabDepenses.push(new Array(iddepadd, "", 0));
    $("#divboutonajouter").after('<div id="'+idbudadd+'" class="row-margin div-budget border col-sm-5">'
                                    +getHtmlBudgetModif(idbudadd, idmariage, "", 0, tabDepenses)
                                +'</div>');

    iddepadd--;
    idbudadd--;

}


// fonction pour supprimer une dépense
function supp(iddepense){
    document.getElementById(iddepense).remove();
}


// fonction pour ajouter un champ dépense
function add(idbudget){
    $("#idadd"+idbudget).before(getHtmlDepenseModif(iddepadd,"",0));
    iddepadd--;
}


// fonction pour annuler les modifications
function annuler(idbudget, idmariage){

    var xhttp3 = new XMLHttpRequest();
    xhttp3.onreadystatechange = function(){
        if(xhttp3.readyState === XMLHttpRequest.DONE){
            if (xhttp3.status === 200){
                var reponse = this.responseText;
                if (reponse.trim() != ""){
                    document.getElementById(idbudget).innerHTML = reponse;
					
					budgetglobaledepense += +document.getElementById("totaldepense"+idbudget).innerHTML.replace("€", "");
					updatebudgetglobal();
                }else{
                    document.getElementById(idbudget).remove(); 
                }
            }else{
                serverLost();
            }
        }
    };

    xhttp3.open("POST", "budget-modifie.php", true);
    xhttp3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp3.send("idbudget="+idbudget+"&action=annuler&idmariage="+idmariage);

}


// fonction pour valider les modifications
function valider(idbudget, idmariage){

    document.getElementById(idbudget).style.filter = "blur(2px)";

    var xhttp4 = new XMLHttpRequest();
    xhttp4.onreadystatechange = function(){
        if(xhttp4.readyState === XMLHttpRequest.DONE){
            if (xhttp4.status === 200){
                var reponse = this.responseText;
				var newid = reponse.substring(0, reponse.indexOf("<")).trim();
				document.getElementById(idbudget).id = newid;
                document.getElementById(newid).innerHTML = reponse.replace(newid, "");
                
				budgetglobaledepense += +document.getElementById("totaldepense"+newid).innerHTML;
				updatebudgetglobal();
				
				// modification couleur
				if (+document.getElementById("totalrestant"+newid).innerHTML >= 0){
					document.getElementById("totalrestant"+newid).style.color = "black";
				}else{
					document.getElementById("totalrestant"+newid).style.color = "red";
				}
				document.getElementById(newid).style.filter = "";
            }else{
                serverLost();
				document.getElementById(idbudget).style.filter = "";
            }
                    			
        }
    };

    var formdata = new FormData(document.getElementById("form"+idbudget));
    formdata.append('action', "valider");
    formdata.append('idbudget', idbudget);
    formdata.append('idmariage', idmariage);
    xhttp4.open("POST", "budget-modifie.php", true);
    xhttp4.send(formdata);

}


// function pour si le client pert la connexion avec le serveur web
// (les requettes ne sont pas recus)
function serverLost(){
    swal({
		title: "Erreur",   
		text: "La connexion au serveur à été perdue !\nLes données ne peuvent pas être sauvegardés ...",   
		type: "warning",   
		showCancelButton: false,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Ok"
		},  function(){
		// ne rien faire
    });
}