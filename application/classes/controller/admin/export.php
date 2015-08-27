<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Export extends Controller {

    private $filename;
    private $contenttype = false;

    public function before(){
    }

	public function action_index()
	{
	}
	public function action_getCompanies(){
	    $companies = DB::select('*')
	                    ->from('company')
	                    ->order_by('company_id', 'asc')
	                    ->execute()
	                    ->as_array();
	    $this->content = json_encode($companies);
	}
	public function action_genCompanyPDF($cid){
	    require Kohana::find_file('vendor', 'dompdf/dompdf_config.inc', 'php');
	    $pdf = new DOMPDF;
	    $template = View::factory('katalog/minkatalog');

        $company = Model::factory('company')->get_company_details($cid);
		$booth = Model::factory('company')->get_company_booth($cid);

    	if(count($booth) > 0)
    	    list($company['booth'])    = $booth;
    	else
    	    $company['booth'] = false;


		$exist = Kohana::find_file('../images', 'booth/'.$company['booth']['place'], 'jpg');
		if(!$exist && $company['booth'] !== false)
		    Model::factory('booth')->render_booth($cid);


        $company['branches']             = Model::factory('company')->get_company_branches($cid);
        $company['programs']             = Model::factory('company')->get_company_programs($cid);
        $company['offers']               = Model::factory('company')->get_company_offers($cid);
        $company['cities']               = Model::factory('company')->get_company_cities($cid);
        $company['countries']            = Model::factory('company')->get_company_countries($cid);
        $company['educationtypes']       = Model::factory('company')->get_company_educationtypes($cid);
        $companies[] = $company;

        $template->companies = $companies;
	    $template->renderIndex = false;

	    $pdf->set_base_path(getcwd());
	    $pdf->load_html($template);
	    $pdf->render();
	    Model::factory('status')->update_to_now('lastpregen');
	    if(file_put_contents('pdf/katalog/'.$cid.'.pdf', $pdf->output())){
	        $this->content = '1';
	    } else {
	        $this->content = '0';
	    }
	}
	public function action_ps(){
        $this->filename = $this->request->controller(). '_' .$this->request->action().'_'.date('Ymdhi').'.xls';
		$this->headers['Content-Disposition'] = 'attachment; filename="'.$this->filename.'"';
		$this->contenttype = 'application/vnd.ms-excel';
        $this->headers['Content-Type'] = $this->contenttype;

        $crew = DB::select_array(array(
	    			'user.fname',
	    			'user.lname',
            	    'user.programId',
            	    'user.user_id',
            	    'interview_interest.company_request',
            	    'company.name'
        	    ))
	            ->from('user')
	            ->join('interview_interest')
	            ->on('user.user_id', '=', 'interview_interest.user')
	            ->join('company')
	            ->on('interview_interest.company', '=', 'company.company_id')
	            ->where('interview_interest.company_request', 'in', DB::expr('(1,2)'))
	            ->order_by('company_request', 'asc')
	            ->order_by('company.name', 'ASC')
	            ->execute()
	            ->as_array();

		$this->contenttype = 'application/vnd.ms-excel';
        $this->filename = $this->request->controller(). '_' .$this->request->action().'_'.date('Ymdhi').'.xls';

        $this->content = View::factory('admin/export/crew');
        $this->content->crew = $crew;
        $this->response->headers('Content-Type', $this->contenttype.'; charset=utf-8');
        $this->response->headers('Content-Disposition', 'attachment; filename="'.$this->filename.'"');

	}
    public function action_psBooked(){
        $this->filename = $this->request->controller(). '_' .$this->request->action().'_'.date('Ymdhi').'.xls';
		$this->headers['Content-Disposition'] = 'attachment; filename="'.$this->filename.'"';
		$this->contenttype = 'application/vnd.ms-excel';
        $this->headers['Content-Type'] = $this->contenttype;

        $crew = DB::select_array(array(
	    			'user.fname',
	    			'user.lname',
        			'user.phone',
            	    array('company.name', 'company'),
            	    array('room.name', 'rum'),
            	    array(DB::expr('concat(period.start, " - ", period.end)'), 'pass')
        	    ))
	            ->from('user')
	            ->join('interview_interest')
	            ->on('user.user_id', '=', 'interview_interest.user')
	            ->join('company')
	            ->on('interview_interest.company', '=', 'company.company_id')
	            ->join('room')
	            ->on('interview_interest.room', '=', 'room.room_id')
	            ->join('period')
	            ->on('interview_interest.period', '=', 'period.period_id')
	            ->where('interview_interest.company_request', 'in', DB::expr('(1,2)'))
	            ->order_by('company.name', 'ASC')
	            ->order_by('company_request', 'asc')
	            ->order_by('period.start', 'asc')
	            ->execute()
	            ->as_array();

		$this->contenttype = 'application/vnd.ms-excel';
        $this->filename = $this->request->controller(). '_' .$this->request->action().'_'.date('Ymdhi').'.xls';

        $this->content = View::factory('admin/export/crew');
        $this->content->crew = $crew;
        $this->response->headers('Content-Type', $this->contenttype.'; charset=utf-8');
        $this->response->headers('Content-Disposition', 'attachment; filename="'.$this->filename.'"');

	}public function action_psBookedbyRoom(){
        $this->filename = $this->request->controller(). '_' .$this->request->action().'_'.date('Ymdhi').'.xls';
		$this->headers['Content-Disposition'] = 'attachment; filename="'.$this->filename.'"';
		$this->contenttype = 'application/vnd.ms-excel';
        $this->headers['Content-Type'] = $this->contenttype;

        $crew = DB::select_array(array(
	    			'user.fname',
	    			'user.lname',
        			'user.phone',
            	    array('company.name', 'company'),
            	    array('room.name', 'rum'),
            	    array(DB::expr('concat(period.start, " - ", period.end)'), 'pass')
        	    ))
	            ->from('user')
	            ->join('interview_interest')
	            ->on('user.user_id', '=', 'interview_interest.user')
	            ->join('company')
	            ->on('interview_interest.company', '=', 'company.company_id')
	            ->join('room')
	            ->on('interview_interest.room', '=', 'room.room_id')
	            ->join('period')
	            ->on('interview_interest.period', '=', 'period.period_id')
	            ->where('interview_interest.company_request', 'in', DB::expr('(1,2)'))
	            ->order_by('room.name', 'asc')
	            ->order_by('period.start', 'asc')
	            ->execute()
	            ->as_array();

		$this->contenttype = 'application/vnd.ms-excel';
        $this->filename = $this->request->controller(). '_' .$this->request->action().'_'.date('Ymdhi').'.xls';

        $this->content = View::factory('admin/export/crew');
        $this->content->crew = $crew;
        $this->response->headers('Content-Type', $this->contenttype.'; charset=utf-8');
        $this->response->headers('Content-Disposition', 'attachment; filename="'.$this->filename.'"');

	}
	public function action_crew(){
        $this->filename = $this->request->controller(). '_' .$this->request->action().'_'.date('Ymdhi').'.xls';
		$this->headers['Content-Disposition'] = 'attachment; filename="'.$this->filename.'"';
		$this->contenttype = 'application/vnd.ms-excel';
        $this->headers['Content-Type'] = $this->contenttype;

        $crew =
			DB::select_array(array(
					'crew.*',
				 	'user.fname',
					'user.lname',
					'user.phone',
					'user.email',
					'user.username',
					'user.year',
					array('program.name', 'program'),
					'user.program_ovrig'
				))
				->from('crew')
				->join('user')
				->on('crew.userid', '=', 'user.user_id')
				->join('program')
				->on('user.programId', '=', 'program.id')
				->order_by('crew.role', 'ASC')
				->order_by('user.lname', 'ASC')
				->order_by('user.fname', 'ASC')
				->order_by('crew.date', 'DESC')
				->execute()
				->as_array();
        $this->content = View::factory('admin/export/crew');
        $this->content->crew = $crew;
	}
    public function after() {
    	if(!empty($this->headers)){
    		foreach($this->headers as $key => $value){
    			$this->response->headers($key, $value);
    		}
    	}

        $this->response->body($this->content);
    }
} // End Welcome
