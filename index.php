<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>test</title>
	<style>
		*{
			margin:0px;
			padding: 0px;
		}
		#search{
			outline:none;
			width: 280px;
			height: 20px;
		}
		#d1{
			float:left;
			border:thin solid #ccc;
			border-top: none;
			background-color: #fff;
			width:282px;
			margin-left: 485px;
			margin-top:0px;
			display: none;
		}
		#container{
			float:left;
			width:284px;
			margin-left:485.3px;
			margin-top: 219px;
			cursor:default;
		}
		#con{
			/*background-color: #ccc;*/
			height:1000px;
		}
		ul{
			list-style-type: none;
		}
		li:hover{
			background-color: #ccc;
		}
		a{
			cursor:default;
			text-decoration: none;
			width:inherit;
		}
		span:hover{
			background-color: #ccc;
			color:#fff;
		}
		#s1{
			font-size:6px;
			float:right;
			color:#ccc;
		}
		#s1:hover{
			color:#fff;
			text-decoration: underline;
			cursor:default;
		}
	</style>
	<script src="jquery.js" type="text/javascript"></script>
	<script>
		$(function(){
			$('span[id=s1]').on('click',function(){
				$.post('handle.php',{value:$(this).attr('value'),type:'cdel'},function(data){
						$('#d1').html(data);
			    });	
			});
			$("#search").on('mousedown',function(){
				$.post('handle.php',{value:'getNum'},function(data){
					if(data==0){
						$('#d1').css('display','none');
					}else{
						$('#d1').css('display','block');
					}
					
				});

			$("#container").on('mousedown',function(){
				$('#d1').css('display','block');
			})
			$("div").bind('mousedown',function(){
				$('#d1').css('display','none');
				$('#d1').bind('mousedown',function(){
					$('#d1').css('display','block');
				})
			})
			// $("#search").on('blur',function(){
			// 	$('#d1').on('click',function(){
			// 		$('#d1').css('display','block');
			// 	})

			// })

			$('#search').bind('keyup',function(){
				val=$(this).val();
				$.post('handle.php',{value:val},function(data){
					if(data!=''){
						$('#d1').css('display','block');
						$('#d1').html(data);
					}else{
						$('#d1').css('display','none');
					}
				})
			})
			$('span').bind('click',function(){
				val=$(this).attr('value');
				$.post('handle.php',{value:val},function(data){
					if(data!=''){
						$('#d1').css('display','block');
						$('#d1').html(data);
					}else{
						$('#d1').css('display','none');
					}
				})
			})
		});
		});
	</script>
</head>
<body>
	<div id="container">
	<input type="text" id='search' name='search'>
	</div>
	<?php
		$conn=mysql_connect('localhost','root','kinhoom123');
		mysql_select_db('testinnodb');
		mysql_query('set names utf8',$conn);
		$res=mysql_query('select * from temp;');
		$num=mysql_num_rows($res);
		echo "<div id='d1'>";
		echo "<ul>";
		while($ret=mysql_fetch_assoc($res)){
			echo "<li><a href='{$ret[url]}'>{$ret['id']}&nbsp;&nbsp;";
			echo "{$ret['name']}&nbsp;&nbsp;";
			echo "{$ret['pass']}</a><span id=s1 value='{$ret[id]}'>删除</span></li>";
		}
		if($num){
			echo "<div style='text-align:right;font-size:5px;color:#999;cursor:default;'><span value='all'>清除历史记录</span></div>";
		}
		echo "</ul>";
		echo "</div>";
	?>
	<div id="con"></div>
</body>
</html>