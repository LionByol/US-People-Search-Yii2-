<?php
use yii\helpers\Url;

$this->title = 'Person Search:Dashboard - Hero Searches';
?>

<h1 class="title text-center" style="font-weight: bold;">Person Search</h1>
<h3 class="title text-center" style="margin-bottom: 40px;margin-top: 20px;">Search by name to find owner's phone, email, address, family members, etc.</h3>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="ibox-content text-center">
            <h2>Input Search Information</h2>
            <form id="people-form" class="form-inline" method="post" action="<?= Url::to(["search/peoplename"]) ?>">
                <div class="form-group width-45 response-width-search">
                    <input name="name" type="text" class="form-control search-field" placeholder="e.g. Jon Sonw" id="search-name" onkeyup="onPeopleNameChange()">
                </div>
                <div class="form-group has-feedback width-45 response-width-search">
                    <input name="address" type="text" class="form-control search-field" id="search-address" placeholder="City, State or ZIP" >
                    <span class="fa fa-search form-control-feedback font-26" style="width:35px;height:35px;line-height:35px !important;z-index: 10;pointer-events: auto;cursor: pointer;" onclick="onSearch()"></span>
                </div>
            </form>
            <p id="error" style="color:red;"></p>
            <hr/>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <p>Tip: Looking for criminal records? Use our <a href="<?= Url::to(['admin/courtsearch']) ?>">court records search</a> instead. </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <p style="margin-top: 40px;">Looking to reconnect with family members? Need to find out where your friend lives? When you search by name, we gather that person’s contact information and any possible records. </p>
    </div>
</div>

<div class="row" style="margin-top:20px;">
    <div class="col-md-4 col-md-offset-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>PERSON SEARCHES MAY INCLUDE </h5>
            </div>
            <div class="ibox-content">        
                <ul>
                    <li>Phone Numbers</li>
                    <li>Email Addresses</li>
                    <li>Family Members</li>
                    <li>Age</li>
                    <li>Current and Historical Addresses</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function onSearch ()              //people name search
    {
        var name = document.getElementById("search-name");
        var address = document.getElementById("search-address");
        if(name.value == '')
        {
            var err = document.getElementById("error");
            err.style.display = "block";
            err.innerHTML = "Please input people name.";
            return;
        }

        var frm = document.getElementById("people-form");
        frm.submit();

        // var fd = new FormData();
        // fd.append('name', name.value);
        // fd.append('address', address.value);
        // $.ajax({
        //     url: '<?=\yii\helpers\BaseUrl::home()?>/search/peoplename',
        //     cache: false,
        //     type: 'POST',
        //     data: fd,
        //     processData: false,
        //     contentType: false,
        //     success: function (data) {
        //         alert(data);
        //     },
        //     error: function () {
        //         alert("ERROR in Internet.");
        //     }
        // });
    }

    function onPeopleNameChange()       //people name box change monitor
    {
        var name = document.getElementById("search-name");
        if(name.value != '')
        {
            var err = document.getElementById("error");
            err.style.display = "none";
            err.innerHTML = "";
        }
    }
</script>