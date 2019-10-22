<?php
defined("_JEXEC") or die();

JHtml::_('behavior.modal', 'a.modal');
?>

<form action="<?php echo JRoute::_("index.php?option=com_testing&view=tickets"); ?>" method="post"
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
                <tr>
                    <th width="30px"> </th>
                    <th style="width: 180px;"> </th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TESTING_TICKETS_TABLE_FIO', 'fio', $this->listDirn, $this->listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TESTING_TICKETS_TABLE_STATUS', 'status', $this->listDirn, $this->listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TESTING_TICKETS_TABLE_RATING', 'rating', $this->listDirn, $this->listOrder); ?></th>
                    <th><?php echo JText::_('COM_TESTING_TICKETS_TABLE_ANSWERS'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($this->items)) : ?>
                    <?php foreach ($this->items as $key=>$item) : ?>
                        <tr>
                            <td>
                                <?php echo JHtml::_("grid.id", $key, $item->id); ?>
                            </td>

                            <td>
                                <?php $link = JRoute::_("index.php?option=com_testing&task=ticket.edit&id=".$item->id); ?>
                                <a href="<?php echo $link; ?>" class="btn btn-primary">
                                    <?php echo JText::_('COM_TESTING_TICKETS_TABLE_EDIT_TICKET'); ?>
                                </a>
                            </td>

                            <td>
                                <?php $linkUser = JRoute::_("index.php?option=com_testing&task=user.edit&id=".$item->user_id); ?>
                                <a href="<?php echo $linkUser; ?>"><?php echo $item->fio; ?></a>
                            </td>

                            <td <?php if ($item->status != 2) echo "colspan='2' style='text-align: center;'"; ?>>
                                <?php
                                switch ($item->status) {
                                    case 1 :
                                        echo "<span class='icon-eye'></span> " . JText::_("COM_TESTING_TICKETS_STATUS_1");
                                        break;
                                    case 2 :
                                        echo "<span class='icon-flag'></span> " . JText::_("COM_TESTING_TICKETS_STATUS_2");
                                        break;
                                    default :
                                        echo  "<span class='icon-clock'></span> " .JText::_("COM_TESTING_TICKETS_STATUS_0");
                                        break;
                                }
                                ?>
                            </td>

                            <?php if ($item->status == 2) : ?>
                            <td>
                                <?php
                                    echo ($item->rating) ?
                                        "<span class='icon-checkmark'></span> " . JText::_("COM_TESTING_TICKETS_RATING_1") :
                                        "<span class='icon-remove'></span> " . JText::_("COM_TESTING_TICKETS_RATING_0");
                                ?>
                            </td>
                            <?php endif; ?>

                            <td>
                                <?php $link = JRoute::_("index.php?option=com_testing&view=modaluserticket&layout=modal&tmpl=component&user_ticket_id=".$item->id); ?>
                                <a class="modal btn btn-primary" rel="{handler: 'iframe', size: {x:1024, y:768}}" href="<?php echo $link; ?>">
                                    <?php echo JText::_("COM_TESTING_TICKETS_TABLE_ANSWERS"); ?>
                                </a>
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
