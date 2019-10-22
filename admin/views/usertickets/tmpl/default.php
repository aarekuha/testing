<?php
defined("_JEXEC") or die();

JHtml::_('behavior.modal', 'a.modal');
?>

<form action="<?php echo JRoute::_("index.php?option=com_testing&view=usertickets"); ?>" method="post"
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
                <th><?php echo JHtml::_('grid.sort', 'COM_TESTING_USER_TICKETS_TABLE_USER', 'user_id', $this->listDirn, $this->listOrder); ?></th>
                <th><?php echo JHtml::_('grid.sort', 'COM_TESTING_USER_TICKETS_TABLE_TICKET', 'ticket_id', $this->listDirn, $this->listOrder); ?></th>
                <th><?php echo JHtml::_('grid.sort', 'COM_TESTING_USER_TICKETS_TABLE_STATUS', 'status', $this->listDirn, $this->listOrder); ?></th>
                <th><?php echo JHtml::_('grid.sort', 'COM_TESTING_USER_TICKETS_TABLE_RATING', 'rating', $this->listDirn, $this->listOrder); ?></th>
            </thead>
            <tbody>
                <?php if (!empty($this->items)) : ?>
                    <?php foreach ($this->items as $key=>$item) : ?>
                        <tr>
                            <td>
                                <?php echo JHtml::_("grid.id", $key, $item->id); ?>
                            </td>
                            <td>
                                <?php // $link = JRoute::_("index.php?option=com_testing&view=user&layout=edit&id=".$item->user_idd); ?>
                                <?php $link = JRoute::_("index.php?option=com_testing&view=modaluserticket&layout=modal&tmpl=component&user_ticket_id=".$item->id); ?>
                                <a class="modal" rel="{handler: 'iframe', size: {x:1024, y:768}}" href="<?php echo $link; ?>"><?php echo $item->user_id; ?></a>
                            </td>
                            <td>
                                <a class="modal" rel="{handler: 'iframe', size: {x:1024, y:768}}" href="<?php echo $link; ?>"><?php echo $item->ticket_id; ?></a>
                            </td>
                            <td>
                                <?php
                                switch ($item->status) {
                                    case 1: $ticketStatus = "<span style='color: #8b0000;'>" . JText::_('COM_TESTING_USER_TICKET_NOT_CHECKED') . "</span>"; break;
                                    case 2: $ticketStatus = "<span style='color: #006400;'>" . JText::_('COM_TESTING_USER_TICKET_CHECKED') . "</span>"; break;
                                    default: $ticketStatus = "<span style='color: #000000;'>" . JText::_('COM_TESTING_USER_TICKET_NOT_PASS') . "</span>"; break;
                                }
                                echo $ticketStatus;
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($item->status == 2)
                                    echo $item->rating ?
                                        "<span style='color: #006400;'>" . JText::_('COM_TESTING_USER_TICKET_SUCCESS') . "</span>" :
                                        "<span style='color: #8b0000;'>" . JText::_('COM_TESTING_USER_TICKET_FAIL') . "</span>";
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
    <input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirn; ?>" />

    <?php echo JHtml::_("form.token"); ?>
</form>
