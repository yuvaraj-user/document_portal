<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Feature with Bootstrap</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- simple pagination -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/simplePagination.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.min.js"></script>
    
    <style>
        body {
            background-color: #f8f9fa;
            padding: 2rem 0;
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

        #result_section {
/*            display: none;*/
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
            box-shadow: 0 6px 17px #80808045;
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

    </style>
</head>

<body>
    <div class="container py-4">

        <div class="card" id="main_section">
            <div class="card-body">      
                <h1 class="text-center mb-4">Document Search</h1>
                <!-- <span class="form-badge bg-primary bg-opacity-10 text-primary text-center">Document Search</span> -->

                <!-- Search Box -->
                <div class="row">
                    <div class="col-12">
                        <div class="input-group mb-3 rounded-pill overflow-hidden shadow">
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    
    <script type="text/javascript">
        
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
                url: 'onedrive.php',
                type: 'POST',
                dataType: 'json',
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
                                    <div class="col-md-6">
                                        <span class="text-primary fw-bold">File Name :</span>
                                        <span>${ file_name }</span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="text-primary fw-bold">Size :</span>
                                        <span>${ size[index] }</span>
                                    </div>                                
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-sm btn-success view_file" data-filepath="${url}">
                                        <i class="fa-solid fa-eye"></i> View
                                        </button>
                                        <a href="${url}" download><button type="button" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-cloud-arrow-down"></i> Download
                                        </button></a>


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
                if($('.search_result').length == 1) {
                    $('.search_result').removeClass('b-border');
                }

                $('.search_result').each(function(index){
                    var index_count = parseInt(index) + parseInt(1);

                    if(index_count == $('.search_result').length) {
                        $(this).removeClass('b-border');
                    }

                });
                // for bottom border remove functionality end  

                pagination('.search_result','pagination_container',1);

                if($('.search_result').length == 0) {
                   clear_pagination('pagination_container'); 
                }

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

    </script>

</body>

</html>
