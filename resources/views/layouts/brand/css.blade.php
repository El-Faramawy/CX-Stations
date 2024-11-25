<!-- TITLE -->
<title>{{setting()->name}}</title>

<!-- [Meta] -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content=" {{setting()->name}}  ">
<meta name="keywords" content="{{setting()->name}}, Hardy, hardy, Hardy CX, hardy cx, cx stations">
<!-- Favicon -->
<link rel="icon" href="{{get_file(setting()->fav_icon)}}" type="image/x-icon">
<!-- icon -->
<link rel="stylesheet" href="{{url('Brand')}}/assets/fonts/fontawesome.css">
<!--  CSS Files -->
<link rel="stylesheet" href="{{url('Brand')}}/assets/css/style.css" >
<link rel="stylesheet" href="{{url('Brand')}}/assets/css/style-preset.css">
<link rel="stylesheet" href="{{url('Brand')}}/assets/css/custom.css?v=6">

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<style>
    /* Global loader container */
    .global-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
        z-index: 9999; /* Ensure it's above other content */
        display: flex;
        justify-content: center;
        align-items: center;
        visibility: hidden; /* Initially hidden */
        opacity: 0;
        transition: visibility 0s, opacity 0.3s ease;
    }

    /* Spinner animation */
    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid rgba(0, 0, 0, 0.2);
        border-top: 5px solid #a420eb; /* Blue color */
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    /* Keyframes for spinner */
    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    /* Show loader */
    .global-loader.show {
        visibility: visible;
        opacity: 1;
    }
</style>
