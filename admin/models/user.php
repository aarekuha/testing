<?php
defined("_JEXEC") or die();

class TestingModelUser extends JModelAdmin {

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm($this->option."user",
                              "user",
                                       array('control' => 'jform',
                                             'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }

        return $form;
    }

    public function getTable($type = 'User', $prefix = 'TestingTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_testing.edit.user.data', array());
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
