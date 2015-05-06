<?php

class dashboard_model extends model {

function __construct() {
    parent::__construct();
}

	function xhrInsert() {
            
            $text= $_POST['text'];
            $room_id= 1;
            //room_id room session 만들고 room exit 누르면 룸 다시 로긴 해야 나오게 하
            
            $sth = $this->db->prepare('INSERT INTO chats_in_room (text,room_id) VALUES (:text, :room_id)');
            $sth->execute(array(':text'=> $text,
                                ':room_id'=>$room_id));
            $data = array('text'=>$text, 'chat_id'=> $this->db->lastInsertId());
            echo json_encode($data);
	}
        
        function xhrGetListings() {
           $sth= $this->db->prepare('SELECT * FROM product');
           
           $sth->setFetchMode(PDO::FETCH_ASSOC);
           
           $sth->execute();
          $data= $sth->fetchAll();
            echo json_encode($data);
        }
        
        function xhrDeleteListing(){
            
            $id = $_POST['id'];
            $sth = $this->db->prepare('DELETE  FROM chats_in_room WHERE chat_id ="'.$id.'"');
            $sth->execute();
            }
            

}
