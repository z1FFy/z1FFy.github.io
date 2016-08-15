<?php

/**
 * Ati.su compaign list
 * by @ziffyweb
 *
 * @param $count
 * @param $pageNumber
 * @return array
 */
function getCompaingsList($pageNumber, $count) {
	if (empty($count)) $count = 100;
	if (empty($pageNumber)) $pageNumber = 1;

	if ($curl = curl_init()) {
		$url = 'http://ati.su/api/rating/getFirmsRating?filter=%7B%22PageNumber%22:'.$pageNumber.',%22ItemsPerPage%22:' . $count . ',%22IsReverse%22:0,%22Geo%22:%7B%22text%22:%22%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F%22,%22value%22:%220_1%22%7D,%22FirmTypes%22:%5B%5D,%22IsActiveMemberAtiDoc%22:0,%22IsTribunalUser%22:0%7D';
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$out = curl_exec($curl);
		curl_close($curl);

		$firms = json_decode($out, 1);
		$firmsA = [];
		$i = 0;
		foreach ($firms['data']['firms'] as $firm) {
			$i++;
			$firmA['id'] = $firm['firm']['id'];
			$firmA['city'] = $firm['firm']['fullCityName'];
			$firmA['name'] = $firm['firm']['mainPartName'];
			$firmA['profile'] = $firm['firm']['profile'];
			$firmsA[] = $firmA;
			if ($i >= 100) {
				$i = 0;
			}
		}
	}

  return $firmsA;
}

/**
 * getReq function
 * Easy getting get/post param with inspect isset
 * by @ziffyweb
 *
 * @param $reqName
 * @return null
 */

function getReq($reqName) {
	if (isset($_REQUEST[$reqName]))
		return $_REQUEST[$reqName];
	else
		return null;
}



$pageNumber = getReq('pageNumber');
$pageCount = getReq('pageCount');

$compaignList = getCompaingsList($pageNumber,$pageCount);

echo json_encode($compaignList);