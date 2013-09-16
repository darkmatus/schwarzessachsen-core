<?php
namespace SchwarzesSachsenCore\Filter;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ImageUploadFilter implements InputFilterAwareInterface
{
    public $upload;
    protected $_inputFilter;

    public function exchangeArray($data)
    {
        $this->upload  = (isset($data['upload']))  ? $data['upload']     : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception('Nicht genutzt!');
    }

    public function getInputFilter()
    {
        if (!$this->_inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add(
            $factory->createInput(array(
                'name'     => 'upload',
                'required' => true,
                ))
            );

            $this->_inputFilter = $inputFilter;
        }

        return $this->_inputFilter;
    }
}