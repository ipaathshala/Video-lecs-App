$(document).ready(function(){
	$('#invun, #invpw, #invlogin, #invalid, #fail, #success, #loader').hide();
	$('form').submit(function(){
		var un = $('#un').val();
		var pw = $('#pw').val();
		var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

		if(un==='' || !pattern.test(un)){
			$('#invun').delay('2000').show().slideUp('fast');
			return false;
		}
		if(pw===''){
			$('#invpw').delay('2000').show().slideUp('fast');
			return false;
		}
		else{
			$.ajax({
				type:'POST',
				url:'ajax/sign-in',
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
						$('#success').delay(5000).show().slideUp('fast');
						$('#loader').show();
						$('button').hide();
						setTimeout("window.location.href='dashboard';",3000);
					}
					else{
						$('#loader').hide();
						$('button').show();
						$('#invlogin').delay(2000).show().slideUp('fast');
						return false;
					}
					if(result == 2){
						$('#loader').hide();
						$('button').show();
						$('#invalid').delay(2000).show().slideUp('fast');
						return false;
					}
				},
				error:function(error){
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