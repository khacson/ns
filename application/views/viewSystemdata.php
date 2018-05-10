<div class="view-systemdata form">
<?php
	$arrPhoneClassify = array(
		0 => '',
		1 => 'FF',
		2 => 'PTG',
		3 => 'PUG',
		4 => 'PUB',
		5 => 'NW ',
	);
	$strFunction = '';
	$strDuration = '';
	$cosmeticGrade = ''; 
	foreach ($datas as $item) {
		$systemdata = json_decode($item->systemdata,true);
		unset($systemdata['function_item']);
		//sap xep lai cac key cho hop ly
		if(isset($systemdata['dtime_startapp']) && isset($systemdata['dtime_finishapp'])){
			$temp1 = $systemdata['dtime_startapp'];
			$temp2 = $systemdata['dtime_finishapp'];
			unset($systemdata['dtime_startapp']);
			unset($systemdata['dtime_finishapp']);
			
			
			$systemdata['dtime_startapp'] = $temp1;
			$systemdata['dtime_finishapp'] = $temp2;
		}
		if(isset($systemdata['dtime_starterase']) && isset($systemdata['dtime_finisherase'])){
			$temp1 = $systemdata['dtime_starterase'];
			$temp2 = $systemdata['dtime_finisherase'];
			unset($systemdata['dtime_starterase']);
			unset($systemdata['dtime_finisherase']);
			$systemdata['dtime_starterase'] = $temp1;
			$systemdata['dtime_finisherase'] = $temp2;
		}
		if(isset($systemdata['dtime_timestart']) && isset($systemdata['dtime_timeend'])){
			$temp1 = $systemdata['dtime_timestart'];
			$temp2 = $systemdata['dtime_timeend'];
			unset($systemdata['dtime_timestart']);
			unset($systemdata['dtime_timeend']);
			$systemdata['dtime_timestart'] = $temp1;
			$systemdata['dtime_timeend'] = $temp2;
		}
		
		$arrCosmeticGrade = array('function_cosmeticgrade');
		$arrCosmeticSurface = array('function_cosface');
		$arrCosmetic = array('function_cosmeticrear','function_cosmeticfront','function_cosmeticright','function_cosmeticup','function_cosmeticdown','function_cosmeticleft');
		$arrButton = array('function_mutebuttonstatus','function_homebuttonstatus','function_upbuttonstatus','function_downbuttonstatus','function_powerbuttonstatus');
		$arrCamera = array('function_camerafront','function_camerarear');
		$arrPower = array('function_power_phone_overheating','function_power_freeze','function_power_intermitter');
		
		$arrayCosmeticGrade = array();
		$arrayCosmeticSurface = array();
		$arrayCosmetic = array();
		$arrayButton =array();
		$arrayCamera = array();
		$arrayPower = array();
		
		if(is_array($systemdata)){
			$strSpecial = '';
			foreach($systemdata as $k=>$v){
				if(in_array($k, $arrCosmetic)){
					$arrayCosmetic[$k] = $v;
					unset($systemdata[$k]);
				}
				if(in_array($k, $arrCosmeticGrade)){
					$arrayCosmeticGrade[$k] = $v;
					$cosmeticGrade = $v;
					unset($systemdata[$k]);
				}
				if(in_array($k, $arrCosmeticSurface)){
					$arrayCosmeticSurface[$k] = $v;
					unset($systemdata[$k]);
				}
				if(in_array($k, $arrButton)){
					$arrayButton[$k] = $v;
					unset($systemdata[$k]);
				}
				if(in_array($k, $arrCamera)){
					$arrayCamera[$k] = $v;
					unset($systemdata[$k]);
				}
				if(in_array($k, $arrPower)){
					unset($systemdata[$k]);
					$arrayPower[$k] = $v;
				}
			}
			
			$t = 0;
			$space = 'space-5';
			if(!empty($arrayCosmetic)){ 
				$t++;
				if($t%3 == 0){
					$space = '';
				}
				$strSpecial .= "<div class='item-group f-left $space'><label class='w-11 lb'>Cosmetic</label><div class='f-left w112'><select id='cosmetic' name='cosmetic' class='selectJson f-left'>";
				foreach($arrayCosmetic as $k=>$v){
					$keyName = $k;
					if(isset($systemData[strtolower($k)])){
						$keyName = str_replace('Cosmetic', '', $systemData[strtolower($k)]); 
					}
					$strSpecial .= "<option value='' dataInput='$v'>$keyName</option>";
				}
				$strSpecial .= "</select></div></div>";
			}
			
			$space = 'space-5';
			if(!empty($arrayCosmeticGrade)){ 
				$t++;
				if($t%3 == 0){
					$space = '';
				}
				foreach($arrayCosmeticGrade as $k=>$v){
					$keyName = $k;
					if(isset($systemData[strtolower($k)])){
						$keyName = $systemData[strtolower($k)]; 
					}
					$strSpecial .= "<div class='item-group f-left $space' keyname='$k'><label class='lb w-11'>$keyName</label>";
					if($v == 'Passed'){
						$strSpecial .= "<input class='cblue systemdata in-text w-1 colorinput' type='text' value='Passed' readonly />";
					}
					elseif($v=='Failed'){
						$strSpecial .= "<input class='cred systemdata in-text w-1 colorinput' type='text' value='Failed' readonly />";
					}
					else{
						$strSpecial .= "<input class='systemdata in-text w-1 colorinput' type='text' value='$v' readonly />";	
					}
					$strSpecial .= "</div>";
				}
			}
			
			$space = 'space-5';
			if(!empty($arrayCosmeticSurface)){
				$t++;
				if($t%3 == 0){
					$space = '';
				}
				foreach($arrayCosmeticSurface as $k=>$v){
					$keyName = $k;
					if(isset($systemData[strtolower($k)])){
						$keyName = $systemData[strtolower($k)]; 
					}
					$strSpecial .= "<div class='item-group f-left $space' keyname='$k'><label class='lb w-11'>$keyName</label>";
					if($v == 'Passed'){
						$strSpecial .= "<input class='cblue systemdata in-text w-1 colorinput' type='text' value='Passed' readonly />";
					}
					elseif($v=='Failed'){
						$strSpecial .= "<input class='cred systemdata in-text w-1 colorinput' type='text' value='Failed' readonly />";
					}
					else{
						$strSpecial .= "<input class='systemdata in-text w-1 colorinput' type='text' value='$v' readonly />";	
					}
					$strSpecial .= "</div>";
				}
			}
			
			$space = 'space-5';
			if(!empty($arrayButton)){
				$t++;
				if($t%3 == 0){
					$space = '';
				}
				$strSpecial .= "<div class='item-group f-left $space'><label class='w-11 lb'>Button</label><div class='f-left w112'><select id='button' name='button' class='selectJson f-left'>";
				foreach($arrayButton as $k=>$v){
					$keyName = $k;
					if(isset($systemData[strtolower($k)])){
						$keyName = str_replace('Button', '', $systemData[strtolower($k)]); 
					}
					$strSpecial .= "<option value='' dataInput='$v'>$keyName</option>";
				}
				$strSpecial .= "</select></div></div>";
			}
			
			$space = 'space-5';
			if(!empty($arrayCamera)){
				$t++;
				if($t%3 == 0){
					$space = '';
				}
				$strSpecial .= "<div class='item-group f-left $space'><label class='w-11 lb'>Camera</label><div class='f-left w112'><select id='camera' name='camera' class='selectJson f-left'>";
				foreach($arrayCamera as $k=>$v){
					$keyName = $k;
					if(isset($systemData[strtolower($k)])){
						$keyName = str_replace('Camera', '', $systemData[strtolower($k)]); 
					}
					$strSpecial .= "<option value='' dataInput='$v'>$keyName</option>";
				}
				$strSpecial .= "</select></div></div>";
			}
			
			$space = 'space-5';
			if(!empty($arrayPower)){
				$t++;
				if($t%3 == 0){
					$space = '';
				}
				$strSpecial .= "<div class='item-group f-left $space power'><label class='w-11 lb'>Power</label><div class='f-left w112'><select id='power' name='power' class='selectJson f-left'>";
				foreach($arrayPower as $k=>$v){
					$keyName = $k;
					if(isset($systemData[strtolower($k)])){
						$keyName = str_replace('Power', '', $systemData[strtolower($k)]); 
					}
					$strSpecial .= "<option value='' dataInput='$v'>$keyName</option>";
				}
				$strSpecial .= "</select></div></div>";
			}
			
			$i = 0;
			foreach($systemdata as $k=>$v){
				if($v == "N/A" || empty($v)){
					continue;
				}
				$keyName = $k; $kk = strtolower($k);
				if(isset($systemData[$kk])){
					$keyName = $systemData[$kk]; 
				}
				else{
					continue;
				}
				$v = (string)$v;
				if(strpos($k, 'dtime') !== false){//duration
					$i++;
					$style = "";
					if($i%3 == 0){
						$style = "style='margin-right: 0 !important'";
					}
					$value = "<input class='systemdata in-text w-1 colorinput' type='text' value='$v' readonly />";	
					$strDuration .= "<div keyname='$k' class='item-group f-left space-5' $style><label class='lb w-11'>$keyName</label>$value</div>";
				}
				else{
					$t++;
					$style = "";
					if($t%3 == 0){
						$style = "style='margin-right: 0 !important'";
					}
					if($v == 'Passed'){
						$value ="<input class='cblue systemdata in-text w-1 colorinput' type='text' value='Passed' readonly />";
					}
					elseif($v=='Failed'){
						$value ="<input class='cred systemdata in-text w-1 colorinput' type='text' value='Failed' readonly />";
					}
					else{
						$value = "<input class='systemdata in-text w-1 colorinput' type='text' value='$v' readonly />";	
					}
					$strFunction .= "<div keyname='$k' class='item-group f-left space-5' $style><label class='lb w-11'>$keyName</label>$value</div>";
				}
			}
		}
	}
?>	
	<div>
		<?php if(!empty($strFunction) || !empty($strSpecial)){ ?>
		<div class="system-title" style="float: left;">Function test</div>
		<?php } ?>
		
		<?php if(!empty($printLabel)){ ?>
		<div class="printLabel">
			<input style="cursor: pointer;" class="btn-2" type="button" value="Print Barcode" onclick="printBarcode()" title="Print Barcode">
		</div>
		<?php } ?>
	</div>
	<br style="clear: both;"/>
	
	<?php 
		if(!empty($strFunction) || !empty($strSpecial)){
			echo $strSpecial.$strFunction;
		} 
	?>
	
	<?php if(!empty($strDuration)){ ?>
	<div class="system-title">Tested time</div>
	<?=$strDuration?>
	<?php } ?>
	<?php 
		if(empty($usedparts)){
			$usedparts = array();
		}
	?>
	<?php if(count($usedparts) > 0){?>
	<div class="system-title">Part used</div>
	<ul class="usedpart">
		<?php foreach($usedparts as $item){?>
			<li><?=$item->partnumber;?> - <?=$item->description;?> - Quantity: <?=$item->quantity;?></li>
		<?php }?>
	</ul>
	<?php }?>
</div>

<!--html barcode-->
<?php if(!empty($printLabel)){ ?>
	<?php if($printLabel == 1){?>
		<div class="f-right w-5 barcode" style="display: none;">
			<fieldset>
				<legend align="center" style="color: #595959">Barcode Preview</legend>
				<div class="content" id="printBarcode">
					<div class="w200 fleft f12">
						<div class="w200 fleft h210">
							 <!--S -->
							<div class="fleft mt2a" style="width:250px;">
								<div style="white-space:nowrap" class="fleft mleft3">
									P/N:&nbsp;
									<?=$info->productname;?>&nbsp;
									<?php if(!empty($info->capacity)){?>
									<?=$info->capacity;?>&nbsp;
									<?php }?>
									<span style="text-transform:capitalize;"><?=$info->color;?></span>
								</div>
							</div>
							<div class="fleft w200" style="display: none">
									&nbsp;&nbsp;<img src='<?= url_tmpl();?>barcodegen/html/image.php?filetype=PNG&dpi=300&scale=2&rotation=0&font_family=Arial.ttf&font_size=0&text=<?=$info->model;?>&thickness=50&start=C&code=BCGcode128' width = '170px' height = '10px'>
							</div>
							<!--E -->
							 <!--S -->
							<div class="fleft w200 mt2a">
								<div class="fleft mleft3">
									Model:&nbsp;<?=$info->model;?><span>  Carrier:&nbsp;<?=$info->carrier?></span>
								</div>
							</div>
							<div class="fleft w200" >
									&nbsp;<img src='<?= url_tmpl();?>barcodegen/html/image.php?filetype=PNG&dpi=300&scale=2&rotation=0&font_family=Arial.ttf&font_size=0&text=<?=$info->imei;?>&thickness=50&start=C&code=BCGcode128' width = '170px' height = '10px'>
							</div>
							<!--E -->
							<!--S -->
							<div class="fleft w200 mt2a">
								<div class="fleft mleft3">
								IMEI:&nbsp;<?=$info->imei;?>
								</div>
							</div>
							<!--E -->
							<!--S -->
							<div class="fleft w200 mt2a">
								<div class="fleft mleft3">FMI/Activation Lock:&nbsp;<?=$info->fmip;?></div>
							</div>
							<!--E -->
							 <div class="fleft w200 mt2a">
								<div class="fleft mleft3">
									Cosmetic Grade:&nbsp;<span id="getcosmetic"><?=$cosmeticGrade;?></span>
								</div>
							</div>
							<!--E -->
							<!--E -->
							 <div class="fleft w200 mt2a">
								<div class="fleft mleft3">
									<?php 
										$phoneclassify = '';
										if(isset($arrPhoneClassify[$info->phoneclassify])){
											$phoneclassify = $arrPhoneClassify[$info->phoneclassify];
										}
									?>
									Phone Classify:&nbsp;<b style="font-size: 20px;"><?=$phoneclassify;?></b>
								</div>
							</div>
							<!--E -->
						</div>
					</div>
				</div>
			</fieldset>
			
		</div>
	<?php } ?>
	<?php if($printLabel == 2){?>
		<div class="f-right w-5 barcode" style="display: none;">
			<fieldset>
				<legend align="center" style="color: #595959">Barcode Preview</legend>
				<div class="content" id="printBarcode">
					<div class="w200 fleft f12" style="width: 230px;float: left; margin-right: 10px;">
						<div class="w200 fleft h210">
							 <!--S -->
							<div class="fleft mt2a" style="width:250px;">
								<div style="white-space:nowrap" class="fleft mleft3">
									P/N:&nbsp;
									<?=$info->productname;?>&nbsp;
									<?php if(!empty($info->capacity)){?>
									<?=$info->capacity;?>&nbsp;
									<?php }?>
									<span style="text-transform:capitalize;"><?=$info->color;?></span>
								</div>
							</div>
							<!--E -->
							<div class="fleft w200" >
									&nbsp;<img src='<?= url_tmpl();?>barcodegen/html/image.php?filetype=PNG&dpi=300&scale=2&rotation=0&font_family=Arial.ttf&font_size=0&text=<?=$info->uniqueid;?>&thickness=50&start=C&code=BCGcode128' width = '170px' height = '10px'>
							</div>
							<!--S -->
							<div class="fleft mt2a" style="width:250px;">
								<div style="white-space:nowrap" class="fleft mleft3">
									<?=$nextprocess?>
								</div>
							</div>
							<div class="fleft mt2a" style="width:250px;">
								<div style="white-space:nowrap" class="fleft mleft3">
									UID: <?=$info->uniqueid;?>
								</div>
							</div>
							<!--E -->
							 <!--S -->
							<div class="fleft w200 mt2a">
								<div class="fleft mleft3">
									Carrier:&nbsp;<?=$info->carrier?></span>
								</div>
							</div>
							<div class="fleft w200" >
									&nbsp;<img src='<?= url_tmpl();?>barcodegen/html/image.php?filetype=PNG&dpi=300&scale=2&rotation=0&font_family=Arial.ttf&font_size=0&text=<?=$info->imei;?>&thickness=50&start=C&code=BCGcode128' width = '170px' height = '10px'>
							</div>
							<!--E -->
							<!--S -->
							<div class="fleft w200 mt2a">
								<div class="fleft mleft3">
								IMEI:&nbsp;<?=$info->imei;?>
								</div>
							</div>
							<!--E -->
							<!--S -->
							<div class="fleft w200 mt2a">
								<div class="fleft mleft3">FMI/Activation Lock:&nbsp;<?=$info->fmip;?></div>
							</div>
							<!--E -->
							<!--S -->
							<div class="fleft w200 mt2a">
								<div class="fleft mleft3">PO#:&nbsp;<?=$info->poname;?></div>
							</div>
							<!--E -->
							<!--S -->
							<div class="fleft w200 mt2a">
								<div class="fleft mleft3">Blacklist:&nbsp;<?=$info->blacklist;?></div>
							</div>
							<!--E -->
							 <div class="fleft w200 mt2a">
								<div class="fleft mleft3">
									Cosmetic Grade:&nbsp;<span id="getcosmetic"><?=$cosmeticGrade;?></span>
								</div>
							</div>
							<!--E -->
							<!--S -->
							<div class="fleft w200 mt2a">
								<div class="fleft mleft3">Function First Failed:&nbsp;<?=$firstFailed;?></div>
							</div>
							<!--E -->
							<!--S -->
							<div class="fleft w200 mt2a">
								<div class="fleft mleft3">LCD Status:&nbsp;<?=$lcd;?></div>
							</div>
							<!--E -->
							<!--E -->
							 <div class="fleft w200 mt2a">
								<div class="fleft mleft3">
									<?php 
										$phoneclassify = '';
										if(isset($arrPhoneClassify[$info->phoneclassify])){
											$phoneclassify = $arrPhoneClassify[$info->phoneclassify];
										}
									?>
									Classify: <b style="font-size: 20px;"><?=$phoneclassify;?></b>
								</div>
							</div>
							<!--E -->
						</div>
					</div>
					<div style="float: left; margin-top: 20px;">
						<b style="font-size: 50px;"><?php echo strtoupper(substr($nextprocess, 0, 1)); ?></b>
					</div>
				</div>
			</fieldset>
			
		</div>
	<?php } ?>
<?php } ?>


<script>
	$('.selectJson').multipleSelect({
		filter: true,
		single: false,
		multipleInput: true,
		inputTitle: '',
		typeMultipleInput: 'select'
	})
	$('#cosmetic, #button, #camera, #power').multipleSelect('checkAll');
	function printBarcode() {
		var disp_setting = "toolbar=yes,location=yes,directories=yes,menubar=no,";
		disp_setting += "scrollbars=yes,width=1000, height=500, left=0.0, top=0.0";
		$barcode = $("#printBarcode").html();
		$css = '<link rel="stylesheet" href="http://localhost:8088/gsi_new/themes/public/default/css/fancybox.css">';
		var docprint = window.open("certificate", "certificate", disp_setting);
		docprint.document.open();
		docprint.document.write('<html>');
		docprint.document.write($css);
		docprint.document.write('<body onLoad="self.print()">');
		docprint.document.write($barcode);
		docprint.document.write('</body></html>');
		docprint.document.close();
		docprint.focus();
		//docprint.close();
   }
</script>
<style>
	.w112{
		width: 112px;
	}
	.ms-drop label { float: left;}
	.ms-drop{
		min-width: 265px;
	} 
	.ms-drop .right {
		margin-right: 20px;
	}
	.power .ms-drop{
		right: 0;
	}
	.usedpart{
		margin-left:90px;
		margin-bottom:30px;
		margin-top:-35px;
	}
	.usedpart li{
		list-style:none;
		/*float:left;*/
		margin-top:3px;
	}
	.printLabel {
		font-size: 12px;
		cursor: pointer;
		float: right;
	}
</style>
