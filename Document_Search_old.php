<?php 
include '../auto_load.php'; 

if(!isset($_SESSION['EmpID'])) {
	header('Location: https://devcorporate.rasiseeds.com/corporate/pages/landing.php');
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>SOP Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Document Search" name="description" />
	<meta content="Themesdesign" name="author" />
	<!-- App favicon -->
	
	<link rel="shortcut icon" href="../global/photos/favicon.ico" />

	<!-- Bootstrap Css -->
	<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

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

	<!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- simple pagination -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/simplePagination.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.min.js"></script>

    <style>
		.ajaxloader {
		    width: 100%;
		    height: 100vh;
		    display: flex;
		    flex-wrap: wrap;
		    align-items: center;
		    justify-content: center;
		/*    position: fixed;*/
		    z-index: 999999999999999999;
		    right: 0;
		    display: none;
		    background: #73737387;
		    position: fixed;
		    bottom: 0px;
		}
		.loader {
		  width: 12px;
		  aspect-ratio: 1;
		  border-radius: 50%;
		  background: #000;
		  clip-path: inset(-220%);
		  animation: l28 2s infinite linear;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		}
		@keyframes l28 {
		  0%  {box-shadow:0 0 0 0   , 40px 0,-40px 0,0 40px,0 -40px}
		  10% {box-shadow:0 0 0 0   , 12px 0,-40px 0,0 40px,0 -40px}
		  20% {box-shadow:0 0 0 4px , 0px  0,-40px 0,0 40px,0 -40px}
		  30% {box-shadow:0 0 0 4px , 0px  0,-12px 0,0 40px,0 -40px}
		  40% {box-shadow:0 0 0 8px , 0px  0,  0px 0,0 40px,0 -40px}
		  50% {box-shadow:0 0 0 8px , 0px  0,  0px 0,0 12px,0 -40px}
		  60% {box-shadow:0 0 0 12px, 0px  0,  0px 0,0  0px,0 -40px}
		  70% {box-shadow:0 0 0 12px, 0px  0,  0px 0,0  0px,0 -12px}
		  80% {box-shadow:0 0 0 16px, 0px  0,  0px 0,0  0px,0  0px }
		  90%,
		  100%{box-shadow:0 0 0 0   , 40px 0,-40px 0,0 40px,0 -40px}
		}

    	#main_section {
            min-height: 100vh;
        }  

        .no_result {
            width: 250px;
            height: 250px;
        }
        
        .search_result
        {
            padding: 30px;
        }

        .b-border {
            border-bottom: 1px solid #80808047;
        }

        .form-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin-bottom: 1.5rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        } 

        .shadow {
            box-shadow: 0 6px 17px #80808045 !important;
        }   

        /* pagination styles */
        .current,.prev,.next {
            width: 40px;
            height: 40px;
            vertical-align: middle;
            text-align: center !important;
            line-height: 35px !important;
            background: #FFA725 !important;
            border: 1px solid !important;
            cursor: pointer !important;
            color: white;
        }

        .page-link {
            width: 40px;
            height: 40px;
            vertical-align: middle;
            text-align: center !important;
            line-height: 35px !important;
            cursor: pointer !important;    
        }
        /* pagination styles end */

        .vertical-collpsed
        {
        	min-height: unset !important;
        }

        .folder{
        	cursor: pointer;
        }

        .folder-card {
        	box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
        }
        .folder-card:hover {
        	scale: 1.01;
        }        
    </style>

</head>

<body data-sidebar="dark" class="sidebar-enable vertical-collpsed">
		<div class="ajaxloader">
				<div class="loader"></div>
    	</div>

	<!-- Begin page -->
	<div id="layout-wrapper">

			<?php include 'Tophead.php'; ?>	
		<!-- ========== Left Sidebar Start ========== -->
		<div class="vertical-menu">

			<div data-simplebar class="h-100">
			
				<?php include 'sidebar.php'; ?>	
			
			</div>
		</div>
		<!-- Left Sidebar End -->

		<div class="main-content" >
			<div class="page-content">
				<div class="container-fluid">

					<!-- start page title -->
					<!-- <div class="row">
						<div class="col-sm-6">
							<div class="page-title-box">
								<h4>Document Search</h4>
							</div>
						</div>
					</div> -->



				    <div class="container-fluid">

						<div class="card">
							<div class="card-body">
								<!-- <div class="row folder"> -->
									<div class="col-md-2 folder">
										<div class="card folder-card justify-content-center align-items-center text-center">
											<div class="card-body">
												<img src="https://cdn-icons-png.flaticon.com/512/6377/6377123.png" width="100px" height="100px">

												<p class="fw-bold mt-2 text-center">Parent Seed</p>
											</div>
										</div>
									</div>
																																	
								<!-- </div> -->

							</div>
						</div>

				        <div class="card" id="main_section">
				            <div class="card-body">      
				                <h1 class="text-center mb-4">Document Search</h1>
				                <!-- <span class="form-badge bg-primary bg-opacity-10 text-primary text-center">Document Search</span> -->

				                <!-- Search Box -->
				                <div class="row">
				                    <div class="col-12">
				                        <div class="input-group mb-3 overflow-hidden shadow">
				                            <input type="text" class="form-control border-0 py-3 px-4" id="searchBox" placeholder="Search Document Keyword...">
				                            <button class="btn btn-primary" type="button" id="searchButton"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
				                        </div>
				                    </div>
				                </div>

				                <div class="row mt-4" id="result_section">
				                    <div class="col-12" id="resultList">

				                        <div class="text-center">
				                           <img src="https://img.freepik.com/free-vector/file-searching-concept-illustration_114360-437.jpg?t=st=1744191466~exp=1744195066~hmac=7c3ce6f141c6271588ac402ff513cefcc2b393f25c966db233c7cd80366c5488&w=826" class="no_result"> 
				                            <p class="text-dark">Search files in server</p>
				                        </div>
				                    </div>

				                    <div id="pagination_container" class="d-flex justify-content-center p-5"></div>
				                </div>

				                <!-- File View Modal -->
				                <div class="modal fade" id="file_view_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				                  <div class="modal-dialog modal-lg">
				                    <div class="modal-content">
				                      <div class="modal-header">
				                        <h1 class="modal-title fs-5" id="exampleModalLabel">File View</h1>
				                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				                      </div>
				                      <div class="modal-body" id="file_view_modal_body">
				                            
				                      </div>
				                      <div class="modal-footer">
				                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
				                      </div>
				                    </div>
				                  </div>
				                </div>     
				            </div>
				        </div>


				    </div>
				</div>
				<!-- container-fluid -->
			</div>
		</div>
	

		<?php include_once('Footer.php') ?>
	</div>


<script src="../common/checkSession.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    
    <script type="text/javascript">

    	$(document).ready(function(){
			get_department_names();
    	});
        
        function extractPDFData(fileUrl) {
            var loadingTask = pdfjsLib.getDocument(fileUrl);

            return new Promise(function(resolve, reject) {            
                loadingTask.promise.then(function (pdf) {
                    var totalPages = pdf.numPages;
                    var extractedText = '';

                    // Array to hold promises for each page
                    var promises = [];

                    // Loop through all pages and extract text
                    for (let pageNum = 1; pageNum <= totalPages; pageNum++) {
                        promises.push(
                            pdf.getPage(pageNum).then(function (page) {
                                return page.getTextContent().then(function (textContent) {
                                    extractedText += textContent.items.map(item => item.str).join(' ') + '\n';
                                });
                            })
                        );
                    }

                    // Wait for all pages to be processed
                    Promise.all(promises).then(() => {
                        // console.log("Extracted Text:", extractedText);
                        resolve(extractedText);

                    }).catch((error) => {
                        reject(error);
                    });

                }).catch((error) => {
                        reject(error);
                });

            });

        }

        $(document).on('click','#searchButton',function(){
            $.ajax({
                url: 'common_ajax.php',
                type: 'POST',
                data: { Action : "Get_Documents" },
                dataType: 'json',
                beforeSend:function(){
                	$('.ajaxloader').css('display','flex');
                },
                success: function(response) {
                    
                    var pdf_url_arr = [];
                    var pdf_size_arr = [];
                    if(response.pdf_url.length > 0) {
                        for(i in response.pdf_url) {
                            pdf_url_arr.push(response.pdf_url[i].file_name);                        
                            pdf_size_arr.push(response.pdf_url[i].file_size);                        
                        }
                        pdf_extract(pdf_url_arr,pdf_size_arr);
                    }

                },
                complete:function(){
                	// $('.ajaxloader').css('display','none');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error: ' + status + error);
                }
            });

        });


        function pdf_extract(pdf_url,pdf_size)
        {

            let size = pdf_size;

            $('#resultList').empty();

            var promises = pdf_url.map(function(url,index) {

                return extractPDFData(url).then(function(res){
                    const search_val  = $('#searchBox').val();  

                    if(search_val != '') {
                        var text_search = res.toLowerCase().includes(search_val.toLowerCase());

                        if(text_search) {
                            var file_name  = url.split('/')[1];

                            var html = `
                                <div class="row search_result b-border">
                                    <div class="col-md-7">
                                        <span class="text-primary fw-bold">File Name :</span>
                                        <span>${ file_name }</span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="text-primary fw-bold">Size :</span>
                                        <span>${ size[index] }</span>
                                    </div>                                
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-success view_file" data-filepath="${url}">
                                        <i class="fa-solid fa-eye"></i> View
                                        </button>
                                    </div>
                                </div>
                            `; 

                            $('#resultList').append(html);
                        }
                    }

                    return text_search;

                });

            });

            Promise.all(promises).then(function(results) {
                // console.log(results);
                var file_not_found  = !results.includes(true);
                if (file_not_found) {
                    var empty_html = `<div class="text-center">
                               <img src="assets/images/no_result.jpg" class="no_result"> 
                                <p class="text-dark">No Files Found</p>
                            </div>`;   

                    $('#resultList').html(empty_html);

                }


                // for bottom border remove functionality start  
                // if($('.search_result').length == 1) {
                //     $('.search_result').removeClass('b-border');
                // }

                // $('.search_result').each(function(index){
                //     var index_count = parseInt(index) + parseInt(1);

                //     if(index_count == $('.search_result').length) {
                //         $(this).removeClass('b-border');
                //     }

                // });
                // for bottom border remove functionality end  

                pagination('.search_result','pagination_container',5);

                if($('.search_result').length == 0) {
                   clear_pagination('pagination_container'); 
                }

                // hide loader after all process complete
               	$('.ajaxloader').css('display','none');


            }); 


        }


        $(document).on('click','.view_file',function(){
            var file_path = $(this).data('filepath');
            var html = `<iframe src='${file_path}#toolbar=0' style="width:100%;height:600px;"></iframe>`;

            $('#file_view_modal_body').html(html);
            $('#file_view_modal').modal('show');
        });


         function pagination(items_class,pagination_container_id,per_page_count)
         {
                var items = $(items_class);
                var numItems = items.length;
                var perPage = per_page_count;

                items.slice(perPage).hide();

                $('#'+pagination_container_id).pagination({
                    items: numItems,
                    itemsOnPage: perPage,
                    prevText: "&laquo;",
                    nextText: "&raquo;",
                    onPageClick: function (pageNumber) {
                        var showFrom = perPage * (pageNumber - 1);
                        var showTo = showFrom + perPage;
                        items.hide().slice(showFrom, showTo).show();
                    }
                });
        }

        function clear_pagination(pagination_container_id)
        {
            $('#'+pagination_container_id).empty();
        }


	   function get_department_names()
	   {
	        $.ajax({
	            url: 'Common_Ajax.php',
	            type: 'POST',
	            data: { Action : 'get_department_names' },
	            dataType: "json",
	            cache:false,
	            beforeSend: function(){
	                $('.ajax-loader').css("visibility", "visible");
	            },
	            success: function(response) {
	                var html = '';
	                if(response.data.length > 0) {
	                    for(i in response.data) {
	                        var status_badge = '';
	                        if(response.data[i].Bid_status == null) {
	                            status_badge = `<span class='badge bg-secondary' style="width: 90px;">No Participant</span>`;
	                        } else if(response.data[i].Bid_status == 'Quoted') {
	                            status_badge = `<span class='badge bg-primary' style="width: 90px;">${ response.data[i].Bid_status}</span>`;
	                        } else if(response.data[i].Bid_status == 'Quote Accepted') {
	                            status_badge = `<span class='badge bg-warning' style="width: 90px;">${ response.data[i].Bid_status}</span>`;
	                        } else if(response.data[i].Bid_status == 'Not Confirmed') {
	                            status_badge = `<span class='badge bg-danger' style="width: 90px;">${response.data[i].Bid_status}</span>`;
	                        } else if(response.data[i].Bid_status == 'Confirmed') {
	                            status_badge = `<span class='badge bg-info' style="width: 90px;">${response.data[i].Bid_status}</span>`;
	                        } 

	                        html += `<tr>
	                            <td>${ parseInt(i) + parseInt(1) }</td>
	                            <td>${ response.data[i].bidnum }</td>
	                            <td>${ response.data[i].MaterialDescription }</td>
	                            <td>${ response.data[i].UOM }</td>
	                            <td>${ response.data[i].Quantity }</td>
	                            <td>${ status_badge }</td>
	                            <td>
	                                <button type="button" class="btn btn-sm btn-success bid_confirm" data-bidnum="${response.data[i].bidnum}" data-material="${ response.data[i].MaterialDescription }">Confirm</button>
	                            </td>
	                        </tr>`;
	                    }
	                }

	                $('.bidding_pending_tbody').html(html);
	                datatable('bidding_pending_tbl','yes');

	            },
	            complete:function() {
	                $('.ajax-loader').css("visibility", "none");
	            }
	        }); 
	   } 



    </script>

</body>

</html>