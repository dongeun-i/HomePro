<?
require_once '../config/index.php';
// 유효성 검사
if (empty($_POST)) {
    $res_data['success'] = false;
    $res_data['msg'] = '올바르지 못한 접근입니다.';
    echo json_encode($res_data);
    exit;
}
extract($_POST);
$db = new Database();
if($mode == 'question'){
	$is_secrete = 0; // 초기화

	if (isset($_POST['is_secrete']) && $_POST['is_secrete'] == 'on') {
		$is_secrete = 1;
	} 
	
	$insert_data = array(
		'title'=> $title,
		'question' => $content,
		'password'=>$password,
		'name'=>$name,
		'is_secrete' => $is_secrete,
		'regi_dt'=>date('Y-m-d H:i:s')
	);
	$result = $db->insert('qa',$insert_data);
	if($result > 0){
		echo"<script>
			alert('등록이 완료되었습니다');
			if (window.opener) {
				window.opener.location.reload();
			}
			self.close();
			</script>";
	}else{
		echo"<script>alert('오류가 발생하였습니다.');self.close();</script>";
	}

}elseif($mode=="answer"){

	$update_data = array(
		'answer_dt'=>date('Y-m-d H:i:s'),
		'is_answer' => 1,
		'answer' =>$answer
	);
	//print_r($insert_data);
	$result = $db->update('qa',$update_data,array('id'=>$id));
	if($result > 0){
		echo"<script>
		alert('등록이 완료되었습니다');
		if (window.opener) {
			window.opener.location.reload();
		}
		self.close();
		</script>";
	}else{
		echo"<script>alert('오류가 발생하였습니다.');self.close();</script>";
	}
    // echo json_encode($res_data);

}
?>