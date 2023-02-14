 <!DOCTYPE html>
 <html lang="tr">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>XLS FİLTER COUNTER</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <link href="filter.css?t=<?= time() ?>" rel="stylesheet">
     <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="filter.js?t=<?= time() ?>"></script>
 </head>

 <body>
     <div class="container py-5">

         <!-- For demo purpose -->
         <header class="text-white text-center">
             <h1 class="display-4">XLS FİLTER COUNTER</h1>
             <p class="lead mb-0">Xls dosyasını seçin ve yükleyin</p>
         </header>


         <div class="row py-4">
             <div class="col-lg-6 mx-auto">

                 <div class="input-group mb-3 px-2 py-2   bg-white shadow-sm">
                     <input id="filterFile" type="file" onchange="filterFile_showFileName(this);" class="form-control border-0 opacity0">
                     <label id="upload-label" for="filterFile" class="font-weight-light text-muted">Filtre Dosyası</label>
                     <div class="input-group-append">
                         <label for="filterFile" class="btn btn-light m-0   px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted filterFile-small">Seç</small></label>
                     </div>
                 </div>
                 <div class="input-group mb-3 px-2 py-2   bg-white shadow-sm" style="border-radius:10px;">
                     <div class="col-6"><label id="upload-label" for="filterFile_colmn" class="font-weight-light text-muted">Sütun seçiniz</label></div>
                     <div class="col-6">
                         <select class="form-select " id="filterFile_colmn">
                             <?php
                                #https://www.bymega.com/phpde-tum-alfabe-harflerini-nasil-alabilirim/
                                foreach (range('A', 'Z') as $value) {
                                    echo '<option value="' . $value . '">' . $value . '</option>';
                                }
                                ?>
                         </select>
                     </div>

                     <div class="col-12" style="margin-top:10px;">
                         <div class="row">
                             <div class="col-6"><label id="upload-label" for="filterFile_colmn_w" class="font-weight-light text-muted">Üzerine Yazılacak Sütun</label></div>
                             <div class="col-6">
                                 <select class="form-select " id="filterFile_colmn_w">
                                     <?php

                                        foreach (range('A', 'Z') as $value) {
                                            echo '<option value="' . $value . '">' . $value . '</option>';
                                        }
                                        ?>
                                 </select>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="input-group mb-3 px-2 py-2   bg-white shadow-sm">
                     <input id="searchinFile" type="file" onchange="searchinFile_showFileName(this);" class="form-control border-0 opacity0">
                     <label id="upload-label" for="searchinFile" class="font-weight-light text-muted">İçinde Aranacak Dosya</label>
                     <div class="input-group-append">
                         <label for="searchinFile" class="btn btn-light m-0  px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted searchinFile-small">Seç</small></label>
                     </div>
                 </div>

                 <div class="input-group mb-3 px-2 py-2   bg-white shadow-sm">
                     <div class="col-6"><label id="upload-label" for="filterFile_colmn" class="font-weight-light text-muted">Bu Sütunda Ara</label></div>
                     <div class="col-6">
                         <select class="form-select " id="searchinFile_colmn">
                             <?php

                                foreach (range('A', 'Z') as $value) {
                                    echo '<option value="' . $value . '">' . $value . '</option>';
                                }
                                ?>
                         </select>
                     </div>
                 </div>
                 <div class="input-group mb-3 px-2 py-2  bg-white shadow-sm">
                     <div class="col-6"><label id="upload-label" for="tam_eslesme" class="font-weight-light text-muted">Tam Eşleşme</label></div>
                     <div class="col-3"></div>
                     <div class="col-3">
                         <label class="switch">
                             <input type="checkbox" id="tam_eslesme">
                             <span class="slider round"></span>
                         </label>
                     </div>
                 </div>
                 <div class="input-group mb-3 px-2 py-2   bg-white shadow-sm">
                     <button class="btn btn-block upUpBtn">Yükle</button>
                     <!-- loading img download https://loading.io/  -->
                     <img src="img/Ellipsis-1s-200px.svg" height="40" id="loadingGIF" style="display:none;margin:auto" />
                 </div>
                 <div class="input-group mb-3 px-2 py-2   bg-white shadow-sm downloadBox" style="display:none">
                     <a href="#" target="_blank" id="downloadLink" class="btn btn-block upUpBtn">İndir</a>
                 </div>

             </div>
         </div>
     </div>
     <section class="">
         <!-- Footer -->
         <footer class="bg-secondary text-white text-center text-md-start">
             <!-- Grid container -->
             <div class="container p-4">
                 <!--Grid row-->
                 <div class="row">
                     <!--Grid column-->
                     <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                         <h5 class="text-uppercase">Hakkında</h5>

                         <p>
                             İlk yüklenen excel dosyanın seçilen sütunundaki verileri alıp ikinci excel dosyasında arama yapıp eşeleşen değerleri sayar. Seçilen sütun üzerine sayılan değeri yazar ve kaydeder. M&M için yazılmıştır
                         </p>
                     </div>
                     <!--Grid column-->

                     <!--Grid column-->
                     <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                         <h5 class="text-uppercase">Links</h5>

                         <ul class="list-unstyled mb-0">
                             <li>
                                 <a target="_blank" href="https://bootsnipp.com/snippets/bl71b" class="text-white">Snippet by Umerfarooq</a>
                             </li>
                             <li>
                                 <a target="_blank" href="https://github.com/PHPOffice/PHPExcel" class="text-white">Plugins : PHPOffice/PHPExcel</a>
                             </li>
                             <li>
                                 <a target="_blank" href="#muhammed" class="text-white">Back-End Dev. by : Muhammed </a>
                             </li>
                             <li>
                                 <a target="_blank" href="xls_filter.rar" class="text-white">Download source code (free)</a>
                             </li>
                             <li>
                                 <a target="_blank" href="https://www.virustotal.com/gui/file-analysis/YWUyOWRmMjZkNjFmZTI2ZGRmYjA2MDc4ZThjODUwYjY6MTY3NjQwNDg1Mg==" class="text-white">Virustotal</a>
                             </li>
                         </ul>
                     </div>
                     <!--Grid column-->
                 </div>
                 <!--Grid row-->
             </div>
             <!-- Grid container -->

             <!-- Copyright -->
             <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                 © 2023 Copyright:
                 <a class="text-white" href="#">Muhammed</a>
                 ❤️ Bootstrap ❤️ Bootsnipp ❤️ PHP ❤️ JQUERY ❤️
             </div>
             <!-- Copyright -->
         </footer>
         <!-- Footer -->
     </section>
 </body>

 </html>