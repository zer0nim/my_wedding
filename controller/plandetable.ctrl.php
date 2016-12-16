<?php
function printAllTables($allTables, $allContacts) {
  foreach ($allTables as $key => $table) {
?>
        <tr id="<?php echo $table->getListTab_id(); ?>">
          <td>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="nom" aria-describedby="basic-addon1" value="<?=$table->getListTab_nom();?>">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
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
              <tbody>
                <?php foreach ($allContacts as $key => $value): ?>
                  <?php if ($value->getCont_idT() == $table->getListTab_id()): ?>
                    <tr id="<?php echo "contId" . $value->getCont_id(); ?>"><td><p><?php echo ($value->getCont_nom() . " " . $value->getCont_prenom()) ?><a onclick="return supprCntTab(<?php echo $value->getCont_id(); ?>);" class="supprCntLink btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p></td></tr>
                  <?php endif; ?>
                <?php endforeach; ?>
                <tr><td>
                  <p><div class="input-group">
                      <select class="form-control">
                        <option>-</option>
                        <?php foreach ($allContacts as $key => $value): ?>
                          <?php if ($value->getCont_idT() == NULL): ?>
                            <option><?php echo ($value->getCont_nom() . " " . $value->getCont_prenom()) ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Ajouter</button>
                      </span>
                    </div>
                  </p>
                </td></tr>
              </tbody>
            </table>
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
