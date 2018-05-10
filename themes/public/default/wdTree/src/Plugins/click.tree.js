/*Sonnguyen V1.0.0*/
function getProductname(){
		var model = "";
		var value = "";
		var nodes=$("#tree").getCheckedNodes();
		if(nodes !=null){
			for(node in nodes){
				value = nodes[node].split('__');	
				if(value[0]=='sub'){
					model+= ','+value[1];
				}
			}
		}
		else{
			model = " ";
		}
		if(model!=""){
			model = model.substring(1);;
		}
		return model;
}
$(function () {
    $('body').bind('click', function (evt) {
		//console.log(evt.target);
		if(evt.target == $('#bgtree')[0]) {
		  $(".wtree").show();
		}
		else if(evt.target == $('.itemslect')[0]){
			$(".wtree").show();
		}
		else{
			//litree 
			//console.log(evt.target);
			$(".wtree").hide();
			var n = 1;
			$('.bbit-tree-node-cb').each(function(){
				n++;
			});
			for(var i=0; i<=n;i++){
				if(evt.target == $('.bbit-tree-node-cb')[i]){
					$(".wtree").show();
					var nodes=$("#tree").getCheckedNodes();
					var item = 0;
					if(nodes !=null)
					{
						for(node in nodes){ 
							item++;
						}
					}
					var view_item = item+ ' of '+ (n-1) +' selected';
					if(item > 0){
						$(".itemslect").html(view_item);
					}
					else{
						$(".itemslect").html("-- Select product(s) --");
					}
				}
			}
			for(var i=0; i<=n;i++){
				if(evt.target == $('.bbit-tree-ec-icon')[i]){
					$(".wtree").show();
				}
				else if(evt.target == $('.bbit-tree-node-icon')[i]){
					$(".wtree").show();
				}
				else if(evt.target == $('.bbit-tree-elbow-line')[i]){
					$(".wtree").show();
				}
				else if(evt.target == $('.bbit-tree-icon')[i]){
					$(".wtree").show();
				}
				else if(evt.target == $('.bbit-tree-node-el')[i]){
					$(".wtree").show();
				}
			}
		}
	  });
});