<div class="container">
	<div class="float-end">
		<form action="<?php echo base_url('/asset/search'); ?>" method="post">
			<input type="text" name="search" value="<?= $search ?>" id="search" class="form-control"
				placeholder="Type search text and press enter">
		</form>
	</div>
	<h1><a class="nolink" href="<?= base_url('asset') ?>">Assets</a></h1>
	<button id="addBtn" class="btn btn-sm btn-primary">Add New</button>
	<?php echo form_open_multipart('asset/upload', array('id'=>"uploadForm"));?>
	<input id='imageInput' name="image" type='file' accept="image/*" hidden />
	</form>
	<br><br>
	<?php if(strlen($search) > 0){ ?>
	<div class="alert alert-success">
		There are <?= count($upload_data) ?> image(s) for key word `<?= $search ?>`.
	</div>
	<?php } ?>

	<?php if($this->session->flashdata('success')){ ?>
	<div class="alert alert-success">
		<strong><span class="glyphicon glyphicon-ok"></span>
			<?php echo $this->session->flashdata('success'); ?></strong>
	</div>
	<?php } ?>

	<div class="d-flex">
		<div class="flex-fill">
			<div class="image-panel ">
				<?php foreach ($upload_data as $item => $value):?>
				<div class="img" data-img-id="<?= $value->id; ?>" data-img-file_name="<?= $value->file_name; ?>"
					data-img-name="<?= $value->orig_name; ?>" data-img-alt="<?= $value->alt_text; ?>"
					data-img-file_size="<?= $value->file_size; ?>" data-img-width="<?= $value->image_width; ?>"
					data-img-height="<?= $value->image_height; ?>">
					<div class="bg-img"
						style="background-image:url('<?php echo base_url('/uploads/' . $value->file_name) ?>')">
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div>
			<div class="img-detail">
				<div class="selected">
				</div>
				<div class="img-data">
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$().ready(function () {
		$("#addBtn").click(function (e) {
			e.preventDefault();
			$("#imageInput").click();
		});

		$("#imageInput").on('change', function () {
			var file = this.files[0];
			if (file.size > 1024 * 1024 * 10) {
				alert('max upload size is 10MB');
			} else {
				$("#uploadForm").submit();
			}
			// Also see .name, .type
		});
		$("#search").keyup(function (e) {
			e.preventDefault();
			console.log(e);
		})
		$(".img").click(function () {
			$(".img-detail").show();
			$(".img").removeClass("active");
			$(this).addClass("active");
			var url = "<?php echo base_url('uploads/')?>" + $(this).attr("data-img-file_name");

			// $(".img-data").html("<form action='<?php echo base_url('asset/update')?> ' method='POST'>");
			// $(".img-data form").append("<input type='hidden' name='asset_id' value='"+ $(this).attr("data-img-id")  +"'>");
			// $(".img-data form").append("<p><b>Name: </b>" + $(this).attr("data-img-name") + "</p>");
			// $(".img-data form").append("<p><b>File size: </b>" + $(this).attr("data-img-file_size") +
			// 	"</p>");
			// $(".img-data form").append("<p><b>Alt: </b><input name='alt_text' type='text' class='form-control' value='" +
			// 	$(this).attr("data-img-alt") + "'></p>");
			// $(".img-data form").append("<a href='<?php echo base_url('asset/delete')?>/" + $(this).attr(
			// 		"data-img-id") +
			// 	"' class='btn btn-danger' onclick='return confirm(\"are you sure to delete\")'>Delete</a>&nbsp;"
			// 	);
			// $(".img-data form").append("<input type='submit' class='btn btn-primary' value='Update'>");
			// $(".img-data").append("</form>");


			$(".img-data").html(
				`<form action='<?php echo base_url("asset/update")?>' method='POST'>
					<input type='hidden' name='asset_id' value='` + $(this).attr("data-img-id") + `'>
					<p><b>Name: </b>` + $(this).attr("data-img-name") + `</p>
					<p><b>Path: </b>` + url + `</p>
					<p><b>File size: </b>` + $(this).attr("data-img-file_size") + `KB</p>
					<p><b>Alt: </b>
						<input name='alt_text' type='text' class='form-control' value='` + $(this).attr("data-img-alt") + `'>
					</p>
					<a href='<?php echo base_url('asset/delete')?>/` + $(this).attr("data-img-id") + `' class='btn btn-danger'
					 onclick='return confirm(\"are you sure to delete\")'>Delete</a>&nbsp;
					<input type='submit' class='btn btn-primary' value='Update'>
				</form>`
			);

			$(".selected").html("<img src='" + url + "' >");
		})
	});

</script>
