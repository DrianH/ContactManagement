<?php
session_start();
?>
<!Doctype html>
<html>
    <head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <?php
        include('header.php');
        include('navbar.php');

        ?>      
		<style>
		.ii{
			border: solid rgb(255,193,5) 10px;
			opacity:0.9;
			width:100%;
			height:50px;
			border-radius: 25px;
			background-color:rgb(255,193,5);
			padding-bottom:70px;
			margin-bottom:250px;
		}
		
	.t{
		padding:25px;
			border-radius: 25px;
			border: solid rgb(255,193,5) 1px;

	}
	#size{
		width:150px;
		height:auto;
		border-radius:25px;
	}
	
		</style>
    </head>
  <body>
        

<main>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/fhtw.jpg" class="d-block w-100" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    </div>
                    <div class="carousel-item">
                        <img src="images/FHT.jpg" class="d-block w-100" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    </div>
                    <div class="carousel-item">
                        <img src="https://iam-blog-de.gumlet.io/blog/wp-content/uploads/2019/11/fh_technikum_wien_vorstellung.jpg?compress=true&quality=80&w=400&dpr=2.6" class="d-block w-100" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>   
          
    <div class="carousel-item">
<img src="images/FHT.jpg" class="d-block w-100" class="bd-placeholder-img" width="100%" height="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"> 
       <div class="carousel-caption d-md-block">
	</div>
  </div> 
	</div>
    <div class="carousel-item">
<img src="https://iam-blog-de.gumlet.io/blog/wp-content/uploads/2019/11/fh_technikum_wien_vorstellung.jpg?compress=true&quality=80&w=400&dpr=2.6"  class="d-block w-100"  class="bd-placeholder-img" width="100%" height="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"> 
   <div class="carousel-caption d-md-block">
	</div>
  </div> 
	</div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</main>




  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
	<h2 style="text-align:center;"><span  style="font-weight:bold; color:;" >SERVICES</span></h2>


    
    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Lorem Ipsum<span  style="color:rgb(140,177,16); font-weight:bold;" >Lorem Ipsum Lorem Ipsum</span></h2>
        <p class="lead">Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy.</p>
      </div>
      <div class="col-md-5">
<img src="images/FHT.jpg" style="width:450px; height:auto;">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Lorem Ipsum <span  style="color:rgb(140,177,16); font-weight:bold;">Lorem Ipsum text.</span></h2>
        <p class="lead">Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing.</p>
      </div>
      <div class="col-md-5 order-md-1">
<img src="images/FHT.jpg" style="width:450px; height:auto;">

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Lorem Ipsum<span  style="color:rgb(140,177,16); font-weight:bold;">Lorem Ipsum test Lorem</span></h2>
        <p class="lead">Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
      </div>
      <div class="col-md-5">
<img src="images/FHT.jpg" style="width:450px; height:auto;">
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->

 <?php
include('footer.php');
 ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
