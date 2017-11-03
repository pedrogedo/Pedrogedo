
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <div class="col-md-12">  
        <h1>Atualizar Usuário</h1>
    </div>
    <div class="col-md-12">
        <form class="form-control" action="<?= base_url() ?>usuario/salvar_atualizacao" method="post">
            <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $usuario[0]->idUsuario; ?>">    
            <div class="form-group">
                <label for="Nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe seu nome..." value="<?= $usuario[0]->nome; ?>">
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Informe o seu CPF..." value="<?= $usuario[0]->cpf; ?>">
            </div>
            <div> 

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Informe o seu E-mail..." value="<?= $usuario[0]->email; ?>">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">                           
                        <div class="form-group">
                            <label for="senha">Senha: </label>
                            <input type="button" class="btn btn-secondary btn-block" value="Atualizar Senha" data-toggle="modal" data-target="#exampleModal">
                        </div> 
                    </div>

                    <div class="col-md-2">
                        <label for="status">Status:</label>
                        <select id="status" name="status" class="form-control" value="<?= $usuario[0]->status; ?>">
                            <option value="0"> --- </option>
                            <option value="1" <?= $usuario[0]->status == 1 ? 'selected' : ''; ?>> Ativo </option>
                            <option value="2" <?= $usuario[0]->status == 2 ? 'selected' : ''; ?>> Inativo </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="nivel">Nível:</label>
                        <select id="nivel" name="nivel" class="form-control">
                            <option value="0"> --- </option>
                            <option value="1" <?= $usuario[0]->nivel == 1 ? 'selected' : ''; ?>> Administrador </option>
                            <option value="2" <?= $usuario[0]->nivel == 2 ? 'selected' : ''; ?>> Usuário </option>
                        </select>
                    </div> 
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="<?= base_url() ?>usuario" class="btn btn-danger">Cancelar</a>
        </form>
    </div> 
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url() ?>usuario/salvar_senha" method="post">
            <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $usuario[0]->idUsuario; ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atualizar Senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for='senha_antiga'>Senha antiga:</label>
                            <input type="password" name="senha_antiga" id="senha_antiga" class="form-control">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for='senha_nova'>Nova Senha:</label>
                            <input type="password" name="senha_nova" id="senha_nova" onkeyup="checarSenha()" class="form-control">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for='senha_confirmar'>Confirmar Senha:</label>
                            <input type="password" name="senha_confirmar" id="senha_confirmar" onkeyup="checarSenha()" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <div id="divcheck">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" id="enviarsenha" disabled>Salvar</button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- O Script abaixo está encarregado de verificar se a nova senha digitada e a 
confirmação da senha, são exatamente iguais. -->
<script>
    $(document).ready(function () {
        $("#senha_nova").keyup(checkPasswordMatch);
        $("#senha_confirmar").keyup(checkPasswordMatch);
    });

    function checarSenha() {
        var novaSenha = $("#senha_nova").val();
        var confirmarSenha = $("#senha_confirmar").val();

        if (novaSenha == '' || '' == confirmarSenha) {
            $("#divcheck").html("<span style='color: red'>Campo de senha vazio!</span>");
            document.getElementById("enviarsenha").disabled = true;
        } else if (novaSenha != confirmarSenha) {
            $("#divcheck").html("<span style='color: red'>Senhas não conferem!</span>");
            document.getElementById("enviarsenha").disabled = true;
        } else {
            $("#divcheck").html("<span style='color: green'>Senhas iguais!</span>");
            document.getElementById("enviarsenha").disabled = false;
        }
    }
</script>