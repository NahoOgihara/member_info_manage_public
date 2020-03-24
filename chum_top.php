<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>chum_member_regist</title>
<link href="chum_top.css" rel="stylesheet">
</head>
<body>
<section class="chum-top-title">
<h1>ユーザー登録・ログイン画面</h1>
</section>
<form method="POST" action="chum_top.php">
<p>
<h2>ログイン</h2>
パスワード：<input type="text" name="pass" placeholder="パスワード"><br>
<input type="submit" name="submit1" value="送信"><br>
</p>
<p>
<h2>初めて利用する方はこちら</h2>
名前：<input type="text" name="name" placeholder="名前"><br>
メールアドレス：<input type="text" name="address" placeholder="メールアドレス"><br>
<input type="submit" name="submit2" value="送信"><br>
</p>
<?php
if(isset($_POST["submit2"])){
if(isset($_POST["name"]) && isset($_POST["address"])){
$name = $_POST["name"];
$address = $_POST["address"];

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'setting.php';

// PHPMailerのインスタンス生成
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP(); // SMTPを使うようにメーラーを設定する
    $mail->SMTPAuth = true;
    $mail->Host = MAIL_HOST; // メインのSMTPサーバー（メールホスト名）を指定
    $mail->Username = MAIL_USERNAME; // SMTPユーザー名（メールユーザー名）
    $mail->Password = MAIL_PASSWORD; // SMTPパスワード（メールパスワード）
    $mail->SMTPSecure = MAIL_ENCRPT; // TLS暗号化を有効にし、「SSL」も受け入れます
    $mail->Port = SMTP_PORT; // 接続するTCPポート

    // メール内容設定
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "base64";
    $mail->setFrom(MAIL_FROM,MAIL_FROM_NAME);
    $mail->addAddress($address, $name); //受信者（送信先）を追加する
//    $mail->addReplyTo('xxxxxxxxxx@xxxxxxxxxx','返信先');
//    $mail->addCC('xxxxxxxxxx@xxxxxxxxxx'); // CCで追加
//    $mail->addBcc('xxxxxxxxxx@xxxxxxxxxx'); // BCCで追加
    $mail->Subject = MAIL_SUBJECT; // メールタイトル
    $mail->isHTML(true);    // HTMLフォーマットの場合はコチラを設定します
    $body = 'パスワードは1234';

    $mail->Body  = $body; // メール本文
    // メール送信の実行
    if(!$mail->send()) {
    	echo 'メッセージは送られませんでした！';
    	echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
    	echo '送信完了！';
    }
}else{
    echo "名前、メールアドレスを入力してください<br>";
}
}else if(isset($_POST["submit1"])){
    if(isset($_POST["pass"]) && $_POST["pass"]!=""){
        $pass = $_POST["pass"];
        if($pass=="1234"){
            ?>
                <meta http-equiv="Refresh" content="1;URL=chum_info_regist.html">
            <?php
        }else{
            echo "パスワードが違います<br>";
        }
    }else{
        echo "パスワードを入力してください<br>";
    }
}
?>
</form>
</body>
</html>