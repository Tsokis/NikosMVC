<?php
class Pages extends Controller {
    public function __construct() {
        $this->postModels = $this->model('Post');
    }
    public function index() {
        $posts = $this->postModels->getPosts();
        $data = ['title'=>'Welcome',
            'post'=> $posts];
        $this->view('pages/index',$data);
    }

    public function about() {
        $data = ['title'=>'About us'];
        $this->view('pages/about',$data);
    }

    public function chat() {
        $data = ['title'=>'Chat Client'];
        $this->view('pages/chat',$data);
    }
}