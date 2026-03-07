# Mesa Fácil — Setup Inicial

## 1. Pré-requisitos

- PHP 8.0+
- Composer
- MySQL 5.7+ (produção) ou SQLite (desenvolvimento)
- Node.js + npm (para assets)

## 2. Instalação

```bash
# Clonar o repositório
git clone <repo-url> mesafacil
cd mesafacil

# Instalar dependências PHP
composer install

# Copiar .env
cp .env.example .env
php artisan key:generate
```

## 3. Configurar .env para Mesa Fácil

As variáveis essenciais para o modo Mesa Fácil:

```env
APP_NAME="Mesa Fácil"
APP_DESC="Sistema para Restaurantes e Lanchonetes"
APP_LOGO=mesafacil.png
PRODUTO_TIPO=mesafacil

# Módulos ativos para restaurante
DELIVERY=1
PEDIDO_LOCAL=1

# Módulos desativados
EVENTO=0
ECOMMERCE=0
LOCACAO=0
MDFE=0
CTE=0
OS=0
COTACAO=0
```

## 4. Banco de dados

### SQLite (desenvolvimento rápido)
```env
DB_CONNECTION=sqlite
DB_DATABASE=/caminho/absoluto/database/database.sqlite
```
```bash
touch database/database.sqlite
php artisan migrate
```

### MySQL (produção)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mesafacil
DB_USERNAME=root
DB_PASSWORD=sua_senha
```
```bash
php artisan migrate
```

## 5. Seed de demonstração

```bash
# Cria empresa demo, 4 usuários, cardápio, mesas, clientes
php artisan db:seed --class=MesaFacilDemoSeeder
```

## 6. Logo

Coloque o arquivo `mesafacil.png` em `public/imgs/`.  
Size recomendado: 120×40px (navbar) ou 200×60px (login).

## 7. Executar

```bash
php artisan serve
```

Acesse `http://localhost:8000/login`

## 8. Produção

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run prod
```
