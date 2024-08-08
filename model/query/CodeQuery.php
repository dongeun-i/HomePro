<?
	class CodeQuery
	{
		public static function getSelectOne($id)
		{
			$query = "SELECT * FROM code where id = $id";
			return $query;
		}
	}

?>