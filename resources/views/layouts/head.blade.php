<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>  </title>
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/hr.png')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap.css" />
    <link href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.bootstrap.css" />


    <link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-easyui/themes/default/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-easyui/themes/icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-easyui/demo/demo.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

</head>

<style>
    .choices {
        margin-bottom: 0 !important;
    }
    @font-face {
        font-family: 'icomoon';
        src: url("{{asset('assets/fonts/ArbFONTS-The-Sans-Plain.otf')}}");
        src: url("{{asset('assets/fonts/ArbFONTS-The-Sans-Plain.otf')}}");
        font-weight: normal;
        font-style: normal;
    }

    * {
        font-family: 'icomoon' !important;
    }
    .textbox-invalid {
        width:  100% !important;
    }
    .textbox{
        width:  100% !important;
    }


    .container-fluid {
        width: 100% !important;
        max-width: unset !important;
    }

    .modelTitle {
        color: #3cacc8;
        font-size: 20px;
    }

    .modal-close:hover {
        transform: scale(1.5);
    }

    .alertImage {
        width: 40px;
        height: 40px;
        margin: 5px;
    }

    .dt-paging {
        direction: ltr !important;
    }

    .dt-length select {
        width: 200px !important;
        -webkit-appearance: auto !important;
        -moz-appearance: auto !important;
        appearance: auto !important;
        direction: ltr !important;
    }

    .dt-search {
        margin-bottom: 10px;
    }

    .dt-search input {
        width: 200px !important;
    }

    .dt-length {
        display: flex;
        direction: rtl;
        align-items: center;
        float: left;

    }

    .dt-length label {
        margin-left: 5px;
        margin-right: 5px
    }

    .dt-search {
        display: flex;
        direction: ltr;
        align-items: center;
        float: right;
    }

    .dt-search label {
        margin-left: 5px;
        margin-right: 5px
    }

    .dt-empty {
        text-align: center !important;
    }
    .dataTables_wrapper {
        direction: rtl !important;
    }
    .container-fluid {
        padding: 0 !important;
    }
    .body-wrapper-inner {
        margin-top: 40px;
        border-radius: 20px !important;
        margin-bottom: 30px;
        min-height: calc(100vh - 70px);
        margin-left: calc(15px);
        margin-right: calc(15px);
    }
</style>


@if(Config::get('app.locale')=='en' )
<style>
    .dt-paging nav {
        float: right !important;
    }
</style>

@endif



@if(Config::get('app.locale')=='ar' )
<style>
    .dt-length select {
        width: 200px !important;
        -webkit-appearance: auto !important;
        -moz-appearance: auto !important;
        appearance: auto !important;
        direction: rtl !important;
    }

    .dt-length {
        display: flex;
        direction: ltr;
        align-items: center;
        float: right;

    }

    .dt-search {
        display: flex;
        direction: ltr;
        align-items: center;
        float: left;
    }


        @if(Config::get('app.locale')=='ar' )
        .edit_layout {
            margin-left: 0 !important;
            margin-right: 260px !important;
            direction: rtl !important;
        }
    @endif

      @if(Config::get('app.locale')=='en' )
        .edit_layout {
        margin-right: 0 !important;
        margin-left: 260px  !important;
        direction: ltr !important;
    }
    @endif
    @media  (max-width: 1200px) {
        @if(Config::get('app.locale')=='ar' )
        .edit_layout {
            margin-left: 0 !important;
            margin-right: 0px !important;
            direction: rtl !important;
        }
        @endif

      @if(Config::get('app.locale')=='en' )
        .edit_layout {
            margin-right: 0 !important;
            margin-left: 0px  !important;
            direction: ltr !important;
        }
    @endif
}

</style>


@endif


