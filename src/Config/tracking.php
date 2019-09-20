<?php

return [
    /**
     * Specify if the tracking is enabled
     */
    'enabled' => env( 'TRACKING_ENABLED', true ),

    /**
     * Specify path's that you want to exclude from analytics
     */
    'ignore_paths'  => [
        'js/*'
    ],

    /**
     * Set IPs you would like to exclude from the tracking
     */
    'ignore_ips'  => [],

    /**
     * The queue to handle the request job
     */
    'queue' => 'default',

    /**
     * Specify form fields which should be guarded and replaced
     * with ***
     */
    'guarded' => [
        'password', 'password_confirmation'
    ],
];
