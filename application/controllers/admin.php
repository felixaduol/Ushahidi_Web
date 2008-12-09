<?php defined('SYSPATH') or die('No direct script access.');

/**
 * This main controller for the Admin section 
 */

class Admin_Controller extends Template_Controller {

    public $auto_render = TRUE;
	
    // Main template
    public $template = 'admin/layout';
	
    // Cache instance
    protected $cache;

    // Enable auth
    protected $auth_required = FALSE;
	
    protected $user;


    public function __construct()
    {
        parent::__construct();	

        // Load cache
        $this->cache = new Cache;

        // Load session
        $this->session = new Session;

        // Load database
        $this->db = new Database();
		
        $this->auth = new Auth();
        $this->session = Session::instance();
        $this->auth->auto_login();
        if (!$this->auth->logged_in('admin')
             && !$this->auth->logged_in('user'))
        {
            url::redirect('login');
        }
		
		
        // Get Session Information
        $user = new User_Model($_SESSION['auth_user']->id);
		
        $this->template->admin_name = $user->name;
		
        // Retrieve Default Settings
        $this->template->site_name = Kohana::config('settings.site_name');
        $this->template->mapstraction = Kohana::config('settings.mapstraction');
        $this->template->api_url = Kohana::config('settings.api_url');
		
        // Javascript Header
        $this->template->map_enabled = FALSE;
		$this->template->flot_enabled = FALSE;
        $this->template->colorpicker_enabled = FALSE;
        $this->template->js = '';
		
        // Load profiler
        // $profiler = new Profiler;		
		
    }

    public function index()
    {
        // Send them to the right page
        url::redirect('admin/dashboard');
    }

    public function log_out()
    {
        $auth = new Auth;
        $auth->logout(TRUE);

        url::redirect('login');
    }		

} // End Admin