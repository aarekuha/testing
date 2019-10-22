<?php
defined("_JEXEC") or die();

?>

<form action="<?php echo JRoute::_("index.php?option=com_testing&view=users"); ?>" method="post"
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
                <th><?php echo JHtml::_('grid.sort', 'COM_TESTING_USERS_TABLE_FIO', 'fio', $this->listDirn, $this->listOrder); ?></th>
                <th><?php echo JHtml::_('grid.sort', 'COM_TESTING_USERS_TABLE_EMAIL', 'email', $this->listDirn, $this->listOrder); ?></th>
            </thead>
            <tbody>
                <?php if (!empty($this->items)) : ?>
                    <?php foreach ($this->items as $key=>$item) : ?>
                        <tr>
                            <td>
                                <?php echo JHtml::_("grid.id", $key, $item->id); ?>
                            </td>
                            <td>
                                <?php $link = JRoute::_("index.php?option=com_testing&task=user.edit&id=".$item->id); ?>
                                <a href="<?php echo $link; ?>"><?php echo $item->fio; ?></a>
                            </td>
                            <td>
                                <a href="<?php echo $link; ?>"><?php echo $item->email; ?></a>
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
