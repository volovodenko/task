<?php

Config::set('routes',
    [
        "home" => "Home",
        "products" => "Products",
        "dashboard" => "Dashboard"
    ]
);

Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '12345');
Config::set('db.name', 'task');

Config::set('salt', 'jd7sj3$dkd964he7e');
