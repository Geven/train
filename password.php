<?php
session_start();
$_SESSION['loggedIn'] = false;

if($_SESSION['loggedIn']){
    //echo 'The session is turned on';
    header('log.pro.txt');
}

class checkUser
{
    public $row;
    public $error;
    public function DbConnect()
    {
        $conn = new mysqli('localhost', 'root', '', 'demosite');
        if (!$conn) {
            echo 'Can\'t establish database connection' . mysqli_error($conn);
        }

        if (isset($_POST['login']) AND isset($_POST['password']) AND isset($_POST['gender']) AND !empty($_POST['login']) AND !empty($_POST['password'])) {
            $username = trim($_POST['login']);
            $password = trim($_POST['password']);
            $gender = $_POST['gender'];
            $product_type = $_POST['product_type'];

            $stmt = $conn->prepare('SELECT id from users WHERE login = ? AND password=?');
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            $row = $result->fetch_array(MYSQL_NUM);

            if($row[0] !== NULL){
                echo '<div style="position:absolute; top:150px; left:600px; ">This username has already being taken!</div>';
            }

            else {
                $stmt_insert = $conn->prepare('INSERT INTO users(login, password, gender, location) VALUES(?,?,?,?)');
                $stmt_insert->bind_param('ssss', $username, $password, $gender, $product_type);
                $stmt_insert->execute();
            }

        }

    }

}

$checkUser = new checkUser();
$checkUser->DbConnect();
?>

<html>
<head>
    <meta charset="utf-8" content="application/http" http-equiv="Content-Type: utf-8">
    <link href="main.css" rel="stylesheet"/>
</head>
<div class="wrapper">

    <form action = "password.php" method = "post">

        <div class="form_login">
            <label>Логин</label>
            <input type = "text" name="login" />
        </div>
        <div class="password_login">
            <label>Пароль</label>
            <input type="password" name="password">
        </div>
        <div class="gender_male">
            <label>Пол</label>
            <select class="gender_selection" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

        </div>
        <div class="product_type">
            <label>Тип аккаунта</label>
         <div class="radio_buttons">
        <input type="radio" name="product_type" value="Customer">Продавец<br/>
        <input type="radio" name="product_type" value="Vendor">Покупатель
        </div>
        </div>

        <div class="dob">
            <label>Выберите год Вашего рождения</label>
            <select>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>

            </select>

        </div>
        <div class="submit_button">
            <input type="submit" value="Зарегистрироваться">
        </div>
    </form>

</div>
</html>