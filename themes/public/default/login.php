<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?=$title;?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=url_tmpl();?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=url_tmpl();?>login/css/style.css">
  <link rel="stylesheet" href="<?= url_tmpl(); ?>css/roboto.css">
  <link rel="stylesheet" href="<?= url_tmpl(); ?>css/font.css">
  <link href="<?=url_tmpl();?>css/font-awesome.min.css" rel="stylesheet">
  <script type='text/javascript' src="<?=url_tmpl();?>js/jquery113.min.js"></script>
  <script type='text/javascript' src="<?=url_tmpl();?>js/jquery.json.js"></script>
  <script>
	  var order = '';
	  var index = 'DESC';
	  var mgsError = 'Lỗi';
	  var mgs_Msg = 'Thông báo';
	  var cfDelete = 'Xác nhận xóa';
	  var cancel = 'Hủy';
	  var deletes = 'Xóa';
	  var selectAll = 'Chọn tất cả';
  </script>
</head>
<body>
	<?=$content;?>
	<script type='text/javascript' src="<?= url_tmpl(); ?>js/bootstrap.min.js"></script>
</body>
</html>
