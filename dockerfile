# Use an official PHP runtime as a parent image
FROM php:8.2-cli

# Arguments defined in docker-compose.yml
ARG user
ARG uid
ARG app_debug

# Set the working directory to /app
WORKDIR /src

# Copy the current directory contents into the container at /app
COPY . /src

# Install dependencies
RUN apt-get update && \
    apt-get install -y libpq-dev zlib1g-dev libzip-dev unzip && \
    docker-php-ext-install pdo_mysql zip

# Install Git
RUN apt-get install -y git

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable xdebug if APP_DEBUG is true on .env
RUN if [ $app_debug = "true" ] ; then \
    pecl install xdebug \
    && docker-php-ext-enable xdebug; \
fi ;

# Create system user to run Composer Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Run composer install to install dependencies
RUN composer install --no-dev --optimize-autoloader

#change to user
USER $user
# Keep the container running
#CMD ["tail", "-f", "/dev/null"]