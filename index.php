<?php
$tag = $_GET["tag"];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>コロナウイルス政府対応指数</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <h1>
        コロナウイルス政府対応追跡指標
    </h1>
    <div>
        <p>
            このページでは、オックスフォード大学が開発したコロナウイルス政府対応追跡指標(OXCGRT）を見える化します。
        </p>
        <p>
            新型コロナウイルスに対する政府の対応策は多岐にわたります。OXCGRTは各国政府の様々な対応を指数化することで、比較可能にします。
        </p>
        <p>
            具体的には封じ込め政策、経済政策、公衆衛生政策について１７の指標を毎日追跡します。これに基づき、政府対応指数、封鎖・健康指数、厳格化指数、経済支援指数の４つの指数を算出します。
        </p>
        <p>
            ここでは、政府対応指数とその内訳を見える化します。
        </p>
    </div>
    <div>
        <h2>
            サービスの利用方法
        </h2>
        <p>本サービスの利用は会員登録（無料）が必要です。会員の方はログインをしてご利用ください</p>
        <h2>
            新規会員登録
        </h2>
        <p>
            <button onclick="location.href='register.php'">会員登録をする</button>
        </p>
    </div>
    <div>
        <h2>
            ログイン
        </h2>
        <form method="POST" action="login_act.php">
            <p>
                ログインID（メールアドレス）<br>
                <input type="text" name="lid">
            </p>
            <p>
                パスワード<br>
                <input type="text" name="lpw">
            </p>
            <p>
                <input type="submit" value="ログインする">
            </p>
        </form>
        <?if($tag=="login_error"){echo '<p class="error">※IDまたはパスワードに誤りがあります。</p>';}?>
    </div>


</body>

</html>