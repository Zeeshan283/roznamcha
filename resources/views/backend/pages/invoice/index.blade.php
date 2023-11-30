<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@700&display=swap" rel="stylesheet">


    <title>Invoice</title>
    <style>
        /* Style for rounded boxes */
        .rounded-box {
            text-align: center;
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 2px;
            margin-bottom: 10px;

        }
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .heading-bg {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
        }
        table { 
            margin-left: auto; 
            margin-right: auto; 
            font-size: 10px; 
            width: 100%; 
            table-layout:fixed; 
        } 
        th { 
            text-align: center;
            color: rgb(0, 0, 0);
            font-size: 13px;
            background: linear-gradient(to right, #498fd5, #e7ece7, #498fd5); /* Adjust colors as needed */
        } 

        td { 
            border: 1px solid black; 
            text-align: center; 
            padding: 10px; 
        } 
        .header-section {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }

        .download-btn {
            margin-top: 20px;
        }
        .underline {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .underline hr {
            flex: 1;
            border: none;
            position: relative;
            height: 1px;
            background-color: #000;
            margin-right: 10px;
        }

        

        .label {
            white-space: nowrap;
        }
        .custom-flag-size {
        font-size: 3em; /* Adjust the size as needed */
        }
        .line {
        border-bottom: 2px solid #333; /* Adjust color and size as needed */
        width: 50%; /* Adjust the width of the line */
        position: absolute;
        bottom: 0;
        margin: 0 auto;
        }
        p {
            font-family: 'Noto Nastaliq Urdu', serif;
        }
        th{
            font-family: 'Noto Nastaliq Urdu', serif;
        }
        td{
            font-family: 'Noto Nastaliq Urdu', serif;
        }
        @media (max-width: 1200px) {
        .custom-flag-size {
            font-size: 2em; 
        }

        .line {
            width: 100%; 
            width: 148px;
        }
        .row_height{
            height: 250px;
        }
        .text-on-line {
            position: absolute;
            top: -4px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            padding: 0 5px;
            font-family: 'Noto Nastaliq Urdu', serif;
            font-size: 12px;
        }
    }
    @media (max-width: 991px) {
        .custom-flag-size {
            font-size: 1.5em; 
        }
        .row_height{
            height: 140px;
        }

        .line {
            width: 50%; 
            width: 100px;
            margin-left: -21;
        }  
        .heading_size{
            font-size: 0.7em;
        } 
        .box_font{
            font-size: 12px;
        }
        
    }
        @media (max-width: 768px) {
        .custom-flag-size {
            font-size: 2em; 
        }

        .line {
            width: 80%; 
            width: 148px;
        }
    }

            
    </style>
</head>
<body>

<div class="container mt-4">
        <div class="card">
            <!-- Header Section -->
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Invoice</h1>
                    </div>
                    <div class="col-md-6 download-btn text-right">
                        <a class="btn btn-primary" href="#" id="downloadBtn">Download Invoice</a>
                    </div>
                </div>
            </div>
            

            <!-- Card Body Section -->
            <div class="card-body" id="pdfContainer">
                <!-- 25% for the logo -->
                <div class="row align-items-center">
                    <div class="col-md-3 border-right text-center">
                        <img src="/upload/logo.png" alt="Logo" style="max-width: 100%; height: auto;">
                    </div>
                    <!-- 75% for two rows -->
                    <div class="col-md-9">
                        <!-- Upper row with heading -->
                        <div class="row border-bottom pb-3 mb-3">
                            <div class="col">
                                <h4 style="text-align: right; color: red ; font-family: 'Noto Nastaliq Urdu', serif;">شرکت ترانزیتی و بار چالانی شفیع الله خوستوال</h4>
                                <h6 class="text-left" style="text-align: right; color: red ; font-family: 'Noto Nastaliq Urdu', serif;">Shafiullah Khostwal Transit & Forwarding Company</h6>
                            </div>
                        </div>
                        <!-- Lower row divided into 4 columns -->
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <p class="text-left" style="font-size: 10px"><strong>محب الله</strong>  0780000475</p>
                                <p style="font-size: 10px"><strong></strong>  0792498000</p>
                                <p class="text-left" style="font-size: 10px"><strong>انور الله</strong>  0780000475</p>
                            </div>
                            <div class="col-md-3 border-right">
                                <p class="text-left" style="font-size: 10px"><strong>نصر الله</strong> 0704908767</p>
                                <p style="font-size: 10px"><strong></strong>  0780967296</p>
                                <p class="text-left" style="font-size: 10px"><strong>وطن يار </strong> 0793837383</p>
                            </div>
                            <div class="col-md-3 border-right">
                                <p class="text-left" style="font-size: 10px"><strong>واحد الله</strong> 700282899</p>
                                <p  style="font-size: 10px"><strong></strong>  0771500060</p>
                                <p class="text-left" style="font-size: 10px"><strong>عابد الله </strong> 0702969916</p>                            </div>
                            <div class="col-md-3">
                                <p style="font-size: 10px"><strong > شفیع الله</strong> <span class="text-center">03330282899</span> </p>
                                <p style="font-size: 10px"><strong></strong>  03320282899</p>
                                <p style="font-size: 10px"><strong>  </strong> 0912552309</p> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="underline">
                                <hr><span class="text-on-line">{{$inv->date}}</span>
                                <p class="label">تاریخ</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="underline">
                                <hr><span class="text-on-line">{{$inv->bulit_no}}</span>
                                <p class="label">نمبر برنامه</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="underline">
                                <hr><span class="text-on-line">{{$inv->bulit_no}}</span>
                                <p class="label">مسلسل نمبر</p>
                            </div>
                        </div>
                </div>
                <div class="row mt-3">

                        <div class="col-md-6">
                            <div class="underline">
                                <hr><span class="text-on-line">{{$inv->admin1->name}}</span>
                                <p class="label">اسم ګیرنده</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="underline">
                                <hr><span class="text-on-line">{{$inv->admin->name}}</span>
                                <p class="label">اسم ارسال کننده</p>
                            </div>
                        </div>
                </div>
                <div class="row mt-3">

                        <div class="col-md-4">
                            <div class="underline">
                                <hr><span class="text-on-line">{{$inv->vehicle_num}}</span>
                                <p class="label">نمبر پلیټ</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="underline">
                                <hr><span class="text-on-line">{{$inv->driver_num}}</span>
                                <p class="label">شمار تماس</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="underline">
                                <hr><span class="text-on-line">{{$inv->name_driver}}</span>
                                <p class="label">اسم دریوار</p>
                            </div>
                        </div>
                </div>
                <div class="row mt-3">

                        <div class="col-md-4">
                            <div class="underline">
                                <hr><span class="text-on-line">{{$inv->port}}</span>
                                <p class="label">طورخم کسټم</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="underline">
                                <hr><span class="text-on-line">{{$inv->p_of_d}}</span>
                                <p class="label">مخیل تخلیه</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="underline">
                                <hr><span class="text-on-line">{{$inv->loading_place}}</span>
                                <p class="label">مخل بارګیری</p>
                            </div>
                        </div>
                </div>
                <div class="row mt-3">
                    <!-- Dividing this row into 20% and 80% -->
                    <div class="col-md-3">
                        <!-- Creating 4 boxes with rounded corners -->
                        <div class="rounded-box" style="background: linear-gradient(to right, #d8df8e, #e7ece7, #d8df8e);">
                            <p class="pt-3 box_font" ><strong>نماینده تورخم بندر <br> </strong> 0779863063</p>
                        </div>
                        <div class="rounded-box" style="background: linear-gradient(to right, #7fd4db, #e7ece7, #7fd4db);">
                            <p class="pt-3 box_font" ><strong>نماینده غلام خان بندر<br> </strong> 0790169528</p>
                        </div>
                        <div class="rounded-box" style="background: linear-gradient(to right, #ebcc9b, #e7ece7, #ebcc9b);">
                            <p class="pt-3 box_font" ><strong>نماینده شیر خان بندر<br></strong> 0776855819</p>
                        </div>
                        <div class="rounded-box" style="background: linear-gradient(to right, #af88cd, #e7ece7, #af88cd);">
                            <p class="pt-3 box_font" ><strong>نماینده اقینه بندر<br> </strong> 0779784938</p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <!-- Creating a table with 6 columns and fixed size -->
                        <table class="table table-bordered table-fixed">
                            <thead>
                                <tr>
                                    <th style="width: 16.66%;">کرایه مجموعی</th>
                                    <th style="width: 16.66%;">كرايه في تن</th>
                                    <th style="width: 16.66%;">و وزن خالص و بارجامه</th>
                                    <th style="width: 16.66%;">نمبر پلیت موتر ازبکستان</th>
                                    <th style="width: 14%;">تفصیلات</th>
                                    <th style="width: 11%;">شماره</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Add your table rows here -->
                                <tr class="row_height">
                                    <td class="table-data" style="font-size: 20px" rowspan="3">{{$inv->kariya * $inv->weight}}</td>
                                    <td class="table-data" style="font-size: 20px" rowspan="3" >{{$inv->kariya}}</td>
                                    <td class="table-data" style="font-size: 20px" rowspan="3" >{{$inv->weight}}</td>
                                    <td class="table-data" style="font-size: 20px" rowspan="3" >{{$inv->n_plate_usd}}</td>
                                    <td class="table-data" style="font-size: 20px" rowspan="3" >{{$inv->product}}</td>
                                    <td class="table-data" style="font-size: 20px" rowspan="3" >{{$inv->sharmata ?? Null}}</td>
                                </tr> 
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                        <!-- Leaving space for a paragraph -->
                        <p style="text-align: right" class="heading_size">اینجانب (__________) که شهرتم درفوق ذکر است تعهد میدارم که اجناس بارگیری شده رابه صورت سالم الی محل تخلیه برسانم‌ودر قسمت نگهداری وصحت بودن اجناس متذکره مسولیت داشته وجوابگو میباشم</p>
                        <!-- Creating a line for a signature -->
                        <div class="row">
                            <div class="col-md-2">
                                <div class="line"></div>
                            </div>
                            <div class="col-md-8 text-center" >
                                <span class="flag-icon flag-icon-az flag-icon-lg custom-flag-size"></span>
                                <span class="flag-icon flag-icon-us flag-icon-lg custom-flag-size"></span>
                                <span class="flag-icon flag-icon-kz flag-icon-lg custom-flag-size"></span>
                                <span class="flag-icon flag-icon-tj flag-icon-lg custom-flag-size"></span>
                                <span class="flag-icon flag-icon-kg flag-icon-lg custom-flag-size"></span>
                                <span class="flag-icon flag-icon-af flag-icon-lg custom-flag-size"></span>
                                <span class="flag-icon flag-icon-pk flag-icon-lg custom-flag-size"></span>
                            </div>
                            <div class="col-md-2">
                                <div class="line" style="margin-left: -43px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


<!-- Bootstrap JS and Popper.js scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>


<script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        function downloadPDF() {
            const element = document.getElementById('pdfContainer');
            html2pdf(element);
        }

        // Attach the downloadPDF function to the click event of the button
        const downloadBtn = document.getElementById('downloadBtn');
        downloadBtn.addEventListener('click', downloadPDF);
    });
    </script>

</script>
</body>
</html>
