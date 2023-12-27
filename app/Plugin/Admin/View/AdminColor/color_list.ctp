<form action="<?php echo DOMAINAD; ?>admin_color/save_pos" method="post" class="form-main">
<div id="main">
<div class="container-fluid">
<?php echo $this->Admin->admin_head('Danh sách màu'); ?>
<?php echo $this->Admin->admin_breadcrumb('Danh mục màu'); ?>

<div style="margin:10px 0 10px;" class="row-fluid">
    <?php echo $this->Session->flash(); ?>
    <a href="<?php echo DOMAINAD; ?>admin_color/color_add" class="btn btn-large btn btn-orange pull-right">Thêm</a>
    <a href="#" onclick="document.form.submit();" class="btn btn-large btn btn-default pull-right savepos">Lưu vị trí</a>
</div>

<div class="box box-color box-bordered">
    <div class="box-title">
        <h3><i class="icon-table"></i>Danh sách</h3>
    </div>   

	
    <div class="box-content nopadding">
	
	<table class="table table-bordered table-hover">
		<tr class="warning" style="font-weight: bold;">
                    <th width="30">STT</th>
                    <th width="100">Mã màu</th>
                    <th>Tên</th>
                    <th width="40">N.bật</th>
                    <th width="40">Vịtrí</th>
                    <th width="40" style="text-align: center;">Sửa</th>
                    <th width="40" style="text-align: center;">Xóa</th>
					<th width="40" style="text-align: center;">ID</th>
		</tr>
		<?php if($this->data) : ?>
		<?php 
			$current_page = $this->Paginator->current(); 
			$stt = 1;
			
			$showing = $this->Paginator->counter('{:current}');
			$total_pages = $this->Paginator->counter('{:pages}');
		
			$redirectPage = $current_page;
			if($current_page > 1 && $current_page == $total_pages && $showing == 1)
				$redirectPage = $current_page - 1;
		
			if($current_page != 1)	$stt = (($current_page - 1) * $limit) + 1; 
			foreach($this->data as $v) : 
		?>
		<tr>
			<td><?php echo $stt; $stt++; ?></td>
                        <td>
                            <div class="color-preview" style="background: <?php echo $v['Color']['image']; ?>;"></div>
                        </td>
			<td><?php echo $v['Color']['title']; ?></td>
			<td style="text-align: center;">
				<a href="<?php echo DOMAINAD; ?>admin_color/update_field/featured/<?php echo $v['Color']['id'] ?>">
					<?php if($v['Color']['featured'] == 1) : ?>
						<i class="icon icon-ok"></i>
					<?php else : ?>
						<i class="icon icon-pause"></i>
					<?php endif; ?>
				</a>
			</td>
            <td>
                <input name="pos[<?php echo $v['Color']['id']; ?>]" value="<?php echo $v['Color']['pos']; ?>" style="width: 30px;" />
            </td>

			<td style="text-align: center;">
				<a href="<?php echo DOMAINAD . "admin_color/color_edit/" . $v['Color']['id']; ?>">
					<i class="icon icon-edit"></i>
				</a> 
			</td>
			
			<td style="text-align: center;">
				<a href="#" class="confirm-delete" goto="<?php echo DOMAINAD . 'admin_color/color_delete/' . $v['Color']['id']; ?>?rp=<?php echo $redirectPage; ?>">
					<i class="icon icon-trash"></i>
				</a>
			</td>

			<td style="text-align: center;"><?php echo $v['Color']['id']; ?></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</table>

	<div class="pagination">
		<?php echo $this->Paginator->first('<< Đầu'); ?>	
		<?php echo $this->Paginator->numbers(array('separator'=>'')); ?>	
		<?php echo $this->Paginator->last('Cuối >>'); ?>	
	</div>
	 




    </div>
</div>
</div>
</div>


</form>


<script type="text/javascript">
    $('#hangxe_type').change(function() {
        var v = $(this).val();
        document.location.href = "<?php echo DOMAINAD; ?>admin_color/color_list/?t="+v;
    });

	$('.savepos').click(function() {
		$('form.form-main').submit();
	});
</script>