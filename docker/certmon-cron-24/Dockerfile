FROM ubuntu:latest

RUN apt-get update
RUN apt-get -y install cron
RUN apt-get -y install curl
RUN apt-get -y install nano


#COPY send-mail-cronjob /etc/cron.d/send-mail-cronjob
#RUN chmod 0644 /etc/cron.d/send-mail-cronjob

#RUN crontab /etc/cron.d/send-mail-cronjob
RUN touch /var/log/cron.log

# Run Cronjob every 24 hours.
RUN crontab -l | { cat; echo "0 0 * * * curl --request GET 'http://certmon-server/tasks/run' > /proc/1/fd/1 2>/proc/1/fd/2"; } | crontab -

CMD ["cron", "-f"]