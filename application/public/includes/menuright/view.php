<!--<link href="<?=url_tmpl();?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>-->
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle navigation</span></a>
	<div class="navbar-custom-menu fleft" style="width:300px;">
		
	</div>
    <div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
		  <li class="dropdown messages-menu" title="Số phiếu chờ chuyển">
				<a  href="#" class="dropdown-toggle">
				  <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
				  <span id="idchuachuyen" class="label label-success">0</span>
				</a>
		  </li>
		  <li class="dropdown messages-menu" title="<?=getLanguage('hien-co');?>">
				<a  href="#" class="dropdown-toggle">
				  <i class="fa fa-folder-open-o"></i>
				  <span id="idhienco" class="label label-success">0</span>
				</a>
		  </li>
          <li class="dropdown messages-menu">	
			<!--data-toggle="dropdown"-->
            <a  title="<?=getLanguage('chua-nhan');?>"  href="#" class="dropdown-toggle" >
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success" id="countaccept">0</span>
            </a>
            <ul class="dropdown-menu">
              <li id="idchuanhan" class="header"></li>
              <li class="footer"><!--<a href="#">See All Messages</a>--></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url();?>files/user/<?=$avatar;?>" class="user-image" alt="">
              <span class="hidden-xs"><?=$fullname;?>(<?=$groupname;?>)</span>
            </a>
            <ul class="dropdown-menu">
              <!-- Menu Footer-->
			  <li class="">
                  <a href="<?=base_url()?>profile.html" class=""><?=getLanguage('ho-so');?></a>
			  </li>
              <li class="">
                  <a href="<?=base_url()?>authorize/logout.html" class=""><?=getLanguage('thoat');?></a>
              </li>
            </ul>
          </li>
        </ul>
	</div>
	<a id="idpopup" href="#" data-toggle="modal" data-target="#myModalInfo"></a>
	<style>
		#addicon_iconsearch {
			color: #05c5ee;
			position: absolute;
			right: 8px;
			top: 15px;
		}
		.nav-tabs-info li a{
			background:#fafafa;
			color:#333 !important;
			margin-bottom:2px;
		}
	</style>
	<script>
		$(function(){
			
		});
	</script>
	