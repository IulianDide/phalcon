<?php

use Phalcon\Mvc\Model;

class Contact extends Model
{
    public function initialize()
    {
        $this->setSource("contacts");
    }
	
}