<?php

//POST値
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

//1.  DB接続します
require "funcs.php";
$pdo = db_conn();

//2. データ取得SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE lid = :lid');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
// $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //* Hash化する場合はコメントする
$status = $stmt->execute();


//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 同一IDが存在しなければ新規登録、同一IDがあれば新規登録画面に戻す

if(!isset($val["lid"])){
  //同名のIDが存在しないとき

  //パスワードをハッシュ化
  $lpw = password_hash($lpw,PASSWORD_DEFAULT);

  // IDとパスワードをDBに格納
  $stmt = $pdo->prepare("INSERT INTO gs_user_table(id,lid,lpw)VALUES(NULL,:a1,:a2)");
  $stmt->bindValue(':a1', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':a2', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $status = $stmt->execute();

  //４．データ登録処理後
  if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMassage:".$error[2]);

  }else{
    //５．index.phpへリダイレクト
    header('Location: thanks.html');
  }
} else{
  //同名のIDが存在するとき
  header("Location: register.php?tag=register_error");
}

exit();


?>