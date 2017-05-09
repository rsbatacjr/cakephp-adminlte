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

var dialogHelper = (function($, undefined) {
	var modal =
		"<div class='modal fade' id='{{id}}' tabindex='-1' role='dialog' aria-labelledby='editorLabel' data-mode='new'>" +
			"<div class='modal-dialog' role='document'>" +
				"<div class='modal-content' style='height:{{height}}'>" +
					"<div class='modal-header'>" +
						"<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" +
							"<span aria-hidden='true'>x</span>" +
						"</button>" +
						"<strong id='title'></strong>" +
					"</div>" +
					"<div class='modal-body'><div class='col-xs-12'>{{content}}</div></div>" +
				"</div>" +
			"</div>" +
		"</div>",
		private = {

		},
		public = {
			AddDialog: function(options) {
				options.content = 
					"<div class='row'>" +
						"<button type='button' class='sm-btn btn-primary btn-save'>Save &amp; New</button> <button type='button' class='sm-btn btn-primary btn-save-close'>Save &amp; Close</button>" +
					"</div><br/>" + 
					options.content;

				modal = modal.replace('{{id}}', options.id);
				modal = modal.replace('{{height}}', options.height + "px");
				modal = modal.replace('{{content}}', options.content);

				$('body').append(modal);

				$('#' + options.id).find('.btn-save').on('click', function(e) {
					options.saveMethod();
				});

				$('#' + options.id).find('.btn-save-close').on('click', function(e) {
					options.saveMethod();
					$('#' + options.id).modal('hide');
				});
			}
		}

	return public;
})(jQuery);