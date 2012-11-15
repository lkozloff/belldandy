#!/bin/sh
cat /var/www/belldandy/cron.stub > /etc/crontab
php /var/www/belldandy/process.php >> /etc/crontab
