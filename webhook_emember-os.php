<?php

header('Content-Type: text/html; charset=utf-8');

$data = json_decode($_POST['data'], true);	

# Ide kerül az emember-től kapott adat
$secretKey = "";
# erre a domain névre került az emembers hhtps:// és www nélkül
$domain = "";
# ide jön a membership level id
$membership_level_id = "";


###########################################################################
##      		         				         ##
##									 ##
##		Innen lefele már ne módosíts semmit	                 ##
##									 ##
###########################################################################	

if ($data["status"]=="true") {
	
	$postdata = array (
		"secret_key" => $secretKey,
		"email" => $data["email"]
	);
	
	$query = posteMember("https://".$domain."/wp-content/plugins/wp-eMember/api/query.php",$postdata);
	$user = json_decode($query);
	
	if ($user->member_id!="") {
		
		if ($user->account_state!="active") {
			$postdata = array (
				"secret_key" => $secretKey,
				"account_state" => "active",
				"member_id" => "",
				"email" => $data["email"]
			);
			
			$active = posteMember("https://".$domain."/wp-content/plugins/wp-eMember/api/deactivate.php",$postdata);
		}
		
		$postdata = array (
			"secret_key" => $secretKey,
			"member_id" => $user->member_id,
			"email" => $data["email"],
			"membership_level_id" => $user->member_data->membership_level+1
		);
		
		if ($user->member_data->membership_level==6) $postdata["membership_level_id"]=6;
		
		$update = posteMember("https://".$domain."/wp-content/plugins/wp-eMember/api/update.php",$postdata);
	
	} else {
		
		$name = explode(" ",$data["name"]);
			
		$postdata = array (
			"secret_key" => $secretKey,
			"first_name" => $name[0],
			"last_name" => $name[1],
			"email" => $data["email"],
			"membership_level_id" => $membership_level_id,
			"membership_level_name" => "",
			"username" => $data["email"],
			"password" => $data["trid"]
		);
		
		$create = posteMember("https://".$domain."/wp-content/plugins/wp-eMember/api/create.php",$postdata);
		
	}

} else {
	
	$postdata = array (
		"secret_key" => $secretKey,
		"member_id" => "",
		"account_state" => "inactive",
		"email" => $data["email"]
	);
		
	$deactive = posteMember("https://".$domain."/wp-content/plugins/wp-eMember/api/deactivate.php",$postdata);
	
}

function posteMember($url,$postdata) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($postdata));
	curl_setopt($ch, CURLOPT_USERAGENT, "SF WebHook");
	$response=curl_exec ($ch); 
	curl_close ($ch);
	return $response;
}

		
?>
