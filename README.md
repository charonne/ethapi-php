# ethapi-php
Laravel package that implements a php client for Ethapi

## Install

This install process assumes you already have [your laravel project installed](https://laravel.com/docs/5.3/) correctly. 

1.  Install the package via composer :
    `composer require charonne/ethapi-php dev-master`
2.  Add the `EthapiServiceProvider` the `config/app.php`, in the `providers` array : 
    `Charonne\Ethapi\EthapiServiceProvider::class,`
3.  Get access to the package's config within your `/config/` folder by running :
    `php artisan vendor:publish` 
4.  You should now be good to go ! In case you are not, please contact us with the relavant error messages


## Developer

Raphael Pralat [raphael.pralat@charonne.com](mailto:raphael.pralat@charonne.com)

