<?php
  require_once '../view/baseMenuFnct.php';
?>

<link rel="stylesheet" href="../view/css/budget.css" type="text/css" />

    
    <div class="text-center">
        
        <div id="divboutonajouter" class="row row-margin col-sm-4 col-sm-offset-4">
            <button class="btn btn-primary" onClick="ajouter('<?= $idmariage ?>')">Ajouter un budget</button>
        </div>
        
        <?php
            if ($tabbudget != null){
                foreach ($tabbudget as $idbudget => $budget) {
        ?>
            <div id="<?= $idbudget ?>" class="row-margin budget col-sm-4 col-sm-offset-1 col-sm-push-1">
                <div class="row col-sm-12">
                    <p><?= $budget->getDescription() ?> : <?= $budget->getValue() ?> €</p>
                </div>
                <table class="row scroll form-control">
                    <tr class="row"><th class="col-sm-12 text-center">Description</th><th class="col-sm-12">Prix</th></tr>
                    <?php
                        $tabdepense = $budget->getTabdepense();
                        if ($tabdepense != null){
                            foreach ($tabdepense as $depense) {
                    ?>
                            <tr class="row"><td><?= $depense->getDescription() ?></td><td class="text-right"><?= $depense->getValue() ?> €</td></tr>
                    <?php
                            }
                        }
                    ?>
                </table>
                <table class="row table-margin col-sm-10">
                    <tr class="row"><td class="text-center">Total dépensé</td><td class="text-right"><?= $budget->getTotalDepense() ?> €</td><td></td></tr>
                    <tr class="row"><td class="text-center">Budget restant</td><td class="text-right"><?= $budget->getTotalRest() ?> €</td><td></td></tr>
                </table>
                <div class="row">
                    <button class="col-sm-4 col-sm-offset-1 btn btn-primary" onClick="confirmation('<?= $idbudget ?>', '<?= $budget->getIdMariage() ?>')">Supprimer</button>
                    <button class="col-sm-4 col-sm-offset-1 btn btn-primary" onclick="afficheModif('<?= $idbudget ?>', '<?= $budget->getIdMariage() ?>')">Modifier</button>
                </div>
            </div>
        <?php
                }
            }
        ?> 
        
    </div>


    <!-- script java -->
    <script type="text/javascript">

        // fonction pour confirmation de suppression d'un budget (cree une popup)
        function confirmation(idbudget, idmariage) {
            var msg = "Êtes-vous sur de vouloir supprimer ce budget ?";
            if (confirm(msg)){
                var xhttp0;
                xhttp0 = new XMLHttpRequest();
                xhttp0.onreadystatechange = function() {
                    if(xhttp0.readyState === XMLHttpRequest.DONE && xhttp0.status === 200) {
                        document.getElementById(idbudget).remove();
                    }
                };
                xhttp0.open("GET", "budget-modifie.php?idbudget="+idbudget+"&action=supprimer&idmariage="+idmariage, true);
                xhttp0.send();
            }
        }    

        // fonction pour afficher les champs quand l'utilisateur veut modifier un budget
        function afficheModif(idbudget, idmariage) {
            var xhttp1;
            xhttp1 = new XMLHttpRequest();
            xhttp1.onreadystatechange = function() {
                if(xhttp1.readyState === XMLHttpRequest.DONE && xhttp1.status === 200) {
                    document.getElementById(idbudget).innerHTML = this.responseText;
                }
            };
            xhttp1.open("GET", "budget-modifie.php?idbudget="+idbudget+"&action=modifier&idmariage="+idmariage, true);
            xhttp1.send();
        }
        
        // fonction pour ajouter un budget
        var nom = 1; // modifier de idbudget
        var i = 1; // modifier de id depense
        function ajouter(idmariage) {
            var xhttp2;
            xhttp2 = new XMLHttpRequest();
            xhttp2.onreadystatechange = function() {
                if(xhttp2.readyState === XMLHttpRequest.DONE && xhttp2.status === 200) { 
                    var reponse = this.responseText;
                    $("#divboutonajouter").after(reponse);
                }
            };
            xhttp2.open("GET", "budget-modifie.php?action=ajouter&idbudget=19999999"+nom+"&iddepense=19999999"+i+"&idmariage="+idmariage, true);
            nom++;
            i++;
            xhttp2.send();
        }
    
        // fonction pour supprimer une dépense
        function supp(iddepense) {
            document.getElementById(iddepense).remove();
        }
    
        // fonction pour ajouter un champ dépense
        function add(idbudget) {
            var iddepense = 19999999+i; // doit etre tout le temps different
            i++;
            $("#idadd"+idbudget).before('<tr id="'+iddepense+'" class="row"><td><p class="btn btn-danger" onclick="supp(\''+iddepense+'\')"> X </p></td><td><input name="'+iddepense+'depdescription" type="text" value=""></td><td class="text-right"><input name="'+iddepense+'depvalue" type="number" min="0" value="0 €"></td></tr>');
        }
        
        // fonction pour annuler les modifications
        function annuler(idbudget, idmariage) {
            var xhttp3;
            xhttp3 = new XMLHttpRequest();
            xhttp3.onreadystatechange = function() {
                if(xhttp3.readyState === XMLHttpRequest.DONE && xhttp3.status === 200) {
                    var reponse = this.responseText;
                    if (reponse.trim() != ""){
                        document.getElementById(idbudget).innerHTML = reponse;
                    }else{
                        document.getElementById(idbudget).remove(); 
                    }
                }
            };
            xhttp3.open("GET", "budget-modifie.php?idbudget="+idbudget+"&action=annuler&idmariage="+idmariage, true);
            xhttp3.send();
        }
        
        // fonction pour valider les modifications
        function valider(idbudget, idmariage) {
            var xhttp4;
            xhttp4 = new XMLHttpRequest();
            xhttp4.onreadystatechange = function() {
                if(xhttp4.readyState === XMLHttpRequest.DONE && xhttp4.status === 200) {
                    var reponse = this.responseText;
                    var long = reponse.indexOf("<");
                    var id = reponse.substring(0, long).trim();
                    var data = reponse.replace(id, "");
                    document.getElementById(idbudget).innerHTML = data;
                    document.getElementById(idbudget).id = id;
                }
            };
            xhttp4.open(document.getElementById("form"+idbudget).method, document.getElementById("form"+idbudget).action+"&idmariage="+idmariage, true);
            xhttp4.send(new FormData(document.getElementById("form"+idbudget)));
        }
        
    </script>

</body>
</html>
