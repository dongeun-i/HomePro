<?
	class codeRadio extends BaseInputLabel {
		public static function getCodeRadio($code_group_id, $name = '', $required = false) {
			// 데이터베이스 객체 생성
			$db = new Database();
	
			// 쿼리 작성
			$query = "SELECT 
						c.name,
						c.id
					  FROM
						code c
						INNER JOIN code_group cg ON c.code_group = cg.id 
						INNER JOIN code_category cc ON cc.id = cg.category_id 
					  WHERE c.is_use = 1 AND cg.id = $code_group_id";
			
			// 쿼리 실행
			$result = $db->query($query);
			$results = [];
	
			// 결과 처리
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$results[] = $row;
				}
			}
	
			// 데이터베이스 연결 종료
			//$db->close();
	
			// 옵션 설정
			$options['optionValue'] = 'id';
			$options['optionLabel'] = 'name';
	
			// 결과 빌더 호출
			return self::resultsBuilder($results, $options, $name, $required);
		}
	}
	

?>