FROM ubuntu:latest

RUN apt-get update
RUN apt-get -y install cron
RUN apt-get -y install curl
RUN apt-get -y install nano

RUN touch /var/log/cron.log

# Run cronjob every 12 hours
RUN crontab -l | { cat; echo "0 */12 * * * curl --request GET 'http://certmon-server/tasks/run' > /proc/1/fd/1 2>/proc/1/fd/2"; } | crontab -

CMD ["cron", "-f"]