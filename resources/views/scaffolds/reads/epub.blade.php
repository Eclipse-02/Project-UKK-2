<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $read->title }} - {{ $read->writer }}</title>

  <script src="{{ asset('jszip-main/dist/jszip.min.js') }}"></script>
  <script src="{{ asset('epubjs/dist/epub.js') }}"></script>
  <script src="{{ asset('master/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
  <script src="{{ asset('master/dist/assets/js/scripts.bundle.js') }}"></script>

  <link rel="stylesheet" type="text/css" href="{{ asset('epubjs/examples/examples.css') }}">
  <link href="{{ asset('master/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('master/dist/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

  <style type="text/css">

    .epub-container {
      /* min-width: 320px; */
      /* margin: 0 auto; */
      /* position: relative; */
    }

    .epub-container .epub-view > iframe {
        background: white;
        box-shadow: 0 0 4px #ccc;
        /*margin: 10px;
        padding: 20px;*/
    }

  </style>
</head>
<body>

    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack my-2" style="position: fixed; top: 0; z-index:100000000000">
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
            <button id="save" onclick="saveViewerState()" class="btn btn-sm btn-success me-2">Save</button>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('bookshelves.index') }}" id="exit" class="btn btn-sm btn-danger">Exit</a>
            <!--end::Button-->
        </div>
        <!--end::Actions-->
    </div>

  <script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    if (urlParams.has('continue')) {
      // get the saved location from localStorage
      var savedLocation = JSON.parse(localStorage.getItem("currentLocation"));
    }

    // Load the opf
    var book = ePub("{{ asset('storage/storage/files/' . $read->file_name) }}");
    var rendition = book.renderTo(document.body, {
        manager: "continuous",
        flow: "scrolled",
        width: "100%",
        height: "100%"
      });

    if (urlParams.has('continue')) {
      var displayed = rendition.display(savedLocation.start.cfi);
    } else {
      var displayed = rendition.display();
    }

    displayed.then(function(renderer){
      // -- do stuff
    });

    // Navigation loaded
    book.loaded.navigation.then(function(toc){
      // console.log(toc);
    });

    function saveViewerState() {
      if (rendition && rendition.location && rendition.location.start) {
        // get the current location
        var currentLocation = rendition.currentLocation();

        // save the current location in localStorage
        localStorage.setItem("currentLocation", JSON.stringify(currentLocation));

        // alert
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
    }

  </script>

</body>
</html>
