<?php

return [

    /*
     * The API key of a MailChimp account. You can find yours at
     * https://us10.admin.mailchimp.com/account/api-key-popup/.
     */
    'apiKey' => env('793d0142e95d41362cbe5f67594017b8-us18'),

    /*
     * The listName to use when no listName has been specified in a method.
     */
    'defaultListName' => 'Landing Page',

    /*
     * Here you can define properties of the lists.
     */
    'lists' => [

        /*
         * This key is used to identify this list. It can be used
         * as the listName parameter provided in the various methods.
         *
         * You can set it to any string you want and you can add
         * as many lists as you want.
         */
        'Landing Page' => [

            /*
             * A MailChimp list id. Check the MailChimp docs if you don't know
             * how to get this value:
             * http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id.
             */
            'id' => env('d8f3fea106'),
        ],
    ],

    /*
     * If you're having trouble with https connections, set this to false.
     */
    'ssl' => false,

];
