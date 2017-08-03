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

<div id="main-content" style="width: 140%;">

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->   

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					Gift Subscribers List

				</h3>

				<ul class="breadcrumb">

					<li>

						<a href="webadmin">Dashboard</a>

						<span class="divider">/</span>

					</li>

                   

					<li class="active">

						Gift Subscribers List

					</li>

				</ul>

				<!-- END PAGE TITLE & BREADCRUMB-->

			</div>

		</div>

		

        <div class="row-fluid">

       

          <div class="well">

           

            <?php

           /*

            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');

           

            //save the columns names in a array that we will use as filter         

            $options_retreats = array('t.group_id'=>'Group ID','m.first_name'=>'First Name','m.last_name'=>'Last Name','m.age'=>'Age','m.gender'=>'Gender','t.state'=>'State','t.country'=>'Country');    

			

			$filter_retreats = array(''=>'All','zone'=>'Zone','state'=>'State','state zone'=>'State zone','county'=>'County','distributer'=>'Distributer');    

            



            echo form_open('webadmin/subscribers_list_report/'.$this->uri->segment(3), $attributes);

     

             /* echo form_label('Search:', 'search_string');

              echo form_input('search_string', $search_string_selected, 'class="form-control" style="width:120px"');*/

			  

			/*  echo form_label('Filter by:', 'filter');

              echo form_dropdown('filter', $filter_retreats,@$filter, 'class="form-control span1" id="filter"  onchange="getData(this.value,0);"');

			  

			  echo form_label('Filter by:', 'users');

              echo form_dropdown('users','',@$users,'class="form-control span1" id="Users"');

			  

			  echo form_label('From:', 'from_date');

			  echo '<div data-form="datetimepicker" class="input-append date" style="display:inline">';

              echo form_input('from_date', @$from_date_selected, 'class="form-control" id="from_date" data-format="MM-dd-yyyy" style="width:120px" ');

			  echo '<span class="add-on">

                <i data-time-icon="icon-time" data-date-icon="icon-calendar">

                  </i>

                </span></div>';

			  

			   echo form_label('To:', 'to_date');

			   echo '<div data-form="datetimepicker" class="input-append date" style="display:inline">';

              echo form_input('to_date', @$to_date_selected, 'class="form-control" id="to_date" data-format="MM-dd-yyyy" style="width:120px" ');

			  echo '<span class="add-on">

                <i data-time-icon="icon-time" data-date-icon="icon-calendar">

                  </i>

                </span></div>';

			  

              /*echo form_label('Order by:', 'order');

              echo form_dropdown('order', $options_retreats, $order, 'class="form-control span1"');*/



            /*  $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');



              /*$options_order_type = array('Asc' => 'Ascending', 'Desc' => 'Descending');

              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="form-control span1"');*/



             /* echo form_submit($data_submit);



            echo form_close();*/

			            ?>

       

          </div>

          </div>

          <?php if($this->session->flashdata('flash_message')){

        if($this->session->flashdata('flash_message') == 'updated')

        {

          echo '<div class="alert alert-success">';

            echo '<a class="close" data-dismiss="alert">×</a>';

            echo 'Group updated successfully.';

          echo '</div>';       

        }

      }

	  ?>

          

		<!-- BEGIN ADVANCED TABLE widget-->

      <p><a href="national/export_all_gift_subscribers" class="btn btn-danger">Export</a></p>

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

              <th class="header">#</th>

                <th class="header">ID</th>

                <th class="header">First Name</th>

                <th class="header">Last Name</th>   
                 <th class="header">Mailing Address 1</th> 
                  <th class="header">Mailing Address 2</th> 
                            


                <th class="header">City</th>

                <th class="header">State</th>

                <th class="header">Zip</th>
                 <th class="header">Billing Address 1</th> 
                  <th class="header">Billing Address 2</th> 
                  <th class="header">Billing City</th> 
                  <th class="header">Billing State</th> 

                  <th class="header">Billing Zip</th> 
                  <th class="header">Home Phone</th>
                  <th class="header">Home Cellphone</th> 
                  <th class="header">Email Address</th>  
                  <th class="header">Church name</th> 
                  <th class="header">Enter By</th> 
                  <th class="header">Created</th> 
                                                  

              </tr>

            </thead>

            <tbody>

              <?php
            $ind=1;
//pr($subscriber);

if(!empty($subscriber)){
              foreach($subscriber as $ind=>$result)

              {	

			 	


			
				   

	                echo '<tr>';

	                echo '<td>'.($ind+1).'</td>';

					echo '<td>'.$result['Subscriber_id'].'</td>';

	                echo '<td>'.$result['First_name'].'</td>';

					echo '<td>'.$result['Last_name'].'</td>';
					echo '<td>'.$result['Mailing_address1'].'</td>';
					echo '<td>'.$result['Mailing_address2'].'</td>';

					echo '<td>'.$result['City'].'</td>';

					echo '<td>'.$result['State'].'</td>';

					echo '<td>'.$result['Zipcode'].'</td>';
					echo '<td>'.$result['BillingAddress1'].'</td>';
					echo '<td>'.$result['BillingAddress2'].'</td>';
					echo '<td>'.$result['BillingCity'].'</td>';

					echo '<td>'.$result['BillingState'].'</td>';

					echo '<td>'.$result['BillingZip'].'</td>';
					echo '<td>'.$result['Home_phone'].'</td>';
					echo '<td>'.$result['Cell_phone'].'</td>';
					echo '<td>'.$result['Email_address'].'</td>';
					echo '<td>'.$result['Church_name'].'</td>';
					echo '<td>'.$result['Enter_by'].'</td>';
					echo '<td>'.$result['created_date'].'</td>';
	                echo '</tr>';
	                $ind++;
                  
              }
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


