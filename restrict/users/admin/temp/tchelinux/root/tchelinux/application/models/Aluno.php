<?php
/**
* Generate by TheWebMind 2.0 Software
* Model Class for Aluno
* @license	http://www.opensource.org/licenses/mit-license.php
* @link http://thewebmind.org
* @author	Jaydson Gomes <jaydson@thewebmind.org>
* @author	Felipe N. Moura <felipe@thewebmind.org>
* @version  1.0
*/
class Aluno extends Zend_Db_Table {
	protected $_name = 'aluno';
	protected $_dependentTables = array('ProfessorAluno');
	/**
	* Save an object Aluno into Database
	* @return void
	*/
	public function save(){
		$post = Zend_Registry::get('post');
		if(isset($post->pk_aluno)){
			$where = $this->getAdapter()->quoteInto('pk_aluno = ?', $post->pk_aluno);
			$data = array();
			$this->update($data,$where);
		}else{
				$data = array();
				$this->insert($data);
			};
	}

	/**
	* List of objects Aluno from Database
	* @return Collection of Aluno
	*/
	public function getCollection(){
		$view = Zend_Registry::get('view');
		$collection = $this->fetchAll();
		$view->assign('alunoCollection',$collection);
		$view->assign('header','pageHeader.phtml');
		$view->assign('body','Aluno/bodyList.phtml');
		$view->assign('footer','pageFooter.phtml');
		if(sizeof($collection)==0){
			$view->assign('message','Empty');
		}
	}

	/**
	* Edit an object Aluno
	* @return void
	*/
	public function edit(){
		$get = Zend_Registry::get('get');
		$view = Zend_Registry::get('view');
		if (!isset($get->id))
		{
			$this->_redirect('/Aluno/list');
			exit;
		}
		$id = (int)$get->id;
		$alunoSelected = $this->find($id)->toArray();
		$view->assign('aluno',$alunoSelected[0]);
		$view->assign('header','pageHeader.phtml');
		$view->assign('body','Aluno/bodyEdit.phtml');
		$view->assign('footer','pageFooter.phtml');
	}

	/**
	* Remove an object Aluno
	* @return void
	*/
	public function remove(){
		$get = Zend_Registry::get('get');
		if(!isset($get->id)){
			$this->_redirect('/Aluno/list');
			exit;
		}
		$pk_aluno = (int)$get->id;
		$where = $this->getAdapter()->quoteInto('pk_aluno = ?', $pk_aluno);
		$this->delete($where);
	}


}