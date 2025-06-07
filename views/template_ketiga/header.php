<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home-Care | <?=$judul?></title>
	  <!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
    <link rel="icon" href="<?php echo base_url('assets/front/img/favicon.png');?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/bootstrap.min.css');?>">
    <!-- animate CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/animate.css');?>">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/owl.carousel.min.css');?>">
    <!-- themify CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/themify-icons.css');?>">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/flaticon.css');?>">
    <!-- magnific popup CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/magnific-popup.css');?>">
    <!-- nice select CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/nice-select.css');?>">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/slick.css');?>">
    <!-- style CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/style.css');?>">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<?php 
if(isset($css_files)){
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach;
}
 ?>
<script>
if (typeof $ == 'undefined') {
   var $ = jQuery;
}
</script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>