<?php

/***********************************************************************************************
 * A classe Usuario_model cuidará da parte de comunicação e manipulação do Banco de dados.     * 
 * Nela se encontram funções importantes tais como: select, insert, update e delete.           *
 **********************************************************************************************/         

class Usuario_model extends CI_Model {

    /*******************************************************************************************
     * A função get_usuarios() tem como objetivo selecionar os usuário cadastrados no Banco    *
     *e e mostrar o seu resultado na tela para visualização do usuário.                        *
     *******************************************************************************************/ 
    
    function get_usuarios() {
        $this->db->select('*');
        return $this->db->get('usuario')->result();
    }
    
    /* ******************************************************************************************
     * A função cadastrar() tem como objetivo fazer a inserção dos dados digitados pelo usuário *
     * na hora de realizar um novo cadastro, e no Banco de dados através da função insert() do  *
     * CodeIgniter. dentro desta função temos $data que irá receber um array com as informações *
     * a serem inseridas no Banco, e usuario é a tabela na qual será inserido.                  *
     ********************************************************************************************/
    
    public function cadastrar($data) {

        return $this->db->insert('usuario', $data);
    }
    
    /* ******************************************************************************************
     * A função excluir() irá realizar a remoção do cadastro de um usuário escolhido de acordo  *
     * com o seu id de usuário. Através do trecho de código: $this->db->where('idUsuario', $id) *
     * buscamos no Banco o idUsuario correspondente ao digitado pelo usuário passado para $id,  *
     * depois utilizamos a função delete() do CodeIgniter para fazer a remoção do cadastro no   *
     * Banco de Dados.                                                                           *
     *******************************************************************************************/
    
    public function excluir($id = null) {

        $this->db->where('idUsuario', $id);
        return $this->db->delete('usuario');
    }
    
    /*******************************************************************************************
     * A função salvar_atualizacao, também utilizará a clásula where para buscar no banco o id *
     * correspondente ao usuário que será atualizado. Assim como o insert utilizara um array   *
     * $data para pegar os novos dados digitados pelo usuário e atualizar no banco de dados,   *
     * através da função update() do CodeIgniter.                                              *
     *******************************************************************************************/
    
    public function salvar_atualizacao($id, $data) {

        $this->db->where('idUsuario', $id);
        return $this->db->update('usuario', $data);
    }
    
    /*****************************************************************************************
     * A função salvar_senha() tem como objetivo fazer a atualização da senha, porém fazendo *
     * uma verificação antes, para ter certeza de que a senha antiga digitada corresponde    *
     * à mesma cadastrada no banco de dados.                                                 *
     *****************************************************************************************/
    
    public function salvar_senha($id, $senha_antiga, $senha_nova) {

        $this->db->select('senha');
        $this->db->where('idUsuario', $id);
        $data['senha'] = $this->db->get('usuario')->result();
        $dados['senha'] = $senha_nova;

        if ($data['senha'][0]->senha == $senha_antiga) {
            $this->db->where('idUsuario', $id);
            $this->db->update('usuario', $dados);
            return true;
        } else {
            return false;
        }
    }

}
