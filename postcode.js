/*!
 * @version    1.0.3
 * @package    Postcode API
 * @author     René Kreijveld <info@renekreijveld.nl>
 * @copyright  2016 René Kreijveld Webdevelopment
 * @license    GNU General Public License version 2 or later
 *
 * This code calls the local PHP proxy to get address info
 *
 */

jQuery(document).ready(function($){
	$('#postcode,#huisnummer').blur(function(event) {
		var postcode = $('#postcode').val();
		var huisnr= $('#huisnummer').val();
		if (postcode !== '' && huisnr !== '') {
			var url = "/media/postcode/pcget.php?postcode=" + postcode + "&number=" + huisnr;
			$.getJSON(url, function(json){
				if (json.length == 1) {
					$("#straat").val(json[0].street).removeAttr('disabled');
					$("#plaats").val(json[0].city).removeAttr('disabled');
					$("#provincie").val(json[0].province).removeAttr('disabled');
					$("#lat").val(json[0].lat).removeAttr('disabled');
					$("#lon").val(json[0].lon).removeAttr('disabled');
				} else {
					$("#straat").removeAttr('disabled');
					$("#plaats").removeAttr('disabled');
					$("#provincie").removeAttr('disabled');
					$("#lat").removeAttr('disabled');
					$("#lon").removeAttr('disabled');
				}
			});
		}
	});
});