<?php require_once('header.php');

if(isset($_POST['search_btn'])){
	$class_id = $_POST['st_class'];
	$st_mobile = $_POST['st_mobile'];

	//Count Student
	$st_count = stRowCount('mobile',$st_mobile);

	if(empty($class_id)){
		$error = "Please Select Class is Required!";
	}
	else if(empty($st_mobile)){
		$error = "Mobile Number is Required!";
	}
	else if($st_count!=1){
		$error = "Student Not Found!";
	}
	else{

		$st_id = StudentFromMobile('id',$st_mobile);
		$result_count = ResultCount($st_id);
		if($result_count==1){ 
			
			$stm=$pdo->prepare("SELECT * FROM students_results WHERE st_id=?");
			$stm->execute(array($st_id));
			$result = $stm->fetchAll(PDO::FETCH_ASSOC);

			// print_r($result);

		}
		else{
			$error = "Student Result Not Found!";
		}
	}

}



?>
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- Main Slider -->
        <div class="section-area section-sp1 ovpr-dark bg-fix online-cours" style="background-image:url(assets/images/background/bg1.jpg);">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center text-white">
							<h2>Search Your Exeam Results</h2>
							<form class="cours-search" method="POST" action="">
								<div class="input-group">
									<select class="p-2" name="st_class" id="">
									<option value="">Select Class</option>
									<?php  
										$stm = $pdo->prepare("SELECT id,class_name FROM class ORDER BY class_name ASC");
										$stm->execute();
										$classList = $stm->fetchAll(PDO::FETCH_ASSOC);
										$i=1;
										foreach($classList as $list) :
									?>
									<option
									<?php 
									if(isset($_POST['select_class']) AND $_POST['select_class'] == $list['id']){
										echo "selected";
									}
									?>
									value="<?php echo $list['id'];?>"><?php echo $list['class_name'];?></option>
									<?php endforeach;?>
									</select>
									<input type="text" name="st_mobile" class="form-control" placeholder="Student Mobile">
									<div class="input-group-append">
										<button class="btn" name="search_btn" type="submit">Search</button> 
									</div>
								</div>
							</form>

								<?php if(isset($error)) :?>
								<div class="alert alert-danger"><?php echo $error;?></div>
								<?php endif;?>

						</div>
					</div>

					<?php if(isset($result)) :?>
					<div class="mw800 m-auto">
						<div class="row">
							<div class="col-md-12">
								<div class="cours-search-bx m-b30">
									<span>Your Result</span>
									<table class="table-bordered">
										<tr>
											<td>Name:</td>
											<td><?php echo Student('name',$result[0]['st_id']); ?></td>
										</tr>
										<tr>
											<td>Position:</td>
											<td><?php echo $result[0]['position']; ?></td>
										</tr>
										<tr>
											<td>Total Marks:</td>
											<td><?php echo $result[0]['total_marks']; ?></td>
										</tr>
										<?php 
										$subList = json_decode($result[0]['subjects'],true);
										$lenght = count($subList)/2;
										for($a=1;$a<$lenght;$a++):?>
										<tr>
											<td><?php echo $subList['subject_'.$a]; ?></td>
											<td><?php echo $subList['subject_'.$a.'_marks']; ?></td>
										</tr>
										<?php endfor;?>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php endif;?>

					<div class="mw800 m-auto">
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<div class="cours-search-bx m-b30">
									<div class="icon-box">
										<h3><i class="ti-user"></i><span class="counter">5</span>M</h3>
									</div>
									<span class="cours-search-text">Over 5 million student</span>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="cours-search-bx m-b30">
									<div class="icon-box">
										<h3><i class="ti-book"></i><span class="counter">30</span>K</h3>
									</div>
									<span class="cours-search-text">30,000 Courses.</span>
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="cours-search-bx m-b30">
									<div class="icon-box">
										<h3><i class="ti-layout-list-post"></i><span class="counter">20</span>K</h3>
									</div>
									<span class="cours-search-text">Learn Anythink Online.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        <!-- Main Slider -->
		<div class="content-block">
            <!-- Popular Courses -->
			<div class="section-area section-sp2 popular-courses-bx">
                <div class="container">
					<div class="row">
						<div class="col-md-12 heading-bx left">
							<h2 class="title-head">Popular <span>Courses</span></h2>
							<p>It is a long established fact that a reader will be distracted by the readable content of a page</p>
						</div>
					</div>
					<div class="row">
					<div class="courses-carousel owl-carousel owl-btn-1 col-12 p-lr0">
						<div class="item">
							<div class="cours-bx">
								<div class="action-box">
									<img src="assets/images/courses/pic1.jpg" alt="">
									<a href="#" class="btn">Read More</a>
								</div>
								<div class="info-bx text-center">
									<h5><a href="#">Introduction EduChamp – LMS plugin</a></h5>
									<span>Programming</span>
								</div>
								<div class="cours-more-info">
									<div class="review">
										<span>3 Review</span>
										<ul class="cours-star">
											<li class="active"><i class="fa fa-star"></i></li>
											<li class="active"><i class="fa fa-star"></i></li>
											<li class="active"><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
										</ul>
									</div>
									<div class="price">
										<del>$190</del>
										<h5>$120</h5>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="cours-bx">
								<div class="action-box">
									<img src="assets/images/courses/pic2.jpg" alt="">
									<a href="#" class="btn">Read More</a>
								</div>
								<div class="info-bx text-center">
									<h5><a href="#">Introduction EduChamp – LMS plugin</a></h5>
									<span>Programming</span>
								</div>
								<div class="cours-more-info">
									<div class="review">
										<span>3 Review</span>
										<ul class="cours-star">
											<li class="active"><i class="fa fa-star"></i></li>
											<li class="active"><i class="fa fa-star"></i></li>
											<li class="active"><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
										</ul>
									</div>
									<div class="price">
										<del>$190</del>
										<h5>$120</h5>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="cours-bx">
								<div class="action-box">
									<img src="assets/images/courses/pic3.jpg" alt="">
									<a href="#" class="btn">Read More</a>
								</div>
								<div class="info-bx text-center">
									<h5><a href="#">Introduction EduChamp – LMS plugin</a></h5>
									<span>Programming</span>
								</div>
								<div class="cours-more-info">
									<div class="review">
										<span>3 Review</span>
										<ul class="cours-star">
											<li class="active"><i class="fa fa-star"></i></li>
											<li class="active"><i class="fa fa-star"></i></li>
											<li class="active"><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
										</ul>
									</div>
									<div class="price">
										<del>$190</del>
										<h5>$120</h5>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="cours-bx">
								<div class="action-box">
									<img src="assets/images/courses/pic4.jpg" alt="">
									<a href="#" class="btn">Read More</a>
								</div>
								<div class="info-bx text-center">
									<h5><a href="#">Introduction EduChamp – LMS plugin</a></h5>
									<span>Programming</span>
								</div>
								<div class="cours-more-info">
									<div class="review">
										<span>3 Review</span>
										<ul class="cours-star">
											<li class="active"><i class="fa fa-star"></i></li>
											<li class="active"><i class="fa fa-star"></i></li>
											<li class="active"><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
										</ul>
									</div>
									<div class="price">
										<del>$190</del>
										<h5>$120</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
			<!-- Popular Courses END -->
			<div class="section-area section-sp2 bg-fix ovbl-dark join-bx text-center" style="background-image:url(assets/images/background/bg1.jpg);">
                <div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="join-content-bx text-white">
								<h2>Learn a new skill online on <br> your time</h2>
								<h4><span class="counter">57,000</span> Online Courses</h4>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
								<a href="#" class="btn button-md">Join Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Form END -->
			<div class="section-area section-sp1">
                <div class="container">
					 <div class="row">
						 <div class="col-lg-6 m-b30">
							<h2 class="title-head ">Learn a new skill online<br> <span class="text-primary"> on your time</span></h2>
							<h4><span class="counter">57,000</span> Online Courses</h4>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</p>
							<a href="#" class="btn button-md">Join Now</a>
						 </div>
						 <div class="col-lg-6">
							 <div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 m-b30">
									<div class="feature-container">
										<div class="feature-md text-white m-b20">
											<a href="#" class="icon-cell"><img src="assets/images/icon/icon1.png" alt=""></a> 
										</div>
										<div class="icon-content">
											<h5 class="ttr-tilte">Our Philosophy</h5>
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing.</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 m-b30">
									<div class="feature-container">
										<div class="feature-md text-white m-b20">
											<a href="#" class="icon-cell"><img src="assets/images/icon/icon2.png" alt=""></a> 
										</div>
										<div class="icon-content">
											<h5 class="ttr-tilte">Kingster's Principle</h5>
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing.</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 m-b30">
									<div class="feature-container">
										<div class="feature-md text-white m-b20">
											<a href="#" class="icon-cell"><img src="assets/images/icon/icon3.png" alt=""></a> 
										</div>
										<div class="icon-content">
											<h5 class="ttr-tilte">Key Of Success</h5>
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing.</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 m-b30">
									<div class="feature-container">
										<div class="feature-md text-white m-b20">
											<a href="#" class="icon-cell"><img src="assets/images/icon/icon4.png" alt=""></a> 
										</div>
										<div class="icon-content">
											<h5 class="ttr-tilte">Our Philosophy</h5>
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
			
			<!-- Testimonials -->
			<div class="section-area section-sp1 bg-fix ovbl-dark text-white" style="background-image:url(assets/images/background/bg1.jpg);">
                <div class="container">
					<div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
                                <div class="counter-style-1">
                                    <div class="text-white">
										<span class="counter">3000</span><span>+</span>
									</div>
									<span class="counter-text">Completed Projects</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
                                <div class="counter-style-1">
									<div class="text-white">
										<span class="counter">2500</span><span>+</span>
									</div>
									<span class="counter-text">Happy Clients</span>
								</div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
                                <div class="counter-style-1">
									<div class="text-white">
										<span class="counter">1500</span><span>+</span>
									</div>
									<span class="counter-text">Questions Answered</span>
								</div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
                                <div class="counter-style-1">
									<div class="text-white">
										<span class="counter">1000</span><span>+</span>
									</div>
									<span class="counter-text">Ordered Coffee's</span>
								</div>
                            </div>
                        </div>
				</div>
			</div>
			<!-- Testimonials END -->
			<!-- Testimonials ==== -->
			<div class="section-area section-sp2">
				<div class="container">
					<div class="row">
						<div class="col-md-12 heading-bx left">
							<h2 class="title-head text-uppercase">what people <span>say</span></h2>
							<p>It is a long established fact that a reader will be distracted by the readable content of a page</p>
						</div>
					</div>
					<div class="testimonial-carousel owl-carousel owl-btn-1 col-12 p-lr0">
						<div class="item">
							<div class="testimonial-bx">
								<div class="testimonial-thumb">
									<img src="assets/images/testimonials/pic1.jpg" alt="">
								</div>
								<div class="testimonial-info">
									<h5 class="name">Peter Packer</h5>
									<p>-Art Director</p>
								</div>
								<div class="testimonial-content">
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type...</p>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimonial-bx">
								<div class="testimonial-thumb">
									<img src="assets/images/testimonials/pic2.jpg" alt="">
								</div>
								<div class="testimonial-info">
									<h5 class="name">Peter Packer</h5>
									<p>-Art Director</p>
								</div>
								<div class="testimonial-content">
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type...</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Testimonials END ==== -->
        </div>
		<!-- contact area END -->
    </div>
    <!-- Content END-->
<?php require_once('footer.php'); ?>