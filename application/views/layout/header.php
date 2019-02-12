<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>eqBorrow <?php echo !empty($main_title) ? '-'.$main_title : ''; ?></title>
	<meta name="description" content="ระบบเบิกจ่ายวัสดุหมวดทางหลวงพร้าว">
	<meta name="author" content="eqBorrow - ">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">

	<!-- Switchery css -->
	<link href="<?php echo base_url('assets/plugins/switchery/switchery.min.css'); ?>" rel="stylesheet" />

	<!-- Bootstrap CSS -->
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />

	<!-- Font Awesome CSS -->
	<link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />

	<!-- Datatables component -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css'); ?>">
	<!-- icheck -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck/skins/flat/flat.css'); ?>">
	<!-- toast message -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/jquery-toast/dist/jquery.toast.min.css'); ?>">
	<!-- daterangpicker -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datetimepicker/css/daterangepicker.css'); ?>">
	<!-- select2 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('node_modules/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-select/css/bootstrap-select.css'); ?>">
	<!-- sweetalert -->
	<link rel="stylesheet" href="<?php echo base_url('node_modules/sweetalert2/dist/sweetalert2.min.css'); ?>">

	<!-- Custom CSS -->
	<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet" type="text/css" />

	<!-- BEGIN CSS for this page -->

	<!-- END CSS for this page -->
	<script>
		var gUrl = '<?php echo site_url(); ?>';
		var gModal = false;
		var gClass = '<?php echo $this->router->fetch_class(); ?>';
		var gEdit = '<?php line('edit'); ?>';
		var gApprove = '<?php line('approve'); ?>';
		var gDelete = '<?php line('delete'); ?>';
		var gApiKey = '<?php echo get_key(); ?>';
	</script>

</head>

<body class="adminbody">

	<div id="main">

		<!-- top bar navigation -->
		<div class="headerbar">

			<!-- LOGO -->
			<div class="headerbar-left">
				<a href="<?php echo site_url(); ?>" class="logo">
					<img alt="logo" src="<?php echo base_url('assets/images/3.png'); ?>" />
					<span></span>
				</a>
			</div>

			<nav class="navbar-custom">

				<ul class="list-inline float-right mb-0">

					<li class="list-inline-item dropdown notif">
						<a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
							<img src="<?php echo base_url('assets/images/2.png'); ?>" alt="Profile image" class="avatar-rounded">
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-dropdown">
							<!-- item-->
							<div class="dropdown-item noti-title">
								<h5 class="text-overflow">
									<small> <?php echo get_username(); ?></small>
								</h5>
							</div>

							<!-- item-->
							<a href="<?php echo site_url('user/main_form/'.get_user_id()); ?>" data-toggle="modal" data-target="#ajaxModal" class="dropdown-item notify-item">
								<i class="fa fa-user"></i>
								<span>แก้ไขข้อมูล</span>
							</a>

							<!-- item-->
							<a href="<?php echo site_url('auth/logout'); ?>" class="dropdown-item notify-item">
								<i class="fa fa-power-off"></i>
								<span>ออกจากระบบ</span>
							</a>
						</div>
					</li>

				</ul>

				<ul class="list-inline menu-left mb-0">
					<li class="float-left">
						<button class="button-menu-mobile open-left">
							<i class="fa fa-fw fa-bars"></i>
						</button>
					</li>
				</ul>

			</nav>

		</div>
		<!-- End Navigation -->


		<!-- Left Sidebar -->
		<div class="left main-sidebar">

			<div class="sidebar-inner leftscroll">
				<div class="app-sidebar__user"><img class="app-sidebar__user-avatar sidebar__user-avatar" src="<?php echo base_url('assets/images/2.png'); ?>" alt="User Image">
					<div>
					<p class="app-sidebar__user-name"><?php echo get_user_fullname(); ?></p>
					<p class="app-sidebar__user-designation"><?php echo get_usertype(); ?></p>
					</div>
				</div>
				<div id="sidebar-menu">

					<ul>
						<li class="submenu">
							<a href="<?php echo site_url(); ?>">
								<i class="fa fa-fw fa-home"></i>
								<span>
									<?php line('menu_dashboard');?> </span>
							</a>
						</li>
						<?php if(get_usertype()==='ADMIN'): ?>
						<li class="submenu">
							<a href="<?php echo site_url('category'); ?>">
								<i class="fa fa-th-large"></i>
								<span>
									<?php line('menu_category');?> </span>
							</a>
						</li>
						<li class="submenu">
							<a href="<?php echo site_url('product'); ?>">
								<i class="fa fa-fw fa-cubes"></i>
								<span>
									<?php line('menu_product');?> </span>
							</a>
						</li>
						<li class="submenu">
							<a href="<?php echo site_url('department'); ?>">
								<i class="fa fa-fw fa-server"></i>
								<span>
									<?php line('menu_department');?> </span>
							</a>
						</li>
						<li class="submenu">
							<a href="<?php echo site_url('membertype'); ?>">
								<i class="fa fa-fw fa-universal-access "></i>
								<span>
									<?php line('menu_membertype');?> </span>
							</a>
						</li>
						<li class="submenu">
							<a href="<?php echo site_url('member'); ?>">
								<i class="fa fa-fw fa-vcard"></i>
								<span>
									<?php line('menu_member');?> </span>
							</a>
						</li>
						<li class="submenu">
							<a href="<?php echo site_url('user'); ?>">
								<i class="fa fa-fw fa-user"></i>
								<span>
									<?php line('menu_user');?> </span>
							</a>
						</li>
						<?php endif; ?>
						<li class="submenu">
							<a href="<?php echo site_url('borrow'); ?>">
								<i class="fa fa-fw fa-random"></i>
								<span>
									<?php line('menu_borrow');?> </span>
									<?php
										if($utype == 'ADMIN'){
											echo '<span class="badge badge-pill badge-danger">'.$count_not_approve.'</span>';											
										}
									?>									
							</a>
						</li>
						<li class="submenu">
							<a href="<?php echo site_url('report/stock'); ?>">
								<i class="fa fa-file-text-o"></i>
								<span>
									<?php line('menu_rpt_stock');?> </span>
							</a>
						</li>
						<li class="submenu">
							<a href="<?php echo site_url('report/borrow'); ?>">
								<i class="fa fa-indent"></i>
								<span>
									<?php line('menu_rpt_borrow');?> </span>
							</a>
						</li>
					</ul>

					<div class="clearfix"></div>

				</div>

				<div class="clearfix"></div>

			</div>

		</div>
		<!-- End Sidebar -->


		<div class="content-page">

			<!-- Start content -->
			<div class="content">

				<div class="container-fluid">


					<div class="row">
						<div class="col-xl-12">
							<div class="breadcrumb-holder">
								<h1 class="main-title float-left"><?php echo !empty($main_title) ? $main_title : ''; ?></h1>
								<ol class="breadcrumb float-right">
									<li class="breadcrumb-item">&nbsp;</li>
								</ol>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<!-- end row -->