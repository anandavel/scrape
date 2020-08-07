<?php
	$uscfid ="";
	$name ="kopula";

	$url = "https://new.uschess.org/player-search?external_identifier=".$uscfid."&display_name=".$name."&state_province_id=All&rating_94%5Bmin%5D=&rating_94%5Bmax%5D=&online_regular_rating_165%5Bmin%5D=&online_regular_rating_165%5Bmax%5D=&quick_rating_95%5Bmin%5D=&quick_rating_95%5Bmax%5D=&online_blitz_rating_98%5Bmin%5D=&online_blitz_rating_98%5Bmax%5D=&blitz_rating_96%5Bmin%5D=&blitz_rating_96%5Bmax%5D=&online_quick_rating_97%5Bmin%5D=&online_quick_rating_97%5Bmax%5D=&correspondence_rating_101%5Bmin%5D=&correspondence_rating_101%5Bmax%5D=";



	$htmlContent = file_get_contents($url);
	$DOM = new \DOMDocument('1.0', 'UTF-8');
	$internalErrors = libxml_use_internal_errors(true);
	@$DOM->loadHTML($htmlContent);

	$Header = $DOM->getElementsByTagName('th');
	$Detail = $DOM->getElementsByTagName('td');

	foreach($Header as $NodeHeader) 
	{
	$aDataTableHeaderHTML[] = trim(str_replace(' ', '_', $NodeHeader->textContent));
	}

	$i = 0;
	$j = 0;
	foreach($Detail as $sNodeDetail) 
	{
	$aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
	$i = $i + 1;
	$j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
	}

	for($i = 0; $i < count($aDataTableDetailHTML); $i++)
	{
	for($j = 0; $j < count($aDataTableHeaderHTML); $j++)
	{
	$aTempData[$i][$aDataTableHeaderHTML[$j]] = $aDataTableDetailHTML[$i][$j];
	}
	}
	$aDataTableDetailHTML = $aTempData; 
	unset($aTempData);
	print_r($aDataTableDetailHTML); die();