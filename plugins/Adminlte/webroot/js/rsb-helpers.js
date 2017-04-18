var notificationHelper = (function ($, toastr, undefined) {
	var _jqExtend = $.extend,
		private = {
			showNotification: function (params) {
				params = params || {};
				toastr.remove();

				if(typeof(params.title) === 'undefined') {
					toastr[params.method](params.msg);
				} else {
					toastr[params.method](params.msg, params.title);
				}
			}
		},
		public = {
			removeAll: function () {
				toastr.remove();
			},
			showError: function (params) {
				params = params || {};

				_jqExtend(params, {
					method: "error"
				});

				private.showNotification(params);
			},
			showInformation: function (params) {
				params = params || {};

				_jqExtend(params, {
					method: "info"
				});

				private.showNotification(params);
			},
			showSuccess: function (params) {
				params = params || {};

				_jqExtend(params, {
					method: "success"
				});

				private.showNotification(params);
			},
			showWarning: function (params) {
				params = params || {};

				_jqExtend(params, {
					method: "warning"
				});

				private.showNotification(params);
			}
		};

	return public;
})(jQuery, toastr);

var validationHelper = (function($, undefined) {
	var emailRegEx = "^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$",
		urlRegEx = "/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/",
		private = {
			validateRegEx: function(param) {
                var object = private.setObject(param),
                	pattern = new RegExp(param.regExp);

                return pattern.test(object.val());
			},
			setObject: function(param) {
				var input = param || {},
                	objectId = "#" + input.Id,
					objectClass = "." + input.Class,
					object = input.object;

				if(typeof(object) === "undefined") {
					if(objectId !== "#") {
						object = $(objectId);
					} else {
						object = $(objectClass);
					}
				}

				return object;
			}
		},
		public = {
			IsEmpty: function(param) {
                var object = private.setObject(param),
					validationMessage = param.validationMessage,
					isEmpty = false;

				$.each(object, function(){
					if($.trim($(this).val()).length === 0) {
						isEmpty = true;
					}
				});
				return isEmpty;
			},
			IsValidEmail: function(param) {
				param.regExp = emailRegEx;
				return private.validateRegEx(param);
			}
		}

	return public;
})(jQuery);