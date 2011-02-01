<?php

require_once realpath(dirname(__FILE__) . '/library/Loader.php');

Mimoza_Loader::loadClass('Mimoza_Project');

/**
 * Mimoza
 * Mind Module for Zend Framework Applications
 * 
 * @author Wanderson Henrique Camargo Rosa
 * @see http://code.google.com/p/webmind/wiki/Mimoza
 * 
 * @uses Module
 * @uses Module_Interface
 */
class Mimoza extends Module implements Module_Interface
{
    /**
     * Diretório da Estrutura Inicial do Aplicativo
     * 
     * @var string Nome do Diretório da Estrutura
     */
    protected $_structure;

    /**
     * 
     * Projeto do Mimoza para Manipulação do Webmind
     * @var Mimoza_Project_Abstract
     */
    protected $_project;

    /**
     * 
     * Ferramenta de Construção do Webmind
     * @var FW
     */
    protected $_framework;

    /**
     * 
     * Construtor do Módulo
     * @param $project Projeto do Webmind
     */
    public function __construct(Project $project)
    {
        GLOBAL $_FW;
        $this->_setProject(new Mimoza_Project($project))
            ->_setFramework($_FW)->setStructure('structure');
    }

    /**
     * Configura a Localização da Estrutura Inicial
     * 
     * @param $structure Nome do Diretório da Estrutura
     * @return Mimoza Próprio Objeto
     */
    public function setStructure($structure)
    {
        $this->_structure = (string) $structure;
        return $this;
    }

    /**
     * Informa o Nome do Diretório da Estrutura Inicial
     * 
     * @return string Nome do Diretório
     */
    public function getStructure()
    {
        return $this->_structure;
    }

    /**
     * 
     * Configuração do Projeto do Mimoza
     * @param $project Mimoza
     * @return Mimoza Próprio Objeto
     */
    protected function _setProject(Mimoza_Project_Abstract $project)
    {
        $this->_project = $project;
        return $this;
    }

    /**
     * 
     * Informação do Projeto do Mimoza Configurado
     * @return Mimoza_Project_Abstract Projeto Configurado
     */
    public function getProject()
    {
        return $this->_project;
    }

    /**
     * 
     * Configuração da Ferramenta de Construção do Webmind
     * @param FW $framework Ferramenta
     * @return Mimoza Próprio Objeto
     */
    protected function _setFramework(FW $framework)
    {
        $this->_framework = $framework;
        return $this;
    }

    /**
     * 
     * Informação da Ferramenta de Construção do Webmind
     * @return FW Objeto Ferramenta
     */
    public function getFramework()
    {
        return $this->_framework;
    }

    /**
     * Execuções em Tempo de Inicialização
     * Métodos Necessários para Execução Inicial do Módulo
     * Criação da Estrutura Inicial
     * 
     * @return Mimoza Próprio Objeto
     */
    public function onStart()
    {
        $htaccess = $this->getProject()->buildHtaccess(null);
        $this->getFramework()->mkFile('project/public/.htaccess', $htaccess);
        $configuration = $this->getProject()->buildConfiguration(null);
        $this->getFramework()->mkFile('project/application/configs/application.ini', $configuration);
        $bootstrap = $this->getProject()->buildBootstrap(null);
        $this->getFramework()->mkFile('project/application/Bootstrap.php', $bootstrap);
        return $this;
    }

    /**
     * Execuções em Tempo de Finalização
     * Métodos Necessários para Execução Final do Módulo
     * 
     * @return Mimoza Próprio Objeto
     */
    public function onFinish()
    {
        return $this;
    }

    /**
     * Aplica as Estruturas de Programação Referentes à Entidade
     * 
     * @param Table $entity
     * @return Mimoza Próprio Objeto
     */
    public function applyCRUD($entity)
    {
        $name = ucfirst(strtolower($entity->name));
        $controller = $this->getProject()->buildController($entity);
        $this->getFramework()->mkFile("project/application/controllers/{$name}Controller.php", $controller);
        $dbtable = $this->getProject()->buildDbTable($entity);
        $this->getFramework()->mkFile("project/application/models/DbTable/{$name}.php", $dbtable);
        $form = $this->getProject()->buildForm($entity);
        $this->getFramework()->mkFile("project/application/forms/{$name}.php", $form);

        $directory = "project/application/views/scripts/{$entity->name}";
        $this->getFramework()->mkDir($directory);
        $create = $this->getProject()->buildViewCreate($entity);
        $this->getFramework()->mkFile($directory . "/create.phtml", $create);
        $delete = $this->getProject()->buildViewDelete($entity);
        $this->getFramework()->mkFile($directory . "/delete.phtml", $delete);
        $update = $this->getProject()->buildViewUpdate($entity);
        $this->getFramework()->mkFile($directory . "/update.phtml", $update);
        $index = $this->getProject()->buildViewIndex($entity);
        $this->getFramework()->mkFile($directory . "/index.phtml", $index);
        return $this;
    }

    /**
     * Chamadas para Métodos Extras Conforme Necessidade
     * 
     * @return Mimoza Próprio Objeto
     */
    public function callExtra()
    {
        return $this;
    }
}