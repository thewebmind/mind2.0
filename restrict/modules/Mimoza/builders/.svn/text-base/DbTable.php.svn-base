<?php

Mimoza_Loader::loadClass('Mimoza_Builder');

/**
 * 
 * Classe Representativa de Tabelas de Banco de Dados
 * @author Wanderson Henrique Camargo Rosa
 *
 */
class Builder_DbTable extends Mimoza_Builder
{
    public function build($element)
    {
        $this->author = $this->getProject()->getMindProject()->owner;
        $this->name   = $element->name;
        $this->entity = ucfirst($element->name);

        $primaries = array();
        foreach ($element->attributes as $attribute) {
            if ($attribute->pk) {
                $primaries[] = $attribute->name;
            }
        }
        $this->primaries = $primaries;

        $dependencies = array();
        foreach ($element->refered as $refered) {
            $dependencies[] = ucfirst(substr($refered, strlen($this->name) + 1));
        }
        $this->dependencies = $dependencies;

        $map = array();
        foreach ($element->foreignKeys as $key) {
            $table = array_pop($key);
            $map[$table] = array_pop($key);
        }
        $this->map = $map;

        return $this->render('dbtable.phtml');
    }
}