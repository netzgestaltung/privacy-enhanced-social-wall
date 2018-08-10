# Privacy enhanced social wall
Loads Tweets, Facebook and Instagram Posts with PHP, and displays it with ```<?php pesf_wall(); ?>```.

Post-images will also be downloaded by PHP and stored in a cache directory. 

Users of the site where the privacy enhanced social wall is shown will never have an open connection to Twitter, Facebook or Instagram in their browser by this script.

## To do's:
* Extend content filter for hashtags and useradresses also for FB and Insta, currently only works for Tweets.
* Add useradresse to username in ```Social_Post()```
* Add more unified meta data in ```Social_Post()```
* Test FB and Insta PHP-API, needs accounts and permissions on the services
