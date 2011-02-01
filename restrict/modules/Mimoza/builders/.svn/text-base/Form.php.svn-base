<?php

Mimoza_Loader::loadClass('Mimoza_Builder');

class Builder_Form extends Mimoza_Builder
{
    public function build($element)
    {
        $this->name = ucfirst($element->name);
        $this->attributes = $element->attributes;
        return $this->render('form.phtml');
    }
}