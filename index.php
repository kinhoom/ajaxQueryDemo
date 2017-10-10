<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>test</title>
	<script src="jquery.js"></script>
	<script>
		$(function(){
			$('#search').bind('keyup',function(){
				val=$(this).val();
				$.post('handle.php',{value:val},function(data){
					$('#t1').html(data);
				})
			})
		});
	</script>
</head>
<body>
	<input type="text" id='search' name='search'><span>查找</span>
	<div class="">
	<?php
		$conn=mysql_connect('localhost','root','kinhoom123');
		mysql_select_db('testinnodb');
		mysql_query('set names utf8',$conn);
		$res=mysql_query('select * from temp;');
		echo "<table id='t1' border=1>";
		echo "<tr><th>id</th><th>username</th><th>password</th></tr>";
		while($ret=mysql_fetch_assoc($res)){
			echo "<tr>";
			echo "<td>{$ret['id']}</td>";
			echo "<td>{$ret['name']}</td>";
			echo "<td>{$ret['pass']}</td>";
			echo "</tr>";
		}
		echo "</table>";
	?>
	</div>
</body>
</html>