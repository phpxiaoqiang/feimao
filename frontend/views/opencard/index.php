<?php 
    // dd($teacher['id']);
//检测老师是否打卡
$t = $omodel->find()->where(['t_id'=>$teacher['id'],'identity'=>1])->asArray()->all();
// dd($t);
$tag = 1;//表示未签到
if(!empty($t)) {
	$date = date('Y-m-d',time());
	foreach($t as $val) {
		if(substr($val['push_time'],0,10) == $date) {
			$tag = 0;//表示已签到
		}
	}
 }
 ?>
<table class="table table-hovered table-bordered">
	<tr><th>身份</th><th>姓名</th><th>签到打卡</th></tr>
	<tr>
			<td>老师</td>
			<td><?=$teacher['name'];?></td>
			<td>
				<?php 
					if($tag == 1) {
						// echo '<a class="a btn btn-primary" href="punch?identity=1&cid='.$c_id.'&name='.$teacher["name"].'&person='.$teacher["name"].'&tid='.$teacher["id"].'" class="btn btn-primary">签到</a>';
						echo '<a style="width:100px;" class="a aa btn btn-primary"  class="btn btn-primary">签到</a>';
						echo  '<a style="display:none;width:100px;" class="del btn btn-danger">删除打卡</a>';

					}else {
						// echo '<a href="javascript:" class="btn">已签到</a>';
						echo '<a style="display:none;width:100px;" class="a aa btn btn-primary"  class="btn btn-primary">签到</a>';
						
						echo  '<a  style="width:100px;" class="del btn btn-danger">删除打卡</a>';

					}
				 ?>
				
					
			</td>

	</tr>
	<?php 
		foreach ($student as $value) {
			$tag1 = 1;
			if(!empty($value)) {
				//检测学生是否已经打卡
				$t1 = $omodel->find()->where(['s_id'=>$value['id'],'identity'=>0])->asArray()->all();
				if(!empty($t1)) {
					$date = date('Y-m-d',time());
					foreach($t1 as $val) {
						if(substr($val['push_time'],0,10) == $date) {
							// dd(substr($val['push_time'],0,10));
							$tag1 = 0;
						}
					}
				}
				// dd($tag1);
	?>
		<tr>
			<td>学生</td>
			<td><?=$value['name'];?></td>
			<td>
				<?php 
					if($tag1 == 1) {
						echo  '<a  style="display:none;width:100px;" class="del1 btn btn-danger" data-sid="'.$value['id'].'" data-cid="'.$c_id.'">删除打卡</a>';
						echo '<a style="width:100px;" class="a1 btn btn-primary" data-name="'.$value['name'].'" data-sid="'.$value['id'].'" data-cid="'.$c_id.'" data-person="'.$teacher['name'].'" data-tid="'.$teacher['id'].'">签到</a>';
						


					}else {
						echo  '<a  style="width:100px;" class="del1 btn btn-danger" data-sid="'.$value['id'].'" data-cid="'.$c_id.'">删除打卡</a>';
						echo '<a style="display:none;width:100px;" class="a1 btn btn-primary" data-name="'.$value['name'].'" data-sid="'.$value['id'].'" data-cid="'.$c_id.'" data-person="'.$teacher['name'].'" data-tid="'.$teacher['id'].'">签到</a>';
						

					}
				 ?>
				
			
			</td>

		</tr>

	<?php
			}
		}
	 ?>
<!-- <a class="btn btn-primary" href="del">开始</a> -->
</table>
<script type="text/javascript">
	$(function() {
		$('.del').click(function() {
			var obj = $(this);
			$.get("del?tid=<?php echo $teacher['id']; ?>",function(data) {
				if(data == 1) {
					// alert('删除打卡成功');
				   obj.css({'display':'none'});
				   $('.aa').css({'display':'block'});
				}
			})
		});
		$('.a').click(function() {
			var obj = $(this);
			$.get("<?php echo 'punch?identity=1&time=1&cid='.$c_id.'&name='.$teacher["name"].'&person='.$teacher["name"].'&tid='.$teacher["id"]; ?>",function(data){
					if(data == 1) {
					// alert('签到成功');

						obj.css({'display':'none'});
						$('.del').css({'display':'block'});
					}
			});
		});

		$('.del1').each(function() {
			$(this).click(function() {
				var obj = $(this);
				sid = $(this).attr('data-sid');
				cid = $(this).attr('data-cid');
				url = "del?sid="+sid+"&cid="+cid;
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
				name = $(this).attr('data-name');
				sid = $(this).attr('data-sid');
				cid = $(this).attr('data-cid');
				person = $(this).attr('data-person');
				tid = $(this).attr('data-tid');

				url = "punch?identity=0&name="+name+"&sid="+sid+"&time=1"+"&cid="+cid+"&person="+person+"&tid="+tid;
				// alert(url);
				$.get(url);
						alert('签到成功');
						
						obj.css({'display':'none'});
						obj.prev('.del1').css({'display':'block'});
					
				
			});
		});

		
	});
</script>