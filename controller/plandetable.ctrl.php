<?php
function printAllTables($allTables, $allContacts) {
  foreach ($allTables as $key => $table) {
?>
        <tr id="<?php echo $table->getListTab_id(); ?>">
          <td>
            <div class="input-group">
              <input type="text" class="nameLink form-control" placeholder="nom" aria-describedby="basic-addon1" value="<?=$table->getListTab_nom();?>">
              <span class="input-group-btn">
              <button class="nameModifLink btn btn-success" type="button" disabled="true"><i class="fa fa-check" aria-hidden="true"></i></button>
              </span>
            </div><!-- /input-group -->
            <br>
            <a class="btn btn-danger" role="button" onclick="return supprT(<?php echo $table->getListTab_id(); ?>);">Supprimer</a>
          </td>
          <td>
            <select class="form-control nbPlacesLink">
              <?php
              for ($i=1; $i<=500; $i++) {
                ?>
                <?php if ($i == $table->getListTab_nbPlaces()){?>
                  <option value="<?=$i?>" selected="selected"><?=$i?></option>
                <?php }else {?>
                  <option value="<?=$i?>"><?=$i?></option>
                <?php }}
                ?>
            </select>
          </td>
          <td>
            <table class="table table-bordered table-striped table-hover table-responsive">
              <tbody class="cntTable" id="<?php echo "cntTable_" . $table->getListTab_id(); ?>">
                <?php foreach ($allContacts as $key => $value): ?>
                  <?php if ($value->getCont_idT() == $table->getListTab_id()): ?>
                    <tr id="<?php echo "contId" . $value->getCont_id(); ?>"><td><p><?php echo ($value->getCont_nom() . " " . $value->getCont_prenom()); ?><a onclick="return supprCntTab(<?php echo $value->getCont_id(); ?>);" class="supprCntLink btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p></td></tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
            <div class="input-group" id="<?php echo "cntTableAdding_" . $table->getListTab_id(); ?>">
                <select class="listCntToAddlink form-control">
                  <?php foreach ($allContacts as $key => $value): ?>
                    <?php if ($value->getCont_idT() == NULL): ?>
                      <option value="<?php echo ($value->getCont_id()); ?>"><?php echo ($value->getCont_nom() . " " . $value->getCont_prenom()); ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
                <span class="input-group-btn">
                  <button class="addCntLink btn btn-default" type="button">Ajouter</button>
                </span>
              </div>
          </td>
        </tr>
<?php
  }
}

require_once '../model/DAO.class.php';
$allTables = $dao->getTables(1);
$allContacts = $dao->getContacts(1);

include_once('../view/plandetable.view.php');

?>
