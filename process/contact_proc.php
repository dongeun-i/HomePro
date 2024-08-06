<?
require_once '../config/index.php';

// 유효성 검사
if (empty($_POST) || !isset($_POST['type']) || !isset($_POST['category'])) {
    $res_data['success'] = false;
    $res_data['msg'] = '올바르지 못한 접근입니다.';
    echo json_encode($res_data);
    exit;
}
extract($_POST);
$db = new Database();
$tel = $tel_01 . '-' .$tel_02.'-'.$tel_03;
if($mode == 'sellForm'){
	// 매매
	$insert_data = array(
		'sale_kind'=>$category,
		'building_type' => $type,
		'sales_dt' => $sale_date,
		'address' => $address,
		'detail_address' => $detail_address,
		'area' => $area,
		'meeting_dt' => $visit_date.' '.$visit_time,
		'requester' => $requester,
		'email' => $email,
		'tel' => $tel,
		'memo' => $memo,
		'regi_dt'=>date('Y-m-d H:i:s')
	);
	//print_r($insert_data);
	$result = $db->insert('sales',$insert_data);
	if($result > 0){
		$res_data['success'] = true;
		$res_data['msg'] = '등록이 완료되었습니다. 감사합니다.';
		
		
	}else{
		$res_data['success'] = false;
		$res_data['msg'] = '오류가 발생하였습니다.';
	}
	
    echo json_encode($res_data);
	

}elseif($mode=="buyForm"){
	// 매수
	$insert_data = array(
		'order_kind'=>$category,
		'building_type' => $type,
		'order_dt' => $order_date,
		'address' => $address,
		'detail_address' => $detail_address,
		'area' => $area,
		'meeting_dt' => $visit_date.' '.$visit_time,
		'requester' => $requester,
		'email' => $email,
		'tel' => $tel,
		'memo' => $memo,
		'regi_dt'=>date('Y-m-d H:i:s')
	);
	//print_r($insert_data);
	$result = $db->insert('orders',$insert_data);
	if($result > 0){
		$res_data['success'] = true;
		$res_data['msg'] = '등록이 완료되었습니다. 감사합니다.';
	}else{
		$res_data['success'] = false;
		$res_data['msg'] = '오류가 발생하였습니다.';
	}
    echo json_encode($res_data);

}else{
	// QA

}
?>