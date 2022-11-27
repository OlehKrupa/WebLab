<?php
function OpenFile (string $fileName){
	if(is_file($fileName)){
		$data = file_get_contents($fileName);
		$user = unserialize($data);
		return $user;
	}
	else{
		return "File404";
	}

}
function IsUser (string $email, string $password, array $users){
	foreach ($users as $key => $value) {
		if (($value['email']===$email)&&($value['password']===$password)){
			return $users;
		} elseif ($value['email']===$email){
			return "IncorrectPassword";
		}
	}
	return "UserNotFound";
}
?>