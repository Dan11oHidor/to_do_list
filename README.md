﻿# Lista de Tarefas

Esta é uma aplicação de lista de tarefas construída com PHP, MySQL, HTML, CSS, JavaScript.

## Pré-requisitos

- PHP >= 7.4
- MySQL
- Servidor Web (Apache 3.3.0)

## Instalação

### Passos para Instalação

1. **Clone o repositório:**
    ```sh
    git clone https://github.com/Dan11oHidor/to_do_list.git
    cd to_do_list
    ```


2. **Configure o banco de dados:**
    - Crie um banco de dados no MySQL.
    - Especificações do Banco de Dados:
  
        ```sh
                CREATE TABLE `task` (
                   `id` int(11) NOT NULL,
                   `titulo` varchar(255) NOT NULL,
                   `descricao` text DEFAULT NULL,
                   `completed` tinyint(1) DEFAULT NULL
                   )
        ```


3. **Configure o arquivo de conexão com o banco de dados (`database/conn2.php`):**
    ```php
    <?php
    class Database {
        private $host = 'localhost';
        private $db_name = 'seu-banco-de-dados';
        private $username = 'seu-usuario';
        private $password = 'sua-senha';
        public $conn;

        public function getPdo() {
            $this->conn = null;
            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            } catch(PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }
    ```

4. **Inicie o servidor web:**
    ```sh
    php -S localhost:8000
    ```

5. **Acesse a aplicação no navegador:**
    ```
    http://localhost:8000
    ```

## Uso

- Adicione novas tarefas preenchendo o formulário e clicando no botão de adicionar.
- Edite ou exclua tarefas existentes usando os botões de ação ao lado de cada tarefa.

## Estrutura do Projeto
