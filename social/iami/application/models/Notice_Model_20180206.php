<?php
class Notice_model extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }

        // public function getInviters($memberID)
        // {
        //         $this->db->where('member_id', $memberID);
        //         $query = $this->db->get('inviter');

        //         return $query;
        // }

        // public function getNotifies($memberID, $limit='NULL')
        // {
        //         $this->db->where('member_id', $memberID);
        //         $this->db->join('member','notifies.member_id=member.id','left');
        //         $query = $this->db->get('notifies', $limit);

        //         return $query;
        // }

        public function getChatNotice($memberID)
        {

                $this->db->where('member_id', $memberID);
                $query = $this->db->get('notices');

                return $query;
        }

        // public function addInviters($memberID, $inviterID, $text)
        // {
        //         $data = array(
        //                 'text'=> $text);
        //         $query = $this->db->insert('notifies', $data);

        //         return $query;
        // }

        public function addNotify($memberID, $data)
        {
                
                $query = $this->db->insert('notifies', $data);

                return $query;
        }

        public function addChatNotify($memberID, $data)
        {
                
                $query = $this->db->insert('notifies', $data);

                return $query;
        }
/*getNoticePost*/
        /*notice:share*/
        public function getNoticePostShare()
        {       

                $this->db->join('member', 'member.id=share.member_id','left');
                $query = $this->db->get('share');

                return $query;
        } 
        /*notice:reply*/
        public function getNoticePostReply()
        {
                $this->db->join('member', 'member.id=collection.member_id','left');
                $query = $this->db->get('reply');

                return $query;
        }
        /*notice:collection*/
        public function getNoticePostCollection()
        {
                $this->db->join('member', 'member.id=collection.member_id','left');
                $query = $this->db->get('collection');

                return $query;       
        }

        /*getNoticePost Sorting*/
        public function getNotice($memberID, $limit, $type)//type(leave, collection, reply, share)
        {
                // if($type=='leave'){
                //         $type="notifes";
                // }
                $this->db->where('member_id', $memberID);
                $this->db->join('member', 'member.id=notices.member_id', 'left');
                $this->db->select('notices.id as noticesid, notices.createTime, notices.text, notices.is_read, notices.member_id, member.nickname, member.id as memberid');
                $query = $this->db->get('notices', $limit);

                return $query;
        }

        public function notice_check($id)
        {
                $data = array(
                        'is_read' => '1'
                );

                $this->db->where('id', $id);
                $this->db->update('notices', $data);
        }


}
?>