<?php
/**
* Generate by TheWebMind 2.0 Software
* Controller Class for aluno
* @license	http://www.opensource.org/licenses/mit-license.php
* @link http://thewebmind.org
* @author	Jaydson Gomes <jaydson@thewebmind.org>
* @author	Felipe N. Moura <felipe@thewebmind.org>
* @version  1.0
*/
class AlunoController extends Zend_Controller_Action {
	/**
	* Overrides Zend_Controller_Action.init
	* Load classes needed
	*/
	public function init(){
		Zend_Loader::loadClass('Aluno');
	}

	/**
	* Redirect to View List
	*/
	public function indexAction(){
		$this->_redirect('Aluno/list');
	}

	/**
	* Action to add object Aluno
	* @return void
	*/
	public function addAction(){
		$view = Zend_Registry::get('view');
		$view->assign('header','pageHeader.phtml');
		$view->assign('body','Aluno/bodyAdd.phtml');
		$view->assign('footer','pageFooter.phtml');
		$this->_response->setBody($view->render('default.phtml'));
	}

	/**
	* Action to save object Aluno
	* @return void
	*/
	public function saveAction(){
		$table = new Aluno();
		$table->save();
		$this->_redirect('Aluno/list');
	}

	/**
	* Action to list object Aluno
	* @return void
	*/
	public function listAction(){
		$view = Zend_Registry::get('view');
		$table = new Aluno();
		$table->getCollection();
		$this->_response->setBody($view->render('default.phtml'));
	}

	/**
	* Action to edit object Aluno
	* @return void
	*/
	public function editAction(){
		$view = Zend_Registry::get('view');
		$table = new Aluno();
		$table->edit();
		$this->_response->setBody($view->render('default.phtml'));
	}

	/**
	* Action to remove object Aluno
	* @return void
	*/
	public function removeAction(){
		$table = new Aluno();
		$table->remove();
		$this->_redirect('aluno/list');

	}

}