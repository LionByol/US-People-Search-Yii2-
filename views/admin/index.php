<?php
use yii\helpers\Url;

$this->title = 'Home:Dashboard - Hero Searches';
?>

<h1 class="title text-center" style="font-weight: bold;">Four ways to search. Unlimited Possibilities.</h1>
<h3 class="title text-center" style="margin-bottom: 40px;margin-top: 20px;">Background Reports, Criminal Records, Contact Details and More!</h3>
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="widget lazur-bg p-xl text-center">
            <h2>
                Person Search
            </h2>

            <p>Search by name to find owner's phone, email, address, family members, etc.</p>

            <button class="btn btn-default dim btn-large-dim" type="button" onclick="window.location='<?= Url::to(['admin/personsearch']) ?>'">Search</button>
        </div>
    </div>
    <div class="col-md-4">
        <div class="widget navy-bg p-xl text-center">
            <h2>
                Reverse Phone Search
            </h2>

            <p>Search by phone to find owner's name, address, other contact info, etc.</p>

            <button class="btn btn-default dim btn-large-dim" type="button" onclick="window.location='<?= Url::to(['admin/phonesearch']) ?>'">Search</button>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="widget yellow-bg p-xl text-center">
            <h2>
                Reverse Address Search
            </h2>

            <p>Search by address to find owner's name, family members, contact info, etc.</p>

            <button class="btn btn-default dim btn-large-dim" type="button" onclick="window.location='<?= Url::to(['admin/addresssearch']) ?>'">Search</button>

        </div>
    </div>
    <div class="col-md-4">
        <div class="widget blue-bg p-xl text-center">
            <h2>
                Court Record Search
            </h2>

            <p>Search by name to find owner's criminal records, liens, judgments, etc.</p>

            <button class="btn btn-default dim btn-large-dim" type="button" onclick="window.location='<?= Url::to(['admin/courtsearch']) ?>'">Search</button>

        </div>
    </div>
</div>