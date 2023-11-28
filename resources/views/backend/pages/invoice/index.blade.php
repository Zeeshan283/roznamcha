<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Your Web Page</title>
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
            font-size: 16px;
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

        .text-on-line {
            position: absolute;
            top: -4px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            padding: 0 5px;
        }

        .label {
            white-space: nowrap;
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
                        <a class="btn btn-primary" href="#" onclick="downloadPDF()">Download Invoice</a>
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
                                <h4 style="text-align: right; color: red">شرکت ترانزیتی و بار چالانی شفیع الله خوستوال</h4>
                                <h4 class="text-left" style="text-align: right; color: red">Shafiullah Khostwal Transit & Forwarding Company</h4>
                            </div>
                        </div>
                        <!-- Lower row divided into 4 columns -->
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <p class="text-center"><strong>محب الله</strong>  0780000475</p>
                                <p class="pl-2"><strong></strong>  0792498000</p>
                                <p class="text-center"><strong>انور الله</strong>  0780000475</p>
                            </div>
                            <div class="col-md-3 border-right">
                                <p class="text-center"><strong>نصر الله</strong> 0704908767</p>
                                <p class="pl-2"><strong></strong>  0780967296</p>
                                <p class="text-center"><strong>وطن يار </strong> 0793837383</p>
                            </div>
                            <div class="col-md-3 border-right">
                                <p class="text-center"><strong>واحد الله</strong> 700282899</p>
                                <p class="pl-2"><strong></strong>  0771500060</p>
                                <p class="text-center"><strong>عابد الله </strong> 0702969916</p>                            </div>
                            <div class="col-md-3">
                                <p><strong style="text-align: left"> شفیع الله</strong> <br><span class="text-center">0333-0282899</span> </p>
                                <p><strong></strong>  0332-0282899</p>
                                <p><strong>  </strong> 091-2552309</p> 
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
                            <p class="pt-3" style="font-size: 16px"><strong>نماینده تورخم بندر <br> </strong> 0779863063</p>
                        </div>
                        <div class="rounded-box" style="background: linear-gradient(to right, #7fd4db, #e7ece7, #7fd4db);">
                            <p class="pt-3" style="font-size: 16px"><strong>نماینده غلام خان بندر<br> </strong> 0790169528</p>
                        </div>
                        <div class="rounded-box" style="background: linear-gradient(to right, #ebcc9b, #e7ece7, #ebcc9b);">
                            <p class="pt-3" style="font-size: 16px"><strong>نماینده شیر خان بندر<br></strong> 0776855819</p>
                        </div>
                        <div class="rounded-box" style="background: linear-gradient(to right, #af88cd, #e7ece7, #af88cd);">
                            <p class="pt-3" style="font-size: 16px"><strong>نماینده اقینه بندر<br> </strong> 0779784938</p>
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
                                    <th style="width: 16.66%;">تفصیلات</th>
                                    <th style="width: 16.66%;">شماره</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Add your table rows here -->
                                <tr height="200px">
                                    <td class="table-data" rowspan="3" >Data 1</td>
                                    <td class="table-data" rowspan="3" >Data 2</td>
                                    <td class="table-data" rowspan="3" >Data 3</td>
                                    <td class="table-data" rowspan="3" >Data 4</td>
                                    <td class="table-data" rowspan="3" >Data 5</td>
                                    <td class="table-data" rowspan="3" >Data 6</td>
                                </tr> 
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                        <!-- Leaving space for a paragraph -->
                        <p>This is a placeholder for your paragraph content.</p>
                        <!-- Creating a line for a signature -->
                        <div class="signature-line"></div>
                        <p>Signature: ________________________</p>
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
    function downloadPDF() {
        const element = document.getElementById('pdfContainer');

        html2pdf(element);
    }
</script>
</body>
</html>
