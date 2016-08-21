<?php
use yii\helpers\Url;
use app\models\JSONObject;

$this->title = 'PersonSearch:Dashboard - Hero Searches';
$personArr = json_decode($data, true);
$persons = [];

//Analyze peoples data.
foreach ($personArr['results'] as $value1)
{
	$person = [];
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
		$location['city'] = $value3['city'];
		$location['state_code'] = $value3['state_code'];
		$location['postal_code'] = $value3['postal_code'];
		$person['locations'][] = $location;
	}

	//legal_entities_at
	$person['legal_entities_at'] = [];
	if($value1['best_location'] != null)
	{
		foreach ($value1['best_location']['legal_entities_at'] as $value2)
		{
			$legal = [];
			$legal['first_name'] = $value2['names'][0]['first_name'];
			$legal['middle_name'] = $value2['names'][0]['middle_name'];
			$legal['last_name'] = $value2['names'][0]['last_name'];
			$legal['age_range'] = $value2['age_range'] == null ? 'unknown' : $value2['age_range']['start'] . '~' . $value2['age_range']['end'];
			$person['legal_entities_at'][] = $legal;
		}
	}

	$persons[] = $person;
}
?>
<div class="row" style="margin-bottom: 40px;">
	<div class="col-md-8 col-md-offset-2">		
		<div class="ibox-content text-center p-md">
		    <h2>People Search</h2>
	    	<div class="">
	    		<form id="people-form" class="form-inline" method="post" action="<?= Url::to(["search/peoplename"]) ?>">
	                <div class="form-group width-45 response-width-search">
	                    <input name="name" type="text" class="form-control search-field" placeholder="e.g. Jon Sonw" id="search-name" onkeyup="onPeopleNameChange()" value="<?= $query_name ?>">
	                </div>
	                <div class="form-group has-feedback width-45 response-width-search">
	                    <input name="address" type="text" class="form-control search-field" id="search-address" placeholder="City, State or ZIP" value="<?= $query_address ?>">
	                    <span class="fa fa-search form-control-feedback font-26" style="width:35px;height:35px;line-height:35px !important;z-index: 10;pointer-events: auto;cursor: pointer;" onclick="onSearch()"></span>
	                </div>
	            </form>
	            <p id="error" style="color:red;"></p>
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
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<p><strong style="font-size: 30px;"><?= count($persons) ?> results found</strong> for <strong style="font-size: 20px;"><?= $query_name ?>, <?= $query_address ?></strong></p>
	</div>
</div>
<div class="row" id="cell-header">
	<div class="col-md-8 col-md-offset-2">
		<div class="row">
			<div class="col-md-3 text-center"><strong>Name</strong></div>
			<div class="col-md-2 text-center"><strong>Age</strong></div>
			<div class="col-md-4"><strong>Address</strong></div>
			<div class="col-md-3"><strong>Family Members</strong></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<?php
			$count = 0;
			foreach($persons as $value)
			{
				?>
				<div class="contact-box">
			        <a class="persons-cell" href="<?= Url::to(['search/person', 'historyid'=>$history_id, 'id'=>$count]) ?>">
				        <div class="col-md-3">
				            <div class="text-center">
				            <?php
				            	foreach ($value['names'] as $value1) 
				            	{
				            		?>
				            		<div><h3 style="float:left;"><i class="fa fa-user"></i> <strong><?= $value1['first_name'] ?> <?= $value1['middle_name'] ?> <?= $value1['last_name'] ?></strong></h3></div>
				            		<?php
				            	}
				            ?>
				            </div>
				        </div>
				        <div class="col-md-2">
				        	<div class="text-center"><?= $value['age_range'] ?></div>
				        </div>
				        <div class="col-md-4">			
			                <?php
			                $flg = false;
			                foreach($value['locations'] as $value1)
			                {
			                	if(!$flg)
			                	{
			                		$flg = true;
				                	echo '<div class="text-center"><i class="fa fa-map-marker"></i> <strong>'.$value1['city'].', '.$value1['state_code'].'</strong></div>';
			                	}
			                	else
			                	{
			                		echo '<div class="text-center" style="margin-bottom:0px">'.$value1['city'].', '.$value1['state_code'].'</div>';
			                	}
			            	}
			                ?>
				        </div>
				        <div class="col-md-3">
				        	<?php
				                $flg = false;
				                foreach($value['legal_entities_at'] as $value1)
				                {
				                	if(!$flg)
				                	{
				                		$flg = true;
			                			echo '<div class="text-center" style="margin-bottom:0px"><i class="fa fa-users"></i> '.$value1['first_name'].' '.$value1['middle_name'].' '.$value1['last_name'].'</div>';
			                		}
			                		else
			                		{
			                			echo '<div class="text-center" style="margin-bottom:0px">'.$value1['first_name'].' '.$value1['middle_name'].' '.$value1['last_name'].'</div>';
			                		}
				            	}
			                ?>
				        </div>
				        <div class="clearfix"></div>
		            </a>
			    </div>
				<?php
				$count ++;
			}
		?>
	</div>
</div>
