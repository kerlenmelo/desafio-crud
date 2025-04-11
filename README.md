# Desafio CRUD de Funcionários com Autenticação

Este projeto é um desafio técnico da empresa **Connecta Tecnologia**. Trata-se de uma aplicação web desenvolvida com **Laravel**, que permite o **cadastro e gerenciamento de funcionários**, com autenticação de usuários via **Laravel Breeze**.

---

## 📸 Demonstração

🚀 Acesse a aplicação publicada:
**https://laravel-crud-kerlen.onrender.com**

## 📋 Funcionalidades Atendidas

### 1. 🔐 Autenticação de Usuário

-   Registro de novo usuário (nome, e-mail e senha).
-   Página de login com validação de e-mail e senha.
-   Apenas usuários autenticados têm acesso ao CRUD de funcionários.
-   Após o login, o usuário é redirecionado para o painel de gerenciamento de funcionários.
-   As senhas são criptografadas.

### 2. 🧑‍💼 CRUD de Funcionários

O sistema permite:

-   Criar um novo funcionário
-   Visualizar todos os funcionários cadastrados
-   Atualizar dados de um funcionário existente
-   Excluir funcionários

### 3. 📝 Campos dos Funcionários

Cada funcionário possui os seguintes campos:

-   Nome
-   CPF
-   Data de nascimento
-   Telefone
-   Gênero

### 4. ✅ Validações

-   CPF: único, obrigatório e validado com formato.
-   Nome e gênero: obrigatórios.
-   Telefone: opcional, mas validado se preenchido.
-   Data de nascimento: opcional, mas deve ser uma data válida.

### 5. 🖥️ Interface

-   Interface clara, responsiva e intuitiva com TailwindCSS.
-   Tela de login e registro de usuários.
-   Tabelas com listagem de funcionários.
-   Formulários de criação e edição bem estruturados.
-   Modais de confirmação para exclusão.

### 6. 🗃️ Banco de Dados

-   Compatível com **SQLite** (padrão).
-   Migrations para criação da tabela de usuários e funcionários incluídas.

---

## 🚀 Tecnologias Utilizadas

-   PHP ^8.1
-   Laravel ^10
-   Laravel Breeze
-   Laravel Lang
-   Livewire Toaster
-   TailwindCSS
-   SQLite
-   Alpine.js

---

## 💻 Requisitos de Ambiente

-   PHP 8.1+
-   Composer
-   Node.js & npm
-   SQLite

---

## ⚙️ Instalação e Configuração

```bash
# Clone o projeto
git clone https://github.com/kerlenmelo/desafio-crud.git
cd desafio-crud

# Instale as dependências
composer install
npm install

# Configure o ambiente
cp .env.example .env
php artisan key:generate

# Configure o banco:
touch database/database.sqlite

# Rode as migrations
php artisan migrate

# Compile os assets
npm run build

# Rode a aplicação
php artisan serve
```

Acesse via: [http://localhost:8000](http://localhost:8000)

---

## 📂 Estrutura Relevante

```
├── app/Http/Controllers/
│   └── FuncionarioController.php
├── resources/views/funcionario/
│   ├── create.blade.php
│   ├── edit.blade.php
│   ├── index.blade.php
│   └── show.blade.php
├── database/migrations/
```

---

## 🧑‍💼 Autor

Desenvolvido por **Kerlen Melo**  
📧 kerlen_1@hotmail.com  
LinkedIn: [LinkedIn](https://www.linkedin.com/in/kerlenmelo/)

Repositório: [https://github.com/kerlenmelo/desafio-crud](https://github.com/kerlenmelo/desafio-crud)

---
