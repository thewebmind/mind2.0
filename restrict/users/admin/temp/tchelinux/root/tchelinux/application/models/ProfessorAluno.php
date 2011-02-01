<?php
/**
* Generate by TheWebMind 2.0 Software
* Model Class for ProfessorAluno
* @license	http://www.opensource.org/licenses/mit-license.php
* @link http://thewebmind.org
* @author	Jaydson Gomes <jaydson@thewebmind.org>
* @author	Felipe N. Moura <felipe@thewebmind.org>
* @version  1.0
*/
class ProfessorAluno extends Zend_Db_Table {
	protected $_name = 'professor_aluno';

	protected $_referenceMap = array('Professor' => Array('columns'   => Array('fk_professor'),
													    'refTableClass'   => 'Professor',
													    'refColumns'   => Array('pk_professor')
														),
									  'Aluno' => Array('columns'   => Array('fk_aluno'),
													    'refTableClass'   => 'Aluno',
													    'refColumns'   => Array('pk_aluno')
														)
										);
	/**
	* Save an object ProfessorAluno into Database
	* @return void
	*/
	public function save(){
		$post = Zend_Registry::get('post');
		if(isset($post->pk_professor_aluno)){
			$where = $this->getAdapter()->quoteInto('pk_professor_aluno = ?', $post->pk_professor_aluno);
			$data = array('fk_professor' => $post->pk_professor,
						  'fk_aluno' => $post->pk_aluno);
			$this->update($data,$where);
		}else{
				$data = array('fk_professor' => $post->pk_professor,
							  'fk_aluno' => $post->pk_aluno);
				$this->insert($data);
			};
	}

	/**
	* List of objects ProfessorAluno from Database
	* @return Collection of ProfessorAluno
	*/
	public function getCollection(){
		$view = Zend_Registry::get('view');
		$collection = $this->fetchAll();
		$view->assign('professor_alunoCollection',$collection);
		$view->assign('header','pageHeader.phtml');
		$view->assign('body','ProfessorAluno/bodyList.phtml');
		$view->assign('footer','pageFooter.phtml');
		if(sizeof($collection)==0){
			$view->assign('message','Empty');
		}
	}

	/**
	* Edit an object ProfessorAluno
	* @return void
	*/
	public function edit(){
		$get = Zend_Registry::get('get');
		$view = Zend_Registry::get('view');
		if (!isset($get->id))
		{
			$this->_redirect('/ProfessorAluno/list');
			exit;
		}
		$id = (int)$get->id;
		$professor_alunoSelected = $this->find($id)->toArray();
		$view->assign('professor_aluno',$professor_alunoSelected[0]);
		$view->assign('header','pageHeader.phtml');
		$view->assign('body','ProfessorAluno/bodyEdit.phtml');
		$view->assign('footer','pageFooter.phtml');
	}

	/**
	* Remove an object ProfessorAluno
	* @return void
	*/
	public function remove(){
		$get = Zend_Registry::get('get');
		if(!isset($get->id)){
			$this->_redirect('/ProfessorAluno/list');
			exit;
		}
		$pk_professor_aluno = (int)$get->id;
		$where = $this->getAdapter()->quoteInto('pk_professor_aluno = ?', $pk_professor_aluno);
		$this->delete($where);
	}


}