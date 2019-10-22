<?php
defined("_JEXEC") or die();

class TestingModelUsertickets extends JModelList {

    public function __construct($config = array())
    {
        $config['filter_fields'] = array('user_id', 'ticket_id', 'status', 'rating');
        parent::__construct($config);
    }

    public function getListQuery()
    {
        $query = parent::getListQuery();

        $query->select("a.id, b.fio as user_id, b.id as user_idd, c.name as ticket_id, a.rating, a.status");
        $query->from("#__test_users_tickets as a");
        $query->join("left", "#__test_users as b on (a.user_id = b.id)");
        $query->join("left", "#__test_tickets as c on (a.ticket_id = c.id)");

        $search = $query->escape($this->getState('filter.search'));
        if (!empty($search)) {
            $query->having('user_id regexp "' . (string)$search . '" or 
                                      ticket_id regexp "' . (string)$search . '"');
        }

        $orderColumn = $query->escape($this->getState('list.ordering', 'status'));
        $orderDirection = $query->escape($this->getState('list.direction', 'desc'));
        $query->order($orderColumn." ".$orderDirection);

        return $query;
    }

    public function populateState($ordering = null, $direction = null)
    {
        parent::populateState('status', 'desc');
    }

    public function delete()
    {
        JSession::checkToken() or die();

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $ids = JFactory::getApplication()->input->get("cid");
        foreach ($ids as $id) {
            $id = $query->escape($id);
        }
        $ids = implode(", ", $ids);

        $query->delete($db->quoteName('#__test_users_tickets'));
        $query->where("`id` in (" . $ids . ")");
        $db->setQuery($query);
        $db->execute();

        $query = $db->getQuery(true);
        $query->delete($db->quoteName('#__test_users_answers'));
        $query->where("`user_ticket_id` in (" . $ids . ")");
        $db->setQuery($query);
        $db->execute();
    }
}

?>
