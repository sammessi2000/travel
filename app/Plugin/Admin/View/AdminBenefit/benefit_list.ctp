 <form action="<?php echo Router::url(array('plugin'=>'admin','controller'=>'admin_benefit','action'=>'save_pos'), true); ?>" method="post">
 <div class="navbar margin-none">
    <div class="navbar-inner radius-none">
	    <a class="brand" href="#">Danh sách Tiện ích</a>
	    <ul class="nav pull-right">
	        <li>
	            <a href="<?php echo Router::url(array('plugin'=>'admin','controller'=>'admin_benefits','action'=>'benefit_add')); ?>">
					<input type="button" name="add" class="btn btn-primary" value="Thêm mới" /></a>
	        </li>
	        <li>
	            <a href="#"><input type="submit" name="save_pos" class="btn btn-warning" value="Lưu vị trí" /></a>
	        </li>
	    </ul>
    </div>
</div>
	
<div class="well bg-white radius-none">
<?php echo $this->Session->flash(); ?>
	<table class="table table-bordered table-hover">
		<tr class="warning" style="font-weight: bold;">
			<td width="30">STT</td>
			<td>Tiêu đề</td>
			<td width="70">Thay đổi</td>
		</tr>
		<?php if($this->data) : ?>
		<?php 
			$current_page = $this->Paginator->current(); 
			$i = 1;
			if($current_page != 1)	$i = $current_page * 10; 
			foreach($this->data as $v) : 
		?>
		<tr>
			<td><?php echo $i; $i++; ?></td>
			<td><?php echo $v['Benefit']['title']; ?></td>
			<td>
				<a href="<?php echo Router::url(array('plugin'=>'admin','controller'=>'admin_benefits','action'=>'benefit_edit', $v['Benefit']['id'])); ?>">
					<i class="icon icon-edit"></i>
				</a> 
				&nbsp; 
				<a href="#" class="confirm-delete" goto="<?php echo Router::url(array('plugin'=>'admin','controller'=>'admin_benefits','action'=>'benefit_delete', $v['Benefit']['id'])); ?>">
					<i class="icon icon-trash"></i>
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</table>

	<div class="pagination">
		<?php echo $this->Paginator->first('<< Đầu'); ?>	
		<?php echo $this->Paginator->numbers(array('separator'=>'')); ?>	
		<?php echo $this->Paginator->last('Cuối >>'); ?>	
	</div>
	
</form>
</div>


<script type="text/javascript">
    $('#benefit_type').change(function() {
        var v = $(this).val();
        document.location.href = "<?php echo DOMAINAD; ?>admin_benefit/benefit_list/?t="+v;
    });
</script>