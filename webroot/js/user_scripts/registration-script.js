var registrationPage = (function ($, toastr, undefined) {
	var notification = notificationHelper,
		validator = validationHelper,
		private = {
			setEvent: function () {
				$('#register-btn').on("click", function(e) {
					var hasError = private.validateEntries();

					if(!hasError) {
						$('#registration-form').submit();
					}
				})
			},
			validateEntries: function() {
				var password = $.trim($('#password').val()),
					validatePassword = $.trim($('#retypepassword').val()),
					hasError = false,
					message = "";
					
				if(validator.IsEmpty({Id: 'first-name'})) {
					hasError = true;
					$('#first-name').addClass("has-error");
					message += "First Name is Required.<br>";
				}

				if(validator.IsEmpty({Id: 'last-name'})) {
					hasError = true;
					message += "Last Name is Required.<br>";
				}

				if(validator.IsEmpty({Id: 'email'})) {
					hasError = true;
					message += "Email is Required.<br>";
				} else if(!validator.IsValidEmail({Id: 'email'})) {
					hasError = true;
					message += "Invalid Email.<br>";
				}

				if(validator.IsEmpty({Id: 'password'})) {
					hasError = true;
					message += "Password is Required.<br>";
				}

				if(password !== validatePassword) {
					hasError = true;
					message += "Password mismatch.<br>";
				}

				if(!$('#chk-agree').is(":checked")) {
					hasError = true;
					message += "Please accept the terms.<br>";
				}

				if(hasError) {
					notification.showError({msg: message, title: "Invalid Entry"});
				}

				return hasError;
			}
		},
		public = {
			onLoad: function() {
				private.setEvent();
			}
		};

	return public;
})(jQuery, toastr);

$(document).ready(function(){
	var registration = registrationPage;

	registration.onLoad();
});