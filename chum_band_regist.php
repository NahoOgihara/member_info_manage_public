<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>chum_band_regist</title>
<link href="chum_band_regist_style.css" rel="stylesheet">
</head>
<body>
<div id="page">
<h1>バンド登録ページ</h1>
<form method="POST" action="chum_band_regist.php">
	
	<div onclick="obj=document.getElementById('openRegist').style; obj.display=(obj.display=='none')?'block':'none';">
	<a style="cursor:pointer;"><h2 class="bandRegist">▼バンド新規登録</h2></a>
	</div>
	<div id="openRegist" style="display:none;clear:both;">
	<p class="bandRegist">
	バンド名：<input type="text" name="bandname" placeholder="バンド名"><br>
	バンドメンバー：<br>
	<?php
	try {
    	// データベースに接続
    	$pdo = new PDO('mysql:host="ユーザー名";dbname="データベース名";charset=utf8','tb-210589','パスワード',array(PDO::ATTR_EMULATE_PREPARES => false));
		//期ごとに表示
		$sql = "SELECT name,period from chummembertest ORDER BY period";
		$stmt = $pdo -> prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$i = -1;
		foreach($result as $output){
			if($i!=$output["period"]){
				$i = $output["period"];
				echo $i."期<br>";
			}
			?>
			<input type="checkbox" name="membername[]" value= <?php echo $output["name"]; ?> > <?php echo $output["name"]; ?> <br>
			<?php
		}
		?>
		<input type="submit" name="bandregist" value="新規登録"><br>
		</p>
		</div>
		<div onclick="obj=document.getElementById('openSearch').style; obj.display=(obj.display=='none')?'block':'none';">
		<a style="cursor:pointer;"><h2 class="bandSearch">▼バンド情報検索</h2></a>
		</div>
		<div id="openSearch" style="display:none;clear:both;">
		<p class="bandSearch">
		バンド名、メンバー名(1人)、メンバー数(半角数字)のいずれかで検索可能。複数入力された場合、上から優先度が高いです。<br>
		<input type="radio" name="allOrNewestBand" value="1">最後に登録した内容<br>
		<input type="radio" name="allOrNewestBand" value="2">全ての登録内容<br>
		バンド名：<input type="text" name="searchbandname" placeholder="バンド名"><br>
		メンバー名：<input type="text" name="searchmembername" placeholder="メンバー名"><br>
		メンバー数(半角数字)：<input type="text" name="searchmembernum" placeholder="メンバー数"><br>
		<input type="submit" name="searchband" value="検索"><br><br>
		</p>
		</div>
		<div onclick="obj=document.getElementById('openEdit').style; obj.display=(obj.display=='none')?'block':'none';">
		<a style="cursor:pointer;"><h2 class="bandEdit">▼バンド情報編集</h2></a>
		</div>
		<div id="openEdit" style="display:none;clear:both;">
		<p class="bandEdit">
		編集したいid：<input type="text" name="editbandid" placeholder="id"><br>
		バンド名：<input type="text" name="editbandname" placeholder="バンド名"><br>
		バンドメンバー：<br>
			<?php
			//期ごとに表示
			$sql = "SELECT name,period from chummembertest ORDER BY period";
			$stmt = $pdo -> prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			foreach($result as $output){
				if($i!=$output["period"]){
					$i = $output["period"];
					echo $i."期<br>";
				}
				?>
				<input type="checkbox" name="editmembername[]" value= <?php echo $output["name"]; ?> > <?php echo $output["name"]; ?> <br>
				<?php
			}
			?>
		<input type="submit" name="editband" value="編集"><br><br>
		</p>
		</div>
		<div onclick="obj=document.getElementById('openDelete').style; obj.display=(obj.display=='none')?'block':'none';">
		<a style="cursor:pointer;"><h2 class="bandDelete">▼バンド情報削除</h2></a>
		</div>
		<div id="openDelete" style="display:none;clear:both;">
		<p class="bandDelete">
		削除したいid：<input type="text" name="deletebandid" placeholder="id"><br>
		<input type="submit" name="deleteband" value="削除"><br><br>
		</p>
		</div>
		</form>
		<?php
		/**************************************ボタンが押された時の処理**************************************/
		//送信ボタンが押されたら
		// テーブル作成
		if(isset($_POST["bandregist"])){
			$sql = 'CREATE TABLE IF NOT EXISTS chumbandtest (
						id INT(11) AUTO_INCREMENT PRIMARY KEY,
						name VARCHAR(20),
						membernum INT(11),
						member1 VARCHAR(20),
						member2 VARCHAR(20),
						member3 VARCHAR(20),
						member4 VARCHAR(20),
						member5 VARCHAR(20),
						member6 VARCHAR(20),
						member7 VARCHAR(20),
						member8 VARCHAR(20),
						registry_datetime TEXT
					) engine=innodb default charset=utf8';
			$res = $pdo->query($sql);
			//入力内容に不備がなければ
			if(isset($_POST["bandname"]) && isset($_POST["membername"]) && $_POST["bandname"]!="" && is_array($_POST["membername"]) && is_string($_POST["bandname"])){
				$memberName = $_POST["membername"];
				$error = 0;
				//メンバー名のチェックボックス受け取りに間違いがないか
				foreach($memberName as $key => $value){
					if(!is_string($value) && $value!=""){
						$error++;
					}
				}
				//エラーがなければ
				if($error===0){
					$bandName = $_POST["bandname"];
					$memberNum = count($memberName);
					for($i=0; $i < 8-$memberNum; $i++){
						//メンバー数を超えている配列要素には空白を代入
						$memberName[$memberNum+$i] = "";
					}
					//インサート
					$sql = "INSERT INTO chumbandtest (name, membernum, member1, member2, member3, member4, member5, member6, member7, member8, registry_datetime) VALUES (:name, :membernum, :member1, :member2, :member3, :member4, :member5, :member6, :member7, :member8, now())";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(':name', $bandName, PDO::PARAM_STR);
					$stmt->bindValue(':membernum', $memberNum, PDO::PARAM_INT);
					$stmt->bindValue(':member1', $memberName[0], PDO::PARAM_STR);
					$stmt->bindValue(':member2', $memberName[1], PDO::PARAM_STR);
					$stmt->bindValue(':member3', $memberName[2], PDO::PARAM_STR);
					$stmt->bindValue(':member4', $memberName[3], PDO::PARAM_STR);
					$stmt->bindValue(':member5', $memberName[4], PDO::PARAM_STR);
					$stmt->bindValue(':member6', $memberName[5], PDO::PARAM_STR);
					$stmt->bindValue(':member7', $memberName[6], PDO::PARAM_STR);
					$stmt->bindValue(':member8', $memberName[7], PDO::PARAM_STR);
					$stmt->execute();
					
					//最後にインサートした内容を表示
					$last = $pdo->lastInsertId();
					$sql = "SELECT * from chumbandtest WHERE id = :id";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(":id", $last, PDO::PARAM_INT);
					$stmt->execute();
					$result = $stmt->fetchAll();
					?>
						
					<h2>登録・編集内容</h2>
					<p>
					<table border="5"> 
					<tr><th>id</th><th>バンド名</th><th>メンバー数</th><th>メンバー1</th><th>メンバー2</th><th>メンバー3</th><th>メンバー4</th><th>メンバー5</th><th>メンバー6</th><th>メンバー7</th><th>メンバー8</th></tr>
					<?php
					foreach($result as $output){ ?>
						<tr><td> <?php echo $output["id"]; ?> </td>
						<td> <?php echo $output["name"]; ?> </td>
						<td> <?php echo $output["membernum"]; ?> </td>
						<td> <?php echo $output["member1"]; ?> </td>
						<td> <?php echo $output["member2"]; ?> </td>
						<td> <?php echo $output["member3"]; ?> </td>
						<td> <?php echo $output["member4"]; ?> </td>
						<td> <?php echo $output["member5"]; ?> </td>
						<td> <?php echo $output["member6"]; ?> </td>
						<td> <?php echo $output["member7"]; ?> </td>
						<td> <?php echo $output["member8"]; ?> </td></tr>
					<?php
					}
					?>
					</table>
					</p>
					<?php
					}else{
						echo "入力内容に不備があります。<br>";
					}
				}else{
					echo "入力内容が不十分です。<br>";
				}
			}//新規登録おしまい
			
		//検索ボタンが押されたら
		if(isset($_POST["searchband"])){
			if(isset($_POST["allOrNewestBand"]) || isset($_POST["searchbandname"]) || isset($_POST["searchmembername"]) || isset($_POST["searchmembernum"])){
				if(isset($_POST["allOrNewestBand"]) && is_string($_POST["allOrNewestBand"])){
					if($_POST["allOrNewestBand"]==="1"){
						$sql = "SELECT id from chumbandtest ORDER BY id DESC";
						$stmt = $pdo -> prepare($sql);
						$stmt->execute();
						$result = $stmt->fetch(PDO::FETCH_NUM);
						$newestId = $result[0];
						$sql = "SELECT * from chumbandtest WHERE id = :id";
						$stmt = $pdo -> prepare($sql);
						$stmt->bindValue(":id", $newestId, PDO::PARAM_INT);
					}else if($_POST["allOrNewestBand"]==="2"){
						$sql = "SELECT * from chumbandtest";
						$stmt = $pdo -> prepare($sql);
					}
				}else if(isset($_POST["searchbandname"]) && is_string($_POST["searchbandname"]) && $_POST["searchbandname"]!=""){
					//バンド名に不備がなければ
					$searchbandname = $_POST["searchbandname"];
					$sql = "SELECT * from chumbandtest WHERE name LIKE :name";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(":name", "%".$searchbandname."%", PDO::PARAM_STR);
				}else if(isset($_POST["searchmembername"]) && is_string($_POST["searchmembername"]) && $_POST["searchmembername"]!=""){
					//メンバー名に不備がなければ
					$searchmembername = $_POST["searchmembername"];
					$sql = "SELECT * from chumbandtest WHERE CONCAT(member1, member2, member3, member4, member5, member6, member7, member8) LIKE :member";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(":member", "%".$searchmembername."%", PDO::PARAM_STR);
				}else if(isset($_POST["searchmembernum"]) && is_string($_POST["searchmembernum"]) && $_POST["searchmembernum"]!=""){
					//メンバー数に不備がなければ
					$searchmembernum = $_POST["searchmembernum"];
					$sql = "SELECT * from chumbandtest WHERE membernum = :membernum";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(":membernum", $searchmembernum, PDO::PARAM_INT);
				}else{
					echo "入力内容に不備があります。<br>";
					$output= array("id"=>"", "name"=>"", "membernum"=>"", "member1"=>"", "member2"=>"", "member3"=>"", "member4"=>"", "member5"=>"", "member6"=>"", "member7"=>"", "member8"=>"");
					$result = $output;
				}
				//何かしら入力があったら表を表示
				?>
				<table border="5"> 
				<tr><th>id</th><th>バンド名</th><th>メンバー数</th><th>メンバー1</th><th>メンバー2</th><th>メンバー3</th><th>メンバー4</th><th>メンバー5</th><th>メンバー6</th><th>メンバー7</th><th>メンバー8</th></tr>
				<?php
				$stmt->execute();
				$result = $stmt->fetchAll();
				foreach($result as $output){?>
					<tr><td> <?php echo $output["id"]; ?> </td>
					<td> <?php echo $output["name"]; ?> </td>
					<td> <?php echo $output["membernum"]; ?> </td>
					<td> <?php echo $output["member1"]; ?> </td>
					<td> <?php echo $output["member2"]; ?> </td>
					<td> <?php echo $output["member3"]; ?> </td>
					<td> <?php echo $output["member4"]; ?> </td>
					<td> <?php echo $output["member5"]; ?> </td>
					<td> <?php echo $output["member6"]; ?> </td>
					<td> <?php echo $output["member7"]; ?> </td>
					<td> <?php echo $output["member8"]; ?> </td></tr>
				<?php
				} ?>
			</table>
			<?php
		}else{//何も入力がなかったら**********is_stringじゃなくて!=""かも********
			echo "検索条件を入力してください。<br>";	
		}
	}
	//編集ボタンが押されたら
	if(isset($_POST["editband"])){
		if(isset($_POST["editbandid"]) && is_string($_POST["editbandid"]) && $_POST["editbandid"]!=""){
			//idが入力されて整数だったら
			$editbandid = $_POST["editbandid"];
			if(isset($_POST["editbandname"]) && isset($_POST["editmembername"]) && $_POST["editbandname"]!="" && $_POST["editmembername"]!="" && is_array($_POST["editmembername"]) && is_string($_POST["editbandname"])){
				//編集内容が入力されたら
				$editmemberName = $_POST["editmembername"];
				$error = 0;
				//メンバー名のチェックボックス受け取りに間違いがないか
				foreach($editmemberName as $key => $value){
					if(!is_string($value)){
						$error++;
					}
				}
				//エラーがなければ
				if($error===0){
					$editbandName = $_POST["editbandname"];
					$editmemberNum = count($editmemberName);
					for($i=0; $i < 8-$editmemberNum; $i++){
						//メンバー数を超えている配列要素には空白を代入
						$editmemberName[$editmemberNum+$i] = "";
					}
					//アップデート
					$sql = "UPDATE chumbandtest SET name=:name, membernum=:membernum, member1=:member1, member2=:member2, member3=:member3, member4=:member4, member5=:member5, member6=:member6, member7=:member7, member8=:member8, registry_datetime=now() WHERE id=:id";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(':name', $editbandName, PDO::PARAM_STR);
					$stmt->bindValue(':membernum', $editmemberNum, PDO::PARAM_INT);
					$stmt->bindValue(':member1', $editmemberName[0], PDO::PARAM_STR);
					$stmt->bindValue(':member2', $editmemberName[1], PDO::PARAM_STR);
					$stmt->bindValue(':member3', $editmemberName[2], PDO::PARAM_STR);
					$stmt->bindValue(':member4', $editmemberName[3], PDO::PARAM_STR);
					$stmt->bindValue(':member5', $editmemberName[4], PDO::PARAM_STR);
					$stmt->bindValue(':member6', $editmemberName[5], PDO::PARAM_STR);
					$stmt->bindValue(':member7', $editmemberName[6], PDO::PARAM_STR);
					$stmt->bindValue(':member8', $editmemberName[7], PDO::PARAM_STR);
					$stmt->bindValue(":id", (int)$editbandid, PDO::PARAM_INT);
					$stmt->execute();
					$sql = "SELECT * from chumbandtest WHERE id = :id";
					$stmt = $pdo -> prepare($sql);
					$stmt->bindValue(":id", (int)$editbandid, PDO::PARAM_INT);
					$stmt->execute();
					$result = $stmt->fetchAll();
					?>
					<h2>編集内容</h2>
					<p>
					以下の内容で編集しました。<br>
					<table border="5"> 
					<tr><th>id</th><th>バンド名</th><th>メンバー数</th><th>メンバー1</th><th>メンバー2</th><th>メンバー3</th><th>メンバー4</th><th>メンバー5</th><th>メンバー6</th><th>メンバー7</th><th>メンバー8</th></tr>
					<?php
					foreach($result as $output){
					?>
					<tr><td> <?php echo $output["id"]; ?> </td>
						<td> <?php echo $output["name"]; ?> </td>
						<td> <?php echo $output["membernum"]; ?> </td>
						<td> <?php echo $output["member1"]; ?> </td>
						<td> <?php echo $output["member2"]; ?> </td>
						<td> <?php echo $output["member3"]; ?> </td>
						<td> <?php echo $output["member4"]; ?> </td>
						<td> <?php echo $output["member5"]; ?> </td>
						<td> <?php echo $output["member6"]; ?> </td>
						<td> <?php echo $output["member7"]; ?> </td>
						<td> <?php echo $output["member8"]; ?> </td></tr>
					<?php
					}
					?>
				</table>
				</p>
				<?php
				}else{
					echo "編集したいidを入力してください。<br>";
				}
			}else{//編集内容の入力が不十分
				echo "編集内容を入力してください。<br>";
			}
		}else{
			echo "編集したいidを入力してください。<br>";	
		}
	}
	//削除ボタンが押されたら
	if(isset($_POST["deleteband"])){
		if(isset($_POST["deletebandid"]) && is_string($_POST["deletebandid"]) && $_POST["deletebandid"]!=""){
			//バンドid入力されたら
			$deletebandid = $_POST["deletebandid"];
			$sql = "SELECT * from chumbandtest WHERE id = :id";
			$stmt = $pdo -> prepare($sql);
			$stmt->bindValue(":id", $deletebandid, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll();
			?>
			<h2>登録内容</h2>
			<p>
			以下の内容を削除しました。<br>
			<table border="5"> 
			<tr><th>id</th><th>バンド名</th><th>メンバー数</th><th>メンバー1</th><th>メンバー2</th><th>メンバー3</th><th>メンバー4</th><th>メンバー5</th><th>メンバー6</th><th>メンバー7</th><th>メンバー8</th></tr>
			<?php
			foreach($result as $output){
				?>
				<tr><td> <?php echo $output["id"]; ?> </td>
					<td> <?php echo $output["name"]; ?> </td>
					<td> <?php echo $output["membernum"]; ?> </td>
					<td> <?php echo $output["member1"]; ?> </td>
					<td> <?php echo $output["member2"]; ?> </td>
					<td> <?php echo $output["member3"]; ?> </td>
					<td> <?php echo $output["member4"]; ?> </td>
					<td> <?php echo $output["member5"]; ?> </td>
					<td> <?php echo $output["member6"]; ?> </td>
					<td> <?php echo $output["member7"]; ?> </td>
					<td> <?php echo $output["member8"]; ?> </td></tr>
				<?php
			}
				?>
			</table>
			</p>
			<?php
			$sql = "DELETE FROM chumbandtest WHERE id = :id";
			$stmt = $pdo -> prepare($sql);
			$stmt->bindValue(":id", (int)$deletebandid, PDO::PARAM_INT);
			$stmt->execute();
			echo "id=".$deletebandid."を削除しました<br>";
		}else{
			echo "削除したいidを正しく入力してください<br>";
		}	
	}
}catch (PDOException $e) {
   	header('Content-Type: text/plain; charset=UTF-8', true, 500);
   	exit($e->getMessage()); 
}
$pdo = null;
?>
</div>
</body>
</html>