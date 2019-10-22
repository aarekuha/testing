<?php

defined('_JEXEC') or die('Restricted access');

class TestingModelModaltickets extends JModelList
{
    public function __construct($config = array())
    {
        $config['filter_fields'] = array('name', 'value');
        parent::__construct($config);
    }

    public function populateState($ordering = 'name', $direction = 'asc')
    {
        parent::populateState('name', 'asc');
    }

    public function getListQuery()
    {
        $query = parent::getListQuery();

        $query->select("id, name, value");
        $query->from("#__test_tickets");

        $search = $query->escape($this->getState('filter.search'));
        if (!empty($search)) {
            $query->where('name regexp "' . (string)$search . '"');
        }

        $orderColumn = $query->escape($this->state->get('list.ordering', 'name'));
        $orderDirection = $query->escape($this->state->get('list.direction', 'desc'));
        $query->order($orderColumn." ".$orderDirection);

        return $query;
    }

}