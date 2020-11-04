<?php  

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\components\datepicker\DatePicker;
use common\components\DinamycForm\DynamicFormWidget;
// use common\components\chosen\Chosen;
use backend\assets\AppAssetLayoutAll;
AppAssetLayoutAll::register($this);
$this->title = 'Notificaciones';	

?>

<style>

	.users {
		padding: 1rem;
	}

	.users-header {
	}

	.users-container {

	}

	.users-footer {

	}

	.user {
	    background-color: #eee;
		padding: 10px;
		box-shadow: inset 0 1px 0 #fff;
		margin-bottom: 5px;
	}

	.user .useremail {
		text-shadow: 0px 0px 0.1px;
		font-weight: bold;
	}

	.user .userdata {
		
	}

	.user-id {
		
	}

	.user-name {
		
	}

	.user > .user-id {
		
	}

	.user > .user-name {
	}
	
	[class*="col"] {
		padding: 0 !important;
	}

	.icon-btn {
		margin: 0;
	}

	.promotion-item {
		display: -webkit-flex;
		display: flex;
		align-items: center;
		width: 100%;
		min-height: 100px;
	}

	#promotions header {
		display: flex;
	    justify-content: space-between;
	    align-items: center;
	}

	#promotions header:after, #promotions header:before  {
		content: unset !important;
	}

</style>

<section class="container-fluid flex flex-wrap">

	<!-- <section class="col-sm-12 col-md-4 users">
		
		<header class="users-header">

			
		</header>

		<section class="users-wrapper">
			
			<div id="users-container" class="users-container">
				
			</div>

		</section>

		<footer class="users-footer">
			
		</footer>

	</section> -->

	<section id="promotions" class="col-sm-12 portlet box blue-hoki">
		
		<header class="portlet-title">
			<div class="caption">
				Promociones
			</div>
			<div class="actions">
				<button class="icon-btn add-promotion">
					<i class="fa fa-plus"></i>
					<div>NUEVO</div>
				</button>
			</div>
		</header>

		<section class="portlet-body">
			
			<ul class="list-group">
				<li class="promotion-item list-group-item">
					<div>
						<span>##</span>
						<input type="hidden">
					</div>
					<div>
						<label>Promociones</label>
						<select></select>
					</div>
					<div>
						<label>Usuarios</label>
						<select class="select-users" multiple></select>
					</div>
					<div>
						<button class=""></button>
						<button class=""></button>
					</div>
				</li>
				<li class="promotion-item list-group-item">
					<div>
						<span>##</span>
						<input type="hidden">
					</div>
					<div>
						<label>Promociones</label>
						<select></select>
					</div>
					<div>
						<label>Usuarios</label>
						<select class="select-users" multiple></select>
					</div>
					<div>
						<button class=""></button>
						<button class=""></button>
					</div>
				</li>
			</ul>
			
		</section>

		

	</section>

</section>

<script>

	<?php $this->registerJS('

	var Gusers_ref;
	var Gusers;
	var GList;
	var Gusermodel;

	var Gpromotions;

	$(document).ready(function() {

		Gusers = new Backbone.Collection;
		Gpromotions = new Backbone.Collection;

		Gusers.on("add", function(user) {

			email = user.get("email");			
			user_key = user.get("user_key");
			$(".select-users").append(user.get("option"));
			console.log(user);
			console.log(user.get("option"));

		});

		Gpromotions.on("add", function ( promotion ) {
			
		});

		InitializeFirebase();
		GetPromotions();

	});

	function InitializeFirebase() {

		var config = {
			apiKey: "AIzaSyDaN8y_A6GuF4HV6KefpocAvNww-JSrGfo",
			authDomain: "test001-5f7b5.firebaseapp.com",
			databaseURL: "https://test001-5f7b5.firebaseio.com/",
			storageBucket: "gs://test001-5f7b5.appspot.com",
			messagingSenderId: "932360788783",
		};
		firebase.initializeApp(config);
		Gusers_ref = firebase.database().ref("users");
		getUsersAndAddToList();

	}

	function getUsersAndAddToList () {

		Gusers_ref.orderByChild("email").on("child_added",function(snapshot){

			addUserAndPrint ( snapshot.val(), snapshot.key );

		});

	}

	function addUserAndPrint ( user_data , user_key ) {

		user = {
			username : user_data.email ,
			user_key : user_key ,
			option: "<option value=\'"+user_key+"\'>"+user_data.email+"</option>",
		};

		Gusers.add(user);

	}

	'); ?>

	

	<?php // $this->registerJS('

		// var Gusers_ref;
		// var Gusers = [];
		// var GList;

		// $(document).ready(function() {
			
		// 	options = {
		// 		valueNames: ["useremail","userdata"],
		// 		item: "<section class=\'user\'><div class=\'useremail\'></div><div class=\'userdata\'></div></section>",
		// 		listClass: "users-container",
		// 		searchClass: "users-search",
		// 		sortClass: "users-sort",
		// 		indexAsync: true,
		// 		page: 5,
		// 		pagination: true,
		// 	}
		// 	GList = new List("users",options,[]);
		// 	InitializeFirebase();

		// });

		// function InitializeFirebase() {

		// 	var config = {
		// 		apiKey: "AIzaSyDaN8y_A6GuF4HV6KefpocAvNww-JSrGfo",
		// 		authDomain: "test001-5f7b5.firebaseapp.com",
		// 		databaseURL: "https://test001-5f7b5.firebaseio.com/",
		// 		storageBucket: "gs://test001-5f7b5.appspot.com",
		// 		messagingSenderId: "932360788783",
		// 	};
		// 	firebase.initializeApp(config);
		// 	Gusers_ref = firebase.database().ref("users");
		// 	getUsersAndAddToList();

		// }

		// function getUsersAndAddToList () {

		// 	Gusers_ref.orderByChild("email").on("child_added",function(snapshot){

		// 		addUserAndPrint ( snapshot.val(), snapshot.key );

		// 	});

		// }

		// function addUserAndPrint (user , userkey) {

		// 	Gusers.push(user);

		// 	email = user.email;
		// 	user_data = userkey + " " + user.first_name;

		// 	console.log(GList);
		// 	console.log(email);
		// 	console.log(user_data);

		// 	// GList.add({ useremail: email, userdata: user_data});

		// 	DOM = "<section class=\'user\'>";
		// 		DOM += "<div class=\'useremail\'>"+email+"</div>";
		// 		DOM += "<div class=\'userdata\'>"+user_data+"</div>";
		// 	DOM += "</section>";

		// 	$(".users-container").append(DOM);

		// }

	// '); ?>

	

	


</script>

<?php 
if (Yii::$app->session->hasFlash('success')):
	$this->registerJS('
		$(document).ready(function(){
			_Message("success","Success!","'.Yii::$app->session->getFlash('success').'");
		});

		');
endif;

if (Yii::$app->session->hasFlash('error')):

	$this->registerJS('

		$(document).ready(function(){
			_Message("error","Error!","'.Yii::$app->session->getFlash('error').'");
		});

	');
endif;
 ?>