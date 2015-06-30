(function($) {
	'use strict';
	tinymce.PluginManager.add('wpsve_mce_button', function(editor, url) {
		var googlePublicKey = editor.getLang('wpsve_mce_button.googlePublicKey');

		editor.addButton('wpsve_mce_button', {
			icon : 'icon dashicons-video-alt2',
			type : "menubutton",
			menu : [ {
				text : 'YouTube',
				icon : 'icon dashicons-video-alt3 color-red',
				onclick : function() {
					// Check if in edit
					var mceStr = $(tinymce.activeEditor.selection.getNode()).text();
					var inEdit = false;
					var fieldObject = {};
					if (mceStr.slice(0, '[wpsve'.length) == '[wpsve') {
						inEdit = true;
						// Remove [ ]
						mceStr = mceStr.substring(1, mceStr.length - 1);
						var fields = mceStr.split(' ');

						if (typeof fields === 'object') {
							fields.forEach(function(field) {
								var c = field.split('=');
								if (c[1] !== undefined) {
									fieldObject[c[0]] = c[1].replace(/"/g, '');
								}
							});
						}
					}

					var win = editor.windowManager.open({
						title : 'YouTube Simple Video Embed',
						body : [ {
							type : 'listbox',
							name : 'type',
							id : 'wpsvetype',
							label : editor.getLang('wpsve_mce_button.typeLabel'),
							value : (typeof fieldObject.type != 'undefined') ? fieldObject.type : "video",
							'values' : [ {
								text : editor.getLang('wpsve_mce_button.videoLabel'),
								value : 'video'
							}, {
								text : editor.getLang('wpsve_mce_button.playlistLabel'),
								value : 'playlist'
							} ],
							onselect : function() {
								if (this.value() === 'video') {
									jQuery('#wpsvetemplate').css('display', 'none');
								} else {
									jQuery('#wpsvetemplate').css('display', 'block');
								}
							}
						}, {
							type : 'textbox',
							name : 'urlorid',
							id : 'wpsveurlorid',
							label : editor.getLang('wpsve_mce_button.urloridLabel'),
							value : (typeof fieldObject.id != 'undefined') ? fieldObject.id : "",
							onclick : function(e) {
								jQuery(e.target).css('border-color', '');
							}
						}, {
							type : 'checkbox',
							name : 'autoplay',
							id : 'wpvseautoplay',
							label : editor.getLang('wpsve_mce_button.autoplayLabel'),
							checked : (typeof fieldObject.autoplay != 'undefined' && fieldObject.autoplay === '1') ? true : false
						}, {
							type : 'checkbox',
							name : 'loop',
							id : 'wpvseloop',
							label : editor.getLang('wpsve_mce_button.loopLabel'),
							checked : (typeof fieldObject.loop != 'undefined' && fieldObject.loop === '1') ? true : false
						}, {
							type : 'listbox',
							name : 'controls',
							id : 'wpvsecontrols',
							label : editor.getLang('wpsve_mce_button.videoControlsDisplayLabel'),
							value : (typeof fieldObject.controls != 'undefined') ? fieldObject.controls : "1",
							'values' : [ {
								text : editor.getLang('wpsve_mce_button.videoControlsDisplay0Label'),
								value : '0'
							}, {
								text : editor.getLang('wpsve_mce_button.videoControlsDisplay1Label'),
								value : '1'
							}, {
								text : editor.getLang('wpsve_mce_button.videoControlsDisplay2Label'),
								value : '2'
							} ]
						}, {
							type : 'checkbox',
							name : 'fs',
							id : 'wpvsefs',
							label : editor.getLang('wpsve_mce_button.fullscreenLabel'),
							checked : (typeof fieldObject.fs !== 'undefined' && fieldObject.fs === '0') ? false : true
						}, {
							type : 'listbox',
							name : 'template',
							id : 'wpsvetemplate',
							label : editor.getLang('wpsve_mce_button.templateLabel'),
							value : (typeof fieldObject.template != 'undefined') ? fieldObject.template : "no_thumb",
							'values' : [ {
								text : editor.getLang('wpsve_mce_button.noThumbLabel'),
								value : 'no_thumb'
							}, {
								text : editor.getLang('wpsve_mce_button.slider'),
								value : 'video_slider'
							}, {
								text : editor.getLang('wpsve_mce_button.thumbSlider'),
								value : 'thumb_slider'
							}, {
								text : editor.getLang('wpsve_mce_button.thumbInColumns'),
								value : 'thumb_col'
							} ]
						} ],
						onsubmit : function(e) {

							// Check if google public key is configured
							if (editor.getLang('wpsve_mce_button.googlePublicKeyV3') === '{#wpsve_mce_button.googlePublicKeyV3}') {
								editor.windowManager.alert(editor.getLang('wpsve_mce_button.alertConfig'));
								return false;
							}

							// Check if a url or a id is passed
							if (e.data.urlorid === '') {
								$('#' + this._id + '-body').find('#wpsveurlorid').css('border-color', 'red');
								editor.windowManager.alert(editor.getLang('wpsve_mce_button.alertRequired'));
								return false;
							}

							var urlParams = ytGetIdFromUrl(e.data.urlorid);
							var id = (e.data.type !== "video") ? urlParams['list'] : urlParams['v'];

							if (e.data.urlorid !== '') {
								var shortcut = '[wpsve object="youtube" type="' + e.data.type + '" id="' + id + '"';

								if (e.data.autoplay) {
									shortcut += ' autoplay="1"';
								}

								if (e.data.loop) {
									shortcut += ' loop="1"';
								}

								shortcut += ' controls="' + e.data.controls + '"'

								if (e.data.fs) {
									shortcut += ' fs="1"';
								} else {
									shortcut += ' fs="0"';
								}

								if (e.data.type === 'playlist') {
									shortcut += ' template="' + e.data.template + '"';

									if (e.data.template === 'thumb_col') {
										if (typeof fieldObject.col !== 'undefined') {
											shortcut += ' col="' + fieldObject.col + '"';
										} else {
											shortcut += ' col="' + editor.getLang('wpsve_mce_button.defaultColumnsNumber') + '"';
										}

										if (typeof fieldObject.thumb_title !== 'undefined') {
											shortcut += ' thumb_title="' + fieldObject.thumb_title + '"';
										} else {
											shortcut += ' thumb_title="' + editor.getLang('wpsve_mce_button.defaultThumbTitle') + '"';
										}

									}

									if (e.data.template === 'thumb_slider') {
										if (typeof fieldObject.thumb_title !== 'undefined') {
											shortcut += ' thumb_title="' + fieldObject.thumb_title + '"';
										} else {
											shortcut += ' thumb_title="' + editor.getLang('wpsve_mce_button.defaultThumbTitle') + '"';
										}
									}

									if (e.data.template === 'video_slider' && typeof fieldObject.height !== 'undefined') {
										shortcut += ' height="' + fieldObject.height + '"';
									} else if (e.data.template === 'video_slider') {
										shortcut += ' height="' + editor.getLang('wpsve_mce_button.defaultVideoSliderHeight') + '"';
									}

								}
								shortcut += ']';

								if (inEdit) {
									$(tinymce.activeEditor.selection.getNode()).text(shortcut);
								} else {
									editor.insertContent(shortcut);
								}
							}
						}

					});
					if (typeof fieldObject.type == 'undefined' || fieldObject.type != 'playlist') {
						$('#wpsvetemplate').css('display', 'none');
					}
				}
			} ]

		});
	});
})(jQuery);

function ytGetIdFromUrl(url, type) {
	var urlParams = {};

	var parser = document.createElement('a');
	parser.href = url;
	if (parser.search !== '') {

		var query = parser.search.substring(1);

		// Regex for replacing addition symbol with a space
		var match, pl = /\+/g,

		search = /([^&=]+)=?([^&]*)/g, decode = function(s) {
			return decodeURIComponent(s.replace(pl, " "));
		}
		while (match = search.exec(query))
			urlParams[decode(match[1])] = decode(match[2]);
	} else {
		urlParams['list'] = url;
		urlParams['v'] = url;
	}
	return urlParams;
}
