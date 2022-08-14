FROM ubuntu:latest

RUN apt-get update
RUN apt-get -y install cron
RUN apt-get -y install curl
RUN apt-get -y install nano


#COPY send-mail-cronjob /etc/cron.d/send-mail-cronjob
#RUN chmod 0644 /etc/cron.d/send-mail-cronjob

#RUN crontab /etc/cron.d/send-mail-cronjob
RUN touch /var/log/cron.log

# Run cronjob every 2 minutes, use only during development
RUN crontab -l | { cat; echo "*/2 * * * * curl --request GET 'http://certmon-server/tasks/test' > /proc/1/fd/1 2>/proc/1/fd/2"; } | crontab -

CMD ["cron", "-f"]