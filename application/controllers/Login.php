<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cookie_model', 'cookie');
        $this->load->model('Login_model', 'login');
        $this->load->model('Usuario_model', 'usuario');
        $this->load->model('Recuperarsenha_model', 'recuperar');
        $this->load->model('Pagina_model', 'pagina');
        $this->load->model('Grupo_model', 'grupo');
        
        $this->load->helper('cookie');
        $this->load->library('session');
    }

    public function index() {
        
        // VALIDATION RULES
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('lembra', 'Lembra');

        $usuario = $this->input->post('username');
        $senha = md5($this->input->post('password'));

        if ($usuario == null) {
            $res = false;
        }
        else {
            $res = $this->login->exibirLoginByInput($usuario, $senha);
        }



        $this->consultaCookie();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/login_view');
        }
        else {

            if ($res) { 

                $id_user = $this->usuario->exibirUsuarioByLogin($res->login_id_login);

                
                $grupo_user = $this->grupo->exibirGrupoByIdUsuario($id_user[0]->usuario_id_usuario);
                $grupo = $grupo_user->gp_id_gp;

                $pagina = $this->pagina->exibirPaginaById($res->login_id_pags);


                if($grupo_user->gp_id_gp != 4)
                {

                    $pags = $grupo_user->gp_id_pags;


                }
                else
                {
                    $pags = $res->login_pags;


                }
                

                $this->load->library('Menu', '', 'menu_libary');
                $this->menu_libary->setPags($pags);
                $this->menu_libary->gerarMenu($pagina->pags_nome);

                $this->criarSessao($res->login_id_login, $id_user[0]->usuario_id_usuario, $grupo, $this->input->post('username'), $pags);

                if ($this->input->post('lembra') == 1) {
                    $this->lembrar($res);
                }

                redirect($pagina->pags_nome);
            }
            else {
                redirect('erro_login');
            }
        }
    }

    public function consultaCookie(){
        if (get_cookie('3e680fc2dd7cb7ab7b84f37ced2b27dc') != null) {
            $cookie = get_cookie('3e680fc2dd7cb7ab7b84f37ced2b27dc');

            $id = str_replace('l', '', strrchr( $cookie, 'l' ));

            $res = $this->login->exibirUsuarioById($id);

            $usuario = $res[0]->login_usuario;
            $nivel = $this->usuario->exibirNivelById($id);

            $this->criarSessao($id, $usuario, $nivel);
            $this->redireciona();
            exit();
        }
    }

    /**
     * Inicializa a sessao
     * @param int $id 
     * @param string $usuario 
     * @param string $nivel
     */
    public function criarSessao($id_login, $id_user, $grupo, $usuario, $paginas) {
        $data = array(
            'id_login' => $id_login,
            'id_usuario' => $id_user,
            'grupo' => $grupo,
            'usuario' => $usuario,
            'paginas' => $paginas,
            'logado' => true
        );

        
  
        $res = $this->session->set_userdata($data);
    }

    /**
     * 
     * @param int $id
     */
    public function lembrar($id) {

        $caracter = strlen($id);

        $tam_total = 21;

        $tam_rand = $tam_total - $caracter;

        if ( ($tam_rand % 4) == 0 ) {
            $cook = $this->random(4 , $tam_rand, $id);
        }
        else if ( ($tam_rand % 3) == 0 ) {
            $cook = $this->random(3 , $tam_rand, $id);
        }
        else if ( ($tam_rand % 2) == 0 ) {
            $cook = $this->random(2 , $tam_rand, $id);
        }
        else {
            $res = ($tam_rand / 2) - 1;

            $res2 = ($tam_rand / 2);

            $cook = rand(substr(111111111111, -$res), substr(999999999999, -$res));
            $cook .= "l";
            $cook .= rand(substr(111111111111, -$res2), substr(999999999999, -$res2));
            $cook .= "l";
            $cook .= $id;
        }

        $cookie = array(
                   'name'   => '3e680fc2dd7cb7ab7b84f37ced2b27dc',
                   'value'  => $cook,
                   'expire' => '604800', 
               ); //7 dias
        
        date_default_timezone_set('America/Sao_Paulo');

        $data_expira = strftime("%Y-%m-%d %H:%M:%S", mktime(date("H"), date("i"), date("s"), date("m"), date("d")+7, date("Y")));

        $this->input->set_cookie($cookie);

        $this->cookie->inserirCookie($id, $cook, $data_expira);
    }

    public function random($n_rande, $tam_rand, $id) {
        $comeco = 111111111111;
        $fim = 999999999999;
        $cook = "";

        $res = ($tam_rand / $n_rande) - 1;

        $rands = 1;
        while ($rands <= $n_rande) {
            $cook .=  rand(substr($comeco, -$res), substr($fim, -$res));
            $cook .= "l";
            $rands++;
        }
        $cook .= "$id";

        return $cook;
    }

    public function sair() {
        $this->session->sess_destroy();
        delete_cookie('3e680fc2dd7cb7ab7b84f37ced2b27dc');
        redirect('Login');
    }

    public function recuperar() {

         $usuarioEmail = $this->input->post('emailusername');

        if ($usuarioEmail == null) {
            $res = false;
        }
        else {
            $res = $this->login->recuperarSenhaByUsuarioEmail($usuarioEmail);
        }

        if($res)
        {

            $this->load->helper('date');
            $datestring = '%Y-%m-%d %H:%i:%s';
            $time = now();
            $timezone  = 'UM3';
            $daylight_saving = false;
            $t = gmt_to_local($time, $timezone, $daylight_saving);
            $datahora =  mdate($datestring, $t);

            $chave = md5($res->usuario_id_usuario . $res->usuario_nome . $res->usuario_email . $datahora);
            
            $recuperar = array(
                   'rec_id_usuario'   => $res->usuario_id_usuario,
                   'rec_chave'  => $chave,
                   'rec_data' => $datahora, 
               );

            $res1 = $this->recuperar->inserirChaves($recuperar);


            $this->load->library("My_PHPMailer","","email");
            
            $mail = $this->email->My_EnviarEmail($res->usuario_email, $res->usuario_nome, $chave);


            echo "Enviado com sucesso!";
        }
        else
        {
            echo "Erro ao enviar o E-mail";
        }
        
        //var_dump($mail);
        // echo $res->usuario_email;
        //echo $chave;
        //echo "<br>";
        //echo $url;
        
    }
 
    public function updateSenha() {
        $id = $this->session->userdata('id_login');

        $senha = md5( $this->input->post('senha') );

        $res = $this->login->updateSenhaById($id, $senha);

        if ($res) {
            echo "Senha atualizada com sucesso!";
        }
        else {
            echo "Erro ao atualizar!";
        }
    }

    public function updateSenhaByIdWithHidden() {
        $id = $this->input->post('iduser');
        $senha = md5( $this->input->post('senha') );

        $res = $this->login->updateSenhaById($id, $senha);

        if ($res) {
            echo "Senha atualizada com sucesso!";
        }
        else {
            echo "Erro ao atualizar!";
        }
    }

    public function trocarSenha($chave) {

        $res = $this->recuperar->comparaChaves($chave);   
        $id = array(
                   'id'   => $res->rec_id_usuario
               );

        $this->load->helper('date');
        $datestring = '%Y-%m-%d %H:%i:%s';
        $time = now();
        $timezone  = 'UM3';
        $daylight_saving = false;
        $t = gmt_to_local($time, $timezone, $daylight_saving);
        $datahora =  mdate($datestring, $t);

        if(($res->rec_data <= $datahora) && ($res->datatermino >= $datahora))
        {
            //echo "controllers/login falta fazer uma pagina para ele alterar suas senhas";
            $this->load->view('login/alterarSenha_view', $id);
            //redirect('login/alterarSenha_view');
        }
        else
        {
            echo "Por favor é preciso fazer um novo requerimento.";
            redirect('login');
        }
    }

    /**
     * Redireciona para a view 'tempoLimite'
     */
    public function tempoLimite() {
        $this->load->view('errors/tempoLimite');
    }
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */