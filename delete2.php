<?php

//セッションスタート
session_start();

require "funcs.php";

//ログインチェック処理
loginCheck();

//1. GETでidを取得
$id = $_GET["id"];

//2. DB接続します
$pdo = db_con();

//3. データ削除SQLを準備
$delete = $pdo->prepare("DELETE FROM oxcgrt_list WHERE id = :id");
$delete->bindValue(":id", $id, PDO::PARAM_INT);//PARAM_STR

//4. SQL実行
$status = $delete->execute();

//5. 一覧ページへ戻す
if ($status == false) { 
    //SQLエラー関数
    sql_error($delete);
  }else{
    redirect('list.php');
  }

?>
