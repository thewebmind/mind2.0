<?php

/**
 * 
 * Construtor da Classe de Inicialização do Sistema
 * @author Wanderson Henrique Camargo Rosa
 *
 */
class Builder_Bootstrap extends Mimoza_Builder
{
    public function build($element)
    {
        $mind = $this->getProject()->getMindProject();
        $this->name   = $mind->name;
        $this->author = $mind->owner;
        return $this->render('bootstrap.phtml');
    }
}