<?php
defined("_JEXEC") or die();
JHtml::_('behavior.keepalive');

?>

<form action="<?php echo JRoute::_('index.php?option=com_testing&layout=edit&id='.(int)$this->item->id); ?>"
      method="post" id="adminForm" name="adminForm">
    <?php echo $this->form->renderFieldset('basic'); ?>
    <?php
        $answers = json_decode($this->item->answers);
        if ($answers) {
            echo "<script>";
            foreach ($answers as $answer) {
                echo "addItem('".$answer."');";
            }
            echo "</script>";
        }
        $document_id = JFactory::getApplication()->input->get("document_id");
        $document_name = JFactory::getApplication()->input->getString("document_name");

        if (($document_id != "") && ($document_name != "")) {
            echo "<script>";
                echo "jQuery('#jform_document_id_id').val('" . $document_id . "');";
                echo "jQuery('#jform_document_id_name').val('" . $document_name . "');";
            echo "</script>";
        }
    ?>

    <?php $action = ((int)$this->item->id == 0) ? "add" : "edit"; ?>
    <a href="javascript:Joomla.submitbutton('question.save'); window.parent.setTimeout('window.location.reload();', 500);" role="button" aria-controls="sbox-window" class="btn btn-primary">
        <span class="icon-plus"></span> <?php echo JText::_("COM_TESTING_SAVE_BUTTON"); ?>
    </a>

    <input type="hidden" name="task" value="question.<?php echo $action; ?>" />
    <?php echo JHtml::_('form.token'); ?>
</form>

