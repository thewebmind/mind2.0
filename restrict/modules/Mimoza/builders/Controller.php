<?php

Mimoza_Loader::loadClass('Mimoza_Builder');

/**
 * 
 * Construtor de Controladoras do Sistema
 * @author Wanderson Henrique Camargo Rosa
 *
 */
class Builder_Controller extends Mimoza_Builder
{
    public function build($element)
    {
        $this->author = $this->getProject()->getMindProject()->owner;
        $this->name   = ucfirst(strtolower($element->name));

        $primaries = array();
        foreach ($element->attributes as $attribute) {
            if ($attribute->pk) {
                $primaries[] = $attribute->name;
            }
        }
        $this->primaries = $primaries;

        return $this->render('controller.phtml');
    }
}