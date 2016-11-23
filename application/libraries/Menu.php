<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Menu {


	/**
     *
     * @var araay
     */
	protected $pags;

	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->model('Pagina_model' , 'pagina');
        $this->CI->load->library('session');
	}
	
	/**
	 * @param string
	 */
	public function setPags($paginas) {

		$ids = explode('|', $paginas);

		$pagina = array();

		foreach ($ids as $id) {
			$obj = $this->CI->pagina->exibirPaginaById($id);
			$pagina[] = [$obj->pags_nome, $obj->pags_apelido];
		}

        $this->CI->session->set_userdata(['paginas' => $paginas]);

		$this->pags = $pagina;
	}
	
	/**
	 * @param  string $pagina
	 * @return boolean
	 */
	public function gerarMenu($pagina)	{
		if ($this->pags == null) {
			return false;
		}

		$menu = "<div class='container'>
					<ul id='gn-menu' class='gn-menu-main'>
						<li class='gn-trigger'>
							<a class='gn-icon gn-icon-menu'><span>Menu</span></a>
							<nav class='gn-menu-wrapper'>
								<div class='gn-scroller'>
									<ul class='gn-menu'>
										<li class='gn-search-item'>
											<input placeholder='Pesquisa' type='search' class='gn-search'>
											<a class='gn-icon gn-icon-search'><span>Pesquisa</span></a>
										</li>";

		foreach ($this->pags as $item ) {
			$menu .= '<li>
						<a href="'.base_url($item[0]).'" class="gn-icon gn-icon-article" >'.$item[1].'</a>
						</li>';
		}

		$menu .= '</ul>
									</div><!-- /gn-scroller -->
								</nav>
							</li>
							<li><a href="'.base_url($pagina).'">Inicio</a></li>
							<li class="relogio"><a><div class="hora"></div></a></li>
							<li><a class="codrops-icon icon icon-close" href="'.base_url('Login/sair').'"><span>Sair</span></a></li>
						</ul>
					</div>'; 
  
        $this->CI->session->set_userdata(['menu' => $menu]);
	}
}	

/* End of file Menu.php */
/* Location: ./application/libaries/Menu.php */