<?php

use Phalcon\Mvc\Controller;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;

class ContactListController extends Controller
{
    public function indexAction()
    {
        $this->view->contacts = Contact::find();
		
    }
	
	public function addAction()
	{
		 // Check if request has made with POST
        if ($this->request->isPost()) {
            // Access POST data
			$contact = new Contact();
			$contact->first_name = $this->request->getPost('first-name');
            $contact->last_name = $this->request->getPost('last-name');
            $contact->email = $this->request->getPost('email');
			if ($contact->create() === false) {
				echo "Umh, We can't store contact right now: \n";

				$messages = $contact->getMessages();

				foreach ($messages as $message) {
					echo $message, "\n";
				}
			} else {
				echo 'Great, a new contact was created successfully!';
			}
        }
		
		$this->dispatcher->forward(['action' => 'index']);
	}
	
	public function removeAction(int $id)
	{
		$contact = Contact::findFirst($id);
		if ($contact !== false) {
			if ($contact->delete() === false) {
				echo "Sorry, we can't delete the contact right now: \n";

				$messages = $contact->getMessages();

				foreach ($messages as $message) {
					echo $message, "\n";
				}
			} else {
				echo 'The contact was deleted successfully!';
			}
		} else {
			echo 'The contact was not found';
		}
		
		$this->dispatcher->forward(['action' => 'index']);
	}
	
	public function updateAction(int $id)
	{
		if ($this->request->isPost()) {
			$contact = Contact::findFirst($id);
			if ($contact !== false) {
				$contact->first_name = $this->request->getPost('first-name');
				$contact->last_name = $this->request->getPost('last-name');
				$contact->email = $this->request->getPost('email');
				if ($contact->save() === false) {
					echo "Sorry, we can't update the contact right now: \n";

					$messages = $contact->getMessages();

					foreach ($messages as $message) {
						echo $message, "\n";
					}
				} else {
					echo 'The contact was updated successfully!';
				}
			} else {
				echo 'The contact was not found';
			}
		}
		
		$this->dispatcher->forward(['action' => 'index']);
	}
}
