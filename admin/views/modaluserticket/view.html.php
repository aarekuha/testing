<?php
defined("_JEXEC") or die();

class TestingViewModaluserticket extends JViewLegacy {

    protected $items;
    protected $pagination;
    protected $state;
    protected $userFio;

    protected $token;

    public function display($tpl = null)
    {
        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->userFio = $this->get("UserFio");
        $this->token = JSession::getFormToken();

        JFactory::getApplication()->input->set('hidemainmenu', true);

        parent::display($tpl);

    }
}
