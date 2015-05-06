<?php

class news_feed_model extends model {

function __construct() {
    parent::__construct();
    session::init();
}

	

  
  //news feed
   public function newsFeed(){
       $return=array();
       
       //get groups of friends
  /*   
       $sth = $this->db->prepare('SELECT * FROM `mygroup_view` WHERE `members_index` IN 
          (SELECT `friend_index` FROM `friends` WHERE `my_index`=:my_index) AND `group_type`= :open
          ORDER BY `timestamp` DESC LIMIT 0,6');
        $sth->execute(array(
            ':my_index'=>session::get('index'),
            ':open' =>'open'
                ));
       $return= $sth->fetchAll();
    */   
       
      //get  friending from frieds
        $sth1 = $this->db->prepare('SELECT * FROM `friends_view` WHERE `my_index` IN 
          (SELECT `friend_index` FROM `friends` WHERE `my_index`=:my_index) AND `status`=:accepted
          ORDER BY `timestamp` DESC LIMIT 0,6');
        $sth1->execute(array(
            ':my_index'=>session::get('index'),
            ':accepted'=>'accepted'
                ));
        $return2= $sth1->fetchAll();
        
        foreach($return2 as $key=>$value){
            
           array_push($return, $value);     
            
        }
       
       
      //get roles from firneds 
       
       
       $sth = $this->db->prepare('SELECT * FROM `meeting_news_view` WHERE `members_index` IN (SELECT `friend_index` FROM `friends` WHERE `my_index`=:my_index)
        AND `meeting_privacy`= :public  ORDER BY `timestamp` DESC LIMIT 0,6');
        $sth->execute(array(
            ':my_index'=>session::get('index'),
            ':public'=>'public'
                ));
        $return3= $sth->fetchAll();
        
        
        //array_push($return,$return3);
        
        foreach($return3 as $key=>$value){
            
           array_push($return, $value);     
            
        }
       
       echo $_GET['callback'].'('.json_encode($return).')';
     /* 
       echo '<pre>';
      print_r($return);
        echo '</pre>';
      * 
      */
   }

}
