version: '3.6'

services:
  chrome:
    container_name: ddev-${DDEV_SITENAME}-chromedriver
    image: drupalci/chromedriver:production
    labels:
    # These labels ensure this service is discoverable by ddev
      com.ddev.site-name: ${DDEV_SITENAME}
      com.ddev.approot: $DDEV_APPROOT
    ports:
      - "9515:9515"
  # This links the Chromedriver service to the web service defined
  # in the main docker-compose.yml, allowing applications running
  # in the web service to access the driver at `chromedriver`.
  web:
    links:
      - chrome:$DDEV_HOSTNAME
