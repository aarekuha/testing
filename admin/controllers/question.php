<?php
defined("_JEXEC") or die();

class TestingControllerQuestion extends JControllerForm {

    public function deleteQuestion()
    {
        JSession::checkToken('get') or die();
        $id = JFactory::getApplication()->input->get("id");

        $model = $this->getModel();
        $model->deleteQuestion($id);

        return true;
    }
}
?>
