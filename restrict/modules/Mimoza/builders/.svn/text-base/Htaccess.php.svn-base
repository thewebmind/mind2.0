<?php

Mimoza_Loader::loadClass('Mimoza_Builder');

/**
 * 
 * Construtor de Arquivo de Configuração do Apache
 * @author Wanderson Henrique Camargo Rosa
 *
 */
class Builder_Htaccess extends Mimoza_Builder
{
    public function build($element)
    {
        $this->env = 'development';
        return $this->render('htaccess.phtml');
    }
}