<?php
defined("_JEXEC") or die();

class TestingControllerDocuments extends JControllerAdmin {
    public function getModel($name = 'Document', $prefix = 'TestingModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }
}

?>
