#!/bin/bash

# ==============================================================================
# Deploy Script para Oracle Cloud (VM ARM) - Ubuntu 22.04 LTS
# Encurtador de Links Laravel 11
# ==============================================================================

# Sair em caso de erro
set -e

echo "🚀 Iniciando deploy do Encurtador na Oracle Cloud VM ARM..."

# 1. Atualizar pacotes
echo "📦 Atualizando pacotes..."
sudo apt update && sudo apt upgrade -y

# 2. Instalar dependências (PHP 8.2, Composer, MySQL, Apache, Git, Unzip)
echo "🛠️ Instalação das bibliotecas necessárias..."
sudo apt install -y software-properties-common curl git unzip
sudo apt install -y apache2 mysql-server
sudo apt install -y php8.2 php8.2-cli php8.2-common php8.2-mysql php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml php8.2-bcmath libapache2-mod-php8.2

# 3. Instalar Composer
if ! [ -x "$(command -v composer)" ]; then
    echo "🎵 Instalando Composer..."
    curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
    HASH=`curl -sS https://composer.github.io/installer.sig`
    php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
fi

# 4. Configurar MySQL
echo "🐬 Configurando Banco de Dados..."
sudo mysql -e "CREATE DATABASE IF NOT EXISTS encurtador;"
sudo mysql -e "CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY 'senha_segura_123';"
sudo mysql -e "GRANT ALL PRIVILEGES ON encurtador.* TO 'admin'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

# 5. Configurar o Projeto Laravel
PROJECT_DIR="/var/www/encurtador"

if [ ! -d "$PROJECT_DIR" ]; then
    echo "📥 Clonando repositório..."
    # Substitua a URL do repositório abaixo
    sudo git clone https://github.com/SEU_USUARIO/laravel-link-shortener.git $PROJECT_DIR
fi

cd $PROJECT_DIR

echo "🧩 Instalando dependências do Laravel..."
sudo composer install --optimize-autoloader --no-dev --ignore-platform-reqs

echo "⚙️ Configurando .env..."
if [ ! -f .env ]; then
    sudo cp .env.example .env
fi

# Atualizando .env para MySQL
sudo sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env
sudo sed -i 's/# DB_HOST=127.0.0.1/DB_HOST=127.0.0.1/' .env
sudo sed -i 's/# DB_PORT=3306/DB_PORT=3306/' .env
sudo sed -i 's/# DB_DATABASE=laravel/DB_DATABASE=encurtador/' .env
sudo sed -i 's/# DB_USERNAME=root/DB_USERNAME=admin/' .env
sudo sed -i 's/# DB_PASSWORD=/DB_PASSWORD=senha_segura_123/' .env
sudo sed -i 's/APP_ENV=local/APP_ENV=production/' .env
sudo sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env

echo "🔑 Gerando Application Key..."
sudo php artisan key:generate --force

echo "🗄️ Executando Migrations e Seeders..."
sudo php artisan migrate --seed --force

# 6. Permissões de Pastas (Apache)
echo "🔒 Ajustando permissões de pasta..."
sudo chown -R www-data:www-data $PROJECT_DIR
sudo chmod -R 775 $PROJECT_DIR/storage
sudo chmod -R 775 $PROJECT_DIR/bootstrap/cache

# 7. Configurar Apache Web Server e Virtual Host
echo "🌐 Configurando Apache..."
cat <<EOF | sudo tee /etc/apache2/sites-available/encurtador.conf
<VirtualHost *:80>
    ServerName demo.link
    DocumentRoot /var/www/encurtador/public

    <Directory /var/www/encurtador/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/encurtador_error.log
    CustomLog \${APACHE_LOG_DIR}/encurtador_access.log combined
</VirtualHost>
EOF

sudo a2enmod rewrite
sudo a2ensite encurtador.conf
sudo a2dissite 000-default.conf
sudo systemctl restart apache2

echo "✅ Deploy concluído com sucesso!"
echo "Acesse http://SEU_IP_AQUI (ou seu domínio) para visualizar o projeto."
