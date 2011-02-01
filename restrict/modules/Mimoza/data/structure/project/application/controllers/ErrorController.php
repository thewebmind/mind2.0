<?php

class ErrorController extends Zend_Controller_Action
{
    public function errorAction()
    {
        Zend_Debug::dump($this->_getParam('error_handler'));
    }
}