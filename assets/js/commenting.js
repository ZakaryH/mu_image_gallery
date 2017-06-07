$("#commentform").on( "submit", function( event ) {
	event.preventDefault();
	// pass in the post id, and the comment value
	submitComment( $(this).attr("postid"), event.target[0].value );
});

function submitComment ( post, comment ) {
	$.ajax({
		method: "POST",
		url: "../admin/comment.php",
		data: {
			comment: comment,
			post: post
		}
	})
	.done(function( response ) {
		var item = $(response).hide().fadeIn(800);
		// add the comment
		$('.post-comments-section').append(item);
		// reset form and button
		$("#commentform").trigger('reset');
	})
	.fail(function() {
		console.log("something went wrong");
	})
	.always(function() {
		console.log("finished");
	});
}