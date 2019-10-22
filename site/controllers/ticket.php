<?php
defined('_JEXEC') or die;

class TestingControllerTicket extends JControllerForm {

    public function getModel($name = 'Ticket', $prefix = 'TestingModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function submitTicket()
    {
        JSession::checkToken("post") or die();

        $ticket_form = $_POST["ticket_form"];

        if(empty($ticket_form)) {
            return false;
        }

        $model = $this->getModel();
        if ($model->submitTicket($ticket_form)) {
            $message = JText::_("COM_TESTING_SUCCESS_FORM_SUBMIT");
            $type = "success";
        } else {
            $message = JText::_("COM_TESTING_FAIL_FORM_SUBMIT");
            $type = "error";
        }

        $app = JFactory::getApplication();
        $app->enqueueMessage($message, $type);
        $app->redirect(JRoute::_('index.php?option=' . $this->option . "&view=tickets"));
    }
}