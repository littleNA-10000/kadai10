<?php

//セッションスタート
session_start();

require "funcs.php";

//ログインチェック処理
loginCheckManager();

//1.  DB接続します
$pdo = db_conn();

$search = $_POST["search"];

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid LIKE '%$search%'ORDER BY id ASC");
$status = $stmt->execute();

  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
        $response[] = $result['lid'];
  }
echo json_encode($response);


//３．データ表示
// $view="";
// if($status==false) {
//     //execute（SQL実行時にエラーがある場合）
//   $error = $stmt->errorInfo();
//   exit("ErrorQuery:".$error[2]);

// }else{
//   //Selectデータの数だけ自動でループしてくれる
//   //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
//   while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
//         $view .= '<tr><td>'.$result['id'].'</td><td>'.$result['lid'].'</td><td>'.$result['lpw'].'</td><td>'.$result['kanri_flg'].'</td><td>'.$result['life_flg'].'</td><td>';
//         $view .= '<a href="delete_member.php?id='.$result['id'].'">';
//         $view .= "[ 削除 ]";
//         $view .= "</a></td></tr>";
//   }
// }

// $a = array(
//   'HPI',
//   'Kyosho',
//   'Losi',
//   'Tamiya',
//   'Team Associated',
//   'Team Durango',
//   'Traxxas',
//   'Yokomo'
// );

// echo json_encode($a);

// $b = array();

// if($_POST['param1']){
//   $w = $_POST['param1'];  
//   foreach($a as $i){
//     if(stripos($i, $w) !== FALSE){
//       $b[] = $i;
//     }
//   }
//   echo json_encode($b);
// }
// else{
//   echo json_encode($b);
// }
?>