
## ICTAU CRM Web Application

## Requirements
		PHP >= 5.6.4
		OpenSSL PHP Extension
		PDO PHP Extension
		Mbstring PHP Extension
		Tokenizer PHP Extension
		XML PHP Extension


## How to set up
1. Clone the repository into your project folder
        `git clone https://projectrepositoryurl.git`
2. Run `composer install` from cmd to install all project dependencies. If you don't have composer installed, go to [here](https://getcomposer.org/download/)
3. Update the values in `.env` file to match your configuration. Copy `.env.example` as a starting point
4. Run ```php artisan migrate``` to install the database migration

## Issues, Questions and Pull Requests

You can report issues and ask questions in the [issues section](https://github.com/skapeyi/ictau_crm/issues). 

If you have a question, check the closed issues first.

To submit a Pull Request, please fork this repository, create a new branch and commit your new/updated code in there. Then open a Pull Request from your new branch. Refer to [this guide](https://help.github.com/articles/about-pull-requests/) for more info.

## Contributors
1. [Samson Kapeyi](http://skapeyi.com)
2. [Ronald Sebuhinja](https://twitter.com/sebsronnie)


## License

This application is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Features
1. Storage of subscriber's details
2. Storage of subscriber's payments
3. Sending of reminders to customers via email when their subscriptions are expiring.
4. Statistics about subscriptions
5. Notify new users via email.
6. Provide users with ability to check their subscription status

