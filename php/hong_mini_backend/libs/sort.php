<?php


class sort{
    
    /**
     *
     * @param string $algo the algorithm md5, sha1, etc
     *  @data the data to encode
     * @param string $salt the salt(this should be same through system
     * @data the data to encode
     * @return string
     * 
     */
    
    public static function sort_user($a, $b){
        return strcmp($a->members_index, $b->members_index);
    }
}
?>
