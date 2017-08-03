<div id="main-content" style="width: 135%;">

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->   

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					Coordinators

				</h3>

				<ul class="breadcrumb">

					<li>

						<a href="<?php echo $this->session->userdata('role'); ?>">Dashboard</a>

						<span class="divider">/</span>

					</li>

                    <li class="active">

						Coordinators List

					</li>

				</ul>

				<!-- END PAGE TITLE & BREADCRUMB-->

			</div>

		</div>

		<div class="row_fluid">

        <div class="widget-body">

        <?php

		$attributes=array('name'=>'form1','method'=>'post','class'=>'form-inline');

		echo form_open('webadmin/coordinators', $attributes);

		?>

        

        <div class="container">

        <?php if($this->session->userdata('role')=='webadmin' || $this->session->userdata('role')=='finance'):?>

        National Coordinator : <select name="national"  data-role="National_admin_id" data-get="zone" class="dynopt" ><option value="">All</option>

        <?php foreach($national as $row): if(isset($_POST['national']) && $_POST['national']==$row['user_id'] ): echo '<option selected="selected" value="'.$row['user_id'].'">'.$row['First_name'].'</option>';

		else : ?>

        <option value="<?php echo $row['user_id']?>"><?php echo $row['First_name'];?></option>

        <?php endif; endforeach;?>

        </select>

        <?php endif;  ?>

        <?php if(in_array($this->session->userdata('role'),array('webadmin','national','finance'))):?>

         Zonal Coordinator : <select name="zone" id="zone" data-role="Zonal_admin_id" data-get="state" class="dynopt" ><option value="">All</option> 

         <?php if(isset($zone)):foreach($zone as $zon): if(isset($_POST['zone']) && $_POST['zone']==$zon['user_id'] ): echo '<option selected="selected" value="'.$zon['user_id'].'">'.$zon['First_name'].'</option>'; else : ?>

        <option value="<?php echo $zon['user_id']?>"><?php echo $zon['First_name'];?></option>

        <?php endif; endforeach; endif;?>       

        </select>

        <?php endif;?>

        <?php if(in_array($this->session->userdata('role'),array('webadmin','national','finance','zone'))):?>

         State Coordinator : <select name="state" id="state" data-role="State_admin_id" data-get="state_zone" class="dynopt" ><option value="" >All</option>  

         <?php if(isset($state)):foreach($state as $stat): if(isset($_POST['state']) && $_POST['state']==$stat['user_id'] ): echo '<option selected="selected" value="'.$stat['user_id'].'">'.$stat['First_name'].'</option>'; else : ?>

        <option value="<?php echo $stat['user_id']?>"><?php echo $stat['First_name'];?></option>

        <?php endif; endforeach; endif;?>      

        </select>

        <?php endif; ?>        

        </div>

        <div class="container">

        <?php if(in_array($this->session->userdata('role'),array('webadmin','national','finance','zone','state'))): ?>

        State Zone : <select name="state_zone" id="state_zone" data-role="State_zone_admin_id" data-get="distributer" class="dynopt" ><option value="">All</option>   

         <?php if(isset($state_zone)):foreach($state_zone as $statz): if(isset($_POST['state_zone']) && $_POST['state_zone']==$statz['user_id'] ): echo '<option selected="selected" value="'.$statz['user_id'].'">'.$statz['First_name'].'</option>'; else : ?>

        <option value="<?php echo $statz['user_id']?>"><?php echo $statz['First_name'];?></option>

        <?php endif; endforeach; endif;?>     

        </select>

        <?php endif;  ?>

      

        <input type="submit"  class="btn btn-success" value="SUBMIT" />

        <?php /* if(in_array($this->session->userdata('role'),array('webadmin','national','zone','state','state_zone','county'))): ?>

         Distributor : <select name="distributer" id="distributer" ><option value="">All</option> 

         <?php if(isset($distributer)):foreach($distributer as $distribut): if(isset($_POST['distributer']) && $_POST['distributer']==$distribut['id'] ): echo '<option selected="selected" value="'.$distribut['id'].'">'.$distribut['First_name'].'</option>'; else : ?>

        <option value="<?php echo $distribut['id']?>"><?php echo $distribut['First_name'];?></option>

         <?php endif; endforeach; endif;?>        

        </select>

        

        <?php endif; */ ?>

        </div>

        <?php

		echo form_close();

		?>

        </div>

        </div>

                     

		   <div class="row-fluid">

			<div class="span12">

				<!-- BEGIN EXAMPLE TABLE widget-->

                 <p><a href="webadmin/export" class="btn btn-danger">Export</a></p>

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

                <th class="header">Name</th>

                <th class="header">Role</th>

                <th class="header">Email</th>

                <th class="header">Address</th>  

                <th class="header">State</th> 

                <th class="header">Zip</th> 

                <th class="header">Phone</th>

                

                

                <?php if(in_array($this->session->userdata('role'),array('webadmin','finance'))): ?>

                <th class="header">National Coordinator</th>

                <?php endif; ?>

			    <?php if(in_array($this->session->userdata('role'),array('webadmin','national','finance'))): ?>

                <th class="header">Zone Coordinator</th>

                <?php endif; ?>

			    <?php if(in_array($this->session->userdata('role'),array('webadmin','national','zone','finance'))): ?>

                 <th class="header">State Coordinator</th>

                <?php endif; ?>

			    <?php if(in_array($this->session->userdata('role'),array('webadmin','national','zone','state','finance'))): ?>

                 <th class="header">State Zone Coordinator</th>

                <?php endif; ?>

                <?php

				$cnt_dist = 1;

                foreach($details as $ind=>$row)

                {

					 if(ucfirst($row['admin_type'])=='Distributer' && $cnt_dist==1 )

					 {
/*
						echo '<td>subscription Length</td>';

						echo '<td>Copies Requested</td>';

						echo '<td>Mode of payment</td>';

						echo '<td>Transaction id</th>'; 

						echo '<td>Cash/Cheque by</th>'; 

						echo '<td>Comments</th>'; 

						echo '<td>Total amount</td>';

						echo '<td>subscription date</td>';

						echo '<td>expiry date</td>';*/

	

					 }

					$cnt_dist++; 

				}

					?>

               <!-- <th width="" class="red header" align="center">Action</th>-->

              </tr>

            </thead>

            <tbody>

              <?php

              foreach($details as $ind=>$row)

              {	

			 	$national_coord   = $this->db->query("select a.id as user_id,a.Distributer_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.* from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$row['National_admin_id']." ")->row_array();

				$zone_coord       = $this->db->query("select a.id as user_id,a.Distributer_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.* from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$row['Zonal_admin_id']." ")->row_array();	

				$state_coord      = $this->db->query("select a.id as user_id,a.Distributer_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.* from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$row['State_admin_id']." ")->row_array();

				$state_zone_coord = $this->db->query("select a.id as user_id,a.Distributer_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.* from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$row['State_zone_admin_id']." ")->row_array();	

			    echo '<tr>';

                echo '<td>'.($ind+1).'</td>';

				if($row['admin_type']=='Distributer'){echo '<td>'.$row['disributer_id'].'</td>';}else{ echo '<td>'.$row['id'].'</td>';}

                 echo '<td>'.ucfirst($row['First_name']).'</td>';

				 echo '<td>'.ucfirst($row['admin_type']).'</td>';

				 echo '<td>'.$row['Email_address'].'</td>';

				 echo '<td>'.$row['Mailing_address1'].'<br>'.$row['Mailing_address2'].'</td>';

				 echo '<td>'.$row['State'].'</td>';

				 echo '<td>'.$row['Zipcode'].'</td>';

				 echo '<td>'.$row['Home_phone'].','.$row['Cell_phone'].'</td>';	

               	

				 if(in_array($this->session->userdata('role'),array('webadmin','finance')))

				 {

				   echo '<td>'.$national_coord['First_name'].'</td>';

				 }

				 if(in_array($this->session->userdata('role'),array('webadmin','national','finance')))

				 {

					 echo '<td>'.$zone_coord['First_name'].'</td>';

				 }

                 if(in_array($this->session->userdata('role'),array('webadmin','national','zone','finance')))

				 {

				 	echo '<td>'.$state_coord['First_name'].'</td>';

				 }

				 if(in_array($this->session->userdata('role'),array('webadmin','national','zone','state','finance')))

				 {

					 echo '<td>'.$state_zone_coord['First_name'].'</td>';

				 }

				 if(ucfirst($row['admin_type'])=='Distributer')

				 {

					$res_pay=$this->db->get_where('kr_dis_payment',array('Subscriber_id'=>$row['disributer_id']))->row_array();

					/*echo '<td>'.$row['subscription_length'].'</td>';

					echo '<td>'.$row['Copies_requested'].'</td>';

					echo '<td>'.$row['Mode_of_payment'].'</td>';

					echo '<td>'.$res_pay['txn_id'].'</td>';

					echo '<td>'.$row['Cash_Check_by'].'</td>';

					echo '<td>'.$row['comments'].'</td>';

					echo '<td>'.$row['Total_amount'].'</td>';

					echo '<td>'.$row['subscription_date'].'</td>';

					echo '<td>'.$row['expiry_date'].'</td>';*/



				 }



				   /*echo '<td class="crud-actions" align="center">

                <!-- <a href="'.site_url('user/create_'.$row['admin_type'].'/'.$row['id']).'" class="btn btn-info">Edit</a>-->

				<!--<a href="'.site_url('distributer/profile/'.ucfirst($row['user_id'])).'" class="btn btn-info">Edit</a>&nbsp;-->';

				

				echo '</td>';*/

                echo '</tr>';

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

<script type="application/javascript">

$(function(){

	$(".dynopt").on('change',function(){

		var ths=$(this);

		var parnt=ths.data('role');

		var parnt_id=ths.val();

		var type=ths.data('get');

		if(parnt_id !="")

		{

			$.get("<?php echo site_url('Webadmin/get_by_type'); ?>/"+parnt+'/'+parnt_id+'/'+type,function(retun){

				$("#"+type).html(retun);

			});

		}

		else

		{

			var ind = ths.index(".form-inline select");	

			$(".form-inline select:gt("+ind+")").html('<option value="" >All</option>');

		}

		

	});

});

</script>