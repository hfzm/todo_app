<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'permissions' => 'c,r,u,d',
            'tasks' => 'c,r,u,d',
            'sub_tasks' => 'c,r,u,d',
        ],
        'manager' => [
            'tasks' => 'c,r,u,d',
            'sub_tasks' => 'c,r,u,d',
        ],
        'employee' => [
            'tasks' => 'c,r,u,d',
            'sub_tasks' => 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
