the redirect address in the https://developer.mercedes-benz.com/console should be
http://localhost/mb/client.php
to start app you should run,
docker run -p 80:80 registry.gitlab.com/bariskayar/mb_cve:latest

or 

download project and extract a folder.
run the command below;
    docker build -t bariskayar/mb .
you should see the output like below;
Sending build context to Docker daemon  121.3kB
Step 1/3 : FROM tutum/apache-php
latest: Pulling from tutum/apache-php
6ffe5d2d6a97: Already exists
f4e00f994fd4: Already exists
e99f3d1fc87b: Already exists
a3ed95caeb02: Already exists
c10ab9e629d8: Already exists
5c65b067601c: Already exists
2cbc3ddde9c1: Already exists
9a5e857e989f: Already exists
7bd95ceec22a: Already exists
c27094051f1e: Already exists
d820ec68d287: Already exists
Digest: sha256:6d21118f57fd5415638b0744be140c16e40353e2bc06659c8c8ffeadae648cfc
Status: Downloaded newer image for tutum/apache-php:latest
---> 2e233ad9329b
Step 2/3 : MAINTAINER Baris Kayar
---> Running in 00c801203a5f
Removing intermediate container 00c801203a5f
---> 09f5694601be
Step 3/3 : ADD mb/ /app/mb
---> 8edf5b9a57c5
Successfully built 8edf5b9a57c5
Successfully tagged bariskayar/mb:latest
you can start app with the command below;    
    docker run -d -p 80:80 bariskayar/mb
Open your browser at http://localhost/mb/