<? 
	require_once "../authentication.php"; 
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$date = $_POST['date'];
	$doctorCode = $_POST['doctorCode'];

	$ro = new database();
	$ro4 = new database4();

	$ro4->get_doctor_outpatient($doctorCode,$date);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="../../bower_components/sweetalert/dist/sweetalert.min.js"></script>
  <script src="../js/open.js"></script>
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../bower_components/semantic/dist/semantic.min.css">
  <link rel="stylesheet" href="../../bower_components/sweetalert/dist/sweetalert.css">

  <script>
  	
  	$(document).ready(function(){

  		
  		<? foreach( $ro4->get_doctor_outpatient_registrationNo() as $registrationNo ) { ?>

  			var registrationNo;
 			var itemNo;

  			$("#patient<? echo $registrationNo ?>").click(function(){

  				<? $itemNo = $ro->selectNow('patientCharges','itemNo','registrationNo',$registrationNo) ?>

  				registrationNo = "<? echo $registrationNo ?>";
  				itemNo = "<? echo $itemNo ?>";
  				var firstName = "<? echo ucfirst(strtolower($ro->selectNow('patientRecord','firstName','patientNo',$ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo)))) ?>";
  				var lastName = "<? echo ucfirst(strtolower($ro->selectNow('patientRecord','lastName','patientNo',$ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo)))) ?>";
  				var age = "<? echo $ro->selectNow('patientRecord','Age','patientNo',$ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo)) ?>";
  				var hmo = "<? echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo) ?>";
  				var address = "<? echo htmlspecialchars(ucfirst(strtolower($ro->selectNow('patientRecord','Address','patientNo',$ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo))))) ?>";
  				var height = "<? echo $ro->selectNow('registrationDetails','height','registrationNo',$registrationNo) ?>";
  				var weight = "<? echo $ro->selectNow('registrationDetails','weight','registrationNo',$registrationNo) ?>";
  				var bloodPressure = "<? echo $ro->selectNow('registrationDetails','bloodPressure','registrationNo',$registrationNo) ?>";
  				var temperature = "<? echo $ro->selectNow('registrationDetails','temperature','registrationNo',$registrationNo) ?>";
  				var pulseRate = "<? echo $ro->selectNow('registrationDetails','pulseRate','registrationNo',$registrationNo) ?>";
  				var complaint = "<? echo $ro->selectNow('registrationDetails','initialDiagnosis','registrationNo',$registrationNo) ?>";
  				
				//highlight selected patient from the list				
				$(".itemPx").removeClass("itemPxSelected");
				$("#patientCell<? echo $registrationNo ?>").addClass("itemPxSelected");
				
				//automatic back to patient tab pag click ng px name
				$('#patientTab a[href="#px"]').tab('show');
  				
  				$("#pxName").html("<a href='#' id='pxLink<? echo $registrationNo ?>' style='color:black'>"+lastName+", "+firstName+"</a>");
  				$("#patientAge").html(age);
  				$("#patientHMO").html(hmo);
  				$("#patientAddress").html(address);
  				$("#patientHeight").html("<b>"+height+"</b>");
  				$("#patientWeight").html("<b>"+weight+"</b>");
  				$("#patientBP").html("<b>"+bloodPressure+"</b>");
  				$("#patientTemp").html("<b>"+temperature+"</b>");
  				$("#patientPR").html("<b>"+pulseRate+"</b>");
  				$("#patientComplaint").html(complaint);


  				/****SOAP*******/
  				$("#patientSubjective").val("");
  				$("#patientObjective").val("");
  				$("#patientAssessment").val("");
  				$("#patientPlan").val("");
  				$("#save").show();
  				$("#update").hide();

				var soapDetails = {
					registrationNo:"<? echo $registrationNo ?>",
					doctorCode:"<? echo $doctorCode ?>"
				};

			    $.getJSON("get-soap.php",soapDetails,function(result){
			        $.each(result, function(i, field){
			            $("#patientSubjective").val(field.subjective);
			            $("#patientObjective").val(field.objective);
			            $("#patientAssessment").val(field.assessment);
			            $("#patientPlan").val(field.plan);
			            $("#save").hide();
			            $("#update").show();
			        });			    		
			    });
			    /****SOAP*******/

  				$("#previousVisitHeading").text("Previous Visit of "+firstName);
  				var html = "";


  				/***PREVIOUS VISIT***/
  				//kkunin q ung latest 5 previous visit ng patient n meron doctor.
			    $.getJSON("previous-visit.php",{registrationNo:"<? echo $registrationNo ?>",date:"<? echo date("Y-m-d") ?>"},function(result){
			        $.each(result, function(i, field) {
			        	if( field.type == "IPD" ) {
			            	html += "<a href='#' id='visit"+field.registrationNo+"' class='list-group-item'><h4 class='list-group-item-heading'>"+field.dateRegistered+"</h4><p class='list-group-item-text'>"+field.timeRegistered+"</p><p class='list-group-item-text'><i class='hotel icon'></i> Admission</p><p class='list-group-item-text'>"+field.doctor+"</p></a>";
			        	}else {
			           		html += "<a href='#' id='visit"+field.registrationNo+"' class='list-group-item'><h4 class='list-group-item-heading'>"+field.dateRegistered+"</h4><p class='list-group-item-text'>"+field.timeRegistered+"</p><p class='list-group-item-text'>"+field.doctor+"</p></a>";
			        	}   			        	  	    	
			        });

			        $("#previousVisitItem").html(html);  

				    //gumawa p aq ng isang getJSON kc kpg dun sa getJSON n nsa itaas ang nkkuha q lng n registrationNo ay ung last.
				    $.getJSON("previous-visit.php",{registrationNo:"<? echo $registrationNo ?>",date:"<? echo date("Y-m-d") ?>"},function(result){
				        $.each(result, function(i, field) {
				        	$("#visit"+field.registrationNo).click(function() {
				        		open("POST","../currentPatient/patientInterface1.php",{registrationNo:field.registrationNo},"_blank");
				        	});  	    	
				        });  	        
				    });  	        
			    });
				/***PREVIOUS VISIT***/


			    //set s textbox ang curent PF ng doctor
			    var pfData = {
			    	registrationNo:"<? echo $registrationNo ?>",
			    	doctorCode:"<? echo $doctorCode ?>"
			    };

			    $.getJSON("get-pf.php",pfData,function(result){
			        $.each(result, function(i,field){		
			        	if(field.company > field.cashUnpaid) {
			        		$("#pfTxtbox").val(field.company);
			        	}else {
			        		$("#pfTxtbox").val(field.cashUnpaid);
			        	}

			        });
			    });			    

			    //pag click s name ng px sa may patient tab lalabas ung patient profile
				$("#pxLink<? echo $registrationNo ?>").click(function(){
					open("POST","../currentPatient/patientInterface1.php",{registrationNo:"<? echo $registrationNo ?>"},"_blank");
				});

  				return false;
  			});

  		<? } ?>

			$("#pfTxtbox").keypress(function (e) {
			 //if the letter is not digit then display error and don't type anything
			 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			    //display error message
			    $("#errmsg").html("Numbers Only").css("color","red").show().fadeOut("slow");
			    return false;
			}
			});


		    $("#pfBtn").click(function() {

		    	var pf = $("#pfTxtbox").val();

		    	var data = {
		    		registrationNo:registrationNo,
		    		pf:pf,
		    		doctorCode:"<? echo $doctorCode ?>"
		    	};

		    	$.post("update-pf.php",data,function(result) {
		    		if( result == "OK" ) {
		    			swal("Professional Fee","Professional Fee Added","success");
		    		}else{
		    			swal("Error!","Problem Unknonwn.Call the IT","error");
		    		}
		    	});
		       	
		    });

	
   			$("#save").click(function(){
   				
   				var patientSubjective = $("#patientSubjective").val();
   				var patientObjective = $("#patientObjective").val();
   				var patientAssessment = $("#patientAssessment").val();
   				var patientPlan = $("#patientPlan").val();
				
				var data = {
					"doctorCode":"<? echo $doctorCode ?>",
					"registrationNo":registrationNo,
					"subjective":patientSubjective,
					"objective":patientObjective,
					"assessment":patientAssessment,
					"plan":patientPlan
				};

   				$.post("add-soap.php",data,function(result){
   					if( result == "OK" ) {
   						swal("Saved!","S.O.AP added to the patient","success");
   					}else {
   						swal("Error!","Problem Unknonwn.Call the IT","error");
   					}
   				});

  			}); 	

   			$("#update").click(function() {
   				
   				var patientSubjective = $("#patientSubjective").val();
   				var patientObjective = $("#patientObjective").val();
   				var patientAssessment = $("#patientAssessment").val();
   				var patientPlan = $("#patientPlan").val();
				
				var data = {
					doctorCode:"<? echo $doctorCode ?>",
					"registrationNo":registrationNo,
					"subjective":patientSubjective,
					"objective":patientObjective,
					"assessment":patientAssessment,
					"plan":patientPlan
				};

   				$.post("update-soap.php",data,function(result){
   
  					var subj = $("#patientSubjective").val();
  					var obj = $("#patientObjective").val();
  					var assess = $("#patientAssessment").val();
  					var plans = $("#patientPlan").val();

  					$("#patientSubjective").val(subj);
  					$("#patientObjective").val(obj);
  					$("#patientAssessment").val(assess);
  					$("#patientPlan").val(plans);   
  					if( result == "OK" ) {
  						swal("Update","S.O.A.P is now updated","success");	
  					}else {
  						swal("Error!","Problem Unknonwn.Call the IT","error");
  					}
   				});

  			}); 

			$("#completeBtn").click(function(){
				
				var data = {
					date:"<? echo $date ?>",
					doctorCode:"<? echo $doctorCode ?>",
					registrationNo:registrationNo
				};

				$.post("patient-completed.php",data,function(result) {
		
					if( result == "OK" ) {
					open("POST","outpatient-ui.php",data,"_self");
					}else {
						swal("Error!","Problem Unknonwn.Call the IT","error");
					}
					
				});
			});

   			$("#refresh").click(function(){

   				var data = {
   					date:"<? echo $date ?>",
   					doctorCode:"<? echo $doctorCode ?>"
   				};
   				
   				open("POST","outpatient-ui.php",data,"_self");
   			});

  	});

  </script>

  <style>
  	#patient {
  		margin-top:2%;
  		height: 500px;
  	}

  	#soap {
  		margin-top:1%;
  	}

  	#records {
  		margin-top:1%;
  	}

  	#save {
  		margin-top:2%;
  	}

  	.list-group-item-heading{
  		margin-bottom: 0%;
  	}

  	.assessmentLabel {
  		margin-bottom: 1px;
  	}

  	#assessmentPanel {
  		border-top:0px;
  	}

  	.assessmentArea {
  		margin-bottom: 3%;
  	}

  	#pxName {
  		margin-top:2%;
  	}

  	.pxList {
  		color:black;
  	}

  	.itemPxSelected {
  		background-color:#F2F2F2;
  	}
 
	#patientsListing::-webkit-scrollbar-track
	{
	    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	    border-radius: 10px;
	    background-color: #F5F5F5;
	}

	#patientsListing::-webkit-scrollbar
	{
	    width: 12px;
	    background-color: #F5F5F5;
	}

	#patientsListing::-webkit-scrollbar-thumb
	{
	    border-radius: 10px;
	    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	    background-color: #555;
	}
	
  	#patientsListing {
  		height: 100%;
  		overflow-y: auto;
  	}

  	#completeBtn {
  		margin-top:3%;
  	}

  </style>
</head>
<body>
	<div class="container">

		<div id="patient" class="col-md-3">	
			<div id="patientsListing" class="ui celled list" >
				<? if( $ro4->get_doctor_outpatient_registrationNo() != "" ) { ?>
					<? foreach( $ro4->get_doctor_outpatient_registrationNo() as $registrationNo ) { ?>
						<? 
							$patientNo = $ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
							$lastName = $ro->selectNow("patientRecord","lastName","patientNo",$patientNo);
							$firstName = $ro->selectNow("patientRecord","firstName","patientNo",$patientNo);
							$gender = $ro->selectNow("patientRecord","Gender","patientNo",$patientNo);

							if( $gender == "male" ) {
								$avatar = "daniel.jpg";
							}else {
								$avatar = "helen.jpg";
							}
						 ?>
						 <div id="patientCell<? echo $registrationNo ?>" class="item itemPx">
						 	<img class="ui avatar image" src="../myImages/<? echo $avatar ?>">
						 	<div class="content">
						 		<div class="header">
						 			<h4 class="h4">
						 				<a href="#" class="pxList" id="patient<? echo $registrationNo ?>">
						 					<? echo ucfirst(strtolower($lastName)).", ".ucfirst(strtolower($firstName)) ?>
						 				</a>
						 			</h4>
						 		</div>
						 	</div>
						 </div>
					<? } ?>	
				<? } ?>
			</div>
			<button type="button" id="refresh" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>
		</div>

		<div id="soap" class="col-md-6">
			<ul id="patientTab" class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#px">Patient</a></li>
				<li><a id="soapTab" data-toggle="tab" href="#assessment">S.O.A.P</a></li>
				<li><a id="pfTab" data-toggle="tab" href="#pf">Prof. Fee</a></li>
			</ul>

			<div class="tab-content">
				<div id="px" class="tab-pane fade in active">

					<h3 id="pxName" class="h3"><!--sa jquery q knukuha ung data d2--> </h3>
			
					<div class="ui list">

						<div class="item">
							<i class="child icon"></i>
							<div id="patientAge" class="content">
								<!--sa jquery q knukuha ung data d2-->
							</div>
						</div>

						<div class="item">
							<i class="credit card alternative icon"></i>
							<div id="patientHMO" class="content">
								<!--sa jquery q knukuha ung data d2-->
							</div>
						</div>

						<div class="item">
							<i class="marker icon"></i>
							<div id="patientAddress" class="content">
								<!---sa jquery q knukuha ung data d2 -->
							</div>
						</div>

						<div class="item">
							<i class="treatment icon"></i>
							<div class="content">
								Vital Sign
								<div class="list">
									<div class="item">Height: <i id="patientHeight"> </i></div>
									<div class="item">Weight: <i id="patientWeight"> </i></div>
									<div class="item">Blood Pressure: <i id="patientBP"> </i></div>
									<div class="item">Temperature: <i id="patientTemp"> </i></div>
									<div class="item">Pulse rate: <i id="patientPR"> </i></div>
								</div>
							</div>
						</div>
					</div>
					<div class="ui form">
						<div class="field">
							<label>Complaint</label>
							<textarea id="patientComplaint"> </textarea>
						</div>
					</div>

					<div id="completeBtn" class="col-md-12 text-right">
						<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-ok"></i> Complete</button>
					</div>

				</div>

		
				<div id="assessment" class="tab-pane fade">
					<div id="assessmentPanel" class="panel panel-default">
						<div class="panel-body">
							<div class="col-md-12 txtbox">
								<h5 class="h5 assessmentLabel">Subjective</h5>
								<textarea rows="3" id="patientSubjective" class="form-control assessmentArea"> </textarea>
							</div>
							<div class="col-md-12 txtbox">
								<h5 class="h5 assessmentLabel">Objective</h5>
								<textarea rows="3" id="patientObjective" class="form-control assessmentArea"> </textarea>
							</div>
							<div class="col-md-12 txtbox">
								<h5 class="h5 assessmentLabel">Assessment</h5>
								<textarea rows="3" id="patientAssessment" class="form-control assessmentArea"> </textarea>
							</div>
							<div class="col-md-12 txtbox">
								<h5 class="h5 assessmentLabel">Plan</h5>
								<textarea rows="3" id="patientPlan" class="form-control assementArea"> </textarea>
							</div>
							<div class="col-md-12 text-center">
								<button id="save" type="button" class="btn btn-default">
									Save
								</button>
									<Br>
								<button id="update" type="button" class="btn btn-default">
									Update
								</button>
							</div>																				
						</div>
					</div>
				</div>

				<div id="pf" class="tab-pane fade">	
					<div class="col-md-12 text-center">
						<div class="row">				
							<div class="ui action input" style="padding-top:25%">
							  <input type="text" id="pfTxtbox" placeholder="Enter You're PF here">
							  <button id="pfBtn" class="ui button">Add</button>
							</div>
						</div>
						<span id="errmsg"></span>
					</div>
				</div>
			</div>

		</div>

		<div id="records" class="col-md-3">
			<h4 id="previousVisitHeading"> </h4>
			<div id="previousVisitContent" class="col-md-12">
				<div id="previousVisitItem" class="list-group">
					
				</div>
			</div>
		</div>

	</div>
</body>
</html>