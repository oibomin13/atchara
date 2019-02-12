<?php
  $sess = $this->session->flashdata('err');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- sweetalert -->
	<link rel="stylesheet" href="<?php echo base_url('node_modules/sweetalert2/dist/sweetalert2.min.css'); ?>">
	<!-- Main CSS-->
	<link href="<?php echo base_url('assets/css/main-login.css'); ?>" rel="stylesheet" type="text/css" />
	<!-- Font-icon css-->
	<link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
	<title>Login - eqBorrow</title>
</head>

<body>
	<section class="material-half-bg">
		<div class="cover"></div>
	</section>
	<section class="login-content">
		<div class="logo">
      <h2>ระบบเบิกจ่ายวัสดุหมวดทางหลวงพร้าว</h2>
		</div>
		<div class="login-box">
			<?php echo form_open('auth/login_process', array('class'=>'login-form')); ?>
			<h3 class="login-head">
				<i class="fa fa-lg fa-fw fa-user-circle-o"></i>
				<?php line('login'); ?>
			</h3>
			<div class="form-group">
				<label class="control-label">
					<?php line('usr_username'); ?>
				</label>
        <?php echo form_input(array('name' => 'username', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder'=>'Username')); ?>
			</div>
			<div class="form-group">
				<label class="control-label">
					<?php line('usr_password') ?>
				</label>
				<?php echo form_password(array('name' => 'password', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder'=>'Password')); ?>
			</div>
			<div class="form-group">
				<div class="utility">
					<div class="animated-checkbox">
						<label>
							<input type="checkbox" name="stay_login" value="1">
							<span class="label-text">จดจำรหัสผ่าน
								<!-- <?php echo line('stay_login'); ?> -->
							</span>
						</label>
					</div>
					<p class="semibold-text mb-2">
						<a href="#" data-toggle="flip">
							<?php echo line('forgotpass'); ?>
						</a>
					</p>
				</div>
			</div>
			<div class="form-group btn-container">
				<button class="btn btn-primary btn-block">
					<i class="fa fa-sign-in fa-lg fa-fw"></i>
					<?php line('ok'); ?>
				</button>
			</div>
			</form>
			<form class="forget-form" action="index.html">
				<h3 class="login-head">
					<i class="fa fa-lg fa-fw fa-lock"></i>
					<?php echo line('forgotpass'); ?> ?</h3>
				<div class="form-group">
					<label class="control-label">
						<?php echo line('mem_email'); ?>
					</label>
					<input class="form-control" type="text" placeholder="Email">
				</div>
				<div class="form-group btn-container">
					<button class="btn btn-primary btn-block">
						<i class="fa fa-unlock fa-lg fa-fw"></i>
						<?php echo line('send'); ?>
					</button>
				</div>
				<div class="form-group mt-3">
					<p class="semibold-text mb-0">
						<a href="#" data-toggle="flip">
							<i class="fa fa-angle-left fa-fw"></i>
							<?php echo line('back_to_login'); ?>
						</a>
					</p>
				</div>
				<?php echo form_close(); ?>
		</div>
	</section>
	<!-- Essential javascripts for application to work-->
	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/main-login.js'); ?>"></script>
  <script src="<?php echo base_url('node_modules/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>
	<!-- The javascript plugin to display page loading on top-->
  <script src="<?php echo base_url('assets/js/pace.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

	<script type="text/javascript">
		// Login Page Flipbox control
		$('.login-content [data-toggle="flip"]').click(function () {
			$('.login-box').toggleClass('flipped');
			return false;
    });

    <?php if($sess['type'] == 'login'): ?>
      var msg = '<?php echo $sess['msg']; ?>';
      showBox(msg, 'error');
    <?php endif; ?>

	<?php if($sess['type'] == 'auth'): ?>
      var msg = '<?php echo $sess['msg']; ?>';
      showBox(msg, 'error');
    <?php endif; ?>

	</script>
</body>

</html>
