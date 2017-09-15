<?php
/*
Template Name: reservations-template
*/
get_header();
get_template_part('partials/page_bg');
get_template_part('partials/title_box');

?>

	<div class="container">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.14/iframeResizer.min.js"></script>
		<form action="https://jansen-car-rental.jansencarrental.com/public/car-rental/reservations/step1?new=true&brand=001eb36a-ecb0-4c0d-b691-510a3a8f76e1&vehicle_class_id=<?php echo (int) get_query_var('vehicle_class_id', null); ?>"
		      method="POST" target="my_iframe" id="reserve_form" hidden="hidden">
			<input hidden="hidden" type="text" autocomplete="off" name="pick_up_date" id="pick_up_date"/>
			<input hidden="hidden" type="text" autocomplete="off" name="return_date" id="return_date"/>
			<input hidden="hidden" type="text" autocomplete="off" name="pick_up_time" id="pick_up_time"/>
			<input hidden="hidden" type="text" autocomplete="off" name="return_time" id="return_time"/>
			<input hidden="hidden" type="radio" name="pick_up_location" value="1"/>
			<input hidden="hidden" type="radio" name="pick_up_location" value="2"/>
			<input hidden="hidden" type="radio" name="pick_up_location" value="custom"/>
			<input hidden="hidden" type="text" autocomplete="off" name="pick_up_location_custom" id="pick_up_location_custom"/>
		</form>
		<style>
			.vc_column-inner {
				background-color: white;
			}

			iframe {
				width: 100%;
				margin: 0;
				padding: 0;
				top: 0;
				border: 0px;
			}
		</style>
		<iframe id="my_iframe" name="my_iframe"
		        src="h ttps://jansen-car-rental.jansencarrental.com/public/car-rental/reservations/recover-last-booking?brand_uuid=001eb36a-ecb0-4c0d-b691-510a3a8f76e1&vehicle_class_id=<?php echo (int) get_query_var('vehicle_class_id', null); ?>"></iframe>
		<script>
			iFrameResize({log: false, checkOrigin: false, maxWidth: screen.width, sizeWidth: true}, '#my_iframe')
		</script>
		<script type="text/javascript">
			(function ($) {
				"use strict";
				$(document).ready(function () {

					$(".container").css({"max-width": "100%", "padding": "0"});

					$("#top-bar .container").css({"max-width": "1140px"});

					$(".header-inner-content").css({"max-width": "1140px"});

					$(".footer-copyright").css({"max-width": "1140px"});

					var url = window.location.href;

					if (url.indexOf('pickup_location') != -1) {
						var pick_up_complete_date = decodeURIComponent(getUrlVars()['pickup_date']);
						var return_complete_date = decodeURIComponent(getUrlVars()['return_date']);
						var pick_up_date = pick_up_complete_date.substr(0, 10);
						var return_date = return_complete_date.substr(0, 10);

						var pick_up_time = pick_up_complete_date.substr(11, 5);
						var return_time = return_complete_date.substr(11, 5);

						var pick_up_location_custom= decodeURIComponent(getUrlVars()['pick_up_location_custom']);

						$("#pick_up_date").val(pick_up_date);
						$("#pick_up_time").val(pick_up_time);
						$("#return_date").val(return_date);
						$("#return_time").val(return_time);
						$("#pick_up_location_custom").val(pick_up_location_custom.split("+").join(" "));

						var pick_up_location = decodeURIComponent(getUrlVars()['pickup_location']);
						$("input[name=pick_up_location][value=" + pick_up_location + "]").prop("checked", true);
						$('#reserve_form').submit();
					}


					function getUrlVars() {
						var vars = [], hash;
						var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
						for (var i = 0; i < hashes.length; i++) {
							hash = hashes[i].split('=');
							vars.push(hash[0]);
							vars[hash[0]] = hash[1];
						}
						return vars;
					}
				})
			})(jQuery);

		</script>
	</div>
<?php get_footer(); ?>