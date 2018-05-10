<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ho-ten');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_fullname"  id="input_fullname" class="form-input form-control " 
				value="<?=$finds->fullname;?>" placeholder="<?=getLanguage('nhap-ho-ten');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('dien-thoai');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_phone"  id="input_phone" class="form-input form-control " 
				value="<?=$finds->phone;?>" placeholder="<?=getLanguage('nhap-dien-thoai');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('email');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_email"  id="input_email" class="form-input form-control " 
				value="<?=$finds->email;?>" placeholder="<?=getLanguage('nhap-email');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('gioi-tinh')?></label>
			<div class="col-md-8">
				<select  id="sex" name="sex" class="select2me form-input form-control " data-placeholder="<?=getLanguage('chon-gioi-tinh')?>">
					<option value=""></option>
					<option <?php if($finds->sex == 1){?> selected <?php }?>  value="1"><?=getLanguage('nam');?></option>
					<option <?php if($finds->sex == 2){?> selected <?php }?>  value="2"><?=getLanguage('nu');?></option>
					<option <?php if($finds->sex == -1){?> selected <?php }?>  value="-1"><?=getLanguage('gioi-tinh-khac');?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<?php 
				$birthday = '';
				if(!empty($finds->birthday) && $finds->birthday != '0000-00-00'){
					$birthday = date(configs('cfdate'),strtotime($finds->birthday));
				}
			?>
			<label class="control-label col-md-4"><?=getLanguage('ngay-sinh')?></label>
			<div class="col-md-8">
				<div class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
					<input value="<?=$birthday;?>" id="birthday" name="birthday" type="text" class="form-input form-control ">
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('dia-chi');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_address"  id="input_address" class="form-input form-control" 
				value="<?=$finds->address;?>" placeholder="<?=getLanguage('nhap-dia-chi');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<?php 
				$date_interview = '';
				if(!empty($finds->date_interview) && $finds->date_interview != '0000-00-00'){
					$date_interview = date(configs('cfdate'),strtotime($finds->date_interview));
				}
			?>
			<label class="control-label col-md-4"><?=getLanguage('ngay-phong-van')?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<div class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
					<input value="<?=$date_interview;?>" id="date_interview" name="date_interview" type="text" class="searchs form-control  form-input">
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('vi-tri-ung-tuyen');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_recruitment_position"  id="input_recruitment_position" class="form-input form-control " 
				value="<?=$finds->recruitment_position;?>" placeholder="<?=getLanguage('nhap-vi-tri-ung-tuyen');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('trinh-do-hoc-van')?></label>
			<div class="col-md-8">
				<select id="academic_level" name="academic_level" class="select2me form-input form-control " data-placeholder="<?=getLanguage('chon-trinh-do-hoc-van')?>">
					<option value=""></option>
					<?php foreach($academics as $item){?>
						<option <?php if($finds->academic_level == $item->id){?> selected <?php }?> value="<?=$item->id;?>"><?=$item->academic_name;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('trinh-do-chuyen-mon');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_academic_skills"  id="input_academic_skills" class="form-input form-control " 
				value="<?=$finds->academic_skills;?>" placeholder="<?=getLanguage('nhap-trinh-do-chuyen-mon');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_description"  id="input_description" class="form-input form-control " 
				value="<?=$finds->description;?>" placeholder="<?=getLanguage('nhap-ghi-chu');?>" 
				/>
			</div>
		</div>
	</div>
</div>
<?php
	//print_r($finds);
?>
<script>
	$(function(){
		initForm();
		handleSelect2();
	});
	function initForm(){
		
	}
</script>
