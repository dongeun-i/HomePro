<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/config/index.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/model/query/ordersQuery.php';

	class Orders{
		public static function getList($option){
			$db = new Database();
			$result = $db->query(ordersQuery::getList($option));

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$results[]= $row;
				}
			} else {
				echo "No results found.";
			}			

			return $results;
		}
	}
	

?>