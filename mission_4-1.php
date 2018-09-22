//データの受け取りと宣言
$come = $_POST['come'];	//コメント
$name = $_POST['name']; //名前
$pass = $_POST['pass']; //パスワード
$remove_num = $_POST['kesu']; //消去番号
$edit = $_POST['edit']; //編集番号
$flag = $_POST['flag']; //編集フラグ

//--新規投稿機能--
if($name != '' && $come != ''){
	if($pass != '' && $flag == ''){
//現在時刻の取得
$time = date("Y/m/d H:i:s");

//行数の取得をするsql
$sql = "SELECT COUNT(*) FROM kengo"; 

//テーブルの行数を取得
$results =  $pdo -> query($sql);

//実行結果から行数取り出し
$num = $results -> fetchColumn();
$num++;

//$numが投稿番号となる。

	//insert文
	$sql = "INSERT INTO kengo(num,name,comment,time,password)VALUES($num,'$name','$come','$time','$pass')";
	//sql実行
	$rezult = $pdo -> query($sql);


	}
}

//削除機能
if($remove_num !=''){
if($pass!=''){

//データを削除するsql文
$sql = "SELECT * FROM kengo WHERE num = $remove_num";

//sql実行
$result = $pdo -> query($sql);
foreach ($result as $neko){
$cat=$neko['password'];

}
if($pass == $cat){
$sql = "delete from kengo where num = $remove_num";
//sql実行
$result = $pdo -> query($sql);
 }

}
}

//編集フラグをあるか確認
if($flag!=''){
//空白判定
if($name!=''&& $come!=''){
//データ取得するｓｑｌ文
	$sql = $sql = "SELECT * FROM kengo WHERE num = $flag";

//sql実行
$result = $pdo -> query($sql);

//DBのパスワードを取得
	foreach ($result as $rows){
		$DB_pass = $rows['password'];
}
//入力されたぱｓｓとｄｂがおなじなら編集する
if($pass==$DB_pass){
	$sql = "update kengo set name='$name',comment='$come'where num = $flag";
$result = $pdo->query($sql);
}
 }
//フラグをオフにする
$flag = '';
  }

//編集指定番号の空白指定番号
if(strval($edit)!=''){

//入力フォームに名前とコメントを戻すためのｓｑｌ
	$sql = "SELECT * FROM kengo WHERE num = $edit";

//sql実行
	$result = $pdo -> query($sql);
//名前とコメントを結果から読み出すためのforeach文
	foreach($result as $kengo){
	$edit_name = $kengo['name'];
	$edit_come = $kengo['comment'];
}






//編集フラグを立てる
$flag = $edit;


}



if(strval($edit)!=''){

//SELECT文の取り出し
//編集フラグ
$sql = "SELECT * FROM kengo WHERE num = $edit";
//sqlを実行
$result = $pdo->query($sql);
foreach($result as $kengo){
//名前の取得
$edit_name = $kengo['name'];
}

}
//表示機能
$sql = 'SELECT*FROM kengo';
$result = $pdo -> query($sql);
foreach ($result as $kengo){
echo $kengo['num'].',';
echo $kengo['edit'].',';
echo $kengo['name'].',';
echo $kengo['comment'].'<br>';
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
	掲示板(kengo)

	<?php /*入力フォーム*/ ?>
	<form action="" method="post">
		名前：<input type="text" name="name"value="<?php echo $edit_name;?>"><br>
		コメント：<input type="text" name="come"value="<?php echo $edit_come;?>"><br>
		パスワード：<input type="password" name="pass"value="<?php echo $edit_pass;?>">
	
		<!--送信ボタン-->
		<input type="submit" value="送信"><br>

		編集番号：<input type="text" name="edit">
		消去番号：<input type="text" name="kesu"value="<?php echo $kesu;?>">
	<!--編集フラグ-->
		<input type="hidden" name="flag" value="<?php echo $flag; ?>">
	</form>


</body>
</html>>
