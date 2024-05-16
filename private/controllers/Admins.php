<?php 

class Admins extends Controller
{
    function index()
	{
<<<<<<< HEAD
        
=======
     
>>>>>>> de73af56ebf26c9c19dd7fba031c1a6bd16405fc
		
		if(!Auth::adminLoggedIn())
		{
			$this->redirect('login');
		}
		$user = new Admin();

		$data = $user->findAll();

		$this->view('home.admin',['rows'=>$data]);
    }
	
}