<div class="list">
  <div class="list_head">
    <span class="title">File list</span>
    <span class="view_files_info">
       :
      added <input type="checkbox" checked id="view_files_A" name="view_files_A">,
      modified <input type="checkbox" checked id="view_files_M" name="view_files_M">,
      deleted <input type="checkbox" checked id="view_files_D" name="view_files_D">
    </span>
    <div class="right status">
      <?php echo link_to('Valider', 'default/branchToggleValidate', array('title' => 'Validate branch', 'query_string' => 'branch='.$branch->getId(), 'class' => 'toggle status-valid '. ($branch->getStatus() !== BranchPeer::OK ? 'disabled' : ''))) ?>
      <?php echo link_to('Invalider', 'default/branchToggleUnvalidate', array('title' => 'Invalidate branch', 'query_string' => 'branch='.$branch->getId(), 'class' => 'toggle status-invalid '. ($branch->getStatus() !== BranchPeer::KO ? 'disabled' : ''))) ?>
    </div>
  </div>
  <div class="list_body" id="file_list">
    <table>
      <?php foreach ($files as $file): ?>
      <tr>
        <td class="state">
          <span class="state_<?php echo $file['State'] ?>" title="<?php echo $file['State'] == 'A' ? 'Added' : ($file['State'] == 'M' ? 'Modified' : 'Deleted') ?>"><?php echo $file['State'] ?></span>
        </td>
        <td>
          <h3><?php echo link_to(stringUtils::lshorten($file['Filename']), 'default/file', array('title' => stringUtils::trimTicketInfos($file['LastChangeCommitDesc']), 'query_string' => 'file='.$file['Id'])) ?></h3>
        </td>
        <td class="view_infos">
          <?php if($file['NbFileComments']): ?>
            <?php echo link_to($file['NbFileComments'], 'default/file', array('query_string' => 'file='.$file['Id'], 'class' => 'icon comment', 'title' => $file['NbFileComments'] . ' comment(s)')) ?>
          <?php endif; ?>
        </td>
        <td class="file_infos">
          999 lines
          <span class="added" title="99 added lines">99+</span>
          <span class="deleted" title="900 deleted lines">900-</span>
        </td>
        <td class="status minified">
          <?php echo link_to('Valider', 'default/fileToggleValidate', array('title' => 'Validate file', 'query_string' => 'file='.$file['Id'], 'class' => 'toggle status-valid '. ($file['Status'] !== BranchPeer::OK ? 'disabled' : ''))) ?>
          <?php echo link_to('Invalider', 'default/fileToggleUnvalidate', array('title' => 'Invalidate file', 'query_string' => 'file='.$file['Id'], 'class' => 'toggle status-invalid '. ($file['Status'] !== BranchPeer::KO ? 'disabled' : ''))) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <div id="comment_component" class="comments_holder">
    <?php include_component('default', 'commentGlobal', array('type' => CommentPeer::TYPE_BRANCH, 'id' => $branch->getId())); ?>
  </div>
</div>
<?php include_partial('default/statusAction', array('statusActions' => $statusActions)) ?>
<?php include_partial('default/commentBoard', array('commentBoards' => $commentBoards)) ?>