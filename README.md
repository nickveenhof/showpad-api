Showpad API Wrapper
========================================

This is a simple PHP wrapper for the Showpad API. It is built for v3 of the API, and it is currently incomplete.

You can find the Showpad website [here](http://www.showpad.com)


Most of this is derived from the turanct/showpad-api repository but for use without the oauth2 redirect url flow so
that it can be used in trusted applications such as Drupal.

2. Setup
----------------------------------------

### 2.1 Composer

Please use composer to autoload the Showpad api wrapper! Other methods are not encouraged by me.

*composer.json*

```json
{
	"require": {
        "nickveenhof/showpad-api-guzzle": "dev-master"
	}
}
```

### 2. Usage

```php
<?php

$url = "https://myaccount.showpad.biz/api/v3";
$username = "my.username@domain.com";
$password = "mypassword";
$clientId = "showpad-client-id";
$clientSecret = "showpad-client-secret";

// Create a config object
$config = new ConfigBasic($url, $username, $password, $clientId, $clientSecret, null, null);

// Create an Authentication object, using the config
$auth = new Authentication($config);
$auth->authenticate();

// Create a showpad client. This client contains all possible api methods.
$client = new Client($auth);

// You can now e.g. upload a file to showpad:
$client->assetsAdd($pathToFile);
```