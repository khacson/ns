//
// this script is used to dynamically insert links from each demo to its previous and next,
// as well as write the drop down.  
//
;(function() {

	var entries = [		
	],
	libraries = [		
	],
	prepareOtherLibraryString = function(demoId, library) {	
	},
	demoSelectorString = (function() {		
	})();
	
	
	jsPlumb.DemoList = {
		find:function(id) {
			
		},
		init : function() {
			var bod = document.body,
				demoId = bod.getAttribute("data-demo-id"),
				library = bod.getAttribute("data-library"),
				libraryString = '<div class="otherLibraries"></div>' + prepareOtherLibraryString(demoId, library),
				demoInfo = jsPlumb.DemoList.find(demoId);
				
			if (demoInfo) {		
				var ds = document.getElementById("demoSelector");
				ds.selectedIndex = demoInfo.idx;
				ds.onchange = function() {
					window.location.href = ds.options[ds.selectedIndex].value;
				};
			}	
		}
	};
})();