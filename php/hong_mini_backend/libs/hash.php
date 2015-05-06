<?php


class hash{
    
    /**
     *
     * @param string $algo the algorithm md5, sha1, etc
     *  @data the data to encode
     * @param string $salt the salt(this should be same through system
     * @data the data to encode
     * @return string
     * 
     */
    
    public static function create($algo, $data ,$salt)
    {
      $context = hash_init($algo, HASH_HMAC , $salt);  
      hash_update($context, $data);
      
      return hash_final($context);
        
    }
}
?>
