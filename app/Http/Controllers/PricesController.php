<?php session_start();  ini_set('session.bug_compat_warn', 0);ini_set("default_charset", "");
ini_set('session.bug_compat_42', 0);
$_SESSION['malk_id1']="";
$pagemenu ="edara";

if ($_POST['search']=="بحث"  or $_POST['search']=="التفاصيل" or $customer_total_trans_rep=="yes" ) {
    if($_POST["export_type"]=="excel"){
        $filename ="excelreport.xls";
        $contents = "testdata1 \t testdata2 \t testdata3 \t \n";
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);
    }

    if($customer_total_trans_rep=="" ){
        require_once('../../../sec_func.php');require_once('../../../Connections/data.php');
        if($_SESSION['def_lang']=="en")include("../../en.php");else include("../../ar.php");
        include("../../name_class.php");
        $name_class=new name_class;
    }


    if($_GET["pagemenu"]=="")
        $usedb="yes";
    else $usedb="";


//require_once('../tab_remove_ejar_duplicate.php');


}else  {

    if($_GET["p"]=="")
        require_once('../../../sec_func.php');
    //require_once('../Connections/data.php');


    if($_GET["pagemenu"]=="")
        $usedb="yes";
    else $usedb="";
    /*
      if($_GET["p"]=="")
    require_once('../../edara/tab_remove_ejar_duplicate.php'); */

    if(trim(mystr_decrypt($_SESSION['login_data_succsess_ok'])) != "Yes" ){
        echo" <meta HTTP-EQUIV=\"refresh\" content=0;url=\"../logout.php\">";
        exit();
    }
    if ( (time()-$stime) > $_SESSION['last_access'] ){
        echo" <meta HTTP-EQUIV=\"refresh\" content=0;url=\"../logout.php\">";
        exit();
    }
}



if ($_POST['search']=="بحث" or $_POST['search']=="التفاصيل"  or   $customer_total_trans_rep=="yes" ) {

    if($customer_total_trans_rep=="yes");else{

        include "../../Hijri_GregorianConvert.class";

        $DateConv=new Hijri_GregorianConvert;
        $format="YYYY-MM-DD"; }
}
else{
    include "Hijri_GregorianConvert.class";

    $DateConv=new Hijri_GregorianConvert;
    $format="YYYY-MM-DD";
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
    <? 	if($_POST["export_type"]=="excel" or  $_POST["export_type2"]=="excel");else{ ?>
        <script>
            $(document).ready(function() {

                $('.popup-youtube').magnificPopup({

                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,

                    fixedContentPos: false
                });

                var calendar = $.calendars.instance('ummalqura');
                $('#reg_date_h').calendarsPicker({calendar: calendar});
                $('#reg_date_h').val('').calendarsPicker('option',
                    {dateFormat: calendar.ISO_8601});


                $('#reg_date').calendarsPicker();
                $('#reg_date').val('').calendarsPicker('option',
                    {dateFormat: calendar.ISO_8601});
                //////////////////////////////////////////////
                $('#reg_date2_h').calendarsPicker({calendar: calendar});
                $('#reg_date2_h').val('').calendarsPicker('option',
                    {dateFormat: calendar.ISO_8601});


                $('#reg_date2').calendarsPicker();
                $('#reg_date2').val('').calendarsPicker('option',
                    {dateFormat: calendar.ISO_8601});


            });





            function  check_datee(val,f_name){

                if(val!=""){

                    var requester = false;
                    if(window.XMLHttpRequest) {
                        requester = new XMLHttpRequest;
                    } else if (window.ActiveXObject) {
                        requester = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    if(requester) {
                        requester.onreadystatechange = function() {
                            if(requester.readyState == 0 || requester.readyState == 1) {}
                            if(requester.readyState == 4 || requester.readyState == "complete") {

                                if(requester.status == 200 || requester.status == 304) {


                                    document.getElementById(f_name).value = (requester.responseText).trim();


                                } else {
                                    document.getElementById('data_proft_years2').innerHTML = '<p><? echo $estthmar101;//هناك خطأ في طلب إستدعاء البيانات?></p>';
                                }
                            }
                        }
                        requester.open("GET", "convert_dates.php?date_type="+f_name+"&date_val="+val, true);
                        requester.send(null);
                    }
                }}
            //]]>

        </script>
        <META NAME="robots" CONTENT="noindex,nofollow">

        <?php

    }

    if ($_POST['search']=="بحث" or $_POST['search']=="التفاصيل" or   $customer_total_trans_rep=="yes") {


        mysql_select_db($database_data);


        $query_Recordset204cm = "SELECT * FROM tbl_general  where gen_id=1" ;
        $Recordset204cm = mysql_query($query_Recordset204cm) or die(mysql_error());
        $row_Recordset204cm = mysql_fetch_assoc($Recordset204cm);
        $_SESSION['accounting_module2']=$row_Recordset204cm["gen_use_cat_news"];
        $_SESSION['gen_vd_directory']=$row_Recordset204cm['gen_vd_directory'];
        $tammen_to_malk=$row_Recordset204cm['tammen_to_malk'];
        $kahraba_estehqaq=$row_Recordset204cm['kahraba_estehqaq'];
        $gen_style=$row_Recordset204cm['style'];

        $gen_currency=$row_Recordset204cm['gen_currency'];
        $gen_currency_sub=$row_Recordset204cm['gen_currency_sub'];

        $show_malk_name_mostjer_rep=$row_Recordset204cm['show_malk_name_mostjer_rep'];

        if($customer_total_trans_rep=="yes"){




            if(intval($customer_id)>0)
                $query_Recordset2 = "SELECT * FROM tbl_customer where id=".intval($customer_id);
            else
                $query_Recordset2 = "SELECT id1 as id  ,a_acc as a_acc ,a_name as a_name,aparent as aparent ,acc_type as acc_type FROM tbl_e_account where id1=".intval($customer_id);

            $Recordset2 = mysql_query($query_Recordset2) or die("E1177=".mysql_error());
            $row_Recordset2 = mysql_fetch_assoc($Recordset2);
        }
        if($_POST['customer_id']!=""){


            $is_parent="";

            if(intval($_POST['customer_id'])>0)
                $query_Recordset2 = "SELECT * FROM tbl_customer where id=".intval($_POST['customer_id']);
            else
                $query_Recordset2 = "SELECT id1 as id  ,a_acc as a_acc,a_name as a_name,aparent as aparent ,acc_type as acc_type FROM tbl_e_account where id1=".intval($_POST['customer_id']);

            $Recordset2 = mysql_query($query_Recordset2) or die("E1122=".mysql_error());
            $row_Recordset2 = mysql_fetch_assoc($Recordset2);

            if($row_Recordset2["id"]<0){
                $query_Recordset2ii = "SELECT id1 as id  ,a_acc as a_acc,a_name as a_name,aparent as aparent ,acc_type as acc_type FROM tbl_e_account where aparent='". $row_Recordset2["a_acc"]."'";

                $Recordset2ii = mysql_query($query_Recordset2ii) or die("E1122=".mysql_error());
                $row_Recordset2ii = mysql_fetch_assoc($Recordset2ii);
                if($row_Recordset2ii["id"]!="")$is_parent="yes";
            }


        }

    }?>

    <title>
        <?  if($row_Recordset2["type"]=="malk")echo $cut_malk_Accounting_report_txt;			else if($row_Recordset2["type"]=="mostajer") echo $cut_mostajer_Accounting_report_txt;

        if($row_Recordset2['a_name']!="")echo $row_Recordset2['a_name']; else echo " | ".trim(mystr_decrypt($row_Recordset2['name'])) ;

        //"كشف حساب عميل";	else if($row_Recordset2["type"]=="mktb"){ echo"كشف حساب مكتب";;	if($row_Recordset2["u_id"]!=""){    $query_Recordset2u = "SELECT * FROM tbl_users where u_id=".$row_Recordset2["u_id"];$Recordset2u = mysql_query($query_Recordset2u) or die("E11=".mysql_error());$row_Recordset2u = mysql_fetch_assoc($Recordset2u); 	 if($row_Recordset2u["u_level"]==33)$is_maktb_admin="yes5";	 	  	}	}	else echo "كشف حساب";?>
    </title>

    <SCRIPT TYPE="text/javascript">
        <!--
        function submitenter(myfield,e)
        {
            var keycode;
            if (window.event) keycode = window.event.keyCode;
            else if (e) keycode = e.which;
            else return true;

            if (keycode == 13)
            {
                myfield.form.submit();
                return false;
            }
            else
                return true;
        }
        //-->
    </SCRIPT>
    <script>
        function myFunction(myForm) {
            document.getElementById(myForm).submit();
        }
    </script>


    <SCRIPT TYPE="text/javascript">


        function get_pay_type() {

            var requester = false;



            if(window.XMLHttpRequest) {

                requester = new XMLHttpRequest;

            } else if (window.ActiveXObject) {

                requester = new ActiveXObject("Microsoft.XMLHTTP");

            }



            if(requester) {

                requester.onreadystatechange = function() {

                    if(requester.readyState == 0 || requester.readyState == 1) {

                        document.getElementById('content_pay_type').innerHTML = '<span><img src="../load/co.gif"></span>';

                    }

                    if(requester.readyState == 4 || requester.readyState == "complete") {

                        if(requester.status == 200 || requester.status == 304) {

                            document.getElementById('content_pay_type').innerHTML = requester.responseText;

                        } else {

                            document.getElementById('content_pay_type').innerHTML = '<p><? echo $estthmar101;//هناك خطأ في طلب إستدعاء البيانات?></p>';

                        }

                    }

                }

                requester.open("GET", "edara/get_pay_type.php?customer_id="+document.form1.customer_id.value, true);

                requester.send(null);



            }

        }



        //<![CDATA[
        function get_bank(textValue) {
            var requester = false;

            if(window.XMLHttpRequest) {
                requester = new XMLHttpRequest;
            } else if (window.ActiveXObject) {
                requester = new ActiveXObject("Microsoft.XMLHTTP");
            }

            if(requester) {
                requester.onreadystatechange = function() {
                    if(requester.readyState == 0 || requester.readyState == 1) {
                        document.getElementById('content_hai2').innerHTML = '<span><img src="load/co.gif"></span>';
                    }
                    if(requester.readyState == 4 || requester.readyState == "complete") {
                        if(requester.status == 200 || requester.status == 304) {
                            document.getElementById('content_hai2').innerHTML = requester.responseText;
                        } else {
                            document.getElementById('content_hai2').innerHTML = '<p><? echo $estthmar101;//هناك خطأ في طلب إستدعاء البيانات?></p>';
                        }
                    }
                }
                requester.open("GET", "edara/get_bank.php?pay_type=" + textValue+"&customer_id="+document.form1.customer_id.value, true);
                requester.send(null);

            }
        }
        //]]>



        //<![CDATA[
        function get_bank_sub(textValue) {
            var requester = false;

            if(window.XMLHttpRequest) {
                requester = new XMLHttpRequest;
            } else if (window.ActiveXObject) {
                requester = new ActiveXObject("Microsoft.XMLHTTP");
            }

            if(requester) {
                requester.onreadystatechange = function() {
                    if(requester.readyState == 0 || requester.readyState == 1) {
                        document.getElementById('content_bank_sub').innerHTML = '<span><img src="load/co.gif"></span>';
                    }
                    if(requester.readyState == 4 || requester.readyState == "complete") {
                        if(requester.status == 200 || requester.status == 304) {
                            document.getElementById('content_bank_sub').innerHTML = requester.responseText;
                        } else {
                            document.getElementById('content_bank_sub').innerHTML = '<p><? echo $estthmar101;//هناك خطأ في طلب إستدعاء البيانات?></p>';
                        }
                    }
                }
                requester.open("GET", "edara/get_bank_sub.php?bank_id=" + textValue+"&customer_id="+document.form1.customer_id.value, true);
                requester.send(null);

            }
        }
        //]]>




    </script>
    </script>


    <style type="text/css">
        <!--
        .style1 {
            font-size: 26px;
            font-weight: bold;
        }
        .stylef {
            font-size: 13px;
            font-weight: bold;
        }
        .style22 {

            font-weight: bold;
        }

        .style_r_big {
            font-size: 16px;
            font-weight: bold;color:#<? if(    $_SESSION['accounting_module2']==110)echo"000";else echo"FF0000";?>;
        }

        .style_b_big {
            font-size: 16px;
            font-weight: bold;color:#<? if(    $_SESSION['accounting_module2']==110)echo"FF0000";else echo"000000";?>;
        }

        .style_r_sm {

            color:#<? if(    $_SESSION['accounting_module2']==110)echo"000";else echo"FF0000";?>;
        }

        .style_b_sm {

            color:#<? if(    $_SESSION['accounting_module2']==110)echo"FF0000";else echo"000000";?>;
        }



        .style3 {
            font-size: 14px !important;
            font-weight: bold; color:#FF0000;
        }
        -->
    </style>
    <style type="text/css" title="currentStyle">
        INPUT.vanadium-valid {
            color: #393939;
            border: solid #00CC66 1px;
            line-height: normal;
            width: 75%;
            float: right;height: 33px;
            margin-right: 0px;
        }
        @import "table_page_new/css/demo_page.css";
        @import "table_page_new/demo_table_jui.css";
        @import "table_page_new/jquery-ui-1.7.2.custom.css";




    </style>

    <?php if ($_POST['search']=="بحث"  or $_POST['search']=="التفاصيل" or $customer_total_trans_rep=="yes" ){?>
        <style>
            @font-face {
                font-family: 'Avenir-Heavy';

                src: url('../../aqar_new_them/AvenirLTStd-Heavy.otf');
                src: url('../../aqar_new_them/AvenirLTStd-Heavy.otf') format('opentype');
                font-weight: normal;
                font-style: normal;
            }

            body{
                font-size: 13px;
                font-family: 'Avenir-Heavy' !important ;
            }

            a{ text-decoration: none;}

            table.tablesorter thead tr th, table.tablesorter tfoot tr th {

                font-size: 13px;
                font-family: 'Avenir-Heavy' !important ;
            }

            table.tablesorter tbody td {

                font-size: 12px !important;
            }

            @media print {
                body{ font-size: 13px;
                    font-family: 'Avenir-Heavy' !important ;}

                a{ text-decoration: none;}

                table.tablesorter thead tr th, table.tablesorter tfoot tr th {

                    font-size: 13px;
                    font-family: 'Avenir-Heavy' !important ;
                }
                table.tablesorter tbody td {

                    font-size: 12px !important;
                }

            }

        </style>
    <? } ?>
    <script type="text/javascript" src="../jquery-latest.js"></script>

    <script type="text/javascript" src="../__jquery.tablesorter.js"></script>


    <?     if($_POST["export_type"]=="excel" or  $_POST["export_type2"]=="excel");else{?><link rel="stylesheet" href="../style_table.css" type="text/css"  /><? }?>


    <script src="edara/jquery.maskedinput.js" type="text/javascript"></script>
    <?php   $date=date("Y")."-".date("m")."-".date("d");///hijri date


    $d_h=$DateConv->GregorianToHijri($date,$format);

    $zy77= substr($d_h,0,4);


    ?>
    <script language="javascript">

        function validdate(){


            valid = true;





        }




    </script>
    <? include('layouts/inner_pages_head.php') ?>
    <style type="text/css>">
        .checkContainer {
            width: 100% !important;
        }
        .checkContainer label {
            margin-bottom: 0 !important;
        }
        .checkContainer input {
            margin-top: 0 !important;
        }
    </style>
</head>
<body>
<?php  if ($_POST['search']=="") {?>

    <div class="content">
        <div class="header" style="   background: #ffffff; border: none; padding: 0;  margin-top: 0;">
            <div class="titleInfo">
                <div class="titleTabs">
                    <h1 class="pageTitle">كشف حساب عام</h1>
                </div>
            </div>

        </div>
        <form name="form1" method="post" action="edara/report/customer_trans_all_emara.php"    onSubmit="return validdate();" enctype="multipart/form-data" target="_blank">
        <div class="filtersIncomeReports generalAccount">

                <?php
                if($_SESSION['ulevel']==25 or $_SESSION['ulevel']==29 or $_SESSION['ulevel']==30 or $_SESSION['ulevel']==31 or $_SESSION['ulevel']==32 or $_SESSION['ulevel']==34 ){
                if($_SESSION['ulevel']==34  and  $_SESSION['accounting_module']==10 )
                    $query_Recordset2 = "SELECT id1 as id FROM tbl_e_account where u_id=".myint_decrypt($_SESSION['admin_id']);
                else
                    $query_Recordset2 = "SELECT * FROM tbl_customer where u_id=".myint_decrypt($_SESSION['admin_id']);
                    $Recordset2 = mysql_query($query_Recordset2) or die(mysql_error());
                    $row_Recordset2 = mysql_fetch_assoc($Recordset2);
                ?>
                <? if($_GET["rep_type"]=="14646980"){?>
                        <div class="filtersGrid">
                            <div class="filterContainer" style="direction:rtl;float:right;text-align: right;  ">
                                <label class="filterLabel"><? echo $estthmar108;//العميل?></label>
                                <div class="inputWithHintDiv">
                                    <input name="customer_name" type="text" id="customer_name"  class="filterInput   " onchange=""  readonly="true"   size="32" value="<?php echo  $ar_tus_name?>" />
                                </div>
                            </div>

                            <div class="filterContainer" style="direction:rtl;float:right;text-align: right;  ">
                                <label class="filterLabel"><? if($_GET["rep_type"]=="14646980"){?><? echo $cut_id_txt;//رقم العميل?> <? } ?> </label>
                                <div class="inputWithHintDiv">
                                    <input name="customer_id"   readonly="true" id="customer_id"  class="filterInput :reqired "
                                        <? if($_GET["rep_type"]=="-1"){?>   value="" type="hidden"<? }else{echo"type=\"text\"   value=\"\"";}?>/>
                                </div>
                            </div>

                        </div>


                <? } // end mostajer trans for malk follower
                else{?>

                <? }?>
                <? }?>
                <div class="accountTypeCalendar">
                    <? if($_SESSION['ulevel']==33 or $_SESSION['ulevel']==25 or $_SESSION['ulevel']==11 or $_SESSION['ulevel']==1  or $_SESSION['ulevel']==34   or $_SESSION['ulevel']==32   or $_SESSION['ulevel']==31 ){?>
                        <? if($_GET["rep_type"]=="0"){?>
                            <div class="accountTypeTabsGeneralAccountLog">

                            <?php if($pagemenu=="mqawl"){?>
                                <div class="account">
                                    <a  class="popup-youtube button" href="<? echo "emqawl/aqar_cust_select.php?u_id=".$_SESSION['edara_office_id']."&type=mosahem&day=tus &form=form1&field=customer_id&field2=customer_name"; ?>">
                                    <div class="clientTypeContainer">
                                        <img src="new_theme_style/img/ownerBlue.svg" alt="">
                                        <span class="clientTypeChecked"><? echo $estthmar192;//مساهم \ مالك?></span>
                                    </div>
                                    </a>
                                    <input name="aqar_id"  id="aqar_id" type="hidden" />
                                    <input name="aqar_name"  id="aqar_name" type="hidden" />

                                </div>
                                <div class="account">
                                    <a style="padding-right: 10px; padding-left: 10px; " class="popup-youtube button" href="<? echo "edara/area_search.php?user_id=".$_SESSION['admin_id']."&u_id=".$_SESSION['edara_office_id']."&type=mqawl&day=tus &form=form1&field=customer_id&field2=customer_name&type2=empty"; ?>">
                                        <div class="clientTypeContainer">
                                            <img src="new_theme_style/img/buyerBlue.svg" alt="">
                                            <span class="clientTypeChecked"><? echo $estthmar193;//مقاول \ مورد?></span>
                                        </div>
                                    </a>

                                </div>

                            <?php }
                            else {?>

                                <?php if(    $_GET["cust"]=="inv"){

                                    echo"<a style=\"cursor:pointer\"  class='popup-youtube' href='edara/area_search.php?get_bank=".$_SESSION['accounting_module']."&user_id=".$_SESSION['admin_id']."&u_id=".$_SESSION['edara_office_id']."&type=sup&day=tus &form=form1&field=customer_id'>مورد </a>";


                                } if(  $_GET["cust"]=="hr" or $_GET["cust"]=="inv");
                                else{

                                    if($_SESSION['ulevel']==33 or $_SESSION['ulevel']==11 or $_SESSION['ulevel']==1  ){
                                        if($_SESSION['gen_show_applay_menu']!=90)
                                            echo "
                                             <div class=\"account\" id=\"selectRental\">
                                             <a class='popup-youtube' href='edara/area_search.php?get_bank=".$_SESSION['accounting_module']."&user_id=".$_SESSION['admin_id']."&u_id=".$_SESSION['edara_office_id']."&type=malk&day=tus &form=form1&field=customer_id&field2=customer_name&type2=empty&show_a_acc=yes ' >
                                                <div class=\"clientTypeContainer\">
                                                    <img src=\"new_theme_style/img/ownerBlue.svg\" alt=\"\">
                                                    <span class=\"clientTypeChecked\"> $malik_txt1 </span>
                                                </div>
                                                </a>
                                            </div>
                                            ";
                                    } ?>



                                    <?php  if(  $_GET["cust"]=="mqawl")
                                        echo "
                                             <div class=\"account\" id=\"selectRental\">
                                             <a class='popup-youtube ' href='edara/area_search.php?get_bank=".$_SESSION['accounting_module']."&user_id=".$_SESSION['admin_id']."&u_id=".$_SESSION['edara_office_id']."&type=mqawl&day=tus &form=form1&field=customer_id&field2=customer_name&type2=empty&show_a_acc=yes' >
                                                <div class=\"clientTypeContainer\">
                                                    <img src=\"new_theme_style/img/rentalBlue.svg\" alt=\"\">
                                                    <span class=\"clientTypeChecked\"> $estthmar103 </span>
                                                </div>
                                                </a>
                                            </div>
                                            ";
                                    else
                                    {         if(  $_SESSION['ulevel']==31  )	;else{

                                        if($_SESSION['gen_show_applay_menu']!=90 )
                                            echo "
                                             <div class=\"account\" id=\"selectRental\">
                                            <a  class='popup-youtube ' href='edara/area_search.php?get_bank=".$_SESSION['accounting_module']."&user_id=".$_SESSION['admin_id']."&u_id=".$_SESSION['edara_office_id']."&type=mostajer&day=tus &form=form1&field=customer_id&field2=customer_name&type2=empty&show_a_acc=yes' >
                                                <div class=\"clientTypeContainer\">
                                                    <img src=\"new_theme_style/img/rentalBlue.svg\" alt=\"\">
                                                    <span class=\"clientTypeChecked\"> $edara_menu_malek2_txt </span>
                                                </div>
                                                </a>
                                            </div>
                                            ";

                                    }


                                        ?>
                                        <?php

                                        if($_SESSION['ulevel']==33 or $_SESSION['ulevel']==11 or $_SESSION['ulevel']==1  ){
                                            if($_SESSION['gen_show_applay_menu']!=90)
                                                echo "
                                             <div class=\"account\" id=\"selectRental\">
                                            <a  class='popup-youtube ' href='edara/area_search.php?get_bank=".$_SESSION['accounting_module']."&user_id=".$_SESSION['admin_id']."&u_id=".$_SESSION['edara_office_id']."&type=moshtari&day=tus &form=form1&field=customer_id&field2=customer_name&type2=empty&show_a_acc=yes'>
                                                <div class=\"clientTypeContainer\">
                                                    <img src=\"new_theme_style/img/buyerBlue.svg\" alt=\"\">
                                                    <span class=\"clientTypeChecked\"> $edara_menu_malek4_txt </span>
                                                </div>
                                                </a>
                                            </div>
                                            ";

                                            ?> <? if($_SESSION['gen_show_applay_menu']!=90){?>

                                                <?php
                                                 echo "  <div class=\"account\" id=\"selectRental\">
                                               <a  class='popup-youtube ' href='eacc/accout_tree/cust_account.php?getsanad=yes&user_id=".$_SESSION['admin_id']."&u_id=".$_SESSION['edara_office_id']."&type=moshtari&day=tus&form=form1&field=customer_id&field2=customer_name&field3=type&show_a_acc=yes'>
                                                <div class=\"clientTypeContainer\">
                                                    <img src=\"new_theme_style/img/buildingLogBlue.svg\" alt=\"\">
                                                    <span class=\"clientTypeChecked\"> $estthmar104 </span>
                                                </div>
                                                </a>
                                            </div>
                                            ";

                                            }

                                        }

                                        ?>

                                    <? }}?>

                                <input name="type"  type="hidden" id="type"     />

                                <?     if(/*$_SESSION['ulevel']==25 or*/ $_SESSION['ulevel']==30 or $_SESSION['ulevel']==31 or $_SESSION['ulevel']==32 or $_SESSION['ulevel']==34 );else{  if(    $_SESSION['accounting_module']==10){?>


                                    <?php   $query_Recordset_permission = "SELECT * FROM tbl_admin  where username='".$_SESSION["admin_username"]."'";
                                    $Recordset_permission = mysql_query($query_Recordset_permission ) or die(mysql_error());
                                    $row_Recordset_permission = mysql_fetch_assoc($Recordset_permission);
                                    $show_mainmenu_halla_malyah_box=$row_Recordset_permission['show_mainmenu_halla_malyah_box'];

                                    if($show_mainmenu_halla_malyah_box=="0"){
                                        echo "  <div class=\"account\" id=\"selectRental\">
                                               <a class='popup-youtube ' href='eacc/accout_tree/taccount.php?getsanad=yes&user_id=".$_SESSION['admin_id']."&u_id=".$_SESSION['edara_office_id']."&type=empty&show_a_acc=yes&page=report&form=form1&field=customer_id".$row_id."&field2=customer_name".$row_id."'>
                                                <div class=\"clientTypeContainer\">
                                                    <img src=\"new_theme_style/img/accountsLogBlue.svg\" alt=\"\">
                                                    <span class=\"clientTypeChecked\"> $estthmar105 </span>
                                                </div>
                                                </a>
                                            </div>
                                            ";
                                    }




                                    ?>

                                <? }?>

                                <? }
                            }?>


                            </div>

                        <? }?>

                    <? } ?>



                    <div class="dateRangeContainer">
                        <?  if($_GET["rep_type"]=="0")
                        {?>
                            <div class="filtersGrid">
                                <div class="filterContainer" style="direction:rtl;float:right;text-align: right;  ">
                                    <label class="filterLabel"><? echo $estthmar182;//الاسم?></label>
                                    <div class="inputWithHintDiv">
                                        <input name="customer_name" type="text" id="customer_name"  class="filterInput <? if($_SESSION['ulevel']==30 or $_SESSION['ulevel']==31 or $_SESSION['ulevel']==32 or $_SESSION['ulevel']==34 ){?>:required<? }?> " onchange=""  readonly="true"   size="32" value="<?php echo  $row_Recordset2['name_search']?>" />
                                    </div>
                                </div>
                            </div>
                        <div class="filtersGrid">
                            <div class="filterContainer" style="direction:rtl;float:right;text-align: right;">
                                <label class="filterLabel"><? echo $estthmar16;//الرقم?></label>
                                <div class="inputWithHintDiv">

                                    <?php     if(    $_SESSION['accounting_module']==10){?>
                                        <input name="show_a_acc"   type="text"  	 id="show_a_acc"  class="filterInput"    readonly="readonly"     />
                                    <?php }else{?>
                                        <input name="show_a_acc"   type="hidden"  	 id="show_a_acc"  class="form-control"         />

                                    <? }?>

                                    <?  if(  $_SESSION['ulevel']==31  or $_SESSION['ulevel']==25000 )
                                        ;else{?>
                                        <input name="customer_id"   <? if($_GET["rep_type"]=="-1" or  $_GET["rep_type"]=="0" or $_SESSION['accounting_module']==10){?>   value="<? echo $row_Recordset2['id'];?>" type="hidden"<? }
                                        else{echo"type=\"text\" value=\"";if($_GET["id"]!="")echo secure( "str",ID_hash($_GET["id"],"dec"));echo"\"";}?>
                                               id="customer_id"  class="filterInput   "  <?       if($_SESSION['ulevel']==30 or $_SESSION['ulevel']==31 or $_SESSION['ulevel']==32 or $_SESSION['ulevel']==34 or $_SESSION['ulevel']==25000 ){?>readonly="readonly"<? }?>    />  <? }?>
                                </div>
                            </div>
                        </div>


                        <? } ?>
                    </div>


               </div>
                <div class="filtersGrid reportsFiltersGrid">


                    <?php
                    mysql_select_db($database_data );
                    $query_Recordset2b =" select * from tbl_close_year  where   u_edara_office_id=".myint_decrypt($_SESSION['edara_office_id'])."   order by reg_date DESC limit 0,1 ";
                    $Recordset2b = mysql_query($query_Recordset2b ) or die(mysql_error());
                    $row_Recordset2b = mysql_fetch_assoc($Recordset2b);
                    ?>
                    <div style="display: flex ; gap: 10px ;" >
                        <div class="filterContainer" style="direction:rtl;float:right;text-align: right;">
                            <label class="filterLabel"><? echo $period_from_txt;//الفترة من?>	<span class="meta"><? echo $m_txt;//م?></span></label>
                            <div class="inputWithHintDiv">
                                <input type="text" name="reg_date"  value="<?php  echo  $row_Recordset2b['reg_date']; ?>" class="filterInput cal-field"  id="reg_date" autocomplete="off" onchange="check_datee(this.value,'reg_date_h')" />
                                <img src="new_theme_style/img/calendarInput.svg" alt="">
                            </div>
                        </div>
                        <div class="filterContainer" style="direction:rtl;float:right;text-align: right;">
                            <label><? echo $period_from_txt;//الفترة من?> <span class="meta"><? echo $h_txt;//هـ?></span> </label>
                            <div class="inputWithHintDiv">
                                <input type="text" name="reg_date_h" value="<?php  echo  $row_Recordset2b['reg_date_h']; ?>" class="filterInput cal-field" id="reg_date_h" autocomplete="off" onchange="check_datee(this.value,'reg_date')"   />
                                <img src="new_theme_style/img/calendarInput.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <div style="display: flex ; gap: 10px ;" >
                        <div class="filterContainer" style="direction:rtl;float:right;text-align: right;">
                            <label class="filterLabel"><? echo $period_to_txt;//إلى?>	<span class="meta"><? echo $m_txt;//م?></span></label>
                            <div class="inputWithHintDiv">
                                <input type="text" name="reg_date2" value="" class="filterInput cal-field" id="reg_date2" autocomplete="off" onchange="check_datee(this.value,'reg_date2_h')" />
                                <img src="new_theme_style/img/calendarInput.svg" alt="">
                            </div>
                        </div>
                        <div class="filterContainer" style="direction:rtl;float:right;text-align: right;">
                            <label class="filterLabel"><? echo $period_to_txt;//إلى?> <span class="meta"><? echo $h_txt;//هـ?></span></label>
                            <div class="inputWithHintDiv">
                                <input type="text"  id="reg_date2_h" autocomplete="off" onchange="check_datee(this.value,'reg_date2')"  name="reg_date2_h" value="" class="filterInput cal-field" />
                            </div>
                        </div>
                    </div>
                    <?   if($_SESSION['ulevel']==32 or  $_SESSION['ulevel']==34  or  $_SESSION['ulevel']==2500 or  $_SESSION['ulevel']==31 ) {
                        if($_GET["cust"]=="my"){
                            ?>
                            <input name="customer_id"   value="<? echo $row_Recordset2['id'];?>" id="customer_id" type="hidden"      />
                        <? }?>


                        <?  if(  $_SESSION['ulevel']==31  or $_SESSION['ulevel']==2500 )	;else{?>
                            <div class="filterContainer" style="direction:rtl;float:right;text-align: right;">
                                <label class="filterLabel"><? echo $estthmar96;//عقار مالك?></label>
                                    <select   name="type"  id="type"  class="form-control" style="height: 40px !important ;" >
                                        <option  value=""><? echo $estthmar123;//الكل?></option>
                                        <?
                                        $u_id1=    myint_decrypt($_SESSION['edara_office_id'])  ;
                                        if($u_id1!="")$data2=" and u_edara_office_id =$u_id1 ";else $data2="";

                                        echo $qq="SELECT * FROM tbl_lead_edara where  (ld_cat_id='emara'  or ld_cat_id='borj' or  ld_cat_id='emaratejari'  or  ld_cat_id='mojama' or  ld_cat_id='block'  or ld_cat_id='mojamaskn' or ld_emara_id is null ) and ld_active='yes'   $data2 and ( post_status='posted'  ) and malk_id=".$row_Recordset2['id']." $data2";
                                        $q=mysql_query($qq);
                                        while($n=mysql_fetch_array($q)){
                                            echo "<option value=$n[id] ";
                                            if($n[id]==$emara)echo "selected='selected'";



                                            echo" >$n[ld_name] </option>";
                                        }
                                        //للشق التي ليست تابعة لعمارة



                                        $qq33="SELECT * FROM tbl_lead_edara where  (ld_cat_id='shoqa'  or ld_cat_id='mahal' or  ld_cat_id='maktab'  or  ld_cat_id='shoqaf'  or ld_cat_id='makhzan'  ) and ld_active='yes'  and ld_emara_id is null  $data2 and ( post_status='posted'   ) and malk_id=".$row_Recordset2['id']."  $data2";
                                        $q33=mysql_query($qq33);
                                        while($n33=mysql_fetch_array($q33)){
                                            echo "<option value=$n33[id] ";
                                            if($n33[id]==$emara)echo "selected='selected'";


                                            echo" >$n33[ld_name] </option>";
                                        }



                                        ?>
                                    </select>
                            </div>

                        <? }?>

                    <?php }
                    else{	?>

                    <? }?>
                    <?php     if(    $_SESSION['accounting_module']==10){?>

                        <?  if(  $_SESSION['ulevel']==31 or  $_SESSION['ulevel']==3200  or $_SESSION['ulevel']==2500 )	;else{?>


                            <div class="filterContainer" style="direction:rtl;float:right;text-align: right;">
                                <label class="filterLabel"><? echo $estthmar144;//مركز تكلفة?></label>
                                <div class="inputWithHintDiv">

                                    <a class="popup-youtube" href="<? echo "eacc/accout_tree/cs_account.php?getsanad=yes&user_id=".$_SESSION['admin_id']."&u_id=".$_SESSION['edara_office_id']."&type=".$_GET["type"]."&day=tus &form=form1&field=cost_center_id&field2=cost_center_name";?>">
                                        <input name="cost_center_name"   type="text" id="cost_center_name" onchange="" class="filterInput green-field "  readonly="true"   size="32"   onChange=""   size="32"  readonly="true"  />
                                    </a>

                                    <input name="cost_center_id"  type="hidden"    id="cost_center_id" />
                                </div></div>

                        <? }}?>
                    <?  if(  $_SESSION['ulevel']==31 or  $_SESSION['ulevel']==3200  or $_SESSION['ulevel']==2500 )	;else{?>

                        <? if(  $_GET["cust"]=="hr" or $_GET["cust"]=="inv");else{
                            if($_SESSION['gen_show_applay_menu']!=90)
                            {?>
                                <div class="filterContainer" style="direction:rtl;float:right;text-align: right;">
                                    <label class="filterLabel">	<? echo $property_txt;//العقار?></label>
                                    <div class="inputWithHintDiv">
                                        <a class="popup-youtube" href="<? echo "edara/aqar_select_and_type.php?user_id=".$_SESSION['admin_id']."&u_id=".$_SESSION['edara_office_id']."&type=$type&day=tus &form=form1&field=aqar_text0&field2=aqar_name_text0&field3=type";?>">

                                            <input name="aqar_name_text0"   type="text" id="aqar_name_text0" onchange="" class="filterInput green-field "  readonly="true"   size="32"   onChange=""   size="32"  readonly="true"
                                            />
                                        </a>
                                    </div>
                                </div>


                            <? }}?>


                        <input type="hidden"    id="aqar_text0" name="aqar_text0">
                        <input type="hidden"    id="show_close_year" name="show_close_year" value="0" >



                    <?php }?>
                    <input name="hid_cancel" type="hidden" value="0" />
                    <?  if(  $_SESSION['ulevel']==31 or $_SESSION['ulevel']==2500 )	;
                    else{?>
                        <?   mysql_select_db($database_data, $data);

                        $query_Recordset_permission = "SELECT * FROM tbl_admin  where username='".$_SESSION["admin_username"]."'";
                        $Recordset_permission = mysql_query($query_Recordset_permission, $data) or die(mysql_error());
                        $row_Recordset_permission = mysql_fetch_assoc($Recordset_permission);
                        $show_mainmenu_halla_malyah_box=$row_Recordset_permission['show_mainmenu_halla_malyah_box'];

                        if($show_mainmenu_halla_malyah_box=="0" or $_SESSION['ulevel']==32){?>
                            <div class="filterContainer" style="direction:rtl;float:right;text-align: right;">
                                    <label class="filterLabel"><strong> <? echo  $m_snotes51_txt; //  نوع السند  ?></strong> </label>
                                    <select name="sanad_type" id="sanad_type"   class="form-control"  >

                                        <option value=""><? echo  $all_txt; //  الكل  ?></option>
                                        <option value="qabd"><? echo $estthmar286;//قبض?></option>
                                        <option value="sarf"><? echo $estthmar285;// صرف?></option>
                                        <?

                                        if($show_mainmenu_halla_malyah_box=="0"){?>
                                            <option value="qaid"><? echo $estthmar284;//قيد?></option> <? }?>
                                    </select>

                            </div>

                        <? }?>
                        <div class="filterContainer" style="direction:rtl;float:right;text-align: right;">
                                <label class="filterLabel"><? echo $estthmar269;//اطبع حساب?></label>
                                <select name="debit_credit_list" id="debit_credit_list"  class="form-control"  style="height:40px !important;"  >
                                    <option  value=""><? echo $all_txt;//الكل?></option>
                                    <option  value="debit"><? echo $estthmar233;//مدين?></option>
                                    <option  value="credit"><? echo $estthmar234;//دائن?></option>
                                </select>
                        </div>

                        <?php if($_SERVER['SERVER_NAME']=="www.banaja2020.com" or $_SERVER['SERVER_NAME']=="banaja2020.com" ){?>
                            <div class="filterContainer" style="direction:rtl;float:right;text-align: right;">
                                    <label class="filterLabel">البنك</label>
                                    <select name="bank_id9"  id="bank_id9"  class="form-control"  style="height:40px !important;"  >
                                        <option  value="">اختر حساب بنك</option>
                                        <?
                                        $query_Recordset204cm = "SELECT * FROM tbl_e_account  where acc_type='bank_82'  $sql_u_edara ";
                                        $Recordset204cm = mysql_query($query_Recordset204cm) or die(mysql_error());
                                        $row_Recordset204cm = mysql_fetch_assoc($Recordset204cm);

                                        $a_acc_82=$row_Recordset204cm["a_acc"];


                                        $rr="SELECT * FROM tbl_e_account where  a_active='yes' and    aparent like '".$a_acc_82."%'   $sql_u_edara  order by aparent " ;

                                        $resultsite = mysql_query($rr);if (!$resultsite) {    die("Query to show fields from table failed moshtari popup");}

                                        $rowst = mysql_num_rows($resultsite);
                                        if($rowst!=0){


                                            for($jt=0;$jt<$rowst;$jt++)
                                            {

                                                $rowsite = mysql_fetch_array($resultsite);

                                                echo "<option value=$rowsite[id1] ";
                                                if($rowsite[id1]==$bank_id)echo "selected='selected'";
                                                $parent_name="";
                                                if(strlen($rowsite[aparent])>8){

                                                    $query_Recordset30="SELECT * FROM tbl_e_account where  a_active='yes' and   a_acc='".$rowsite[aparent]."'  $sql_u_edara "   ;
                                                    $Recordset30 = mysql_query($query_Recordset30) or die(mysql_error()."4");
                                                    $row_Recordset30 = mysql_fetch_assoc($Recordset30);
                                                    $parent_name=$row_Recordset30['a_name']." - ";
                                                }
                                                echo" style=\"color:#33CC00\">$parent_name ".$rowsite[a_name]."  </option>";
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                        <? }?>



                        <div class="filterContainer" style="direction:rtl;float:right;text-align: right;">
                            <label class="filterLabel"> <? echo $user_text407;//كلمة البحث?></label>
                            <div class="inputWithHintDiv">
                                <input name="key_word_search"   type="text" id="key_word_search" onchange="" class="filterInput  "     size="32"       size="32"    >
                            </div>
                        </div>
                        <?php     if(    $_SESSION['accounting_module']==10){?>
                            <div class="filterContainer" id="content_pay_type"></div>
                        <?php }?>

                        <div id="content_hai2" class="filterContainer"></div>
                        <div id="content_bank_sub" class="filterContainer"></div>

                        <? } ?>




                </div>
            <div class="checkBtnsGeneral">
                <?  if(  $_SESSION['ulevel']==31 or $_SESSION['ulevel']==2500 )	;
                else{?>

                    <div class="checkContainer" >
                        <input name="show_cust_col" type="checkbox" value="0"  style="margin-top: 0 !important;"  />
                        <label for="show_cust_col" style="margin-bottom: 0 !important;">  <? echo $inv_print30;//عرض عمود العميل من كشف حساب عام ?> </label>
                    </div>
                    <div class="checkContainer" >
                        <input name="show_aqd_pay" type="checkbox" value="0"  style="margin-top: 0 !important;"  />
                        <label for="show_aqd_pay" style="margin-bottom: 0 !important;"> <? echo $user_text469;//    عرض قيمة العقد ونوع الدفع في كشف حساب عام?> </label>
                    </div>
                    <div class="checkContainer" >
                        <input name="show_aqar_name" type="checkbox" value="0"  style="margin-top: 0 !important;"  />
                            <label for="show_aqar_name" style="margin-bottom: 0 !important;">  <? echo $user_text22;// عرض اسم العقار?>  </label>
                    </div>
                    <div class="checkContainer" >
                        <input name="show_cost_center_col" type="checkbox" value="0" style="margin-top: 0 !important;"   />
                            <label for="show_cost_center_col" style="margin-bottom: 0 !important;"><? echo $user_text23;//  عرض عمود مركز التكلفة  من كشف حساب عام ?>  </label>
                    </div>
                    <? if(  $_GET["cust"]=="hr" or $_GET["cust"]=="inv" or $_SESSION['gen_show_applay_menu']==90);else{?>
                        <div class="checkContainer" >
                            <input name="show_qabd_ejar_col" type="checkbox" value="0"  style="margin-top: 0 !important;"    />
                            <label for="show_qabd_ejar_col" style="margin-bottom: 0 !important;"> <? echo $user_text24;// اخفاء  حركات قبض الايجار من كشف المالك?> </label>
                        </div>
                    <? }?>
                    <? if(    $_SESSION['gen_show_applay_menu']==90);else{?>
                        <div class="checkContainer" >
                            <input name="hid_det" type="checkbox" value="0" style="margin-top: 0 !important;"  />
                            <label for="hid_det" style="margin-bottom: 0 !important;"> <? echo $hide_trans_det_txt;//  اخفاء تفاصيل الحركات - مبالغ فقط ?>  </label>

                        </div>
                    <? }?>
                    <div class="checkContainer">
                        <input name="hide_open_balance" type="checkbox" value="0" style="margin-top: 0 !important;"   />
                       <label for="hide_open_balance" style="margin-bottom: 0 !important;"> <? echo $user_text405;//بدون رصيد افتتاحي?> </label>

                    </div>
                    <? if(  $_SESSION['ulevel']==32 );else{?>

                        <div class="checkContainer" >
                            <input name="show_osol_ehlak" type="checkbox" value="0" style="margin-top: 0 !important;"   />
                         <label for="show_osol_ehlak" style="margin-bottom: 0 !important;">    <? echo $user_text404;//  عرض حركات اهلاك كشف حساب اصل?>  </label>
                        </div>



                        <div class="checkContainer" >
                            <input name="export_type" type="checkbox" value="excel"  style="margin-top: 0 !important;"  />
                                <label for="export_type" style="margin-bottom: 0 !important;"> <? echo $estthmar17;// تصدير اكسل  ?>  </label>
                                <img src="img/excel.png" />
                        </div>


                    <? }}?>

                <? if(  $_GET["cust"]=="hr" or $_GET["cust"]=="inv" or   $_SESSION['gen_show_applay_menu']==90 or $_SESSION['ulevel']==25000);else{?>

                    <div class="checkContainer" >
                        <input name="show_tamen" type="checkbox" value="0" style="margin-top: 0 !important;"
                               <? if($_SERVER['SERVER_NAME']=="www.amlaaki.com" or $_SERVER['SERVER_NAME']=="amlaaki.com"  or $_SERVER['SERVER_NAME']=="www.alhubaishi.com.sa" or $_SERVER['SERVER_NAME']=="alhubaishi.com.sa" );else{?>checked<? }?> />
                       <label style="margin-bottom: 0 !important;" for="show_tamen"> <? echo $show_tameen_maintinance_txt;//  عرض شامل تأمين الصيانة ?> </label>

                    </div>

                <? }?>
                <?  if(  $_SESSION['ulevel']==31  )	;
                else{?>
                    <?php
                    $query_Recordset204cm = "SELECT * FROM tbl_general  where gen_id=1" ;
                    $Recordset204cm = mysql_query($query_Recordset204cm) or die(mysql_error());
                    $row_Recordset204cm = mysql_fetch_assoc($Recordset204cm);
                    if($row_Recordset204cm["gen_use_cat_news"]==10){?>
                        <div class="checkContainer" >
                            <input name="show_manar_ejar_estehqaq" checked="checked" type="radio" value=""  style="margin-top: 0 !important;"   />
                            <label for="show_manar_ejar_estehqaq" style="margin-bottom: 0 !important;">	<? echo $user_text25;//	دفعات التعاقد ?>  </label>

                        </div>


                        <div class="checkContainer" >
                            <input name="show_manar_ejar_estehqaq" type="radio" value="0" style="margin-top: 0 !important;" />
                            <label for="show_manar_ejar_estehqaq" style="margin-bottom: 0 !important;">	<? echo $user_text26;//	حركات استحقاق معايير دولية ?> </label>
                        </div>

                        <div class="checkContainer" >
                            <input name="show_manar_ejar_estehqaq" type="radio" value="s"    style="margin-top: 0 !important;" />
                                <label for="show_manar_ejar_estehqaq" style="margin-bottom: 0 !important;"><? echo $user_text27;//	حركات استحقاق معايير سعودية ?>  </label>

                        </div>

                    <?php }?>


                <? }?>
                <?php if($row_Recordset204cm["gen_use_maqal"]==10)
                {
                    if( $_SERVER['SERVER_NAME']=="app.sproperty.sa"  );else{
                        ?>
                        <div class="checkContainer" >
                        <input name="show_estithmar_price_estehqaq"   type="checkbox" value="yes"  style="margin-top: 0 !important;"    />
                            <label for="show_estithmar_price_estehqaq" style="margin-bottom: 0 !important;">	 <? echo $user_text406;//عرض حركات  شهري  مقطوع الاستثمار للمالك?>  </label>
                           </div>
                    <? }}?>
                <?php  if( $_SERVER['SERVER_NAME']=="app.sproperty.sa" or  $_SERVER['SERVER_NAME']=="www.taw9999thiq.vip" or  $_SERVER['SERVER_NAME']=="tawt999hiq.vip")
                {?>

                    <?  if(  $_SESSION['ulevel']==32  )	;else{?>
                    <div class="checkContainer" >
                        <input name="hide_ejaraqdtaklofa"   type="checkbox" value="yes"  style="margin-top: 0 !important;"   />
                            <label for="hide_ejaraqdtaklofa" style="margin-bottom: 0 !important;"> <? echo $user_text472;//	اخفاء  عمولة العقد?>	 </label>
                    </div>

                <? }?>
                    <div class="checkContainer" >
                        <input name="hide_offise_kdmat"   type="checkbox" value="yes" style="margin-top: 0 !important;"      />
                            <label for="hide_offise_kdmat" style="margin-bottom: 0 !important;"> <? echo $user_text471;//	اخفاء  خدمات مكتب?></label>
                    </div>


                <? }?>
                <div class="checkContainer" >
                    <input name="show_ref"   type="checkbox" value="0"     style="margin-top: 0 !important;"  />
                    <label for="hide_offise_kdmat" style="margin-bottom: 0 !important;">   <? echo $user_text470;//عرض رقم المرجع للسند?>	 </label>

                </div>


            </div>


            <input name="u_id"  type="hidden" class="texts"   value="<?php echo $_SESSION['edara_office_id'];?>" size="32" />
            <input name="cust"  type="hidden" class="texts"   value="<?php echo $_GET['cust'];?>" size="32" />

            <div class="form-action col-md-12 ">

                <button class="button" type="submit" hidden id="searchBtn"> <? echo $search_txt;?> <span style="font-size: 10px;"> <i class="fa fa-search"></i> </span> </button>
                <input type="hidden" name="search" id="search" value="بحث" onkeypress="return submitenter(this,event)" alt="بحث">
            </div>
            <div class="printActions text-center">

                <button class="secondaryBtn" onclick="search()">  <? echo $search_txt;?>    </button>
            </div>

        </div>

        </form>

<script type="text/javascript">
    function search(){
        $('#searchBtn').trigger('click');
    }
</script>
    </div>

   <?}

if ($_POST['search']=="بحث" or $_POST['search']=="التفاصيل"  or   $customer_total_trans_rep=="yes" ) {

    include("edara/customer_trans_all_emara_action.php");
}




?>
<? 	if($_POST["export_type"]=="excel" or  $_POST["export_type2"]=="excel");else{ ?>

    <script
        type="text/javascript">

        jQuery(function($){


            $("#reg_date_h").mask("9999-99-99",{placeholder:"<?php echo $zy77;?>-01-01"});
            $("#reg_date2_h").mask("9999-99-99",{placeholder:"<?php echo $zy77;?>-12-01"});
            document.getElementById("bbb").value='<? echo $javat;?>';
        });
    </script>
</body>
</html>
<? } ?>
