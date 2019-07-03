#!/bin/bash
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:CREATE
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load