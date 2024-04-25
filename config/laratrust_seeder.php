<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'books' => 'c,r,u,d',
            'borrowings' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'publishers' => 'c,r,u,d',
        ],
        'employee' => [
            'books' => 'c,r,u,d',
            'borrowings' => 'c,r,u,d',
        ],
        'user' => [
            'borrowings' => 'c,r,u,d',
            'bookshelves' => 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
