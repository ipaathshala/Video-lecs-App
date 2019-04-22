$(document).ready(function(){
	
	$("#invboard, #invclass, #invnm, #invun, #invpw, #duplicate, #invalid, #fail, #success, #loader").hide();
	
	$.ajax({
		type:'POST',
		url:'ajax/board-dropdown',
		success:function(result){
			if(result!=0){
				$('#board').html(result).show();
			}
		},
		error: function(error){
			$('#fail').delay(2000).show().slideUp('fast');
			return false;
		}
	});

	$.ajax({
		type:'POST',
		url:'ajax/standard-dropdown',
		success:function(result){
			if(result!=0){
				$('#standard').html(result).show();
			}
		},
		error: function(error){
			$('#fail').delay(2000).show().slideUp('fast');
			return false;
		}
	});

	$('form').submit(function(){
		var boardid = $('#board option:selected').val();
		var standardid = $('#standard option:selected').val();
		var firstname = $("#fn").val();
		var lastname = $("#ln").val();
		var username = $("#un").val();
		var password = $("#pw").val();
		var regex = /^[a-zA-Z ]*$/;
		var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

		if(boardid == 0){
			$('#invboard').delay(2000).show().slideUp('fast');
			return false;
		}
		if(standardid == 0){
			$('#invclass').delay(2000).show().slideUp('fast');
			return false;
		}
		if(firstname==='' || !regex.test(firstname) || lastname==='' || !regex.test(lastname)){
			$("#invnm").delay(2000).show().fadeOut('fast');
			return false;
		}
		if(username==='' || !pattern.test(username)){
			$("#invun").delay(2000).show().fadeOut('fast');
			return false;
		}
		if(password===''){
			$("#invpw").delay(2000).show().fadeOut('fast');
			return false;
		}
		else{
			$.ajax({
				type:'POST',
				url:'ajax/std-profile',
				data:new FormData (this),
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(result){
					$('button').hide();
					$('#loader').show();
				},
				success:function(result){
					if(result == true){
						$('#success').delay(2000).show().slideUp('fast');
						$('form').trigger('reset');
						$('#loader').hide();
						$('button').show();	
					}
					if(result == 2){
						$('#loader').hide();
						$('button').show();	
						$('#duplicate').delay(2000).show().slideUp('fast');
						return false;
					}
					if(result == 0){
						$('#invalid').delay(2000).show().slideUp('fast');
						return false;
					}
				},
				error:function(error){
					$('#loader').hide();
					$('button').show();
					$('#fail').delay(2000).show().slideUp('fast');
					return false;	
				},
				complete:function(result){
					$("#loader").hide();
					$('button').show();
				}
			});
			return false;
		}
	});
});