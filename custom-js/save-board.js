$(document).ready(function(){

	$("#invboard, #duplicate, #invalid, #fail, #success, #records, #norecords, #loader").hide();

	$('form').submit(function(){
		var board = $('#board').val();
		if(board === ''){
			$('#invboard').delay(2000).show().slideUp('fast');
			return false;
		}
		else{
			$.ajax({
				type:'POST',
				url:'ajax/save-board',
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
					else if(result == 2){
						$('#loader').hide();
						$('button').show();	
						$('#duplicate').delay(2000).show().slideUp('fast');
						return false;
					}
					else if(result == 0){
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

	/*Refresh records*/
	$("#refresh").click(function(){
		$.ajax({
			type:'POST',
			url:'ajax/board-list',
			success:function(result){
				if(result!=0){
					$('#boardlist').html(result).show();
					$('#records').delay(2000).show().slideUp('fast');
				}
				else{
					$('#norecords').delay(2000).show().slideUp('fast');
					return false;
				}
			},
			error: function(error){
				$('#fail').delay(2000).show().slideUp('fast');
				return false;
			}
		});
	});
});