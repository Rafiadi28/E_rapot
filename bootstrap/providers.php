<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\RoleServiceProvider::class,  // Add this line
    Illuminate\Filesystem\FilesystemServiceProvider::class,  // Add this line
];
