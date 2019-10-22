<?php
defined("_JEXEC") or die();

class TestingControllerModaluserticket extends JControllerAdmin {

    public function getModel($name = 'Modaluserticket', $prefix = 'TestingModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function setAnswerRating()
    {
        JSession::checkToken("get") or jexit('Invalid Token');

        $id  = JFactory::getApplication()->input->get("id");
        $rating  = JFactory::getApplication()->input->get("rating");

        $model = $this->getModel();
        $model->setAnswerRating($id, $rating);

        return true;
    }

    public function setTicketRating()
    {
        JSession::checkToken("get") or jexit('Invalid Token');

        $id  = JFactory::getApplication()->input->get("id");
        $rating  = JFactory::getApplication()->input->get("rating");

        $model = $this->getModel();
        $model->setTicketRating($id, $rating);

        return true;
    }


}

?>
