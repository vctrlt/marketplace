<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Interface Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in the user interface.
    |
    */
    'money' => ['free' => 'FREE'],
    'connection' => [
        'http' => [
            'lost' => 'Internet connection was lost.',
            'gained' => 'Internet connection was reestablished.'
        ],
        'websocket' => ['lost' => 'Chat connection was lost.', 'gained' => 'Chat connection was reestablished.']
    ],
    'error' => ['unknown' => 'Unknown error.', 'image' => 'Image fetch error.'],
    'form' => [
        'username' => 'Username',
        'display_name' => 'Display Name',
        'email' => 'E-mail',
        'login' => 'Login',
        'password' => 'Password',
        'password_confirmation' => 'Password confirmation',
        'file-select' => 'Select file',
        'file-select-multiple' => 'Select files',
        'file-select-listed' => 'One file|:amount files',
        'currency' => 'Currency',
        'extended' => [
            'offer-name' => 'What are you selling?',
            'offer-description' => 'Describe the offer a little more',
            'offer-images' => 'Add some photos'
        ],
        'offer-name' => 'Offer name',
        'offer-description' => 'Offer description',
        'price' => 'Price',
        'offer-images' => 'File',
        'reorder-images' => 'Reorder the photos (use drag & drop)',
        'password_change' => 'New password',
        'user-information' => 'Basic information',
        'profile-image' => 'Profile image'
    ],
    'button' => [
        'profile' => 'Show Profile',
        'login' => 'Login',
        'remember-me' => 'Remember Me',
        'forgot-password' => 'Forgot Your Password?',
        'register' => 'Register',
        'password-email' => 'Send Password Reset Link',
        'password-reset' => 'Reset Password',
        'expand' => 'Expand',
        'close' => 'Close',
        'message' => 'Message',
        'ban' => 'Ban',
        'unban' => 'Unban',
        'report' => 'Report',
        'edit' => 'Edit',
        'remove' => 'Remove',
        'mark-appropriate' => 'Mark as appropriate',
        'bump' => 'Bump up as new',
        'bump-times' => '(left: :times)',
        'previous' => 'Previous',
        'next' => 'Next',
        'browse' => 'Browse',
        'publish' => 'Publish',
        'revert-images' => 'Revert original photos',
        'resend' => 'Resend',
        'send' => 'Send',
        'language-toggle' => 'Toggle Language',
        'offer-create' => 'Create a New Offer',
        'chat' => 'Open Chat',
        'go-back' => 'Go Back',
        'top' => 'Go to top',
        'images-loading' => 'Check again?',
        'buy' => 'Buy',
        'search' => 'Search',
        'update-profile' => 'Update Profile',
        'clear-image' => 'Do not upload an image',
        'remove-profile-image' => 'Remove my profile image altogether.'
    ],
    'hint' => [
        'login' => 'Username or e-mail',
        'type-message' => 'Type a message',
        'empty_change' => 'Keep empty if you do not want to change'
    ],
    'page' => [
        'login' => 'Sign In',
        'register' => 'Register',
        'password-email' => 'Reset Password',
        'password-reset' => 'Reset Password',
        'offer-create' => 'Create offer',
        'offer-edit' => 'Edit offer',
        'chat' => 'Chat',
        'banned' => 'Banned users',
        'admin' => 'Administration',
        'reported' => 'Reported offers',
        'offer' => 'Offer',
        'search' => 'Search',
        'dashboard' => 'Dashboard',
        'me' => 'My Profile',
        'logout' => 'Sign Out',
        'user-settings' => 'My Settings'
    ],
    'confirm' => [
        'ban' => 'Are you sure you want to ban user :user?',
        'unban' => 'Are you sure you want to unban user :user?',
        'offer-remove' => 'You are trying to remove offer ":offer". Are you sure you want to continue?',
        'offer-bump' => 'Are you sure you want to make the offer ":offer" reappear on top as new?',
        'offer-bump-times' => '{1} You can do this only one more time.|{2} You can do this only twice.|[3,*] You can do this only :times times.',
        'offer-report' => 'Are you sure you want to report the offer ":offer" as inappropriate?',
        'offer-mark-appropriate' => 'Are you sure you want to mark the offer ":offer" as appropriate?',
        'form-leave' => 'Are you sure you want to leave? You have unsaved changes!',
        'message' => 'Are you sure you want to send user :user a message?'
    ],
    'notification' => [
        'before' => [
            'ban' => 'Banning user :user',
            'unban' => 'Unbanning user :user',
            'offer-remove' => 'Offer ":offer" is being removed.',
            'offer-bump' => 'Bumping offer ":offer".',
            'offer-report' => 'Reporting offer ":offer".',
            'offer-mark-appropriate' => 'Marking offer ":offer" as appropriate.'
        ],
        'after' => [
            'ban' => 'User :user was successfully banned.',
            'unban' => 'User :user was successfully unbanned.',
            'offer-remove' => 'Offer ":offer" was successfully removed.',
            'offer-bump' => 'Offer ":offer" was successfully bumped.',
            'offer-report' => 'Offer ":offer" has been successfully reported.'
        ],
        'messages' => 'You have a new message.|You have :amount new messages.',
        'user-settings' => [
            'password' => [
                'success' => 'Password was successfully updated.',
                'failure' => 'Password failed to update.'
            ],
            'image' => [
                'success' => 'Profile image was successfully updated. The change may not appear immediately.',
                'failure' => 'Profile image failed to update.'
            ],
            'success' => 'Profile was successfully updated.',
            'failure' => 'Profile failed to update.'
        ]
    ],
    'notice' => [
        'bumps-none' => 'No bumps left!',
        'bumped-recently' => 'Bumped recently',
        'loading' => 'Loading...',
        'message-failed' => 'Message send failed.',
        'offer-reported' => '{1} Reported once|{2} Reported twice|[3,*] Reported :times times',
        'images-loading' => 'Not all images are ready yet.',
        'list-end' => 'You reached the end.',
        'user-buy' => 'User :user wants to buy something!'
    ],
    'label' => [
        'options' => [
            'additional' => 'Additional options',
            'owned' => 'Owner options',
            'admin' => 'Administrator options'
        ],
        'page-current' => '(current)'
    ],
    'choices' => [
        'no-results' => 'No results found',
        'no-choices' => 'No choices to choose from',
        'select' => 'Press to select',
        'add' => 'Press Enter to add ":value"',
        'max' => 'Only :max values can be added.'
    ],
    'message' => [
        'error' => 'Error',
        'received' => 'Received',
        'awaiting' => 'Awaiting send',
        'read' => 'Read',
        'sent' => 'Sent',
        'typing' => 'Typing...'
    ],
    'accessibility' => ['profile-img' => 'Profile Image', 'offer-image' => 'Offer Photo'],
    'offer' => ['draft' => 'Draft', 'sold' => 'Sold', 'expired' => 'Expired'],
];