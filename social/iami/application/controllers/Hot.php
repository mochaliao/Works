<?php
class Hot extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
		$this->load->model('trace_model');
		$this->load->model('post_model');
		$this->load->model('member_model');
		$this->load->model('like_model');
		$this->load->model('member_company_model');
        $this->load->model('member_school_model');
        $this->load->model('language_model');
        $this->load->model('country_model');
		$this->load->model('hot_model');
    }

    public function post($showType = ""){

        $member_id = $this->session->userdata("member_id");
        if (!isset($member_id)) {
            redirect('/member/doLogin');
        }

        $myself = false;
        $info_id = $this -> input -> get("i");
        if(is_null($info_id)){
            $info_id = $member_id;
            $myself = true;
        }
        else if($info_id == $member_id){
            $myself = true;
        }

        $member = $this->member_model->getMember($info_id)->row_array();

        $postCount = $this -> post_model -> getPostCount($info_id);
        $collectCount = $this -> post_model -> getCollectionCount($info_id);
        $traceCount = $this -> trace_model -> getTraceByMember($info_id) -> num_rows();
        $fansCount = $this -> trace_model -> getMemberByTrace($info_id) -> num_rows();

        $isTrace = $this -> like_model -> isTrace($member_id, $info_id);
        $isInvite = $this -> like_model -> isInvite($member_id, $info_id);
        $isFriend = $this -> like_model -> isFriend($member_id, $info_id);

        $data = array(
            'member_id' => $info_id,
            'email' => $member["email"],
            'nickname' => $member["nickname"],
            'language_id' => $this->session->userdata("language_id"),
            'avatar' => $member["avatar"],
            'banner' => $member["banner"],
            'status' => $this->session->userdata("status"),
            "is_myself" => $myself,
            'level' => $member["level"],
            'money' => $member["money"],
            "postCount" => $postCount,
            "collectCount" => $collectCount,
            "traceCount" => $traceCount,
            "fansCount" => $fansCount,
            "isTrace" => $isTrace,
            "isFriend" => $isFriend,
            "isInvite" => $isInvite
        );


        $member = $this->member_model->getMember($member_id)->row_array();
        $data['member'] = $member;
        $member_companys = $this->member_company_model->getMemberCompany($member_id)->result_array();
        $data['member_companys'] = $member_companys;
        $member_schools = $this->member_school_model->getMemberSchool($member_id)->result_array();
        $data['member_schools'] = $member_schools;
        $countrys = $this->country_model->getCountry()->result_array();
        $data['countrys'] = $countrys;
        $languages = $this->language_model->getLanguage()->result_array();
        $data['languages'] = $languages;
        $data['show_type'] = $showType;






        $page = $this->input->get_post('page');
        // $start = $this->input->get_post('start');
        $perPage = $this->input->get_post('perPage');
        
        // $member_id = $this->session->userdata('member_id');
        $member_id = $this->input->get_post('member_id');
// $member_id = 2;
        /*積分點數設定*/
        $mulThumb = $this->input->get_post('mulThumb');
        $mulComments = $this->input->get_post('mulComments');
        $mulShare = $this->input->get_post('mulShare');


        if(!isset($page)){
            $page=1;
        }
        if(!isset($perPage)){
            $perPage=10;
        }

        if(!isset($mulThumb)){
            $mulThumb = 1;
        }
        if(!isset($mulComments)){
            $mulComments = 5;
        }
        if(!isset($mulShare)){
            $mulShare = 10;
        }


        if(!isset($member_id)){
            $member_id = 'NULL';
        }
        
        $start = ($page-1)*$perPage;


        $this->load->model('hot_model');
        $data['initPost'] = $this->hot_model->initPost($member_id, $start, $perPage, $mulThumb, $mulComments, $mulShare);
        
        $this->load->view('hot_post', $data);

    }

    public function video($showType = "")
    {
    	$member_id = $this->session->userdata("member_id");
        if (!isset($member_id)) {
            redirect('/member/doLogin');
        }

        $myself = false;
        $info_id = $this -> input -> get("i");
        if(is_null($info_id)){
            $info_id = $member_id;
            $myself = true;
        }
        else if($info_id == $member_id){
            $myself = true;
        }

        $member = $this->member_model->getMember($info_id)->row_array();

        $postCount = $this -> post_model -> getPostCount($info_id);
        $collectCount = $this -> post_model -> getCollectionCount($info_id);
        $traceCount = $this -> trace_model -> getTraceByMember($info_id) -> num_rows();
        $fansCount = $this -> trace_model -> getMemberByTrace($info_id) -> num_rows();

        $isTrace = $this -> like_model -> isTrace($member_id, $info_id);
        $isInvite = $this -> like_model -> isInvite($member_id, $info_id);
        $isFriend = $this -> like_model -> isFriend($member_id, $info_id);

        $data = array(
            'member_id' => $info_id,
            'email' => $member["email"],
            'nickname' => $member["nickname"],
            'language_id' => $this->session->userdata("language_id"),
            'avatar' => $member["avatar"],
            'banner' => $member["banner"],
            'status' => $this->session->userdata("status"),
            "is_myself" => $myself,
            'level' => $member["level"],
            'money' => $member["money"],
            "postCount" => $postCount,
            "collectCount" => $collectCount,
            "traceCount" => $traceCount,
            "fansCount" => $fansCount,
            "isTrace" => $isTrace,
            "isFriend" => $isFriend,
            "isInvite" => $isInvite
        );


        $member = $this->member_model->getMember($member_id)->row_array();
        $data['member'] = $member;
        $member_companys = $this->member_company_model->getMemberCompany($member_id)->result_array();
        $data['member_companys'] = $member_companys;
        $member_schools = $this->member_school_model->getMemberSchool($member_id)->result_array();
        $data['member_schools'] = $member_schools;
        $countrys = $this->country_model->getCountry()->result_array();
        $data['countrys'] = $countrys;
        $languages = $this->language_model->getLanguage()->result_array();
        $data['languages'] = $languages;
        $data['show_type'] = $showType;




        $page = $this->input->get_post('page');
        // $start = $this->input->get_post('start');
        $perPage = $this->input->get_post('perPage');
        
        // $member_id = $this->session->userdata('member_id');
        // $member_id = $this->input->get_post('member_id');
// $member_id = 2;
        /*積分點數設定*/
        $mulThumb = $this->input->get_post('mulThumb');
        $mulComments = $this->input->get_post('mulComments');
        $mulShare = $this->input->get_post('mulShare');


        if(!isset($page)){
            $page=1;
        }
        if(!isset($perPage)){
            $perPage=10;
        }

        if(!isset($mulThumb)){
            $mulThumb = 1;
        }
        if(!isset($mulComments)){
            $mulComments = 5;
        }
        if(!isset($mulShare)){
            $mulShare = 10;
        }


        if(!isset($member_id)){
            $member_id = 'NULL';
        }
        
        $start = ($page-1)*$perPage;


        $this->load->model('hot_model');
        $data['initVideo'] = $this->hot_model->initVideo($member_id, $start, $perPage, $mulThumb, $mulComments, $mulShare);

        $this->load->view('hot_video', $data);
    }

	public function getPost()
	{
		
        // $member_id = $this->session->userdata("member_id");
        // $member = $this->member_model->getMember($member_id)->row_array();
        // $postCount = $this -> post_model -> getPostCount($member_id);
        // $traceCount = $this -> trace_model -> getTraceByMember($member_id) -> num_rows();
        // $fansCount = $this -> trace_model -> getMemberByTrace($member_id) -> num_rows();

        // $data = array(
        //     'member_id' => $member_id,
        //     'email' => $member["email"],
        //     'nickname' => $member["nickname"],
        //     'language_id' => $member["language_id"],
        //     'avatar' => $member["avatar"],
        //     'banner' => $member["banner"],
        //     'status' => $member["status"],
        //     'level' => $member["level"],
        //     'money' => $member["money"],
        //     "is_myself" => true,
        //     "postCount" => $postCount,
        //     "traceCount" => $traceCount,
        //     "fansCount" => $fansCount,
        //     "show_type" => $show_type
        // );
        $page = $this->input->get_post('page');
		// $start = $this->input->get_post('start');
		$perPage = $this->input->get_post('perPage');
        $start = ($page-1)*$perPage;
		// $member_id = $this->session->userdata('member_id');
        $member_id = $this->input->get_post('member_id');
        // $member_id = 45;
        $isTotal = $this->input->get_post('isTotal');

		/*積分點數設定*/
		$mulThumb = $this->input->get_post('mulThumb');
		$mulComments = $this->input->get_post('mulComments');
		$mulShare = $this->input->get_post('mulShare');


		if(!isset($page)){
			$page=2;
		}
		if(!isset($perPage)){
			$perPage=10;
		}

		if(!isset($mulThumb)){
			$mulThumb = 1;
		}
		if(!isset($mulComments)){
			$mulComments = 5;
		}
		if(!isset($mulShare)){
			$mulShare = 10;
		}


        if(!isset($member_id)){
            $member_id = 'NULL';
        }
		

		$res = $this->hot_model->getPost($member_id, $start, $perPage*1, $mulThumb, $mulComments, $mulShare);
		
        echo json_encode($res);
	}

	public function getVideo()
	{
		// $start = $this->input->get_post('start');
		$perPage = $this->input->get_post('perPage');
        $page = $this->input->get_post('page');
        $start = ($page-1)*$perPage;

		// $member_id = $this->session->userdata('member_id');
        $member_id = $this->input->get_post('member_id');

		/*積分點數設定*/
		$mulThumb = $this->input->get_post('mulThumb');
		$mulComments = $this->input->get_post('mulComments');
		$mulShare = $this->input->get_post('mulShare');


		if(!isset($page)){
			$page=2;
		}
		if(!isset($perPage)){
			$perPage=10;
		}

		if(!isset($mulThumb)){
			$mulThumb = 1;
		}
		if(!isset($mulComments)){
			$mulComments = 5;
		}
		if(!isset($mulShare)){
			$mulShare = 10;
		}

        if(!isset($member_id)){
            $member_id = 'NULL';
        }

		// $member_id = $this->session->userdata('member_id');
		$res = $this->hot_model->getVideo($member_id, $start, $perPage*1, $mulThumb, $mulComments, $mulShare);
		echo json_encode($res);
	}

}
?>