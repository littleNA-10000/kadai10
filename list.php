<?php
//セッションスタート
session_start();

require "funcs.php";

//ログインチェック処理
loginCheck();

//1.  DB接続します
$pdo = db_conn();

$countryname = $_GET["countryname"];
$startdate = $_GET["startdate"];
$enddate = $_GET["enddate"];
$comment = $_GET["comment"];
$timeseries_flag = $_GET["timeseries_flag"];
$date = $_GET["date"];
$countries_flag = $_GET["countries_flag"];

//２．データ取得SQL作成
// $stmt = $pdo->prepare("INSERT INTO oxcgrt_list(id,countryname,startdate,enddate,comment, timeseries_flag,date,countries_flag)VALUES(NULL,:a1,:a2,:a3,:a4,:a5,:a6,:a7)");
// $stmt->bindValue(':a1', $countryname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':a2', $startdate, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':a3', $enddate, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':a4', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':a5', $timeseries_flag, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':a6', $date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':a7', $countries_flag, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $status = $stmt->execute();

$stmt = $pdo->prepare("SELECT * FROM oxcgrt_list WHERE member_id =".$_SESSION["member_id"]." ORDER BY id DESC");
$status = $stmt->execute();

//３．データ表示
$view="";
$view2="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
      if($result['timeseries_flag']==1){
        $view .= '<tr><td>'.$result['countryname'].'</td><td>'.$result['startdate'].'</td><td>'.$result['enddate'].'</td><td>'.$result['comment'].'</td><td>';
        $view .= '<a href="timeseries.php?id='.$result['id'].'&countryname='.$result['countryname'].'&startdate='.$result['startdate'].'&enddate='.$result['enddate'].'&comment='.$result['comment'].'">';
        $view .= "[ 表示・更新 ]";
        $view .= "</a></td><td>";
        $view .= '<a href="delete2.php?id='.$result['id'].'">';
        $view .= "[ 削除 ]";
        $view .= "</a></td></tr>";
      }
      else {
        $view2 .= '<tr><td>'.$result['date'].'</td><td>'.$result['comment'].'</td><td>';
        $view2 .= '<a href="countries.php?id='.$result['id'].'&date='.$result['date'].'&comment='.$result['comment'].'">';
        $view2 .= "[ 表示・更新 ]";
        $view2 .= "</a></td><td>";
        $view2 .= '<a href="delete2.php?id='.$result['id'].'">';
        $view2 .= "[ 削除 ]";
        $view2 .= "</a></td></tr>";
      }
  }

}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>保存用メモ</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- <link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet"> -->
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<nav>
    <a href="main.php">トップに戻る</a> | <a href="logout.php">ログアウトする</a><?if($_SESSION["kanri_flg"] == 1){echo' | <a href="member.php">管理用画面</a>';}?> | 
</nav>
<h1>
    保存用メモ
</h1>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
        <h2>
            時系列で比較する
        </h2>
        <table>
            <tr>
                <th>
                    国名
                </th>
                <th>
                    開始日
                </th>
                <th>
                    終了日
                </th>
                <th>
                    コメント
                </th>
                <th>
                    表示・更新
                </th>
                <th>
                    削除
                </th>
            </tr>
            <?=$view?>
        </table>
        <h2>
            国別に比較する
        </h2>
        <table>
            <tr>
                <th>
                    基準日
                </th>
                <th>
                    コメント
                </th>
            </tr>
            <?=$view2?>
        </table>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>