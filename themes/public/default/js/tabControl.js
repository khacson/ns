var tabContainer = {}; // điều khiển khi nhấn tab
var tabPosition = 0;
function tabControl(){
	var tabList = new Array();
	var tabIndex = 0;
	var tabTimes = 0;
	var tabTimesNext = 0;
	var tabMap = {};
	var tabClass = '.tab-event';
	if(tabPosition == 1){
		tabClass = '.input-tab';
	}
	$(tabClass).each(function(e){
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
		/*$(this).click(function(){
			if(tabType === 'INPUT'){
				$('#'+tabID).focus();
			}
			else if(tabType === 'SELECT'){
				$('#'+tabID).parent().find('.dropsearch').focus();
			}
		});*/
	});
	if(tabList.length < 1){ // không c
		return false;
	}
	tabContainer.list = tabList;
	tabContainer.map = tabMap;
	tabContainer.state = 0;
	tabContainer.blur = null;
	tabContainer.shift = false;
	$(document).keydown(function (e){ 
		if(e.keyCode === 116){ // nhấn f5
			location.reload();
		}
		if(e.keyCode === 16){ // nhấn shift => quay ngược lại
			tabContainer.shift = true;
			//console.log(tabList);
		} 
		else if(e.keyCode !== 9){
			tabContainer.shift = false;
		} 
		else{
			e.preventDefault();
			var tabList = tabContainer.list;
			var checkFirst = tabContainer.list[0].tabType;//Vị trí đầu tiên của form
			if(checkFirst == 'SELECT'){
				tabTimes = 1;
				if(tabTimesNext == 0){
					tabContainer.state = -1;
				}
				tabTimesNext = 1;
			}
			var tabState = tabContainer.state;
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
		var findTabIndex = nextState.tabIndex; //Vi tri tab
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
			if(tabTimes == 1){
				$('#'+tabID).parent().find('.ms-choice').click();
				$('#'+tabID).parent().find('.dropsearch').focus();
			}
			tabContainer.blur = tabID;
		} 
		else{
			tabContainer.blur = null;
		}
		tabTimes = 1;
	}
	//callback();
	// for cus input đầu tiên trong list
	initTabEventChange(tabList[0]);
	//Phím tắt
	$(function(){
		//Firfox
		var isFirefox = typeof InstallTrigger !== 'undefined';
		if(isFirefox){
			$(document).keypress(function(event) {
				//alert(event.which);
				if ((event.which == 115) && (event.ctrlKey||event.metaKey)|| (event.which == 19)) {
					event.preventDefault();
					//alert('Ctr+S');
					save();
					return false;
				}
				else if ((event.which == 102) && (event.ctrlKey||event.metaKey)|| (event.which == 19)) {
					event.preventDefault();
					//alert('Ctr+F');
					tabClass = '.input-tab';
					popup();
					return false;
				}
				else if ((event.which == 108) && (event.ctrlKey||event.metaKey)|| (event.which == 19)) {
					event.preventDefault();
					//alert('Ctr+L');
					tabClass = '.input-tab';
					popup();
					return false;
				}
				return true;
			});
		}
		//Chrom
		var isChrome = !!window.chrome && !!window.chrome.webstore;
		if(isChrome){
			$(document).bind('keydown', function(event) {
				//alert(event.which);
				if(event.ctrlKey && (event.which == 83)) {
					event.preventDefault();
					//alert('Ctrl+Ss');
					save();
					return false;
				}
				else if(event.ctrlKey && (event.which == 70)) {
					event.preventDefault();
					//alert('Ctrl+F');
					tabClass = '.input-tab';
					popup();
					return false;
				}
				else if(event.ctrlKey && (event.which == 76)) {
					event.preventDefault();
					//alert('Ctrl+L');
					tabClass = '.input-tab';
					popup();
					return false;
				}
			});
		}
		//MAC
		var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));
		if(isSafari){
			document.addEventListener("keydown", function(event) {
			  if (event.keyCode == 83 && (navigator.platform.match("Mac") ? event.metaKey : event.ctrlKey)) {
				event.preventDefault();
				//alert('captured');
				save();
			  }
			}, false);
			document.addEventListener("keydown", function(event) {
			  if (event.keyCode == 70 && (navigator.platform.match("Mac") ? event.metaKey : event.ctrlKey)) {
				event.preventDefault();
				//alert('captured');
				popup();
			  }
			}, false);
			document.addEventListener("keydown", function(event) {
			  if (event.keyCode == 76 && (navigator.platform.match("Mac") ? event.metaKey : event.ctrlKey)) {
				event.preventDefault();
				//alert('captured');
				popup();
			  }
			}, false);
		}
	});
}
