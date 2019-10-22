<?php
defined("_JEXEC") or die();

JHtml::_('behavior.keepalive');
JHtml::_('behavior.modal', 'a.modal');

?>

<script>
    function deleteQuestion(id) {
        jQuery.getJSON("index.php?option=com_testing&task=question.deleteQuestion&<?php echo JSession::getFormToken(); ?>=1&id=" + id, function (responce) {});
        jQuery('#row' + id).remove();
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_testing&layout=edit&id=' . $this->id); ?>"
      method="post" id="adminForm" name="adminForm" class="form-validate">
    <?php echo $this->form->renderFieldset('basic'); ?>
    <input type="hidden" name="task" value="document.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>

<?php if (!$this->id) : ?>
    Для добавления вопросов к новому документу необходимо его сохранить...
<?php else : ?>
    <table class="table table-striped table-hover">
        <thead>
            <th><?php echo JText::_("COM_TESTING_ANSWERS_TABLE_QUESTION"); ?></th>
            <th><?php echo JText::_("COM_TESTING_ANSWERS_TABLE_TYPE"); ?></th>
            <th><?php echo JText::_("COM_TESTING_ANSWERS_TABLE_ANSWERS"); ?></th>
            <th><?php echo JText::_("COM_TESTING_ANSWERS_TABLE_ACTION"); ?></th>
        </thead>
        <tbody>

        <?php if (empty($this->item->questions)) : ?>
            <tr>
                <td colspan="4" style="text-align: center; font-weight: bold;"><?php echo JText::_("COM_TESTING_ANSWERS_TABLE_NO_DATA"); ?></td>
            </tr>
        <?php else : ?>
            <?php foreach ($this->item->questions as $question) : ?>
                <tr id="row<?php echo $question->id; ?>">
                    <td><?php echo $question->question; ?></td>
                    <td><?php switch ($question->type) {
                            case 0: echo JText::_("COM_TESTING_FIELD_TYPE_1"); break;
                            case 1: echo JText::_("COM_TESTING_FIELD_TYPE_2"); break;
                            case 2: echo JText::_("COM_TESTING_FIELD_TYPE_3"); break;
                            default: echo JText::_("COM_TESTING_FIELD_TYPE_UNDEFINED");
                        }
                        ?></td>
                    <td>
                        <?php $question->answers = json_decode($question->answers); ?>
                        <?php if(empty($question->answers) || ($question->answers == "null")) : ?>
                            Варианты ответа отсутствуют
                        <?php else : ?>
                            <ul>
                            <?php foreach ($question->answers as $answer) : ?>
                                <li><?php echo $answer; ?></li>
                            <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a rel="{handler: 'iframe', size: {x:1024, y:768}}"
                           href="<?php echo JRoute::_("index.php?option=com_testing&view=question&tmpl=component&layout=edit&id=" . $question->id); ?>"
                           class="modal btn btn-light">
                            <span class="icon-edit"></span> <?php echo JText::_("COM_TESTING_ANSWERS_TABLE_EDIT_QUESTION"); ?>
                        </a>
                        <a href="javascript:deleteQuestion(<?php echo $question->id; ?>);"
                           class="btn btn-danger">
                            <span class="icon-delete"></span> <?php echo JText::_("COM_TESTING_ANSWERS_TABLE_DELETE_QUESTION"); ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

        </tbody>
        <tfooter>
            <tr>
                <td colspan="4">
                    <a rel="{handler: 'iframe', size: {x:1024, y:768}}"
                       href="<?php echo JRoute::_("index.php?option=com_testing&view=question&tmpl=component&layout=edit&id=0&document_name=" . (string)$this->item->name . "&document_id=" . $this->id); ?>"
                       class="modal btn btn-success">
                        <span class="icon-plus"></span> <?php echo JText::_("COM_TESTING_ANSWERS_TABLE_ADD_QUESTION"); ?>
                    </a>
                </td>
            </tr>
        </tfooter>

    </table>
<?php endif; ?>
