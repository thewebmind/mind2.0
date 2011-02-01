<?php
/**
* Generate by TheWebMind 2.0 Software
* Controller Class for professor_aluno
* @license	http://www.opensource.org/licenses/mit-license.php
* @link http://thewebmind.org
* @author	Jaydson Gomes <jaydson@thewebmind.org>
* @author	Felipe N. Moura <felipe@thewebmind.org>
* @version  1.0
*/
class ProfessorAlunoController extends Zend_Controller_Action {
	/**
	* Overrides Zend_Controller_Action.init
	* Load classes needed
	*/
	public function init(){
		Zend_Loader::loadClass('ProfessorAluno');
		Zend_Loader::loadClass('Professor');
		Zend_Loader::loadClass('Aluno');
	}

	/**
	* Redirect to View List
	*/
	public function indexAction(){
		$this->_redirect('ProfessorAluno/list');
	}

	/**
	* Action to add object ProfessorAluno
	* @return void
	*/
	public function addAction(){
		$professor = new Professor();
		$aluno = new Aluno();
		$view = Zend_Registry::get('view');
		$view->assign('header','pageHeader.phtml');
		$view->assign('body','ProfessorAluno/bodyAdd.phtml');
		$view->assign('footer','pageFooter.phtml');
		$view->assign('professorCollection',$professor->fetchAll());
		$view->assign('alunoCollection',$aluno->fetchAll());
		$this->_response->setBody($view->render('default.phtml'));
	}

	/**
	* Action to save object ProfessorAluno
	* @return void
	*/
	public function saveAction(){
		$table = new ProfessorAluno();
		$table->save();
		$this->_redirect('ProfessorAluno/list');
	}

	/**
	* Action to list object ProfessorAluno
	* @return void
	*/
	public function listAction(){
		$view = Zend_Registry::get('view');
		$table = new ProfessorAluno();
		$table->getCollection();
		$this->_response->setBody($view->render('default.phtml'));
	}

	/**
	* Action to edit object ProfessorAluno
	* @return void
	*/
	public function editAction(){
		$view = Zend_Registry::get('view');
		$professor = new Professor();
		$view->assign('professorCollection',$professor->fetchAll());
		$aluno = new Aluno();
		$view->assign('alunoCollection',$aluno->fetchAll());
		$table = new ProfessorAluno();
		$table->edit();
		$this->_response->setBody($view->render('default.phtml'));
	}

	/**
	* Action to remove object ProfessorAluno
	* @return void
	*/
	public function removeAction(){
		$table = new ProfessorAluno();
		$table->remove();
		$this->_redirect('professor_aluno/list');

	}

}