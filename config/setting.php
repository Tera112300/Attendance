<?php
return [
    'BcApp' => [
        /**
         * システムナビ
         */
        'adminNavigation' => [
            'Plugins' => [
                'menus' => [
                    'Attendance' => [
                        'title' => '勤怠管理',
                        'url' => [
                            'prefix' => 'Admin',
                            'plugin' => 'Attendance',
                            'controller' => 'Attendance',
                            'action' => 'index'
                        ]
                    ]
                ]
            ]
        ]
    ],
];


