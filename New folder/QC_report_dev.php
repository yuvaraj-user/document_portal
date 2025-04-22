
<?php include '../../auto_load.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Quality -Report </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Quality -Report" name="description" />
	<meta content="Themesdesign" name="author" />
	<!-- App favicon -->
	
	<link rel="shortcut icon" href="../../global/photos/favicon.ico" />

	<!-- Bootstrap Css -->
	<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<!-- App Css -->
	<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
	<!-- Custom Css -->
	<link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
<!-- DataTables -->
<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<script src="assets/libs/jquery/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Responsive datatable examples -->
<link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />


    <style>
.badge {
    --bs-badge-padding-x: 0.4em;
    --bs-badge-padding-y: 0.25em;
    --bs-badge-font-size: 1.75em;
    --bs-badge-font-weight: 700;
    --bs-badge-color: #fff;
    --bs-badge-border-radius: var(--bs-border-radius);
    display: inline-block;
    padding: var(--bs-badge-padding-y) var(--bs-badge-padding-x);
    font-size: var(--bs-badge-font-size);
    font-weight: var(--bs-badge-font-weight);
    line-height: 1;
    color: var(--bs-badge-color);
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: var(--bs-badge-border-radius);
}.dataTables_scrollFoot{

	background-color: #4f88b9;
}

#location_date {
	   height: 40px;
}

    </style>
</head>

<body data-sidebar="dark" class="sidebar-enable vertical-collpsed">
	
	<!-- Begin page -->
	<div id="layout-wrapper">

			<?php include 'Tophead.php'; ?>	
		<!-- ========== Left Sidebar Start ========== -->
		<div class="vertical-menu">

			<div data-simplebar class="h-100">

			
			<?php include 'sidebar.php'; ?>	




    


  	  ?>
			
			</div>
		</div>
		<!-- Left Sidebar End -->

		<div class="main-content" >
			


			<div class="page-content">
	<div class="container-fluid">

		<!-- start page title -->
		<div class="row">
			<div class="col-sm-6">
				<div class="page-title-box">
					<h4>Dashboard</h4>
					
				</div>
			</div>
			<!--<div class="col-sm-6">
				<div class="state-information d-none d-sm-block">
					<div class="state-graph">
						<div id="header-chart-1"></div>
						<div class="info">Balance $ 2,317</div>
					</div>
					<div class="state-graph">
						<div id="header-chart-2"></div>
						<div class="info">Item Sold 1,230</div>
					</div>
				</div>
			</div>-->
		</div>
		<!-- end page title -->

		<!--<div class="row">
			<div class="col-xl-2 col-sm-6">
				<div class="card mini-stat bg-primary">
					<div class="card-body mini-stat-img">
						<div class="mini-stat-icon">
							<i class="mdi mdi-cube-outline float-end"></i>
						</div>
						<div class="text-white">
							<h6 class="text-uppercase mb-3 font-size-16 text-white">Central</h6>
							<h2 class="mb-4 text-white"><?=$Central_plan?></h2>
							<span class="badge bg-info"> <?=$Central_Actual?></span> <span class="ms-40">Actual Value</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-sm-6">
				<div class="card mini-stat bg-primary">
					<div class="card-body mini-stat-img">
						<div class="mini-stat-icon">
							<i class="mdi mdi-buffer float-end"></i>
						</div>
						<div class="text-white">
							<h6 class="text-uppercase mb-3 font-size-16 text-white">North 1</h6>
						    <h2 class="mb-4 text-white"><?=$North1_plan?></h2>
							<span class="badge bg-info"><?=$North1_Actual?> </span> <span class="ms-4">Actual Value</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-sm-6">
				<div class="card mini-stat bg-primary">
					<div class="card-body mini-stat-img">
						<div class="mini-stat-icon">
							<i class="mdi mdi-tag-text-outline float-end"></i>
						</div>
						<div class="text-white">
							<h6 class="text-uppercase mb-3 font-size-16 text-white">North 2</h6>
							<h2 class="mb-4 text-white"><?=$North2_plan?></h2>
							<span class="badge bg-info"><?=$North2_Actual?> </span> <span class="ms-4">Actual Value</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-sm-6">
				<div class="card mini-stat bg-primary">
					<div class="card-body mini-stat-img">
						<div class="mini-stat-icon">
							<i class="mdi mdi-briefcase-check float-end"></i>
						</div>
						<div class="text-white">
							<h6 class="text-uppercase mb-3 font-size-16 text-white">South</h6>
							<h2 class="mb-4 text-white"><?=$South_plan?></h2>
							<span class="badge bg-info"><?=$South_Actual?> </span> <span class="ms-4">Actual Value</span>
						</div>
					</div>
				</div>
			</div>


			<div class="col-xl-2 col-sm-4">
				<div class="card mini-stat bg-primary">
					<div class="card-body mini-stat-img">
						<div class="mini-stat-icon">
							<i class="mdi mdi-briefcase-check float-end"></i>
						</div>
						<div class="text-white">
							<h6 class="text-uppercase mb-3 font-size-14 text-white">Tamilnadu</h6>
							<h2 class="mb-4 text-white"><?=$Tamilnadu_plan?></h2>
							<span class="badge bg-info"><?=$Tamilnadu_Actual?> </span> <span class="ms-4">Actual Value</span>
						</div>
					</div>
				</div>
			</div>



		</div>-->



		    <div class="container-fluid">

       
    
        <!-- Data Table-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title" style="text-align: center;">QA field observation report</h4>
                     

                     			<div class="row">

                     				<div class="col-md-2">
										<label for="location_date" class="form-label">Date</label>
										<input type="text" class="form-control location_date" name="location_date" id="location_date" />
									</div>
									
									
									<div class="col-md-2">
										<label for="SeasonCode" class="form-label">SeasonCode</label>
										<select class="form-select SeasonCode select2" id="SeasonCode" name="SeasonCode" required>
											<option value="">Choose Season</option>

											<option value="18KW">18KW</option>
										
										</select>
									</div>


									<div class="col-md-2">
										<label for="Plant" class="form-label">Plant</label>
										<select class="form-select Plant select2" id="Plant" name="Plant" required>
											<option value="">Choose Plant</option>

											<option value="P009">P009</option>
										
										</select>
									</div>


									<div class="col-md-2">
										<label for="CropCode" class="form-label">CropCode</label>
										<select class="form-select CropCode select2" id="CropCode" name="CropCode" required>
											<option value="">Choose Crop</option>

											<option value="014">014</option>
										
										</select>
									</div>



									<div class="col-md-2">
										<label for="Yearcode" class="form-label">YearCode</label>
										<select class="form-select Yearcode select2" id="Yearcode" name="Yearcode" required>
											<option value="">Choose Yearcode</option>

											<option value="PR18">PR18</option>
										
										</select>
									</div>





								

									

									<div class="col-md-2 mt-2">
										<br>
										<button type="button" class="btn btn-success" id="filter">Submit</button>
										
									</div>
								</div>

                   <div class="row mt-4">


                        <table class="table table-bordered table-hover table table-bordered  nowrap" cellspacing="0" width="100%" id="QC_report" data-loaded='no' style=" width: 100%;">
              <thead>
                  <tr>                    
 <th  style="text-align:center;border-bottom: 1px solid;">S.No</th>
                   <th  style="text-align:center;border-bottom: 1px solid;">	FLDINSPID	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	FARMER_CODE	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	INSPECTIONDATE	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	TZONE	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	MATNR	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	INSP_CODE	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	INSP_DESC	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	CROPCODE	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	NOOFDAYS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	ISO_DIST	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	STAGEOFINSPECTION	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	TOTAL	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	NOOFCOUNTS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	MALE_OFF	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	FEMALE_OFF	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	FEMALE_SB	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	MALE_SB	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	DISEASED_PLANTS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	FEMALE_POP	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	AVG_BALLS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	UPROOT_MALE	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	CONDITIONOFCROP	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	CROPAGE	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	FACODE	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	WERKS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	YEARCODE	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	OPENFLOWERS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	IMPROPEREMASCULATION	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	IMPROPERDUSTING	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	MORNINGEMASCULATION	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	QC_PERSON	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	HYBRID	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	FERTILEPLANT	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	PRT_SEED_PURITY	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	PREV_CROP	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	ISO_PBLM	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	TIME_ISO	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	NATURE_CONT	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	FLOWER_CONT	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	CROP_UNIFORMITY	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	OFFTYPES_ROG_MX	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	OFFTYPES_ROG_FX	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	FM_TASSEL_SHEDDING	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	NICK_COVER	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	MALE_STAND_POP	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	CROP_HEALTH	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	MALE_DEST_STATUS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	QA_STATUS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	STAGE_DETASSELING	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	PER_DETASSELING	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	PER_SILKING	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	PER_MALE_SHEDDING	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	SHED_TASSELS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	NON_SHED_TASSELS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	REMARKS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	FVSTATUS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	DISTANCE_CONTAMINANT	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	NICK_CONTAMINANT	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	BARRIER	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	MALE	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	FEMALE	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	SHEDDERS	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	MALE_HARVEST	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	IMAGEPATH1	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	IMAGEPATHEXT1	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	IMAGEPATH2	</th>
<th  style="text-align:center;border-bottom: 1px solid;">	IMAGEPATHEXT2	</th>

                 
                   </tr>
              </thead >

              <tbody class="closereuest">

              </tbody>    

                      
              </table>
                    </div>

                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
		<!-- end row -->

	


	</div>
	<!-- container-fluid -->
</div>
		</div>

		<footer class="footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						©
						<script>document.write(new Date().getFullYear())</script>  <span
							class="d-none d-sm-inline-block"> Rasi Seeds (P) Ltd</span>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<!-- Right Sidebar -->
	<div class="right-bar">
		<div data-simplebar class="h-100">

			<div class="rightbar-title d-flex align-items-center px-3 py-4">

				<h5 class="m-0 me-2">Settings</h5>

				<a href="javascript:void(0);" class="right-bar-toggle ms-auto">
					<i class="mdi mdi-close noti-icon"></i>
				</a>
			</div>

			<!-- Settings -->
			<hr class="mt-0" />

			

			

		</div> <!-- end slimscroll-menu-->
	</div>
	<!-- /Right-bar -->

	<!-- Right bar overlay-->
	<div class="rightbar-overlay"></div>

	<!-- JAVASCRIPT -->
	<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="assets/libs/simplebar/simplebar.min.js"></script>
	<script src="assets/libs/node-waves/waves.min.js"></script>
	<script src="assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>

	<!-- App js -->
	<script src="assets/js/app.js"></script>
	<!-- <script src="assets/js/ajax.js"></script> -->

	<script src="assets/libs/morris.js/morris.min.js"></script>
<script src="assets/libs/raphael/raphael.min.js"></script>

<script src="assets/js/pages/dashboard.init.js"></script>

<script>
	$('#header-chart-1').sparkline([8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
		type: 'bar',
		height: '32',
		barWidth: '5',
		barSpacing: '3',
		barColor: '#7A6FBE'
	});
	$('#header-chart-2').sparkline([8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
		type: 'bar',
		height: '32',
		barWidth: '5',
		barSpacing: '3',
		barColor: '#29bbe3'
	});
</script>

<script>


	$(document).ready(function(){
    

	$('#location_date').daterangepicker({
		autoUpdateInput: false,
		locale: {
      		format: 'DD/MM/YYYY'
    	}
	},    	function(start, end, label) {
        	let fromDate = start.format("DD/MM/YYYY");
        	let toDate = end.format("DD/MM/YYYY");
        	let location_date = fromDate + ' - ' + toDate;
        	$("#location_date").val(location_date);
    	});

	 var user_input = {};
	 user_input.SeasonCode = $('.SeasonCode').val();
	 user_input.Plant  = $('.Plant').val();
	 user_input.CropCode = $('.CropCode').val();
	 user_input.Yearcode = $('.Yearcode').val();
	 user_input.location_date = $('.location_date').val();
  

  
   Server_Side_Datatable("no",user_input);
   $('.select2').select2();


  });

function Get_Footer_Details(user_input){



   $.ajax({
              type:'POST',
              url:'Mustard_Product_report_footer.php',
              "data": {Action:'Mustard_Product_report_footer',user_input : user_input},
              success:function(html){
            $(".Footer_Total").html(html);
             
              }
              });
  
}
 function Server_Side_Datatable(destroy_status,user_input)
{
	// console.log(user_input);
//Get_Footer_Details(user_input);

// jQuery.fn.DataTable.Api.register( 'buttons.exportData()', function ( options ) {
//                  if ( this.context.length ) {
//                      var jsonResult = $.ajax({

//                         "url": "Common_Ajax.php", 
//                          type:'POST',
//                          dataType:'json',
//                          "data": {Action:"Mustard_Product_report",length:"All",user_input : user_input},
//                          async: false,
//                      });
      
                  
//                      let headers=['S.No','Division','Region','Territory','EsoCode','Eso Name','Retailer Name','Location','Date','RMX-9906 (Plan)','RMX-9906 (Actual)','RMX-9922 (Plan)','RMX-9922 (Actual)','RMX-9903(Plan)','RMX-9903 (Actual)','Karuna Gold(Plan)','Karuna Gold(Actual)','Anmol(Plan)','Anmol(Actual)','Total(Plan)','Total(Actual)','RMX-9906 (Actual)','RMX-9922 (Actual)','RMX-9903 (Actual)','Karuna Gold(Actual)','Anmol(Actual)','Total(Actual)'];

      
                     
//                      return {
//                        body: jsonResult.responseJSON.data, 
//                        header: headers};
//                  }
//              } );
   var data_table='QC_report'
   if(destroy_status == "yes")
  {
    $('#'+data_table).DataTable().destroy();
  }

  
 $('#'+data_table).DataTable({

    "dom": 'Bfrtip',

	// "columnDefs": [
	// 	{ targets: [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21,22,23,24,25,26 ], className: 'dt-body-right' },
    // ],
 
    "scrollX": true,
    "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
    "bprocessing": true,
    "serverSide": true,
    "pageLength": 10,
    "ajax": 
    {
      "url": "Common_Ajax.php", 
      "type": "POST",
      "data": {Action:"QC_Product_report",user_input : user_input}
    }

  
  });
}

	function get_region(zone_name = '')
	{
		$.ajax({
			url: 'common_ajax.php',
			type: 'POST',
			data: { Action : 'get_region',zone_name : zone_name },
			dataType: "json",
			beforeSend: function(){
				// showLoader();
			},
			success: function(response) {
				var option = '<option value="">Choose Region</option>';
				for(i in response) {
						option += `<option value="${ response[i].Region_Name }">${ response[i].Region_Name }</option>`;
 				}
 				$('#Region').html(option);

   				$('#Region').select2();

			},
			complete:function() {
				// hideLoader();
			}
		});

	}

	function get_territory(zone_name = '',region_name = '')
	{
		$.ajax({
			url: 'common_ajax.php',
			type: 'POST',
			data: { Action : 'get_territory',zone_name : zone_name,region_name : region_name },
			dataType: "json",
			beforeSend: function(){
				// showLoader();
			},
			success: function(response) {
				var option = '<option value="">Choose Territory</option>';
				for(i in response) {
						option += `<option value="${ response[i].TERRITORY }">${ response[i].TERRITORY }</option>`;
 				}
 				$('#Territory').html(option);
   				$('#Territory').select2();


			},
			complete:function() {
				// hideLoader();
			}
		});

	}

	function get_retailer(zone_name = '',region_name = '',territory = '')
	{
		$.ajax({
			url: 'common_ajax.php',
			type: 'POST',
			data: { Action : 'get_retailer',zone_name : zone_name,region_name : region_name,territory : territory },
			dataType: "json",
			beforeSend: function(){
				// showLoader();
			},
			success: function(response) {
				var option = '<option value="">Choose Retailer</option>';
				for(i in response) {
						option += `<option value="${ response[i].Retailar_Name }">${ response[i].Retailar_Name }</option>`;
 				}
 				$('#Retailer').html(option);
 				$('#Retailer').select2();

			},
			complete:function() {
				// hideLoader();
			}
		});

	}


	$(document).on('change','.Zone',function(){
		var zone = $(this).val();
		get_region(zone);
	});	

	$(document).on('change','.Region',function(){
		var zone = $('.Zone').val();
		var region = $(this).val();
		get_territory(zone,region);
	});	


	$(document).on('change','.Territory',function(){
		var zone = $('.Zone').val();
		var region = $('.Region').val();
		var territory = $(this).val()
		get_retailer(zone,region,territory);
	});	


	$(document).on('click','#filter',function(){
		 var user_input = {};
		 user_input.zone = $('.Zone').val();
		 user_input.region = $('.Region').val();
		 user_input.territory = $('.Territory').val();
		 user_input.retailer = $('.Retailer').val();
		 user_input.location_date = $('.location_date').val();

		 Server_Side_Datatable('yes',user_input)

	});
	
	</script>


	<script src="../../global/vendor/datatables.net/jquery.dataTablesfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-bs4/dataTables.bootstrap4fd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-rowgroup/dataTables.rowGroup.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-scroller/dataTables.scroller.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-responsive/dataTables.responsive.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-buttons/dataTables.buttons.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-buttons/buttons.html5.minfd53.js?v4.0.1"></script>
 
  <script src="../../global/vendor/datatables.net-buttons/buttons.print.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-buttons/buttons.colVis.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.minfd53.js?v4.0.1"></script>

  <script src="../../global/js/Plugin/datatables.minfd53.js?v4.0.1"></script>
<script src="../../assets/js/menu.js?v4.0.1"></script>

<script src="../../../common/checkSession.js"></script>


</body>

</html>