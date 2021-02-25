<section class="section">
	<div class="container">
		<div class="account-pages my-5 pt-sm-5">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6 col-xl-5">
						<div class="card overflow-hidden">
							<div class="bg-soft-primary">
								<div class="row">
									<div class="col-12">
										<div class="text-primary p-4">
											<h5 class="text-primary">Welcome Hero!</h5>
											<p>Sign in to continue.</p>

										</div>
									</div>
									
								</div>
							</div>
							<div class="card-body pt-0">
								<div class="p-2">
									<form id="loginform" class="form-horizontal" method="POST"
										action="<?php echo base_url('admin/login') ?>">
										<div class="error_msg">
											<?php echo $error; ?>
										</div>
										<div class="form-group">
											<label for="email">Email</label>
											<input type="email" class="form-control" name="email"
												placeholder="Enter email">
										</div>

										<div class="form-group">
											<label for="password">Password</label>
											<input type="password" class="form-control" name="password"
												placeholder="Enter password">
										</div>

										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input"
												id="customControlInline">
											<label class="custom-control-label" for="customControlInline">Remember
												me</label>
										</div>

										<div class="mt-3">
											<button class="btn btn-primary btn-block waves-effect waves-light"
												type="submit">Log In</button>
										</div>

									</form>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
