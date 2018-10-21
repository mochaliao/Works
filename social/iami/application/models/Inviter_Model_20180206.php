<?php
class Inviter_Model extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function __construct()
        {
                parent::__construct();
                
        }

        public function getInviters($membersID)
        {
                $this->db->where('be_inviter_id', $membersID);
                $this->db->join('members','members.id=inviter.inviter_id','left');
                $this->db->select('inviter.createTime, inviter.text, members.id, members.nickname');
                $this->db->group_by('members.nickname');
                $query = $this->db->get('inviter');

                return $query;
        }

        public function addInviters($membersID, $inviterID, $text)
        {
                $data = array(
                        'text'=> $text);
                $query = $this->db->insert('notices', $data);

                return $query;
        }

        public function addInviter($id, $process)
        {
                $data = array(
                        'inviter_id'    => '1',
                        'be_inviter_id' => '2'
                );

                $this->db->insert('inviter', $data);
        }

        public function delInviter($id, $process){

                $data = array(
                        'inviter_id' => $id
                );
                $this->db->where('id', $id);
                $this->db->delete('inviter');
        }

        public function inviter_process($inviter_id, $be_inviter_id)
        {
                $data = array(
                        'inviter_id'    =>  $inviter_id,
                        'be_inviter_id'  =>  $be_inviter_id
                        );
                // $this->db->where(,$inviter_id);
                $this->db->insert('inviter', $data);
        }

}
?>