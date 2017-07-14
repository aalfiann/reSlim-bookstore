	<!-- LazySizes -->
	<script src="assets/js/lazysizes.min.js" async=""></script>
	
	<!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.min.js"></script>

	<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.min.js"></script>

	<!-- Export -->
	<script type="text/javascript" src="assets/js/package.export.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
	<script>$("head").append("<link rel='stylesheet' type='text/css' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css' /><style>.ui-autocomplete{max-height:200px;overflow-y:auto;overflow-x:hidden}* html .ui-autocomplete{height:200px} .ui-autocomplete-loading { background:url('assets/img/ajax-loader.gif') no-repeat right center }</style><style>.lazyload {opacity: 0;} .lazyloading {opacity: 1;transition: opacity 300ms;background: #f7f7f7 url(assets/img/blank.gif) no-repeat center;} .sidebar .nav > li.active-bottom{position:fixed;width:100%;bottom:10px;} .sidebar .nav > li.active-bottom a{background:rgba(255,255,255,0.14);opacity:1;color:#FFFFFF;}</style><style>.modal{overflow:auto;min-height:100%;position:absolute;background-color:#000000;opacity:0.95 !important;} body.modal-open .main-panel{overflow:hidden !important;}</style>");</script>
	<script type="text/javascript">
    $(function(){
        $("#firstdate").datepicker({
            dateFormat:"yy-mm-dd"
        }),
        $("#lastdate").datepicker({
            dateFormat:"yy-mm-dd"
        }),
		$('#email-input').on('change', function() {
			$.ajax({
				url: "<?php echo Core::getInstance()->api?>/user/validasi/email/"+$('#email-input').val(),
				data: {'email' : $('#email-input').val()},
				dataType: 'json',
				success: function(data) {
					if(data.result) {
						var div = document.getElementById('email-info');
						div.innerHTML = '<p class="text-danger">Info: <?php echo Core::lang('validation_email_fail')?></p>';
					}
					else {
						var emailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
						var x = $('#email-input').val();
						if (emailRegex.test(x) == false) {
							var div = document.getElementById('email-info');
							div.innerHTML = '<p class="text-danger">Info: <?php echo Core::lang('validation_email_letter_fail')?></p>';
						} else {
							var div = document.getElementById('email-info');
							div.innerHTML = '<p class="text-success">Info: <?php echo Core::lang('validation_email_ok')?></p>';
						}
					}
				},
				error: function(data){
					//error
				}
			});
		}),
		$('#username-input').on('change', function() {
			$.ajax({
				url: "<?php echo Core::getInstance()->api?>/user/validasi/username/"+$('#username-input').val(),
				data: {'username' : $('#username-input').val()},
				dataType: 'json',
				success: function(data) {
					if(data.result) {
						var div = document.getElementById('username-info');
						div.innerHTML = '<p class="text-danger">Info: <?php echo Core::lang('validation_username_fail')?></p>';
					}
					else {
						var usernameRegex = /^[a-zA-Z0-9]+$/;
						var x = $('#username-input').val();
						if (usernameRegex.test(x) == false) {
							var div = document.getElementById('username-info');
							div.innerHTML = '<p class="text-danger">Info: <?php echo Core::lang('validation_username_letter_fail')?></p>';
						} else {
							var div = document.getElementById('username-info');
							div.innerHTML = '<p class="text-success">Info: <?php echo Core::lang('validation_username_ok')?></p>';
						}
					}
				},
				error: function(data){
					//error
				}
			});
		}),
		$('#password1-input').on('change', function() {
			var a = $('#password1-input').val();
			var b = $('#password2-input').val();
			if (a != b) {
				var div = document.getElementById('password-info');
				div.innerHTML = '<p class="text-danger">Info: <?php echo Core::lang('validation_password_fail')?></p>';
			} else {
				var div = document.getElementById('password-info');
				div.innerHTML = '<p class="text-success">Info: <?php echo Core::lang('validation_password_ok')?></p>';
			}
		}),
		$('#password2-input').on('keyup', function() {
			var a = $('#password1-input').val();
			var b = $('#password2-input').val();
			if (b) {
				if (a != b) {
					var div = document.getElementById('password-info');
					div.innerHTML = '<p class="text-danger">Info: <?php echo Core::lang('validation_password_fail')?></p>';
				} else {
					var div = document.getElementById('password-info');
					div.innerHTML = '<p class="text-success">Info: <?php echo Core::lang('validation_password_ok')?></p>';
				}
			} else {
				var div = document.getElementById('password-info');
				div.innerHTML = '<p class="text-danger">Info: <?php echo Core::lang('validation_password_fail')?></p>';
			}
		}),
		$('#key-input').on('keyup', function() {
			var a = parseInt($('#aaa-input').val());
			var b = parseInt($('#bbb-input').val());
			var c = parseInt($('#key-input').val());
			var z = a + b;
			if (z != c) {
				var div = document.getElementById('key-info');
				div.innerHTML = '<p class="text-danger">Info: <?php echo Core::lang('validation_key_fail')?></p>';
			} else {
				var div = document.getElementById('key-info');
				div.innerHTML = '<p class="text-success">Info: <?php echo Core::lang('validation_key_ok')?></p>';
			}
		}),
		$('#number-input').on('keyup', function() {
			var x = $('#number-input').val();
			if (x) {
				if (isNaN(x)) {
					var div = document.getElementById('number-info');
					div.innerHTML = '<p class="text-danger">Info: <?php echo Core::lang('validation_number_fail')?></p>';
				} else {
					var div = document.getElementById('number-info');
					div.innerHTML = '<p class="text-success">Info: <?php echo Core::lang('validation_number_ok')?></p>';
				}
			} else {
				var div = document.getElementById('number-info');
				div.innerHTML = '<p class="text-danger">Info: <?php echo Core::lang('validation_number_fail')?></p>';
			}
		}),
		$('#formUpload').submit(function() {
			$.ajax({
				url : $(this).attr("action"),
				type: "POST",
				data : new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				xhr: function(){
					//upload Progress
					var xhr = $.ajaxSettings.xhr();
					if (xhr.upload) {
						xhr.upload.addEventListener('progress', function(event) {
							var percent = 0;
							var position = event.loaded || event.position;
							var total = event.total;
							if (event.lengthComputable) {
								percent = Math.ceil(position / total * 100);
							}
							/*update progressbar for jQuery UI
							$('#statusprogress').text(percent +"%");
							$( '#progressbar' ).progressbar({
								value: percent
							});*/
							//update progressbar for Twitter Bootstrap
							$('#statusprogress').text(percent +"%");
							$('#progressbar').css('width', percent+'%').attr('aria-valuenow', percent); 
						}, true);
					}
					return xhr;
				},
				mimeType:"multipart/form-data"
			}).done(function(res){ //
				//$(my_form_id)[0].reset(); //reset form
				//$(result_output).html(res); //output response from server
				//submit_btn.val("Upload").prop( "disabled", false); //enable submit button once ajax is done
			});
		});
    });
	</script>
	<?php include 'analytics.php';?>