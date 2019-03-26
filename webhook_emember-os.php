<?

header('Content-Type: text/html; charset=utf-8');

$data = json_decode($_POST['data'], true);	

# Ide kerül az emember-től kapott adat
$secretKey = "";
#erre a domain névre került az emembers
$domain = "";


###################################################################
##               											     ##
##																 ##
##				Innen lefele már ne módosíts semmit				 ##
##																 ##
###################################################################	
if ($data["status"]=="true") {
	
	$postdata = array (
		"secret_key" => $secretKey,
		"email" => $data["email"]
	);
	
	$query = posteMember("http://".$domain."/wp-content/plugins/wp-eMember/api/query.php",$postdata);
	$user = json_decode($query);
	
	if ($user->member_id!="") {
		
		if ($user->account_state!="active") {
			$postdata = array (
				"account_state" => "active",
				"email" => $data["email"]
			);
			
			$active = posteMember("http://".$domain."/wp-content/plugins/wp-eMember/api/deactivate.php",$postdata);
		}
		
		$postdata = array (
			"member_id" => $user->member_id,
			"email" => $data["email"],
			"membership_level_id" => $user->membership_level+1
		);
		
		if ($user->membership_level==6) $postdata["membership_level_id"]=6;
		
		$update = posteMember("http://".$domain."/wp-content/plugins/wp-eMember/api/update.php",$postdata);
	
	} else {
		
		$name = split_name($data["name"]);
			
		$postdata = array (
			"first_name" => $name[0],
			"last_name" => $name[1],
			"email" => $data["email"],
			"membership_level_id" => 3
		);
		
		$create = posteMember("http://".$domain."/wp-content/plugins/wp-eMember/api/create.php",$postdata);
	
	}

} else {
	
	$postdata = array (
		"account_state" => "inactive",
		"email" => $data["email"]
	);
		
	$deactive = posteMember("http://".$domain."/wp-content/plugins/wp-eMember/api/deactivate.php",$postdata);

}

function posteMember($url,$postdata) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$response=curl_exec ($ch); 
	curl_close ($ch);
	return $response;
}

function split_name($name) {
    $name = trim($name);
    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
    return array($first_name, $last_name);
}
		
?>