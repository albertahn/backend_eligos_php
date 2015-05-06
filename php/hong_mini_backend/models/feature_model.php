<?php

class feature_model extends model {

function __construct() {
    parent::__construct();
}


public function show_featured(){
    
    
$stha = $this->db->prepare('SELECT * FROM `featured_mentor_view` where `publish` =:true');
  $stha->execute(array(':true'=>'1')); 
  
   $stream= $stha->fetchAll();
   
   $json = json_encode($stream);
   
   echo $json;    
} //

    
public function insert_expert($data){
    
      $sth = $this->db->prepare('SELECT * FROM `expert` 
         WHERE `members_index` =:members_index');
        $sth->execute(array(
            ':members_index'=> $data['my_index']
        ));
            
        $count = $sth->rowCount();
        
        if($count>0){
            
                    $sth1 = $this->db->prepare('UPDATE `expert`
                        SET `blurb` = :blurb,
                        `about_me` =:about_me
                        WHERE `members_index` = :members_index
                     ');

                  $sth1->execute(array(
                     ':members_index' => $data['my_index'],
                     ':blurb'=>$data['blurb'],
                      ':about_me'=>$data['about_me']
                    ));
                  
            
        }else{
    
        $sth2= $this->db-> prepare('INSERT INTO `expert` (`members_index`,`blurb`, `about_me`) VALUES (:members_index, :blurb, :about_me)');
        $sth2-> execute(array(
            ':members_index' => $data['my_index'],
            ':blurb' => $data['blurb'],
            ':about_me' =>$data['about_me']
        ));
        
        } //else end
        
         $json = json_encode($data);
   
   echo $json;
        
   //update user as publish
        /* $sth3 = $this->db->prepare('UPDATE `members`
                        SET `publish` = :publish
                        WHERE `index` = :members_index
                     ');

                  $sth3->execute(array(
                     ':members_index' => $data['my_index'],
                     ':publish'=>'1'
                     
                    ));*/
      //to the url  
        
       
        
    
}// end insert expert
        
          
          
       //get my application data
   public function get_my_apply($my_index){
       
    $stha = $this->db->prepare('SELECT * FROM `featured_mentor_view` where `members_index` =:members_index');

    $stha->execute(array(
      
      ':members_index' =>$my_index
      )); 
  
   $stream= $stha->fetch();
   $json = json_encode($stream);
   
   echo $json;
   
   } //get apply
        

}
