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
		/*.loader {
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
		}*/

		.loader {
		    width: 40px;
		    height: 40px;
		    --c:no-repeat linear-gradient(#584475 0 0);
		    background: var(--c),var(--c),var(--c),var(--c);
		    background-size: 21px 21px;
		    animation: l5 1.5s infinite cubic-bezier(0.3,1,0,1);
		    position: absolute;
			top: 45%;
			left: 50%;
		}
		@keyframes l5 {
		   0%   {background-position: 0    0,100% 0   ,100% 100%,0 100%}
		   33%  {background-position: 0    0,100% 0   ,100% 100%,0 100%;width:60px;height: 60px}
		   66%  {background-position: 100% 0,100% 100%,0    100%,0 0   ;width:60px;height: 60px}
		   100% {background-position: 100% 0,100% 100%,0    100%,0 0   }
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
/*		    background: antiquewhite;*/
		    background: #e1f0f6;
		    border-radius: 10px; 
		    /*width: 80%;
    		height: 70%; */      	
        }
        .folder-card:hover {
        	scale: 1.01;
        }       

        .folder_img {
            width: 100px;
            height: 100px;
        } 

        .breadcrump_sop_document,.breadcrump_department,.breadcrump_division {
        	cursor: pointer;
        }
        .breadcrump_root,.breadcrump_department,.breadcrump_division {
        	text-decoration: underline;
        }

        .input_close {
	        position: absolute;
		    right: 14%;
		    top: 35%;
/*        	z-index: -1;*/
        	cursor: pointer;
        }

        #searchBox:focus + .input_close {
        	z-index: 10;
        } 

        @media only screen and (max-width:768px) {
        	.vertical-menu {
        		display: none !important;
        	}

        	.navbar-brand-box {
        		display: none;
        	}

        	.input_close {
		    	right: 18%;
        	}

        }

        @media only screen and (max-width:1250px) {
        	.input_close {
		    	right: 20%;
        	}
        }

        #file_view_modal_body {
        	overflow: auto;
        	height: 600px;
        }

    </style>

</head>

<body data-sidebar="dark" class="sidebar-enable vertical-collpsed">
		<div class="ajaxloader">
				<div class="loader"></div>
				<!-- <img src="assets/images/loader.gif"> -->
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
				    	<div class="row">
					    	<div class="col-md-12 col-12">
								<div class="card">
									<div class="card-body">
										<div class="row">
						                    <div class="col-md-8">
												<div class="d-flex breadcrump">
													<p class="text-primary">Document Search</p>	
													<p class="text-primary ms-2 me-2">></p>	
													<p>SOP Documents</p>	
												</div>
						                    </div>
						                    <div class="col-md-4">
						                        <div class="input-group mb-3 overflow-hidden shadow">
						                        	<input type="hidden" id="folder-level">
						                            <input type="text" class="form-control border-0 py-3 px-4" id="searchBox" placeholder="Search File Keyword...">
						                            <i class="fa-solid fa-xmark input_close"></i>
						                            <button class="btn btn-primary" type="button" id="searchButton"><i class="fa-solid fa-magnifying-glass"></i></button>
						                        </div>
						                    </div>									
										</div>




										<div class="row mt-5" id="folder_list">
										</div>
						                
						                <div id="pagination_container" class="d-flex justify-content-center p-5"></div>


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
						                      </div>
						                    </div>
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
	<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="assets/libs/simplebar/simplebar.min.js"></script>
	<script src="assets/libs/node-waves/waves.min.js"></script>
	<script src="assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>
	<script src="assets/js/app.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    
    <script type="text/javascript">

		async function renderPdf(url, scale) {
		  const container = document.getElementById('file_view_modal_body');
		  container.innerHTML = '';

		  // Get container dimensions
		  const containerWidth = container.offsetWidth;
		  const containerHeight = container.offsetHeight;

		  const loadingTask = pdfjsLib.getDocument(url);
		  pdfDocRef = await loadingTask.promise;

		  for (let i = 1; i <= pdfDocRef.numPages; i++) {
		    const page = await pdfDocRef.getPage(i);

		   // // Base viewport for scale 1
		    const unscaledViewport = page.getViewport({ scale: 1 });
		    
		    // Calculate scale to fit the modal width
		    const scale = containerWidth / unscaledViewport.width;

		    const viewport = page.getViewport({ scale });

		    const canvas = document.createElement('canvas');
		    // canvas.style.display = 'block';
		    // canvas.style.margin = '20px auto';
			canvas.style.border = '1px solid #ccc';
			canvas.style.padding = '10px';
			canvas.style.boxShadow = '0 0 5px rgba(0,0,0,0.1)';	
			canvas.style.maxWidth = '100%'; // Prevent overflow

		    const context = canvas.getContext('2d');

		        // Scale the canvas to fit inside the container
		    // const scaleFactor = Math.min(containerWidth / viewport.width, containerHeight / viewport.height);
		    // canvas.width = viewport.width * scaleFactor;
		    // canvas.height = viewport.height * scaleFactor;

		    canvas.height = viewport.height;
		    canvas.width = viewport.width;

		    await page.render({ canvasContext: context, viewport }).promise;
		    container.appendChild(canvas);
		  }
		}

		async function addWatermarkAndEmbedPdf(url, watermark_text) {
			  try {
			    console.log("Fetching PDF from:", url);
			    const response = await fetch(url);
			    if (!response.ok) throw new Error("Network response was not ok");

			    const existingPdfBytes = await response.arrayBuffer();
			    console.log("PDF fetched successfully. Size:", existingPdfBytes.byteLength);

			    const pdfDoc = await PDFLib.PDFDocument.load(existingPdfBytes);
			    console.log("PDF loaded into pdf-lib");

			    const helveticaFont = await pdfDoc.embedFont(PDFLib.StandardFonts.Helvetica);

			    const pages = pdfDoc.getPages();
			    pages.forEach(page => {
			      const { width, height } = page.getSize();

			      page.drawText(watermark_text, {
			        x: width / 3 - 100,
			        y: height * 0.5,
			        size: 40,
			        font: helveticaFont,
			        color: PDFLib.rgb(0, 1, 0),
			        rotate: PDFLib.degrees(30),
			        opacity: 0.2,
			      });

			     
			    });

			    const pdfBytes = await pdfDoc.save();
			    const blob = new Blob([pdfBytes], { type: 'application/pdf' });
			    pdfBlobUrl = URL.createObjectURL(blob);

			    // document.getElementById('pdfModal').style.display = 'block';
			    currentScale = 1.5;
			    await renderPdf(pdfBlobUrl, currentScale);
			  } catch (error) {
			    alert("Could not load PDF");
			    console.error("Error in addWatermarkAndEmbedPdf:", error);
			  }
		} 	

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
        	var department = $('.bread_department').data('department');
        	var division   = $('.bread_division').data('division');

            $.ajax({
                url: 'common_ajax.php',
                type: 'POST',
                data: { Action : "Get_Documents",department : department,division : division },
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

            $('#folder_list').empty();

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

                            $('#folder_list').append(html);
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

                    $('#folder_list').html(empty_html);

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
            // var html = `<iframe src='${file_path}#toolbar=0' style="width:100%;height:600px;"></iframe>`;


			const customerId = '<?php echo strtoupper($_SESSION["EmpID"]) . " - " . $_SESSION["Name"]; ?>'; 
		    addWatermarkAndEmbedPdf(file_path, customerId);

            // $('#file_view_modal_body').html(html);
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
	                var bread_crump = `<p class="text-primary">Document Search</p>	
									<p class="text-primary ms-2 me-2">></p>	
									<p class="text-primary breadcrump_sop_document">SOP Documents</p>`;	                
	                if(response.data.length > 0) {
	                	var img_path = 'assets/images/Department_images/';
	                    for(i in response.data) {
	                        html += `<div class="col-md-3 col-lg-3 col-xl-3 col-xxl-2 col-12 folder department-folder" data-department="${ response.data[i].Department_Folder_Name }">
										<div class="card folder-card justify-content-center align-items-center text-center">
											<div class="card-body">
												<img src="${ img_path+response.data[i].Department_Folder_Image }" class="folder_img">

												<p class="fw-bold mt-2 text-center">${ response.data[i].Department }</p>
											</div>
										</div>
									</div>`;
	                    }
	                }
					$('#folder-level').val('department');

	                $('#folder_list').html(html);
	                $('.breadcrump').html(bread_crump);

	            },
	            complete:function() {
	                $('.ajax-loader').css("visibility", "none");
	            }
	        }); 
	   } 


	   function get_division_folder(department)
	   {
	   	    $.ajax({
                url: 'common_ajax.php',
                type: 'POST',
                data: { Action : "Get_division_folder",department : department },
                dataType: 'json',
                beforeSend:function(){
                	$('.ajaxloader').css('display','flex');
                },
                success: function(response) {
	                var html = '';
	                var bread_crump = `<p class="text-primary">Document Search</p>	
									<p class="text-primary ms-2 me-2">></p>	
									<p class="text-primary breadcrump_sop_document breadcrump_root">SOP Documents</p>`;

	                if(response.data.length > 0) {
	                	var img_path = 'assets/images/division_images/';

	                    for(i in response.data) {
	                    	if(response.type[0] == 'folder') {
	                        	html += `<div class="col-md-3 col-lg-3 col-xl-3 col-xxl-2 col-12 folder division-folder" data-department="${department}" data-division="${ response.data[i].Division_Folder_Name }">
										<div class="card folder-card justify-content-center align-items-center text-center">
											<div class="card-body">
												<img src="${img_path+''+response.data[i].Division_Folder_Image}" class="folder_img">

												<p class="fw-bold mt-2 text-center">${ response.data[i].Division_Folder_Name }</p>
											</div>
										</div>
									</div>`;
				
									$('#folder-level').val('division');

	                    	} else if(response.type[0] == 'file') {
		                        html += `<div class="col-md-3 col-lg-3 col-xl-3 col-xxl-2 col-12 folder sop-file" data-department="${department}" data-filename="${ response.data[i] }">
											<div class="justify-content-center align-items-center text-center">
												<div class="card-body">
													<img src="assets/images/pdf-img.webp" class="folder_img">

													<p class="fw-bold mt-2 text-center">${ response.data[i] }</p>
												</div>
											</div>
										</div>`;

									$('#folder-level').val('file');										
	                    	}
	                    }
	                }                  

	                $('#folder_list').html(html);

	                // if(response.type[0] == 'file') {
	                	bread_crump += `<p class="text-primary ms-2 me-2">></p>
	                		<p class="text-primary bread_department"  data-department="${department}">${department}</p>`;
	                // }
	                $('.breadcrump').html(bread_crump);



                },
                complete:function(){
                	$('.ajaxloader').css('display','none');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error: ' + status + error);
                }
            });
	   }

	   function get_division_files(department = '',division = '')
	   {
	   	    $.ajax({
                url: 'common_ajax.php',
                type: 'POST',
                data: { Action : "Get_division_files",department : department,division : division },
                dataType: 'json',
                beforeSend:function(){
                	$('.ajaxloader').css('display','flex');
                },
                success: function(response) {
	                var html = '';
	                var bread_crump = `<p class="text-primary">Document Search</p>	
									<p class="text-primary ms-2 me-2">></p>	
									<p class="text-primary breadcrump_sop_document breadcrump_root">SOP Documents</p>`;

	                if(response.data.length > 0) {
	                    for(i in response.data) {
            			    html += `<div class="col-md-3 col-lg-3 col-xl-3 col-xxl-2 col-12 folder sop-file" data-department="${department}" data-division="${division}" data-filename="${ response.data[i] }">
								<div class="justify-content-center align-items-center text-center">
									<div class="card-body">
										<img src="assets/images/pdf-img.webp" class="folder_img">

										<p class="fw-bold mt-2 text-center">${ response.data[i] }</p>
									</div>
								</div>
							</div>`;
	                    }
	                } else {
                   	 	html = `<div class="text-center">
                               <img src="assets/images/no_result.jpg" class="no_result"> 
                                <p class="text-dark">No Files Found</p>
                            </div>`;   

	                }                     

	                $('#folder_list').html(html);

                	bread_crump += `<p class="text-primary ms-2 me-2">></p>
                		<p class="text-primary bread_department breadcrump_department" data-department="${department}">${department}</p>
                		<p class="text-primary ms-2 me-2">></p>
                		<p class="text-primary bread_division" data-division="${ division }">${ division }</p>`;

	                $('.breadcrump').html(bread_crump);
					
					$('#folder-level').val('file');										

                },
                complete:function(){
                	$('.ajaxloader').css('display','none');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error: ' + status + error);
                }
            });
	   }


        $(document).on('click','.breadcrump_root',function(){
	 		$('#pagination_container').empty();
        	get_department_names();
        });

        $(document).on('click','.breadcrump_department',function(){
	 		$('#pagination_container').empty();
        	var department = $(this).data('department'); 
        	get_division_folder(department);
        });


        $(document).on('click','.department-folder',function(){
	 		$('#pagination_container').empty();
        	var department = $(this).data('department'); 
        	get_division_folder(department);
        });

		$(document).on('click','.division-folder',function(){
	 		$('#pagination_container').empty();
        	var department = $(this).data('department'); 
        	var division   = $(this).data('division'); 

        	get_division_files(department,division);
            // $.ajax({
            //     url: 'common_ajax.php',
            //     type: 'POST',
            //     data: { Action : "Get_division_files",department : department,division : division },
            //     dataType: 'json',
            //     beforeSend:function(){
            //     	$('.ajaxloader').css('display','flex');
            //     },
            //     success: function(response) {
	        //         var html = '';
	        //         var bread_crump = `<p class="text-primary">Document Search</p>	
			// 						<p class="text-primary ms-2 me-2">></p>	
			// 						<p class="text-primary breadcrump_sop_document breadcrump_root">SOP Documents</p>`;

	        //         if(response.data.length > 0) {
	        //             for(i in response.data) {
            // 			    html += `<div class="col-md-3 col-lg-3 col-xl-3 col-xxl-2 col-12 folder sop-file" data-department="${department}" data-filename="${ response.data[i] }">
			// 					<div class="justify-content-center align-items-center text-center">
			// 						<div class="card-body">
			// 							<img src="assets/images/pdf-img.webp" class="folder_img">

			// 							<p class="fw-bold mt-2 text-center">${ response.data[i] }</p>
			// 						</div>
			// 					</div>
			// 				</div>`;
	        //             }
	        //         } else {
            //        	 	html = `<div class="text-center">
            //                    <img src="assets/images/no_result.jpg" class="no_result"> 
            //                     <p class="text-dark">No Files Found</p>
            //                 </div>`;   

	        //         }                     

	        //         $('#folder_list').html(html);

            //     	bread_crump += `<p class="text-primary ms-2 me-2">></p>
            //     		<p class="text-primary bread_department breadcrump_department" data-department="${department}">${department}</p>
            //     		<p class="text-primary ms-2 me-2">></p>
            //     		<p class="text-primary bread_division" data-division="${ division }">${ division }</p>`;

	        //         $('.breadcrump').html(bread_crump);
					
			// 		$('#folder-level').val('file');										

            //     },
            //     complete:function(){
            //     	$('.ajaxloader').css('display','none');
            //     },
            //     error: function(xhr, status, error) {
            //         console.error('AJAX error: ' + status + error);
            //     }
            // });

        });	           	   

 		$(document).on('click','.sop-file',function(){
        	var department = $(this).data('department'); 
        	var division   = $(this).data('division'); 
        	var filename   = $(this).data('filename'); 
			
            $.ajax({
                url: 'common_ajax.php',
                type: 'POST',
                data: { Action : "View_file",department : department,division : division,filename : filename  },
                dataType: 'json',
                beforeSend:function(){
                	$('.ajaxloader').css('display','flex');
                },
                success: function(response) {
                	var html = '';

                	if(response.file_name !== undefined && response.file_name !== null && response.file_name !== '') {
                		var file_path = response.file_name;
		            	// html = `<iframe src='${file_path}#toolbar=0' style="width:100%;height:600px;"></iframe>`;
		            	

		    			const customerId = '<?php echo strtoupper($_SESSION["EmpID"]) . " - " . $_SESSION["Name"]; ?>';
					    addWatermarkAndEmbedPdf(file_path, customerId);			    		
                	}

		            // $('#file_view_modal_body').html(html);
		            $('#file_view_modal').modal('show');

                },
                complete:function(){
                	$('.ajaxloader').css('display','none');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error: ' + status + error);
                }
            });

        });	   


 		$(document).on('click','.input_close',function(){
 			var search_val   = $('#searchBox').val();
 			var folder_level = $('#folder-level').val();


 			if(search_val != '') {
	 			$('#searchBox').val('');
	 			$('#pagination_container').empty();

	 			if(folder_level == 'department') {
		        	get_department_names();
	 			} else if(folder_level == 'division') {
        			var department = $('.bread_department').data('department');
		        	get_division_folder(department);	 				
	 			} else if(folder_level == 'file') {
        			var department = $('.bread_department').data('department');
        			var division   = $('.bread_division').data('division');	 				
        			get_division_files(department,division);

	 			}

 			}

 		});

 		$(document).on('keyup','#searchBox',function(){
 			var search_val = $(this).val();
 			var folder_level = $('#folder-level').val();
 			
 			if(search_val == '') {
	 			$('#pagination_container').empty();

	 			if(folder_level == 'department') {
		        	get_department_names();
	 			} else if(folder_level == 'division') {
        			var department = $('.bread_department').data('department');
		        	get_division_folder(department);	 				
	 			} else if(folder_level == 'file') {
        			var department = $('.bread_department').data('department');
        			var division   = $('.bread_division').data('division');	 				
        			get_division_files(department,division);

	 			}
 			}

        });	



    </script>

</body>

</html>