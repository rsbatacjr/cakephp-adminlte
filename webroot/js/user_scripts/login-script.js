var loginPage = (function($, toastr, undefined) {
	var notification = notificationHelper,
		private = {
			setEvents: function() {
				
			},
			validateEntries: function(){
				
			}
		},
		public = {
			onLoad: function() {
				private.setEvents();
			}
		}

	return public;
})(jQuery, toastr);

$(document).ready(function(){
	var login = loginPage;

	registration.onLoad();
});