<?php

namespace SchwarzesSachsenCore\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter;

/**
 * Erstellt das Multiuploadform inklusive Validatoren
 * fielOptions muss ein Optionsarray der image/file Config sein
 * @author mi.mueller
 *
 */
class MultiUploadForm extends Form
{
    public function __construct($fileOptions, $name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->addElements();
        $this->setInputFilter($this->createInputFilter($fileOptions));
    }

    public function addElements()
    {
        $file = new Element\File('file');
        $file
        ->setLabel('Bilder hochladen: ')
        ->setAttributes(array(
            'id'       => 'file',
            'multiple' => true
        ));
        $this->add($file);
    }

    public function createInputFilter($options)
    {
        $inputFilter = new InputFilter\InputFilter();

        // File Input
        $file = new InputFilter\FileInput('file');
        $file->setRequired(true);
        $file->getFilterChain()->attachByName(
        'filerenameupload',
        array(
            'target'          => $options['galleryDir'],
            'overwrite'       => true,
            'use_upload_name' => true,
        )
        );
        $inputFilter->add($file);

        return $inputFilter;
    }
}