<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		$('#myModal').on('show.bs.modal', function(e) {
		    $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
		});
	});
	
</script>