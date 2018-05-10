function error(text){
	toastr.error(text,mgsError, 
	{
	   closeButton: false,
	   //debug: true,
	   newestOnTop: false,
	   progressBar: true,
	   positionClass: "toast-top-center",
	   preventDuplicates: true,
	   onclick: null,
	   showDuration: "300",
	   hideDuration: 5000,
	   timeOut: 5000,
	   extendedTimeOut: 5000,
	   showEasing: "swing",
	   hideEasing: "linear",
	   showMethod: "fadeIn",
	   hideMethod: "fadeOut"
	}); 
}
function warning(text){
	 toastr.warning(text,mgs_Msg, {
	   closeButton: false,
	   //debug: true,
	   newestOnTop: false,
	   progressBar: true,
	   positionClass: "toast-top-center",
	   preventDuplicates: true,
	   onclick: null,
	   showDuration: "300",
	   hideDuration: 3000,
	   timeOut: 3000,
	   extendedTimeOut: 3000,
	   showEasing: "swing",
	   hideEasing: "linear",
	   showMethod: "fadeIn",
	   hideMethod: "fadeOut"
	});
}
function success(text){
	toastr.success(text,mgs_Msg, 
	{
	   closeButton: false,
	   //debug: true,
	   newestOnTop: false,
	   progressBar: true,
	   positionClass: "toast-top-center",
	   preventDuplicates: true,
	   onclick: null,
	   showDuration: "300",
	   hideDuration: 1000,
	   timeOut: 1000,
	   extendedTimeOut: 1000,
	   showEasing: "swing",
	   hideEasing: "linear",
	   showMethod: "fadeIn",
	   hideMethod: "fadeOut"
	});
}
var ids = '';
function confirmDelete(id) { 
        toastr.options = {
            "closeButton": false,
            "debug": true,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "0",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
		var cf = cfDelete;
		ids = id;
        toastr.warning('<div class="txtconfirmDelete">'+cf+'</div><div class="text-center"><button type="button" onclick="okDelete();" id="okdelete" class="btn btn-danger">'+deletes+'</button><button type="button" id="surpriseBtn" class="btn" style="margin: 0 8px 0 8px">'+cancel+'</button></div>')
}
function okDelete(){
	$.ajax({
		url : controller + 'deletes',
		type: 'POST',
		async: false,
		data: {id:ids},
		success:function(datas){
			var obj = $.evalJSON(datas); 
			$("#token").val(obj.csrfHash);
			if(obj.status == 0){
				error("Xóa thành công"); return false;		
			}
			else{
				success('Xóa thành công');
				refresh();	return false;		
			}
		},
		error : function(){
			error("Xóa không thành công"); return false;		
		}
	});
}
