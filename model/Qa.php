<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/config/index.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/model/query/QaQuery.php';

	class Qa{
		public static function getList($option){
			$db = new Database();
			$result = $db->query(QaQuery::getQaList($option));

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$results[]= $row;
				}
			} else {
				$results = [];
				//echo "No results found.";
			}			

			return $results;
		}
	}
?>