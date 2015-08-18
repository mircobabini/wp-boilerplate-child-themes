# install a blog from the command line, after manually creating db and db_user
wp core download
wp core config --dbname=DBNAME --dbuser=DBUSER --dbpass=DBPASS
wp core install --url=http://sitename.com/ --title="Site title" --admin_user=myusername --admin_password=mypassword --admin_email=my.email@whatever.com

# rename a site (note: use option --allow-root to run commands as root)
wp search-replace 'http://example.dev' 'http://example.com' --skip-columns=guid
# or, if you only want to change the option
wp option update home 'http://example.com'
wp option update siteurl 'http://example.com'