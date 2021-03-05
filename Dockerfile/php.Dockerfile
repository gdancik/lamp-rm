# run php with mysqli and install R
FROM php:7.4.3-apache
RUN apt-get update
RUN apt-get -y install r-base
RUN apt-get -y install pandoc
RUN R -e "install.packages(c('rmarkdown'), repos='https://cloud.r-project.org/')" 
RUN docker-php-ext-install mysqli pdo pdo_mysql
