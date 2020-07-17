<?php

//セッションスタート
session_start();

require "funcs.php";

//ログインチェック処理
loginCheck();

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
// $name = $_POST["name"];
// $email = $_POST["email"];
// $naiyou = $_POST["naiyou"];
$countryname = $_GET["countryname"];
$startdate = $_GET["startdate"];
$enddate = $_GET["enddate"];
$comment = $_GET["comment"];
$timeseries_flag = $_GET["timeseries_flag"];
$date = $_GET["date"];
$countries_flag = $_GET["countries_flag"];
$member_id = $_SESSION["member_id"];

//2. DB接続します
$pdo = db_con();

//３．データ登録SQL作成
// $stmt = $pdo->prepare("INSERT INTO gs_an_table(id,name,email,text,indate)VALUES(NULL,:a1,:a2,:a3,sysdate())");
if($timeseries_flag==1){
$stmt = $pdo->prepare("INSERT INTO oxcgrt_list(id,countryname,startdate,enddate,comment,timeseries_flag,member_id)VALUES(NULL,:a1,:a2,:a3,:a4,:a5,:a6)");
$stmt->bindValue(':a1', $countryname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $startdate, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $enddate, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $comment, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $timeseries_flag, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a6', $member_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
}
else {$stmt = $pdo->prepare("INSERT INTO oxcgrt_list(id,comment,date,countries_flag,member_id)VALUES(NULL,:a4,:a6,:a7,:a8)");
$stmt->bindValue(':a4', $comment, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a6', $date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a7', $countries_flag, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a8', $member_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
}

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);

}else{
  //５．index.phpへリダイレクト
  header('Location: list.php');
 
}


?>
