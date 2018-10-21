<?php
class Money_model extends CI_Model {

        //public $title;
        //public $content;
        //public $date;

        public function __construct()
        {
            parent::__construct();
            // Your own constructor code
        }

        public function getMoney($memberID)
        {
            $this->db->where('member_id', $memberID);
            $query = $this->db->get('money');

            return $query;
        }

        public function exchangeTo($memberID, $targetMemberID, $money, $note)
        {
            // $this->db->where('member_id', $memberID);
            // $query = $this->db->get('money');

            $exchange = array(
                    'points'  =>  $money,
                    'action'  =>  '2',
                    'note'    =>  $note
            );
            $this->db->set('member_id', $memberID);
            $query = $this->db->insert('money_logs', $exchange);
        }

        public function moneyIn($memberID, $points,$originMoney, $note){

                // echo $originMoney;
                //原本IAMI幣多少
                // getMoney($memberID);
                $newPoints = $points+$originMoney;
                $moneyIn = array(
                        'member_id' => $memberID,
                        'points'  =>  $newPoints,
                        'action' => '1',
                        'note'    =>  $note
                );

                $this->db->where('member_id', $memberID);
                $this->db->insert('money_logs', $moneyIn);
        }

        public function moneySave($memberID)
        {
                //儲值IAMI幣
        }

}
?>