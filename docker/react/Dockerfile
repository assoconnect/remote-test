FROM node:alpine

# set working directory
WORKDIR /usr/src/frontend

# add `/usr/src/frontend/node_modules/.bin` to $PATH
ENV PATH /usr/src/frontend/node_modules/.bin:$PATH

# install and cache app dependencies
COPY ./apps/frontend/package.json /usr/src/frontend/package.json
COPY ./apps/frontend/yarn.lock /usr/src/frontend/yarn.lock
RUN yarn install

VOLUME /usr/src/frontend/node_modules

COPY docker/react/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]

# start app
CMD ["yarn", "start"]
