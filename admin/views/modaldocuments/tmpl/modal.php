<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

// Load tooltip behavior
JHtml::_('behavior.tooltip');

$function = JFactory::getApplication()->input->getCmd('function', 'jSelectBook');
?>
<form action="#" method="post" name="adminForm" id="adminForm">

    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

    <table class="adminlist">
        <thead>
        <tr>
            <th>
                <?php echo JHtml::_('grid.sort', 'COM_TESTING_DOCUMENTS_MODAL_TABLE_NAME', 'name', $this->listDirn, $this->listOrder); ?>
            </th>
            <th>
                <?php echo JHtml::_('grid.sort', 'COM_TESTING_DOCUMENTS_MODAL_TABLE_VALUE', 'value', $this->listDirn, $this->listOrder); ?>
            </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="6"><?php //echo $this->pagination->getListFooter(); ?></td>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach ($this->items as $i => $item) : ?>
            <tr class="row<?php echo $i % 2; ?>">
                <td>
                    <a style="cursor: pointer;" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->name)); ?>');"><?php echo $this->escape($item->name); ?></a>
                </td>
                <td><?php echo $item->value; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
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
    </table>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $this->listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
