<?
	class QaQuery
	{
		public static function getQaList()
		{
			$query = "SELECT * FROM qa";
			return $query;
		}

		public static function selectOne($id)
		{
			$query = "SELECT * FROM qa where id = $id";
			return $query;
		}
	}

?>