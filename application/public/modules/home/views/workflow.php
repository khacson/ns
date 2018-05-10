<!-------------------danh cho uer------------------------------->  
<script type='text/javascript'>
    $(function() {
		var token = $("#token").val();
        jsPlumb.importDefaults({
            // default drag options
            DragOptions: {cursor: 'pointer', zIndex: 2000},
            EndpointStyles: [{fillStyle: '#225588'}, {fillStyle: '#558822'}],
            Endpoints: [["Dot", {radius: 7}], ["Dot", {radius: 11}]],
            ConnectionOverlays: [
                ["Arrow", {location: -1,
                        width: 7,
                        length: 7,
                        foldback: 1
                    }],
                ["Label", {
                        location: 0.1,
                        id: "label",
                        cssClass: "aLabel"
                    }]
            ]
        });
//        //========================= danh cho user chi co quyen view========================>
//

		<?php foreach ($forcedrouting as $item) { ?>
					_addEndpoints("ID<?= $item->processnode; ?>", ["<?= $item->forcestar; ?>_v"], []);
					_addEndpoints("ID<?= $item->nextprocessid; ?>", [], ["<?= $item->forceend; ?>_v"]);
					jsPlumb.connect({uuids: ["ID<?= $item->processnode; ?><?= $item->forcestar; ?>_v", "ID<?= $item->nextprocessid; ?><?= $item->forceend; ?>_v"], editable: false});
		<?php } ?>


        $('#editworkflow').click(function() {
			var token = $("#token").val();
            $('#main123').html('<center><img src="<?= url_tmpl() ?>img/preloader.gif"></center>');
			var link = url + control + '/loadWorkFlowEdit' + suffix;
			$.ajax({
				url:link,
				async: true,
				type: 'POST',
				data:{page: 1,csrf_token_gce:token},
				success:function(datas) {
					var obj = $.evalJSON(datas);
					$('#token').val(obj.csrfHash);
					$('#main123').html(obj.content);
					setHeight();
				}
			});
        });
        $('.workflow').mouseenter(function() {
            // alert("manh") ;
            var focus = $('.' + $(this).attr("id"));
            focus.addClass("classfocus");
        });
        $('.workflow').mouseleave(function() {
            var focus = $('.' + $(this).attr("id"));
            focus.removeClass("classfocus");
        });

    });
</script>

<style>
    #main{
		width:auto; 
		position:relative;
		height:600px;
	}
	a:link, a:visited {
		color: #346703;
		outline: medium none;
		text-decoration: none;
		white-space:nowrap !important;
	}

    img.desaturate{ filter: grayscale(100%);
                    -webkit-filter: grayscale(100%);
                    -moz-filter: grayscale(100%);
                    -ms-filter: grayscale(100%); 
                    -o-filter: grayscale(100%);
                    filter: url(<?= url_tmpl() ?>Workflow/desaturate.svg#greyscale); 
                    filter: gray; 
                    -webkit-filter: grayscale(1); }


    .workflow { 
        width:70px;
        height:70px;
        text-align:center;
        z-index:20; 
        position:absolute;
        color:black;
        font-family:helvetica;padding:0.5em;
        font-size:0.9em;
		white-space:nowrap !important;
    }   

    ._jsPlumb_connector { z-index:4; }  

    ._jsPlumb_endpoint, .endpointTargetLabel, .endpointSourceLabel{ z-index:-1;}


    .hl { border:3px solid red; }
    #debug { position:absolute; background-color:black; color:red; z-index:5000 }

    ._jsPlumb_dragging { z-index:4000; }


</style>


<!------------------------------------------------ket thuc user--------------------------------------->





<style>	
<?php
foreach ($process as $item) {
    ?>
        #ID<?= $item->processid; ?> {<?= $item->positionicon; ?>}		    
<?php } ?>    
</style>

<div id="main">	
    <?php 
    foreach ($process as $item){
		if($item->processid == 1){
			$controller = 'receiving?prs=1'; 
		}
		else{
			$controller = 'process?prs='.$item->processid; 
		}
        ?>
        <div class="workflow" id="ID<?= $item->processid; ?>">
		 <?php if(isset($permisison[$item->processid])){?>
		 <a href="<?= base_url().$controller;?>" class="link-1">                
			<img style="max-width: 50px; max-height: 50px" src="<?= base_url() ?>/files/Image/<?= $item->image; ?>"><br/><?= $item->processname; ?>
		 </a>
		 <?php }else{?>
		 <img style="max-width: 50px; max-height: 50px" class="desaturate" src="<?= base_url() ?>/files/Image/<?= $item->image; ?>"><br/><?= $item->processname; ?>  
		 <?php }?>
		</div>
    <?php }/*End for*/ ?>
	
	<?php if($login['grouptype'] < 1){?>
		<div class="pull-right workflow-icon">
			<a href="#" title="Edit" class="btn-edit" id="editworkflow" >
				<img src="<?=url_tmpl();?>img/pen.png" />
			</a>
		</div>
	<?php }?>
</div>
<div style="clear: both;"></div>
