
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <div class="col-md-10">  
        <h1>Usuários</h1>
    </div>

    <div class="col-md-2">
        <a class="btn btn-primary" href="<?= base_url() ?>usuario/cadastro">Novo Cadastro</a> 
    </div>

    <div class="col-md-12">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Status</th>
                <th>Nível</th>
                <th></th>
                <th></th>
            </tr>

            <?php foreach ($usuarios as $usu) { ?>
                <tr>
                    <td><?= $usu->idUsuario; ?></td>
                    <td><?= $usu->nome; ?></td>
                    <td><?= $usu->email; ?></td>
                    <td><?= $usu->status; ?></td>
                    <td><?= $usu->nivel; ?></td>
                    <td>
                        <a href="<?= base_url('usuario/atualizar/' . $usu->idUsuario) ?>" class="btn btn-primary">Atualizar</a>
                        <a href="<?= base_url('usuario/excluir/' . $usu->idUsuario) ?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir o usuário ?');">Remover</a>
                    </td>    
                </tr>
            <?php } ?>
        </table>
    </div>   
</main>
