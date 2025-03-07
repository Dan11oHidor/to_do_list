document.addEventListener("DOMContentLoaded", function () {
    // Adiciona evento de clique para todos os botões de edição
    document.querySelectorAll(".button-edit").forEach(function (button) {
        button.addEventListener("click", function () {
            var tarefa = this.closest(".task");
            tarefa.querySelector(".progress").classList.add("hidden");
            tarefa.querySelector(".tarefa-acoes").classList.add("hidden");
            tarefa.querySelector(".tarefa-titulo").classList.add("hidden");
            tarefa.querySelector(".tarefa-descricao").classList.add("hidden");
            tarefa.querySelector(".form.edit-task").classList.remove("hidden");
        });
    });

    // Adiciona evento de clique para todos os checkboxes de progresso
    document.querySelectorAll(".progress").forEach(function (progress) {
        progress.addEventListener("click", function () {
            if (this.checked) {
                this.classList.add("done");
            } else {
                this.classList.remove("done");
            }
        });

        document.querySelectorAll('.progress').forEach(function (checkbox) {
            checkbox.addEventListener('click', function () {
                const id = this.getAttribute('data-task-id');
                const completed = this.checked ? 1 : 0;

                fetch('actions/update-progress.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({ id: id, completed: completed })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Erro ao atualizar a tarefa');
                    }
                })
                .catch(() => {
                    alert('Erro ao atualizar a tarefa');
                });
            });
        });
    });

    // Adiciona evento de confirmação ao formulário de edição
    document.querySelectorAll('.edit-task').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!confirm('Tem certeza de que deseja salvar as alterações?')) {
                event.preventDefault();
            }
        });
    });

    // Adiciona evento de confirmação ao botão de exclusão
    document.querySelectorAll('.button-delete').forEach(function (button) {
        button.addEventListener('click', function (event) {
            if (!confirm('Tem certeza de que deseja excluir esta tarefa?')) {
                event.preventDefault();
            }
        });
    });

    // Adiciona evento de clique ao ícone de filtro para abrir o menu de seleção
    document.getElementById('filter-icon').addEventListener('click', function () {
        document.querySelector('.form-status-select').focus();
    });
});