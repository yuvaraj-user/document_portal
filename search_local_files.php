<?php 
    $path = "uploads/";
    $files = scandir($path);
    
    $pdf_files = array();
    foreach ($files as $value) {

        $filePath = $path.$value;

        if (is_file($filePath)) {
            $pdf_files[] = $filePath;
        }
    }

?>
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

    <style>
        .result-list {
            margin-top: 20px;
        }

        ul {
            text-decoration: none;
            list-style: none;
        }

        .result-list li {
            padding: 20px;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        .result-list li:hover {
            background-color: #f1f1f1;
        }

        .no-results {
            color: red;
            font-weight: bold;
            text-align: center;
        }


        .no_result {
            width: 250px;
            height: 250px;
        }


    </style>
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Document Search</h1>
        <input type="hidden" id="pdf_file_list" value="<?php echo json_encode($pdf_files) ?>">
        <!-- Search Box -->
        <div class="row">
            <div class="col-12">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchBox" placeholder="Search...">
                    <button class="btn btn-primary" type="button" id="searchButton"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">


                        <!-- Results List -->
                        <ul id="resultList" class="list-group result-list">
                                                                             
                        </ul>

                    </div>
                </div>
            </div>
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
                <button type="button" class="btn btn-primary">Save changes</button>
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
            // const pdf_url = 'Noc Confirmation.pdf';
            const pdf_url     = <?php echo json_encode($pdf_files); ?>;
            // console.log(pdf_url.length);

            if(pdf_url.length > 0) {
               
                $('#resultList').empty();


                var promises = pdf_url.map(function(url) {

                    return extractPDFData(url).then(function(res){
                        const search_val  = $('#searchBox').val();  

                        if(search_val != '') {
                            var text_search = res.toLowerCase().includes(search_val.toLowerCase());

                            if(text_search) {
                                var file_name  = url.split('/')[1];

                                var html = `<li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <span class="text-primary fw-bold">File Name :</span>
                                            <span>${ file_name }</span>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-sm btn-success view_file" data-filepath="${url}">
                                            <i class="fa-solid fa-eye"></i> View
                                            </button>
                                        </div>
                                    </div>
                                </li>`; 

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
                });                


                // console.log(file_not_found);

            }

        });


        $(document).on('click','.view_file',function(){
            var file_path = $(this).data('filepath');
            var html = `<iframe src='${file_path}#toolbar=0' style="width:100%;height:600px;"></iframe>`;

            $('#file_view_modal_body').html(html);
            $('#file_view_modal').modal('show');
        });

    </script>

</body>

</html>
