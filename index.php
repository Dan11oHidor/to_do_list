<!-- conexão com o banco de dados -->

<?php
require_once ('database/conn2.php');

$database = new database();

$sql = 'SELECT id, descricao, completed FROM  task ORDER BY :order ASC';

$task = $database->query($sql, ['order' => 'tarefa']);


?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="src/styles/style.css">
    <title>Lista de Tarefas</title>
</head>
<body>
    <div id="to_do">

        <h1>Lista de Tarefas</h1>

        <!-- Formulário de Seleção de Status -->
         <form action="index.php" method="GET" class="form-status">
            <select name="status" onchange="this.form.submit()" class="form-status-select">
                <option value="all" <?= !isset($_GET['status']) || $_GET['status'] == 'all' ? 'selected' : '' ?>>Todos</option>
                <option value="pending" <?= isset($_GET['status']) && $_GET['status'] == 'pending' ? 'selected' : '' ?>>Pendente</option>
                <option value="completed" <?= isset($_GET['status']) && $_GET['status'] == 'completed' ? 'selected' : '' ?>>Concluída</option>7
                
            </select>
        </form>

        <!-- adicionar tarefa -->
        <form action="actions/create.php" method="POST" class="form">
            <input type="text" name="titulo" placeholder="Título da tarefa" class="form-titulo" required>
            <input type="text" name="descricao" placeholder="Adicione uma tarefa" required>
            <button type="submit" class="form-button">
                <i class="fa-solid fa-plus"></i>
            </button>
        </form>

        <!-- Lista de tarefas -->
        <div id="tasks">

            <?php
            require_once ('database/conn2.php');

            $db = new Database();
            $pdo = $db->getPdo();

            // Filtra as tarefas com base no status selecionado
            $status = isset($_GET['status']) ? $_GET['status'] : 'all';
            $sql = 'SELECT id, titulo, descricao, completed FROM task';
            
            if ($status == 'pending') {
                $sql .= ' WHERE completed = 0';
            } elseif ($status == 'completed') {
                $sql .= ' WHERE completed = 1';
            }

            $sql .= ' ORDER BY id DESC';
            $task = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($task as $task):
            ?>
                
            <!-- Tarefa --> 
            <div class="task">
                <div class="tarefa-check"><input 
                    type="checkbox" 
                    name="progress" 
                    class="progress <?= $task['completed'] ? 'done' : '' ?>" 
                    data-task-id="<?= $task['id'] ?>"
                    <?= $task['completed'] ? 'checked' : '' ?>
                ></div>
                <div class="tarefa-conteudo">
                    <p class="tarefa-titulo">
                    <?= htmlspecialchars($task['titulo']) ?>
                </p>
                
                <p class="tarefa-descricao">
                    <?= htmlspecialchars($task['descricao']) ?>
                </p>
            </div>

        <!-- Ações da tarefa - Editar e Excluir -->
                <div class="tarefa-acoes">
                    <a  class=" button-acoes button-edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>

                    <a href="actions/delete.php?id=<?= $task['id'] ?>" class=" button-acoes button-delete">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </div>

        <!-- Formulário de edição - hidden/escondido -->
        <form action="actions/update.php" method="POST" class="form edit-task hidden">
            <input type="hidden" name="id" value="<?= $task['id']?>" class="form-id hidden">
            <input type="text" name="titulo" placeholder="Título da tarefa" value="<?= $task['titulo'] ?>" class="form-titulo">
            <input type="text" name="descricao" placeholder="Adicione uma tarefa" value="<?= $task['descricao'] ?>" class="tarefa-descricao">
            <button type="submit" class="form-button confirm-button">
                <i class="fa-solid fa-check"></i>
            </button>
        </form>
    </form>
</div>
<?php endforeach; ?>
</div>
</div>

    <!-- incluindo JavaScript -->
    <script src="src/javascript/script.js"></script>


</body>
</html>
