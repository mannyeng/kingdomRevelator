<style>

/*.row-fluid

{

min-width:1600px !important;	

	}

	#main-content

	{

	min-width:1700px !important;	

		}*/

</style>

<div id="main-content">

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->   

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					Subscribers List

				</h3>

				<ul class="breadcrumb">

					<li>

						<a href="national">Dashboard</a>

						<span class="divider">/</span>

					</li>

                    <li>

						<a href="national">National</a>

						<span class="divider">/</span>

					</li>

                    <!--<li>

						<a href="national/zone_list">Zone List</a>

						<span class="divider">/</span>

					</li>

					<li>

						<a href="national/state_list">State List</a>

						<span class="divider">/</span>

					</li>

                    <li>

						<a href="national/state_zone_list">State Zone</a>

						<span class="divider">/</span>

					</li>

                    <li>

						<a href="national/county_list">County List</a>

						<span class="divider">/</span>

					</li>

                    <li>

						<a href="national/distributers_list">Distributers List</a>

						<span class="divider">/</span>

					</li>-->

					<li class="active">

						Subscribers List

					</li>

				</ul>

				<!-- END PAGE TITLE & BREADCRUMB-->

			</div>

		</div>

		

        <div class="row-fluid">

       

          <div class="well">

           

            <?php

	  ?>

          

		<!-- BEGIN ADVANCED TABLE widget-->

      <p><a href="webadmin/export_subscribers/<?php echo $this->uri->segment(3);?>" class="btn btn-danger">Export</a></p>

        <div class="row-fluid">

			<div class="span12">

				<!-- BEGIN EXAMPLE TABLE widget-->

				<div class="widget blue">

					<div class="widget-title">

						<h4><i class="icon-reorder"></i> List All </h4>

						<span class="tools">

							<a href="javascript:;" class="icon-chevron-down"></a>

						</span>

					</div>

					<div class="widget-body">

						<table class="table table-striped table-bordered table-condensed" id="sample_1">

							<thead>

              <tr>

                <th class="header">#</th>

                <th class="header">ID</th>

                <th class="header">First Name</th>

                <th class="header">Last Name</th>                

                <th class="header">City</th>

                <th class="header">State</th>

                <th class="header">Zip</th>

                <th class="header">No .of copies</th>

                <th class="header">National Coordinator</th>

                <th class="header">Zone Coordinator</th>

                <th class="header">State Coordinator</th>

                <th class="header">State zone Coordinator</th>

                <th width="60" class="header">Subscription Time</th>  

                <th width="60" class="header">Expiration Time</th>                                          

              </tr>

            </thead>

            <tbody>

              <?php

              foreach($subscriber as $ind=>$row)

              {	

			 	if($row['Subscriptions']==25)

				{

					 $dateString = $row['subscription_date'];

					 $t = strtotime($dateString);

					 $expiry_date = date('Y-m-d',strtotime('+1 years', $t));

					//echo $expiry_date = date('Y-m-d',strtotime($row['subscription_date'])+strtotime('+5 years'));

				}

				if($row['Subscriptions']==45)

				{

					 $dateString = $row['subscription_date'];

					 $t = strtotime($dateString);

					 $expiry_date = date('Y-m-d',strtotime('+2 years', $t));

					//echo $expiry_date = date('Y-m-d',strtotime($row['subscription_date'])+strtotime('+5 years'));

				}

				$this->db->join('kr_subscribers','kr_subscribers.Distributer_id=kr_users.id','innerjoin');

			    $results = $this->db->get_where('kr_users',array('kr_users.id'=>$this->uri->segment('3')))->result_array();

				foreach($results as $result)

				{

					$national_coord   = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where b.id=".$result['National_admin_id']." ")->row_array();

					$zone_coord       = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['Zonal_admin_id']." ")->row_array();	

					$state_coord      = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['State_admin_id']." ")->row_array();

					$state_zone_coord = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['State_zone_admin_id']." ")->row_array();	

				}

			  	//$counts=explode("#$",$row['counts']);

				

				//$balance = $counts[3] - $row['paid_amt'];

				//$pending=(($counts[1]-$row['waitl']) < 0)? 0 :($counts[1]-$row['waitl']);		

                echo '<tr>';

                echo '<td>'.($ind+1).'</td>';

				echo '<td>'.$row['id'].'</td>';

                echo '<td>'.$row['First_name'].'</td>';

				echo '<td>'.$row['Last_name'].'</td>';

				echo '<td>'.$row['City'].'</td>';

				echo '<td>'.$row['State'].'</td>';

				echo '<td>'.$row['Zipcode'].'</td>';

				echo '<td>'.$row['No_of_copies'].'</td>';

				echo '<td>'.$national_coord['First_name'].'</td>';

				echo '<td>'.$zone_coord['First_name'].'</td>';

				echo '<td>'.$state_coord['First_name'].'</td>';

				echo '<td>'.$state_zone_coord['First_name'].'</td>';

				//echo '<td>'. number_format($balance,2).'</td>';

				echo '<td>'.date('Y-m-d',strtotime($row['subscription_date'])).'</td>';	

				echo '<td>'.date('Y-m-d',strtotime($row['expiry_date'])).'</td>';			

                // if( $this->session->userdata('role') !='coordinator'):           

            //    echo '<td class="crud-actions" align="center">

                //  <a href="groups/update/'.$row['retreat_id'].'/'.$row['group_id'].'" class="btn btn-info">Edit</a>&nbsp;';				  				//else:

				   /*echo '<td class="crud-actions" align="center">

                 <a href="County/subscribers_list/'.$row['id'].'" class="btn btn-info">view subscribers</a>&nbsp;';*/

				//endif;

                echo '</td></tr>';

              }

              ?>      

            </tbody>

						</table>

					</div>

				</div>

				<!-- END EXAMPLE TABLE widget-->

			</div>

		</div>



		<!-- END ADVANCED TABLE widget-->

	</div>

	<!-- END PAGE CONTAINER-->

</div>