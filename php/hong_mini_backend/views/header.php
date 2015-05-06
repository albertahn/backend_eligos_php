<!doctype html>

	<head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
           <?php
 $cache_expire = 60*60*24*365;
 header("Pragma: public");
 header("Cache-Control: max-age=".$cache_expire);
 header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_expire) . ' GMT');
 ?>
 <script src="//connect.facebook.net/en_US/all.js"></script>
             <?php
//group social finding
                         if (isset($this->group_social))
                         { echo '
<meta property="og:description" content="'.$this->group_social['profile'].'" />
 <meta property="og:title" content="'.$this->group_social['name'].' Group" />

<meta property="og:url" content="'.URL.'group/inside_group/'.$this->group_social['index'].'" />
<meta property="og:image" content="'.GROUPS_PIC.'/'.$this->group_social['group_pic'].'" />

                         ';
                         }
                         /**
  //profile social finding
                          if (isset($this->profile_social))
                         { echo '
<meta property="og:description" content="'.$this->profile_social['profile'].'" />
 <meta property="og:title" content="'.$this->group_social['name'].' Group" />

<meta property="og:url" content="'.URL.'group/inside_group/'.$this->group_social['index'].'" />
<meta property="og:image" content="'.GROUPS_PIC.'/'.$this->group_social['group_pic'].'" />

                         ';
                         }
                         **/
                         
  //product social finding
  
                          if (isset($this->product_social))
                         { echo '
<meta property="og:description" content="'.$this->product_social['description'].'" />
 <meta property="og:title" content="'.$this->product_social['name'].'" />

<meta property="og:url" content="'.URL.'product/inside_product/'.$this->product_social['index'].'" />
<meta property="og:image" content="'.PRODUCTS_PIC.'/'.$this->product_social['main_picture'].'" />

                         ';
                         }
                         
                         


                         
                        ?>
             <!-- group social --> 
            <meta name="keywords" content="contendera, success, change, habit, porn addiction, 12 steps, addiction, men, self help, living dreams, goals" />
	    <meta name="description" content="Share and create value for the whole world." />	
                        <title>Contendera</title>
			<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
			<script type="text/javascript" src="<?php echo URL; ?>public/js/javascript.js"></script>
                       <script type="text/javascript" src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
                       
                      
 <!--facebook javascript stuff-->
 
  <?php
  /*
 $cache_expire = 60*60*24*365;
 header("Pragma: public");
 header("Cache-Control: max-age=".$cache_expire);
 header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_expire) . ' GMT');
   * */
   
 ?>
 
 
		<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/default.css" />
                        
                       <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/bootstrap.min.css" />
                        
                         <!--css rendering-->
			<?php
                         if (isset($this->css))
                         {
                             foreach ($this -> css as $css) {
                                 echo '<link rel="stylesheet" type="text/css" href="'.URL.'views/'.$css.'"/>';
                                 
                             }
                             
                         }
                        ?>
                      
                        <!--javascript rendering-->
			<?php
                         if (isset($this->js))
                         {
                             foreach ($this -> js as $js) {
                                 echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
                                 
                             }
                             
                         }
                        ?>
                        
                        <!--jui-->
        <script type="text/javascript" src="<?php echo URL; ?>public/jq_ui/jui.js"></script> 
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/jq_ui/jui.css" />
             <!--[if IE]>
			<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/ie.css" />
			<![endif]-->
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAhSxFeXu28VWO0vKLIF21r1DRSZARPZXA&sensor=true"></script>              

<link href='http://fonts.googleapis.com/css?family=Lato:100,200,300,400,700,400italic,700italic' rel='stylesheet' type='text/css'>  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35502139-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</head>
	
	
	
	<body>
          


<?php session::init(); ?>	
           
       
		<div id="content" >
	