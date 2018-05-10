<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ma-khach-hang');?></label>
			<div class="col-md-8">
				<input type="text" name="customer_code" placeholder="<?=getLanguage('nhap-ma-kh');?>" id="customer_code" value="<?=$finds->customer_code;?>" class="form-input form-control tab-event"  />
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('khach-hang');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="customer_name" placeholder="<?=getLanguage('nhap-ten-kh');?>" id="customer_name" value="<?=$finds->customer_name;?>" class="form-input form-control tab-event"  />
			</div>
		</div>
	</div>
</div>
<div class="row mtop10">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('dien-thoai');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="phone" placeholder="<?=getLanguage('nhap-dien-thoai');?>" id="phone" value="<?=$finds->phone;?>" class="form-input form-control tab-event phone"  />
			</div>			
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">			
			<label class="control-label col-md-4"><?=getLanguage('email');?></label>
			<div class="col-md-8">
				<input type="text" name="email" placeholder="<?=getLanguage('nhap-email');?>" id="email" value="<?=$finds->email;?>"  class="form-input form-control tab-event email" />
			</div>
		</div>
	</div>
</div>
<div class="row mtop10">
	<div class="col-md-6">
		<div class="form-group">			
			<label class="control-label col-md-4"><?=getLanguage('dia-chi');?></label>
			<div class="col-md-8">				
				<input type="text" name="address" placeholder="<?=getLanguage('nhap-dia-chi');?>" id="address" value="<?=$finds->address;?>" class="form-input form-control tab-event" />
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">			
			<label class="control-label col-md-4" ><?=getLanguage('sinh-nhat');?></label>
			<div class="col-md-8">	
				<?php $birthday = '';
					if(!empty($finds->birthday) && $finds->birthday != '0000-00-00'){
						$birthday = date(configs('cfdate'),strtotime($finds->birthday));
					}
				?>
				<div class="input-group date" data-provide="datepicker">
					<input type="birthday" name="birthday" placeholder="<?=getLanguage('chon-ngay');?>" id="birthday"  value="<?=$birthday;?>" class="form-input form-control tab-event" />				
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
<div class="row mtop10">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('mst');?></label>
			<div class="col-md-8">				
				<input type="text" name="mst" placeholder="<?=getLanguage('nhap-mst');?>" id="mst" value="<?=$finds->mst;?>" class="form-input form-control tab-event"  />
			</div>			
		</div>
	</div>
	
</div>
