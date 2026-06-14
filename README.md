<h1 align="center">
  📚 Biblioteca Clarice Lispector
</h1>

<p align="center">
  <em>Sistema web de gerenciamento de empréstimos de livros</em><br>
  <em>Web-based library loan management system</em>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white"/>
  <img src="https://img.shields.io/badge/Bootstrap-4.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white"/>
  <img src="https://img.shields.io/badge/PDO-Prepared_Statements-green?style=for-the-badge"/>
</p>

<p align="center">
  <a href="#português">🇧🇷 Português</a> &nbsp;|&nbsp;
  <a href="#english">🇺🇸 English</a>
</p>

---

<h2 id="português">🇧🇷 Português</h2>

### Sobre o projeto

O **Biblioteca Clarice Lispector** é uma aplicação web desenvolvida como projeto da segunda unidade do componente curricular **Web II** no **IFPE – Campus Afogados da Ingazeira**. O sistema permite o gerenciamento de empréstimos de livros, com controle de acesso por perfil de usuário, histórico de empréstimos e devolução de obras.

O projeto recebe o nome em homenagem à escritora Clarice Lispector, cujo acervo compõe o catálogo inicial da biblioteca fictícia.

---

### ✨ Funcionalidades

- 🔐 **Autenticação de usuários** com controle de sessão PHP
- 📖 **Catálogo de livros** com status de disponibilidade em tempo real
- 🔄 **Empréstimo e devolução** de obras com registro de datas
- 🗂️ **Histórico pessoal** de empréstimos por usuário
- 🎨 **Interface responsiva** com sidebar, navbar e player de música
- 🛡️ **Proteção de rotas** — páginas internas inacessíveis sem login

---

### 🏗️ Arquitetura e tecnologias

| Camada | Tecnologia |
|---|---|
| Back-end | PHP 8 (OOP) |
| Banco de dados | MySQL via PDO |
| Front-end | HTML5, CSS3, Bootstrap 4 |
| Interatividade | JavaScript (vanilla) |
| Estilo | CSS customizado com variáveis de tema |

#### Estrutura de classes

```
Auth              → gerenciamento de sessão e autenticação
Biblioteca        → operações do acervo (herda traits)
├── AcoesEmprestimo  (trait) → pegarEmprestado(), devolver()
└── ConsultaAcervo   (trait) → getLivros(), getHistorico()
```

#### Banco de dados

```sql
usuarios      → id, nome, usuario, senha, perfil
livros        → id, titulo, autor, disponivel
emprestimos   → id, usuario_id, livro_id, data_emprestimo, data_devolucao
```

---

### 🗂️ Estrutura de arquivos

```
📁 projeto/
├── index.html              # Página inicial pública
├── login.php               # Tela de autenticação
├── validalogin.php         # Processamento do login
├── validasessao.php        # Guard de sessão (incluído nas páginas protegidas)
├── livros.php              # Catálogo do acervo
├── historico.php           # Histórico de empréstimos do usuário
├── processa_emprestimo.php # Controller do empréstimo
├── processa_devolucao.php  # Controller da devolução
├── sair.php                # Logout
├── menu.php                # Navbar e sidebar (componente reutilizável)
├── conexao.php             # Configuração e conexão PDO
├── classes.php             # Auth, Biblioteca, traits
├── style.css               # Estilos globais
├── script.js               # Sidebar, player de música
└── banco.sql               # Script de criação e seed do banco
```

---

### 🚀 Como rodar localmente

**Pré-requisitos:** PHP 8+, MySQL 8+, servidor local (XAMPP, Laragon, etc.)

```bash
# 1. Clone o repositório
git clone https://github.com/seu-usuario/biblioteca-clarice-lispector.git

# 2. Importe o banco de dados
mysql -u root -p < banco.sql

# 3. Ajuste a conexão em conexao.php
$host = '127.0.0.1:3306';  # porta padrão do MySQL
$user = 'root';
$pass = 'sua_senha';

# 4. Coloque a pasta no diretório do servidor (ex: htdocs no XAMPP)
# 5. Acesse http://localhost/biblioteca-clarice-lispector
```

**Usuários de teste disponíveis:**

| Usuário | Senha | Perfil |
|---|---|---|
| `lazaro` | `lazaro123` | Bibliotecário |
| `lairson` | `lairson123` | Professor |
| `elizabete` | `elizabete123` | Aluna |

---

### 🔒 Segurança

- Todas as queries utilizam **prepared statements (PDO)** para prevenção de SQL Injection
- Saídas no HTML são sanitizadas com `htmlspecialchars()` para prevenção de XSS
- Páginas protegidas verificam sessão ativa via `validasessao.php`

> ⚠️ **Aviso:** as senhas estão armazenadas em texto puro neste projeto acadêmico. Em produção, utilize `password_hash()` e `password_verify()`.

---

<h2 id="english">🇺🇸 English</h2>

### About

**Biblioteca Clarice Lispector** is a web application developed as the second-unit project for the **Web II** course at **IFPE – Campus Afogados da Ingazeira**. The system handles library loan management, featuring role-based access control, borrowing history, and book returns.

The project is named in honour of the Brazilian writer Clarice Lispector, whose works make up the initial catalogue of the fictional library.

---

### ✨ Features

- 🔐 **User authentication** with PHP session management
- 📖 **Book catalogue** with real-time availability status
- 🔄 **Borrow and return** workflow with timestamped records
- 🗂️ **Personal loan history** per user
- 🎨 **Responsive UI** with sidebar, navbar, and music player
- 🛡️ **Route protection** — internal pages are inaccessible without an active session

---

### 🏗️ Architecture & technologies

| Layer | Technology |
|---|---|
| Back-end | PHP 8 (OOP) |
| Database | MySQL via PDO |
| Front-end | HTML5, CSS3, Bootstrap 4 |
| Interactivity | Vanilla JavaScript |
| Styling | Custom CSS with theme variables |

#### Class structure

```
Auth              → session management & authentication
Biblioteca        → collection operations (uses traits)
├── AcoesEmprestimo  (trait) → pegarEmprestado(), devolver()
└── ConsultaAcervo   (trait) → getLivros(), getHistorico()
```

#### Database schema

```sql
usuarios      → id, nome, usuario, senha, perfil
livros        → id, titulo, autor, disponivel
emprestimos   → id, usuario_id, livro_id, data_emprestimo, data_devolucao
```

---

### 🗂️ File structure

```
📁 project/
├── index.html              # Public landing page
├── login.php               # Authentication screen
├── validalogin.php         # Login processor
├── validasessao.php        # Session guard (included in protected pages)
├── livros.php              # Book catalogue
├── historico.php           # User loan history
├── processa_emprestimo.php # Borrow controller
├── processa_devolucao.php  # Return controller
├── sair.php                # Logout
├── menu.php                # Navbar & sidebar (reusable component)
├── conexao.php             # PDO connection config
├── classes.php             # Auth, Biblioteca, traits
├── style.css               # Global styles
├── script.js               # Sidebar toggle, music player
└── banco.sql               # Database creation & seed script
```

---

### 🚀 Running locally

**Requirements:** PHP 8+, MySQL 8+, local server (XAMPP, Laragon, etc.)

```bash
# 1. Clone the repository
git clone https://github.com/your-username/biblioteca-clarice-lispector.git

# 2. Import the database
mysql -u root -p < banco.sql

# 3. Adjust the connection in conexao.php
$host = '127.0.0.1:3306';  # default MySQL port
$user = 'root';
$pass = 'your_password';

# 4. Place the folder in your server's root (e.g. htdocs in XAMPP)
# 5. Access http://localhost/biblioteca-clarice-lispector
```

**Test accounts:**

| Username | Password | Role |
|---|---|---|
| `lazaro` | `lazaro123` | Librarian |
| `lairson` | `lairson123` | Professor |
| `elizabete` | `elizabete123` | Student |

---

### 🔒 Security

- All queries use **PDO prepared statements** to prevent SQL Injection
- HTML output is sanitised with `htmlspecialchars()` to prevent XSS
- Protected pages verify an active session via `validasessao.php`

> ⚠️ **Note:** passwords are stored in plain text in this academic project. In production, use `password_hash()` and `password_verify()`.

---

<p align="center">
  Desenvolvido por alunos do IFPE – Campus Afogados da Ingazeira &nbsp;•&nbsp;
  Web II · 2025
</p>
