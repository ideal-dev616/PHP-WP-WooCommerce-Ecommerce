(function($) {

	var liquidImporter = function(id, options) {
		var $this = this;

		// Id import
		$this.id = id;
		// list type import
		$this.options = options;


		this.init = function() {

			var self = this,
			message,
			start = $('#lqd-popup'),
			actions = this.options.slice();
			start.hide();
			$('#liquid-import-emoj').hide();

			//start.after(_.template($('#tmpl-demo-import-modules').html())({ modules: this.options }));
			start.hide();

			$(document.body).append(_.template($('#tmpl-demo-import-modules').html())({ modules: this.options }));
			
			//alert( $('.import-id').attr('data-import-id') );
			
			var data = new FormData();

			data.append('action', 'ocdi_import_demo_data');
			//data.append( 'security', boo.ajax_nonce );
			data.append('selected', 2);
			data.append('selections', options);
			runImport($this.options, $this.id);

			//ajaxCall( data );

		};

		this.init();

	};

	$.fn.getParameterByName = function(name, url) {
		if (!url) url = window.location.href;
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	}

	function runImport(options, id) {
		var count = 0;
		console.log(options);
		ajaxRun('liquid_' + options[options.length - options.length], options, id, function() {
			count++;
			ajaxRun('liquid_' + options[count], options, id, function() {
				count++;
				ajaxRun('liquid_' + options[count], options, id, function() {
					count++;
					ajaxRun('liquid_' + options[count], options, id, function() {
						count++;
						ajaxRun('liquid_' + options[count], options, id, function() {
							count++;
							ajaxRun('liquid_' + options[count], options, id);
						});
					});
				});
			})
		});
	}

	function getImportedPosts() {
		var total, imported, precent, newtotal, newtotal1;
		$.ajax({
			url: ajaxurl,
			type: 'GET',
			data: {
				action: 'liquid_total_imported',
			},
		}).done(function(resp) {
			total = parseInt(resp.match(/(?:(?!\|).)*/i)[0]);
			if (resp.indexOf('|')) {
				newtotal = resp.substring(0, resp.indexOf('|'));
				newtotal1 = resp.replace(newtotal, '');
			} else {
				newtotal1 = total;
			}
			if (newtotal1.match(/(\d+)(?!.*\d)/i)) {
				imported = parseInt(newtotal1.match(/(\d+)(?!.*\d)/i)[0]);
				precent = parseInt((imported * 100) / total);
			} else {
				precent = parseInt('100');
			}

			$('#lqd-loader').parent().css('width', precent - 1 + '%');
			$('#lqd-loader').text(precent - 1 + '%');
			return false;
		});
		return false;

	}

	function getProgress() {
		$.ajax({
			url: ajaxurl,
			type: 'GET',
			data: {
				action: 'liquid_progress_imported',
			},
		}).done(function(resp) {
			$('#liquid-progress').text(resp);
			return false;
		});
		return false;
	}

	function ajaxRun(action, options, demo, callback) {
		var ajaxupdater, ajaxprogress;
		ajaxupdater = setInterval(getImportedPosts, 5000);

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: action,
				demo: demo,
				content: ($('#lqd-imp-all').is(':checked') ? 1 : 0),
				media: ($('#lqd-imp-media').is(':checked') ? 1 : 0)
			},
			beforeSend: function(jq) {
				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
						action: 'liquid_reset_logs',
					},
				})
				ajaxprogress = setInterval(getProgress, 5000);
			},
			success: function(d) {

			},
			complete: function() {

				if (typeof callback === 'function' && !action.match('undefined')) {
					callback();
				}
				clearInterval(ajaxupdater);
				clearInterval(ajaxprogress);
			},
		}).done(function(r) {
			console.log(r)
			if ('liquid_' + options[options.length - 1] === action) {
				clearInterval(ajaxupdater);
				clearInterval(ajaxprogress);
				var popup = $('#liquid-popup');
				$('#lqd-loader').parent().css('min-width', '100%');
				$('#lqd-loader').text("100%");
				setTimeout(function() {
					$('#liquid-import-emoj').show();
					$('#lqd-progress-popup').hide();
					$('#liquid-progress').hide();
					setTimeout(function() { popup.remove(); }, 10000);

				}, 800)
				return false;
			}
		});
	}

	function ajaxCall(data) {

		$.ajax({
			method: 'POST',
			url: ajaxurl,
			data: data,
			contentType: false,
			processData: false,
		})
		.done(function(response) {
			if ('undefined' !== typeof response.status && 'newAJAX' === response.status) {
				ajaxCall(data);

			} else if ('undefined' !== typeof response.status && 'customizerAJAX' === response.status) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append('action', 'ocdi_import_customizer_data');
				//newData.append( 'security', ocdi.ajax_nonce );

				// Set the wp_customize=on only if the plugin filter is set to true.
				//if ( true === ocdi.wp_customize_on ) {
				newData.append('wp_customize', 'on');

				//}

				ajaxCall(newData);
			} else if ('undefined' !== typeof response.status && 'afterAllImportAJAX' === response.status) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append('action', 'ocdi_after_import_data');

				//newData.append( 'security', ocdi.ajax_nonce );
				ajaxCall(newData);

			} else if ('undefined' !== typeof response.message) {
				var popup = $('#liquid-popup');
				setTimeout(function() { popup.remove(); }, 10000);
			} else {
				var popup = $('#liquid-popup');
				setTimeout(function() { popup.remove(); }, 10000);
			}
		})
		.fail(function(error) {
			var popup = $('#liquid-popup');
			setTimeout(function() { popup.remove(); }, 10000);
		});
	}

	function reset_wp(callback) {
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'liquid_reset_wp'
			},
			beforeSend: function() {
				$('#liquid-demo-loader').addClass('is-active');

			}
		}).done(function(re) {
			console.log(re);
			$('#liquid-demo-loader').removeClass('is-active');
			if (typeof callback === 'function') {
				callback();
			}
		});
	}

	function reset_confirm_message(callback) {
		if (typeof callback === 'function') {
			callback();
		}
}

function initPopUp(demo) {

	// Popup
	var popup = $('#lqd-popup');

	// CLose
	popup.on('click', '.lqd-imp-popup-close', function() {
		popup.remove();
	});

	popup.on('click', '.agree', function() {

		var $this = $(this),
		parent = $this.parent();

		$this.is(':checked') ? parent.addClass('checked') : parent.removeClass('checked')

	})

	// Import Now
	popup.on('click', '.lqd-import-btn', function() {
		var btn = $(this);

/*
		if (!btn.prev().children('input').is(':checked')) {
			var agreeBox = btn.prev();

			agreeBox.removeClass('liquid-shake error');

			setTimeout(function() {
				agreeBox.addClass('liquid-shake error');
			}, 50)

			return;
		}
*/

		var options = [];

		btn.parent().parent().find('#lqd-import-opts .lqd-imp-opt :checked').each(function() {
			options.push($(this).val());
		});

		var importer = new liquidImporter(demo, options, demo);
	});
}
var liquidAdmin = {

	init: function() {
		this.oneCollectionLazyLoad();
		this.initTabs();
		this.initDemo();
		this.initIconpicker();
	},

	initDemo: function() {

		$('.lqd-solid-wrap').on('click', '.lqd-import-popup', function() {
			//exit if we found any error message
			if ($('.liquid-error-message').length) {
				return;
			}
			var id = $(this).data('demo-id'),

			demo = liquid_demos[id];
			var demo_id = $(this).attr('data-import-id');

			$.ajax({
				url: ajaxurl,
				type: 'GET',
				data: {
					action: 'liquid_prepare_demo_package',
					demo: id
				},
				beforeSend: function() {
					$('#liquid-demo-loader').addClass('is-active');

				}
			}).done(function(resp) {
				var jsonresp = JSON.parse(resp);
				console.log(jsonresp);
				if (jsonresp.stat === 1) {
					$.ajax({
						url: ajaxurl,
						type: 'POST',
						data: {
							action: 'liquid_require_plugins',
							demo: id
						},
					}).done(function(re) {
						console.log(re);
						$('#liquid-demo-loader').removeClass('is-active');
						ret = JSON.parse(re);
						if (ret.stat == 1) {
							$(document.body).append(_.template($('#tmpl-demo-popup').html())(demo));
							initPopUp(id);

						} else if (ret.stat == 0) {
							message = message = "Please install/activate <strong>" + ret.plugins.toString() + "</strong>";
							reset_confirm_message(function() {
								$.confirm({
									title: 'Missing Required Plugins',
									content: message,
									buttons: {
										confirm: {
											text: 'I understand, let\'s import, please',
											btnClass: 'btn-blue',
											keys: ['enter', 'shift'],
											action: function() {
												$(document.body).append(_.template($('#tmpl-demo-popup').html())(demo));
												initPopUp(id);
											}
										},
										cancel: function() {

										}
									}
								});
							})

						}
					})
				} else {
					$('#liquid-demo-loader').removeClass('is-active');
					var $title = 'Error:';
					var $content = 'Please, Activate Ave Core plugin';
					if( ( jsonresp.stat === 0 ) && ( jsonresp.message != null ) ) {
						$title = 'Error';
						$content = jsonresp.message;
					}
					$.confirm({
						title: $title,
						content: $content,
						buttons: {
							confirm: {
								text: 'Ok',
								btnClass: 'btn-blue',
								keys: ['enter', 'shift'],
								action: function() {}
							},
							cancel: function() {

							}
						}
					});
				}
			});

			return false;
		});
	},

	oneCollectionLazyLoad: function() {

		var collectionItem = document.querySelectorAll('.vc_ui-template');

		if ( collectionItem.length >= 0 ) {

			var observer = new IntersectionObserver( function (enteries, observer) {

				enteries.forEach( function(entery) {

					var target = entery.target,
						thumbImage = target.querySelector('img');

					if ( entery.isIntersecting ) {

						thumbImage.src = thumbImage.getAttribute('data-src');
						$(thumbImage).parent().css('background-image', 'url(' + thumbImage.getAttribute('data-src') + ')');

					}

				})

			}, { threshold: 0.25 });

			for ( var i = 0; i < collectionItem.length; i++ ) {

				observer.observe(collectionItem[i]);

			};

		}

	},

	initIconpicker: function() {

		if ( $.isFunction($.fn.fontIconPicker) ) {
			var iconInput = $('.liquid-icon-picker');
			iconInput.fontIconPicker();
		}

	},

	initTabs: function() {

		var activeTab = $().getParameterByName('page');

		$('.liquid-nav-tabs').find('li').each(function() {
			var that = $(this);
			if (that.data('tab') == activeTab) {
				that.addClass('is-active');
			}
		})

	},

};

jQuery(document).ready(function() {
	liquidAdmin.init();
});
jQuery(document).ajaxComplete(function(e) {
	//if ( jQuery(e.target.activeElement).is( '.widget-control-save' ) ) {
		liquidAdmin.initIconpicker();
	//}
});

})(jQuery);