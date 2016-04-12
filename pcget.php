<?php
/**
 * @version    1.0.4
 * @package    Postcode API
 * @author     René Kreijveld <info@renekreijveld.nl>
 * @copyright  2016 René Kreijveld Webdevelopment
 * @license    GNU General Public License version 2 or later
 *
 * Deze code zoekt aan de hand van postcode en huisnummer de bijbehorende adresgegevens op via postcodeapi.nu.
 *
 */

define( '_JEXEC', 1 );

// defining the base path.
define( 'JPATH_BASE', realpath(dirname(__FILE__).'/../..' ));
define( 'DS', DIRECTORY_SEPARATOR );

// including the main joomla files
require_once ( JPATH_BASE.DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE.DS.'includes'.DS.'framework.php' );

// Creating an app instance
$app = JFactory::getApplication('site');
$app->initialise();

$jinput = JFactory::getApplication()->input;
$postcode = strtoupper($jinput->get('postcode', '', 'STRING'));
$number = $jinput->get('number', '', 'STRING');

if (strlen($postcode) == 7) $postcode = substr($postcode, 0, 4) . substr($postcode, 5, 2);

if ($postcode !== '' && $number !== '')
{
	$headers = array();
	// voorbeeld: $headers[] = 'X-Api-Key: sdfhksewhfsifhwkejfrbkfhskfHKkHKHKH';
	$headers[] = 'X-Api-Key: <plaats hier je postcodeapi.nu API key>';

	// De URL naar de API call
	$url = 'https://postcode-api.apiwise.nl/v2/addresses/?postcode=' . $postcode . '&number=' . $number;

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

	$response = curl_exec($curl);
	$data = json_decode($response);
	curl_close($curl);

	$addressdata = $data->_embedded->addresses[0];
	if ($addressdata)
	{
		$city = $addressdata->city->label;
		$street = $addressdata->street;
		$province = $addressdata->province->label;
		$lat = $addressdata->geo->center->wgs84->coordinates[1];
		$lon = $addressdata->geo->center->wgs84->coordinates[0];
		$return_data[]= array("city"=>$city,"street"=>$street,"province"=>$province,"lat"=>$lat,"lon"=>$lon);
		header('Content-type:application/json;charset=utf-8');
		echo json_encode($return_data);
	}
}