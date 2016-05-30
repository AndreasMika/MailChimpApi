   
	<div id="main">  
        <pre>         
      	<?php  
	   		$status = NULL;
			
	   		foreach($data['checkUp']['connections'] as $key => $value) {
				if($value == true) {					
					$status = '<strong class="msgSuccess">[OK]</strong>';	
					}  else {
					$status = '<strong class="msgError">[error]</strong>';
					}	
				echo '<p>'.$key.' - '.$status.'</p>';		
			}						
				
	   	?>        
        </pre>         
    </div>	