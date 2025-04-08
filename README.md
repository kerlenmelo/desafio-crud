# Desafio CRUD de Funcionários com Autenticação

Este projeto é um desafio técnico da empresa Connecta Tecnologia. E se trata de um projeto **cadastro e gerenciamento de funcionários**, desenvolvido com o framework **Laravel 10** e utiliza o **Laravel Breeze** como starter kit de autenticação.

---

## 📋 Funcionalidades

- Autenticação de usuários (login, registro, logout)
- Redirecionamento para o painel após login
- CRUD completo de funcionários:
  - Cadastro
  - Listagem
  - Edição
  - Visualização detalhada
  - Exclusão com confirmação via modal
- Validações de dados com mensagens em **português brasileiro**
- Layout responsivo com **Tailwind CSS**

---

## 🚀 Tecnologias

- PHP ^8.1
- Laravel ^10
- Laravel Breeze
- TailwindCSS
- SQLite (ou MySQL)
- Laravel Lang (para tradução de mensagens)

---

## 💻 Requisitos

Certifique-se de ter os seguintes softwares instalados:

- [PHP 8.1+](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) e [npm](https://www.npmjs.com/)
- Banco de dados **SQLite** (recomendado) ou **MySQL**

---

## ⚙️ Instalação e Configuração

Siga os passos abaixo para rodar a aplicação localmente:

### 1. Clone o projeto

```bash
git clone https://github.com/kerlenmelo/desafio-crud.git
cd desafio-crud
```

### 2. Instale as dependências do PHP e JavaScript

```bash
composer install
npm install
```

### 3. Crie o arquivo `.env`

```bash
cp .env.example .env
```

### 4. Gere a chave da aplicação

```bash
php artisan key:generate
```

### 5. Configure o banco de dados

#### Opção 1: SQLite (mais simples)

```bash
touch database/database.sqlite
```

No arquivo `.env`, configure:

```env
DB_CONNECTION=sqlite
DB_DATABASE=${absolute_path}/database/database.sqlite
```

#### Opção 2: MySQL (alternativo)

Configure no `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 6. Execute as migrations

```bash
php artisan migrate
```

### 7. Compile os assets

```bash
npm run build
```

### 8. Rode a aplicação

```bash
php artisan serve
```

Acesse [http://localhost:8000](http://localhost:8000)

---

## 🌐 Idioma da Aplicação

A aplicação utiliza mensagens de validação em **pt-BR**, com auxílio do pacote:

```bash
composer require laravel-lang/common
php artisan lang:add pt_BR
```

---

## 🧪 Usuário

Você pode registrar um novo usuário. Após login, será redirecionado automaticamente para o gerenciamento de funcionários.

---

## 📂 Estrutura de Pastas Relevantes

```
├── app/Http/Controllers/
│   └── FuncionarioController.php
├── app/Rules/
│   └── Cpf.php
├── resources/views/funcionario/
│   ├── create.blade.php
│   ├── edit.blade.php
│   ├── index.blade.php
│   └── show.blade.php
├── database/migrations/
│   └── create_funcionarios_table.php
```

---

## 📌 Considerações

- As **senhas dos usuários são criptografadas**.
- A autenticação e middleware protegem o acesso ao CRUD.
- As validações são feitas no backend e frontend com mensagens claras.
- CPF e telefone aceitam apenas entradas válidas e no formato correto.

---

## 🧑‍💻 Autor

Desenvolvido por **Kerlen Melo** 💼  
Contato: kerlen_1@hotmail.com
[LinkedIn:](https://www.linkedin.com/in/kerlenmelo/)
---
