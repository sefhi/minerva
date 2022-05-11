FROM node:18-alpine

WORKDIR /app

# install app dependencies
COPY package.json ./
COPY package-lock.json ./

RUN npm ci --silent

# add app
COPY . ./

# start app
CMD ["npm", "start"]