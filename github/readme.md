## GitHub Search Package

This package helps you use the [GiHub's search API](https://developer.github.com/v3/search/).

### Installation ###

Add the following line to `config/app.php` inside the 'providers' array to use the service provider

	'Nowakjestem\GitHub\GitHubSearchServiceProvider',

Update composer

	composer update

Run the package install command

	php artisan package:install

### Usage ###

Package comes with a set of services, which every one handles one endpoint.
Also, every service has a set of methods, which helps you to addavailable qualifiers to narrow your search. 

```php
<?php
use Nowakjestem\GitHub\Services\RepositorySearchService;

$service = new RepositorySearchService();
$service->addFollowersQualifier(5, '<=')
    ->byLanguage('php')
    ->addKeyword('Laravel')
    ->search();
```

If you don't want to use predefined methods for adding qualifiers, you can always use methods like `addStringQualifier` to get your exact result.
```php
<?php
use Nowakjestem\GitHub\Services\RepositorySearchService;

$service = new RepositorySearchService();

$service->addStringQualifier('is', $lookingForPrivate ? 'private' : 'public'); 
```
