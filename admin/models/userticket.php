<?php
defined("_JEXEC") or die();

class TestingModelUserticket extends JModelAdmin {

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm($this->option."userticket",
                              "userticket",
                                       array('control' => 'jform',
                                             'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }

        return $form;
    }

    public function getTable($type = 'Userticket', $prefix = 'TestingTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_testing.edit.userticket.data', array());
        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    public function save($data)
    {
        // Предварительная обработка данных перед добавлением в БД
        return parent::save($data);
    }
}
?>
