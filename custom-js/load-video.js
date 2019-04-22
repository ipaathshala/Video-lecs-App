$(document).ready(function(){
	
	$("#norecords, #records, #videobody").hide();

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

	$("#subject").change(function(){
		var subjectid = $("#subject option:selected").val();
		var stdid = $("#student").val();
		$.ajax({
			type:'GET',
			url:'ajax/chapter-dropdown',
			data:{subjectid: subjectid, stdid: stdid},
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

	$("#subject, #chapter").change(function(){
		var subjectid = $("#subject option:selected").val();
		var chapterid = $("#chapter option:selected").val();
		var stdid = $("#student").val();
		$.ajax({
			type:'GET',
			url:'ajax/lecture-video',
			data:{subjectid: subjectid, chapterid: chapterid, stdid: stdid},
			success:function(result){
				if(result != 0){
					$("#videobody").html(result).show();
				}
				else{
					$("#videobody").trigger(0);
				}
			},
			error: function (error){
				$("#fail").delay(2000).show().slideUp('fast');
				return false;
			}
		});
	});
});