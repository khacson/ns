<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=url_tmpl();?>css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=url_tmpl();?>font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=url_tmpl();?>theme/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=url_tmpl();?>theme/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <!--<link rel="stylesheet" href="<?=url_tmpl();?>theme/plugins/iCheck/flat/blue.css">-->
  <!-- Morris chart -->
  <!--<link rel="stylesheet" href="<?=url_tmpl();?>theme/plugins/morris/morris.css">-->
  <!-- jvectormap -->
  <!--<link rel="stylesheet" href="<?=url_tmpl();?>theme/plugins/jvectormap/jquery-jvectormap-1.2.2.css">-->
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=url_tmpl();?>theme/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=url_tmpl();?>theme/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=url_tmpl();?>theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?=url_tmpl();?>template.css">
  <link href="<?=url_tmpl();?>toast/toastr.min.css" rel="stylesheet" type="text/css"/>
  <link href="<?=url_tmpl();?>scrollTable/scrollTable.css" rel="stylesheet" type="text/css"/>
  <link href="<?=url_tmpl();?>multipleselect/multiple-select.css" rel="stylesheet" type="text/css"/>
  
  <!-- jQuery 2.2.3 -->
  <script type='text/javascript' src="<?=url_tmpl();?>theme/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script type='text/javascript' src="<?=url_tmpl();?>theme/bootstrap/js/bootstrap.min.js"></script>
  
  <script type='text/javascript' src="<?=url_tmpl();?>js/number.js" ></script>
  <script type='text/javascript' src="<?=url_tmpl();?>js/jquery.json.js" ></script>
  <script type='text/javascript' src="<?=url_tmpl();?>js/colResizable-1.5.min.js" ></script>
 
  <script type='text/javascript' src="<?=url_tmpl();?>toast/toastr.min.js"></script>  
  <script type='text/javascript' src="<?=url_tmpl();?>toast/notifications.js"></script>  
  <script type='text/javascript' src="<?=url_tmpl();?>js/tab.control.js" ></script>
  <script type='text/javascript' src="<?=url_tmpl();?>js/main.js" ></script>
  <script type='text/javascript' src="<?=url_tmpl();?>scrollTable/scrollTable.js" ></script>
  <script type='text/javascript' src="<?=url_tmpl();?>scrollTable/jquery.scrollTo.js" ></script>
  <script type='text/javascript'>
	  var order = '';
	  var index = 'DESC';
	  var mgsError = '<?=getLanguage('loi');?>';
	  var mgs_Msg = '<?=getLanguage('thong-bao');?>';
	  var cfDelete = '<?=getLanguage('xac-nhan-xoa');?>';
	  var cancel = '<?=getLanguage('huy');?>';
	  var deletes = '<?=getLanguage('xoa');?>';
	  var selectAll = '<?=getLanguage('chon-tat-ca');?>';
	  var tmtc = '<?=getLanguage('them-moi-thanh-cong');?>';
	  var tmktc = '<?=getLanguage('them-khong-moi-thanh-cong');?>';
	  var stc = '<?=getLanguage('sua-thanh-cong');?>';
	  var sktc = '<?=getLanguage('sua-khong-thanh-cong');?>';
	  var dldtt = '<?=getLanguage('du-lieu-da-ton-tai');?>';
	  var cldcs = '<?=getLanguage('chon-du-lieu-can-sua');?>';
  </script>
  <script type='text/javascript' src="<?=url_tmpl();?>multipleselect/jquery.multiple.select.js" ></script>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b></span>
      <!-- logo for regular state and mobile devices -->
	  <img class="logo-img" src="<?=url_tmpl();?>img/logo.png" />
      <!--<span class="logo-lg"><b>Nova </b>Shop floor</span>-->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
         <?=$this->load->inc('menuright');?>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
		<?=$this->load->inc('menu');?>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
          <?=$content;?>
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
      <?=$this->load->inc('footer');?>
  </footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
     <?=$this->load->inc('right');?>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery UI 1.11.4 -->
<script type='text/javascript' src="<?=url_tmpl();?>js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script type='text/javascript'>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script type='text/javascript' src="<?=url_tmpl();?>js/moment.min.js"></script>
<script type='text/javascript' src="<?=url_tmpl();?>theme/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script type='text/javascript' src="<?=url_tmpl();?>theme/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Slimscroll -->
<script type='text/javascript' src="<?=url_tmpl();?>theme/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script type='text/javascript' src="<?=url_tmpl();?>theme/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script type='text/javascript' src="<?=url_tmpl();?>theme/dist/js/app.js"></script>
</body>
</html>
