<?php
// Call First
session_start();

// Call Second
addSameSite("Lax");




// Make sure the below is available to the script

/* 
   From: https://robert-lerner.com, verify you did it right over at https://headerinspector.com
   Make sure session_start() is called prior to this.
   Note: Didn't add session.cookie_lifetime support since session cookies don't have timeouts, and yea.
*/
function addSameSite(string $val="Lax") {
	$sessionName = ini_get("session.name");
	$domainSetting = ini_get("session.cookie_domain");
	$path = ini_get("session.cookie_path");
	if (ini_get("session.cookie_httponly")) {
		$httpOnly = "HttpOnly;";
	}
	if (ini_get("session.cookie_secure")) {
		$secure = "secure;";
	}
	if ($domainSetting!="") {
		$domain = "domain={$domainSetting};";
	}
	$header = "Set-Cookie: {$sessionName}=" . session_id() . ";path={$path};{$domain}{$secure}{$httpOnly}SameSite=$val";
	header($header,true);
}
