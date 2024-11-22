<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> DEV-HR ADMIN </title>
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/hr.png')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap.css" />
    <link href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.bootstrap.css" />
</head>

<style>
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
</style>


@endif