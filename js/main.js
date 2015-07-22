
$(document).ready(function(){
	$("#result").hide();
	$('#file-path').change(function(){
		$('#image-box').hide(500);
		if(imageValid($('#file-path').val()) == true){
			showImage(this);
		}
		else{
			$('#image-preview').attr('alt', "Invalid Image");
			$('#image-preview').attr('src', "");
			$('#image-box').show(500);
			e.preventDefault();
		}
	});
	$('#submit').click(function(e){
    	if(!imageValid($('#file-path').val()))
    		e.preventDefault();
	});
	$("button").click(function() {
	    var $btn = $(this);
	    $btn.button('loading');
	    // simulating a timeout
	    setTimeout(function () {
	        $btn.button('reset');
	    }, 30000);
		});


});
function showImage(input){
	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image-preview').attr('src', e.target.result);
       
            $('#image-box').show(500);
        }

        reader.readAsDataURL(input.files[0]);
    }

}
function imageValid(a){
	var x = a.substring(a.lastIndexOf('.')+1);
	x = x.toLowerCase();
	if( x != "png" && x != "jpg" && x != "jpeg")
		return false;
	return true;
}