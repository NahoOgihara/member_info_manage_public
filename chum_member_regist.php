<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>chum_member_regist</title>
<link href="chum_member_regist_style.css" rel="stylesheet">
</head>
<body>
<div id="page">
<article>
<h1>サークル員登録ページ</h1>
<form method="POST" action="chum_member_regist.php">
	<section>
	<div onclick="obj=document.getElementById('openRegist').style; obj.display=(obj.display=='none')?'block':'none';">
	<a style="cursor:pointer;"><h2 class="memberRegist">▼サークル員新規登録</h2></a>
	</div>
	<div id="openRegist" style="display:none;clear:both;">
	<p class="memberRegist">
	名前：<input type="text" name="name" placeholder="名前"><br>
	期(半角数字)：<input type="text" name="period" placeholder="期"><br>
	学科：<br>
	<input type="radio" name="subject" value="建築">建築学科<br>
	<input type="radio" name="subject" value="電気工">電気工学科<br>
	<input type="radio" name="subject" value="機械工">機械工学科<br>
	<input type="radio" name="subject" value="情報工">情報工学科<br>
	<input type="radio" name="subject" value="応用生物">応用物理学科<br>
	<input type="radio" name="subject" value="生物工">生物工学科<br>
	<input type="radio" name="subject" value="材料工">材料工学科<br>
	<input type="radio" name="subject" value="電気電子工">電気電子工学科<br>
	<input type="radio" name="subject" value="その他">その他<br>
	性別：<br>
	<input type="radio" name="gender" value="男">男<br>
	<input type="radio" name="gender" value="女">女<br>
	<input type="radio" name="gender" value="その他">その他<br>
	<br>
	<input type="submit" name="newregistmember" value="新規登録"><br><br>
	</p>
	</div>
	</section>
	<section>
	<div onclick="obj=document.getElementById('openSearch').style; obj.display=(obj.display=='none')?'block':'none';">
	<a style="cursor:pointer;"><h2 class="memberSearch">▼サークル員情報検索</h2></a>
	</div>
	<div id="openSearch" style="display:none;clear:both;">
	<p class="memberSearch">
	<input type="radio" name="allOrNewestMember" value="1">最後に登録した内容<br>
	<input type="radio" name="allOrNewestMember" value="2">全ての登録内容<br>
	名前、各期、各学科で検索可能。<br>
	名前：<input type="text" name="searchname" placeholder="名前"><br>
	期(半角数字)：<input type="text" name="searchperiod" placeholder="期"><br>
	学科：<br>
	<input type="radio" name="searchsubject" value="建築">建築学科<br>
	<input type="radio" name="searchsubject" value="電気工">電気工学科<br>
	<input type="radio" name="searchsubject" value="機械工">機械工学科<br>
	<input type="radio" name="searchsubject" value="情報工">情報工学科<br>
	<input type="radio" name="searchsubject" value="応用生物">応用物理学科<br>
	<input type="radio" name="searchsubject" value="生物工">生物工学科<br>
	<input type="radio" name="searchsubject" value="材料工">材料工学科<br>
	<input type="radio" name="searchsubject" value="電気電子工">電気電子工学科<br>
	<input type="radio" name="searchsubject" value="その他">その他<br>
	<input type="submit" name="searchmember" value="検索"><br><br>
	</p>
	</div>
	</section>
	<section>
	<div onclick="obj=document.getElementById('openEdit').style; obj.display=(obj.display=='none')?'block':'none';">
	<a style="cursor:pointer;"><h2 class="memberEdit">▼サークル員情報編集</h2></a>
	</div>
	<div id="openEdit" style="display:none;clear:both;">
	<p class="memberEdit">
	編集したいid：<input type="text" name="editmemberid" placeholder="id"><br>
	名前：<input type="text" name="editname" placeholder="名前"><br>
	期(半角数字)：<input type="text" name="editperiod" placeholder="期"><br>
	学科：<br>
	<input type="radio" name="editsubject" value="建築">建築学科<br>
	<input type="radio" name="editsubject" value="電気工">電気工学科<br>
	<input type="radio" name="editsubject" value="機械工">機械工学科<br>
	<input type="radio" name="editsubject" value="情報工">情報工学科<br>
	<input type="radio" name="editsubject" value="応用生物">応用物理学科<br>
	<input type="radio" name="editsubject" value="生物工">生物工学科<br>
	<input type="radio" name="editsubject" value="材料工">材料工学科<br>
	<input type="radio" name="editsubject" value="電気電子工">電気電子工学科<br>
	<input type="radio" name="editsubject" value="その他">その他<br>
	性別：<br>
	<input type="radio" name="editgender" value="男">男<br>
	<input type="radio" name="editgender" value="女">女<br>
	<input type="radio" name="editgender" value="その他">その他<br>
	<input type="submit" name="editmember" value="編集"><br><br>
	</p>
	</div>
	</section>
	<section>
	<div onclick="obj=document.getElementById('openDelete').style; obj.display=(obj.display=='none')?'block':'none';">
	<a style="cursor:pointer;"><h2 class="memberDelete">▼サークル員情報削除</h2></a>
	</div>
	<div id="openDelete" style="display:none;clear:both;">
	<p class="memberDelete">
	削除したいid：<input type="text" name="deleteid" placeholder="id"><br>
	<input type="submit" name="deletemember" value="削除"><br><br>
	</p>
	</div>
	</section>
	</form>
	<?php
	try {
  		 // データベースに接続
    	$pdo = new PDO('mysql:host="ユーザー名";dbname="データベース名";charset=utf8','tb-210589','パスワード',array(PDO::ATTR_EMULATE_PREPARES => false));
	/*****************************************@@@@@@@@@@@@@@@@ボタンが押された時の処理@@@@@@@@@@@@@@@@*************************************************/
//検索すると見たい内容が表示できる
if(isset($_POST["searchmember"])){
		if(isset($_POST["allOrNewestMember"]) && is_string($_POST["allOrNewestMember"])){
			if($_POST["allOrNewestMember"] === "1"){
				$sql = "SELECT id from chummembertest ORDER BY id DESC";
				$stmt = $pdo -> prepare($sql);
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_NUM);
				$last = $result[0];
				$sql = "SELECT * from chummembertest WHERE id = :id ORDER BY period";
				$stmt = $pdo -> prepare($sql);
				$stmt->bindValue(":id", $last, PDO::PARAM_INT);
			}else if($_POST["allOrNewestMember"] === "2"){
				$sql = "SELECT * from chummembertest";
				$stmt = $pdo -> prepare($sql);
			}
		}else if(!isset($_POST["searchname"]) && !isset($_POST["searchperiod"]) && !isset($_POST["searchsubject"]) && !is_string($_POST["searchname"]) && !is_string($_POST["searchperiod"]) && !is_string($_POST["searchsubject"]) && $_POST["searchname"]!="" && $_POST["searchperiod"]!="" && $_POST["searchsubject"]!=""){
			echo "入力内容に不備があります。<br>";
		}else{ //入力内容に不備がなければ
			if(!isset($_POST["searchname"])){
				$searchname = "";
			}else{
				$searchname = $_POST["searchname"];
			}
			if(!isset($_POST["searchperiod"])){
				$searchperiod = "";
			}else{
				$searchperiod = $_POST["searchperiod"];
			}
			if(!isset($_POST["searchsubject"])){
				$searchsubject = "";
			}else{
				$searchsubject = $_POST["searchsubject"];
			}
			if($searchname==="" && $searchperiod==="" && $searchsubject===""){
				echo "名前、各期、各学科いずれか一つ以上指定してください。<br>";
			}else{
				if($searchname!="" && $searchperiod!="" && $searchsubject!=""){
					$sql = "SELECT * from chummembertest WHERE  name LIKE :name and period = :period and subject = :subject ORDER BY period";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(":name", $searchname, PDO::PARAM_STR);
					$stmt->bindValue(":period", $searchperiod, PDO::PARAM_INT);
					$stmt->bindValue(":subject", $searchsubject, PDO::PARAM_STR);
			}else if($searchname!="" && $searchperiod!=""){
					$sql = "SELECT * from chummembertest WHERE  name LIKE :name and period = :period ORDER BY period";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(":name", $searchname, PDO::PARAM_STR);
					$stmt->bindValue(":period", $searchperiod, PDO::PARAM_INT);
				}else if($searchname!="" && $searchsubject!=""){
					$sql = "SELECT * from chummembertest WHERE  name LIKE :name and subject = :subject ORDER BY period";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(":name", $searchname, PDO::PARAM_STR);
					$stmt->bindValue(":subject", $searchsubject, PDO::PARAM_STR);
				}else if($searchsubject!="" && $searchperiod!=""){
					$sql = "SELECT * from chummembertest WHERE period = :period and subject = :subject ORDER BY period";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(":period", $searchperiod, PDO::PARAM_INT);
					$stmt->bindValue(":subject", $searchsubject, PDO::PARAM_STR);
				}else if($searchname!=""){
					$sql = "SELECT * from chummembertest WHERE  name LIKE :name ORDER BY period";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(":name", $searchname, PDO::PARAM_STR);
				}else if($searchperiod!=""){
					$sql = "SELECT * from chummembertest WHERE period = :period ORDER BY period";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(":period", $searchperiod, PDO::PARAM_INT);
				}else if($searchsubject!=""){
					$sql = "SELECT * from chummembertest WHERE subject = :subject ORDER BY period";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(":subject", $searchsubject, PDO::PARAM_STR);
				}	
			}
		}
		$stmt->execute();
		$result = $stmt->fetchAll();
		?>
		<table border="5">
		<caption>検索結果</caption>
		<tr><th>id</th><th>名前</th><th>学科</th><th>期</th></tr>
		<?php
		foreach($result as $output){
			if((int)$output["period"] <= 3 && $output["gender"]=="男"){
				$periodColor = "period3M";
			}else if((int)$output["period"] <= 3 && $output["gender"]=="女"){
				$periodColor = "period3F";
			}else if((int)$output["period"] <= 3 && $output["gender"]=="その他"){
				$periodColor = "period3O";
			}else if((int)$output["period"] == "4" && $output["gender"]=="男"){
				$periodColor = "period4M";
			}else if((int)$output["period"] == "4" && $output["gender"]=="女"){
				$periodColor = "period4F";
			}else if((int)$output["period"] == "4" && $output["gender"]=="その他"){
				$periodColor = "period4O";
			}else if((int)$output["period"] == 5 && $output["gender"]=="男"){
				$periodColor = "period5M";
			}else if((int)$output["period"] == 5 && $output["gender"]=="女"){
				$periodColor = "period5F";
			}else if((int)$output["period"] == 5 && $output["gender"]=="その他"){
				$periodColor = "period5O";
			}else if((int)$output["period"] == 6 && $output["gender"]=="男"){
				$periodColor = "period6M";
			}else if((int)$output["period"] == 6 && $output["gender"]=="女"){
				$periodColor = "period6F";
			}else if((int)$output["period"] == 6 && $output["gender"]=="その他"){
				$periodColor = "period6O";
			}else{
				$periodColor = "period0";
			}
			?>
			<tr class= <?php echo $periodColor; ?> ><td> <?php echo $output["id"]; ?> </td>
			<td> <?php echo $output["name"]; ?> </td>
			<td> <?php echo $output["subject"]; ?> </td>
			<td> <?php echo $output["period"]; ?> </td></tr>
			<?php
		}
			?>
		</table>
		<?php
}
	//新規登録
	if(isset($_POST["newregistmember"])){
		if(isset($_POST["name"]) && isset($_POST["period"]) && isset($_POST["subject"]) && isset($_POST["gender"]) && $_POST["name"]!="" && $_POST["period"]!="" && $_POST["subject"]!="" && $_POST["gender"]!="" && is_string($_POST["name"]) && is_string($_POST["period"]) && is_string($_POST["subject"]) && is_string($_POST["gender"])){
			$name = $_POST["name"];
			$period = $_POST["period"];
			$subject = $_POST["subject"];
			$gender = $_POST["gender"];
	   		// テーブル作成
			$sql = 'CREATE TABLE IF NOT EXISTS chummembertest (
					id INT(11) AUTO_INCREMENT PRIMARY KEY,
					name VARCHAR(20),
					period INT(11),
					subject VARCHAR(20),
					gender VARCHAR(20),
					registry_datetime TEXT
					) engine=innodb default charset=utf8';
	
			//実行
			$res = $pdo->query($sql);
			$sql = "INSERT INTO chummembertest (name, period, subject, gender, registry_datetime) VALUES (:name, :period, :subject, :gender, now())";
			$stmt = $pdo -> prepare($sql);
			$stmt->bindValue(':name', $name, PDO::PARAM_STR);
			$stmt->bindValue(':period', $period, PDO::PARAM_INT);
			$stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
			$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
			$stmt->execute();
			//登録内容表示
			$last = $pdo->lastInsertId();
			echo $last."<br>";
			$sql = "SELECT * from chummembertest WHERE id = :id ORDER BY period";
			$stmt = $pdo -> prepare($sql);
			$stmt->bindValue(":id", $last, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll();
			?>
			以下の内容で登録しました。<br>
			<table border="5">
			<caption>登録内容</caption>
			<tr><th>id</th><th>名前</th><th>学科</th><th>期</th><th>性別</th></tr>
			<?php
			foreach($result as $output){
				?>
				<tr><td> <?php echo $output["id"]; ?> </td>
				<td> <?php echo $output["name"]; ?> </td>
				<td> <?php echo $output["subject"]; ?> </td>
				<td> <?php echo $output["period"]; ?> </td>
				<td> <?php echo $output["gender"]; ?> </td></tr>
				<?php
			}
			?>
			</table>
			<?php
			}else{
				echo "入力内容に不備があります。<br>";
			}
	}

	//編集ボタンが押されたら
	if(isset($_POST["editmember"])){
		if(isset($_POST["editname"]) && isset($_POST["editperiod"]) && isset($_POST["editsubject"]) && isset($_POST["editgender"]) && isset($_POST["editmemberid"]) && is_string($_POST["editname"]) && is_string($_POST["editperiod"]) && is_string($_POST["editsubject"]) && is_string($_POST["editgender"]) && is_string($_POST["editmemberid"]) && $_POST["editname"]!="" && $_POST["editperiod"]!="" && $_POST["editsubject"]!="" && $_POST["editgender"]!="" && $_POST["editmemberid"]!=""){
			$editname = $_POST["editname"];
			$editperiod = $_POST["editperiod"];
			$editsubject = $_POST["editsubject"];
			$editgender = $_POST["editgender"];
			$editmemberid = $_POST["editmemberid"];
		
			$sql = "UPDATE chummembertest SET name=:name, period=:period, subject=:subject, gender=:gender, registry_datetime=now() WHERE id = :id";
			$stmt = $pdo -> prepare($sql);
			$stmt->bindValue(":name", $editname, PDO::PARAM_STR);
			$stmt->bindValue(":period", $editperiod, PDO::PARAM_INT);
			$stmt->bindValue(":subject", $editsubject, PDO::PARAM_STR);
			$stmt->bindValue(":gender", $editgender, PDO::PARAM_STR);
			$stmt->bindValue(":id", $editmemberid, PDO::PARAM_INT);
			$stmt->execute();
				
			//編集内容の表示
			$sql = "SELECT * from chummembertest WHERE id = :id ORDER BY period";
			$stmt = $pdo -> prepare($sql);
			$stmt->bindValue(":id", (int)$editmemberid, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll();
			?>
			<p>
			以下の内容で編集しました。<br>
			</p>
			<table border="5">
			<caption>編集内容</caption>
			<tr><th>id</th><th>名前</th><th>学科</th><th>期</th><th>性別</th></tr>
			<?php
			$stmt->execute();
			$result = $stmt->fetchAll();
			foreach($result as $output){
			?>
				<tr><td> <?php echo $output["id"]; ?> </td>
				<td> <?php echo $output["name"]; ?> </td>
				<td> <?php echo $output["subject"]; ?> </td>
				<td> <?php echo $output["period"]; ?> </td>
				<td> <?php echo $output["gender"]; ?> </td></tr>
			<?php
			}
			?>
			</table>
			<?php	
		}else{
			echo "入力内容に不備があります。<br>";
		}
	}

	//削除ボタンが押されたら
	if(isset($_POST["deletemember"])){
		if(isset($_POST["deleteid"]) && $_POST["deleteid"]!="" && is_string($_POST["deleteid"])){
			$deleteid = $_POST["deleteid"];
			$sql = "SELECT * from chummembertest WHERE id = :id ORDER BY period";
			$stmt = $pdo -> prepare($sql);
			$stmt->bindValue(":id", $deleteid, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll();
			?>
			<p>
			以下の内容を削除しました。<br>
			</p>
			<table border="5">
			<caption>削除内容</caption>
			<tr><th>id</th><th>名前</th><th>学科</th><th>期</th><th>性別</th></tr>
			<?php
			foreach($result as $output){
				?>
				<tr><td> <?php echo $output["id"]; ?> </td>
				<td> <?php echo $output["name"]; ?> </td>
				<td> <?php echo $output["subject"]; ?> </td>
				<td> <?php echo $output["period"]; ?> </td>
				<td> <?php echo $output["gender"]; ?> </td></tr>
				<?php
			}
				?>
			</table>
			<?php
				$sql = "DELETE FROM chummembertest WHERE id = :id";
				$stmt = $pdo -> prepare($sql);
				$stmt->bindValue(":id", (int)$deleteid, PDO::PARAM_INT);
				$stmt->execute();
		}else{
			echo "入力内容に不備があります。<br>";
		}
	}
}catch (PDOException $e) {
   	header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage()); 
}$pdo = null;
?>
</article>
</div>
</body>
</html>