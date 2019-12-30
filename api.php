<?php

$app->on('cockpit.rest.init', function ($routes) {
  $routes['wufoo'] = 'Wufoo\\Controller\\WufooApi';
});