<?
	class OrdersQuery
	{
		public static function getList($option = [])
		{
			$where = '';
			if(count($option) > 0){
				if(isset($option['order_kind'])){
					$where .= "AND order_kind = $order_kind";
				}
				if(isset($option['building_type'])){
					$where .= "AND order_kind = $building_type";
				}
				if(isset($option['room_type'])){
					$where .= "AND order_kind = $room_type";
				}
			}

			$query = "SELECT * FROM orders where 1=1 $where order by regi_dt desc";
			return $query;
		}
	}

?>