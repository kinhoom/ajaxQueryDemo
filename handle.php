<?php
$type=$_POST['type'] ? $_POST['type'] : '';
$value=$_POST['value'] ? $_POST['value'] : '';
$conn=mysql_connect('localhost','root','kinhoom123');
mysql_select_db('testinnodb');
mysql_query('set names utf8',$conn);

if($value=='all'){
	// echo 333;
	$res=mysql_query("delete  from temp");
	// var_dump($res);	
	echo '';
	exit;
}


$res=mysql_query("select * from temp where name like '%{$value}%' or id like '%{$value}%' or pass like '%{$value}%'");
$num=mysql_num_rows($res);
$res1=mysql_query("select * from temp");
$num1=mysql_num_rows($res1);
// var_dump($num1);
if($value=='getNum'){
	if($num1==0){
		echo 0;
		exit;
	}
}
if($type=='cdel'){
	if($value){
		$ret=mysql_query("delete from temp where id={$value}");
		if($ret){
			$res1=mysql_query("select * from temp");
			$n1=mysql_num_rows($res1);
			if($n1){
				echo "<ul>";
			}
			while($ret=mysql_fetch_assoc($res1)){
			echo "<li><a href='{$ret[url]}'>{$ret['id']}&nbsp;&nbsp;";
			echo "{$ret['name']}&nbsp;&nbsp;";
			echo "{$ret['pass']}</a><span id=s1 value='{$ret[id]}'>删除</span></li>";
			}
			if($n1){
				echo "<div style='text-align:right;font-size:5px;color:#999;cursor:default;'><span value='all'>清除历史记录</span></div>";
			}
		}
	}
	
	exit;
}

if($num1){
	echo "<ul>";
}
while($ret=mysql_fetch_assoc($res)){
	// echo $ret['id']."&nbsp;";
	// echo $value;
	preg_match_all("/{$value}/", $ret['id'], $resword);
	if($resword[0][0]){
		echo ("<li><a href='{$ret[url]}'>".str_replace($resword[0][0], "<b>{$resword[0][0]}</b>", $ret['id'])."&nbsp;&nbsp;");
	}else{
		echo "<li><a href='{$ret[url]}'>{$ret['id']}&nbsp;&nbsp;";
	}
	preg_match_all("/{$value}/", $ret['name'], $resword1);
	if($resword1[0][0]){
		echo ("".str_replace($resword1[0][0], "<b>{$resword1[0][0]}</b>", $ret['name'])."&nbsp;&nbsp;");
	}else{
		echo "{$ret['name']}&nbsp;&nbsp;";
	}
	preg_match_all("/{$value}/", $ret['pass'], $resword2);
	// var_dump($res1[0][0]);
	if($resword2[0][0]){
		echo ("".str_replace($resword2[0][0], "<b>{$resword2[0][0]}</b>", $ret['pass'])."</a><span id=s1 value='{$ret[id]}'>删除</span></li>");
	}else{
		echo "{$ret['pass']}</a><span id=s1 value='{$ret[id]}'>删除</span></li>";
	}
}
if($num1){
	echo "</ul>";
	 echo "<div style='text-align:right;font-size:5px;color:#999;cursor:default;'><span>清除历史记录</span></div>";

}