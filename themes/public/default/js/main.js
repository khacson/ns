
$(function(){
	//S Sorting
		$("[id^='ord_']").each(function(){
			$(this).click(function(){
				order =  $(this).attr('id');
				if(index == 'DESC'){
					index = 'ASC';
				}
				else{
					index = 'DESC';
				}
				$(".loading").show();
				searchList();
			});
		});
});
var getList = function (page,csrfHash){	
	$("#token").val('');
	$.ajax({
		  url:controller+'getList',
		  async: true,
		  type: 'POST',
		  data:{csrf_stock_name:csrfHash,page:page,search:search,order:order,index:index},
		  success:function(datas) {
			 if(datas == -9){ //session expiry
				 location.reload();
			 }
			 var obj = $.evalJSON(datas);  
			 $('#paging').html(obj.paging);
			 $('#grid-rows').html(obj.content);
			 $("#token").val(obj.csrfHash);
			 var total = obj.viewtotal;
			 $(".viewtotal").html(total);
			 $(".loading").hide();
			 var p = $('#paging').html();
			 if(p==''){
				$('#paging').hide(); 
			 }
			 else{
				 $('#paging').show(); 
			 }
			 paging(obj.csrfHash);
			 if(typeof(func_get)=='function'){
				func_get(obj);
			 }
			  if(typeof(funcList)=='function'){
				  funcList(obj);
			  }
			try{
				$("#checkAll").removeAttr('checked');
			}
			catch(exx){
				//console.log(exx);
			}
		  }
	});
}
function func_get(obj){
	$('.edit').each(function(e){
		 $(this).click(function (){ 
			//con tro toi tr
			var _this = $(this);
			//con tro toi check box
			var _checkbox = _this.find(":checkbox[name='keys[]']");
			//click hang nao thi check vao hang do
			var check = _checkbox.is(':checked');
			if(check == true){
				//_checkbox.removeAttr('checked');
				_checkbox.prop('checked',false);
			}
			else{
				_checkbox.prop('checked',true);
			}
			//kiem tra xem co check all chua
			var len = $(":checkbox[name='keys[]']:checked").length;
			var len2 = $(":checkbox[name='keys[]']").length;
			$ch = (len==len2)?true:false;
			$("#checkAll").prop('checked',$ch);
		});
	});
	$("#data").scroll(function () {
		var scrollLeft = $(this).scrollLeft();
		$("#tHeader").scrollTo(scrollLeft,0,0);
	});
	$("#checkAll").click(function() { 
		$(":checkbox[name='keys[]']").prop('checked', $('#checkAll').is(':checked'));
	});
	var wHeight = $(window).height(); 
    var offset = $('#gridView').offset();
    if(typeof offset !== "undefined") {
	    var top = offset.top;
	    var h = wHeight - top - 40;
	    $('#gridView').css('max-height',h);
    }
}
function paging(csrfHash){
	$("#paging a").each(function(){
		$(this).click(function(){
			cpage = $(this).attr('name');
			getList(cpage,csrfHash);
			return false;
		});
	});
}
function getCombo(id){
	var val = $('#'+id).multipleSelect('getSelects');
	if(typeof val === 'object'){
		val = "";
	}
	return val;
}
function getComboText(id){
	var val = $('#'+id).multipleSelect('getSelects','text');
	return val;
}
$(function(){
	$("#checkAll").click(function() { 
		$(":checkbox[name='keys[]']").prop('checked', $('#checkAll').is(':checked'));
	});
	$('.date').datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true,
		defaultDate:'now'
	});
	
});
function deletecookie(name){
		document.cookie = name +'=;';
	}
function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1);
		if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
	}
	return "";
}
function formatNumber(fclass){
	$('.'+fclass).each(function(){
		 var nb = $(this).val();
		 var valsNew = number_format(nb, 0, ',', ',');
		 $(this).val(valsNew);
	});
}
function formatNumberKeyUp(fclass){
	$('.'+fclass).each(function(){
		 $(this).keyup(function(){
			  var nb = $(this).val();
			  nb = nb.replace(/[,]/g, '');
			  //console.log(nb);
			  /*if(isNaN(nb)){
				  $(this).val(0); 
			  }
			  else{
				 
			  }*/
			  var valsNew = number_format(nb, 0, ',', ',');
			  $(this).val(valsNew); 
		 });
	});
}
function formatOne(nb){
	return number_format(nb, 0, ',', ',');
}
var currPosEdit = 0;
function focusQuantityEdit(){ // khi nhan tab chi focus vao nhung o input so luong
	currPosEdit = $(".txt-quantity-edit").length;
	currPosEdit -= 1;
	// console.log(currPosEdit);
	$(".txt-quantity-edit").each(function(e) {
		$(this).keydown(function(e){
			// console.log(e.keyCode);
			// console.log($(this).attr('pos'));
			if(e.keyCode == 9){ // nhan tab
				var currPosTmp = $(this).attr('pos');
				currPosTmp++;
				if(currPosTmp > currPosEdit){
					currPosTmp = 0;
				}
				// console.log(currPosTmp);
				try{
					// $(".txt-quantity-edit")[currPosTmp].focus();
					var inputTmp = $($(".txt-quantity-edit")[currPosTmp]);
					var valTmp = $(inputTmp).val();
					inputTmp.focus().val('');
					inputTmp.focus().val(valTmp);
				}
				catch(exx){
					console.log(exx.message);
				}
				e.preventDefault();
			}
		});
	});
}
function getSearch() {
	var objReq = {};
	$(".searchs").each(function(i) {
		var id = $(this).attr('id');
		var val = $(this).val();
		val = val.replace(/['"]/g, '');
		if(id != undefined){ // neu co dinh nghia id la gi
			objReq[id] = val;
		}
	});
	$(".select2me").each(function(i) {
		var id = $(this).attr('id');
		var val = $(this).val();
		val = val.replace(/['"]/g, '');
		if(id != undefined){ // neu co dinh nghia id la gi
			var ids = id.replace('input_','');
			var res = id.substring(0, 4); 
			if(res != 's2id'){
				objReq[ids] = val;
			}
		}
	});
	$(".combos").each(function(i) {
		var id = $(this).attr('id');
		var val = getCombo(id);
		val = val.replace(/['"]/g, '');
		objReq[id] = val;
	});
	return JSON.stringify(objReq);
}
function getFormInput() {
	var objReq = {};
	$(".form-input").each(function(i) {
		var id = $(this).attr('id');
		var val = $(this).val();
		val = val.replace(/['"]/g, '');
		if(id != undefined){ // neu co dinh nghia id la gi
			var ids = id.replace('input_','');
			var res = id.substring(0, 4); 
			if(res != 's2id'){
				objReq[ids] = val;
			}
		}
	});
	$(".combos-input").each(function(i) {
		var id = $(this).attr('id');
		var val = getCombo(id);
		val = val.replace(/['"]/g, '');
		objReq[id.replace('input_','')] = val;
	});
	return JSON.stringify(objReq);
}
function getCheckedId(){
	var strId = '';
	/*$('#grid-rows input.noClick:checked').each(function(){
		var id = $(this).attr('id');
		strId += ','+id;
	});*/
	$('#grid-rows input.noClick').each(function(){
		if($(this).is(':checked')){
			var id = $(this).attr('id');
			strId += ','+id;
		}
	});
	return strId.substring(1);
}   
function setNumberKeyUp(fclass){
	$('.'+fclass).each(function(){
		$('.'+fclass).keyup(function () {		
			if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
				this.value = this.value.replace(/[^0-9\.]/g, '');
			}
		});	
	});	
}
function validateEmail(email){
	var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	var valid = emailReg.test(email);
	if(!valid) {
		return false;
	} else {
		return true;
	}
}
function handleSelect2(){
	if (jQuery().select2) {
		$('.select2me').select2({
			placeholder: "Select",
			allowClear: true
		});
	}
}