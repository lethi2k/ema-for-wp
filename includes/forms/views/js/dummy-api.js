(function() {
	window.ema4wp = window.ema4wp || {
		listeners: [],
		forms: {
			on: function(evt, cb) {
				window.ema4wp.listeners.push(
					{
						event   : evt,
						callback: cb
					}
				);
			}
		}
	}
})();
