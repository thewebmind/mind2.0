<?php
/**
* Generate by TheWebMind 2.0 Software
* Model Class for Mae
* @license	http://www.opensource.org/licenses/mit-license.php
* @link http://thewebmind.org
* @author	Jaydson Gomes <jaydson@thewebmind.org>
* @author	Felipe N. Moura <felipe@thewebmind.org>
* @version  1.0
*/
class Mae extends Zend_Db_Table {
	protected $_name = 'mae';

	protected $_referenceMap = array('Professor' => Array('columns'   => Array('fk_professor'),
													    'refTableClass'   => 'Professor',
													    'refColumns'   => Array('pk_professor')
														)
										);
	/**
	* Save an object Mae into Database
	* @return void
	*/
	public function save(){
		$post = Zend_Registry::get('post');
		if(isset($post->pk_mae)){
			$where = $this->getAdapter()->quoteInto('pk_mae = ?', $post->pk_mae);
			$data = array('fk_professor' => $post->pk_professor);
			$this->update($data,$where);
		}else{
				$data = array('fk_professor' => $post->pk_professor);
				$this->insert($data);
			};
	}

	/**
	* List of objects Mae from Database
	* @return Collection of Mae
	*/
	public function getCollection(){
		$view = Zend_Registry::get('view');
		$collection = $this->fetchAll();
		$view->assign('maeCollection',$collection);
		$view->assign('header','pageHeader.phtml');
		$view->assign('body','Mae/bodyList.phtml');
		$view->assign('footer','pageFooter.phtml');
		if(sizeof($collection)==0){
			$view->assign('message','Empty');
		}
	}

	/**
	* Edit an object Mae
	* @return void
	*/
	public function edit(){
		$get = Zend_Registry::get('get');
		$view = Zend_Registry::get('view');
		if (!isset($get->id))
		{
			$this->_redirect('/Mae/list');
			exit;
		}
		$id = (int)$get->id;
		$maeSelected = $this->find($id)->toArray();
		$view->assign('mae',$maeSelected[0]);
		$view->assign('header','pageHeader.phtml');
		$view->assign('body','Mae/bodyEdit.phtml');
		$view->assign('footer','pageFooter.phtml');
	}

	/**
	* Remove an object Mae
	* @return void
	*/
	public function remove(){
		$get = Zend_Registry::get('get');
		if(!isset($get->id)){
			$this->_redirect('/Mae/list');
			exit;
		}
		$pk_mae = (int)$get->id;
		$where = $this->getAdapter()->quoteInto('pk_mae = ?', $pk_mae);
		$this->delete($where);
	}


}