<?php
//セッションスタート
session_start();

require "funcs.php";

//ログインチェック処理
loginCheck();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>指標の見方を選ぶ</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
</head>

<body>
    <nav>
        <a href="list.php">保存用メモを見る</a>|<a href="logout.php">ログアウトする</a>
    </nav>
    <h1>
        コロナウイルス政府対応追跡指標
    </h1>
    <div>
        <h2>
            時系列で比較する
        </h2>
        <p>
            国を選択し、時系列の推移を見る。
        </p>
        <form method="GET" action="timeseries.php">
            <p>
                国を選択
                <select name="countryname">
                    <option value="China">China</option>
                    <option value="France">France</option>
                    <option value="Germany">Germany</option>
                    <option value="India">India</option>
                    <option value="Italy">Italy</option>
                    <option value="Japan">Japan</option>
                    <option value="South Korea">South Korea</option>
                    <option value="Spain">Spain</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                </select>
            </p>
            <p>
                開始日<input type="text" name="startdate">（2020-01-01~2020-6-10までの範囲でYYYY-MM-DDで入力）
            </p>
            <p>
                終了日<input type="text" name="enddate">（2020-01-01~2020-6-10までの範囲でYYYY-MM-DDで入力）
            </p>
            <p>
                <input type="submit" value="時系列で比較">
            </p>
        </form>
    </div>
    <div>
        <h2>
            国別に比較する
        </h2>
        <form method="GET" action="countries.php">
            <p>
                基準日を指定
                基準日<input type="text" name="date">（2020-01-01~2020-6-10までの範囲でYYYY-MM-DDで入力）
            </p>
            <p>
                <input type="submit" value="国別に比較">
            </p>
        </form>
    </div>


</body>

</html>