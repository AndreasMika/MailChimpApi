   
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
				
				if($key == 'Tables') {	
					foreach($value['connections'] as $key => $value) {
						if($value == true) {					
							$status = '<strong class="msgSuccess">[OK]</strong>';	
						}  else {
							$status = '<strong class="msgError">[error]</strong>';
						}	
						echo '<p>'.$key.' - '.$status.'</p>';			
					}
				} else {
					
				echo '<p>'.$key.' - '.$status.'</p>';		
				}
			}	
				
		
			if($data['checkUp']['connections']['MySQL Connection'] === true &&
			   $data['checkUp']['connections']['Tables']['status'] === false) {				   				   				
				echo '<br/><p>Configured tables not found in DB <strong>'.$data['cfg']['mysql_dbmame'].'</strong>.</p><p>Click <i>Setup Tables</i> in <i>Menu</i> to install all neccesary tables</p>';
			}
			
			if($data['checkUp']['status'] === true) {
				echo '<p>EVERYTHING OK</p>';
				}
				
	   ?>        
        </pre>         
    </div>	