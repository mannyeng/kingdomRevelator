<div class="span12">

				
							
								
									<table class="table table-striped table-bordered table-condensed" id="sample_1">

              <thead>

              <tr>

                <th class="header">#</th>

               

                <th  class="header">Subs. Date</th>  

                <th  class="header">Expiry Date</th> 

                <th  class="header">Subs. Length ( Months )</th> 
                <th  class="header">Number of Copies</th> 
                <th  class="header">Payment Mode</th> 
                <th  class="header">Order Created Date</th> 


 
                                                         

              </tr>

            </thead>

            <tbody>

              <?php
            // pr($orders);
if(count($history) > 0) {
 
  $i = 1;
              foreach($history as $row)

             { 

       

          

        echo '<tr>';

        echo '<td>'.$i.'</td>';


       

        echo '<td>'.$row['subscription_date'].'</td>';

        echo '<td>'.$row['expiry_date'].'</td>';    

       echo '<td>'.$row['subscription_length'].'</td>'; 
        echo '<td>'.$row['No_of_copies'].'</td>'; 
         echo '<td>'.$row['Mode_of_pay'].'</td>'; 
         echo '<td>'.$row['order_date'].'</td>'; 
        
          
          
         
                echo '</tr>';
$i++;
           }
         }
         
              ?>      

            </tbody>

            </table>
									
									
								
							
					
			
			
		</div>
