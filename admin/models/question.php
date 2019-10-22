<?php
defined("_JEXEC") or die();

class TestingModelQuestion extends JModelAdmin {

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm($this->option."question",
                              "question",
                                       array('control' => 'jform',
                                             'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }

        return $form;
    }

    public function getTable($type = 'Question', $prefix = 'TestingTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_testing.edit.question.data', array());
        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    public function save($data)
    {
        $data["answers"] = json_encode($data["answers"]);
        return parent::save($data);
    }

    public function delete(&$pks)
    {
        JSession::checkToken() or die();

        // Удалить записи из пользовательских ответов, которые ссылаются на удаляемый вопрос
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $ids = $pks;
        foreach ($ids as $id) {
            $id = $query->escape($id);
        }
        $ids = implode(", ", $ids);

        $query->delete($db->quoteName('#__test_users_answers'));
        $query->where("`id` in (" . $ids . ")");
        $db->setQuery($query);
        $db->execute();

        return parent::delete($pks);
    }

    public function deleteQuestion($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $id = $query->escape($id);

        $query->delete($db->quoteName('#__test_questions'));
        $query->where("`id` = " . $id);
        $db->setQuery($query);
        $db->execute();
    }
}
?>
