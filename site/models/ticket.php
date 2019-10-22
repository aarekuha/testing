<?php
defined('_JEXEC') or die;

class TestingModelTicket extends JModelItem
{
    protected function populateState()
    {
        $app = JFactory::getApplication();
        $id = $app->input->getInt("id");
        $this->setState("ticket.id", $id);

        parent::populateState();
    }

    public function getItem($pk = null)
    {
        $pk = (!empty($pk)) ? $pk : $this->getState("ticket.id");

        if (!$pk)
            return false;

        $query = $this->getDbo()->getQuery(true);
        $query->select("a.id as question_id, a.users_ticket_id");
        $query->from("#__test_users_answers as a");

        $query->select("b.question, b.answers, b.type");
        $query->join("left", "#__test_questions as b on (b.id = a.question_id)");

        $query->select("c.name");
        $query->join("left", "#__test_documents as c on (c.id = b.document_id)");

        $query->where("a.users_ticket_id = " . $pk);

        $db = JFactory::getDbo();
        $db->setQuery($query);

        $items = $db->loadObjectList();

        foreach ($items as $item) {
            $item->answers = json_decode($item->answers);
        }

        return $items;
    }

    public function submitTicket($ticket_form) {

        foreach ($ticket_form as $question_id => $answer) {
            $question = new stdClass();
            $question->id = $question_id;
            if (is_array($answer)) {
                $answer = implode("<br />", $answer);
            }
            $question->answer = $answer;
            JFactory::getDbo()->updateObject('#__test_users_answers', $question, 'id');
        }

        $user_ticket_id = JFactory::getApplication()->input->get("user_ticket_id");
        $user_ticket = new stdClass();
        $user_ticket->id = $user_ticket_id;
        $user_ticket->status = 1;

        return JFactory::getDbo()->updateObject('#__test_users_tickets', $user_ticket, 'id');
    }
}

?>