<?php
defined("_JEXEC") or die();

class TestingModelTicket extends JModelAdmin {

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm($this->option."ticket",
                              "ticket",
                                       array('control' => 'jform',
                                             'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }

        return $form;
    }

    public function getTable($type = 'Ticket', $prefix = 'TestingTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getItem($pk = null)
    {
        $pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("*")->from("#__test_users_tickets")->where("`id` = " . $pk);
        $db->setQuery($query);
        $result = $db->loadObject();

        if (empty($result)) {
            $result = new stdClass();
            $result->id = 0;
        }

        return $result;
    }


    public function getQuestions()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("a.id, question");
        $query->from("#__test_questions as a");

        $query->select("b.name, b.value");
        $query->join("left", "#__test_documents as b on (a.document_id = b.id)");

        $query->order("b.name ASC, a.id ASC");
        $db->setQuery($query);

        return $db->loadObjectList();
    }

    public function getTicketQuestions()
    {
        $pk = (int) $this->getState($this->getName() . '.id');
        if (!$pk) {
            return new stdClass();
        }
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("a.question_id");
        $query->from("#__test_users_answers as a");

        $query->select("b.question");
        $query->join("left", "#__test_questions as b on (a.question_id = b.id)");

        $query->select("c.name");
        $query->join("left", "#__test_documents as c on (b.document_id = c.id)");

        $query->where("`users_ticket_id` = " . $pk);

        $db->setQuery($query);
        return $db->loadObjectList();
    }


    public function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_testing.edit.ticket.data', array());
        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    public function save($data)
    {
        if (!parent::save($data)) {
            return false;
        }

        $data['id'] = $data['id'] ? $data['id'] : JFactory::getDbo()->insertid();

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->delete("#__test_users_answers")->where("`users_ticket_id` = " . $data['id']);
        $db->setQuery($query);
        $db->execute();

        foreach ($data['questions'] as $id => $question) {
            $newQuestion = new stdClass();
            $newQuestion->users_ticket_id = $data['id'];
            $newQuestion->question_id = $id;
            JFactory::getDbo()->insertObject('#__test_users_answers', $newQuestion);
        }

        $ticket = new stdClass();
        $ticket->id = $data['id'];
        $ticket->status = 0;
        JFactory::getDbo()->updateObject('#__test_users_tickets', $ticket, 'id');

        $data['questions'] = "";

        return true;
    }
}
?>
