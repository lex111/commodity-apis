<?php
function permissionConstructor(string $canRead, string $canWrite) {

    $canRead = (bool) $canRead;
    $canWrite = (bool) $canWrite;

    if (!is_bool($canRead)) {
        throw new \Exception('The canRead property must be a boolean.');
    }

    if (!is_bool($canWrite)) {
        throw new \Exception('The canWrite property must be a boolean.');
    }

    if (!$canRead && $canWrite) {
        throw new \Exception('The permission cannot read but can write.  This is impossible.');
    }
};

function validatePassword(string $password) {
    $info = password_get_info($password);
    if (!isset($info['algo']) || ($info['algo'] != \PASSWORD_DEFAULT)) {
        throw new \Exception('The password algo is invalid.');
    }
};

function validateEmail(string $email) {
    $exploded = explode('@', $email);
    if (count($exploded) != 2) {
        throw new \Exception('The email address ('.$email.') must contain this character, once: @');
    }

    $ipAddress = gethostbyname($exploded[1]);
    if(!filter_var($ipAddress, \FILTER_VALIDATE_IP)) {
        throw new \Exception('The ipAddress connected to the domain name of the email address ('.$email.') is invalid.  Therefore, the email address is also invalid.');
    }

    if (empty(trim($exploded[0]))) {
        throw new \Exception('The username of the given email address ('.$email.') is empty.');
    }
};

function validateIpAddress(string $ipAddress) {
    if(!filter_var($ipAddress, \FILTER_VALIDATE_IP)) {
        throw new \Exception('The ipAddress ('.$ipAddress.') is invalid.');
    }
};

function validateDomainName(string $domainName) {
    $ipAddress = gethostbyname($domainName);
    if(!filter_var($ipAddress, \FILTER_VALIDATE_IP)) {
        throw new \Exception('The ipAddress connected to the domain name ('.$domainName.') is invalid.  Therefore, the domain name is also invalid.');
    }
};

function validateKey(string $key) {

    $length = strlen($key);
    if ($length < 50) {
        throw new \Exception('The key ('.$key.') must not contain less than 50 characters.');
    }

    if ($length > 99) {
        throw new \Exception('The key ('.$key.') must not contain more than 99 characters.');
    }

    $matches = [];
    preg_match_all('/[a-zA-Z0-9]+/s', $key, $matches);
    if (!isset($matches[0][0]) || ($matches[0][0] != $key)) {
        throw new \Exception('The key ('.$key.') must only contain letters (lowercase and/or uppercase) and numbers.');
    }

};
