#instalar apache como servidor web
apt-get install apache2 -y
#instalar la base de datos
apt-get install mariadb-server git -y
# instalar php en su version mas actual
apt-get install php libapache2-mod-php php-mysql -y
apt-get install curl php-cli unzip
apt-get install php-xml php-curl
# interfaz phpmyadmin para facilitar la revision de la base de datos
sudo apt install phpmyadmin

# instalar composer
curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
HASH=`curl -sS https://composer.github.io/installer.sig`
php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

# configurar proyecto
cd /var/www/

git clone https://github.com/zzva332/system_fce.git
cd /var/www/system_fce/
# instala las dependencias
composer install
# copia el archivo de configuracion de db
cp -r .env.example .env
# corre las migraciones
php artisan migrate


mysql
mysql -u root
# usuario para phpmyadmin
CREATE USER 'root2'@'localhost' IDENTIFIED BY 'clave';
GRANT ALL PRIVILEGES ON *.* TO 'root2'@'localhost';
FLUSH PRIVILEGES;