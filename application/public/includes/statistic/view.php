<script type="text/javascript">
    var url = '<?= base_url() ?>';   
    $(function() {
	   $('#viewstatic').html('Please click refresh <br>button to show data');       	
       $('.btn-refresh').click(function() {
            $('#viewstatic').html('<center><img src="<?= url_tmpl() ?>img/icon_loading.gif"></center>');
            loadstatictis();
       });
    });
	function loadstatictis(){
		var linkWorkflow = url + 'loadstatic/getData';
		var token = $("#token").val();
		$.ajax({
			url:linkWorkflow,
			async: true,
			type: 'POST',
			data:{page: 1, csrf_token_gce:token},
			success:function(datas) {
				var ojb = $.evalJSON(datas);
			$('#viewstatic').html(ojb.html);   
			}
		});
	}
</script>


﻿<div class="fixie job-control">
    <div id="control" class="title fixie">Statistics <span class="ico ico-show"></span></div>
    <div class="content box">
        <div class="job-content">
            <dl class="job-counter clearfix" id="viewstatic" style="padding-top: 15px">                
            </dl>
            <p class="clearfix"><a href="javascript:;" class="btn-refresh" title="Refresh">Refresh</a></p>
        </div>
    </div>
</div>
<input autocomplete="off" type="hidden" name="<?=$csrfName;?>" id="token" value="<?=$csrfHash;?>" />












<!--
<dl class="job-counter clearfix">
                <dt><strong>Receiving</strong><span id="static_total">10,000</span></dt>
                <dt><strong>Input QC</strong><span>6789</span></dt>
                <dt><strong>Disassembly</strong><span>200</span></dt>
                <dt><strong>Function Test</strong><span>100</span></dt>
                <dd><strong>Passed</strong><span>50</span></dd>
                <dd><strong>Failed</strong><span>30</span></dd>
                <dd class="last"><strong>WIP</strong><span>20</span></dd>
                <dt><strong>Repair</strong><span>100</span></dt>
                <dd><strong>Passed</strong><span>50</span></dd>
                <dd><strong>Failed</strong><span>30</span></dd>
                <dd class="last"><strong>WIP</strong><span>20</span></dd>
                <dt><strong>Swap/ Assembly</strong><span>100</span></dt>
                <dd><strong>Passed</strong><span>50</span></dd>
                <dd><strong>Failed</strong><span>30</span></dd>
                <dd class="last"><strong>WIP</strong><span>20</span></dd>
                <dt><strong>QC</strong><span>100</span></dt>
                <dd><strong>Passed</strong><span>50</span></dd>
                <dd><strong>Failed</strong><span>30</span></dd>
                <dd class="last"><strong>WIP</strong><span>20</span></dd>
                <dt><strong>FGI</strong><span>9</span></dt>
                <dt><strong>Failed Stock</strong><span>3</span></dt>
            </dl>-->