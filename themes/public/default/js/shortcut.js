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