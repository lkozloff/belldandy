#!/bin/sh
/var/www/belldandy/process.php
cat /var/www/belldandy/cron.stub /tmp/bell.stub > /etc/crontab
