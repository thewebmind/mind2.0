<?php

Mimoza_Loader::loadClass('Mimoza_Builder');

/**
 * 
 * Arquivo de Configuração do Aplicativo Zend Framework
 * @author Wanderson Henrique Camargo Rosa
 *
 */
class Builder_Configuration extends Mimoza_Builder
{
    public function build($element)
    {
        $project = $this->getProject();
        $mind = $project->getMindProject();

        $this->adapter = $this->convertPdo($mind->dbms);

        $this->production = array(
            'host'     => $mind->environment['production']['dbAddress'],
            'dbname'   => $mind->environment['production']['dbName'],
            'username' => $mind->environment['production']['user'],
            'password' => $mind->environment['production']['userPwd'],
        );

        $this->development = array(
            'host'     => $mind->environment['development']['dbAddress'],
            'dbname'   => $mind->environment['development']['dbName'],
            'username' => $mind->environment['development']['user'],
            'password' => $mind->environment['development']['userPwd'],
        );

        return $this->render('configuration.phtml');
    }

    /**
     * 
     * Conversão de Tipo de Banco de Dados
     * @param string $source Nome de Banco de Dados do Webmind
     * @return string Nome de Adaptador de Banco de Dados do Zend Framework
     */
    public function convertPdo($source)
    {
        $adapter = null;
        switch(strtolower($source)) {
            case 'mysql':
                $adapter = 'pdo_mysql';
                break;
            case 'postgresql':
                $adapter = 'pdo_pgsql';
                break;
        }
        return $adapter;
    }
}