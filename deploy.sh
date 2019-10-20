#!/bin/bash

#########################################
echo "Zip explorer"
#########################################
rm -f ./explorer.zip
zip -r explorer.zip ./src/ ./public/ ./composer.json

#########################################
echo "Send explorer.zip to remote: 67.205.189.5"
#########################################
scp ./explorer.zip root@67.205.189.5:/home
rm ./explorer.zip

#########################################
echo "[Remote] Unzip explorer.zip"
#########################################
ssh root@67.205.189.5 'cp /home/explorer.zip /var/www/explorer/ && cd /var/www/explorer/ && unzip -o /home/explorer.zip'

#########################################
echo "[Remote] Chmod 777"
#########################################
ssh root@67.205.189.5 'chmod -R 777 /var/www/explorer/'

#########################################
echo "[Remote] Chown www-data"
#########################################
ssh root@67.205.189.5 'chown -R www-data:www-data /var/www/explorer/'

