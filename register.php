<?php
$tag = $_GET["tag"];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>新規会員登録</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <nav>
        <a href="index.php">最初の画面に戻る</a>
    </nav>
    <h1>
        新規会員登録
    </h1>
    <form method="POST" action="insert_member.php">
        <p>
            ログインID（メールアドレス）<br>
            <input type="text" name="lid">
        </p>
        <p>
            パスワード<br>
            <input type="text" name="lpw">
        </p>
        <p>
            <input type="submit" value="上記の情報で会員登録する">
        </p>
        <?if($tag=="register_error"){echo'<p class="error">※このIDは既に使用されています。別のIDを入力してください。<p>';}else{}?>
    </form>
</body>

</html>