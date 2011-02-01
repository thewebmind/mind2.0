<?php
/**
* Generate by TheWebMind 2.0 Software
* Controller Class for mae
* @license	http://www.opensource.org/licenses/mit-license.php
* @link http://thewebmind.org
* @author	Jaydson Gomes <jaydson@thewebmind.org>
* @author	Felipe N. Moura <felipe@thewebmind.org>
* @version  1.0
*/
class MaeController extends Zend_Controller_Action {
	/**
	* Overrides Zend_Controller_Action.init
	* Load classes needed
	*/
	public function init(){
		Zend_Loader::loadClass('Mae');
		Zend_Loader::loadClass('Professor');
	}

	/**
	* Redirect to View List
	*/
	public function indexAction(){
		$this->_redirect('Mae/list');
	}

	/**
	* Action to add object Mae
	* @return void
	*/
	public function addAction(){
		$professor = new Professor();
		$view = Zend_Registry::get('view');
		$view->assign('header','pageHeader.phtml');
		$view->assign('body','Mae/bodyAdd.phtml');
		$view->assign('footer','pageFooter.phtml');
		$view->assign('professorCollection',$professor->fetchAll());
		$this->_response->setBody($view->render('default.phtml'));
	}

	/**
	* Action to save object Mae
	* @return void
	*/
	public function saveAction(){
		$table = new Mae();
		$table->save();
		$this->_redirect('Mae/list');
	}

	/**
	* Action to list object Mae
	* @return void
	*/
	public function listAction(){
		$view = Zend_Registry::get('view');
		$table = new Mae();
		$table->getCollection();
		$this->_response->setBody($view->render('default.phtml'));
	}

	/**
	* Action to edit object Mae
	* @return void
	*/
	public function editAction(){
		$view = Zend_Registry::get('view');
		$professor = new Professor();
		$view->assign('professorCollection',$professor->fetchAll());
		$table = new Mae();
		$table->edit();
		$this->_response->setBody($view->render('default.phtml'));
	}

	/**
	* Action to remove object Mae
	* @return void
	*/
	public function removeAction(){
		$table = new Mae();
		$table->remove();
		$this->_redirect('mae/list');

	}

}