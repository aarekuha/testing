<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tooltip');

$function = JFactory::getApplication()->input->getCmd('function', 'jSelectBook');

$script = "function setAnswerRating(_id, _rating) {
                _rating = _rating ? '0' : '1';
                jQuery.getJSON('index.php?option=com_testing&task=modaluserticket.setAnswerRating&" . $this->token . "=1&id='+_id+'&rating='+_rating, function (responce) {});
            };";
$script .= "function setTicketRating(_id, _rating) {
                jQuery.getJSON('index.php?option=com_testing&task=modaluserticket.setTicketRating&" . $this->token . "=1&id='+_id+'&rating='+_rating, function (responce) {});
            }";

JFactory::getDocument()->addScriptDeclaration($script);

?>

<style>
    @media print {
        html {background-color: #ffffff!important;}
        table td:last-child {display:none;}
        table th:last-child {display:none;}
        a {display: none!important;}

        @page {
            size: auto;   /* auto is the initial value */
            margin: 0px;  /* this affects the margin in the printer settings */
        }
    }
</style>
<form action="#" method="post" name="adminForm" id="adminForm">
    <center><h4><?php echo $this->userFio; ?></h4></center>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?php echo JText::_('COM_TESTING_USER_TICKET_MODAL_TABLE_DOCUMENT'); ?></th>
                <th><?php echo JText::_('COM_TESTING_USER_TICKET_MODAL_TABLE_QUESTION'); ?></th>
                <th><?php echo JText::_('COM_TESTING_USER_TICKET_MODAL_TABLE_ANSWER'); ?></th>
                <th><?php echo JText::_('COM_TESTING_USER_TICKET_MODAL_TABLE_RATING'); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($this->items)) : ?>
            <tr>
                <td colspan="4" style="text-align: center;">
                    В выбранном билете отсутствуют вопросы...
                </td>
            </tr>
        <?php else : ?>
            <?php foreach ($this->items as $i => $item) : ?>
                <tr class="row<?php echo $i % 2; ?>">
                    <td><?php echo $item->document; ?></td>
                    <td><?php echo $item->question; ?></td>
                    <?php if ($item->answer) : ?>
                        <td><?php echo $item->answer; ?></td>
                        <td align="center">
                            <input
                                type="checkbox"
                                <?php if ($item->rating) echo "checked"; ?>
                                onclick="javascript:setAnswerRating(<?php echo $item->id; ?>, !this.checked);"
                            >
                        </td>
                    <?php else : ?>
                        <td colspan="2" style="text-align: center">Ответ отсутствует</td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>

        <tfoot>
        <tr>
            <td>
                <a class="btn btn-primary" href="javascript:window.print();"><?php echo JText::_("COM_TESTING_TICKET_MODAL_PRINT"); ?></a>
            </td>
            <td colspan="3" style="text-align: right; min-width: 300px;">
                <?php $user_ticket_id = JFactory::getApplication()->input->getInt("user_ticket_id", -1); ?>
                <a class="btn btn-success" href="javascript:setTicketRating(<?php echo $user_ticket_id; ?>, 1);window.parent.location.reload();"><?php echo JText::_("COM_TESTING_MODAL_USER_TICKET_SUCCESS"); ?></a>
                <a class="btn btn-warning" href="javascript:setTicketRating(<?php echo $user_ticket_id; ?>, 0);window.parent.location.reload();"><?php echo JText::_("COM_TESTING_MODAL_USER_TICKET_FAIL"); ?></a>
                <a class="btn" href="javascript:window.parent.location.reload();"><?php echo JText::_("COM_TESTING_MODAL_USER_TICKET_CLOSE"); ?></a>
            </td>
        </tr>
        </tfoot>
    </table>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>


