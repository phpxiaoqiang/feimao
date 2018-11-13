<?php 
	$tag = 0;//表示未签到
	if($teacher['created_at'] == null) $tag = 1;
 ?>
<table class="table table-hovered table-bordered">
	<tr><th>身份</th><th>姓名</th><th>签到打卡</th></tr>
	<tr>
			<td>老师</td>
			<td><?=$teacher['name'];?></td>
			<td>
				<?php 
					if($tag == 1) {
						echo '<a style="width:100px;" class="a aa btn btn-primary">签到</a>';
						echo  '<a style="display:none;width:100px;" class="del btn btn-danger">删除打卡</a>';
					}else {
						echo '<a style="display:none;width:100px;" class="a aa btn btn-primary">签到</a>';
						echo  '<a  style="width:100px;" class="del btn btn-danger">删除打卡</a>';
					}
				 ?>
			</td>
	</tr>
	<?php 
		foreach ($student as $key=>$value) {
			$tag1 = 0;
			if( $value['created_at'] == null ) $tag1 = 1;
	?>
		<tr>
			<td>学生</td>
			<td><?=$value['name'];?></td>
			<td>
				<?php 
					if($tag1 == 1) {
						echo  '<a  style="display:none;width:100px;" class="del1 btn btn-danger" data-sid="'.$value['s_id'].'" data-cid="'.$c_id.'" data-time="'.$time.'">删除打卡</a>';
						echo '<a style="width:100px;" class="a1 btn btn-primary" data-name="'.$value['name'].'" data-sid="'.$value['s_id'].'" data-cid="'.$c_id.'" data-time="'.$time.'" data-person="'.$teacher['name'].'" data-tid="'.$teacher['id'].'">签到</a>';
					}else {
						echo  '<a  style="width:100px;" class="del1 btn btn-danger" data-name="'.$value['name'].'" data-sid="'.$value['s_id'].'" data-cid="'.$c_id.'" data-time="'.$time.'" data-person="'.$teacher['name'].'" data-tid="'.$teacher['id'].'">删除打卡</a>';
						echo '<a style="display:none;width:100px;" class="a1 btn btn-primary" data-name="'.$value['name'].'" data-sid="'.$value['s_id'].'" data-cid="'.$c_id.'" data-time="'.$time.'" data-person="'.$teacher['name'].'" data-tid="'.$teacher['id'].'">签到</a>';
					}
				 ?>
			</td>
		</tr>
	<?php
			}
		// }
	 ?>
<!-- <a class="btn btn-primary" href="del">开始</a> -->
</table>
<script type="text/javascript">
	$(function() {
		$('.del').click(function() {
			var obj = $(this);
			$.get("/opencard/del?identity=1&time=<?php echo $time ?>&tid=<?php echo $teacher['id']; ?>&cid=<?php echo $c_id; ?>",function(data) {
				if(data == 1) {
					alert('删除打卡成功');
				   obj.css({'display':'none'});
				   $('.aa').css({'display':'block'});
				}
			})
		});

		$('.a').click(function() {
			var obj = $(this);
			$.get("<?php echo '/opencard/punch?identity=1&cid='.$c_id.'&name='.$teacher["name"].'&time='.$time.'&tid='.$teacher["id"]; ?>",function(data){
					if(data == 1) {
					alert('签到成功');

						obj.css({'display':'none'});
						$('.del').css({'display':'block'});
					}
			});
		});

		$('.del1').each(function() {
			$(this).click(function() {
				var obj = $(this);
				var name = $(this).attr('data-name');
				var	sid = $(this).attr('data-sid');
				var cid = $(this).attr('data-cid');
				var person = $(this).attr('data-person');
				var tid = $(this).attr('data-tid');
				var time = $(this).attr('data-time');
				url = "del?identity=0&name="+name+"&sid="+sid+"&time="+time+"&cid="+cid+"&tid="+tid;
				$.get(url,function(data) {
					if(data == 1) {
					alert('删除打卡成功');
						obj.css({'display':'none'});
						obj.next('.a1').css({'display':'block'});
					}	
				})
			});
		})
		
		
		$('.a1').each(function() {
			$(this).click(function() {
				var obj = $(this);
				var name = $(this).attr('data-name');
				var	sid = $(this).attr('data-sid');
				var cid = $(this).attr('data-cid');
				var person = $(this).attr('data-person');
				var tid = $(this).attr('data-tid');
				var time = $(this).attr('data-time');

				url = "punch?identity=0&name="+name+"&sid="+sid+"&time="+time+"&cid="+cid+"&tid="+tid;
				// alert(url);
				$.get(url,function(data) {
					if(data) {
						alert('签到成功');
						
						obj.css({'display':'none'});
						obj.prev('.del1').css({'display':'block'});
					}
				});	
			});
		});
	});
</script>