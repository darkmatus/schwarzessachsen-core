<?php

namespace SchwarzesSachsenCore\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class UploadForm extends Form
{
    public function __construct($multi = null, $name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->addElements($multi);
    }

    public function addElements($multi)
    {
        $file = new Element\File('upload');
        $file->setLabel('Bild hinzufügen:')
        ->setAttribute('id', 'file');
        if ($multi !== null) {
            $file->setAttribute('multiple', true);
        }
        $this->add($file);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Hochladen'
            ),
        ));
    }
}