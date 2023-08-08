FROM php:8.1-cli
COPY . /usr/src/simpleGlobalOnlineMarket
WORKDIR /usr/src/simpleGlobalOnlineMarket
CMD [ "php" ]