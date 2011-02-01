<?php

Mimoza_Loader::loadClass('Mimoza_Builder');

/**
 * Construtor da Camada de Visualização
 * Ação para Criar um Novo Elemento
 * @author Wanderson Henrique Camargo Rosa
 */
class Builder_ViewCreate extends Mimoza_Builder
{
    public function build($element)
    {
        return $this->render('viewcreate.phtml');
    }
}