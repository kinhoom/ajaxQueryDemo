<?php
$value=$_POST['value'];
$conn=mysql_connect('localhost','root','kinhoom123');
mysql_select_db('testinnodb');
mysql_query('set names utf8',$conn);
$res=mysql_query("select * from temp where name like '%{$value}%' or id like '%{$value}%' or pass like '%{$value}%'");
echo "<tr><th>id</th><th>username</th><th>password</th></tr>";
while($ret=mysql_fetch_assoc($res)){
	echo "<tr>";
	echo "<td>{$ret['id']}</td>";
	echo "<td>{$ret['name']}</td>";
	echo "<td>{$ret['pass']}</td>";
	echo "</tr>";
}
