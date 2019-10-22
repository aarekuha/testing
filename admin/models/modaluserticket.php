<?php

defined('_JEXEC') or die('Restricted access');

class TestingModelModaluserticket extends JModelList
{
    public function __construct($config = array())
    {
        parent::__construct($config);
    }

    public function populateState($ordering = 'user_ticket_id', $direction = 'asc')
    {
        parent::populateState($ordering, $direction);
    }

    public function getListQuery()
    {
        $query = parent::getListQuery();

        $query->select("a.id, answer, users_ticket_id, rating");
        $query->from("#__test_users_answers as a");

        $query->select("question");
        $query->join("left", "#__test_questions as b on (b.id = a.question_id)");

        $query->select("name as document");
        $query->leftJoin("#__test_documents as c on (c.id = b.document_id)");

        $user_ticket_id = JFactory::getApplication()->input->get("user_ticket_id", "-1");
        $query->where("a.users_ticket_id = " . $query->escape($user_ticket_id));

        $this->setState('list.limit', 200);

        return $query;
    }

    public function getUserFio()
    {
        $user_ticket_id = JFactory::getApplication()->input->get("user_ticket_id", "-1");
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("fio");
        $query->from("#__test_users as a");

        $query->leftJoin("#__test_users_tickets as b on (a.id = b.user_id)");
        $query->where("b.id = " . $db->escape($user_ticket_id));

        $db->setQuery($query);

        return $db->loadResult();
    }

    public function setAnswerRating($id, $rating)
    {
        if (empty($id))
            return;

        $object = new stdClass();

        $object->id = $id;
        $object->rating = $rating; // Оценка: правильно/неправильно

        JFactory::getDbo()->updateObject('#__test_users_answers', $object, 'id');
    }

    public function setTicketRating($id, $rating)
    {
        if (empty($id))
            return;

        $object = new stdClass();

        $object->id = $id;
        $object->rating = $rating; // Оценка: успех/провал
        $object->status = 2; // Статус: проверен

        JFactory::getDbo()->updateObject('#__test_users_tickets', $object, 'id');
    }

}