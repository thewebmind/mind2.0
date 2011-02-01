<?php
/**
* Generate by TheWebMind 2.0 Software
* Controller Class for professor
* @license	http://www.opensource.org/licenses/mit-license.php
* @link http://thewebmind.org
* @author	Jaydson Gomes <jaydson@thewebmind.org>
* @author	Felipe N. Moura <felipe@thewebmind.org>
* @version  1.0
*/
class ProfessorController extends Zend_Controller_Action {
	/**
	* Overrides Zend_Controller_Action.init
	* Load classes needed
	*/
	public function init(){
		Zend_Loader::loadClass('Professor');
	}

	/**
	* Redirect to View List
	*/
	public function indexAction(){
		$this->_redirect('Professor/list');
	}

	/**
	* Action to add object Professor
	* @return void
	*/
	public function addAction(){
		$view = Zend_Registry::get('view');
		$view->assign('header','pageHeader.phtml');
		$view->assign('body','Professor/bodyAdd.phtml');
		$view->assign('footer','pageFooter.phtml');
		$this->_response->setBody($view->render('default.phtml'));
	}

	/**
	* Action to save object Professor
	* @return void
	*/
	public function saveAction(){
		$table = new Professor();
		$table->save();
		$this->_redirect('Professor/list');
	}

	/**
	* Action to list object Professor
	* @return void
	*/
	public function listAction(){
		$view = Zend_Registry::get('view');
		$table = new Professor();
		$table->getCollection();
		$this->_response->setBody($view->render('default.phtml'));
	}

	/**
	* Action to edit object Professor
	* @return void
	*/
	public function editAction(){
		$view = Zend_Registry::get('view');
		$table = new Professor();
		$table->edit();
		$this->_response->setBody($view->render('default.phtml'));
	}

	/**
	* Action to remove object Professor
	* @return void
	*/
	public function removeAction(){
		$table = new Professor();
		$table->remove();
		$this->_redirect('professor/list');

	}

}