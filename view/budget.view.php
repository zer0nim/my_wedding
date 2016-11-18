<?php
  require_once '../view/baseMenuFnct.php';
?>
<link rel="stylesheet" href="../view/css/budget.css" type="text/css" />

    <!--<div class="col-xs-12">
	
	<div class="col-xs-12 col-sm-3 col-sm-push-1"> <!-- div principale de chaque budget -->
	   <!--<div class="form-group col-sm-12">
		<p>Budget nourriture : 1500 €</p>
	    </div>
	    
	    ---------------
	    
	    <form action="">
	    First name: <input type="text" id="txt1" onkeyup="showHint(this.value)">
	    </form>

	    <p>Suggestions: <span id="txtHint"></span></p>

	    <script>
	    function showHint(str) {
	      var xhttp;
	      if (str.length == 0) {
		document.getElementById("txtHint").innerHTML = "";
		return;
	      }
	      xhttp = new XMLHttpRequest();
	      xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		  document.getElementById("txtHint").innerHTML = this.responseText;
		}
	      };
	      xhttp.open("GET", "gethint.php?q="+str, true);
	      xhttp.send();
	    }
	    </script>

	    -------------------------------
	    
	    <table class="form-group col-sm-12">
		<tr><td>Boisson</td><td>500 €</td></tr>
		<tr><td>Viande</td><td>1000 €</td></tr>
		<tr><td>Gateau</td><td>70 €</td></tr>
		<tr><td>Total</td><td>1570 €</td></tr>
	    </table>
	    
	    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popup1">Modifier</button>
	    <div id="popup1" class="modal fade" role="dialog">
	      <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal">&times;</button>
		    <h4 class="modal-title">Budget nourriture</h4>
		  </div>
		  <div class="modal-body">
		      <!-- body -->
		      <!--<form method="get" action="accueil.ctrl.php">
			  <input type="text" value="test" name="testtext">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Valider</button>
		      </form>
		      <form>			  
			  <button type="button" class="btn" data-dismiss="modal">Annuler</button>
		      </form>
		  </div>
		</div>

	      </div>
	    </div>
	</div>
	
    </div>-->

</body>
</html>
