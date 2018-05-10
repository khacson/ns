$(function () {	
	refreshTable(); 
});
function refreshTable(){
	//Tinh ðo rong cac cot
	var w = 0; var attw; var arr = [];
	$('.tbtop th').each(function(e){
		var attw = parseInt($(this).attr('width'));
		if(!isNaN(attw)){
			w+=attw;
		}
		else{
			attw = 'auto';
		}
		arr[e] = attw;
	});
	var ws = parseInt(w*20/100);
	w+=ws;
	$('.tbtop').width(w); //Gan do rong table
	$('.tbcenter').width(w-20); //Gan do rong table
	//var toptitle = parseInt($('.toptitle').height())+10;
	//$('.tbtop').css('margin-top',toptitle);
	$('#table').find('#gridview').scroll(function(obj) {
		var scrollLeft = $(this).scrollLeft();
		var scrollTop = $(this).scrollTop();
		$('#table').find('#header').scrollTo(scrollLeft, 0);
	});
	//Click o list
	$('.edit').each(function(e){
        $(this).click(function(e){
            //con tro toi tr
            var _this = $(this);
			console.log(_this);
            //con tro toi check box
            var _checkbox = _this.find(":checkbox[name='check']");
            //click hang nao thi check vao hang do
            $('.listitem').removeClass('bgclick');
            _this.addClass('bgclick');
            var check = _checkbox.is(':checked');
            if(check == true){
                _checkbox.removeAttr('checked');
                //_this.removeClass('bgclick');
            }
            else{
                _checkbox.attr('checked',true);
                //_this.addClass('bgclick');
            }
            //kiem tra xem co check all chua
            var len = $(":checkbox[name='check']:checked").length;
            var len2 = $(":checkbox[name='check']").length;
            $ch = (len==len2)?true:false;
            $("#checkall").attr('checked',$ch);
        });
    });
    //click check all
    $("#checkall").click(function(){
        if($("#checkall").is(':checked')){
            $(":checkbox[name='check']").attr('checked',true);
        }
        else{
            $(":checkbox[name='check']").removeAttr('checked');
        }
    });
}