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
$id = $_GET["id"];

//２．データ取得SQL作成
// $stmt = $pdo->prepare("SELECT * FROM oxcgrt_index WHERE CountryCode = 'USA' AND Date BETWEEN '2020-02-01' AND '2020-05-01' ORDER BY DATE");
$stmt = $pdo->prepare("SELECT * FROM oxcgrt_index WHERE CountryName = :a1 AND Date BETWEEN :a2 AND :a3 ORDER BY DATE");
$stmt->bindValue(':a1', $countryname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $startdate, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $enddate, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
    $result = $stmt->fetchAll();
    $daterange = array_column($result, 'Date');
    $c1 = array_column($result, 'C1_School closing');
    $c2 = array_column($result, 'C2_Workplace closing');
    $c3 = array_column($result, 'C3_Cancel public events');
    $c4 = array_column($result, 'C4_Restrictions on gatherings');
    $c5 = array_column($result, 'C5_Close public transport');
    $c6 = array_column($result, 'C6_Stay at home requirements');
    $c7 = array_column($result, 'C7_Restrictions on internal movement');
    $c8 = array_column($result, 'C8_International travel controls');
    $e1 = array_column($result, 'E1_Income support');
    $e2 = array_column($result, 'E2_Debt/contract relief');
    $h1 = array_column($result, 'H1_Public information campaigns');
    $h2 = array_column($result, 'H2_Testing policy');
    $h3 = array_column($result, 'H3_Contact tracing');

    $json_daterange = json_encode($daterange);
    $json_c1 = json_encode($c1);
    $json_c2 = json_encode($c2);
    $json_c3 = json_encode($c3);
    $json_c4 = json_encode($c4);
    $json_c5 = json_encode($c5);
    $json_c6 = json_encode($c6);
    $json_c7 = json_encode($c7);
    $json_c8 = json_encode($c8);
    $json_e1 = json_encode($e1);
    $json_e2 = json_encode($e2);
    $json_h1 = json_encode($h1);
    $json_h2 = json_encode($h2);
    $json_h3 = json_encode($h3);

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>時系列で比較する</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
</head>
<body id="main">
<!-- Head[Start] -->
    <nav>
        <a href="main.html">トップに戻る</a> | <a href="countries.php">国別で比較する</a> | <a href="list.php">保存用メモを見る</a> | <a href="logout.php">ログアウトする</a>
    </nav>

    <div>
        <h2>
            時系列で比較する
        </h2>
        <p>
            国を選択し、時系列の推移を見る。
        </p>
        <form method="GET" action="timeseries.php">
            国を選択
            <select name="countryname">
                <option value="China" <?IF($countryname == "China"){echo selected;}?>>China</option>
                <option value="France" <?IF($countryname == "France"){echo selected;}?>>France</option>
                <option value="Germany" <?IF($countryname == "Germany"){echo selected;}?>>Germany</option>
                <option value="India" <?IF($countryname == "India"){echo selected;}?>>India</option>
                <option value="Italy" <?IF($countryname == "Italy"){echo selected;}?>>Italy</option>
                <option value="Japan" <?IF($countryname == "Japan"){echo selected;}?>>Japan</option>
                <option value="South Korea" <?IF($countryname == "South Korea"){echo selected;}?>>South Korea</option>
                <option value="Spain" <?IF($countryname == "Spain"){echo selected;}?>>Spain</option>
                <option value="United Kingdom" <?IF($countryname == "United Kingdom"){echo selected;}?>>United Kingdom</option>
                <option value="United States" <?IF($countryname == "United States"){echo selected;}?>>United States</option>
            </select>
            開始日<input type="text" name="startdate" value="<?=$startdate?>">（YYYY-MM-DDで入力）
            終了日<input type="text" name="enddate" value="<?=$enddate?>">（YYYY-MM-DDで入力）
            <input type="submit" value="表示">
            コメント<input type="text" name="comment"  value="<?=$comment?>">
            <input type="hidden" name="timeseries_flag" value="1">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="submit" value="<?IF($id==""){echo'登録';}else{echo'更新';}?>" onClick="form.action='<?IF($id==""){echo'insert2.php';}else{echo'update2.php';}?>';return true">
            <?IF($id==""){}else{echo '<input type="submit" value="削除" onClick="form.action='."'delete2.php'".';return true">'.' '.'<input type="submit" value="新規で登録" onClick="form.action='."'insert2.php'".';return true">';}?>
        </form>
    </div>
<!-- Head[End] -->

<!-- Main[Start] -->
    <canvas id="myChart"></canvas>
<!-- Main[End] -->

<script>
    var daterange = JSON.parse('<?=$json_daterange?>');
    var c1 = JSON.parse('<?=$json_c1?>');
    var c2 = JSON.parse('<?=$json_c2?>');
    var c3 = JSON.parse('<?=$json_c3?>');
    var c4 = JSON.parse('<?=$json_c4?>');
    var c5 = JSON.parse('<?=$json_c5?>');
    var c6 = JSON.parse('<?=$json_c6?>');
    var c7 = JSON.parse('<?=$json_c7?>');
    var c8 = JSON.parse('<?=$json_c8?>');
    var e1 = JSON.parse('<?=$json_e1?>');
    var e2 = JSON.parse('<?=$json_e2?>');
    var h1 = JSON.parse('<?=$json_h1?>');
    var h2 = JSON.parse('<?=$json_h2?>');
    var h3 = JSON.parse('<?=$json_h3?>');

    var ctx = document.getElementById('myChart').getContext('2d');
    // Chart.defaults.global.defaultFontStyle = 'ＭＳ Ｐゴシック';
    var stackedBar = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: daterange,
            datasets: [
                {
                    label: "学校閉鎖(C1)",
                    data: c1,
                    backgroundColor: "#650000",
                },
                {
                    label: "職場閉鎖(C2)",
                    data: c2,
                    backgroundColor: "#CB0000",
                },
                {
                    label: "公的集会中止(C3)",
                    data: c3,
                    backgroundColor: "#FF3232",
                },
                {
                    label: "私的集会制限(C4)",
                    data: c4,
                    backgroundColor: "#FF9932",
                },
                {
                    label: "公共交通機関閉鎖(C5)",
                    data: c5,
                    backgroundColor: "#CB6500",
                },
                {
                    label: "避難所または自宅待機命令(C6)",
                    data: c6,
                    backgroundColor: "#CB9800",
                },
                {
                    label: "国内移動制限(C7)",
                    data: c7,
                    backgroundColor: "#FFBF00",
                },
                {
                    label: "外国人に対する入国制限(C8)",
                    data: c8,
                    backgroundColor: "#FFD865",
                },
                {
                    label: "失業及び休業中の人への直接的な金銭支給(E1)",
                    data: e1,
                    backgroundColor: "#269800",
                },
                {
                    label: "家庭の金銭債務負担の停止(E2)",
                    data: e2,
                    backgroundColor: "#65FF32",
                },
                {
                    label: "公的な情報周知キャンペーンの有無(H1)",
                    data: h1,
                    backgroundColor: "#004C98",
                },
                {
                    label: "検査対象者の政府指針(H2)",
                    data: h2,
                    backgroundColor: "#3299FF",
                },
                {
                    label: "陽性判定後の接触追跡に関する政府指針(H3)",
                    data: h3,
                    backgroundColor: "#99CCFF",
                },
            ]
        },
        options: {
            scales: {
                xAxes: [{
                    stacked: true
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        }
    });

</script>
</body>
</html>
