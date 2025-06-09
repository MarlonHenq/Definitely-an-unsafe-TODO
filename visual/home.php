<!doctype html>
<html lang="en">
    <head>
        <title>A Secure Beautiful TODO</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Favicon -->
        <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <link rel="stylesheet" href="../static/css/style.css" />
    </head>

    <body>

        <div class="container my-5">
        <h1 class="text-center mb-4">A Secure Beautiful TODO</h1>

        <!-- Formulário de Adição de Tarefa -->
        <form id="taskForm" class="mb-4 border p-4 rounded shadow">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="taskName" class="form-label">Nome da Tarefa</label>
                    <input type="text" id="taskName" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="taskPriority" class="form-label">Prioridade</label>
                    <select id="taskPriority" class="form-select" required>
                        <option value="Alta">Alta</option>
                        <option value="Média">Média</option>
                        <option value="Baixa">Baixa</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="taskShare" class="form-label">Compartilhar com a equipe?</label>
                    <select id="taskShare" class="form-select" required>
                        <option value="false">Não</option>
                        <option value="true">Sim</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="taskDescription" class="form-label">Descrição</label>
                    <textarea id="taskDescription" class="form-control" rows="2" required></textarea>
                </div>
                <div class="col-12">
                    <label for="taskLink" class="form-label">Link relacionado (opcional)</label>
                    <input type="url" id="taskLink" class="form-control" placeholder="https://exemplo.com">
                </div>

            </div>
            <div class="mt-3 text-end">
                <button type="submit" class="btn btn-primary">Adicionar Tarefa</button>
            </div>
        </form>

        <!-- Tabelas de Tarefas -->
        <div class="row">
            <!-- Tarefas da Equipe -->
            <div class="col-md-6">
                <h3 class="text-center">Tarefas da Equipe</h3>
                <table class="table table-striped table-bordered" id="teamTasks">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th>Prioridade</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <!-- Tarefas Pessoais -->
            <div class="col-md-6">
                <h3 class="text-center">Minhas Tarefas</h3>
                <table class="table table-striped table-bordered" id="personalTasks">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th>Prioridade</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
            
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
