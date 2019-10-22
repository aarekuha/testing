<?php
defined("_JEXEC") or die();

class TestingModelDocuments extends JModelList {

    public function __construct($config = array())
    {
        $config['filter_fields'] = array('name', 'value');
        parent::__construct($config);
    }

    public function getListQuery()
    {
        $query = parent::getListQuery();

        $query->select("a.id, a.name, a.value");
        $query->from("#__test_documents as a");

        $search = $query->escape($this->getState('filter.search'));
        if (!empty($search)) {
            $query->having('a.name regexp "' . (string)$search . '" or 
                                      value regexp "' . (string)$search . '"');
        }

        $orderColumn = $query->escape($this->getState('list.ordering', 'id'));
        $orderDirection = $query->escape($this->getState('list.direction', 'desc'));
        $query->order($orderColumn." ".$orderDirection);

        return $query;
    }

    public function populateState($ordering = null, $direction = null)
    {
        parent::populateState('id', 'desc');
    }
}

?>
