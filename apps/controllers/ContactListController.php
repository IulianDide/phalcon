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
            $contact['first-name'] = $this->request->getPost('first-name');
            $contact['last-name'] = $this->request->getPost('last-name');
            $contact['email'] = $this->request->getPost('email');
			$contactEntity = new Contact();
			$contactEntity->first_name = $this->request->getPost('first-name');
            $contactEntity->last_name = $this->request->getPost('last-name');
            $contactEntity->email = $this->request->getPost('email');
			if ($contactEntity->create() === false) {
				echo "Umh, We can't store contact right now: \n";

				$messages = $contactEntity->getMessages();

				foreach ($messages as $message) {
					echo $message, "\n";
				}
			} else {
				echo 'Great, a new contact was created successfully!';
			}
			//var_dump($contact);
			//var_dump($contactEntity);
        }
	}
}
