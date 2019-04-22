$(document).ready(function(){
	
	$("#invboard, #invclass, #invsubject, #invfile, #invalid, #fail, #success, #loader").hide();
	
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

	$.ajax({
		type:'POST',
		url:'ajax/subject-dropdown',
		success:function(result){
			if(result!=0){
				$('#subject').html(result).show();
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
		var subjectid = $('#subject option:selected').val();
		var fileType = $('#file').val();
		var extensions = [".csv"];
		var check = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + extensions.join('|') + ")$");

		if(boardid == 0){
			$('#invboard').delay(2000).show().slideUp('fast');
			return false;
		}
		if(standardid == 0){
			$('#invclass').delay(2000).show().slideUp('fast');
			return false;
		}
		if(subjectid == 0){
			$('#invsubject').delay(2000).show().slideUp('fast');
			return false;
		}
		if(fileType===''||!check.test(fileType.toLowerCase())){
			$('#invfile').delay(2000).show().slideUp('fast');
			return false;
		}
		else{
			$.ajax({
				type:'POST',
				url:'ajax/save-chapter',
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