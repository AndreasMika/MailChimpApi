<i><?php echo $data['tblName']; ?></i>
<br/><br/>

    <?php 		
		
		// GENERATES TABLE HEADER	
		echo '<div class="tbl">';
		
		foreach(array_keys($data['mc_users'][0]) as $rowHeader) {	
			$cssAdd = (in_array($rowHeader, array('id', 'age'))) ? 'notOnMobile' : '';
			$inlineAdd = (in_array($rowHeader, array('id', 'age'))) ? 'style="width:5%;"' : '';			
			echo '<div class="tblHeader '.$cssAdd.'" '.$inlineAdd.'>'.$rowHeader.'</div>';	
		}
		
		echo '</div>';			
		
		
		
		// GENERATES TABLE BODY
		foreach($data[$data['tblName']] as $member) {
			
			echo '<div class="tbl">';
			
			foreach(array_keys($member) as $bit) {	
				$cssAdd = (in_array($bit, array('id', 'age'))) ? 'notOnMobile' : '';
				$inlineAdd = (in_array($bit, array('id', 'age'))) ? 'style="width:5%;"' : '';			
				echo '<div class="tblCell '.$cssAdd.'" '.$inlineAdd.'>'.$member[$bit].'</div>';	
			}			
			
			echo '</div>';
		}
		
		
		
	?> 