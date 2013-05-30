var App = App || {};
var App_main = function() {};
var App_login =   function() {};
var App_admin =   function() {};
var App_problem =   function() {};
var AppProblemObj = '';
var AppMainObj = "";
(function($) {
    "use strict";

    App_main.prototype.makeAjaxRequest = function(url,postParams,dataType,successCallback,errorCallback) {
        $.ajax({
          url: url,
          type: "post",
          data: postParams,
          dataType:dataType,
          success: function(data){
            if(typeof successCallback != 'undefined'){
                successCallback(data);  
            }             
          },
          error:function(error){
                //alert("AJAX Error");
          }   
        }); 
    }

})(jQuery);

(function($) {
    "use strict";
    App_login.prototype.init = function() {
            $(".btn_sign").on('click',function(){
                AppMainObj.makeAjaxRequest(basePath+'/account/loginUser/',$(".form-signin").serialize(),'json',function(data){App_login.prototype.loginStatus(data);});
            });
    }

    App_login.prototype.loginStatus = function(data) {
        //console.log(data);
        if(data.status == 'success') {
            location.href = basePath+data.redirectUrl;
        }else{
            $(".form-signin-heading").html(data.message);
        }        
    }
})(jQuery);


(function($) {
    "use strict";
    App_admin.prototype.init = function() {
            $(".delete_user").off('click').on('click',function(){
                var agree=confirm("Are you sure you want to delete user?");
                if(!agree){
                    return false;
                }
                AppMainObj.makeAjaxRequest(basePath+'/admin/deleteUser/',{'user_id':$(this).attr('personId')},'json',function(data){location.reload();});
                return false;
            });

            $(".sort").off('click').on('click',function(){                
                AppMainObj.makeAjaxRequest(basePath+'/admin/listUsers/1/'+$(this).attr('sortBy')+'/'+$(this).attr('sortOrder'),{'isAjax':1},'json',function(data){$(".content").html(data.html);var AppAdminObj = new App_admin();AppAdminObj.init();});
                return false;
            });

            $(".update_btn").off('click').on('click',function(){                
                $("#avatar").remove();
                $(".form-edituser").submit();
            }); 

            $(".patientCheckBox").off('click').on('click',function(){ 
                $(".form-registration .patientPasswords").removeClass('hidden');
            });

            $(".roleCheckBox").off('click').on('click',function(){ 
                $(".form-registration .patientPasswords").addClass('hidden');
            });
            
    }
   
})(jQuery);


(function($) {
    "use strict";
    App_problem.prototype.init = function() {
        $("#matched_terms_input,#matched_medications_input").on('keyup',function(){
            var curObj =  this;
            if($(this).val().length <= 2) {
                return true;
            }
            AppMainObj.makeAjaxRequest(basePath+'/problem/searchProblem/',{term:$(this).val()},'json',
                function(data){
                    AppProblemObj.parseConceptTerms(data,$(curObj).data('divid'),$(curObj).data('destid'));
              });
            return false;
        })

        $(".matched_terms,.matched_medications").on('mouseleave',function(){
            $(this).hide();
        });   

        $(".addProgram_btn").on('click',function(){
            AppMainObj.makeAjaxRequest(basePath+'/problem/saveProblem/'+$(this).attr('personid'),{form_data:$(".form-addProblem").serialize()},'json',
                function(data){
                    location.href=basePath+"/patient/index/"+data.personId;
              });
            return false;
        });

        $(".addMedication_btn").on('click',function(){
			var problemid=$(this).attr('problemid');
            AppMainObj.makeAjaxRequest(basePath+'/medication/saveMedication/',{personId:$(this).attr('personid'),medicationId:$(this).attr('medicationid'),problemId:$(this).attr('problemid'),form_data:$(".form-addProblem").serialize()},'json',
                function(data){
                    location.href=basePath+"/problem/detail/"+problemid;
              });
            return false;
        });
        $(".delete_problem").on('click',function(){
            var agree=confirm("Are you sure you want to delete problem?");
            if(!agree){
                return false;
            }
            AppMainObj.makeAjaxRequest(basePath+'/problem/delete/'+$(this).data('problemid'),'','json',
                function(data){
                    location.reload();
              });
            return false;
        });

        $(".delete_goal").on('click',function(){
            var agree=confirm("Are you sure you want to delete goal?");
            if(!agree){
                return false;
            }
            AppMainObj.makeAjaxRequest(basePath+'/goal/delete/'+$(this).data('goalid'),'','json',
                function(data){
                    location.reload();
              });
            return false;
        });

        $(".approve_problem").on('click',function(){            
            AppMainObj.makeAjaxRequest(basePath+'/problem/approve/'+$(this).data('problemid'),'','json',
                function(data){
                    location.reload();
              });
            return false;
        });

        $(".approve_medication").on('click',function(){            
            AppMainObj.makeAjaxRequest(basePath+'/medication/approve/'+$(this).data('medicationid'),'','json',
                function(data){
                    location.reload();
              });
            return false;
        });

        $(".save_narrative").on('click',function(){            
            AppMainObj.makeAjaxRequest(basePath+'/patient/savePatientData/',{likeToKnow:$("#likeToKnow").val(),needToKnow:$("#needToKnow").val(),personId:$("#patient_id").val()},'json',
                function(data){
                    location.reload();
              });
            return false;
        });
		$('.saveeditpatient').on('click',function(){
            AppMainObj.makeAjaxRequest(basePath+'/patient/editData/',{likeToKnow:$("#likeToKnow").val(),needToKnow:$("#needToKnow").val(),personId:$("#patient_id").val(),'patient_image_file_path':$('#patient_image_file_path').val()},'json',
                function(data){
                    location.reload();
              });
            return false;
        });

        $(".save_image").on('click',function(){            
            AppMainObj.makeAjaxRequest(basePath+'/patient/savePatientData/',{patient_image_file_path:$("#patient_image_file_path").val(),personId:$("#patient_id").val()},'json',
                function(data){
                    location.reload();
              });
            return false;
        });

        $(".add_goal").on('click',function(){            
            AppMainObj.makeAjaxRequest(basePath+'/goal/add/',$("#goal_form").serialize(),'json',
                function(data){
                    location.href=basePath+"/problem/detail/"+$(".problemId").val();
              });
            return false;
        });

        $(".patient_pic").on('change',function(){
                $.ajaxFileUpload({
                url: basePath+'/account/saveUploadedFile?type=cover',
                secureuri:false,
                fileElementId:'avatar',
                dataType: 'html',
                success: function (data, status){
                    $("#patient_image_file_path").val(basePath+"/uploads/cover/"+data);
                    $(".upload_status").html('uploaded successfully');
                },
                error: function (data, status, e){
                }
              });
            });

        $(".delete_medication").on('click',function(){
            var agree=confirm("Are you sure you want to delete medication?");
            if(!agree){
                return false;
            }
            AppMainObj.makeAjaxRequest(basePath+'/medication/delete/'+$(this).data('medicationid'),'','json',
                function(data){
                    location.reload();
              });
            return false;
        });
    }

    App_problem.prototype.parseConceptTerms = function(data,divId,destId) {

        $(divId).html("").show();
        $.each(data, function(index, value) {
            var elementObj;
            elementObj = $(divId).append('<li id="'+value.conceptId+'">'+value.term+'</li>');
        });
        $(divId+" li").on('click',function(){
            $(destId).val($(this).attr('id')).parent().find("span").html($(this).html());
        });
    }
   
})(jQuery);

App.registerUser = function() {
    	$(function(){
    		$(".avatar").on('change',function(){
    			$.ajaxFileUpload({
                url: basePath+'/account/saveUploadedFile?type=avatar',
                secureuri:false,
                fileElementId:'avatar',
                dataType: 'html',
                success: function (data, status){
                	$("#avatar_filename").val(basePath+"/uploads/avatar/"+data);
                    $(".upload_status").html('uploaded successfully');
                },
                error: function (data, status, e){
                }
          	  });
    		});

            $(".fileinput-button").on('click',function(){
                $("#avatar").trigger('click'); 
            });

            $(".register_btn").on('click',function(){                
                $("#avatar").remove();
                $(".form-registration").submit();
            });   			
    	});
}

$(document).ready(function(){
    new App.registerUser();
    var AppLoginObj = new App_login();
    var AppAdminObj = new App_admin();
    AppProblemObj = new App_problem();
    AppMainObj = new App_main();
    AppLoginObj.init();
    AppAdminObj.init();
    AppProblemObj.init();
});


    
