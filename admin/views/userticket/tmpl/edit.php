<?php
defined("_JEXEC") or die();

JHtml::_('behavior.keepalive');
?>

<form action="<?php echo JRoute::_('index.php?option=com_testing&layout=edit&id='.(int)$this->item->id); ?>"
      method="post" id="adminForm" name="adminForm" class="form-validate">
    <?php echo $this->form->renderFieldset('basic'); ?>

    <?php echo $this->form->getField('id')->renderField(); ?>
    <input type="hidden" name="task" value="userticket.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>
