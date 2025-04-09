<?php session_start(); ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
if ($_POST['search']=="بحث") { $pagemenu ="edara";
    if($_POST["export_type"]=="excel"){
        $filename ="excelreport.xls";
        $contents = "testdata1 \t testdata2 \t testdata3 \t \n";
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);
    }
    require_once('../../sec_func.php');require_once('../../Connections/data.php');

    if($_SESSION['def_lang']=="en")include("../en.php");else include("../ar.php");
    include("../name_class.php");
    $name_class=new name_class;


    include "../Hijri_GregorianConvert.class";

    $DateConv=new Hijri_GregorianConvert;


}else  {

    if($_GET["p"]=="")
        require_once('../../sec_func.php');
    //require_once('../Connections/data.php');
    if(trim(mystr_decrypt($_SESSION['login_data_succsess_ok'])) != "Yes" ){
        echo" <meta HTTP-EQUIV=\"refresh\" content=0;url=\"../logout.php\">";
        exit();
    }
    if ( (time()-$stime) > $_SESSION['last_access'] ){
        echo" <meta HTTP-EQUIV=\"refresh\" content=0;url=\"../logout.php\">";
        exit();
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
    <META NAME="robots" CONTENT="noindex,nofollow">
    <title>تقرير مستأجرين لمالك</title>



    <? if($_POST["export_type"]=="excel");else{?>
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
        <script type="text/javascript" src="__jquery.tablesorter.js"></script>


        <style type="text/css">
            <!--
            .style1 {
                font-size: 26px;
                font-weight: bold;
            }
            .stylef {
                font-size: 16px;
                font-weight: bold;
            }
            .style22 {
                font-size: 16px;
                font-weight: bold;
            }
            .style3 {font-size: 12px; font-weight: bold; color: #FF0000; }
            -->


            .style11 {
                font-size: 14px;
                font-weight: bold;
            }
            .style33 {font-size: 11px; font-weight: bold; color: #FF0000; }


        </style><style type="text/css" title="currentStyle">


            /* tables */
            table.tablesorter {
                background-color: #CDCDCD;
                margin:10px 0pt 15px;
                width: 100%;
            }
            table.tablesorter thead tr th,    table.tablesorter tfoot tr th {
                background-color: #e6EEEE;
                border: 1px solid #FFF;
                padding-right: 7px; font-size:13px; font-family:"Times New Roman", Times, serif;
            }
            table.tablesorter thead tr .header {
                background-image: url(bg.gif);
                background-repeat: no-repeat;
                background-position: center right;
                cursor: pointer;
            }
            table.tablesorter tbody td {
                color: #3D3D3D;
                padding: 1px;
                background-color: #FFF;
                vertical-align: top; font-size:14px;
            }
            table.tablesorter tbody tr.odd td {
                background-color:#F0F0F6;
            }
            table.tablesorter thead tr .headerSortUp {
                background-image: url(asc.gif);
            }
            table.tablesorter thead tr .headerSortDown {
                background-image: url(desc.gif);
            }
            table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {
                background-color: #8dbdd8;
            }</style><? }?>
</head>

<body style="background-color:#CCCCCC">

<?php  if ($_POST['search']=="") {?>
    <div class="content">


        <form name="form1" method="post" action="edara/rep_mostajer_of_malk.php"  enctype="multipart/form-data" target="_blank">


            <div class="form-horigontal">

                <div class="">
                    <div class="">

                        <div class="row">    <?php
                            if($_SESSION['ulevel']==30 or $_SESSION['ulevel']==31 or $_SESSION['ulevel']==32 or $_SESSION['ulevel']==34 ){


                                /*  if($_SESSION['ulevel']==34  and  $_SESSION['accounting_module']==10 )
                                      $query_Recordset2 = "SELECT id1 as id FROM tbl_e_account where u_id=".myint_decrypt($_SESSION['admin_id']);

                                  else*/
                                $query_Recordset2 = "SELECT * FROM tbl_customer where u_id=".myint_decrypt($_SESSION['admin_id']);
                                $Recordset2 = mysql_query($query_Recordset2) or die(mysql_error());
                                $row_Recordset2 = mysql_fetch_assoc($Recordset2);
                            }?>


                            <?   if($_SESSION['ulevel']==32 or  $_SESSION['ulevel']==34 ) { ?>
                                <input name="show_zero_rased"    type="hidden" value="yes"    />

                            <? }?>

                            <?   if($_SESSION['ulevel']==32 or  $_SESSION['ulevel']==34 ) {

                                ?>


                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"><label><? echo $estthmar96;//عقار مالك?></label>

                                        <select        name="type"  id="type" style="width:223px;"  ><option  value=""><? echo $estthmar123;//الكل?></option>
                                            <?
                                            $u_id1=    myint_decrypt($_SESSION['edara_office_id'])  ;
                                            if($u_id1!="")$data2=" and u_edara_office_id =$u_id1 ";else $data2="";

                                            echo $qq="SELECT * FROM tbl_lead_edara where  (ld_cat_id='emara'  or ld_cat_id='borj' or  ld_cat_id='emaratejari'  or  ld_cat_id='mojama' or  ld_cat_id='block'  or ld_cat_id='mojamaskn' or ld_emara_id is null ) and ld_active='yes'   $data2 and ( post_status='posted' ) and malk_id=".$row_Recordset2['id']." $data2";
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
                                        </select>   </div></div>


                            <?php } ?>



                            <? if($_SESSION['ulevel']==33 or $_SESSION['ulevel']==11 or $_SESSION['ulevel']==1 ){?>





                            <div class="row">




                                <? //if($_GET["rep_type"]=="emara")
                                {?>

                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"><label><? echo $period_from_txt;//الفترة من?>	<span class="meta"><? echo $m_txt;//م?></span> </label><input type="text" name="reg_date"  value="<?php
                                            include "Hijri_GregorianConvert.class";

                                            $DateConv=new Hijri_GregorianConvert;


                                            $format="YYYY-MM-DD";
                                            $sday=date("d");
                                            $year1=date("Y");
                                            $month1=date("m");
                                            //$dd= $year1."-".$month1."-".$sday;

                                            $query_Recordset2 =" select * from tbl_close_year  where   u_edara_office_id=".myint_decrypt($_SESSION['edara_office_id'])."   order by reg_date DESC limit 0,1 ";
                                            $Recordset2 = mysql_query($query_Recordset2 ) or die(mysql_error());
                                            $row_Recordset2 = mysql_fetch_assoc($Recordset2);

                                            $dd2= $row_Recordset2['reg_date'];// "2023-01-01" ;
                                            echo $dd2 ;
                                            ?>" class="form-control cal-field"  id="reg_date" autocomplete="off" onchange="check_datee(this.value,'reg_date_h')" />   </div></div>





                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"><label><? echo $period_to_txt;//إلى?>	<span class="meta"><? echo $m_txt;//م?></span></label><input type="text" name="reg_date2" value="<?php



                                            $format="YYYY-MM-DD";
                                            $sday=date("d");
                                            //$year1=date("Y")+1;
                                            $year1=date("Y") ;
                                            $month1=date("m");
                                            echo $dd= $row_Recordset2['reg_date2'];///$year1."-".$month1."-".$sday;
                                            ?>" class="form-control cal-field" id="reg_date2" autocomplete="off" onchange="check_datee(this.value,'reg_date2_h')" />
                                        </div></div>



                                <? }?>


                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"><label>   <a class="popup-youtube" style="cursor:pointer; border-radius: 5px;margin-left:5px; margin-bottom:5px;  background: #3bafda ;color: #fff;padding: 8px;" href="<? echo "edara/area_search.php?user_id=".$_SESSION['admin_id']."&u_id=".$_SESSION['edara_office_id']."&type=malk&day=tus &form=form1&field=customer_id&field2=customer_name"; ?>">
                                                <? echo $estthmar9;//اختر  مالك العقار?>   </a>



                                            <a class="popup-youtube" style="cursor:pointer; border-radius: 5px;margin-left:5px; margin-bottom:5px;  background: #3bafda ;color: #fff;padding: 8px;"  href="<? echo "edara/aqar_select_and_type.php?user_id=".$_SESSION['admin_id']."&u_id=".$_SESSION['edara_office_id']."&type=$type&day=onlyemara&form=form1&field=customer_id&field2=customer_name&field3=type"; ?>">
                                                <? echo $estthmar10;// اختر عمارة - مالك ?>  </a>
                                        </label>


                                        <input name="customer_name" type="text" id="customer_name"  class="form-control green-field"   onChange=""  readonly="true"   size="32" value="<?php echo  $ar_tus_name?>" />  </a>
                                    </div></div>





                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"><label><? echo $period_from_txt;//الفترة من?> <span class="meta"><? echo $h_txt;//هـ?></span> </label><input type="text" name="reg_date_h" value="<?



                                        echo  $DateConv->GregorianToHijri($dd2,$format);
                                        ?>" class="form-control cal-field" id="reg_date_h" autocomplete="off" onchange="check_datee(this.value,'reg_date')"   />   </div></div>


                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"><label><? echo $period_to_txt;//إلى?> <span class="meta"><? echo $h_txt;//هـ?></span></label><input type="text"  id="reg_date2_h" autocomplete="off" onchange="check_datee(this.value,'reg_date2')"  name="reg_date2_h" value="<?php



                                        // $dd= $year1."-".$month1."-".$sday;
                                        echo  $DateConv->GregorianToHijri($dd,$format);
                                        ?>" class="form-control cal-field" />

                                    </div></div>




                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"><label><? echo $estthmar16;//الرقم?></label>
                                        <input name="customer_id" <? if($_GET["rep_type"]=="-1"){?>   value="-1" type="hidden"<? }else{echo"type=\"text\""; }?>  readonly="true" class="form-control  "    id="customer_id">    </div></div>

                                <input name="type"  type="hidden" id="type"     />






                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"><label><? echo $estthmar269;//اطبع حساب?></label>

                                        <select    class="form-control  "      name="debit_credit_list"  id="debit_credit_list"    >

                                            <option  value=""><? echo $all_txt;//الكل?></option>
                                            <option  value="debit"><? echo $estthmar233;//مدين?></option>
                                            <option  value="credit"><? echo $estthmar234;//دائن?></option>


                                        </select></div></div>


                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"><label> <? echo $estthmar683;// غرض التاجير?> </label>
                                        <select name="ejar_order_type" id="ejar_order_type"  onChange="get_ejar_order_type_other(this.value)"class=" form-control "   >
                                            <option value=''><? echo $all_txt;//  الكل?></option>
                                            <option value="1"><? echo $estthmar498;//سكني?></option>
                                            <option value="2"><? echo $estthmar499;//تجاري?></option>
                                        </select>
                                    </div></div>



                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"><label><? echo  $estthmar621;//المستخدم?></label>   <select   class="form-control "     name=user_id   >



                                            <?php
                                            $query_Recordset5 = "SELECT * FROM tbl_general where gen_id=1" ;
                                            $Recordset5= mysql_query($query_Recordset5, $data) or die(mysql_error());
                                            $row_Recordset5 = mysql_fetch_assoc($Recordset5);
                                            $show_all_aqarusers_rep=$row_Recordset5['show_all_aqarusers_rep'] ;

                                            $query_Recordset162 = "SELECT * FROM tbl_lead_edara_order_users where   lead_edara_u_id=".$_SESSION['ld_activated_by'] ." limit 0,1";
                                            $Recordset162 = mysql_query($query_Recordset162) or die(mysql_error());
                                            $row_Recordset162 = mysql_fetch_assoc($Recordset162);
                                            $show_lead_allow = mysql_num_rows($Recordset162);

                                            if($_SESSION['ulevel']==33  or $show_lead_allow==0 or $show_all_aqarusers_rep==""){echo"<option value=''>".$all_txt."</option>"; }

                                            if($_SESSION['ulevel']==33 )
                                                $q=mysql_query("SELECT * FROM tbl_users where  u_edara_office_id=".myint_decrypt($_SESSION['edara_office_id']));
                                            else
                                                $q=mysql_query("SELECT * FROM tbl_users where  u_id=".myint_decrypt($_SESSION['admin_id'])."");


                                            while($n=mysql_fetch_array($q)){
                                                echo "<option value=$n[u_id] ";
                                                if($n[u_id]==$cat)echo "selected='selected'";

                                                echo" >$n[u_username]</option>";
                                            }

                                            ?>
                                        </select> </div></div>


                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"><label><? echo $estthmar694;// نوع الدفع?>  </label>
                                        <select name="pay_type" id="pay_type" class="form-control "  >

                                            <option value=""><? echo $choose;//اختر ?></option>
                                            <option value="1"><? echo $estthmar691;//شهري?></option>
                                            <option value="2"><? echo $estthmar690;//شهرين?></option>
                                            <option value="3"><? echo $estthmar689;//3 أشهر?></option>
                                            <option value="4"><? echo $estthmar688;//4 أشهر?></option>
                                            <option value="6"     ><? echo $estthmar687;//6 أشهر?></option>
                                            <option value="12"><? echo $estthmar307;//سنوي?></option>
                                        </select>     </div>

                                </div>






                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"><label><? /*if($row_Recordset1['type'] =="mktb")echo"جهة القدوم";else*/{?><? echo $estthmar343;//الجنسية?><? }

                                            ?></label>
                                        <select name=country    class="form-control "    onChange="getCity(this.value);">


                                            <option value=''><? echo $choose;//اختر ?><? /*if($row_Recordset1['type'] =="mktb")echo"جهة القدوم";else*/{?><? echo $estthmar343;//الجنسية?><? }?></option>
                                            <?


                                            include'../library1/conf.php';


                                            $q=mysql_query("select * from tbl_country   ");
                                            while($n=mysql_fetch_array($q)){
                                                echo "<option value=$n[co_id] ";

                                                if($n[co_id]==$ld_country)echo "selected='selected'";

                                                if($_SESSION['def_lang']=="en")
                                                    echo" >$n[co_name_en]</option>";

                                                else echo" >$n[co_name]</option>";
                                            }

                                            ?>
                                        </select>
                                    </div></div>


                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"></div></div>


                                <?php
                                $query_Recordset204cm = "SELECT * FROM tbl_general  where gen_id=1" ;
                                $Recordset204cm = mysql_query($query_Recordset204cm) or die(mysql_error());
                                $row_Recordset204cm = mysql_fetch_assoc($Recordset204cm);
                                if($row_Recordset204cm["gen_use_cat_news"]==10){?>

                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"><label>	  <input name="show_manar_ejar_estehqaq" type="checkbox" value="0"     /></label>
                                            <? echo $mezanieh_rep8;//اظهار حركات الاستحقاق?></div> </div>
                                <?php }?>





                                <? if($_GET["rep_type"]=="emara");else{?>

                                    <input name="show_expire_only99999999999"  type="hidden" value="post_all"   />
                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"> <label> <input name="show_expire_only"  type="radio" value="post_all"   checked="checked"   /> </label>
                                            <? echo $user_text487;//	كل العقود السارية ?></div></div>
                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"> <label> <input name="show_expire_only"  type="radio" value="post_only_period"   checked="checked"   /> </label>
                                            <? echo $user_text104;// اظهر العقود السارية  فقط ?>  <? echo $user_text488;// على الفترة?> </div></div>



                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"> <label> <input name="show_expire_only"  type="radio" value="expire_only"    /> </label>
                                            <? echo $estthmar14;//اظهر العقود المنتهية فقط ?></div></div>






                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"> <label> <input name="show_expire_only"  type="radio" value="old_only"    /> </label>
                                            <? echo $user_text105;//	 اظهر العقود المؤرشفة  فقط  ?></div></div>

                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"> <label> <input name="show_expire_only"  type="radio" value="show_create_date"    /> </label>
                                            <? echo $user_text489;//	تاريخ الإنشاء ?></div></div>


                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"> <label> <input name="show_rased" type="checkbox" value="minusonly"    /> </label>
                                            <? echo $estthmar15;//	اظهر المتاخرين فقط ?> </div></div>
                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"> <label> <input name="show_mostajer_wo_aqd" type="checkbox" value="yes"    /> </label>
                                            <? echo $user_text106;// اظهر المستاجرين بدون عقود?></div></div>

                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"> <label> <input name="show_zero_rased"  checked="checked"   type="checkbox" value="yes"    /> </label>
                                            <? echo $user_text107;// اظهر المستاجرين ارصدتهم صفر ?> </div></div>


                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"> <label> <input name="aqd_eskan_no"    type="checkbox" value="yes"    /> </label>
                                            <? echo $user_text108;// عقود موثقه ?></div></div>



                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"> <label> <input name="show_aqd_start_on_period"    type="checkbox" value="yes"    /> </label>
                                            <? echo $user_text490;//	عقود تبدأ حسب الفترة لايشمل المجدد?></div></div>

                                    <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                        <div class="form-group"> <label> <input name="show_aqd_expire_on_period"    type="checkbox" value="yes"    /> </label>
                                            <? echo $user_text491;//	عقود تنتهي حسب الفترة لايشمل المجدد ?></div></div>



                                <? }?>


                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"> <label> <input name="show_estihqa_moqam"    type="checkbox" value="yes"    /> </label>
                                        <? echo $user_text492;//	عرض حركات الاستحقاق مقدم ?></div></div>



                                <div class="col-md-4" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"><label> <input name="export_type" type="checkbox" value="excel"  style="margin-top:11px;  " /></label>


                                        <? echo $estthmar17;//  تصدير اكسل ?><img src="img/excel_icon.gif" width="22" height="22" />
                                    </div></div>















                                <div class="col-md-12" style="direction:rtl;float:right;text-align: right;">
                                    <div class="form-group"><label><? echo $estthmar135;//	اظهار الاعمدة في التقرير ?> </label>
                                        <table width="100%" class="group-inactive-section" cellpadding="3">



                                            <tr>
                                                <td>  <p style="font-size:11px"> 	 <input name="show_country" style="  width: 14px; margin-top:5px; margin-left:3px;"  type="checkbox" value="0"   <?  if($_SERVER['SERVER_NAME']=="www.murabustan.net" or  $_SERVER['SERVER_NAME']=="murabustan.net") {?> checked="checked"<? }?>    />  <? echo $estthmar343;//الجنسية	?>
                                                    </p></td>

                                                <td><p style="font-size:11px"> 	 <input name="show_jawwal"  style="  width: 14px; margin-top:5px; margin-left:3px;" type="checkbox" value="0"   checked="checked"  />
                                                        <? echo $jawwal_txt;//رقم الجوال?></p></td>

                                                <td>  <p style="font-size:11px"> 	 <input name="show_emara" style="  width: 14px; margin-top:5px; margin-left:3px;"  type="checkbox" value="0"    checked="checked"    />  <? echo $cust_report47;//العمارة?>
                                                    </p></td>
                                                <td>  <p style="font-size:11px"> 	 <input name="show_aqarname" style="  width: 14px; margin-top:5px; margin-left:3px;"  type="checkbox" value="0"        /><? echo $estthmar586;// وصف العقار	?>
                                                    </p></td>

                                                <td><p style="font-size:11px"> 	 <input name="show_aqar"  style="  width: 14px; margin-top:5px; margin-left:3px;" type="checkbox" value="0"   checked="checked"  />
                                                        <? echo $property_txt;//العقار?></p></td>
                                                <td><p style="font-size:11px"> 	 <input name="show_stuts"  style="  width: 14px; margin-top:5px; margin-left:3px;" type="checkbox" value="0"     />
                                                        <? echo "حالة المستاجر";//حالة المستاجر?></p></td>
                                                <td>  <p style="font-size:11px"> 	 <input name="show_debit" style="  width: 14px; margin-top:5px; margin-left:3px;"  type="checkbox" value="0"    checked="checked"    /><? echo $user_text493;// اجمالي المدين	?>
                                                    </p></td>

                                                <td><p style="font-size:11px"> 	 <input name="show_credit"  style="  width: 14px; margin-top:5px; margin-left:3px;" type="checkbox" value="0"   checked="checked"  />
                                                        <? echo $user_text494;//	اجمالي الدائن?></p></td>

                                                <td>  <p style="font-size:11px"> 	 <input name="show_tammen" style="  width: 14px; margin-top:5px; margin-left:3px;"  type="checkbox" value="0"      /><? echo $Insurance_txt;// تأمين	?>
                                                <td>  <p style="font-size:11px"> 	 <input name="show_aqd_id" style="  width: 14px; margin-top:5px; margin-left:3px;"  type="checkbox" value="0"    checked="checked"    /> <? echo $estthmar25;//رقم العقد	?>
                                                    </p></td>
                                                <td>  <p style="font-size:11px"> 	 <input name="show_aqd_id_ejar" style="  width: 14px; margin-top:5px; margin-left:3px;"  type="checkbox" value="0"       /> <? echo $user_text495;//رقم ايجار	?>
                                                    </p></td>
                                                <td>  <p style="font-size:11px"> 	 <input name="last_sanad_notes" style="  width: 14px; margin-top:5px; margin-left:3px;"  type="checkbox" value="0"        /> <? echo $user_text496;// بيان آخر سند?>
                                                    </p></td>
                                                <td>  <p style="font-size:11px"> 	 <input name="last_sanad_date" style="  width: 14px; margin-top:5px; margin-left:3px;"  type="checkbox" value="0"        /> <? echo $user_text497;// اخر   سداد?>
                                                    </p></td>
                                                <td>  <p style="font-size:11px"> 	 <input name="last_sanad_cash" style="  width: 14px; margin-top:5px; margin-left:3px;"  type="checkbox" value="0"        /> <? echo "مبلغ اخر سداد";// مبلغ اخر سداد?>
                                                    </p></td>

                                                <td>  <p style="font-size:11px"> 	 <input name="show_vat_num" style="  width: 14px; margin-top:5px; margin-left:3px;"  type="checkbox" value="0"        /><? echo $m_estthmar140_2;//  الرقم الضريبي?>
                                                    </p></td>
                                                <td>  <p style="font-size:11px"> 	 <input name="show_mostajer_det" style="  width: 14px; margin-top:5px; margin-left:3px;"  type="checkbox" value="0"        /> <? echo $user_text498;// بيانات المستاجر?>
                                                    </p></td>

                                            </tr>


                                        </table>



                                    </div></div>



                                <? if($_GET["rep_type"]=="-1"){?>

                                <? } ?>


                                <? } else{


                                    mysql_select_db($database_data, $data);
                                    $query_Recordset2 = "SELECT * FROM tbl_customer where u_id=".myint_decrypt($_SESSION['admin_id']);
                                    $Recordset2 = mysql_query($query_Recordset2, $data) or die(mysql_error());
                                    $row_Recordset2 = mysql_fetch_assoc($Recordset2);
                                    ?>
                                    <input name="customer_id"    value="<? echo $row_Recordset2['id']; ?>" type="hidden" 	  id="customer_id"  class=":required" />
                                    <input name="customer_name" type="hidden" id="customer_name"   value="<? echo trim(mystr_decrypt($row_Recordset2['name'])); ?>" />

                                <? }?>


                                <input name="u_id"  type="hidden" class="texts"   value="<?php echo $_SESSION['edara_office_id'];?>" size="32" />

                                <input name="hid_det"  value="2"  type="hidden" id="hid_det"     />

                            </div>


                            <div class="form-action"><button class="button" type="submit"> <? echo $search_txt;?> <span style="font-size: 12px;"> <i class="fa fa-search"></i> </span> </button>
                                <input type="hidden" name="search" id="search" value="بحث" onkeypress="return submitenter(this,event)" alt="بحث">
                            </div>
                            <div class="clear"></div>
                        </div>




                    </div>

                    <div class="clear"></div>
                </div>



            </div></form>




    </div>

    <?php

}

if ($_POST['search']=="بحث") {


    include("edara/rep_mostajer_of_malk_action.php");?>


<? }?>

</body>
</html>

