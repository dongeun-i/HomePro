<?
	class codeSelect extends BaseSelect{
		public static function getCodeSelect($code_group_id){
			$db = new Database();

			$query = "SELECT 
						c.name,
						c.id
					FROM
						code c
						inner join code_group cg ON c.code_group =  cg.id 
						inner join code_category cc on cc.id = cg.category_id 
					where c.is_use  =1 and cg.id= $code_group_id";
			$result = $db->query($query);

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$results[]= $row;
				}
			} else {
				echo "No results found.";
			}			
			$options['optionValue'] = 'id';
			$options['optionLabel'] = 'name';

			return self::resultsBuilder($results, $options);

			

		}
	}
	

?>