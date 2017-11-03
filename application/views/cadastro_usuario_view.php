
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <div class="col-md-12">  
        <h1>Novo Usuário</h1>
    </div>
    <div class="col-md-12">
        <form class="form-control" action="<?= base_url() ?>usuario/cadastrar" method="post">
            <div class="form-group">
                <label for="Nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe seu nome...">
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Informe o seu CPF...">
            </div>
            <div> 

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Informe o seu E-mail...">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">                           
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe a Senha...">
                        </div> 
                    </div>

                    <div class="col-md-2">
                        <label for="status">Status:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="0"> --- </option>
                            <option value="1"> Ativo </option>
                            <option value="2"> Inativo </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="nivel">Nível:</label>
                        <select id="nivel" name="nivel" class="form-control">
                            <option value="0"> --- </option>
                            <option value="1"> Administrador </option>
                            <option value="2"> Usuário </option>
                        </select>
                    </div> 
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>

        </form>
    </div> 

</main>
</div>
</div>