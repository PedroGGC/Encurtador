# Encurtador de Links - Laravel 11

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-3-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Oracle Cloud](https://img.shields.io/badge/Oracle_Cloud-F80000?style=for-the-badge&logo=oracle&logoColor=white)

Um moderno e rápido encurtador de links construído com a última versão do Laravel 11, Breeze, Tailwind CSS e banco de dados MySQL para alta performance. Inclui geração instantânea de QR Code e análises em tempo real, além de deploy otimizado para Oracle Cloud ARM.

##  Features

- **Encurtamento Rápido:** URLs amigáveis com 6 caracteres randômicos via arquitetura leve.
- **Geração de QR Code:** Suporte integrado a QR Codes (`simple-qrcode`) por link.
- **Analytics Nativo:** Controle de total de cliques e último acesso integrado diretamente por link.
- **Admin Dashboard:** TALL Stack (Tailwind, Alpine, Livewire, Laravel). Estatísticas detalhadas de links através de um dashboard interativo (Sem page reloads).
- **Segurança (Breeze Auth):** Sistema completo de autenticação e proteção garantindo privacidade aos links administrativos.
- **Rate Limiting:** API protegida no padrão limitando requisições abusivas.

## Tech Stack

- **Backend:** Laravel 11, PHP 8.2+
- **Frontend:** Tailwind CSS, Blade Templates, Livewire 3
- **Database:** MySQL
- **Dependências:** `simplesoftwareio/simple-qrcode`, `laravel/breeze`

## Como Rodar Localmente

1. **Clone o repositório:**

    ```bash
    git clone https://github.com/SEU_USUARIO/laravel-link-shortener.git
    cd laravel-link-shortener
    ```

2. **Instale dependências do Composer e NPM:**

    ```bash
    composer install
    npm install && npm run build
    ```

3. **Configure as Variáveis de Ambiente:**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    > Certifique-se de configurar o banco de dados `MySQL` em seu `.env`. Caso deseje facilitar testes locais, mude `DB_CONNECTION=sqlite`.

4. **Prepare o Banco de Dados:**

    ```bash
    php artisan migrate --seed
    ```

    _O Seeder irá gerar um usuário super admin (`admin@example.com` / `password`) com alguns links artificiais._

5. **Inicie o servidor de desenvolvimento:**
    ```bash
    php artisan serve
    ```

## Deploy Oracle Cloud (Free Tier ARM)

Este projeto acompanha um script bash completo e otimizado para deploy 1-click automático direto nas instâncias Ubuntu (ARM) da Oracle Cloud Free Tier.

**Executando no servidor root remoto:**

```bash
chmod +x deploy-oracle.sh
./deploy-oracle.sh
```

_(O script cuida da instalação do `php8.2`, `composer`, `mysql`, chaves seguras e setup do `apache2` em apenas um comando)._

## API

Pode ser integrado programaticamente usando o endpoint seguro:

**POST:** `/api/shorten`

- Autenticação opcional.
- Request Body: `{"url": "https://google.com"}`
- Responses: Recebe string JSON contendo a full short url gerada, url original. Limitado à cota do Throttle (`10req/min` default).

---

_Construído como caso de estudo/portfólio de engenharia de software fullstack._
