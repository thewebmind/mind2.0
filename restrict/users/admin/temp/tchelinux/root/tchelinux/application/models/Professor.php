<?php
/**
* Generate by TheWebMind 2.0 Software
* Model Class for Professor
* @license	http://www.opensource.org/licenses/mit-license.php
* @link http://thewebmind.org
* @author	Jaydson Gomes <jaydson@thewebmind.org>
* @author	Felipe N. Moura <felipe@thewebmind.org>
* @version  1.0
*/
class Professor extends Zend_Db_Table {
	protected $_name = 'professor';
	protected $_dependentTables = array('ProfessorAluno', 
			                            'Mae');
	/**
	* Save an object Professor into Database
	* @return void
	*/
	public function save(){
		$post = Zend_Registry::get('post');
		if(isset($post->pk_professor)){
			$where = $this->getAdapter()->quoteInto('pk_professor = ?', $post->pk_professor);
			$data = array('nome' => $post->nome,
						  'salario' => $post->salario);
			$this->update($data,$where);
		}else{
				$data = array('nome' => $post->nome,
							  'salario' => $post->salario);
				$this->insert($data);
			};
	}

	/**
	* List of objects Professor from Database
	* @return Collection of Professor
	*/
	public function getCollection(){
		$view = Zend_Registry::get('view');
		$collection = $this->fetchAll();
		$view->assign('professorCollection',$collection);
		$view->assign('header','pageHeader.phtml');
		$view->assign('body','Professor/bodyList.phtml');
		$view->assign('footer','pageFooter.phtml');
		if(sizeof($collection)==0){
			$view->assign('message','Empty');
		}
	}

	/**
	* Edit an object Professor
	* @return void
	*/
	public function edit(){
		$get = Zend_Registry::get('get');
		$view = Zend_Registry::get('view');
		if (!isset($get->id))
		{
			$this->_redirect('/Professor/list');
			exit;
		}
		$id = (int)$get->id;
		$professorSelected = $this->find($id)->toArray();
		$view->assign('professor',$professorSelected[0]);
		$view->assign('header','pageHeader.phtml');
		$view->assign('body','Professor/bodyEdit.phtml');
		$view->assign('footer','pageFooter.phtml');
	}

	/**
	* Remove an object Professor
	* @return void
	*/
	public function remove(){
		$get = Zend_Registry::get('get');
		if(!isset($get->id)){
			$this->_redirect('/Professor/list');
			exit;
		}
		$pk_professor = (int)$get->id;
		$where = $this->getAdapter()->quoteInto('pk_professor = ?', $pk_professor);
		$this->delete($where);
	}


}