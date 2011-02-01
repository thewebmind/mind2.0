<?php

/**
 * 
 * Mimoza Project Abstract
 * Projeto do Mimoza para Encapsulamento de Projeto Webmind
 * Método de Acesso Rápido para Construtores de Informação
 * 
 * @author Wanderson Henrique Camargo Rosa
 * @see http://code.google.com/p/webmind/Mimoza
 * 
 * @uses Project
 * 
 * @package Mimoza
 * @subpackage Project
 *
 */
abstract class Mimoza_Project_Abstract
{
    /**
     * 
     * Projeto Padrão do Webmind
     * @var Project
     */
    protected $_project;

    /**
     * 
     * Construtor da Classe
     * @param Project $project Projeto do Webmind
     */
    public function __construct(Project $project)
    {
        $this->_setMindProject($project);
        $this->init();
    }

    /**
     * 
     * Configuração do Ponteiro para Projeto Webmind
     * @param Project $project Projeto Padrão Webmind
     * @return Mimoza_Project_Abstract Próprio Objeto
     */
    protected function _setMindProject(Project $project)
    {
        $this->_project = $project;
        return $this;
    }

    /**
     * 
     * Informação do Ponteiro para Projeto Webmind
     * @return Project Projeto Configurado do Webmind
     */
    public function getMindProject()
    {
        return $this->_project;
    }

    /**
     * 
     * Método Mágico
     * Captura de Métodos não Informados na Construção da Classe
     * Proxy para Construção Automática de Construtores de Informação do Mimoza
     * @param string $method Nome do Método Capturado
     * @param array $args Parâmetros Informados ao Método
     * @return Mimoza_Project_Abstract|string Resultado da Execução do Método
     */
    public function __call($method, $args)
    {
        if (preg_match('/^build/', $method)) {
            $class = 'Builder_' . substr($method, 5);
            Mimoza_Loader::loadClass($class);
            $builder = new $class($this);
            return $builder->build(current($args));
        } else {
            Mimoza_Loader::loadClass('Mimoza_Loader_Exception');
            $message = sprintf(
                'Unrecognized method "%s" in Project Class', $method);
            throw new Mimoza_Loader_Exception($message);
        }
        return $this;
    }

    /**
     * 
     * Método para Inicialização e Sobrescrita em Herança
     * @return Mimoza_Project_Abstract Próprio Objeto
     */
    public function init()
    {
        return $this;
    }

}