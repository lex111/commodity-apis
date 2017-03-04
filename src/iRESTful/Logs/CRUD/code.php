<?php

function validateDomain(string $name) {
    $ip = gethostbyname($name);
    if(filter_var($ip, \FILTER_VALIDATE_IP) === false) {
        throw new \Exception('The given domain name ('.$name.') is invalid.');
    }
};

function validateIpAddress(string $ipAddress) {
    if(filter_var($ipAddress, \FILTER_VALIDATE_IP) === false) {
        throw new \Exception('The given ip address ('.$ipAddress.') is invalid.');
    }
};

function validateUsername(string $username) {
    $exploded = explode(' ', $username);
    if (count($exploded) != 1) {
        throw new \Exception('The username ('.$username.') cannot contain spaces.');
    }

    $exploded = explode(\PHP_EOL, $username);
    if (count($exploded) != 1) {
        throw new \Exception('The username ('.$username.') cannot end of lines.');
    }

};

function validateKeyname(string $keyname) {
    $matches = [];
    preg_match_all('/[a-z0-9\-]+/s', $keyname, $matches);
    if (!isset($matches[0][0]) || ($matches[0][0] != $keyname)) {
        throw new \Exception('The given keyname ('.$keyname.') is invalid.  It must only contain lowercase letters numbers and hyphens (-).');
    }
};
