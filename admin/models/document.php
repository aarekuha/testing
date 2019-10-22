<?php
defined("_JEXEC") or die();

class TestingModelDocument extends JModelAdmin {

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm($this->option."document",
                              "document",
                                       array('control' => 'jform',
                                             'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }

        return $form;
    }

    public function getTable($type = 'Document', $prefix = 'TestingTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getItem($pk = null)
    {
        $pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("*")->from("#__test_documents")->where("`id` = " . $db->quote($pk));
        $db->setQuery($query);
        $result = $db->loadObject();

        if ($pk) {
            $query = $db->getQuery(true);
            $query->select("*")->from("#__test_questions")->where("`document_id` = " . $db->quote($pk));
            $db->setQuery($query);
            $result->questions = $db->loadObjectList();
        }

        return $result;
    }

    public function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_testing.edit.document.data', array());

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }
}


