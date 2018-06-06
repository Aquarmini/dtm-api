#!/usr/bin/env bash
ssh -i /var/jenkins_home/.ssh/id_rsa -tt root@172.17.0.1 "cd /www/limx/dtm-api && \
git pull && \
composer update --no-dev --prefer-dist -o && \
service dtm.chat restart && \
echo Hi, $name"