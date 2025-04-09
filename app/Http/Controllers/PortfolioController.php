<div class="content">
    <!-- header -->
    <div class="header">
        <div class="titleInfo">
            <!-- <div class="breadcrumbs">
                محاسبة وسندات
            </div> -->
            <div class="titleTabs">
                <h1 class="pageTitle">كشف حساب عام</h1>
            </div>
        </div>

    </div>



    <!-- filters -->
    <div class="filtersIncomeReports generalAccount">

        <div class="accountTypeCalendar">
            <div class="accountTypeTabsGeneralAccountLog">
                <div class="account selected">
                    <div class="clientTypeContainer">
                        <img src="img/ownerBlue.svg" alt="">
                        <span class="clientTypeChecked">مالك</span>
                        <div class="selectedAccountInfo">
                            <div class="verticalDivider"></div>
                            <div class="accountTwoLines">
                                <span class="accountName">محمد الميموني</span>
                                <span class="accountNum">#325</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="account" id="selectRental">
                    <div class="clientTypeContainer">
                        <img src="img/rentalBlue.svg" alt="">
                        <span class="clientTypeChecked">مستأجر</span>
                    </div>
                </div>

                <div class="account">
                    <div class="clientTypeContainer">
                        <img src="img/buyerBlue.svg" alt="">
                        <span class="clientTypeChecked">مشتري</span>
                    </div>
                </div>

                <div class="account">
                    <div class="clientTypeContainer">
                        <img src="img/buildingLogBlue.svg" alt="">
                        <span class="clientTypeChecked">دليل العملاء والعقار</span>
                    </div>
                </div>

                <div class="account">
                    <div class="clientTypeContainer">
                        <img src="img/accountsLogBlue.svg" alt="">
                        <span class="clientTypeChecked">دليل الحسابات</span>
                    </div>
                </div>
            </div>

            <div class="dateRangeContainer">
                <div class="dateType">

                    <input type="radio" id="cristian" name="calendar_type" value="cristian" checked="">
                    <label class="radioLabel" for="cristian">ميلادياً</label>

                    <input type="radio" id="hijri" name="calendar_type" value="cristian">
                    <label class="radioLabel" for="hijri">هجرياً</label>
                </div>

                <div class="relatedInputs">
                    <div class="inputWithHintDiv">
                        من
                        <input type="date" name="cristian_calendar" id="cristianCalendarFrom" value="01/01/2024" class="filterInput">
                        <img src="img/calendarInput.svg" alt="">
                    </div>
                    <div class="inputWithHintDiv">
                        إلى
                        <input type="date" name="cristian_calendar" id="cristianCalendarTo" value="01/01/2024" class="filterInput">
                        <img src="img/calendarInput.svg" alt="">
                    </div>
                </div>
            </div>


        </div>

        <!-- filters -->
        <div class="filtersGrid reportsFiltersGrid">



            <div class="filterContainer">
                <label for="itemUnit" class="filterLabel">مركز التكلفة</label>
                <div class="popupInputDiv">
                    <span>اختر</span>
                    <img src="img/nextArrow.svg" alt="">
                </div>
            </div>

            <div class="filterContainer">
                <label for="itemUnit" class="filterLabel">العقار</label>
                <select name="dropDown" id="itemUnit" autocomplete="transaction-currency">
                    <option value="كل العمائر والشقق">كل العمائر والشقق</option>
                </select>
            </div>



            <div class="filterContainer">
                <label for="itemUnit" class="filterLabel">نوع السند</label>
                <select name="dropDown" id="itemUnit" autocomplete="transaction-currency">
                    <option value="اختر">اختر نوع السند</option>
                </select>
            </div>


            <div class="filterContainer">
                <label for="itemUnit" class="filterLabel">اطبع حساب</label>
                <select name="dropDown" id="itemUnit" autocomplete="transaction-currency">
                    <option value="اختر">الكل</option>
                </select>
            </div>

            <div class="filterContainer" style="margin-top: 0;">
                <div class="searchInput">
                    <img src="img/search.svg" alt="">
                    <input type="text" name="search" id="searchInput" placeholder="بحث">
                </div>
            </div>
        </div>

        <div class="checkBtnsGeneral">
            <div class="checkContainer">
                <input type="checkbox" name="checkboxesGeneralAccount" id="generalAccountCheck1">
                <label for="generalAccountCheck1">عرض عمود العميل من كشف حساب عام</label>
            </div>

            <div class="checkContainer">
                <input type="checkbox" name="checkboxesGeneralAccount" id="generalAccountCheck2">
                <label for="generalAccountCheck2">عرض قيمة العقد ونوع الدفع في كشف حساب عام</label>
            </div>

            <div class="checkContainer">
                <input type="checkbox" name="checkboxesGeneralAccount" id="generalAccountCheck3">
                <label for="generalAccountCheck3">عرض اسم العقار</label>
            </div>

            <div class="checkContainer">
                <input type="checkbox" name="checkboxesGeneralAccount" id="generalAccountCheck4">
                <label for="generalAccountCheck4">عرض عمود مركز التكلفة من كشف حساب عام</label>
            </div>
            <div class="checkContainer">
                <input type="checkbox" name="checkboxesGeneralAccount" id="generalAccountCheck5">
                <label for="generalAccountCheck5">اخفاء حركات قبض الايجار من كشف المالك</label>
            </div>

            <div class="checkContainer">
                <input type="checkbox" name="checkboxesGeneralAccount" id="generalAccountCheck6">
                <label for="generalAccountCheck6">اخفاء تفاصيل الحركات - مبالغ فقط</label>
            </div>
            <div class="checkContainer">
                <input type="checkbox" name="checkboxesGeneralAccount" id="generalAccountCheck7">
                <label for="generalAccountCheck7">عرض حركات اهلاك كشف حساب اصل</label>
            </div>

            <div class="checkContainer">
                <input type="checkbox" name="checkboxesGeneralAccount" id="generalAccountCheck8">
                <label for="generalAccountCheck8">بدون رصيد افتتاحي</label>
            </div>
            <div class="checkContainer">
                <input type="checkbox" name="checkboxesGeneralAccount" id="generalAccountCheck9">
                <label for="generalAccountCheck9">عرض شامل تأمين الصيانة</label>
            </div>

            <div class="checkContainer">
                <input type="checkbox" name="checkboxesGeneralAccount" id="generalAccountCheck10">
                <label for="generalAccountCheck10">عرض حركات شهري مقطوع الاستثمار للمالك</label>
            </div>
            <div class="checkContainer">
                <input type="checkbox" name="checkboxesGeneralAccount" id="generalAccountCheck11">
                <label for="generalAccountCheck11">عرض رقم المرجع للسند</label>
            </div>

        </div>

    </div>
</div>
