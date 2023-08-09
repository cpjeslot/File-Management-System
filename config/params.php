<?php

/**
 * @author Chetan Patel <cpjeslot@gmail.com>>
*/

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',

    'passwordResetTokenExpire' => 3600,
    
    'jwt' => [
        'issuer' => 'https://api.dms.com',  //name of your project (for information only)
        'audience' => 'https://www.dms.com',  //description of the audience, eg. the website using the authentication (for info only)
        'id' => 'AMqey0yAVrqmhR82RMlWB3zqMpvRP0zaaOheEeq2tmmcEtRYNj',  //a unique identifier for the JWT, typically a random string
        'expire' => '+4 hour',  //the short-lived JWT token is here set to expire after 1 Hours.
        'request_time' => '+0 seconds',
        'uploadPath' => ''
    ],
    
];
