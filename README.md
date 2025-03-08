# Lista de Tarefas

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

    // conexão com o banco de dados
    class Database {
        private string $host;
        private string $database;
        private string $user;
        private string $password;

        private PDO $pdo;
        public function __construct() {
            $this->host = 'localhost';
            $this->database = 'to_do_list';
            $this->user = 'root';
            $this->password = '';

            $this->connect();
        }

    

        private function connect() {
            try {
                $str = sprintf('mysql:host=%s;dbname=%s', $this->host, $this->database);
    
                $this->pdo = new PDO($str, $this->user, $this->password);
    
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {
                print_r($ex->getMessage());
                die();
            }
        }

        public function query(string $str, array $params)
        {
            $stmt = $this->pdo->prepare($str);

            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function getPdo(): PDO {
            return $this->pdo;
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
