    <?php
    require_once "functions.php";
    $file = 'users.php';

    $loginEmail = $_POST['loginEmail'];
    $loginPasswd = $_POST['loginPasswd'];

    $data = file_get_contents($file);
    $user = unserialize($data);

    $registered=[];

    $correct=0;
    $incorrect=0;

    $login=[];
    $nonLogin=[];

    foreach ($user as $u) {
     $registered[] = ["email" => $u["email"], "password"=> $u["password"]];
 }
 foreach($registered as $r){
     if (($loginEmail === $r["email"]) && ($loginPasswd === $r["password"])){
        echo($loginEmail." logined");

        $fileName = $r["email"].".json";
        $data = file_get_contents($fileName);
        if (!$data)
        {
            $login["correct"]=1;
            $login["incorrect"]=0;
        }else{
           $login = json_decode($data, true); 
           $login["correct"]++;
       }


       $data = json_encode($login);
       file_put_contents($fileName, $data);
       return;

   } elseif (($loginEmail === $r["email"]) &&($loginPasswd != $r["password"])){
    echo($loginEmail." incorrect password");
    $fileName = $r["email"].".json";
    $data = file_get_contents($fileName);
    if (!$data)
    {
        $login["correct"]=0;
        $login["incorrect"]=1;
    }else{
       $login = json_decode($data, true); 
       $login["incorrect"]++;
   }
   $data = json_encode($login);
   file_put_contents($fileName, $data);
   return;
} 
}

echo("Unknown user");
$fileName = "user404".".json";
$data = file_get_contents($fileName);
if (!$data){
    $nonLogin["$loginEmail"]=1;
}else{
    $nonLogin=json_decode($data,true);
    if (array_key_exists($loginEmail, $nonLogin)){
        $nonLogin["$loginEmail"]++;
    }else{
        $nonLogin["$loginEmail"]=1;
    }
}   
$data = json_encode($nonLogin);
file_put_contents($fileName, $data);

?>