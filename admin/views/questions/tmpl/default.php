<?php
defined("_JEXEC") or die();
?>
<script>
    close();
</script>

<form action="<?php echo JRoute::_("index.php?option=com_testing&view=questions"); ?>" method="post"
      name="adminForm" id="adminForm">

    <?php if(!empty($this->sidebar)) : ?>
        <div id="j-sidebar-container" class="span2">
            <?php echo $this->sidebar; ?>
        </div>
    <?php endif; ?>

    <div id="j-main-container" class="span10">

         <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

        <table class="table table-striped table-hover">
            <thead>
            <th width="30px"> </th>
            <th><?php echo JHtml::_('grid.sort', 'COM_TESTING_QUESTIONS_TABLE_DOCUMENT', 'document_id', $this->listDirection, $this->listOrder); ?></th>
            <th><?php echo JHtml::_('grid.sort', 'COM_TESTING_QUESTIONS_TABLE_QUESTION', 'question', $this->listDirection, $this->listOrder); ?></th>
            <th><?php echo JHtml::_('grid.sort', 'COM_TESTING_QUESTIONS_TABLE_TYPE', 'type', $this->listDirection, $this->listOrder); ?></th>
            </thead>
            <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php foreach ($this->items as $key=>$item) : ?>
                    <tr>
                        <td>
                            <?php echo JHtml::_("grid.id", $key, $item->id); ?>
                        </td>
                        <td>
                            <?php echo $item->document_id; ?>
                        </td>
                        <td>
                            <?php $link = JRoute::_("index.php?option=com_testing&task=question.edit&id=".$item->id); ?>
                            <a href="<?php echo $link; ?>"><?php echo $item->question; ?></a>
                        </td>
                        <td>
                            <?php switch ($item->type) {
                                case 0: echo JText::_("COM_TESTING_FIELD_TYPE_1"); break;
                                case 1: echo JText::_("COM_TESTING_FIELD_TYPE_2"); break;
                                case 2: echo JText::_("COM_TESTING_FIELD_TYPE_3"); break;
                                default: echo JText::_("COM_TESTING_FIELD_TYPE_UNDEFINED");
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="4">
                        <div class="span3">
                            <?php echo $this->pagination->getPagesCounter(); ?>
                        </div>
                        <div class="span9">
                            <?php echo $this->pagination->getListFooter(); ?>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="filter_order" value="<?php echo $this->listOrder; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirection; ?>" />
    <?php echo JHtml::_("form.token"); ?>
</form>
