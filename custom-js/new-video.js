$(document).ready(function(){

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

	$("#board, #standard, #subject").change(function(){
		var boardid = $("#board option:selected").val();
		var standardid = $("#standard option:selected").val();
		var subjectid = $("#subject option:selected").val();
		$.ajax({
			type:'GET',
			url:'ajax/loadchapter-list',
			data:{boardid: boardid, standardid: standardid, subjectid: subjectid},
			success:function(result){
				if(result != 0){
					$("#chapter").html(result);
				}
				else{
					$("#chapter").trigger(0);
				}
			},
			error: function (error){
				$("#fail").delay(2000).show().slideUp('fast');
				return false;
			}
		});
	});

	$('.addRow').on('click',function(){
		var html1 = '';
		html1 +='<tr>'; 
		html1 +='<td><input type="text" class="form-control vtitle" name="vtitle[]" placeholder="Video Title" autocomplete="off"></td>'; 
		html1 +='<td><input type="text" class="form-control url" name="url[]" placeholder="Video URL" autocomplete="off"></td>'; 
		html1 +='<td><button class="btn btn-dark btn-sm waves-effect waves-light removeRow"><i class="fa fa-times"></i> REMOVE</button></td>'; 
		html1 +='</tr>';
		$('#videolist').append(html1);
	});

	$(document).on('click','.removeRow',function(){
		$(this).closest('tr').remove();
	});

	$("#invboard, #invstd, #invsub, #invchapter, #invtitle, #invurl, #duplicate, #invalid, #fail, #success, #loader").hide();

	$('form').submit(function(){
		var bd_id = $("#board option:selected").val();
		var std_id = $("#standard option:selected").val();
		var sub_id = $("#subject option:selected").val();
		var chap_id = $("#chapter option:selected").val();
		var vtitle = $('.vtitle').val();
		var url = $('.url').val();
		var validate = /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/

		if(bd_id==0){
			$('#invboard').delay(2000).show().slideUp('fast');
			return false;
		}
		if(std_id==0){
			$('#invstd').delay(2000).show().slideUp('fast');
			return false;
		}
		if(sub_id==0){
			$('#invsub').delay(2000).show().slideUp('fast');
			return false;
		}
		if(chap_id==0){
			$('#invchapter').delay(2000).show().slideUp('fast');
			return false;
		}
		if(vtitle===''){
			$('#invtitle').delay(2000).show().slideUp('fast');
			return false;
		}
		if(!validate.test(url)){
			$('#invurl').delay(2000).show().slideUp('fast');
			return false;
		}
		else{
			$.ajax({
				type:'POST',
				url:'ajax/new-video',
				data:new FormData(this),
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
						$('#duplicate').delay(2000).show().slideUp('fast');
						return false;
						$('#loader').hide();
						$('button').show();	
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