<?php
$file = 'users.php';

$id = 0;
$name = $_POST['fname'];
$surname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['passwd'];
$repeatpasswd = $_POST['passwd2'];
$gender = $_POST['gender'];
$birth = $_POST['birth'];
$country = $_POST['country'];
$language = $_POST['language'];

$user = [];

echo "Registered: $name $surname, $gender, $birth, $country";
echo " Confidential: $email, $password, $repeatpasswd";
if (!strncmp($password, $repeatpasswd, 20)) {
    echo " !Paroles match! ";

    $data = file_get_contents($file);
    $user = unserialize($data);

    $id = random_int(1, 10000);

    $user[$id] = ["name" => $name,"surname"=>$surname, "gender"=>$gender, "birth"=>$birth, "country"=>$country, "language"=>$language, "email" => $email, "password"=>$password ];

    $data = serialize($user);
    file_put_contents($file, $data);

} else {
    echo " !Incorrect password! ";
}

//Задания с массивами
echo "<br/> Юзеров: ";
var_dump(count($user));
echo "<br/>";
//Сортировка
//krsort($user);

echo "<br/> Макс айди: ";
var_dump(array_key_first($user));
echo "<br/> Мин айди: ";
var_dump(array_key_last($user));
echo "<br/> ПредМакс айди: ";
next($user);
var_dump(key($user));
echo "<br/> ПредМин айди: ";
end($user);
prev($user);
var_dump(key($user));
//Удалить с мин айди
//array_pop($user);

//Приветствие
$greetings=["ua"=>"Привіт","ru"=>"Привет","en"=>"Hello","fr"=>"Salut","de"=>"Hallo","pl"=>"Hej"];

foreach($greetings as $id=>$gr)
{
    if(($user[array_key_first($user)]["language"] === $user[array_key_last($user)]["language"])&&($user[array_key_first($user)]["language"] === $id))
    {
        $first=$gr;
        $last="";
        break;
    }

    if ($user[array_key_first($user)]["language"] === $id)
        $first=$gr;

    if($user[array_key_last($user)]["language"] === $id)
        $last=$gr;
}

$message=$first." ".$last;
echo "<script type='text/javascript'>alert('$message');</script>";

//Задание 1
$nameUser = array_count_values(array_column($user,'name'));
unset($nameUser[array_search(1, $nameUser)]);

//Задание 2
$languageUser=[];
foreach ($user as $id=>$info)
{
    if(!array_key_exists($info["language"], $languageUser))
    {
       $languageUser[$info["language"]] = [$info];
   }
   else
   {
    array_push($languageUser[$info["language"]],$info);
}
}

//задание 3
$reverse_array=[];
//Зачем делать сложно если можно делать не сложно
$reverse_array=array_reverse($user, true);
//Якщо через цикл то for($i = count($user)-1; $i>=0; $i--)

echo '<pre>';
print_r($languageUser);
echo '</pre>';
?>