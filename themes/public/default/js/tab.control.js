var tabContainer = {}; // điều khiển khi nhấn tab
function tabControl(){
	var tabList = new Array();
	var tabIndex = 0;
	var tabMap = {};
	$(".tab-event").each(function(){
		var tabID = $(this).attr('id');
		var tabType = $(this).prop('tagName');
		if(tabID != undefined){
			if(typeof tabMap[tabID] == 'undefined'){
				tabList.push({tabID:tabID, tabType:tabType, tabIndex:tabIndex});
				tabMap[tabID] = tabIndex;
				tabIndex++;
			}
			if(tabType === 'INPUT'){
				$('#'+tabID).bind('focus', function(){
					var tabMap = tabContainer.map;
					tabContainer.state = tabMap[tabID];
				});
			} else if(tabType === 'SELECT'){
				$('#'+tabID).parent().find('.ms-choice').bind('click', function(){
					var tabMap = tabContainer.map;
					tabContainer.state = tabMap[tabID];
					tabContainer.blur = tabID;
				});
			}	
		}
	});
	if(tabList.length < 1){ // không c
		return false;
	}
	tabContainer.list = tabList;
	tabContainer.map = tabMap;
	tabContainer.state = 0;
	tabContainer.blur = null;
	tabContainer.shift = false;
	//console.log(tabContainer);
	$(document).keydown(function (e){
		if(e.keyCode === 116){ // nhấn f5
			location.reload();
		}
		if(e.keyCode === 16){ // nhấn shift => quay ngược lại
				tabContainer.shift = true;
		} 
		else if(e.keyCode !== 9){
			tabContainer.shift = false;
		} 
		else{
			e.preventDefault();
			var tabState = tabContainer.state;
			var tabList = tabContainer.list;
			if(tabContainer.shift){ // đang giữ shift
				tabState--;
				if(tabState < 0){
					tabState = 0;
				}
			} else{ // không nhấn nút shift
				tabState++;
				if(tabState >= tabList.length){ // tab đến thằng cuối
					tabState = 0;
				}
			}
			tabContainer.state = tabState;
			tabContainer.shift = false; // trả cờ shift lại false
			var nextState = tabList[tabState];
			initTabEventChange(nextState);
		}
	});
	function initTabEventChange(nextState){
		var tabID = nextState.tabID;
		var tabType = nextState.tabType;
		if(tabContainer.blur !== null){ // nếu multiple select đang mở thì đóng lại
			if(!$('#'+tabContainer.blur).parent().find('.ms-drop').is(':hidden')){
				$('#'+tabContainer.blur).parent().find('.ms-choice').click();
			}
		}
		if(tabType === 'INPUT'){
			$('#'+tabID).focus();
			tabContainer.blur = null;
		} 
		else if(tabType === 'SELECT'){
			$('#'+tabID).parent().find('.ms-choice').click();
			tabContainer.blur = tabID;
		} 
		else{
			tabContainer.blur = null;
		}
	}
	//callback();
	// for cus input đầu tiên trong list
	initTabEventChange(tabList[0]);
}
