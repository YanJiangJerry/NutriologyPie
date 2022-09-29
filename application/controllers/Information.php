<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class information extends CI_Controller {
	public function index()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('article_model');
		$this->load->view('components/header');
		$category = 'body health';
		$article_list = $this->article_model->get_article($category);
		$articles = "";
		foreach ($article_list as $article) {
			$articles = $articles.'
			<div class="more-topic">
				<a href="'.$article->link.'">
					<img class="ml-5 h-52 w-72 pb-2" src="http://localhost/NutriologyPie/assets/images/information.png" alt="information">
				</a>
				<h3 class="mt-2 text-left ml-4 w-72 text-[#0B6B2C] text-xl font-bold capitalize">'.$article->title.'</h3>
				
        	</div>
			';
		}
		$data['article_list'] = $articles;
		$data['top_article'] = $article_list[0];
		$this->load->view('information',$data);
	}

	// <h3 class="mt-2 text-left ml-4 text-[#0B6B2C] text-xl font-bold capitalize">Rate: '.number_format($article->avg_rating,1).'<span class="text-xs text-slate-900"> / 5</span></h3>

	public function category($category=Null)
	{
		if ($category == Null){
			redirect('information');
		}
		
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('article_model');
		$this->load->view('components/header');
		$category = urldecode($category);
		$article_list = $this->article_model->get_article($category);
		$articles = "";
		foreach ($article_list as $article) {
			$articles = $articles.'
			<div class="more-topic">
				<a href="'.$article->link.'">
					<img class="ml-5 h-52 w-72 pb-2" src="http://localhost/NutriologyPie/assets/images/information.png" alt="information">
				</a>
				<h3 class="mt-2 text-left w-72 ml-4 text-[#0B6B2C] text-xl font-bold capitalize">'.$article->title.'</h3>
        	</div>
			';
		}
		$data['article_list'] = $articles;
		$data['top_article'] = $article_list[0];
		$this->load->view('information',$data);
	}

	public function fetch(){
		$this->load->model('article_model'); // load file_model 
        $data = $this->article_model->get_article("health"); //send query to file_model and put result to $data
            if(!$data == null){
                echo json_encode ($data); //send result back
            }else{
                echo  ""; // no result found
            }
    
	}
}
?>