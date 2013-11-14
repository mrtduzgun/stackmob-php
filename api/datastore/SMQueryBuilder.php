	
<?php

/**
 *	Simple Active Record Pattern onto Rest Api Url
 * 
 * 	@author Murat Duzgun
 * 
*/

class SMQueryBuilder {

	private $query = "";
	private $where = array();
	private $depth = 0;
	private $selectedFields = array();

	public function __construct() {
	}

	/**
	 *	"SELECT" query
	 * 
	 * 	@param array $fields selected fields, it shows "SELECT *" query if fields is empty
	 *  @example $a->select(array('field1', array('field2' => 'f2'), 'field3')) means "SELECT field1, field2 AS f2, field3"
	*/
	protected function select($fields = array()) {

	}

	protected function from($tableName) {

	}

	protected function where($field, $value, $op = "=") {

	}

	protected function orWhere($field, $value, $op = "=") {

	}

	protected function orderByDesc($field) {

	}

	protected function orderByAsc($field) {

	}

	protected function limit($length, $offset = 0) {

	}

	protected function join($tableName) {

	}

	protected function on($field, $value, $op = "=") {

	}

	protected function insert($tableName, $data) {

		$insertedData = array();

		if (!empty($data)) {
			if (is_array($data)) {
				$insertedData = $data;
			} else if (is_object($data)) {
				$insertedData = (array)$data;
			}
		}
	}

	protected function update($tableName, $data = array()) {

	}

	protected function delete($tableName, $where = array()) {

	}

	protected function setWhereCondition() {

	}
}

?>