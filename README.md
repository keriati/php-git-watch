Git Watch - PHP based Git pull script for beanstalkapp web hooks
================================================================

This script should pull the changes from beanstalkapp, after somebody did a push. It's based on beanstalkapp's webhooks.

Example usage
-------------

- Create a read only user on beanstalkapp with public key
- Copy the private key for the user on your webserver
- Edit config.ini for every repository and branch with folder and private key location settings like this:

    [examplerepository]
    branch.folder = '/srv/www/examplerepo/';
    branch.keyLocation = '/srv/www/puller.key';

- Copy the script to your server with the 'public' directory as document root folder
- Set up rights on your server for the www-data user to make a git pull (...)
- Make log/gitwatch.log writeable
- Enable WebHooks in beanstalkapp for your project
- Debug, check the logs...

more details later....