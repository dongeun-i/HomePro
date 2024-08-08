<?
	class SalesQuery
	{
		public static function getList($option = [])
		{
			$where = '';
			if(count($option) > 0){
				if(isset($option['sales_kind'])){

					$where .= "AND sales_kind = $sales_kind";
				}
				if(isset($option['building_type'])){
					$where .= "AND sales_kind = $building_type";
				}
				if(isset($option['room_type'])){
					$where .= "AND sales_kind = $room_type";
				}
			}

			$query = "SELECT * FROM sales where 1=1 $where order by regi_dt desc";
			return $query;
		}
	}

?>