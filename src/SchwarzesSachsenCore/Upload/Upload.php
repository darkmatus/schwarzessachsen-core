<?php
namespace SchwarzesSachsenCore\Upload;

use Zend\Validator\File\Extension;

use Zend\Validator\File\Size;

class Upload
{
    protected $_fileSrcPathname;
    protected $_error;
    protected $_imageSupported;
    protected $_options;
    protected $_uploaded;

    public function __construct($sm)
    {
        if (null === $this->_options) {
            $config = $sm->get('config');
            $this->_options = $config['image_config'];
        }
    }

    function uploadFile($form, $file, $image = null)
    {
        $options = $this->_options;
        $size = new Size(array(
            'min' => $options['min'],
            'max' => $options['max']
        ));
        $type = new Extension($options['allowedExtensions']);

        $adapter = new \Zend\File\Transfer\Adapter\Http();
        $adapter->setValidators(array($size, $type), $file['name']);
        if ((!$adapter->isValid()) || file_exists($options['galleryDir'] . $file['name'])) {
            $dataError = $adapter->getMessages();
            $error = array();
            foreach ($dataError as $key => $row) {
                $error[] = $row;
            }

            if (file_exists($options['galleryDir'] . $file['name'])) {
                $error[] = 'Die Datei ' . $file['name'] . ' existiert bereits. Bitte umbenennen';
            }

            return $error;
        } else {
            $adapter->setDestination($options['galleryDir']);
            if ($adapter->receive($file['name'])) {
                if ($image != null) {
                    $image->exchangeArray($form->getData());
                    return array('error' => '');
                }
            }
        }
    }
}