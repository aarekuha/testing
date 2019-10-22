<?php
defined("_JEXEC") or die();

JHtml::_('behavior.keepalive');

JFactory::getDocument()->addScript(JUri::base() . "components/com_testing/js/questions.js");

?>
<script type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        if (task == 'ticket.save') {
            if (confirm('При сохранении билета его состояние будет сброшено на "Не пройден", уверены, что хотите сохранить?')) {
                Joomla.submitform(task);
            } else {
                return false;
            }
        } else {
            Joomla.submitform(task);
        }
    }
</script>

<div class="">
    <div class="accordion span6">
        <form action="<?php echo JRoute::_('index.php?option=com_testing&layout=edit&id=' . (int)$this->item->id); ?>"
              method="post" id="adminForm" name="adminForm" class="form-validate">
            <?php echo $this->form->renderFieldset('basic'); ?>

            <input type="hidden" name="task" value="document.edit" />
            <?php echo JHtml::_('form.token'); ?>

            <h5><?php echo JText::_("COM_TESTING_TICKET_USER_QUESTIONS_LIST"); ?></h5>
            <ul id="userQuestionsList"></ul>
        </form>
    </div>

    <div class="accordion span6" id="accordion">
        <h5><?php echo JText::_("COM_TESTING_TICKET_QUESTIONS_LIST"); ?></h5>
        <?php
        $questionName = "";
        $counter = 0;

        foreach ($this->questions as $question) {
            if ($questionName != $question->name) {
                if ($questionName != "") {
                    echo '</ul></div></div></div>';
                }
                echo '<div class="accordion-group">';
                $questionName = $question->name;
                echo '<div class="accordion-heading">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse' . ++$counter . '">
                              ' . $question->name . ' ( ' . $question->value . ')
                          </a>
                      </div>';
                echo '<div id="collapse' . $counter . '" class="accordion-body collapse">
                          <div class="accordion-inner">
                            <ul>';
            }
            echo "<li><a href='javascript:addItem(\"" . $question->name . " : " . $question->question . "\", " . $question->id . ");'>" . $question->question . "</a></li>";
        }
        echo '</div></div></div>';
        ?>
    </div>
</div>

<script>
    <?php
    foreach ($this->ticketQuestions as $ticketQuestion) {
        echo "addItem('" . $ticketQuestion->name . " : " . $ticketQuestion->question . "', " . $ticketQuestion->question_id . ");";
    }
    ?>
</script>


