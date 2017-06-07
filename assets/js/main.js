// delete a post confirmation
function confirmDelete(id) {
	if ( confirm("Are you sure you want to delete this post?") ) {
		window.location = ("http://localhost/mu_image_gallery/admin/delete.php?id=" + id);
	}
}
