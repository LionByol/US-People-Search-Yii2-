<?php
use yii\helpers\Url;
use app\models\JSONObject;

$this->title = 'PersonSearch:Dashboard - Hero Searches';
$personArr = json_decode($data, true);
$person = [];

	//Analyze person data.
	$value1 = $personArr['results'][$id];

	$person['gender'] = $value1['gender']==null?'Male':$value1['gender'];
	//name
	$person['names'] = [];
	foreach($value1['names'] as $value2)
	{
		$name = [];		
		$name['first_name'] = $value2['first_name'];
		$name['middle_name'] = $value2['middle_name'];
		$name['last_name'] = $value2['last_name'];
		$person['names'][] = $name;
	}

	//age_range
	if($value1['age_range'] == null)
	{
		$person['age_range'] = "unknown";
	}
	else
	{
		$person['age_range'] = $value1['age_range']['start'].'~'.$value1['age_range']['end'];
	}

	//location
	$person['locations'] = [];
	foreach ($value1['locations'] as $value3)
	{
		$location = [];
		$location['address'] = $value3['address'];
		$location['city'] = $value3['city'];
		$location['state_code'] = $value3['state_code'];
		$location['postal_code'] = $value3['postal_code'];
		$location['zip4'] = $value3['zip4'];
		$ts = $value3['contact_creation_date'];		
		$location['contact_creation_date'] = date('Y, m', $ts);
		$location['valid_for_start'] = $value3['valid_for']['start']==null?"":$value3['valid_for']['start']['year'].'.'.$value3['valid_for']['start']['month'];
		$location['valid_for_stop'] = $value3['valid_for']['stop']==null?"":$value3['valid_for']['stop']['year'].'.'.$value3['valid_for']['stop']['month'];
		$location['latitude'] = $value3['lat_long']['latitude'];
		$location['longitude'] = $value3['lat_long']['longitude'];
		$person['locations'][] = $location;
	}

	//legal_entities_at
	$person['legal_entities_at'] = [];
	foreach($value1['best_location']['legal_entities_at'] as $value2)
	{
		$legal = [];
		$legal['first_name'] = $value2['names'][0]['first_name'];
		$legal['middle_name'] = $value2['names'][0]['middle_name'];
		$legal['last_name'] = $value2['names'][0]['last_name'];
		$legal['age_range'] = $value2['age_range']==null?'unknown':$value2['age_range']['start'].'~'.$value2['age_range']['end'];
		$legal['valid_for_start'] = $value2['valid_for']['start']==null?"":$value2['valid_for']['start']['year'].'.'.$value2['valid_for']['start']['month'];
		$legal['valid_for_stop'] = $value2['valid_for']['stop']==null?"":$value2['valid_for']['stop']['year'].'.'.$value2['valid_for']['stop']['month'];
		$person['legal_entities_at'][] = $legal;
	}

	//current location
	$person['current_location'] = [];
	$person['current_location']['address'] = $value1['best_location']['address'];
	$person['current_location']['city'] = $value1['best_location']['city'];
	$person['current_location']['state_code'] = $value1['best_location']['state_code'];
	$person['current_location']['postal_code'] = $value1['best_location']['postal_code'];
	$person['current_location']['zip4'] = $value1['best_location']['zip4'];
	$person['current_location']['latitude'] = $value1['best_location']['lat_long']['latitude'];
	$person['current_location']['longitude'] = $value1['best_location']['lat_long']['longitude'];

	//phones
	$person['phones'] = [];
	foreach ($value1['phones'] as $value2)
	{
		$phone = [];
		$phone['phone_number'] = isset($value2['phone_number'])?$value2['phone_number']:'unknown';
		$phone['country_calling_code'] = isset($value2['country_calling_code'])?$value2['country_calling_code']:'unknown';
		$phone['line_type'] = isset($value2['line_type'])?$value2['line_type']:'unknown';
		$ts = $value2['contact_creation_date'];
		$phone['contact_creation_date'] = date('Y, m', $ts);
		$persons['phones'] = $phone;
	}

?>

<div class="row" style="margin-top:20px;">
	<div class="col-md-6 col-md-offset-3">
		<div class="profile-image">
            <img src="/images/avater.jpg" class="img-circle circle-border m-b-md" alt="profile">
        </div>
		<div class="profile-info">
            <div class="">
                <div>
                    <h2>
                        <?= $person['names'][0]['first_name'].' '.$person['names'][0]['middle_name'].' '.$person['names'][0]['last_name'] ?>
                    </h2>
                    <h4>AGE: <?= $person['age_range'] ?></h4>
                </div>
            </div>
        </div>
	</div>
</div>

<div class="row" style="font-size: 14px;">
	<div class="col-md-8 col-md-offset-2">
		<div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a aria-expanded="false" data-toggle="tab" href="#tab-1">Contact Info</a></li>
                <li class=""><a aria-expanded="true" data-toggle="tab" href="#tab-2">Criminal Records</a></li>
                <li class=""><a aria-expanded="true" data-toggle="tab" href="#tab-3">Bankruptcies</a></li>
                <li class=""><a aria-expanded="true" data-toggle="tab" href="#tab-4">Liens & Judgments</a></li>
                <li class=""><a aria-expanded="true" data-toggle="tab" href="#tab-5">Properties</a></li>
                <li class=""><a aria-expanded="true" data-toggle="tab" href="#tab-6">Licenses</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">                        
                        <div class="row">
	                        <div class="col-md-6">
	                        	<p><strong><i class="fa fa-home" style="padding-right: 10px;font-size: 18px;"></i></strong> <?= $person['current_location']['address'] ?></p>
	                        	<p style="padding-left: 20px;"><?= $person['locations'][0]['contact_creation_date'] ?> - Present</p>
	                        	<hr/>
	                        	<?php
	                        	if(count($person['phones']) > 0)
	                        	{
		                        	$flg = false;
		                        	foreach ($person['phones'] as $value)
		                        	{
		                        		if(!$flg)
		                        		{
		                        			$flg = true;
		                        			echo '<p><strong><i class="fa fa-phone" style="padding-right: 10px;font-size: 18px;"></i></strong> '.$person['phones'].'</p>';
		                        		}
		                        		else
		                        		{
		                        			echo '<p>'.$person['phones'].'</p>';
		                        		}
			                        }
			                    }
			                    else
			                    {
			                    	echo '<p><strong><i class="fa fa-phone" style="padding-right: 10px;font-size: 18px;"></i></strong> unknown</p>';
			                    }
	                        	?>
	                        	<hr/>
	                        	<p><strong>AKA</strong></p>
	                        	<?php
	                        		foreach ($person['names'] as $value2)
	                        		{
	                        			echo '<p>'.$value2['first_name'].' '.$value2['middle_name'].' '.$value2['last_name'].'</p>';
	                        		}
	                        	?>
	                        </div>
	                        <div class="col-md-6">
		                        <script>
		                        function initialize()
		                        {
		                        	var mapProp = {
		                        		center: new google.maps.LatLng(<?= $person['current_location']['latitude'] ?>, <?= $person['current_location']['longitude'] ?>),
		                        		zoom:14,
		                        		mapTypeId:google.maps.MapTypeId.ROADMAP
		                        	};
		                        	var map = new google.maps.Map(document.getElementById('location-map'), mapProp);
		                        	var marker = new google.maps.Marker({
		                        		position:{lat:<?= $person['current_location']['latitude'] ?>, lng:<?= $person['current_location']['longitude'] ?>},
		                        		map:map,
		                        		title:'<?= $person['current_location']['address'] ?>'
		                        	});
		                        }
		                        google.maps.event.addDomListener(window, 'load', initialize);
		                        </script>
		                        <div id="location-map"></div>
	                        </div>
                        </div>

                        <hr style="margin:5px;" />
                        
                        <div class="row">
	                        <div class="col-md-12">
	                        	<h2 class="title"><strong>Phone Numbers</strong></h2>
	                        	<?php
	                        		if(count($person['phones']) == 0)
	                        			echo 'Unknown';
	                        		else
	                        		{
	                        			foreach ($person['phones'] as $value)
	                        			{
	                        			?>
	                        				<div class="row">
	                        					<div class="col-md-4">
				                        			<strong><?= $value['phone_number'] ?></strong>
				                        		</div>
				                        		<div class="col-md-4">
				                        			<p><?= $value['contact_creation_date'] ?>~</p>
				                        		</div>
	                        				</div>
										<?php
	                        			}
		                        	}
	                        	?>
	                        </div>
                        </div>

                        <hr style="margin:5px;" />

                        <div class="row">
	                        <div class="col-md-12">
	                       	 	<h2 class="title"><strong>Pervious Address</strong></h2>
	                       	 	<?php
	                       	 	$cnt = 0;
	                       	 	foreach ($person['locations'] as $value)
	                       	 	{
	                       	 	?>
		                       	 	<div class="row" style="margin-top: 20px;">
			                       	 	<div class="col-md-6">
			                       	 		<p><i class="fa fa-home" style="padding-right: 10px;"></i> <?= $value['address'] ?></p>
			                       	 	</div>
			                       	 	<div class="col-md-3">
			                       	 		<p><?= $value['valid_for_start'] ?> ~ <?= $value['valid_for_stop'] ?></p>
			                       	 	</div>
			                       	 	<div class="col-md-3">
			                       	 		<a href="javascript:onShowMap(<?= $cnt ?>)" id="showbtn<?= $cnt ?>">Hide Map</a>
			                       	 	</div>
			                       	 	<div class="col-md-12" id="previous-map<?= $cnt ?>" style="display:block">
			                       	 		<script>
						                        function initialize<?= $cnt ?>()
						                        {
						                        	var mapProp = {
						                        		center: new google.maps.LatLng(<?= $value['latitude'] ?>, <?= $value['longitude'] ?>),
						                        		zoom:14,
						                        		mapTypeId:google.maps.MapTypeId.ROADMAP
						                        	};
						                        	var map = new google.maps.Map(document.getElementById('pre-map<?= $cnt ?>'), mapProp);
						                        	var marker = new google.maps.Marker({
						                        		position:{lat:<?= $value['latitude'] ?>, lng:<?= $value['longitude'] ?>},
						                        		map:map,
						                        		title:'<?= $value['address'] ?>'
						                        	});
						                        }
						                        google.maps.event.addDomListener(window, 'load', initialize<?= $cnt ?>);
					                        </script>
			                       	 		<div id="pre-map<?= $cnt ?>" style="height:200px;"></div>
			                       	 	</div>
		                       	 	</div>
		                       	 	<?php
		                       	 	$cnt ++;
	                       	 	}
	                       	 	?>
	                       	 	<script type="text/javascript">
	                       	 		function onShowMap(id)
	                       	 		{
	                       	 			var ele = document.getElementById("previous-map"+id);
	                       	 			var btn = document.getElementById("showbtn"+id);
	                       	 			if(ele.style.display == 'block')
	                       	 			{
	                       	 				ele.style.display = 'none';
	                       	 				btn.innerHTML = "Show Map";
	                       	 			}
	                       	 			else
	                       	 			{
	                       	 				ele.style.display = 'block';
	                       	 				btn.innerHTML = "Hide Map";
	                       	 			}
	                       	 		}
	                       	 	</script>
	                        </div>
                        </div>

                        <hr style="margin:5px;" />

                        <div class="row">
                        	<div class="col-md-12">
	                       	 	<h2 class="title"><strong>Family members</strong></h2>
	                       	 	<?php
	                       	 	$cnt = 0;
	                        	foreach ($person['legal_entities_at'] as $value)
	                       	 	{
	                       	 	?>
		                       	 	<div class="row" style="font-size: 14px;margin-top: 10px;">
			                       	 	<div class="col-md-6">
			                       	 		<p><i class="fa fa-user" style="padding-right: 10px;"></i> <?= $value['first_name'].' '.$value['middle_name'].' '.$value['last_name'] ?></p>
			                       	 	</div>
			                       	 	<div class="col-md-3">
			                       	 		<p><i class="fa fa-gift" style="padding-right: 10px;"></i><?= $value['age_range'] ?></p>
			                       	 	</div>
			                       	 	<div class="col-md-3">
			                       	 		<p><?= $value['valid_for_start'] ?> ~ <?= $value['valid_for_stop'] ?></p>
			                       	 	</div>
		                       	 	</div>
		                       	 	<?php
		                       	 	$cnt ++;
	                       	 	}
	                       	 	?>
	                       	 </div>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
						<div class="col-sm-2">
							<div class="text-center">
								<center><img alt="image" class="img-circle m-t-xs img-responsive" src="/images/handcuffs.jpg"></center>
								<div class="m-t-xs font-bold" style="font-size: 18px;">Criminal Records</div>
							</div>
						</div>
						<div class="col-sm-8 col-sm-offset-1">
							<div>
								<p>Our Criminal Records include all available details on <strong>Criminal and Traffic Offenses, Arrests, and Warrants</strong> and may contain over 100 different attributes such as:</p>
								<ul>
									<li><strong>Identifying information</strong> including birth date, gender, hair, eye color, and height</li>
									<li><strong>Mugshots</strong>, if available on file</li>
									<li>Indication if the person is a <strong>Sex Offender</strong></li>
									<li><strong>Offense details</strong> including crime type, location, date, and description</li>
									<li><strong>Case details</strong> including case type, plea, courts, disposition, sentence, and relevant dates</li>
								</ul>
							</div>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<p>Case details including case type, plea, courts, disposition, sentence, and relevant dates</p>
						</div>
						<div class="col-sm-12 text-center">
							<button class="btn btn-success">Get full details</button>
						</div>
						<div class="clearfix"></div>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
						<div class="col-sm-2">
							<div class="text-center">
								<center><img alt="image" class="img-circle m-t-xs img-responsive" src="/images/bankrupcies.jpg"></center>
								<div class="m-t-xs font-bold" style="font-size: 18px;">Bankruptcies and Foreclosures </div>
							</div>
						</div>
						<div class="col-sm-8 col-sm-offset-1">
							<div>
								<p>Our <strong>Bankruptcy</strong> records may contain over 35 different attributes such as:</p>
								<ul>
									<li><strong>Bankruptcy details</strong> including type, location, case details, and relevant dates</li>
									<li><strong>Action type</strong> including petition, discharge, dismissal, or conversion</li>
									<li><strong>Attorney and law firm</strong> names and addresses</li>
									<li><strong>Trustee</strong> names and addresses</li>
									<li><strong>Court details</strong></li>
								</ul>
								<p>Our Foreclosure records may contain over 60 different attributes such as:</p>
								<ul>
									<li><strong>Property details</strong> including address, size, age, zoning, number of rooms, and value</li>
									<li><strong>Lender</strong> company, trustee, and plaintiff details</li>
									<li><strong>Loan</strong> amount and dates</li>
									<li>Assessor’s <strong>Parcel number ID</strong></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<p>To see if this person has any bankruptcy or foreclosure records associated with their past, unlock their profile by ordering a Background Report today. </p>
						</div>
						<div class="col-sm-12 text-center">
							<button class="btn btn-success">Get full details</button>
						</div>
						<div class="clearfix"></div>
                    </div>
                </div>
                <div id="tab-4" class="tab-pane">
                    <div class="panel-body">
						<div class="col-sm-2">
							<div class="text-center">
								<center><img alt="image" class="img-circle m-t-xs img-responsive" src="/images/court.jpg"></center>
								<div class="m-t-xs font-bold" style="font-size: 18px;">Liens & Judgments </div>
							</div>
						</div>
						<div class="col-sm-8 col-sm-offset-1">
							<div>
								<p>Our <strong>Lien and Judgment</strong> records may contain over 40 different attributes such as: </p>
								<ul>
									<li><strong>Identifying information</strong> including name, address, and DOB</li>
									<li><strong>Lien and judgement details</strong> such as amount, filing type, and plaintiff</li>
									<li><strong>Case details</strong> such as case number, relevant dates, and court contact information</li>
									<li>Relevant <strong>document details</strong> such as document type, recording number, and date</li>
								</ul>
							</div>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<p>To see if this person has any lien or judgment records associated with their past, unlock their profile by ordering a Background Report today.</p>
						</div>
						<div class="col-sm-12 text-center">
							<button class="btn btn-success">Get full details</button>
						</div>
						<div class="clearfix"></div>
                    </div>
                </div>
                <div id="tab-5" class="tab-pane">
                    <div class="panel-body">
						<div class="col-sm-2">
							<div class="text-center">
								<center><img alt="image" class="img-circle m-t-xs img-responsive" src="/images/properties.jpg"></center>
								<div class="m-t-xs font-bold" style="font-size: 18px;">Properties </div>
							</div>
						</div>
						<div class="col-sm-8 col-sm-offset-1">
							<div>
								<p>Our <strong>Property Ownership</strong> records may contain over 70 different attributes on current and historical properties such as: </p>
								<ul>
									<li><strong>Basic property information</strong> including address, size, year built, and description</li>
									<li><strong>Tax and assessment information</strong> including assessed, tax, improvement, and total values; number of rooms and baths</li>
									<li>Current <strong>owner details</strong> including owner and seller, type of property, dates</li>
									<li>Related <strong>mortgage</strong> information including lender, amount, interest rate, and term</li>
								</ul>
							</div>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<p>To see if this person owns any properties, businesses or guns, unlock their profile by ordering a Background Report today.</p>
						</div>
						<div class="col-sm-12 text-center">
							<button class="btn btn-success">Get full details</button>
						</div>
						<div class="clearfix"></div>
                    </div>
                </div>
                <div id="tab-6" class="tab-pane">
                    <div class="panel-body">
						<div class="col-sm-2">
							<div class="text-center">
								<center><img alt="image" class="img-circle m-t-xs img-responsive" src="/images/licence.jpg"></center>
								<div class="m-t-xs font-bold" style="font-size: 18px;">Licenses </div>
							</div>
						</div>
						<div class="col-sm-8 col-sm-offset-1">
							<div>
								<p>Our <strong>Licenses and Permits</strong> records may contain: </p>
								<ul>
									<li><strong>Professional license</strong> details for all US states and territories including type, number, state, status, issue and expiration date</li>
									<li><strong>Pilot license</strong> records issued by FAA</li>
									<li><strong>Permits</strong> including hunting permits and concealed weapon permits</li>
								</ul>
							</div>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<p>To see if this person has any licenses, unlock their profile by ordering a Background Report today.</p>
						</div>
						<div class="col-sm-12 text-center">
							<button class="btn btn-success">Get full details</button>
						</div>
						<div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

<div class="row" style="margin-top: 20px;">
	<div class="col-md-8 col-md-offset-2">
		<div class="social-feed-box">
			<p style="padding:20px;">
				*The records displayed in this report may or may not actually belong to the person you searched for, especially if the person you searched for has a common name. Records may also include incorrect, partial, or outdated data. Please always use caution with respect to the information in these reports.
			</p>
		</div>
	</div>
</div>