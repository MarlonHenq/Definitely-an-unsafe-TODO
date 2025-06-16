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

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="../static/img/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                    A Secure Beautiful TODO
                </a>

                <div class="d-flex ms-auto">
                    <a href="/logout.php"><button class="btn btn-outline-light" type="submit">Logout</button></a>
                </div>
            </div>
        </nav>


        <div class="container my-5">
        <!-- <h1 class="text-center mb-4">A Secure Beautiful TODO</h1> -->

        <!-- Formulário de Adição de Tarefa -->
        <form action="home.php<?= isset($taskToEdit) ? '?id=' . $taskToEdit['id'] : '' ?>" method="POST" id="taskForm" class="mb-4 border p-4 rounded shadow">
            <input type="hidden" name="taskId" value="<?= $taskToEdit ? $taskToEdit['id'] : '' ?>">

            <div class="row g-3">
                <div class="col-md-4">
                    <label for="taskName" class="form-label">Nome da Tarefa</label>
                    <input type="text" id="taskName" name="taskName" class="form-control" required
                        value="<?= $taskToEdit ? htmlspecialchars($taskToEdit['name']) : '' ?>">
                </div>
                <div class="col-md-4">
                    <label for="taskPriority" class="form-label">Prioridade</label>
                    <select id="taskPriority" name="taskPriority" class="form-select" required>
                        <option value="Alta" <?= $taskToEdit && $taskToEdit['priority'] === 'Alta' ? 'selected' : '' ?>>Alta</option>
                        <option value="Média" <?= $taskToEdit && $taskToEdit['priority'] === 'Média' ? 'selected' : '' ?>>Média</option>
                        <option value="Baixa" <?= $taskToEdit && $taskToEdit['priority'] === 'Baixa' ? 'selected' : '' ?>>Baixa</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="taskShare" class="form-label">Compartilhar com a equipe?</label>
                    <select id="taskShare" name="taskShare" class="form-select" required>
                        <option value="false" <?= $taskToEdit && !$taskToEdit['shared'] ? 'selected' : '' ?>>Não</option>
                        <option value="true" <?= $taskToEdit && $taskToEdit['shared'] ? 'selected' : '' ?>>Sim</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="taskDescription" class="form-label">Descrição</label>
                    <textarea id="taskDescription" name="taskDescription" class="form-control" rows="2" required><?= $taskToEdit ? htmlspecialchars($taskToEdit['description']) : '' ?></textarea>
                </div>
                <div class="col-12">
                    <label for="taskLink" class="form-label">Link relacionado (opcional)</label>
                    <input type="url" id="taskLink" name="taskLink" class="form-control"
                        value="<?= $taskToEdit ? htmlspecialchars($taskToEdit['link']) : '' ?>"
                        placeholder="https://exemplo.com">
                </div>
            </div>
            <div class="mt-3 text-end">
                <button type="submit" name="addTask" class="btn btn-primary">
                    <?= $taskToEdit ? 'Atualizar Tarefa' : 'Adicionar Tarefa' ?>
                </button>
            </div>

            <?= $alert_message ? "<div class='alert alert-$alert_type mt-3'>$alert_message</div>" : '' ?>
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
                        <th>Link</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>


                <tbody>
                    <?php if ($teamTasks && $teamTasks->num_rows > 0): ?>
                        <?php while ($task = $teamTasks->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($task['name']) ?></td>
                                <td><?= htmlspecialchars($task['priority']) ?></td>
                                <td><?= htmlspecialchars($task['description']) ?></td>
                                <td class="text-center">
                                    <?php if (!empty($task['link'])): ?>
                                        <a href="redirect.php?link=<?= urlencode($task['link']) ?>" class="btn btn-sm btn-primary" target="_blank">Abrir</a>
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($task['user_id'] == $_SESSION['user_id']): ?>
                                        <a href="home.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($task['user_id'] == $_SESSION['user_id']): ?>
                                        <a href="deleteTask.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">Excluir</a>
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhuma tarefa compartilhada encontrada.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>


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
                        <th>Link</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>


                <tbody>
                    <?php if ($personalTasks && $personalTasks->num_rows > 0): ?>
                        <?php while ($task = $personalTasks->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($task['name']) ?></td>
                                <td><?= htmlspecialchars($task['priority']) ?></td>
                                <td><?= htmlspecialchars($task['description']) ?></td>
                                <td class="text-center">
                                    <?php if (!empty($task['link'])): ?>
                                        <a href="redirect.php?link=<?= urlencode($task['link']) ?>" class="btn btn-sm btn-primary" target="_blank">Abrir</a>
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="home.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                </td>
                                <td class="text-center">
                                    <a href="deleteTask.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Você ainda não adicionou tarefas.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
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
