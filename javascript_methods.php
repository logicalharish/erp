<script type="text/javascript">
	$(document).ready(function() {
		
		                
		 $('#first_name,#last_name').keyup( function() {
			var fname = $('input:text[name="first_name"]').val();
			var lname = $('input:text[name="last_name"]').val();
			$('input:text[name="username"]').val(fname+lname);
			$("#username").prop('readOnly', true);
		});
		
		$("#regiLink").click(function (){
			$(".loginForm").css("display","none");
			$(".registrationFrom").css("display","block");
			$(".alert-info").html("Please enter your details to Register.");
		});
		
		$("#loginLink").click(function (){
			$(".loginForm").css("display","block");
			$(".registrationFrom").css("display","none");
			$(".alert-info").html("Please login with your Username and Password.");
		});
		
		var rowCount = $('#mytable >tbody >tr').length;
		if(rowCount==0){
		 $('#mytable tbody').append('<tr id="firstRow"><td class="center"><input class="input-small focused required" id="contact_full_name" name="contact_full_name[]" type="text" value=""></td><td class="center"><input type="text" class="input-small datepicker required" id="dob" name="dob[]" value=""></td><td class="center"><input type="text" class="input-small datepicker required" id="dom" name="dom[]" value=""></td><td class="center"><input class="input-small focused required" id="contact_mobile" name="contact_mobile[]" type="text" value=""></td><td class="center"><input class="input-small focused required" id="contact_email" name="contact_email[]" type="email" value=""></td><td class="center"><input class="input-small focused required" id="designation" name="designation[]" type="text" value=""></td><td class="center"><select class="input-small focused required" id="contact_status" name="contact_status[]" ><option value="Active">Active</option><option value="Inactive">Inactive</option></select></td><td class="center"><input class="btn btn-success" id="removeRows" type="button" value="Remove"></input></td></tr>');
		}
		$("#addrows").click(function () {
			$("#firstRow").remove();
			  var c_name = $('#c_name').val();
			  var c_dob = $('#c_dob').val();
			  var c_dom = $('#c_dom').val();
			  var c_mobile = $('#c_mobile').val();
			  var c_email = $('#c_email').val();
			  var c_designation = $('#c_designation').val();
			  var c_status = $('#c_status').val();
			  $('#mytable tbody').append('<tr id="visibleDiv" name="visibleDiv"><td class="center"><input class="input-small focused required" id="contact_full_name" name="contact_full_name[]" type="text" value="'+c_name+'"></td><td class="center"><input type="text" class="input-small datepicker required" id="dob" name="dob[]" value="'+c_dob+'"></td><td class="center"><input type="text" class="input-small datepicker required" id="dom" name="dom[]" value="'+c_dom+'"></td><td class="center"><input class="input-small focused required" id="contact_mobile" name="contact_mobile[]" type="text" value="'+c_mobile+'"></td><td class="center"><input class="input-small focused required" id="contact_email" name="contact_email[]" type="email" value="'+c_email+'"></td><td class="center"><input class="input-small focused required" id="designation" name="designation[]" type="text" value="'+c_designation+'"></td><td class="center"><select class="input-small focused required" id="contact_status" name="contact_status[]" ><option value="Active">Active</option><option value="Inactive">Inactive</option></select></td><td class="center"><input class="btn btn-success" id="removeRows" type="button" value="Remove"></input></td></tr>');
			$('#c_name').val("");$('#c_dob').val("");$('#c_dom').val("");$('#c_mobile').val("");$('#c_email').val("");$('#c_designation').val("");$('#c_status').val("");
		});
		
		$("#removeRows").live('click', function(event) {
			if($('#mytable >tbody >tr').length > 1){
				$(this).parent().parent().remove();
			}else{alert("There must be at least one contact.");}
		});
		
		function getSizes(im,obj)
		{
			if(obj.width > 0){
				$("#x_axis").val(obj.x1);
				$("#x2_axis").val(obj.x2);
				$("#y_axis").val(obj.y1);
				$("#y2_axis").val(obj.y2);
				$("#thumb_width").val(obj.width);
				$("#thumb_height").val(obj.height);
			}else
				alert("Please select image portion to upload..!");
		}
		$("#photoimg").on('change', function () {

		var imgPath = $(this)[0].value;
		var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

		if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
			if (typeof (FileReader) != "undefined") {

				var image_holder = $("#previewDiv");
				image_holder.empty();

				var reader = new FileReader();
				reader.onload = function (e) {
					$("<img />", {
						"src": e.target.result,
							"id":"photo"
					}).appendTo(image_holder);
					$("#img_path").val(e.target.result);
					$('#photo').imgAreaSelect({
						//aspectRatio: '1:1',
						onSelectEnd: getSizes
					});

				}
				image_holder.show();
				reader.readAsDataURL($(this)[0].files[0]);
			} else {
				alert("This browser does not support FileReader.");
			}
		} else {
			alert("Pls select only images");
		}
	});
		// Validate form
		$("#form").validate({
		debug: false,
		errorClass: "label label-important",
		errorElement: "span",
		ignore: [],
		rules: {                                               first_name:{
										onlyletter: true,
										maxlength : 30
										},
									last_name:{
										onlyletter: true,
										maxlength : 30
										},
									username: {
                                                                                    required: true,
                                                                                    //minlength: 5,
                                                                                    remote: {
                                                                                        url: "controller/routes.php",
                                                                                        type: "get",
                                                                                        data: {
                                                                                            hid_action: function () {
                                                                                                return "check_username";
                                                                                            },
                                                                                            username: function() {
                                                                                                var username = $("#username").val();
                                                                                                return username;
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                },
									password:{
										minlength: 10,
										nospace: true
									},
									full_name: {
                                                                        letter_space: true,
                                                                        minlength: 5
                                                                        },
                                                                        short_name: {
                                                                                    letter_space: true,
                                                                                    minlength: 2
                                                                                    },
                                                                        est_date: {
                                                                                date:true
                                                                               },
                                                                        pincode: {
							                number: true,
							                minlength: 6,
											maxlength: 9
							               },
									latitude:{
										lat_long:true
									},
									longitute:{
										lat_long:true
									},
									email: {
                                                                            email: true
                                                                        },
									website: {
									       url: true
									      },
								 	mobile: {
										    number: true,
											nospace: true,
									        minlength: 10,
									        maxlength: 10
									       },
									phone: {
                                                                        number: true,
                                                                        nospace: true,
                                                                        minlength: 8,
                                                                        maxlength: 8
                                                                       },
									"contact_full_name[]": {
										required: true,
										letter_space: true
									},
									"dob[]": {
										required: true,
										date:true
									},
									"dom[]": {
										required: true,
										date:true
									},
									"contact_mobile[]": {
										required: true,
										number: true,
										nospace: true,
									    minlength: 10,
									    maxlength: 10
									},
									"contact_email[]": {
										required: true,
										email:true
									},
									"designation[]": {
										//tablewithnorow:true,
										required: true,
										letter_space:true
									},
									year:{
										digits: true,
										minlength: 4
									},
									ad_date:{
										date:true
									},
									mytable:{
										tablewithnorow:true
									},
									conformPwd:{
										pwdMatch:true
									},
									newPwd:{
										minlength: 10
									},
									photoimg:{
										required:false,
										imageExist:true
									}
									
		},
		messages: {
                        username:{
                            remote: "Username already Exist"
                        },
			"designation[]":{
				required: "Designation is Required",
				letter_space: "Designation requires valid entry"
			},
			"contact_email[]":{
				required: "Email is Required"
			},
			"contact_mobile[]":{
				required: "Mobile is Required",
				minlength: "Mobile must be of at least 10 characters"
			},
			"dom[]":{
				required: "Date Of Marriage is Required"
			},
			"dob[]":{
				required: "Date Of Birth is Required"
			},
			"contact_full_name[]":{
				required: "Full Name is Required",
				letter_space: "Full Name requires valid entry"
			}
		},
		highlight: function(element, errorClass) {
			$(element).removeClass(errorClass);
		},
		errorPlacement: function(error, element) {
			//if (element.attr("name") == "contact_full_name[]" || element.attr("name") == "dob[]" || element.attr("name") == "dom[]"|| element.attr("name") == "contact_mobile[]"|| element.attr("name") == "contact_email[]"|| element.attr("name") == "designation[]" || element.attr("name") == "contact_status[]")
			//	error.insertAfter("#mytable");
			if  (element.attr("name") == "paymentOptions[]" )
				error.insertAfter("#paymentResult");
			else if  (element.attr("name") == "visibleDiv" )
				error.insertAfter("#mytable");
			else if  (element.attr("name") == "photoimg" )
				error.insertAfter(".uploader");
			else
				error.insertAfter(element);
		}
	});
							$.validator.addMethod("customvalidation",
				                    function(value, element) {
				                            return /^[A-Za-z\d]+$/.test(value);
				                    },
				            "Sorry, no special characters allowed"
				            );
				            $.validator.addMethod("onlyletter",
				                    function(value, element) {
				                            return /^[A-Za-z]+$/.test(value);
				                    },
				            "Please input alphabet characters only"
				            );
				            $.validator.addMethod("nospace",
				                    function(value, element) {
				            	return value.indexOf(" ") < 0 && value != ""; 
				            }, 
				            "No space please"
				            );
				            $.validator.addMethod("letter_space",
				                    function(value, element) {
				                            return /^[a-zA-Z ]+$/.test(value);
				                    },
				            "Invalid entry"
				            );

				           /* $.validator.addMethod("ContainsAtLeastOneDigit", function (value) { 
				                return /^[a-z]+[0-9]/i.test(value); 
				       				}, 
				        	"Your User Name must be of letters followed by numbers"
				        	);*/
				            $.validator.addMethod("selectoption", function(value, element, arg){
				            	  return arg != value;
				            	 }, "Please select any one!");

							$.validator.addMethod("lat_long", function(value, element) {
				                            return /^-?((1?[0-7]?|[0-9]?)[0-9]|180)\.[0-9]{1,6}$/.test(value);
				                    },"Invalid Entry");
									
							$.validator.addMethod("pwdMatch", function(value, element) {
				                            return $('#newPwd').val() == value;
				                    },"New Password and Conform password do not Match.");
							
							$.validator.addMethod("imageExist", function(value, element) {
											return  $('#img_path').val() != "";
				                    },"Please upload Image.");
									
							$.validator.addMethod("tablewithnorow", function (value) {
									if ($("#visibleDiv").length === 0) {
									//	$('#mytable').addClass('error');
									//	error.insertAfter("#mytable");
										alert("there must be atleast one contact in table");
										return false;
									}else {
										//alert("there must be atleast one contact in table");
										//$('#visibleDiv').addClass('error');
										return true;
										}
									//return $('#mytable tbody tr').length > 0;
								}, "Must have at least one contact.");
                                                                
                                                                
                                                                
                                                                
                            
							
	});
	
</script>