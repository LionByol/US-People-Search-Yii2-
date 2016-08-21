<?php
use yii\helpers\Url;

$this->title = 'Phone Search:Dashboard - Hero Searches';
?>

<h1 class="title text-center" style="font-weight: bold;">Phone Search</h1>
<h3 class="title text-center" style="margin-bottom: 40px;margin-top: 20px;">Search by phone number to find owner's name, address, other contact info, etc.</h3>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="ibox-content text-center">
            <h2>Input Search Information</h2>
            <form class="form-inline" id="phone-form" action="<?= Url::to(['search/phonenumber']) ?>" method="post">
                <div class="form-group has-feedback width-100 response-width-search">
                    <input type="tel" class="form-control search-field" placeholder="e.g. 206-897-5306" id="search-phone" name="phonenumber" onkeyup="onPhoneChange(event.keyCode)">
                    <span class="fa fa-search form-control-feedback font-26" style="width:35px;height:35px;line-height:35px !important;z-index: 10;pointer-events: auto;cursor: pointer;" onclick="onSearch()"></span>
                </div>
            </form>
            <p id="error" style="color:red;"><?= isset($error)?$error:'' ?></p>
            <hr/>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <p>Tip: Looking for a phone number? Use our <a href="<?= Url::to(['admin/personsearch']) ?>">person search</a> instead. </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <p style="margin-top: 40px;">Use our reverse phone number search to find out who called you. When you search by a phone number, we gather the owner’s name, address, and contact information. </p>
    </div>
</div>

<div class="row" style="margin-top:20px;">
    <div class="col-md-4 col-md-offset-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>REVERSE PHONE MAY INCLUDE </h5>
            </div>
            <div class="ibox-content">        
                <ul>
                    <li>Name</li>
                    <li>Age</li>
                    <li>Current and Historical Addresses</li>
                    <li>Family Members</li>
                    <li>Related Phone Numbers</li>
                    <li>Phone Metadata</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function onSearch ()
    {
        var phone = document.getElementById("search-phone");
        if(phone.value == '')
        {
            var err = document.getElementById("error");
            err.style.display = "block";
            err.innerHTML = "Please input phone number.";
            return;
        }

        var frm = document.getElementById("phone-form");
        frm.submit();

//        var fd = new FormData();
//        fd.append('phonenumber', phone.value);
//        $.ajax({
//            url: '<?//=\yii\helpers\BaseUrl::home()?>///search/phonenumber',
//            cache: false,
//            type: 'POST',
//            data: fd,
//            processData: false,
//            contentType: false,
//            success: function (data) {
//                alert(data);
//            },
//            error: function () {
//                alert("ERROR in Internet.");
//            }
//        });
    }

    function onPhoneChange(keycode)
    {
        var phone = document.getElementById("search-phone");
        if((keycode>=65 && keycode<=90) || (keycode>=97 && keycode<112))
        {
            phone.value = phone.value.substring(0, phone.value.length-1);
        }
        if(phone.value != '')
        {
            var err = document.getElementById("error");
            err.style.display = "none";
            err.innerHTML = "";
        }
    }
</script>