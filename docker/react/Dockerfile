FROM node:alpine

# set working directory
WORKDIR /usr/src/frontend

# add `/app/node_modules/.bin` to $PATH
ENV PATH /usr/src/frontend/node_modules/.bin:$PATH

# install and cache app dependencies
COPY ./apps/frontend/package.json /usr/src/frontend/package.json
COPY ./apps/frontend/yarn.lock /usr/src/frontend/yarn.lock
RUN yarn install
RUN yarn global add react-scripts@3.0.1

# start app
CMD ["yarn", "start"]