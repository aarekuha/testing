<?php
defined("_JEXEC") or die();

class TestingControllerQuestions extends JControllerAdmin {
    public function getModel($name = 'Question', $prefix = 'TestingModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function delete()
    {
        JSession::checkToken() or die();
//        $this->input->get('cid'); // Массив выбранных идентификаторов
        parent::delete();
    }
}

?>
