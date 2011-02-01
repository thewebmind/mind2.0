<?php

Mimoza_Loader::loadClass('Mimoza_Builder');

/**
 * Construtor da Camada de Visualização
 * Ação para Visualização de Elementos
 * @author Wanderson Henrique Camargo Rosa
 */
class Builder_ViewIndex extends Mimoza_Builder
{
    public function build($element)
    {
        $this->columns = $element->attributes;
        $primaries = array();
        foreach ($element->attributes as $attribute) {
            if ($attribute->pk) {
                $primaries[] = $attribute->name;
            }
        }
        $this->primaries = $primaries;
        return $this->render('viewindex.phtml');
    }
}