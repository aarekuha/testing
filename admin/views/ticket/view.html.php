<?php
defined("_JEXEC") or die();

class TestingViewTicket extends JViewLegacy {

    protected $form = null;
    protected $item = null;

    protected $questions;
    protected $ticketQuestions;

    public function display($tmpl = null)
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->questions = $this->get("Questions");
        $this->ticketQuestions = $this->get("TicketQuestions");

        $this->addToolBar();

        parent::display($tmpl);
    }

    protected function addToolBar()
    {
        $isNew = ($this->item->id == 0);

        $title = ($isNew) ? JText::_("COM_TESTING_TICKET_TITLE_NEW") : JText::_("COM_TESTING_TICKET_TITLE_EDIT");
        JToolbarHelper::title($title);

        JToolbarHelper::save('ticket.save');
        JToolbarHelper::cancel('ticket.cancel');
    }
}
?>
