<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $read->title }} - {{ $read->writer }}</title>
</head>
<body style="margin: 0">
    <link href="{{ asset('master/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('master/dist/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('master/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('master/dist/assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('package/build/pdf.js') }}"></script>
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack my-2" style="position: fixed; top: 0">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ $read->title }}
            <!--begin::Separator-->
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <!--end::Separator-->
            <!--begin::Description-->
            <small class="text-muted fs-7 fw-bold my-1 ms-1">{{ $read->writer }}</small>
            <!--end::Description--></h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center py-1">
            <!--begin::Button-->
            <button id="save" onclick="save()" class="btn btn-sm btn-success me-2">Save</button>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('bookshelves.index') }}" id="exit" class="btn btn-sm btn-danger">Exit</a>
            <!--end::Button-->
        </div>
        <!--end::Actions-->
    </div>
    <div id="pdfViewerDiv"></div>
    <style>
        canvas {
            padding-left: 0;
            padding-right: 0;
            margin-left: auto;
            margin-right: auto;
            display: block;
            width: 800px;
        }
    </style>
    <script>
        initPDFViewer = () => {
            $('#pdfViewerDiv').html("")
            pdfjsLib.getDocument("{{ asset('storage/storage/files/' . $read->file_name) }}").promise.then(pdfDoc => {
                console.log(pdfDoc);
                let pages = pdfDoc._pdfInfo.numPages
                for(let i = 1; i <= pages; i++) {
                    pdfDoc.getPage(i).then(page => {
                        let pdfCanvas = document.createElement("canvas")
                        let context = pdfCanvas.getContext("2d")
                        let pageViewPort = page.getViewport({scale:1.5})
                        console.log(pageViewPort);
                        pdfCanvas.width = pageViewPort.width
                        pdfCanvas.height = pageViewPort.height
                        $('#pdfViewerDiv').append(pdfCanvas)
                        page.render({
                            canvasContext:context,
                            viewport:pageViewPort
                        })
                    }).catch(pageErr => {
                        console.log(pageErr);
                    })
                }
            }).catch(pdfErr => {
                console.log(pdfErr);
            })
        }

        $(window).on("scroll", function() {
            localStorage.setItem("tempScrollTop", $(window).scrollTop());
            console.log($(window).scrollTop());
        });

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        $(function() {
            initPDFViewer()

            if (urlParams.has('continue')) {
                setTimeout(() => {
                    $(window).scrollTop(localStorage.book{{ auth()->user()->id }}{{ $read->id }});
                }, 10000);
            }
        })

        save = () => {
            //saving soln 1
            localStorage.setItem("book{{ auth()->user()->id }}{{ $read->id }}", $(window).scrollTop());

            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: "success",
                title: "Saved Successfully!"
            });
        }
    </script>
</body>
</html>
