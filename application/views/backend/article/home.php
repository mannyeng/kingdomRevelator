<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Distributer Management
				</h3>
				<ul class="breadcrumb">
					<li>
						<a href="article">Dashboard</a>
						<span class="divider">/</span>
					</li>
					<li>
						<a href="article">Article</a>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
        
        <!-- END PAGE HEADER-->
     <!--   <?php
		$future = strtotime($row['expiry_date']); //Future date.
		$timefromdb =strtotime(date("Y-m-d"));
		$timeleft = $future-$timefromdb;
		$daysleft = round((($timeleft/24)/60)/60); 
		?>
        <div class="metro-nav">
       <div class="metro-nav-block nav-olive">
            <a data-original-title="" href="javascript:;">
                <div class="info"><?php// echo  date('Y-m-d',strtotime($row['subscription_date'])); ?></div> 
                Subscription Start at 
            </a>
        </div>
        <div class="metro-nav-block nav-block-blue">
             <a data-original-title="" href="javascript:;">
                <div class="info"><?php// echo date('Y-m-d',strtotime($row['expiry_date'])); ?></div> 
                Subscription End at 
            </a>
        </div>
        <div class="metro-nav-block nav-block-green">
             <a data-original-title="" href="javascript:;">
                <div class="info"><?php// echo $daysleft;?> Days</div>
                Remaining
            </a>
        </div>
       </div>-->
		<!-- BEGIN PAGE CONTENT-->
		
				
		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
        <div class="widget blue">
					<div class="widget-title">
						<span class="tools">
							<a href="javascript:;" class="icon-chevron-down"></a>
						</span>
					</div>
                    </div>
			<!--BEGIN METRO STATES-->
			<div class="metro-nav">
				
				<!--<div class="metro-nav-block nav-olive">
					<a data-original-title="" href="county/subscribers_save">
						<i class="icon-heart"></i>
						<div class="info">Add New</div>
						<div class="status">Subscriber</div>
					</a>
				</div>-->
                <?php foreach($articles as $key){?>
				<div class="metro-nav-block nav-olive">
					<a data-original-title="" href="article/submit_article/<?php echo $key['id']; ?>">
						<i class="icon-list"></i>
						<div class="info">view</div>
						<div class="status"><?php echo $key['memo']; ?></div>
					</a>
				</div>
				 <?php } ?>	
			</div>
		
			<!--END METRO STATES-->
		</div>

		<!-- END PAGE CONTENT-->
	</div>
	<!-- END PAGE CONTAINER-->
</div>