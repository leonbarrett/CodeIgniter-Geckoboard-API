<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Geckoboard_API {
  
  var $CI;
  
  function Geckoboard_API()
  {
    
    $this->CI =& get_instance();
  
  }
  
  function return_geckboard_data($data){
  	
  	$response = json_encode($data);
    return $response;
  
  }
  
  function return_geckoboard_pie($data){
  	
    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml .= '<root>';
	
	foreach($data as $segment):
	$xml .= '<item><value>'.$segment['value'].'</value><label>'.$segment['label'].'</label><colour>'.$segment['colour'].'</colour></item>';
	endforeach;		
	
	$xml .= '</root>';
  	
  	return $xml;
  }
  
  function return_geckoboard_stat($data){
  	
  	
  	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml .= '<root>';
	
	foreach($data as $stat):
	$xml .=	'<item><value>'.$stat['value'].'</value><text>'.$stat['label'].'</text></item>';
	endforeach;

	$xml .= '</root>';
	
	return $xml;
  	
  }
  
  function return_geckoboard_meter($data){

  	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml .= '<root>';
	
	$xml .= '<item>'.$data['value'].'</item>';
	$xml .=	'<min><value>'.$data['min']['value'].'</value><text>'.$stat['min']['label'].'</text></min>';
	$xml .=	'<max><value>'.$data['max']['value'].'</value><text>'.$stat['max']['label'].'</text></max>';

	$xml .= '</root>';
	
	return $xml;
  	
  }
  
  function return_geckoboard_text($data){
  	
  	
  	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml .= '<root>';
	
	foreach($data as $stat):
	$xml .=	'<item><type>'.$stat['type'].'</type><text><![CDATA['.$stat['label'].']]></text></item>';
	endforeach;

	$xml .= '</root>';
	
	return $xml;
  	
  }
  
  function return_geckoboard_graph($data){
  
  	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml .= '<root>';
	
	$length = count($data);
	
	$loop = ($length-3);
	
	$i=0;
	foreach($data as $stat):
		if($i < $loop):
			$xml .= '<item>'.$stat.'</item>';
		endif;
		$i++;
	endforeach;
	
	$xml .= '<settings>';
	
	$xml .= '<axisx>'.$data['axisx'][0].'</axisx>';
	$xml .= '<axisx>'.$data['axisx'][1].'</axisx>';
	
	$xml .= '<axisy>'.$data['axisy'][0].'</axisy>';
	$xml .= '<axisy>'.$data['axisy'][1].'</axisy>';
	
	$xml .= '<colour>'.$data['colour'].'</colour></settings></root>';
	
	return $xml;
  
  }
  
}
?>