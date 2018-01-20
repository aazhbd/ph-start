<?php

$conf = array(
    'production' => array(
        'db_name' => 'ph-start',
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => 'root',
        'development_mode' => true,
        'path_sys_template' => '/Template/base.twig',
        'path_static' => '/Template/static/',
        'path_user_template' => '/App/views',
        'user_var' => array(
            'project_name' => 'ArtWebCMS',
            'project_scripts' => '/App/scripts',
            'project_static' => '/App/static',
        ),
    ),
    'development' => array(
        'db_name' => 'ph-start',
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => 'root',
        'development_mode' => true,
        'path_sys_template' => '/Template/base.twig',
        'path_static' => '/Template/static/',
        'path_user_template' => '/App/views',
        'user_var' => array(
            'project_name' => 'ArtWebCMS',
            'project_scripts' => '/App/scripts',
            'project_static' => '/App/static',
        ),
    ),
    'staging' => array(
        'db_name' => 'dev_db',
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => '1234',
        'development_mode' => true
    )
);

return $conf['development'];

