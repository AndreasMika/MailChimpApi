
	<div id="main">  
        <pre>  
        
        <?php
		if($data['checkUp']['status'] === false) {
			echo 'This will create tables('.count($data['cfg']['mcTables']).') in  <strong>'.$data['cfg']['mysql_dbmame'].'</strong>
			
	Click <a href="'.$data['cfg']['host_path'].'install/go">install now</a> to continue';
		} else {
			echo 'EVERYTHING OK - NO NEED TO INSTALL TABLES';
		}
		
		
		?>
        
        </pre>         
    </div>	
	
	