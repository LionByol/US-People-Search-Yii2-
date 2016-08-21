<?php
use yii\helpers\Url;
use app\models\JSONObject;

$this->title = 'Reverse Phone:Dashboard - Hero Searches';
$oridata = json_decode($data, true);
$phonenumber = '('.substr($query_number, 0, 3).') '.substr($query_number, 3, 3).' - '.substr($query_number, 6);
$phonedata = [];
$phonedata['line_type'] = $oridata['results'][0]['line_type'];
$phonedata['carrier'] = $oridata['results'][0]['carrier'];
$phonedata['spam_level'] = $oridata['results'][0]['reputation']['level'];

$phonedata['name'] = [];
$phonedata['name']['first_name'] = $oridata['results'][0]['belongs_to'][0]['names'][0]['first_name'];
$phonedata['name']['middle_name'] = $oridata['results'][0]['belongs_to'][0]['names'][0]['middle_name'];
$phonedata['name']['last_name'] = $oridata['results'][0]['belongs_to'][0]['names'][0]['last_name'];
$phonedata['gender'] = $oridata['results'][0]['belongs_to'][0]['gender']==null?'male':$oridata['results'][0]['belongs_to'][0]['gender'];
$phonedata['age_range'] = $oridata['results'][0]['belongs_to'][0]['age_range']==null?'unknown':($oridata['results'][0]['belongs_to'][0]['age_range']['start'].'~'.$oridata['results'][0]['belongs_to'][0]['age_range']['end']);

$phonedata['location'] = [];
$phonedata['location']['address'] = $oridata['results'][0]['associated_locations'][0]['address'];
$phonedata['location']['country_code'] = $oridata['results'][0]['associated_locations'][0]['country_code'];
$phonedata['location']['state_code'] = $oridata['results'][0]['associated_locations'][0]['state_code'];
$phonedata['location']['zip4'] = $oridata['results'][0]['associated_locations'][0]['zip4'];
$phonedata['location']['postal_code'] = $oridata['results'][0]['associated_locations'][0]['postal_code'];
$phonedata['location']['city'] = $oridata['results'][0]['associated_locations'][0]['city'];
$phonedata['location']['latitude'] = $oridata['results'][0]['associated_locations'][0]['lat_long']['latitude'];
$phonedata['location']['longitude'] = $oridata['results'][0]['associated_locations'][0]['lat_long']['longitude'];
?>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="ibox-content text-center">
			<h2>Input Search Information</h2>
			<form class="form-inline" id="phone-form" action="<?= Url::to(['search/phonenumber']) ?>" method="post">
				<div class="form-group has-feedback width-100 response-width-search">
					<input type="tel" class="form-control search-field" placeholder="e.g. 206-897-5306" id="search-phone" name="phonenumber" value="<?= $query_number ?>" onkeyup="onPhoneChange(event.keyCode)">
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

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="row" style="background-color: white;margin: 10px 0px 0px 10px;padding: 20px;">
			<div class="col-sm-1">
				<div class="text-center">
					<img alt="image" class="img-circle m-t-xs img-responsive phone-circle" src="/images/mobile.jpg">
				</div>
			</div>
			<div class="col-sm-8">
				<h2><strong><?= $phonenumber ?></strong></h2>
				<p><i class="fa fa-map-marker"></i> Registered to <strong><?= $phonedata['name']['first_name'].' '.$phonedata['name']['middle_name'].' '.$phonedata['name']['last_name'] ?></strong></p>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-success" onclick="onSearchPeople()">Search details on <br><?= $phonedata['name']['first_name'].' '.$phonedata['name']['middle_name'].' '.$phonedata['name']['last_name'] ?></button>
			</div>
			<div class="clearfix"></div>
		</div>
		<form id="people-form" action="<?= Url::to(["search/peoplename"]) ?>" method="post">
			<input name="name" type="hidden" id="search-name" value="<?= $phonedata['name']['first_name'].' '.$phonedata['name']['last_name'] ?>">
			<input name="address" type="hidden" id="search-address" value="<?= $phonedata['location']['city'].', '.$phonedata['location']['state_code'] ?>" >
		</form>
		<script>
			function onSearchPeople()
			{
				var name = document.getElementById("search-name");
				var address = document.getElementById("search-address");
				var frm = document.getElementById("people-form");
				frm.submit();
			}
		</script>
		<div class="row" style="background-color: white;margin: 10px 0px 0px 10px;padding: 20px;">
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-12">
						<strong style="font-size: 24px;"> Owner's Details</strong>
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-sm-1">
						<div class="text-center">
							<i class="fa fa-user" style="font-size: 30px;"></i>
						</div>
					</div>
					<div class="col-sm-8">
						<p style="font-size: 20px;"><?= $phonedata['name']['first_name'].' '.$phonedata['name']['middle_name'].' '.$phonedata['name']['last_name'] ?></p>
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-sm-1">
						<div class="text-center">
							<i class="fa fa-home" style="font-size: 30px;"></i>
						</div>
					</div>
					<div class="col-sm-8">
						<p style="font-size: 20px;"><?= $phonedata['location']['address'] ?></p>
					</div>
				</div>
				<hr/>
			</div>
			<div class="col-sm-6">
				<script>
					function initialize()
					{
						var mapProp = {
							center: new google.maps.LatLng(<?= $phonedata['location']['latitude'] ?>, <?= $phonedata['location']['longitude'] ?>),
							zoom:14,
							mapTypeId:google.maps.MapTypeId.ROADMAP
						};
						var map = new google.maps.Map(document.getElementById('location-map'), mapProp);
						var marker = new google.maps.Marker({
							position:{lat:<?= $phonedata['location']['latitude'] ?>, lng:<?= $phonedata['location']['longitude'] ?>},
							map:map,
							title:'<?= $phonedata['location']['address'] ?>'
						});
					}
					google.maps.event.addDomListener(window, 'load', initialize);
				</script>
				<div id="location-map"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="row" style="background-color: white;margin: 10px 0px 0px 10px;padding: 20px;">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-md-12">
						<strong style="font-size: 24px;"> Phone Metadata</strong>
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-md-1">
						<div class="text-center">
							<i class="fa fa-flag" style="font-size: 30px;"></i>
						</div>
					</div>
					<div class="col-md-5">
						<p style="font-size: 18px;">Phone Number</p>
					</div>
					<div class="col-md-6">
						<p style="font-size: 20px;"><?= $phonenumber ?></p>
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-md-1">
						<div class="text-center">
							<i class="fa fa-mobile-phone" style="font-size: 30px;"></i>
						</div>
					</div>
					<div class="col-md-5">
						<p style="font-size: 18px;">Phone Type</p>
					</div>
					<div class="col-md-6">
						<p style="font-size: 20px;"><?= $phonedata['line_type'] ?></p>
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-md-1">
						<div class="text-center">
							<i class="fa fa-wifi" style="font-size: 30px;"></i>
						</div>
					</div>
					<div class="col-md-5">
						<p style="font-size: 18px;">Carrier</p>
					</div>
					<div class="col-md-6">
						<p style="font-size: 20px;"><?= $phonedata['carrier'] ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="background-color: white;margin: 10px 0px 0px 10px;padding: 20px;">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-md-12">
						<strong style="font-size: 24px;"> Phone Reputation</strong>
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-md-1">
						<div class="text-center">
							<i class="fa fa-check-circle-o" style="font-size: 30px;"></i>
						</div>
					</div>
					<div class="col-md-3">
						<p style="font-size: 18px;">Spam Level</p>
					</div>
					<div class="col-md-8">
						<p style="font-size: 20px;">
							<?php
								if($phonedata['spam_level']==1)
									echo 'LOW';
								else if($phonedata['spam_level']==2)
									echo 'MEDIUM';
								else
									echo 'HIGH';
							?>
						</p>
						<hr/>
						<p style="font-size: 16px;">
							<?php
							if($phonedata['spam_level']==1)
								echo $phonenumber.' appears to be a valid caller that presents practically no risk of scam or fraud.';
							else if($phonedata['spam_level']==2)
								 echo $phonenumber.' appears to be a valid caller, but presents practically few risk of scam or fraud.';
							else
								echo $phonenumber.' appears to be a invalid caller that presents practically risk of scam or fraud.';
							?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>