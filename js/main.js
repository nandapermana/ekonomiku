var postID;
var potoID;
var pdfID;
var adsID;

//for edit pdf;
var description,url,title;
$(document).ready(function(){
    $('.yesDelete').click(function(){
        	$.ajax({
		    type: 'GET',
		    dataType: 'JSON',
		    data: { 	id: postID  },
		    url: delete_url,
		    success: function(data){
		       location.reload();
		    },
		    error: function(xhr){
		        console.log(xhr.responseText);
		    }
		});
    });

     $('.deletePic').click(function(){
        	$.ajax({
		    type: 'GET',
		    dataType: 'JSON',
		    data: { 	id: potoID  },
		    url: delete_img,
		    success: function(data){
		       location.reload();
		    },
		    error: function(xhr){
		        console.log(xhr.responseText);
		    }
		});
    });

    $('.deletePdf').click(function(){
        	$.ajax({
		    type: 'GET',
		    dataType: 'JSON',
		    data: { 	id: pdfID  },
		    url: deletepdfurl,
		    success: function(data){
		       location.reload();
		    },
		    error: function(xhr){
		        console.log(xhr.responseText);
		    }
		});
    });

    $('.delete-ads').click(function(){
    	$.ajax({
		    type: 'GET',
		    dataType: 'JSON',
		    data: { 	id: adsID  },
		    url: deleteadsurl,
		    success: function(data){
		       location.reload();
		    },
		    error: function(xhr){
		        console.log(xhr.responseText);
		    }
		});
    });

});

function deleteAds(id){
	$('#deleteAds').modal();
	adsID = id;
}

function editAds(id,url,name,description){
	$('#adsEdit').modal();
	$('#url_edit').val(url);
	$('#name_edit').val(name);
	$('#description_edit').val(description);
	$('#id_edit').val(id);
}

function uploadAds(){
	$('#adsModal').modal();
}

function confimrationDelete(id){
	postID = id;
	$('#myModal').modal();
}

function confirmPotoDelete(id){
	potoID= id;
	$('#myModal').modal();
}

function uploadPDF() {
	$('#pdf_upload').modal();
}

function deletePDF(pdf_id){
	pdfID = pdf_id;
	$('#delete_pdf').modal();
}

function editPDF(pdf_id,pdf_title,pdf_description,pdf_url) {
	pdfID 		= pdf_id;
	description = pdf_description;
	title 		= pdf_title;
	url 		= pdf_url;

	$("#pdf_url").val(pdf_url);
	$("#pdf_title").val(pdf_title);
	$("#pdf_description").val(pdf_description);
	$("#pdf_id").val(pdf_id);
	$("#pdf_edit").modal();
}

function share(url){
	console.log(url);
	$("#modal-share").modal();
	$("#share-link").val(url);
}


/*

function next(totalPage){
	var currentPage = +$("#next").attr('value');
	if (currentPage<=totalPage) {
		if (currentPage == 1) {
		var nextPage = 2;
		}else{
			var nextPage = currentPage +1;
		}
		$.ajax({
			    type: 'GET',
			    dataType: 'JSON',
			    data: { 	next: nextPage  },
			    url: nextUrl,
			    success: function(data){
			    	//console.log(data);
			    	//location.reload(data);
			    	//$("html").html(data);
			    	
			    	var nextVal = ((+data['page']));
			        $("#next").attr("value", nextVal);
			        console.log(data['post']);
			        
			    },
			    error: function(xhr){
			        //console.log(xhr.responseText);
			        $("html").html(xhr.responseText);
			        $("head").html(head);
			    }
		});
	}
}

function prev(){
	console.log("prev");
	console.log(prevUrl);
}

*/