function refineuser(user_login_id)

{

	var url1=getRootUrl(document.location);

	var querystring="user_login_id="+user_login_id;

	$.ajax({

		url: url1+"/catalog/usermanage/refineuser",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		}

	})

}

function changeMainFeatured(all_id,typedata,status)

{

	

	var querystring="all_id="+all_id+"&typedata="+typedata+"&status="+status;

	var url1=getRootUrl(document.location);

	$.ajax({

		url: url1+"/comman/ajax_function/changeFeatured",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		window.location.reload();

		}

	})

}	

function refinecatalogmoduletype(module_type_id)

{

	var url1=getRootUrl(document.location);

	var querystring="module_type_id="+module_type_id;

	$.ajax({

		url: url1+"/catalog/moduletypemanage/refinemoduletype",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		}

	})

}



function refinecataloglayout(catalog_layout_id)

{

	var url1=getRootUrl(document.location);

	var querystring="catalog_layout_id="+catalog_layout_id;

	$.ajax({

		url: url1+"/catalog/cataloglayout/refinecataloglayout",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		}

	})

}







function edituser(admin_login_id)

{

	var querystring="type=edit&admin_login_id="+admin_login_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/usermanage/edituser",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		$("#user_group").val(data.user_group).attr("selected", "selected");

		$("#admin_login_id").val(data.admin_login_id);

		$("#user_mail_id").val(data.email_id);

		$("#user_name").val(data.user_name);

		$("#designation").val(data.designation);

		$("#contact_no").val(data.contact_no);

		$("#employer_id").val(data.employer_Id);

		$("#title").html("Edit User");

		$("#submit").val("Update");

		$("#new").show();

	}

	})

}





function editmoduletype(module_type_id)

{

	var querystring="type=edit&module_type_id="+module_type_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/moduletypemanage/editmoduletype",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#module_type_id").val(data.module_type_id);

		$("#module_title").val(data.module_title);

		$("#module_name").val(data.module_name);

		$("#title").html("Edit User");

		$("#submit").val("Update");

		$("#new").show();

	}

	})

}

function editLayout(catalog_layout_id)

{

	var querystring="type=edit&catalog_layout_id="+catalog_layout_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/cataloglayout/editcataloglayout",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#catalog_layout_id").val(data.catalog_layout_id);

		$("#catalog_layout_title").val(data.catalog_layout_title);

		$("#catalog_layout_type").val(data.catalog_layout_type);

		$("#title").html("Edit User");

		$("#submit").val("Update");

		$("#new").show();

	}

	})

}



function editadminpage(page_id)

{

	var querystring="type=edit&page_id="+page_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/comman/ajax_function/editPage",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		$("#page_name").val(data.page_name);

		$("#page_link").val(data.page_link);

		$("#page_id").val(data.page_id);

		$("#parent_id").val(data.parent_id).attr("selected", "selected");

		$("#title").html("Edit Page");

		$("#submit").val("Update");

		$("#new").show();

	}

	})



}



function editfrontmenu(menu_id)

{

	var querystring="type=edit&menu_id="+menu_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/comman/ajax_function/editMenu",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {



		$("#menu_title").val(data.menu_title);

		$("#menu_link").val(data.menu_url);

		$("#menu_id").val(data.menu_id);

		$("#parent_id").val(data.parent_id).attr("selected", "selected");

		$("#catalog_layout").val(data.catalog_layout).attr("selected", "selected");

		$("#module_type").val(data.module_type).attr("selected", "selected");

		$("#title").html("Edit Page");

		$("#submit").val("Update");

		$("#new").show();

	}

	})



}

	

function editcountry(country_id)

{

    var querystring="country_id="+country_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/comman/ajax_function/editcountry",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		$("#country_name").val(data.country_name);

		$("#country_id").val(data.country_id);

		$("#title").html("Edit Country");

		$("#submit").val("Update");

		$("#new").show();

	}

	})

				 

}	



function editusergroup(user_group_id)

{



	document.getElementById('frmusergroup').reset();

    var querystring="user_group_id="+user_group_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/comman/ajax_function/editusergroup",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		 var access_permission =data.access_permission;

		 var modify_permission =data.modify_permission;

		 var modify_arr = modify_permission.split(",");

		 var access_arr = access_permission.split(",");

		 var i=0;		 

		 while (i < modify_arr.length) {

			 

			 $('#modify_permission'+modify_arr[i]).attr('checked','checked');

			 i++; 

			}

		i=0;	

		while (i < access_arr.length) {

			    $('#access_permission'+access_arr[i]).attr('checked','checked');

				i++;

		        } 		

		$("#user_group_name").val(data.user_group_name);

		$("#user_group_id").val(data.user_group_id);

		

		$("#title").html("Edit User Group");

		$("#submit").val("Update");

		$("#new").show();

	}

	})

				 

}

				 

function editstate(state_id)

{

	 var querystring="state_id="+state_id;

		var url1=getRootUrl(document.location);

		$.ajax({

		url: url1+"/comman/ajax_function/editstate",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#state_name").val(data.state_name);

		 $("#state_id").val(data.state_id);

		 $("#country_id").val(data.country_id).attr("selected", "selected");

		 $("#title").html("Edit State");

		 $("#submit").val("Update");

		 $("#new").show();

	

	}

	})

				 

}			 		 

				 

			 

function editcity(city_id)

{

	var querystring="type=editcity&city_id="+city_id;

	var url1=getRootUrl(document.location);



	$.ajax({

		url: url1+"/comman/ajax_function/editcity",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#city_name").val(data.city_name);

		 $("#city_id").val(data.city_id);

		 $("#country_id").val(data.country_id).attr("selected", "selected");

		 $("#state_id").html(data.statedrop);

		 $("#state_id").val(data.state_id).attr("selected", "selected");

		 $("#meta_key").val(data.meta_key);

		 $("#meta_des").val(data.meta_des);

		 $("#contant_title").val(data.contant_title);

		 var editor = CKEDITOR.instances.content1;

		  editor.setData( data.content );

		 //$("#content").val(data.content);

		 $("#title").html("Edit city");

		 $("#submit").val("Update");

		 $("#new").show();

		}

	})

}			 		  

				 

 function getdropdownstate(country_id,next_id,call_on,list)

	{

	 var querystring="country_id="+country_id;

		var url1=getRootUrl(document.location);

		$.ajax({

		url: url1+"/comman/ajax_function/getstatedrop",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#"+next_id).html(data.option);

		 if(list=='yes')

		 {

			refineWithCountry(country_id,call_on);

		 }

	}

  })

		 

}	

				 

 function getdropdowncity(state_id,next_id,call_on,list)

	{

	    var querystring="state_id="+state_id

		var country_id=$("#seatchcountry").val();

		var url1=getRootUrl(document.location);

		$.ajax({

		url: url1+"/comman/ajax_function/getcitydrop",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#"+next_id).html(data.option);

		//refineWithState(country_id,state_id,call_on);

		if(list=='yes')

		 {

			refineWithState(country_id,state_id,call_on);

		 }

		

	}

  })

		 

}

//StartRefine Country  

function refinecountry(country_id)

{

	var url1=getRootUrl(document.location);

	var querystring="country_id="+country_id;

	$.ajax({

		url: url1+"/comman/ajax_function/refinecountry",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		}

	})

}		 		  



//StartRefine Country  And Country Wise State City Location



function refineWithCountry(country_id,onpage)

{

	var url1=getRootUrl(document.location);

	var querystring="country_id="+country_id+"&onpage="+onpage;

	$.ajax({

		url: url1+"/comman/ajax_function/refineWithCountry",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#allbody").html(data.refine_data);

		 $(".pagination").html(data.pagination);

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		}

})

}	

// End Refine Country  And Country Wise State City Location







//StartRefine State  And State Wise City Location



function refineWithState(country_id,state_id,onpage)

{

	var url1=getRootUrl(document.location);

	var querystring="country_id="+country_id+"&state_id="+state_id+"&onpage="+onpage;

	$.ajax({

		url: url1+"/comman/ajax_function/refineWithState",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#allbody").html(data.refine_data);

		 $(".pagination").html(data.pagination);

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		}

})

}	

   // End Refine State  And State Wise City Location



		 		  



   //Start Refine  Function For State 



function refinestate(state_id)

{

	var country_id=$("#seatchcountry").val();

	var querystring="&state_id="+state_id+"&country_id="+country_id;

	var url1=getRootUrl(document.location);

	$.ajax({

		url: url1+"/comman/ajax_function/refinestate",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#allbody").html(data.refine_sta);

		 $(".pagination").html(data.pagination)

		  $(".ask").jConfirmAction();

		}

	})

}	

					

//Start Refine  Function For City



function refinecity(city_id)

{

	var country_id=$("#seatchcountry").val();

	var state_id=$("#seatchstate").val();

	var querystring="&city_id="+city_id+"&country_id="+country_id+"&state_id="+state_id;

	var url1=getRootUrl(document.location);

	$.ajax({

		url: url1+"/comman/ajax_function/refinecity",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#allbody").html(data.refine_sta);

		 $(".pagination").html(data.pagination)

		  $(".ask").jConfirmAction();

		}

	})

}	





function refinelocality(city_id)

{

	var country_id=$("#seatchcountry").val();

	var state_id=$("#seatchstate").val();

	var querystring="&city_id="+city_id+"&country_id="+country_id+"&state_id="+state_id;

	var url1=getRootUrl(document.location);

	$.ajax({

		url: url1+"/comman/ajax_function/refinelocality",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#allbody").html(data.refine_sta);

		 $(".pagination").html(data.pagination)

		  $(".ask").jConfirmAction();

		}

	})

}	













/*

function refinecity(city_id)

{

	

	var querystring="type=refinecity&city_id="+city_id;

	var url1=getRootUrl(document.location);

	$.ajax({

		url: url1+"/mahalaxmimedicos/include/ajax_function.php",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		 $("#city_body").html(data.refine_city);

		

		}

	})

}	*/		 		  

//Start Refine  Function For Change Status

function changeStatus(all_id,typedata,status)

{

	

	var querystring="all_id="+all_id+"&typedata="+typedata+"&status="+status;

	var url1=getRootUrl(document.location);

	$.ajax({

		url: url1+"/comman/ajax_function/changeStatus",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		window.location.reload();

		}

	})

}			 		  

function getRootUrl(url) {

  return url.toString().replace(/^(.*\/\/[^\/?#]*).*$/,"$1")+"/synergy/admin";

} 

//Start Refine  Function For  Send Record In trash 




function recordAddToTrace(tr,primary_key,dbname,delstatus,currentpage)

{

	

  var x = confirm("Are you sure you want to delete?");

  if (x==true)

	{

    

	var rowCount = $('#allbody tr').length;

	var url=$("#uri")

    var querystring="primary_key="+primary_key+"&dbname="+dbname+"&delstatus="+delstatus+"&thispagerecord="+rowCount +"&currentpage="+currentpage;

	var url1=getRootUrl(document.location);

		

	$.ajax({

		url: url1+"/comman/ajax_function/addToTrash",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		

		if(data.msg==1)

			{

			window.location.reload();

			}

		/* $(tr).parents("tr").fadeOut(300, function() {

						$(this).remove();

					});	*/			

					

		  }

	   })

}

  else{

    return false;

}

	}









function insertAll(form,insertCuntroller)

{

		 //return false;

	var rowCount = $('#allbody tr').length;

	var url=$("#uri")

    var querystring=$(form).serialize();

	

	

	return false;

	var url1=getRootUrl(document.location);

	$.ajax({

		url: url1+"/comman/ajaxinsertfunction/"+insertCuntroller,

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		

		if(data.msg==1)

		{		

		   var url=$("#uri").val();			

				searchload(url)	;

		}

		/* $(tr).parents("tr").fadeOut(300, function() {

						$(this).remove();

					});	*/			

					

		  }

	   })

	}



function updateInsertAll(form,method,onpage,controller,check)

{



		 //return false;

	var rowCount = $('#allbody tr').length;

	var url=$("#uri")

	

	if(check==1)

	{

	var content1= CKEDITOR.instances.content1.getData();

	$('#content1').val(content1);

	}



	var querystring=$(form).serialize();



	var url1=getRootUrl(document.location);

	$.ajax({

		url: url1+"/catalog/"+controller+"/"+method,

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		

		if(data.msg==1)

		{	

		

			

		   var url=$("#uri").val()+'/'+onpage;			

				searchload(url)	;

		}

		/* $(tr).parents("tr").fadeOut(300, function() {

						$(this).remove();

					});	*/			

					

		  }

	   })

	}





function validateAll(form,method,controller,check)

{



	revalue= ValidateForm(form);

	valsubmit=$('#submit').val();

	onpage=$('#onpage').val();

	if(revalue==true)

	{

		if (valsubmit.toLowerCase()=='submit')

		{

			valsubmit='insert';

		}

		method= valsubmit.toLowerCase()+method;

		

		updateInsertAll(form,method,onpage,controller,check);

		return false;

	   

	}

	else

	{

		 alert(revalue);

		if(revalue==false)

	{

		

		return false;

	   

	}	

	}

}







function searchload(url){



$("#SearchForm").attr("action",url).submit();}



function setpriority(value,set_id,page){

	

	var url=$("#uri")

	value=$("#"+value).val();

	var querystring="set_id="+set_id+"&value="+value+"&page="+page;

	var url1=getRootUrl(document.location);

	$.ajax({

		url: url1+"/comman/ajax_function/setpriority",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		

		if(data.update=='yes')

		{		

		window.location.reload();

		}

				

					

		  }

	   })

	

}





/* 17 Septembeer Work */







/*  Refined Certificates Types Start*/

function refinecertificatestypes(certificates_types_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="certificates_types_id="+certificates_types_id;

	$.ajax({

		url: url1+"/catalog/certificatestypes/refinecertificatestypes",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



/*  Refined Certificates Types End*/







/*  Edit/Update Certificates Types Start*/



function editcertificateatypes(certificates_type_id)

{

	

	var querystring="type=edit&certificates_types_id="+certificates_type_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/certificatestypes/editCertificates_types",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#certificates_types_id").val(data.certificates_types_id);

		$("#certificates_types_name").val(data.certificates_types_name);

		$("#certificates_types_description").val(data.certificates_types_description);

		$("#preview").html(data.image_html);

		$("#title").html("Edit Certificate Type");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}







/**********  18 September Work ******/







/**********  18 September Work ******/





///////////// Edit/Update Gallery Start //////



function editmanagegallery(manage_gallery_id)

{

	

	

	var querystring="type=edit&manage_gallery_id="+manage_gallery_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/managegallery/editManage_gallery",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#manage_gallery_id").val(data.manage_gallery_id);

		$("#manage_gallery_title").html(data.manage_gallery_title);

		$("#manage_gallery_image").val(data.manage_gallery_image);

		$("#preview").html(data.image_html);

		$("#title").html("Edit Gallery");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



////////Edit/Update Gallery End ////////////









/*  Refined Certificates Types Start*/

function refinemanagegallery(manage_gallery_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="manage_gallery_id="+manage_gallery_id;

	$.ajax({

		url: url1+"/catalog/managegallery/refineManageGallery",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



/*  Refined Certificates Types End*/











///////////// Edit/Update Planting Partners Start //////



function editplantingpartners(planting_partner_id)

{

	

	

	var querystring="type=edit&planting_partner_id="+planting_partner_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/manageplantingpartners/editPlanting_partners",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#planting_partners_id").val(data.planting_partners_id);

		$("#planting_partners_title").val(data.planting_partners_title);

		$("#preview").html(data.image_html);

		$("#project_management_country").val(data.country_id);

		$("#seatchstate").html(data.statedrop);

		$("#seatchstate").val(data.state_id);

		$("#seatchcity").html(data.citydrop);

		$("#seatchcity").val(data.city_id);

		 var editor = CKEDITOR.instances.content1;

		  editor.setData( data.planting_partners_description );

		//$("#planting_partners_description").val(data.planting_partners_description);

		$("#title").html("Edit Planting Partner");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



////////Edit/Update Planting Partners End ////////////













/*  Refined Planting Partners Start*/

function refineplantingpartners(planting_partners_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="planting_partners_id="+planting_partners_id;

	$.ajax({

		url: url1+"/catalog/manageplantingpartners/refinePlantingPartners",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



/*  Refined Planting Partners End*/













//////////// Edit/Update Video Gallery Start //////



function editvideogallery(video_gallery_id)

{

	

	var querystring="type=edit&video_gallery_id="+video_gallery_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/managevideogallery/editVideo_gallery",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#video_gallery_id").val(data.video_gallery_id);

		$("#video_gallery_title").val(data.video_gallery_title);

		$("#video_gallery_code").val(data.video_gallery_code);

		$("#title").html("Edit Video Gallery");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



////////Edit/Update Video  Gallery End ////////////









/*  Refined Video  Gallery Start*/

function refinevideogallery(video_gallery_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="video_gallery_id="+video_gallery_id;

	$.ajax({

		url: url1+"/catalog/managevideogallery/refineVideoGallery",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



/*  Refined Video  Gallery End*/













//////////// Edit/Update Upcoming Event Start //////



function editupcomingevent(upcoming_event_id)

{

	

	

	var querystring="type=edit&upcoming_event_id="+upcoming_event_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/upcomingevents/editUpcoming_event",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#upcoming_event_id").val(data.upcoming_event_id);

		$("#upcoming_event_title").val(data.upcoming_event_title);

	//	$("#upcoming_event_description").val(data.upcoming_event_description);

		 var editor = CKEDITOR.instances.content1;

		  editor.setData( data.upcoming_event_description );

		$("#meta_keyword").val(data.meta_keyword);

		$("#meta_description").val(data.meta_description);

		$("#meta_next").val(data.meta_next);

		$("#meta_previous").val(data.meta_previous);

		$("#meta_canonical").val(data.meta_canonical);

		$("#title").html("Edit Upcoming Event");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



////////Edit/Update Upcoming Event End ////////////









/*  Refined Upcoming Event Start*/

function refineupcomingevent(upcoming_event_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="upcoming_event_id="+upcoming_event_id;

	$.ajax({

		url: url1+"/catalog/upcomingevents/refineUpcomingEvent",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



/*  Refined Upcoming Event End*/









//////////// Edit/Update Project Management Start //////



function editprojectmanagement(project_management_id)

{

	

	

	var querystring="type=edit&project_management_id="+project_management_id;

	

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/projectmanagements/editProject_management",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#project_management_id").val(data.project_management_id);

		$("#project_management_title").val(data.project_management_title);

		$("#project_management_country").val(data.country_id);

		$("#seatchstate").html(data.statedrop);

		$("#seatchstate").val(data.state_id);

		$("#seatchcity").html(data.citydrop);

		$("#preview").html(data.image_html);

		$("#seatchcity").val(data.city_id);

		$("#meta_keyword").val(data.meta_keyword);

		$("#meta_description").val(data.meta_description);

		$("#meta_next").val(data.meta_next);

		$("#meta_previous").val(data.meta_previous);

		$("#meta_canonical").val(data.meta_canonical);

		$("#project_target").val(data.project_target);

		 var editor = CKEDITOR.instances.content1;

		  editor.setData( data.content );

		

		$("#title").html("Edit Project");

		$("#submit").val("Update");

		$("#new").show();

		

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



////////Edit/Update Project Management End ////////////









/*  Refined Project Management Start*/

function refineprojectmanagement(project_management_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="project_management_id="+project_management_id;

	$.ajax({

		url: url1+"/catalog/projectmanagements/refineProjectmanagement",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



/*  Refined Project Management End*/









/*  19Septeember Work */



//////////// Edit/Update Project Slider Management Start //////



function editprojectsliddermanagement(project_slider_management_id)

{

	

	

	var querystring="type=edit&project_slider_management_id="+project_slider_management_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/projectslidermanagement/editProjectslider",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#project_slider_management_id").val(data.project_slider_management_id);

		$("#project_management_id").html(data.projectdrop);

		$("#project_management_id").val(data.project_management_id);

		$("#project_slider_title").val(data.project_slider_title);

		$("#title").html("Edit Project Slider");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



////////Edit/Update Project Slider Management End ////////////









/*  Refined Project Management Start*/

function refineprojectslidermanagement(project_slider_management_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="project_slider_management_id="+project_slider_management_id;

	$.ajax({

		url: url1+"/catalog/projectslidermanagement/refineProjectslider",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



/*  Refined Project Slider Management End*/





/*  Refined Project Slider Management End*/





// The instanceReady event is fired, when an instance of CKEditor has finished

// its initialization.

CKEDITOR.on( 'instanceReady', function( ev ) {

	// Show the editor name and description in the browser status bar.

	document.getElementById( 'eMessage' ).innerHTML = 'Instance <code>' + ev.editor.name + '<\/code> loaded.';



	// Show this sample buttons.

	document.getElementById( 'eButtons' ).style.display = 'block';

});



function InsertHTML() {

	// Get the editor instance that we want to interact with.

	var editor = CKEDITOR.instances.content1;

	var value = document.getElementById( 'htmlArea' ).value;



	// Check the active editing mode.

	if ( editor.mode == 'wysiwyg' )

	{

		// Insert HTML code.

		// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertHtml

		editor.insertHtml( value );

	}

	else

		alert( 'You must be in WYSIWYG mode!' );

}



function InsertText() {

	// Get the editor instance that we want to interact with.

	var editor = CKEDITOR.instances.content1;

	var value = document.getElementById( 'txtArea' ).value;



	// Check the active editing mode.

	if ( editor.mode == 'wysiwyg' )

	{

		// Insert as plain text.

		// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertText

		editor.insertText( value );

	}

	else

		alert( 'You must be in WYSIWYG mode!' );

}



function SetContents() {

	// Get the editor instance that we want to interact with.

	var editor = CKEDITOR.instances.content1;

	var value = document.getElementById( 'htmlArea' ).value;



	// Set editor contents (replace current contents).

	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-setData

	editor.setData( value );

}



function GetContents() {

	// Get the editor instance that you want to interact with.

	var editor = CKEDITOR.instances.content1;



	// Get editor contents

	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getData

	alert( editor.getData() );

}



function ExecuteCommand( commandName ) {

	// Get the editor instance that we want to interact with.

	var editor = CKEDITOR.instances.content1;



	// Check the active editing mode.

	if ( editor.mode == 'wysiwyg' )

	{

		// Execute the command.

		// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-execCommand

		editor.execCommand( commandName );

	}

	else

		alert( 'You must be in WYSIWYG mode!' );

}



function CheckDirty() {

	// Get the editor instance that we want to interact with.

	var editor = CKEDITOR.instances.content1;

	// Checks whether the current editor contents present changes when compared

	// to the contents loaded into the editor at startup

	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-checkDirty

	alert( editor.checkDirty() );

}



function ResetDirty() {

	// Get the editor instance that we want to interact with.

	var editor = CKEDITOR.instances.content1;

	// Resets the "dirty state" of the editor (see CheckDirty())

	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-resetDirty

	editor.resetDirty();

	alert( 'The "IsDirty" status has been reset' );

}



function Focus() {

	CKEDITOR.instances.content1.focus();

}



function onFocus() {

	document.getElementById( 'eMessage' ).innerHTML = '<b>' + this.name + ' is focused </b>';

}



function onBlur() {

	document.getElementById( 'eMessage' ).innerHTML = this.name + ' lost focus';

}







/*  20 September Work */



function refineinfocontant(contant_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="contant_id="+contant_id;

	$.ajax({

		url: url1+"/catalog/infocontants/refineInfocontant",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}







function editinfocontant(contant_id)

{

	

	

	var querystring="type=edit&contant_id="+contant_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/infocontants/editContant",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#contant_id").val(data.contant_id);

		//$("#project_management_id").html(data.projectdrop);

		$("#content_title").val(data.content_title);

		$("#menu_id").html(data.drop_menu);

		$("#menu_id").val(data.menu_id);

		 var editor = CKEDITOR.instances.content1;

		  editor.setData( data.content );

		$("#title").html("Edit Info Content");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}









/* 20 September Work End */





/* 23 Septemeebr Work Start */

function editprojectslidderimagemanagement(project_slider_image_management_id)

{



	

	var querystring="type=edit&project_slider_image_management_id="+project_slider_image_management_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/projectsliderimages/editProjectsliderimage",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#project_slider_image_management_id").val(data.project_slider_image_management_id);

		$("#preview").html(data.preview);

		$("#project_slider_management_id").html(data.slider_drop);

		

		$("#title").html("Edit Project Slider");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



function refineprojectsliderimages(project_slider_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="project_slider_id="+project_slider_id;

	$.ajax({

		url: url1+"/catalog/projectsliderimages/refineProjectsliderimage",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



























function editquotes(quote_id)

{

	

	

	var querystring="type=edit&quote_id="+quote_id;

	

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/quotes/editQuote",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#quotes_id").val(data.quotes_id);

		$("#quote_name").val(data.quotes_name);

		$("#project_management_country").val(data.country_id);

		$("#quote_designation").val(data.quote_designation);

		$("#preview").html(data.image_html);

		 var editor = CKEDITOR.instances.content1;

		  editor.setData( data.content );

		$("#title").html("Edit Quote");

		$("#submit").val("Update");

		$("#new").show();

		

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}









function refinequote(quote_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="quote_id="+quote_id;

	$.ajax({

		url: url1+"/catalog/quotes/refineQuote",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}











function editmanagegalleryadd(manage_gallery_id)

{

	

	

	var querystring="type=edit&manage_gallery_id="+manage_gallery_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/addimagegallery/editManage_gallery",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#manage_gallery_add_id").val(data.manage_gallery_add_id);

		$("#manage_gallery_title").val(data.manage_gallery_title);

		

		$("#title").html("Edit Gallery");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}







function refinemanagegalleryadd(manage_gallery_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="manage_gallery_id="+manage_gallery_id;

	$.ajax({

		url: url1+"/catalog/addimagegallery/refineManageGallery",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}

/* 23 Septemeebr Work End*/





/* 25 September Work Start */

function edittestimonials(testimonial_id)

{

	

	

	var querystring="type=edit&testimonial_id="+testimonial_id;

	

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/testimonials/editTestimonials",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#testimonial_id").val(data.testimonial_id);

		$("#client_name").val(data.client_name);

		

		$("#preview").html(data.image_html);

		 var editor = CKEDITOR.instances.content1;

		  editor.setData( data.content );

		$("#title").html("Edit Testimonial");

		$("#submit").val("Update");

		$("#new").show();

		

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}









function refinetestimonials(testimonial_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="testimonial_id="+testimonial_id;

	$.ajax({

		url: url1+"/catalog/testimonials/refineTestimonials",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}







/* 25 September Work End */

















/* 26 September Work Start */

function editnewsletter(newsletter_id)

{

	

	

	var querystring="type=edit&newsletter_id="+newsletter_id;

	

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/newsletter/editNewsletter",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#newsletter_id").val(data.newsletter_id);

		$("#newsletter_title").val(data.newsletter_title);

		$("#preview").html(data.image_html);

		$("#preview").html(data.image_html);

		$("#preview_pdf_s").html(data.pdf_html);

		$("#title").html("Edit Newsletter");

		$("#submit").val("Update");

		$("#new").show();

		

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}









function refinenewsletter(newsletter_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="newsletter_id="+newsletter_id;

	$.ajax({

		url: url1+"/catalog/newsletter/refineNewsletter",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}





























function editmedia(media_id)

{

	

	

	var querystring="type=edit&media_id="+media_id;

	

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/media/editMedia",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#media_id").val(data.media_id);

		$("#media_title").val(data.media_title);

		$("#media_location").val(data.media_location);

		///$("#quote_designation").val(data.quote_designation);

		$("#preview").html(data.image_html);

		 var editor = CKEDITOR.instances.content1;

		  editor.setData( data.content );

		$("#title").html("Edit Media");

		$("#submit").val("Update");

		$("#new").show();

		

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}









function refinemedia(media_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="media_id="+media_id;

	$.ajax({

		url: url1+"/catalog/media/refineMedia",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}







//////////// Edit/Update Project Slider Management Start //////



function editmediaslider(media_slider_id)

{

	

	

	var querystring="type=edit&media_slider_id="+media_slider_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/mediaslider/editMediaslider",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#media_slider_id").val(data.media_slider_id);

		$("#media_id").html(data.mediadrop);

		//$("#media_id").val(data.project_management_id);

		$("#media_slider_name").val(data.media_slider_name);

		$("#title").html("Edit Media Slider");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



////////Edit/Update Project Slider Management End ////////////









/*  Refined Project Management Start*/

function refinemediaslider(media_slider_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="media_slider_id="+media_slider_id;

	$.ajax({

		url: url1+"/catalog/mediaslider/refineMediaslider",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



/*  Refined Project Slider Management End*/









function editmediasliderimage(media_slider_image_id)

{



	

	var querystring="type=edit&media_slider_image_id="+media_slider_image_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/mediasliderimage/editMediasliderimage",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#media_slider_image_id").val(data.media_slider_image_id);

		$("#preview").html(data.preview);

		$("#media_slider_id").html(data.slider_drop);

		

		$("#title").html("Edit Media Slider Slider");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



function refinemediasliderimage(media_slider_image_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="media_slider_image_id="+media_slider_image_id;

	$.ajax({

		url: url1+"/catalog/mediasliderimage/refineMediasliderimage",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}







/* 26 September Work End */





function editpaypal(paypal_id)

{

	

	var querystring="type=edit&paypal_id="+paypal_id;

	

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/paypal/editPaypal",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#paypal_id").val(data.paypal_id);

		$("#api_username").val(data.api_username);

		$("#api_password").val(data.api_password);

		$("#api_signature").val(data.api_signature);

		$("#title").html("Edit Paypal");

		$("#submit").val("Update");

		$("#new").show();

		

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}









function refinepaypal(paypal_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="paypal_id="+paypal_id;

	$.ajax({

		url: url1+"/catalog/paypal/refinePaypal",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}









function editcurrentopening(currentopening_id)

{

	

	

	var querystring="type=edit&currentopening_id="+currentopening_id;

	

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/currentopening/editCurrentopening",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

	

		$("#currentopening_id").val(data.currentopening_id);

		$("#job_title").val(data.title);

		$("#location").val(data.location);

		$("#department").val(data.department);

		 var editor = CKEDITOR.instances.content1;

		  editor.setData( data.content );

		$("#preview").html(data.pdf_html);

		$("#title").html("Edit Opening");

		$("#submit").val("Update");

		$("#new").show();

		

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}









function refinecurrentopening(currentopening_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="currentopening_id="+currentopening_id;

	$.ajax({

		url: url1+"/catalog/currentopening/refinecurrentopening",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}















function editvolunteer(volunteer_id)

{

	

	

	var querystring="type=edit&volunteer_id="+volunteer_id;

	

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/volunteer/editVolunteer",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

	

		$("#volunteer_id").val(data.volunteer_id);

		$("#job_title").val(data.title);

		$("#location").val(data.location);

		$("#department").val(data.department);

		 var editor = CKEDITOR.instances.content1;

		  editor.setData( data.content );

		$("#preview").html(data.pdf_html);

		$("#title").html("Edit Volunteer Opening");

		$("#submit").val("Update");

		$("#new").show();

		

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}









function refinevolunteer(volunteer_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="volunteer_id="+volunteer_id;

	$.ajax({

		url: url1+"/catalog/volunteer/refinevolunteer",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}







function editinternship(internship_id)

{

	

	

	var querystring="type=edit&internship_id="+internship_id;

	

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/internship/editinternship",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

	

		$("#internship_id").val(data.internship_id);

		$("#job_title").val(data.title);

		$("#location").val(data.location);

		$("#department").val(data.department);

		 var editor = CKEDITOR.instances.content1;

		  editor.setData( data.content );

		$("#preview").html(data.pdf_html);

		$("#title").html("Edit Internship Opening");

		$("#submit").val("Update");

		$("#new").show();

		

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}









function refineinternship(internship_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="internship_id="+internship_id;

	$.ajax({

		url: url1+"/catalog/internship/refineinternship",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}













//////////// 10 Oct Work

//////////// Edit/Update Project Slider Management Start //////



function editinformationslider(slider_management_id)

{

	

	

	var querystring="type=edit&information_slider_management_id="+slider_management_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/slider/editInformationslider",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#information_slider_management_id").val(data.information_slider_management_id);

		$("#information_page_id").html(data.projectdrop);

		$("#information_page_id").val(data.information_page_id);

		$("#information_slider_title").val(data.information_slider_title);

		$("#title").html("Edit Project Slider");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



////////Edit/Update Project Slider Management End ////////////









/*  Refined Project Management Start*/

function refineinformationslider(information_slider_management_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="information_slider_management_id="+information_slider_management_id;

	$.ajax({

		url: url1+"/catalog/slider/refineInformationslider",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



/*  Refined Project Slider Management End*/







function editinformationslidderimagemanagement(information_slider_image_management_id)

{



	

	var querystring="type=edit&information_slider_image_management_id="+information_slider_image_management_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/sliderimage/editInformationsliderimage",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#information_slider_image_management_id").val(data.information_slider_image_management_id);

		$("#preview").html(data.preview);

		$("#information_slider_management_id").html(data.slider_drop);

		

		$("#title").html("Edit Information Slider");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



function refineinformationsliderimages(information_slider_management_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="information_slider_management_id="+information_slider_management_id;

	$.ajax({

		url: url1+"/catalog/sliderimage/refineInformationsliderimage",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}









//// CC Avenue Start //



function editccavenue(ccavenue_id)

{

	

	var querystring="type=edit&ccavenue_id="+ccavenue_id;

	

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/ccavenue/editCcavenue",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#ccavenue_id").val(data.ccavenue_id);

		$("#marchant_id").val(data.marchant_id);

		$("#redirect_url").val(data.redirect_url);

		$("#access_code").val(data.access_code);

		$("#encrypt_key").val(data.encrypt_key);

		$("#order_transaction_status").html(data.order_transaction_status);

		$("#order_abort_status").html(data.order_abort_status);

		$("#order_failure_status").html(data.order_failure_status);

	

		$("#title").html("Edit Ccavenue");

		$("#submit").val("Update");

		$("#new").show();

		

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}









function refineccavenue(ccavenue_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="ccavenue_id="+ccavenue_id;

	$.ajax({

		url: url1+"/catalog/ccavenue/refineCcavenue",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

		

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



/// CC Avenue End













///////////// Edit/Update  Our Team Start //////



function editourteam(ourteam_id)

{

	

	

	var querystring="type=edit&ourteam_id="+ourteam_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/ourteam/editOurteam",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#ourteam_id").val(data.ourteam_id);

		$("#ourteam_title").val(data.ourteam_title);

		$("#preview").html(data.image_html);

	

		 var editor = CKEDITOR.instances.content1;

		  editor.setData( data.ourteam_description );

		//$("#planting_partners_description").val(data.planting_partners_description);

		$("#title").html("Edit Team Member");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



////////Edit/Update  Our Team End ////////////













/*  Refined  Our Team Start*/

function refineourteam(ourteam_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="ourteam_id="+ourteam_id;

	$.ajax({

		url: url1+"/catalog/ourteam/refineOurteam",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



/*  Refined Our Team End*/











///////////// Edit/Update Corporate Partner Start //////



function editcorporatepartner(corporate_partner_id)

{

	

	

	var querystring="type=edit&corporate_partner_id="+corporate_partner_id;

	var url1=getRootUrl(document.location);

	$.ajax({

	url: url1+"/catalog/corporatepartner/editCorporatepartner",

	type: "POST",

	data: querystring,

	dataType: "json",

	success: function(data) {

		

		$("#corporate_partner_id").val(data.corporate_partner_id);

		$("#corporate_partner_title").val(data.corporate_partner_title);

		

		$("#preview").html(data.image_html);

		$("#title").html("Edit Corporate Partner");

		$("#submit").val("Update");

		$("#new").show();

	},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



////////Edit/Update Corporate Partner End ////////////









/*  Refined Corporate Partner Start*/

function refinecorporatepartner(corporate_partner_id)

{

	

	var url1=getRootUrl(document.location);

	

	var querystring="corporate_partner_id="+corporate_partner_id;

	$.ajax({

		url: url1+"/catalog/corporatepartner/refineCorporatepartner",

		type: "POST",

		data: querystring,

		dataType: "json",

		success: function(data) {

			

		 $("#allbody").html(data.refine_con);

		 $(".pagination").html(data.pagination)

		 $(".ask").jConfirmAction();

		 $(".up").recordUP();

		 $(".down").recordDown();

		},

		 error:function(jqXHR,textStatus,errorThrown)

		{

				 if (jqXHR.status == 500) {

                      alert('Internal error: ' + jqXHR.responseText);

                  } else {

                      alert('Unexpected error.'+errorThrown);

                  }

		}

	})

}



/*  Refined Corporate Partner End*/