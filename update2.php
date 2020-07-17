<?php

//セッションスタート
session_start();

require "funcs.php";

//ログインチェック処理
loginCheck();

//1.POSTでデータを取得
$id = $_GET["id"];
$countryname = $_GET["countryname"];
$startdate = $_GET["startdate"];
$enddate = $_GET["enddate"];
$comment = $_GET["comment"];
$date = $_GET["date"];
$countries_flag = $_GET["countries_flag"];

//2.DB接続など
$pdo = db_con();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//基本的にinsert.phpの処理の流れと同じです。
if($timeseries_flag==1){
    $stmt = $pdo->prepare("UPDATE oxcgrt_list SET countryname=:a1, startdate=:a2, enddate=:a3, comment=:a4 WHERE id =:id");
    $stmt->bindValue(':a1', $countryname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':a2', $startdate, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':a3', $enddate, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':a4', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
    $status = $stmt->execute();
}else{
    $stmt = $pdo->prepare("UPDATE oxcgrt_list SET comment=:a4, date=:a5 WHERE id =:id");
    $stmt->bindValue(':a4', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':a5', $date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
    $status = $stmt->execute();
}


if($status==false) {
    //SQLエラー関数
    sql_error($stmt);
  }else{
    
   //一覧ページへ戻す
   redirect('list.php');
  }
?>

