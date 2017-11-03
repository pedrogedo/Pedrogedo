<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/****************************************************************************************
 * A classe Usuario que extende nosso CI_Controller irá cuidar da comunicação entre os  *
 * nosso Model e nossa View. Em outras palavras controla as ações importantes para que  *
 * haja a comunicação seguindo as praticas do MVC (Model View Controller).              *
 ****************************************************************************************/

class Usuario extends CI_Controller {
    
    /**************************************************************************************** 
     * A função abaixo serve para carregar classes importantes para a nossa utilização sem  *
     * que precisemos carregá-las diretamente na função que será executada, como por exemplo* 
     * o código: $this->load->model('Usuario_model', 'usuario');, onde estamos carregando a *
     * nossa classe Usuario_model apenas uma vez para todos os métodos da classe Usuario.   *
     ****************************************************************************************/
    
    public function __construct() {
        parent::__construct();
        //Carrega a classe Usuario_model e renomeia como usuario para utilizar nas funções abaixo.
        $this->load->model('Usuario_model', 'usuario');  
    }
    
    /******************************************************************************************
     * A função index() tem como objetivo carregar a tela principal de Usuarios. Através da   *
     * função get_usuarios() da Classe Usuario_model que está simplificada como usuario,      *
     * carregamos os dados dos usuários cadastrados no Banco de dados. Nela temos condições   * 
     * para as mensagens de sucesso e de erro de cadastrar, excluir e atualizar.              *
     ******************************************************************************************/
    
    public function index($indice = null) {

        $dados['usuarios'] = $this->usuario->get_usuarios();
        $this->load->view('includes/header_view');
        $this->load->view('includes/menu_view');

        if ($indice == 1) {
            $data['msg'] = "Usuário cadastrado com sucesso.";
            $this->load->view('includes/msg_sucesso_view', $data);
        } else if ($indice == 2) {
            $data['msg'] = "Não foi possível cadastrar o Usuário !";
            $this->load->view('includes/msg_erro_view', $data);
        } else if ($indice == 3) {
            $data['msg'] = "Usuário excluído com sucesso.";
            $this->load->view('includes/msg_sucesso_view', $data);
        } else if ($indice == 4) {
            $data['msg'] = "Não foi possível excluir o Usuário !";
            $this->load->view('includes/msg_erro_view', $data);
        } else if ($indice == 5) {
            $data['msg'] = "Usuário atualizado com sucesso.";
            $this->load->view('includes/msg_sucesso_view', $data);
        } else if ($indice == 6) {
            $data['msg'] = "Não foi possível atualizar o Usuário !";
            $this->load->view('includes/msg_erro_view', $data);
        }
        $this->load->view('listar_usuario_view', $dados);
        $this->load->view('includes/footer_view');
    }
    
    //A função cadastro() tem como objetivo apenas carregar as views da nossa Tela de cadastro.
    public function cadastro() {

        $this->load->view('includes/header_view');
        $this->load->view('includes/menu_view');
        $this->load->view('cadastro_usuario_view');
        $this->load->view('includes/footer_view');
    }
    
    /****************************************************************************************** 
     * A função cadastrar() tem como objetivo fazer o cadastro do usuário no banco de dados   *
     * utilizando um array $data que recebe os dados digitados via post e verifica através da *
     * condição: if ($this->usuario->cadastrar($data)), se foi cadastrado no banco de dados.  *
     * se tiver sido cadastrado, vai redirecionar a mensagem de sucesso: redirect('usuario/1')*   *
     * caso contrário irá apresentar a mensagem de erro: redirect('usuario/2').               *
     ****************************************************************************************/
    
    public function cadastrar() {

        $data['nome'] = $this->input->post('nome');
        $data['cpf'] = $this->input->post('cpf');
        $data['email'] = $this->input->post('email');
        $data['senha'] = md5($this->input->post('senha')); //Utilizamos md5 para criptografia da senha.
        $data['status'] = $this->input->post('status');
        $data['nivel'] = $this->input->post('nivel');

        if ($this->usuario->cadastrar($data)) {
            redirect('usuario/1');
        } else {
            redirect('usuario/2');
        }
    }
    
    /******************************************************************************************** 
     * A função excluir() parte da mesma lógica da função cadastrar(), porém com a diferença de * 
     * que agora será para a remoção do cadastro no banco de dados. Ou seja, temos uma condição *
     * que verifica se o usuário foi excluído com sucesso no banco, se foi va redirecionar para *
     * a mensagem de sucesso: redirect('usuario/3') do contrário redirecionar para a mensagem   *
     * de erro: redirect('usuario/4').                                                          *
     ********************************************************************************************/
    
    public function excluir($id = null) {

        if ($this->usuario->excluir($id)) {
            redirect('usuario/3');
        } else {
            redirect('usuario/4');
        }
    }
    
    /******************************************************************************************* 
     * A função atualizar() tem como objetivo, buscar os dados atuais do usuário registrado no *
     * Banco e e carregar na tela esses dados atuais. Nesta função encontram-se também as      *
     * mensagem de sucesso e de erro que se referem a alteração da senha.                      *
     *******************************************************************************************/
    
    public function atualizar($id = null, $indice = null) {

        $this->db->where('idUsuario', $id);
        $data['usuario'] = $this->db->get('usuario')->result();
        $this->load->view('includes/header_view');
        $this->load->view('includes/menu_view');
        if ($indice == 1) {
            $data['msg'] = "Senha alterada com sucesso.";
            $this->load->view('includes/msg_sucesso_view', $data);
        } else if ($indice == 2) {
            $data['msg'] = "Não foi possível alterar a senha !";
            $this->load->view('includes/msg_erro_view', $data);
        }
        $this->load->view('editar_usuario_view', $data);
        $this->load->view('includes/footer_view');
    }
    
    /******************************************************************************************
     *  A função salvar_atualizacao tem como objetivo atualizar os dados carregados na função *
     * atualizar(). Utiliza a condição: if($this->usuario->salvar_atualizacao($id, $data), ou *
     * seja, se atualizar com sucesso os dados no Banco de dados, vai redirecionar para a     *
     * mensagem de sucesso: redirect('usuario/5'), caso contrário para a mensagem de erro:    *
     * redirect('usuario/6').                                                                 *
     ******************************************************************************************/
    
    public function salvar_atualizacao() {

        $id = $this->input->post('idUsuario');
        $data['nome'] = $this->input->post('nome');
        $data['cpf'] = $this->input->post('cpf');
        $data['email'] = $this->input->post('email');
        $data['status'] = $this->input->post('status');
        $data['nivel'] = $this->input->post('nivel');

        if ($this->usuario->salvar_atualizacao($id, $data)) {
            redirect('usuario/5');
        } else {
            redirect('usuario/6');
        }
    }
    
    /********************************************************************************************
     * A função salvar_senha() tem o mesmo objetivo da função salvar_atualizacao(), porém com   *
     * algumas diferenças. Por se tratar de um campo onde era preciso ser feito as validações   *
     * de senha antiga, nova e confirmação de nova senha, foi criada separada dos outros dados. * 
     * Na condição: if($this->usuario->salvar_senha($id, $senha_antiga, $senha_nova), ele vai   *
     * verificar no Banco de dados se a senha antiga digitada corresponde a mesma digitada pelo *
     * usuário, caso corresponda haverá também um Script que analisará se a senha nova e a sua  *
     * confirmação, são exatamente iguais, caso sejam ele deixa fazer a alteração e teremos a   *
     * mensagem de sucesso: redirect('usuario/atualizar/' . $id . '/1'), do contrário será a    *
     * mensagem de erro: redirect('usuario/atualizar/' . $id . '/2').                           *
     ********************************************************************************************/
    
    public function salvar_senha() {

        $id = $this->input->post('idUsuario');
        $senha_antiga = md5($this->input->post('senha_antiga'));
        $senha_nova = md5($this->input->post('senha_nova'));

        if ($this->usuario->salvar_senha($id, $senha_antiga, $senha_nova)) {
            redirect('usuario/atualizar/' . $id . '/1');
        } else {
            redirect('usuario/atualizar/' . $id . '/2');
        }
    }

}
