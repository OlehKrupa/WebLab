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

    foreach ($user as $U) {
     $registered[] = ["email" => $U["email"], "password"=> $U["password"]];
 }
 foreach($registered as $R){
     if (($loginEmail === $R["email"]) && ($loginPasswd === $R["password"])){
        echo($loginEmail." logined");

        $fileName = $R["email"].".json";
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

   } elseif (($loginEmail === $R["email"]) &&($loginPasswd != $R["password"])){
    echo($loginEmail." incorrect password");
    $fileName = $R["email"].".json";
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