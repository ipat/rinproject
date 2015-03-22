@extends('admin.layout.default')
@section('content')
<?php $url = URL::to(""); ?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div class="page-header">
		<h1>จัดการขนมหวาน</h1>
		<div class="pull-right">
			<div class="btn btn-yellow float-right-up"><a class="white" href="<?php echo $url . '/admin/adddessert' ?>"><i class="fa fa-plus"></i> เพิ่มขนมหวาน</a></div>
		</div>						
	</div>
	<?php if($errors->has()): ?>
		<?php foreach($errors->all() as $error): ?>
		<div class="bg-danger alert"><?php echo $error ?></div>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if(Session::has('message')): ?>
		<div class="bg-success alert"><?php echo Session::get('message') ?></div>
	<?php endif; ?>


	<table class="table table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>รูปภาพ</th>
				<th>ชื่อสินค้า</th>
				<th>รายละเอียดสินค้า</th>
				<th>ราคา</th>
				<th>แก้ไข</th>
				<th>ลบ</th>
			</tr>
			
		</thead>
		<tbody>
			<?php $desserts = DB::table('dessert')->get(); $emptyDessert = sizeof($desserts) == 0?>
			<?php foreach($desserts as $dessert): ?>
				<tr>
					<td><?php echo $dessert->id ?></td>
					<td><img src="<?php echo $dessert->image_url ?>" alt="<?php echo $dessert->name ?>" class="img-thumbnail preview-thumb"></td>
					<td><?php echo $dessert->name ?></td>
					<td><?php echo $dessert->description ?></td>
					<td><?php echo $dessert->price ?> บาท</td>
					<td><a href="<?php echo $url . '/admin/editdessert/' . $dessert->id  ?>" >แก้ไข</a></td>
					<td><a data-href="<?php echo $url . '/admin/earsedessert/' . $dessert->id  ?>" data-dessertName="<?php echo $dessert->name ?>" data-toggle="modal" data-target="#myModal" href="#">ลบ</a></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<?php if($emptyDessert): ?>
		<h3 class="text-center">ยังไม่มีขนมหวานเลยอะคับ</h3>
	<?php endif; ?>

</div>
			

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">ลบข้อมูล</h4>
      </div>
      <div class="modal-body">
        ท่านแน่ใจที่จะลบข้อมูลขนมนี้หรือไม่?
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
        <a type="button" class="btn btn-danger danger">ลบ</a>
      </div>
    </div>
  </div>
</div>
		
@stop		
