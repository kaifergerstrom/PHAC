
// Close the upload form
$("#close-upload-form").click(function(){
	$(".overlay").fadeOut();
});

// Open the upload form
$("#open-upload-header").click(function(){
	$(".overlay").css("display", "flex");
	$(".overlay").hide();
	$(".overlay").fadeIn();
});

// Update file input text
$('#customFile').on('change',function(){
	//get the file name
	var fileName = $(this).val();
	fileName = fileName.replace(/^.*\\/, "");
	//replace the "Choose a file" label
	$(this).next('.custom-file-label').html(fileName);
})