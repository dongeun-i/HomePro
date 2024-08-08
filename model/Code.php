<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/config/index.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/model/query/CodeQuery.php';

	class Code{
		public static function getSelectOne($id){
			$db = new Database();

			$result = $db->query(CodeQuery::getSelectOne($id));

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$results[]= $row;
				}
			} else {
				echo "No results found.";
			}			

			return $results[0];
		}
	}
	

?>