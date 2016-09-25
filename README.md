# SimpleLotteryBundle Installation

This is a Test bundle to test the power of the symfony framework.

This bundle provides:
- A Form to persist in the database a nickname.
- A Random Lottery raffle that show the winner.

There is an example of the project on-line in: http://lottery.feerb.com/

## Prerequisites

This version of the bundle requires Symfony 2.8.


## Install Symfony

If you are starting a new project you need install symfony standard, if you already 
have a symfony project go to next step.

If you arent install symfony yet you need to read symfony install
[documentation](http://symfony.com/doc/current/book/installation.html)

## Install the bundle

Add this bundle into src/ folder

## Enable the Bundle

Enable the blog bundle in your AppKernel, additionally you need to enable KnpPaginatorBundle.

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new SimpleLotteryBundle\SimpleLotteryBundle(),
    );
}
```

## Update your database schema

### Configure your database

Fist, if you aren't configured your database you need to read symfony database
[documentation](http://symfony.com/doc/current/book/doctrine.html).

Your parameters should looks like this.

``` yml
# app/config/parameters.yml
parameters:
    database_driver: pdo_mysql
    database_host: 127.0.0.1
    database_port: null
    database_name: blog_bundle_dev
    database_user: myUser
    database_password: myPass
    locale: en
    secret: ThisTokenIsNotSoSecretChangeIt
```

### Update schema

Now that the bundle is configured, the last thing you need to do is update your database schema.

run following command.

``` bash
$ php doctrine:schema:update --dump-sql
```

It will show the changes that will be made ​​in the database, if everything is correct then you can execute.

``` bash
$ php doctrine:schema:update --force
```
