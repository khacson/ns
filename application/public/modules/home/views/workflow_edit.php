<!-- Start danh cho admin Code ----------> 
<style>

    #main{height:600px;position:relative;}
	a:link, a:visited {
		color: #346703;
		outline: medium none;
		text-decoration: none;
		white-space:nowrap !important;
	}
    .workflow { 
        width:70px;
        height:70px;
        text-align:center;
        z-index:20; 
        position:absolute;
        color:black;
        font-family:helvetica;padding:0.5em;
        font-size:0.9em;}
    .active {
		white-space:nowrap !important;
    }
    .hover {
        /*border:1px dotted red;*/
        background: #f00;
    }


    ._jsPlumb_connector { z-index:4; }
    ._jsPlumb_endpoint, .endpointTargetLabel, .endpointSourceLabel{ z-index:21;cursor:pointer; }
    .hl { border:3px solid red; }
    #debug { position:absolute; background-color:black; color:red; z-index:5000 }

    ._jsPlumb_dragging { z-index:4000; }

    .aLabel {
        display: none;
        background-color:white; 
        padding:0.4em; 
        font:12px sans-serif; 
        color:#444;
        z-index:21;
        border:1px dotted gray;
        opacity:0.8;
        filter:alpha(opacity=80);
    }

</style>

<link rel="stylesheet" href="<?= url_tmpl() ?>js/jquery.msgBox/Styles/msgBoxLight.css">
<script type='text/javascript' src="<?= url_tmpl() ?>js/jquery.msgBox/Scripts/jquery.msgBox.js"></script>    
<script type='text/javascript'>
	var msgBoxImagePath = "<?= url_tmpl() ?>js/jquery.msgBox/Images/";
    var $arraypositon = new Array();
    var $arrayforcedrouting = new Array();
    $(function() {
    jsPlumb.importDefaults({
				// default drag options
				DragOptions : { cursor: 'pointer', zIndex:2000 },
				// default to blue at one end and green at the other
				EndpointStyles : [{ fillStyle:'#225588' }, { fillStyle:'#558822' }],
				// blue endpoints 7 px; green endpoints 11.
				Endpoints : [ [ "Dot", {radius:7} ], [ "Dot", { radius:11 } ]],
				// the overlays to decorate each connection with.  note that the label overlay uses a function to generate the label text; in this
				// case it returns the 'labelText' member that we set on each connection in the 'init' method below.
				ConnectionOverlays : [
					[ "Arrow", { location:-5 } ],
					[ "Label", { 
						location:0.1,
						id:"label",
						cssClass:"aLabel"
					}]
				]
			});				


        /////////////////////////////// danh co admin co quyen chinh sua work flow===========================================
        //add endpoint
<?php
foreach ($process as $item) {
    ?>
            _addEndpoints("ID<?= $item->processid; ?>", [], 
				[
				"Vitri1",
                "Vitri2",
                "Vitri3",
                "Vitri4",
                "Vitri5",
                "Vitri6",
                "Vitri7",
                "Vitri8",
                "Vitri9",
                "Vitri10",
                "Vitri11",
                "Vitri12"
				]);

<?php } ?>

        //add start poit cho tất cả icon
<?php
foreach ($process as $item) {
    ?>
            _addEndpoints("ID<?= $item->processid; ?>",
				[
				"Vitri1",
                "Vitri2",
                "Vitri3",
                "Vitri4",
                "Vitri5",
                "Vitri6",
                "Vitri7",
                "Vitri8",
                "Vitri9",
                "Vitri10",
                "Vitri11",
                "Vitri12"
				], []);

<?php } ?>
<?php foreach ($forcedrouting as $item) { ?>
            jsPlumb.connect({uuids: ["ID<?= $item->processnode; ?><?= $item->forcestar; ?>", "ID<?= $item->nextprocessid; ?><?= $item->forceend; ?>"], editable: false});
<?php } ?>
        jsPlumb.draggable(jsPlumb.getSelector(".workflow"), {grid: [1, 1], containment: "#main",
            stop: function() {
                var position = $(this).attr('style');
                var processid = $(this).attr('idprocess');

                var myposition = new Array();
                myposition["processid"] = processid;
                myposition["position"] = position;
                $arraypositon.push(myposition);
            }});


        jsPlumb.bind("click", function(conn) {
			var token = $("#token").val();
            var $star = $('#' + conn.sourceId);
            var $idstar = $star.attr('idprocess');
            var $end = $('#' + conn.targetId);
            var $idend = $end.attr('idprocess');
            var $starpoint = conn.endpoints[0].anchor.type;
            var $endpoint = conn.endpoints[1].anchor.type;
            var length = $arrayforcedrouting.length;
            if (length > 0) {
                //kiem tra xem co trung voi trong list
                for ($i = 0; $i < length; $i++) {
                    if ($arrayforcedrouting[$i]["idstar"] == $idstar && $arrayforcedrouting[$i]["idend"] == $idend
                    && $arrayforcedrouting[$i]["pointstar"] == $starpoint && $arrayforcedrouting[$i]["pointend"] == $endpoint ){                        
                        $arrayforcedrouting.splice($i, 1);
                        //console.log($arrayforcedrouting);
                    }
                }
            }
            $.msgBox({
                title: "Thông báo",
                content:"Xác nhận xóa?",
                type: "confirm",
                buttons: [{value: "Yes"}, {value: "No"}],
                success: function(result) {
                    if (result == "Yes") {
						var link = url + control + '/deleforcedrouting' + suffix;
						$.ajax({
							url:link,
							async: true,
							type: 'POST',
							data:{
								page: 1,
								csrf_token_gce:token,
								idstar: $idstar,
								idend: $idend,
								starpoint:$starpoint,
								endpoint:$endpoint
							},
							success:function(datas) {
								jsPlumb.detach(conn);
								var obj = $.evalJSON(datas);
								//$('#token').val(obj.csrfHash);
								if(obj.status == 1){
									success('Xóa thành công');
								}
								else{
									error('Xóa không thành công');
								}
								
							}
						});
                    }
                }
            });
        });
        jsPlumb.bind("jsPlumbConnection", function(CurrentConnection) {
            var $star = $('#' + CurrentConnection.sourceId);
            var $idstar = $star.attr('idprocess');
            var $end = $('#' + CurrentConnection.targetId);
            var $idend = $end.attr('idprocess');
            var $pointstar = CurrentConnection.sourceEndpoint.anchor.type;
            var $pointend = CurrentConnection.targetEndpoint.anchor.type;
            if ($idend) {
                var myconect = new Array();
                myconect["idstar"] = $idstar;
                myconect["pointstar"] = $pointstar;
                myconect["idend"] = $idend;
                myconect["pointend"] = $pointend;
                $arrayforcedrouting.push(myconect);
            }

        });
        $('#closeeditworkflow').click(function() {
            $('#main123').html('<center><center><img src="<?= url_tmpl() ?>img/preloader.gif"></center></center>');
        });
        $('#saveworkflow').click(function() {
            var token = $("#token").val();
            var length = $arrayforcedrouting.length;
			//console.log($arrayforcedrouting); return false;
            if (length > 0) {              
                $arrayforcedrouting.forEach(function(entry) {
					var link = url + control + '/addforcedrouting' + suffix;
					$.ajax({
						url:link,
						async: true,
						type: 'POST',
						data:{
							page: 1,
							csrf_token_gce:token,
							idstar: entry["idstar"],
							idend: entry["idend"],
							pointstar: entry["pointstar"],
							pointend: entry["pointend"]
						},
						success:function(datas) {
							var obj = $.evalJSON(datas);
							success('Lưu thành công');
							$('#token').val(obj.csrfHash);
						}
					});
                });
            }
            //update list position
            var length1 = $arraypositon.length;
            if (length1 > 0) {             
                $arraypositon.forEach(function(entry1) {
					var link = url + control + '/updateProcess' + suffix;
					$.ajax({
						url:link,
						async: true,
						type: 'POST',
						data:{
							page: 1,
							csrf_token_gce:token,
							processid: entry1['processid'],
							position: entry1['position']
						},
						success:function(datas) {
							var obj = $.evalJSON(datas);
							$('#token').val(obj.csrfHash);
						}
					});
                });
            }
            //clear array
            $arrayforcedrouting = [];
            $arraypositon = [];
           // success('Sửa thành công');
        });
    });
</script>

<!----------------------------------------------------------ket thuc admin-------------------------->


<style>	
<?php
foreach ($process as $item) {
    ?>
        #ID<?= $item->processid; ?> {<?= $item->positionicon; ?>}		    
<?php } ?>



    .workflowsl {
        line-height: 27px;
        height: 27px;
        padding: 0 0 0 5px;
        position: relative;
        overflow: hidden;
        width: 80px !important; }   
    </style>
    <div id="main">	

    <?php
    foreach ($process as $item) {
        ?>
        <div  class="workflow" id="ID<?= $item->processid; ?>" idprocess="<?= $item->processid; ?>">           
            <img style="max-width: 50px; max-height: 50px" src="<?= base_url() ?>/files/Image/<?= $item->image; ?>"><br/><?= $item->processname; ?>

        </div>
    <?php } ?>
    <div class="pull-right workflow-icon">        
        <a href="<?= base_url() ?>home.html" title="Close" class="btn-delete" id="closeeditworkflow">
			<img src="<?=url_tmpl();?>img/close.png" />
		</a>
        <a href="#" title="Save" class="btn-save" id="saveworkflow">
			<img src="<?=url_tmpl();?>img/save.png" />
		</a>
    </div>
</div>
