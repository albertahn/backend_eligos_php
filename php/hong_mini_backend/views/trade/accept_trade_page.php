<?php



echo'<a style="float:right;" class="uiButton" href="'.URL.'trade/accept_trade/'.$this->accept_trade_page['trade_index'].'">
           Accept trade<img style="width:20px; border-radius:10px;" src="'.URL.'/public/images/arrow.png"/></a>
     <a style="float:right;" class="uiButton" href="'.URL.'trade/reject_trade/'.$this->accept_trade_page['trade_index'].'">
           Reject trade<img style="width:20px; border-radius:10px;" src="'.URL.'/public/images/arrow.png"/></a>        
    
<p>requestor:</p> <a href="'.URL.'user/user_profile/'.$this->accept_trade_page['members_index'].'">
    
<img id="accept_request_page_profile_pic" src="'.MEMBERS_PIC.'/'.$this->accept_trade_page['profile_picture'].'" />
</a>

<p>name: '.$this->accept_trade_page['username'].'</p> <br />

<p>product :'.$this->accept_trade_page['product_name'].'</p>
<a href="'.URL.'product/inside_product/'.$this->accept_trade_page['product_index'].'">
<img id="accept_request_page_product_pic" src="'.PRODUCTS_PIC.'/'.$this->accept_trade_page['product_picture'].'" />
</a>
<p>price: '.$this->accept_trade_page['price'].'</p>
    <p>for: '.$this->accept_trade_page['for'].'</p>

';
