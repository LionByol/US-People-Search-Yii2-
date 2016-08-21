<?php
use yii\helpers\Url;

$this->title = 'Phone Search:Dashboard - Hero Searches';
?>

<h1 class="title text-center" style="font-weight: bold;">Address Search</h1>
<h3 class="title text-center" style="margin-bottom: 40px;margin-top: 20px;">Search by phone number to find owner's name, address, other contact info, etc.</h3>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="ibox-content text-center">
            <h2>Input Search Information</h2>
            <form class="form-inline">
                <div class="form-group width-45 response-width-search">
                    <input type="text" class="form-control search-field" placeholder="e.g. 1600 Pennsylvnia Ave NW" id="search-street" onkeyup="onStreetChange()">
                </div>
                <div class="form-group has-feedback width-45 response-width-search">
                    <input type="text" class="form-control search-field" id="search-zip" placeholder="City, State or ZIP" >
                    <span class="fa fa-search form-control-feedback font-26" style="width:35px;height:35px;line-height:35px !important;z-index: 10;pointer-events: auto;cursor: pointer;" onclick="onSearch()"></span>
                </div>
            </form>
            <p id="error" style="color:red;"></p>
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
        <p style="margin-top: 40px;">You can use our address search to look up info about your new neighbors or find people who used to live in your house. When you search by an address, we gather the owner’s name, family members, other contact info, etc. </p>
    </div>
</div>

<div class="row" style="margin-top:20px;">
    <div class="col-md-4 col-md-offset-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>REVERSE ADDRESS MAY INCLUDE </h5>
            </div>
            <div class="ibox-content">
                <ul>
                    <li>Name</li>
                    <li>Age</li>
                    <li>Date of Birth</li>
                    <li>Current and Historical Occupants</li>
                    <li>Family Members</li>
                    <li>Phone Numbers</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function onSearch ()              //people name search
    {
        var streetname = document.getElementById("search-street");
        var address = document.getElementById("search-zip");
        if(streetname.value == '')
        {
            var err = document.getElementById("error");
            err.style.display = "block";
            err.innerHTML = "Please input street information.";
            return;
        }
        var fd = new FormData();
        fd.append('street', streetname.value);
        fd.append('address', address.value);
        $.ajax({
            url: '<?=\yii\helpers\BaseUrl::home()?>/search/streetaddress',
            cache: false,
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            success: function (data)
            {
                alert(data);
            },
            error: function () {
                alert("ERROR in Internet.");
            }
        });
    }

    function onStreetChange()       //street box change monitor
    {
        var street = document.getElementById("search-street");
        if(street.value != '')
        {
            var err = document.getElementById("error");
            err.style.display = "none";
            err.innerHTML = "";
        }
    }
</script>